<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class PengelolaHasLogin implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        // Do something here
        if (session()->get('login')) {
            
            return redirect()->to('/pengelola/dashboard');

        }
        if (session()->get('role') == "admin") {
            return redirect()->to('/admin/dashboard');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}
