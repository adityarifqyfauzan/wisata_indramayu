<?php

namespace App\Controllers\Pengelola;

use App\Controllers\BaseController;
use App\Models\FotoWisataModel;
use CodeIgniter\Session\Session;
use Config\Services;

class Galeri extends BaseController
{

    protected $fotoWisataModel;

    public function __construct()
    {
        $this->fotoWisataModel = new FotoWisataModel();
    }

    public function index()
    {
        
        $data = [
            'title' => 'Galeri',
            'foto'  => $this->fotoWisataModel->getDataFoto($this->session->get('id')),
            'validation' => Services::validation()
        ];

        return view('pengelola/galeri/index', $data);

    }

    public function uploadFoto()
    {
        $validation = $this->validate(
            [
                'foto' => [
                    'rules' => 'uploaded[foto]|max_size[foto,3000]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Jika ingin mengganti gambar, harap pilih gambar terlebih dahulu, lalu simpan',
                        'max_size' => 'Ukuran file terlalu besar, ukuran maksimal adalah 3 MB',
                        'is_image' => 'File yang Anda pilih harus berupa file gambar',
                        'mime_in' => 'File yang Anda pilih harus berupa file gambar',
                    ]
                ]
            ]
        );

        if (!$validation) {

            return redirect()->to('/pengelola/galeri')->withInput();

        } else {
            //Ambil id pengelola
            $id = $this->session->get('id');

            //Ambil gambar yang diinputkan oleh pengelola
            $foto = $this->request->getFile('foto');

            //bikin nama random agar nama file foto tidak ada anomali ketika terjadi kesamaan nama
            $namaFoto = $foto->getRandomName();

            //pindahkan atau simpan gambar ke folder penyimpanan yang kita tentukan, disini kita menyimpannya di assets/img/profile_pengelola
            $foto->move('assets/img/galeri', $namaFoto);

            //siapkan data untuk kita masukkan kedalam database
            $data = [
                'wisata_id' => $id,
                'foto' => $namaFoto
            ];

            $this->fotoWisataModel->insert($data);

            $message = "Foto berhasil diupload ke Galeri";
            $this->session->setFlashdata('message', $message);

            return redirect()->to('/pengelola/galeri');

        }

    }

    public function hapusFoto($id)
    {
        // cek apakah ada id yang dikirimkan dari url
        // apabila null maka dikembalikan ke halaman /pengelola/galeri
        if ($id == null) {
            return redirect()->to('/pengelola/galeri');
        }

        // cari data foto berdasarkan id
        $dataFoto = $this->fotoWisataModel->getDataById($id);

        // ambil nama foto
        $namaFoto = $dataFoto['foto'];

        // hapus foto lama dari folder penyimpanan
        unlink('assets/img/galeri/' . $namaFoto);

        // hapus foto dari database
        $this->fotoWisataModel->delete($id);

        // set pesan untuk ditampilkan ke user
        $message = "Foto berhasil dihapus dari Galeri";
        $this->session->setFlashdata('message', $message);

        // kembalikan ke halaman /pengelola/galeri
        return redirect()->to('/pengelola/galeri');

    }
}