<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TempatWisataModel;
use Config\Database;

class Dashboard extends BaseController
{

    protected $tempatWisataModel;

    protected $builder;

    protected $db;

    public function __construct()
    {
        $this->tempatWisataModel = new TempatWisataModel();
        $this->db = Database::connect();
        $this->builder = $this->db->table('tempat_wisata');
    }

    public function index()
    {
        $wisata_alam = $this->builder->select('*')->where('kategori_id', 1)->countAllResults();
        $wisata_budaya = $this->builder->select('*')->where('kategori_id', 2)->countAllResults();
        $wisata_rekreasi = $this->builder->select('*')->where('kategori_id', 3)->countAllResults();
        $wisata_kuliner = $this->builder->select('*')->where('kategori_id', 4)->countAllResults();
        $wisata_religi = $this->builder->select('*')->where('kategori_id', 5)->countAllResults();

        $data = [
            'title' => 'Dashboard',
            'wisata_alam' => $wisata_alam,
            'wisata_budaya' => $wisata_budaya,
            'wisata_rekreasi' => $wisata_rekreasi,
            'wisata_kuliner' => $wisata_kuliner,
            'wisata_religi' => $wisata_religi,
        ];

        return view('admin/dashboard', $data);
    }

    
}