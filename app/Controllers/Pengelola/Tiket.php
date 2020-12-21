<?php

namespace App\Controllers\Pengelola;

use App\Controllers\BaseController;
use App\Models\TempatWisataModel;
use App\Models\TiketModel;

class Tiket extends BaseController
{

    protected $tiketModel;

    public function __construct()
    {
        $this->tiketModel = new TiketModel();
    }

    public function tambahTiket()
    {
        $tempat_wisata_id = $this->request->getVar('tempat_wisata_id');
        $keterangan = $this->request->getVar('keterangan');
        $keterangan_hari = $this->request->getVar('keterangan_hari');
        $harga = htmlspecialchars($this->request->getVar('harga'));
        
        $validate = $this->validate([
            'harga' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga harus diisi',
                    'numeric'  => 'Harga harus diisi dengan angka'
                ]
            ]
        ]);

        if (!$validate) {

            $message = "Input data Tiket gagal, silahkan cek kembali";
            $this->session->setFlashdata('error', $message);
            return redirect()->to('/pengelola/akun')->withInput();
        } else {

            $data = [
                'tempat_wisata_id' => $tempat_wisata_id,
                'keterangan'       => $keterangan,
                'keterangan_hari'  => $keterangan_hari,
                'harga'            => $harga
            ];

            //insert data
            $this->tiketModel->insert($data);

            $message = "Berhasil menambahkan data tiket";
            $this->session->setFlashdata('message', $message);

            return redirect()->to('/pengelola/akun');
        }
    }

    public function editTiket()
    {
        $id = $this->request->getVar('id');
        $keterangan = $this->request->getVar('keterangan');
        $keterangan_hari = $this->request->getVar('keterangan_hari');
        $harga = htmlspecialchars($this->request->getVar('harga'));

        $validate = $this->validate([
            'harga' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga harus diisi',
                    'numeric'  => 'Harga harus diisi dengan angka'
                ]
            ]
        ]);

        if (!$validate) {

            $message = "Gagal memperbarui data tiket, silahkan cek kembali";
            $this->session->setFlashdata('error', $message);
            return redirect()->to('/pengelola/akun')->withInput();

        } else {

            $data = [
                'keterangan'       => $keterangan,
                'keterangan_hari'  => $keterangan_hari,
                'harga'            => $harga
            ];

            //insert data
            // dd($this->request->getVar());
            $this->tiketModel->update($id, $data);

            $message = "Berhasil memperbarui data tiket";
            $this->session->setFlashdata('message', $message);

            return redirect()->to('/pengelola/akun');
        }
    }

    public function hapusTiket($id)
    {
        if ($id == null) {
            
            return redirect()->to('/pengelola/akun');

        } else {
            
            //hapus data tiket dari table tiket
            $this->tiketModel->delete($id);

            // set pesan untuk ditampilkan
            $message = "Data tiket berhasil dihapus";
            $this->session->setFlashdata('message', $message);

            // arahkan kembali ke halaman pengaturan akun pengelola
            return redirect()->to('/pengelola/akun');

        }
        
    }
}