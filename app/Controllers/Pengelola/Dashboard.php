<?php

namespace App\Controllers\Pengelola;

use App\Controllers\BaseController;
use App\Models\TempatWisataModel;
use Config\Services;

class Dashboard extends BaseController
{

    protected $tempatWisataModel;

    public function __construct()
    {
        $this->tempatWisataModel = new TempatWisataModel();
    }

    public function index()
    {
        $id = $this->session->get('id');
        $dataPengelola = $this->tempatWisataModel->getWisataById($id);

        $data = [
            'title' => 'Dashboard',
            'dataPengelola' => $dataPengelola
        ];
    
        return view('pengelola/dashboard/dashboard', $data);
    
    }

}