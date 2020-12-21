<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\KategoriWisataModel;
use Config\Database;
use App\Models\TiketModel;

class TempatWisataModel extends Model
{

    protected $tiketModel;

    protected $db;

    protected $builder;

    protected $kategoriWisata;

    protected $table      = 'tempat_wisata';

    protected $allowedFields = [
        'email', 'password', 'nama_wisata', 'alamat', 'akses_kendaraan', 'no_hp', 'is_active', 'deskripsi', 'harga_tiket', 'foto', 'google_maps', 'jam_buka', 'jam_tutup', 'dari_hari', 'sampai_hari', 'kategori_id'
    ];

    protected $useTimestamps = true;

    public function __construct()
    {
        $this->kategoriWisata = new KategoriWisataModel();
        $this->db = Database::connect();
        $this->builder = $this->db->table($this->table);
        $this->tiketModel = new TiketModel();
    }

    public function getDataWisataAktif($dialogflow = false)
    {
        if ($dialogflow == true) {
            
            $getAlldata = $this->asArray()->where('is_active', '1')->orderBy('nama_wisata', 'ASC')->findAll();

            $data = "";
            $data.= "Berikut adalah tempat wisata di Indramayu : ";
            $no = 1;
            foreach ($getAlldata as $key) {
                
                $namawisata = $key['nama_wisata'];
                $data      .= $no . '.' . $namawisata . " | ";
                $no++;
            
            }

            $data .= "Anda bisa menanyakan lokasi, hari operasional maupun harga tiket wisata yang ada";
            $data .= "Apakah masih ada yang ingin ditanyakan lagi ? ";

            // return $getAlldata;
            return $data;

        } else {

            return $this->asArray()->where('is_active', '1')->findAll();
        
        }
        
    }

    public function getDataWisataBaru()
    {
        return $this->asArray()->where('is_active', '0')->findAll();
    }

    public function getWisataById($id)
    {
        
        return $this->asArray()->where('id', $id)->first();
        
    }

    public function getWisataByKategori($kategori_id)
    {
        return $this->asArray()->where('kategori_id', $kategori_id)->findAll();
    }

    public function getWisataByKategoriName($kategori, $text)
    {
        $kategori_id = $this->kategoriWisata->where('kategori', $kategori)->first();

        $getNamaKategori = explode(" ", $text);
        
        if($getNamaKategori[0] == "Wisata" || $getNamaKategori[0] == "wisata"){

            
            $getAlldata = $this->asArray()->where('kategori_id', $kategori_id['id'])->findAll();
            if ($getAlldata != null) {
                $result = "Berikut ini $kategori di Indramayu | ";
                $no = 1;
                foreach ($getAlldata as $key) {
                    $nama_wisata = $key['nama_wisata'];

                    $result .= "$no. $nama_wisata | ";
                }

                $result .= "Apakah masih ada yang ingin ditanyakan lagi ? ";
                
                $data = [
                    'status' => 200,
                    // 'text'   => "Berikut ini $kategori di Indramayu",
                    'text' => $result,
                    'dataWisata' => $getAlldata
                ];
                
                return $data;
                
            } else {
                
                $data = [
                    'status' => 404,
                    'text'   => "$kategori tidak ditemukan"
                ];
                
                return $data;

            }
            

            // return $getAlldata;
            
        } else {
            
            // $getAlldata = $this->builder->select('*')->like(['kategori_id' => $kategori_id['id'], 'nama_wisata', $getNamaKategori[0]])->get();

            $getAlldata = $this->asArray()->like('nama_wisata', $getNamaKategori[0])->findAll();
            
            // $getNamaWisata = $getAlldata->getResult();

            if($getAlldata != null){
                $result = "Berikut ini $kategori di Indramayu | ";
                $no = 1;
                foreach ($getAlldata as $key) {
                    $nama_wisata = $key['nama_wisata'];

                    $result .= "$no. $nama_wisata | ";
                }
                $result .= "Apakah masih ada yang ingin ditanyakan lagi ? ";
                $data = [
                    'status' => 201,
                    // 'text'   => "Berikut ini $getNamaKategori[0] di Indramayu",
                    'text' => $result,
                    'dataWisata' => $getAlldata
                ];
    
                return $data;

            }else{

                $data = [
                    'status' => 404,
                    'text'   => "strtoupper($getNamaKategori[0]) di Indramayu tidak ditemukan"
                ];

                return $data;

            }

        
        }


        // $data  = "";
        // $data .= "Berikut adalah $kategori di Indramayu : \n";
        // $no = 1;
        // foreach ($getAlldata as $key) {

        //     $namawisata = $key['nama_wisata'];
        //     $data.= "$no. $namawisata | ";
        //     $no++;
        // }

        // $data .= "\n Anda bisa menanyakan lokasi, hari operasional maupun harga tiket wisata yang ada";

        // return $data;
    }

    public function getInformasiWisataByName($namawisata)
    {
        
        $data = $this->builder->select("*")->where('is_active', '1')->like("nama_wisata", $namawisata)->get();

        if ($data->getResult() != null) {
            
            $result = $data->getResult();
            $text = "";
            foreach ($data->getResult() as $key) {
                $id = $key->id; 
                $nama_wisata = $key->nama_wisata;
                $foto = $key->foto;
                $alamat = $key->alamat;
                $deskripsi = $key->deskripsi;
                $no_hp = $key->no_hp;
            }
            
            // $text .= "Berikut ini informasi tentang $nama_wisata";
            $text .= "Nama Wisata : $nama_wisata | Alamat : $alamat | No Hp : $no_hp";
            $result .= "Apakah masih ada yang ingin ditanyakan lagi ? ";
            $data = [
                'status' => 200,
                'text'   => $text,
                'dataWisata' => [
                    'id'          => $id,
                    'nama_wisata' => $nama_wisata,
                    'foto'        => $foto,
                    'alamat'      => $alamat,
                    'deskripsi'   => $deskripsi
                ]
            ];

            return $data;

        }else{
            
            $result = "Nama wisata yang Anda cari tidak ditemukan";
            
            $data = [
                'status' => 404,
                'text'   => $result
            ];

            return $data;

        }

    }

    public function getLokasiWisata($namawisata)
    {
        // cari data di table tempat_wisata 
        $data = $this->builder->select('*')->like('nama_wisata', $namawisata)->get();
        
        // cek apakah data yang dicari tersebut ada atau tidak
        // jika ada
        if ($data->getResult() != null) {
            
            $result = "";

            foreach ($data->getResult() as $key) {
                
                $nama_wisata    = $key->nama_wisata;
                $akses_kendaraan = $key->akses_kendaraan;
                $google_maps    = $key->google_maps;
                $alamat         = $key->alamat;

                if($akses_kendaraan == "Semua"){

                    $akses = "Bisa diakses oleh semua kendaraan, baik roda 2 maupun roda 4";
                
                } else if ($akses_kendaraan == "Motor"){

                    $akses = "Untuk menuju lokasi hanya bisa menggunakan kendaraan roda 2";

                } else if ($akses_kendaraan == "Mobil"){

                    $akses = "Untuk menuju lokasi hanya bisa menggunakan kendaraan roda 4";

                } else if ($akses_kendaraan == null){
                    $akses = "";
                }

                $result .= "Alamat $nama_wisata ada di \n";
                $result .= "$alamat. $akses";
                $result .= "Apakah masih ada yang ingin ditanyakan lagi ? ";
                $data = [
                    'status' => 200,
                    'text' => $result,
                    'dataWisata' => [
                        'nama_wisata' => $nama_wisata,
                        'alamat'      => $alamat,
                        'google_maps' => $google_maps
                    ]
                ];

                return $data;
            }

        } 
        // jika tidak ada
        else {

            $result = "Nama wisata yang Anda cari tidak ditemukan";

            $data = [
                'status' => 404,
                'text' => $result,
            ];

            return $data;

        }

    }
    
    public function getWaktuOperasionalWisata($namawisata)
    {
        // cari data di table tempat_wisata 
        $data = $this->builder->select('*')->like('nama_wisata', $namawisata)->get();

        // cek apakah data yang dicari tersebut ada atau tidak
        // jika ada
        if ($data->getResult() != null) {
            
            $result = "";

            foreach ($data->getResult() as $key) {
                
                $nama_wisata    = $key->nama_wisata;
                $dari_hari      = $key->dari_hari;
                $sampai_hari    = $key->sampai_hari;
                $jam_buka       = $key->jam_buka;
                $jam_tutup      = $key->jam_tutup;

                if($dari_hari == "Setiap Hari"){

                    $result .= "$nama_wisata buka \n";
                    $result .= "$dari_hari, ";
                    $result .= "Jam $jam_buka sampai $jam_tutup \n";
                    
                    return $result;
                }
                
                $result .= "$nama_wisata \n";
                $result .= "Buka dari hari $dari_hari sampai $sampai_hari, \n";
                $result .= "dari jam $jam_buka - $jam_tutup \n";
                $result .= "Apakah masih ada yang ingin ditanyakan lagi ? ";
                return $result;
            }

        } 
        
        // jika tidak ada
        else {

            $result = "Nama wisata yang Anda cari tidak ditemukan";

            return $result;

        }

    }

    public function getHargaTiketWisata($namawisata)
    {
        // cari data di table tempat_wisata 
        $data = $this->builder->select('*')->like('nama_wisata', $namawisata)->get();

        if ($data->getResult() != null) {
            
            $result  = "";
            foreach ($data->getResult() as $key) {

                $result .= "Berikut ini harga tiket $key->nama_wisata : ";

                $dataTiket = $this->tiketModel->where('tempat_wisata_id', $key->id)->findAll();
                
                if ($dataTiket != null) {
                    
                    foreach ($dataTiket as $tiket) {
                        $keterangan = $tiket['keterangan'];
                        $keterangan_hari = $tiket['keterangan_hari'];
                        $harga = $tiket['harga'];

                        if($keterangan == "Semua"){
                            $keterangan = "Semua umur";
                        }

                        $result .= "$keterangan, ";
                        $result .= "hari $keterangan_hari, ";
                        $result .= "harga Tiket nya adalah Rp ". number_format($harga) .". ";

                    }
                    $result .= "Apakah masih ada yang ingin ditanyakan lagi ? ";
                    // $resultText = "Harga tiket $key->nama_wisata";

                    $data = [
                        "status" => 200,
                        "text"   => $result,
                        "dataTiket" => $dataTiket
                    ];

                    return $data;

                } else {
                    
                    $result = "$key->nama_wisata Gratis/Tidak ada tiket masuk";

                    $data = [
                        "status" => 404,
                        "text"   => $result
                    ];

                    return $data;
                }
                

            }
        }
        // jika nama wisata yang dicari tidak ditemukan
        else {
            $result = "Nama wisata yang Anda cari tidak ditemukan";

            $data = [
                "status" => 403,
                "text"   => $result
            ];

            return $data;
        }

    }

}