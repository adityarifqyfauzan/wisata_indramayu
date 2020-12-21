<?php

namespace App\Controllers\Pengelola;

use App\Controllers\BaseController;
use App\Models\TempatWisataModel;
use App\Models\TiketModel;
use App\Models\KategoriWisataModel;
use Config\Services;

class Akun extends BaseController
{

    protected $tempatWisataModel;

    protected $tiketModel;

    protected $kategoriWisataModel;

    public function __construct()
    {
        $this->tiketModel = new TiketModel();
        $this->tempatWisataModel = new TempatWisataModel();
        $this->kategoriWisataModel = new KategoriWisataModel();
    }

    public function index()
    {
        $id = $this->session->get('id');
        $dataPengelola = $this->tempatWisataModel->getWisataById($id);
        $dataTiket = $this->tiketModel->getDataByIdWisata($id);

        $kategoriWisata = $this->kategoriWisataModel->getById($dataPengelola['kategori_id']);

        $data = [
            'title' => 'Akun',
            'dataPengelola' => $dataPengelola,
            'dataTiket' =>  $dataTiket,
            'dataKategoriWisata' => $kategoriWisata,
            'validation' => Services::validation()
        ];

        return view('pengelola/akun/index', $data);

    }

    public function setJam()
    {
        $id = $this->request->getVar('id');
        $jam_buka = $this->request->getVar('jam_buka');
        $jam_tutup = $this->request->getVar('jam_tutup');

        $validation = $this->validate([
            'jam_buka' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jam Buka harus diisi'
                ]
            ],
            'jam_tutup' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jam Tutup harus diisi'
                ]
            ]
        ]);

        if (!$validation) {

            $message = "Gagal Memperbarui jam operasional";
            $this->session->setFlashdata('error', $message);
            return redirect()->to('/pengelola/akun')->withInput();

        } else {
            
            $data = [
                'jam_buka' => $jam_buka,
                'jam_tutup'=> $jam_tutup
            ];

            $this->tempatWisataModel->update($id, $data);

            $message = "Berhasil memperbarui jam operasional";
            $this->session->setFlashdata('message', $message);
            return redirect()->to('/pengelola/akun');

        }
        
    }

    public function setHari()
    {
        //mengambil id wisata untuk update
        $id = $this->request->getVar('id');
        $dari_hari = $this->request->getVar('dari_hari');
        $sampai_hari = $this->request->getVar('sampai_hari');
        $setiap_hari = $this->request->getVar('setiap_hari');

        if ($dari_hari && $sampai_hari != null) {

            $data = [
                'dari_hari' => $dari_hari,
                'sampai_hari' => $sampai_hari
            ];

            $this->tempatWisataModel->update($id, $data);

            //set message ketika proses diatas berhasil
            $message = "Waktu operasional berhasil diperbarui";
            $this->session->setFlashdata('message', $message);

            return redirect()->to('/pengelola/akun');

        } else {
            
            if ($dari_hari != "" || $sampai_hari != "" && $setiap_hari != "") {
                # code...

                //set message ketika proses diatas berhasil
                $message = "Gagal Memperbarui waktu operasional";
                $this->session->setFlashdata('error', $message);

                return redirect()->to('/pengelola/akun');

            } else {
                
                $data = [
                    'dari_hari' => $setiap_hari,
                    'sampai_hari' => ''
                ];

                $this->tempatWisataModel->update($id, $data);

                //set message ketika proses diatas berhasil
                $message = "Waktu operasional berhasil diperbarui";
                $this->session->setFlashdata('message', $message);

                return redirect()->to('/pengelola/akun');

            }         

        }
    }

    public function uploadMainImage() 
    {
        $validation = $this->validate(
            [
                'foto' => [
                    'rules' => 'uploaded[foto]|max_size[foto,4000]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Jika ingin mengganti gambar, harap pilih gambar terlebih dahulu, lalu simpan',
                        'max_size' => 'Ukuran file terlalu besar, ukuran maksimal adalah 4 MB',
                        'is_image' => 'File yang Anda pilih harus berupa file gambar',
                        'mime_in' => 'File yang Anda pilih harus berupa file gambar',
                    ]
                ]
            ]
        );

        if (!$validation) {
            
            return redirect()->to('/pengelola/akun')->withInput();

        } else {

            //Ambil gambar yang diinputkan oleh pengelola
            $foto = $this->request->getFile('foto');

            //bikin nama random agar nama file foto tidak ada anomali ketika terjadi kesamaan nama
            $namaFoto = $foto->getRandomName();

            //pindahkan atau simpan gambar ke folder penyimpanan yang kita tentukan, disini kita menyimpannya di assets/img/profile_pengelola
            $foto->move('assets/img/profile_pengelola', $namaFoto);
            
            //Ambil id pengelola sebagai parameter pengelola mana yang datanya ingin di update/perbarui
            $id = $this->request->getVar('id');

            //siapkan data untuk kita masukkan kedalam database
            $data = [
                'foto' => $namaFoto
            ];

            //sebelum data terupdate, hapus terlebih dahulu foto lamanya agar tidak memenuhi penyimpanan, dengan cara :

            //1. cari nama foto yang sudah ada (yang suda exist)
            $dataPengelola = $this->tempatWisataModel->getWisataById($id);
            
            if($dataPengelola['foto'] != null){

                //simpan nama foto lama ini kedalam variable namaFotoLama
                $namaFotoLama = $dataPengelola['foto'];
    
                //hapus foto lama dari folder penyimpanan
                unlink('assets/img/profile_pengelola/' . $namaFotoLama);
                
            }

            //update data pada database
            $this->tempatWisataModel->update($id, $data);

            //set message ketika proses diatas berhasil
            $message = "Foto utama berhasil diperbarui";
            $this->session->setFlashdata('message', $message);
            
            
            return redirect()->to('/pengelola/akun');

        }
        
    }

    public function updateAkun()
    {
        $validation = $this->validate([
            'nama_wisata' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Wisata tidak boleh kosong'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required'    => 'Email tidak boleh kosong',
                    'valid_email' => 'Penulisan {field} tidak valid, contoh -> example@gmail.com'
                ]
            ],
            'no_hp'    => [
                'rules'        => 'required|numeric|max_length[15]',
                'errors'    => [
                    'required' => 'No Handphone harus diisi',
                    'numeric'  => 'No Handphone hanya boleh berisi angka',
                    'max_length' => 'No Handphone maksimal 15 angka'
                ]
            ],
        ]);

        if (!$validation) {
            
            return redirect()->to('/pengelola/akun')->withInput();

        } else {
            
            //ambil id pengelola sebagai parameter pengelola mana yang datanya ingin diperbarui 
            $id = $this->request->getVar('id');


            // set data akses kendaraan
            $motor = $this->request->getVar('motor');
            $mobil = $this->request->getVar('mobil');
            $akses_kendaraan = $this->akses_kendaraan($motor, $mobil);

            //siapkan data
            $data = [
                'nama_wisata'  => htmlspecialchars($this->request->getVar('nama_wisata')),
                'email'        => htmlspecialchars($this->request->getVar('email')),
                'no_hp'        => htmlspecialchars($this->request->getVar('no_hp')),
                'deskripsi'    => $this->request->getVar('deskripsi'),
                'alamat'       => $this->request->getVar('alamat'),
                'akses_kendaraan' => $akses_kendaraan,
                'google_maps'  => $this->request->getVar('google_maps') 
            ];

            //perbarui data pengelola melalui model tempatWisataModel
            $this->tempatWisataModel->update($id, $data);

            $message = "Data Tempat Wisata berhasil diperbarui";
            $this->session->setFlashdata('message', $message);

            return redirect()->to('/pengelola/akun');

        }
        
    }

    public function akses_kendaraan($motor = null, $mobil = null)
    {
        
        $akses_kendaraan = null;

        if ($motor && $mobil != null) {
            
            $akses_kendaraan = "Semua";

        } else {
            
            if ($motor != null) {
                
                $akses_kendaraan = "Motor";

            } else if ($mobil != null) {

                $akses_kendaraan = "Mobil";

            } else if ($mobil && $motor == null) {
                
                $akses_kendaraan = null;

            }

        }

        return $akses_kendaraan;
        
    }

}