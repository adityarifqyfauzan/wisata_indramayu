<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\DetailUserModel;
use Config\Services;
use App\Models\UserModel;
use App\Models\UserTokenModel;

class Auth extends BaseController
{

	//Property atau variable untuk menyimpan model agar bisa diakses oleh function yang ada dikelas ini dan kelas turunannya
	protected $userModel;
	protected $userTokenModel;
	protected $detailUser;

	public function __construct()
	{
		$this->detailUser = new DetailUserModel();
		$this->userModel = new UserModel();
		$this->userTokenModel = new UserTokenModel();
	}

	public function login()
	{
		//membuat rules validation untuk email dan password yang di inputkan oleh user
		$validation = $this->validate([
			'email' => [
				'rules' => 'required|valid_email',
				'errors' => [
					'required'    => '{field} harus diisi',
					'valid_email' => 'Penulisan {field} tidak valid, contoh -> example@gmail.com'
				]
			],
			'password' => [
				'rules'  => 'required|min_length[5]',
				'errors' => [
					'required'	 => '{field} harus diisi',
					'min_length' => '{field} minimal 5 karakter'
				]
			],
		]);
		
		//cek apakah validasi berhasil (memenuhi syarat) atau tidak
		if (!$validation) {
			//jika tidak maka ...
	
			//membuat laporan validasi error untuk ditampilkan ke user
			$validation_report = Services::Validation();
			return redirect()->to('/login')->withInput()->with('validation', $validation_report);

		} else {
			//jika berhasil

			//ambil data email dan password yang diinputkan user dan simpan kedalam variabel
			$email 	  = htmlspecialchars($this->request->getVar('email')); //fungsi htmlspecialchars digunakan agar sistem tidak memproses masukan berupa spesial karakter
			$password = $this->request->getVar('password');	

			//cek apakah email yang dimasukkan
			$cekUser = $this->userModel->where('email', $email)->first();

			if ($cekUser) {
				
				if ($cekUser['is_active'] == 1) {
					
					if (password_verify($password, $cekUser['password'])) {
						
						$dataUser = $this->detailUser->where('user_id', $cekUser['id'])->first();
						$nickname = explode(" ", $dataUser['nama_user']);
						
						//menyiapkan data untuk dijadikan sebuah session
						$data = [
							'id'   		=> $cekUser['id'],
							'email'		=> $cekUser['email'],
							'nama_user' => $nickname[0],
							'role'		=> 'user',
							'login'		=> true
						];

						//set session 
						$this->session->set($data);
						
						//arahkan ke halaman utama setelah login berhasil
						return redirect()->to('/');

					} else {

						$message = "Password Salah";
						$this->session->setFlashdata('error', $message);
						return redirect()->to('/login')->withInput();

					}
					

				} else {

					$message = "Akun Anda belum aktif, silahkan cek email Anda untuk melakukan aktivasi";
					$this->session->setFlashdata('error', $message);
					return redirect()->to('/login');

				}
				

			} else {

				$message = "Akun tidak terdaftar, silahkan daftar terlebih dahulu";
				$this->session->setFlashdata('error', $message);
				return redirect()->to('/login');

			}
			

		}
		

		$email = $this->request->getVar('email');
		return view('');
	}

	public function registrasi()
	{
		//set rules untuk validasi request input saat user melakukan registrasi
		$validation = $this->validate(
			[
				'nama'	   => [
					'rules'  => 'required',
					'errors' => [
						'required' => 'Nama harus diisi'
					]
				],

				'email'    => [
					'rules'  => 'required|is_unique[users.email]|valid_email',
					'errors' => [
						'required'    => '{field} harus diisi',
						'is_unique'   => '{field} ini sudah terdaftar',
						'valid_email' => 'Penulisan {field} tidak valid, contoh -> example@gmail.com'
					]
				],

				'password' => [
					'rules'  => 'required|min_length[5]',
					'errors' => [
						'required'	 => '{field} harus diisi',
						'min_length' => '{field} minimal 5 karakter'
					]
				],

				'password_confirm' => [
					'rules'  => 'required|matches[password]',
					'errors' => [
						'required' => '{field} harus diisi',
						'matches'  => 'Password Confirmation harus sama'
					]
				]
			]
		);

		//cek apakah validasi berhasil atau tidak
		if (!$validation) {
			//jika tidak berhasil ($validation bernilai false), maka..

			return redirect()->to('/registrasi')->withInput();
			
		} else {
			//jika berhasil ($validation bernilai true), maka... 

			$email = $this->request->getVar('email');

			$data = [
				'email' 	=> $email,
				'password'	=> password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
				'is_active' => '0',
			];

			//set token untuk verifikasi email dan forgot password
			$token = base64_encode(random_bytes(32));

			$user_token = [
				'email' 	  => $email,
				'token' 	  => $token,
				'created_at'  => time()
			];

			//insert Data User
			$this->userModel->insert($data);

			//insert Data token user
			$this->userTokenModel->insert($user_token);

			$userData = $this->userModel->getNamaID($email);
			$detailUserData = [
				'user_id'  		=> $userData['id'],
				'nama_user'		=> $this->request->getVar('nama')
			];

			$this->detailUser->insert($detailUserData);

			//kirim email
			$this->_sendEmail($email, $token, 'verify');

			$message = "Akun sudah berhasil terdaftar, cek email Anda untuk aktivasi akun";
			$this->session->setFlashdata('success', $message);
			return redirect()->to('/login');

		}
	}

	public function forgotPassword()
	{
		$validation = $this->validate([
			'email' => [
				'rules'  => 'required|valid_email',
				'errors' => [
					'required' 	  => 'Email harus diisi',
					'valid_email' => 'Penulisan {field} tidak valid, contoh -> example@gmail.com'
				]
			]
		]);

		if (!$validation) {
			
			$validation_report = Services::validation();
			return redirect()->to('/forgot_password')->withInput()->with('validation', $validation_report);

		} else {
			
			$email = $this->request->getVar('email');
			$token = base64_encode(random_bytes(32));
			$cekEmail = $this->userModel->where('email', $email)->first();

			if ($cekEmail) {
				
				if ($cekEmail['is_active'] != '0') {
					
					$this->_sendEmail($email, $token, 'forgot-password');

					$message = "Email reset password sudah dikirim, silahkan cek email Anda";
					$this->session->setFlashdata('success', $message);
					return redirect()->to('/forgot_password');

				} else {
					
					$message = "User belum melakukan aktivasi, silahkan cek email Anda untuk melakukan aktivasi";
					$this->session->setFlashdata('message', $message);
					return redirect()->to('/forgot_password');

				}
				

			} else {
				
				$message = "Email belum terdaftar, silahkan lakukan registrasi terlebih dahulu";
				$this->session->setFlashdata('message', $message);
				return redirect()->to('/forgot_password');
				
			}
			

		}
		
	}

	private function _sendEmail($data, $token, $option)
	{

		//konfigurasi email preference

		$config = [
			'protocol' 		=> 'smtp',
			'SMTPCrypto'	=> 'ssl',
			'SMTPHost'	 	=> 'smtp.gmail.com',
			'SMTPUser'		=> 'wisataindramayu8@gmail.com',
			'SMTPPass'		=> 'AdministratorWisata',
			'SMTPPort'		=> 465,
			'mailType'		=> 'html',
			'charset'		=> 'utf-8',
			'newline'		=> "\r\n"
		];

		//instansiasi class email
		$email = Services::email();

		//inisialisasi email dengan config yang udah kita atur diatas
		$email->initialize($config);

		if ($option == 'verify') {
			//membuat email
			$email->setFrom('wisataindramayu8@gmail.com', 'Wisata Indramayu');
			$email->setTo($data);
			$email->setSubject('Verifikasi Akun');
			$email->setMessage('Klik <a href="' . base_url() . '/auth/verify?email=' . $data . '&token=' . urlencode($token) . '">Activate</a>');

			//kirim email
			$email->send();
		}else if($option == 'forgot-password'){

			$email->setFrom('wisataindramayu8@gmail.com', 'Wisata Indramayu');
			$email->setTo($data);
			$email->setSubject('Reset Password');
			$email->setMessage('Klik <a href="' . base_url() . '/auth/forgot-pass?email=' . $data . '&token=' . urlencode($token) . '">Reset Password</a>');

			//kirim email
			$email->send();

		}
	}

	public function newPassword()
	{
		dd($this->request->getVar());
	}

	public function verify()
	{
		//variabel $email digunakan untuk menyimpan nilai yang diambil dari url verify
		$email	= $this->request->getVar('email');

		//variabel $token digunakan untuk menyimpan nilai yang diambil dari url verify
		$token  = $this->request->getVar('token');

		//cek apakah email yang dikirim melalui url ada didalam tabel user
		$user 	= $this->userModel->where('email', $email)->first();


		if ($user) {
			//jika user nya ada maka


			$cekToken = $this->userTokenModel->where('token', $token)->first();
			//cek token
			if ($cekToken) {

				//cek batas waktu penggunaan token (hanya 24 jam)
				if (time() - $cekToken['created_at'] < (60 * 60 * 24)) {

					$is_active = [
						'is_active' => '1'
					];

					$this->userModel->update($user['id'], $is_active);
					$this->userTokenModel->where('email', $email)->delete();

					$message = "Email ". $email . " sudah aktif, silahkan login";
					$this->session->setFlashdata('success', $message);
					return redirect()->to('/login');

				} else {

					$this->detailUser->where('user_id', $user['id'])->delete();
					$this->userTokenModel->where('email', $email)->delete();
					$this->userModel->where('email', $email)->delete();

					$message = "Token expired, Silahkan daftar ulang";
					$this->session->setFlashdata('error', $message);
					return redirect()->to('/login');

				}
			} else {

				$message = "Token Anda tidak valid, Aktifasi kembali akun Anda dengan mengklik link yang dikirim lewat email";
				$this->session->setFlashdata('error', $message);
				return redirect()->to('/login');

			}
		} else {

			$message = "Email Anda tidak valid, Aktifasi kembali akun Anda dengan mengklik link yang dikirim lewat email";
			$this->session->setFlashdata('error', $message);
			return redirect()->to('/login');

		}
	}

	public function logout()
	{
		$this->session->destroy();
		return redirect()->to('/');
	}
}