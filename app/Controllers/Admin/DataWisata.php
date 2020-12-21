<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\AdminModel;
use App\Models\TempatWisataModel;

class DataWisata extends BaseController
{

    protected $tempatWisataModel;

    public function __construct()
    {
        $this->tempatWisataModel = new TempatWisataModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Wisata',
            'wisata'=> $this->tempatWisataModel->getDataWisataAktif()
        ];

        return view('admin/wisata/index', $data);
    }

    public function pengajuanBaru()
    {
        $data = [
            'title' => 'Pengajuan Wisata Baru',
            'wisata' => $this->tempatWisataModel->getDataWisataBaru()
        ];

        return view('admin/wisata/wisata_baru', $data);
    }

    public function aktifkanAkunWisata($id)
    {
        
        $cekWisata = $this->tempatWisataModel->getWisataById($id);

        if ($cekWisata) {
            
            $data = [
                'is_active' => '1'
            ];

            $this->tempatWisataModel->update($id, $data);
            $this->_sendEmail($cekWisata['email'], 'aktif');
            $message = "Akun Berhasil Diaktifkan";
            $this->session->setFlashdata('message', $message);
            return redirect()->to("/admin/wisata/$id");

        }else {
            
            $message = "Akun tidak ditemukan";
            $this->session->setFlashdata('error', $message);
            return redirect()->to("/admin/wisata/$id");

        }

    }

    public function nonAktifkanAkunWisata($id)
    {
        $cekWisata = $this->tempatWisataModel->getWisataById($id);

        if ($cekWisata) {

            $data = [
                'is_active' => '0'
            ];

            $this->tempatWisataModel->update($id, $data);

            $message = "Akun Berhasil Dinonaktifkan";
            $this->session->setFlashdata('message', $message);
            return redirect()->to("/admin/wisata/$id");

        } else {

            $message = "Akun tidak ditemukan";
            $this->session->setFlashdata('error', $message);
            return redirect()->to("/admin/wisata/$id");

        }
        
    }

    public function detail($id)
    {   
        
        $dataWisata = $this->tempatWisataModel->getWisataById($id);
        
        if ($dataWisata == null) {
            return redirect()->to('/admin/dashboard');
        }

        $data = [
            'title' => 'Detail Tempat Wisata',
            'wisata' => $this->tempatWisataModel->getWisataById($id)
        ];

        return view('admin/wisata/detail_wisata', $data);
    }

    private function _sendEmail($data, $option)
    {

        //konfigurasi email preference

        $config = [
            'protocol'      => 'smtp',
            'SMTPCrypto'    => 'ssl',
            'SMTPHost'      => 'smtp.gmail.com',
            'SMTPUser'      => 'wisataindramayu8@gmail.com',
            'SMTPPass'      => 'AdministratorWisata',
            'SMTPPort'      => 465,
            'mailType'      => 'html',
            'charset'       => 'utf-8',
            'newline'       => "\r\n"
        ];

        //instansiasi class email
        $email = Services::email();

        //inisialisasi email dengan config yang udah kita atur diatas
        $email->initialize($config);

        if ($option == 'aktif') {
            //membuat email
            $email->setFrom('wisataindramayu8@gmail.com', 'Wisata Indramayu');
            $email->setTo($data);
            $email->setSubject('Verifikasi Akun');
            $email->setMessage('<p>Akun Anda sudah aktif, silahkan Login</p> <a href="' . base_url() . '/pengelola/login"><b>Login disini!</b></a>');

            //kirim email
            $email->send();
        } else if ($option == 'nonaktif') {

        }
    }

    
}