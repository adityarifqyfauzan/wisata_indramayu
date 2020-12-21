<?php

namespace App\Controllers;

use Config\Services;

class AuthPagesUser extends BaseController
{
    public function login()
    {
        $data = [
            'title' => 'Login Pengguna',
            'validation' => Services::validation()
        ];
        return view('auth_user/login', $data);
    }

    public function registrasi()
    {
        $data = [
            'validation' => Services::validation(),
            'title' => 'Registrasi'
        ];

        return view('auth_user/registrasi', $data);
    }

    public function forgotPass()
    {
        $data = [
            'validation' => Services::validation(),
            'title' => 'Lupa Password'
        ];

        return view('auth_user/lupa_pass', $data);
    }

    public function errorAuth()
    {
        return view('auth_user/error/error_auth');
    }
}