<?php

namespace App\Controllers;

use App\Models\TempatWisataModel;
use App\Models\KategoriWisataModel;
use App\Models\FotoWisataModel;
use App\Models\TiketModel;

class Wisata extends BaseController
{

    protected $tempatWisataModel;

    protected $kategoriWisata;

    protected $allKategori;

    protected $fotoWisataModel;

    protected $tiketModel;

    public function __construct()
    {
        $this->kategoriWisata = new KategoriWisataModel();
        $this->tempatWisataModel = new TempatWisataModel();
        $this->allKategori = $this->kategoriWisata->findAll();
        $this->fotoWisataModel = new FotoWisataModel();
        $this->tiketModel = new TiketModel();
    }

    public function index($id = null)
    {
        
        if ($id == null || $id == '') {
            
            return redirect()->to('/');
            
        } else {
            
            $wisata = $this->tempatWisataModel->getWisataByKategori($id);
            $kategoriWisata = $this->kategoriWisata->where('id', $id)->first();
            $data = [
                'kategoriWisata' => $kategoriWisata,
                'wisata' => $wisata,
                'page' => 'wisata',
                'kategori' => $this->allKategori
            ];

            return view('wisata', $data);

        }

    }

    public function detail($id = null)
    {

        if ($id == null || $id == '') {
            
            return redirect()->to('/');

        } else {
            
            $tempat_wisata = $this->tempatWisataModel->getWisataById($id);
            
            $foto_wisata = $this->fotoWisataModel->getDataFoto($id);
            
            $tiket = $this->tiketModel->getDataByIdWisata($id);

            if ($tempat_wisata == null) {
                
                return redirect()->to('/');

            } else {

                $data = [
                    'page'   => 'Detail Wisata',
                    'wisata' => $tempat_wisata,
                    'kategori'=> $this->allKategori,
                    'foto_wisata' => $foto_wisata,
                    'tiket'  => $tiket
                ];

                return view('detail_wisata', $data);
            
            }

        }
        

    }

}