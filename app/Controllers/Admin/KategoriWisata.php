<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\KategoriWisataModel;

class KategoriWisata extends BaseController
{
    protected $dataKategoriWisata;
    
    public function __construct()
    {
        $this->dataKategoriWisata = new KategoriWisataModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kategori Wisata',
            'kategori' => $this->dataKategoriWisata->getAll(),
            'validation' => Services::validation()
        ];

        return view('admin/wisata/kategori_wisata', $data);
    }

    public function tambahKategori()
    {
        
        $validation = $this->validate([
            'kategori' => [
                'rules' => 'required|is_unique[kategori_wisata.kategori]',
                'errors' => [
                    'required'    => 'Kategori harus diisi',
                    'is_unique'   => 'Nama kategori sudah ada'
                ]
            ]
        ]);

        if (!$validation) {
            
            return redirect()->to('/admin/kategori_wisata')->withInput();

        } else {
            
            $data = [
                'kategori' => htmlspecialchars($this->request->getVar('kategori'))
            ];

            $this->dataKategoriWisata->insert($data);

            $message = "Kategori berhasil ditambahkan";
            $this->session->setFlashdata('message', $message);

            return redirect()->to('/admin/kategori_wisata');

        }
        

    }

    public function editKategori()
    {
        $validation = $this->validate([
            'kategori' => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Kategori tidak boleh kosong'
                ]
            ]
        ]);

        if (!$validation) {
            
            return redirect()->to('/admin/kategori_wisata')->withInput();

        } else {
            
            $kategori_id = $this->request->getVar('id');
            $data = [
                'kategori' => $this->request->getVar('kategori')
            ];

            $this->dataKategoriWisata->update($kategori_id, $data);
            
            $message = "Data berhasil diperbarui";
            $this->session->setFlashdata('message', $message);

            return redirect()->to('/admin/kategori_wisata');

        }
        
    }

    public function hapusKategori($id)
    {
        
        if ($id == null) {
            
            return redirect()->to('/admin/kategori_wisata');

        } else {
            
            $dataKategori = $this->dataKategoriWisata->getById($id);

            if(!$dataKategori){

                return redirect()->to('/admin/kategori_wisata');

            }else{
                
                //hapus kategori wisata dari table
                $this->dataKategoriWisata->delete($id);
                
                $message = "Data berhasil dihapus";
                $this->session->setFlashdata('message', $message);

                return redirect()->to('/admin/kategori_wisata');

            }

        }
        

    }

}
