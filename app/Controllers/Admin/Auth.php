<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\AdminModel;

class Auth extends BaseController
{

    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function login_form()
    {
        $data = [
            'title' => 'Login',
            'validation' => Services::validation()
        ];

        return view('admin/auth/login', $data);
    }

    public function login()
    {
        
        $validation = $this->validate([
            'username' => [
                'rules' => 'required',
                'errors'=> [
                    'required' => 'Username harus diisi'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]',
                'errors'=> [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password minimal 5 karakter'
                ]
            ]
        ]);
        
        if (!$validation) {
            
            $validation_report = Services::validation();
            return redirect()->to('/admin/login')->withInput()->with('validation', $validation_report);

        } else {
            
            $username = htmlspecialchars($this->request->getVar('username'));
            $password = $this->request->getVar('password');

            $cekAdmin = $this->adminModel->where('username', $username)->first();

            if ($cekAdmin) {
                
                if (password_verify($password, $cekAdmin['password'])) {
                    
                    $data = [
                        'username' => $cekAdmin['username'],
                        'role'      => 'admin',
                        'isLogedin' => true
                    ];

                    $this->session->set($data);
                    $message = "Selamat Datang";
                    $this->session->setFlashdata('message', $message);
                    return redirect()->to('/admin/dashboard');

                } else {

                    $message = "Password yang Anda masukkan salah";
                    $this->session->setFlashdata('error', $message);
                    return redirect()->to('/admin/login')->withInput();

                }
                

            } else {

                $message = "Admin tidak terdaftar";
                $this->session->setFlashdata('error', $message);
                return redirect()->to('/admin/login')->withInput();

            }
            

        }
        
    }

    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard'
        ];

        return view('admin/dashboard', $data);
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/admin/login');
    }
    
}