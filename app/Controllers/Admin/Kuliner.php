<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\KulinerModel;

class Kuliner extends BaseController
{
    protected $dataKuliner;
    
    public function __construct()
    {
        $this->dataKuliner = new KulinerModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kuliner',
            'kuliner' => $this->dataKuliner->getAll(),
            'validation' => Services::validation()
        ];

        return view('admin/kuliner/index', $data);
    }

    public function tambahKuliner()
    {
        
        $validation = $this->validate([
            'nama_kuliner' => [ //ini kan baru nama, nah tinggal tambahin aja dibawahnya
                'rules' => 'required',
                'errors' => [
                    'required'   => 'kuliner harus diisi',
                ],
            ],

            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required'  => 'alamat harus diisi',
                ]
            ],

            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'deskripsi harus diisi',
                ]
            ],

            'foto' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'foto harus diisi',
                ]
            ],
            //dah ngapain lagi abis ini, kalo foto rulesnya bisa kamu liat di pengelola
        ]);

        if (!$validation) {
            
            return redirect()->to('/admin/kuliner')->withInput();

        } else {
            
            $data = [
                'nama_kuliner' => htmlspecialchars($this->request->getVar('nama_kuliner'))
            ];

            $this->dataKuliner->insert($data);

            $message = "Kuliner berhasil ditambahkan";
            $this->session->setFlashdata('message', $message);

            return redirect()->to('/admin/kuliner');

        }
        

    }

    public function editKuliner()
    {
        $validation = $this->validate([
            'kuliner' => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Kuliner tidak boleh kosong'
                ]
            ]
        ]);

        if (!$validation) {
            
            return redirect()->to('/admin/kuliner')->withInput();

        } else {
            
            $kuliner_id = $this->request->getVar('id');
            $data = [
                'kuliner' => $this->request->getVar('kuliner')
            ];

            $this->dataKuliner->update($kuliner_id, $data);
            
            $message = "Data berhasil diperbarui";
            $this->session->setFlashdata('message', $message);

            return redirect()->to('/admin/kuliner');

        }
        
    }

    public function hapusKuliner($id)
    {
        
        if ($id == null) {
            
            return redirect()->to('/admin/kuliner');

        } else {
            
            $dataKuliner = $this->dataKuliner->getById($id);

            if(!$dataKuliner){

                return redirect()->to('/admin/kuliner');

            }else{
                
                $this->dataKuliner->delete($id);
                $message = "Data berhasil dihapus";
                $this->session->setFlashdata('message', $message);

                return redirect()->to('/admin/kuliner');

            }

        }
        

    }

}
