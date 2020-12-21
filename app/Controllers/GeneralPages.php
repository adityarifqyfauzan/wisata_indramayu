<?php

namespace App\Controllers;

use App\Models\tempatWisataModel;
use App\Models\KategoriWisataModel;

class GeneralPages extends BaseController
{

	//bikin global variabel untuk nyimpen model
	protected $tempatWisataModel;

	protected $kategoriWisataModel;

	protected $kategoriWisata;

	public function __construct()
	{
		//biar bisa dipake di tiap method
		$this->tempatWisataModel = new tempatWisataModel();
		$this->kategoriWisataModel = new KategoriWisataModel();
		
		$this->kategoriWisata = $this->kategoriWisataModel->findAll();
	}

	public function index()
	{
		$data = [
			'page' => 'home',
			'wisata' => $this->tempatWisataModel->getDataWisataAktif(),
			'kategori' => $this->kategoriWisata
		];
		return view('index', $data);
	}

	public function wisata()
	{
		$data = [
			'page' => 'wisata',
			'wisata' => $this->tempatWisataModel->getDataWisataAktif(),
			'kategori' => $this->kategoriWisata
		];
		return view('wisata', $data);
	}
	
	public function tentang()
	{
		$data = [
			'page' => 'tentang',
			'kategori' => $this->kategoriWisata
		];
		return view('tentang', $data);
	}
	
	public function kontak()
	{
		$data = [
			'page' => 'contact',
			'kategori' => $this->kategoriWisata
		];
		return view('contact', $data);
	}

}
