<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        // Do something here
        if (!session()->get('isLogedin')) {
            
            return redirect()->to('/admin/login');

        }
        if (session()->get('role') == 'pengelola') {
            
            return redirect()->to('/pengelola/dashboard');
        
        }

    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}
