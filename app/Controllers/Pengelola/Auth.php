<?php

namespace App\Controllers\Pengelola;

use App\Controllers\BaseController;
use App\Models\TempatWisataModel;
use Config\Services;
use App\Models\UserTokenModel;

class Auth extends BaseController
{

	//Property atau variable untuk menyimpan model agar bisa diakses oleh function yang ada dikelas ini dan kelas turunannya
	protected $tempatWisataModel;

	protected $userTokenModel;

	public function __construct()
	{
		$this->tempatWisataModel = new TempatWisataModel();
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
			return redirect()->to('/pengelola/login')->withInput()->with('validation', $validation_report);

		} else {
			//jika berhasil

			//ambil data email dan password yang diinputkan user dan simpan kedalam variabel
			$email 	  = htmlspecialchars($this->request->getVar('email')); //fungsi htmlspecialchars digunakan agar sistem tidak memproses masukan berupa spesial karakter
			$password = $this->request->getVar('password');	
			
			//cek apakah email yang dimasukkan
			$cekPengelola = $this->tempatWisataModel->where('email', $email)->asArray()->first();
			// dd($cekPengelola); ds
			if ($cekPengelola) {
				
				if ($cekPengelola['is_active'] == 1) {
					
					if (password_verify($password, $cekPengelola['password'])) {
						
						//menyiapkan data untuk dijadikan sebuah session
						$data = [
							'id'   		 => $cekPengelola['id'],
							'nama_wisata'=> $cekPengelola['nama_wisata'],
							'email'		 => $cekPengelola['email'],
							'role'		 => 'pengelola',
							'login'		 => true
						];

						//set session 
						$this->session->set($data);
						$message = "Selamat datang admin pengelola ". $cekPengelola['nama_wisata'];
						$this->session->setFlashdata('message', $message);
						//arahkan ke halaman utama setelah login berhasil
						return redirect()->to('/pengelola/dashboard');

					} else {

						$message = "Password Salah";
						$this->session->setFlashdata('error', $message);
						return redirect()->to('/pengelola/login')->withInput();

					}
					

				} else {

					$message = "Akun Anda belum aktif, silahkan cek email Anda untuk melakukan aktivasi";
					$this->session->setFlashdata('error', $message);
					return redirect()->to('/pengelola/login');

				}
				

			} else {

				$message = "Akun tidak terdaftar, silahkan daftar terlebih dahulu";
				$this->session->setFlashdata('error', $message);
				return redirect()->to('/pengelola/login');

			}
			
		}
		
	}


	public function registrasi()
	{
		//set rules untuk validasi request input saat Pengelola melakukan registrasi
		$validation = $this->validate(
			[
				'nama_wisata'	   => [
					'rules'  => 'required',
					'errors' => [
						'required' => 'Nama Tempat Wisata harus diisi'
					]
				],

				'kategori_id' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Kategori harus dipilih'
					]
				],

				'email'    => [
					'rules'  => 'required|is_unique[tempat_wisata.email]|valid_email',
					'errors' => [
						'required'    => '{field} harus diisi',
						'is_unique'   => '{field} ini sudah terdaftar',
						'valid_email' => 'Penulisan {field} tidak valid, contoh -> example@gmail.com'
					]
				],
				'no_hp'	=> [
					'rules'		=> 'required|numeric|max_length[15]',
					'errors'	=> [
						'required' => 'No Handphone harus diisi',
						'numeric'  => 'No Handphone hanya boleh berisi angka',
						'max_length' => 'No Handphone maksimal 15 angka'
					]
				],
				'password' => [
					'rules'  => 'required|min_length[5]',
					'errors' => [
						'required'	 => '{field} harus diisi',
						'min_length' => '{field} minimal 5 karakter'
					]
				],

				'ulang_password' => [
					'rules'  => 'required|matches[password]',
					'errors' => [
						'required' => 'Ulang password harus diisi',
						'matches'  => 'Password Confirmation harus sama'
					]
				],

				'alamat' => [
					'rules' => 'required',
					'errors'=> [
						'required' => 'Alamat harus diisi'
					]
				]

			]
		);

		//cek apakah validasi berhasil atau tidak
		if (!$validation) {
			//jika tidak berhasil ($validation bernilai false), maka..

			return redirect()->to('/pengelola/registrasi')->withInput();
			
		} else {
			
			$email 		 = $this->request->getVar('email');
			$password 	 = $this->request->getVar('password');
			$nama_wisata = $this->request->getVar('nama_wisata');
			$alamat 	 = $this->request->getVar('alamat');
			$no_hp		 = $this->request->getVar('no_hp');
			$kategori_id = $this->request->getVar('kategori_id');

			$data = [
				'email' 		=> htmlspecialchars($email),
				'password'  	=> password_hash($password, PASSWORD_DEFAULT),
				'nama_wisata' 	=> htmlspecialchars($nama_wisata),
				'alamat'		=> htmlspecialchars($alamat),
				'no_hp'			=> htmlspecialchars($no_hp),
				'kategori_id'	=> $kategori_id
			];

			$this->tempatWisataModel->insert($data);

			$message = "Akun sudah berhasil terdaftar, Namun masih dalam tahap verifikasi oleh Dinas Pariwisata";
			$this->session->setFlashdata('success', $message);
			return redirect()->to('/pengelola/login');

		}
	}

	public function lupaPassword()
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
			
			return redirect()->to('/pengelola/lupa-password')->withInput();

		} else {

			$email = $this->request->getVar('email');
			$token = base64_encode(random_bytes(32));
			$cekEmail = $this->tempatWisataModel->where('email', $email)->first();

			if ($cekEmail) {
				
				if ($cekEmail['is_active'] == 1) {
					
					$data = [
						'email' => $email,
						'token' => $token
					];

					$this->userTokenModel->insert($data);

					$this->_sendEmail($email, $token, 'lupa-password');

				} else if ($cekEmail['is_active'] == 0) {

					$message = "Akun Anda belum terverifikasi, Harap menunggu konfirmasi dari pihak terkait";
					$this->session->setFlashdata('error', $message);
					return redirect()->to('/pengelola/lupa-password');

				} else if ($cekEmail['is_active'] == 2) {

					$message = "Akun Anda sudah diblacklist, ajukan kembali pembuatan akun, atau hubungi Administrator";
					$this->session->setFlashdata('error', $message);
					return redirect()->to('/pengelola/lupa-password');

				}
				

			} else {

				$message = "Email belum terdaftar, silahkan lakukan registrasi terlebih dahulu";
				$this->session->setFlashdata('error', $message);
				return redirect()->to('/pengelola/lupa-password');

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
			$email->setMessage('Akun anda sudah aktif, silahkan <a href="'. base_url("/pengelola/login") .'" >Login</a>');

			//kirim email
			$email->send();

		}else if($option == 'lupa-password'){

			$email->setFrom('wisataindramayu8@gmail.com', 'Wisata Indramayu');
			$email->setTo($data);
			$email->setSubject('Reset Password');
			$email->setMessage('Klik <a href="' . base_url() . '/pengelola/lupa-password?email=' . $data . '&token=' . urlencode($token) . '">Reset Password</a>');

			//kirim email
			$email->send();

		}
	}

	public function newPassword()
	{
		dd($this->request->getVar());
	}

	public function logout()
	{
		$this->session->destroy();
		return redirect()->to('/pengelola/login');
	}

	
}