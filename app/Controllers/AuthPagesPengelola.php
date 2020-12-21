<?php

namespace App\Controllers;

use App\Models\KategoriWisataModel;
use Config\Services;

class AuthPagesPengelola extends BaseController
{
    protected $kategoriWisata;

    public function login()
    {
        $data = [
            'validation' => Services::validation(),
            'title' => 'Login'
        ];

        return view('pengelola/auth/login', $data);
    }

    public function registrasi()
    {   
        
        $this->kategoriWisata = new KategoriWisataModel();

        $data = [
            'validation' => Services::validation(),
            'title' => 'Registrasi',
            'kategori' => $this->kategoriWisata->getAll()
        ];

        return view('pengelola/auth/registrasi', $data);
        
    }

    public function lupaPassword()
    {
        
        $data = [
            'validation' => Services::validation(),
            'title' => 'Lupa Password',
        ];

        return view('pengelola/auth/lupa_password', $data);
    }

}