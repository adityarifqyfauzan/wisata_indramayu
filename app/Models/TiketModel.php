<?php

namespace App\Models;

use CodeIgniter\Model;

class TiketModel extends Model
{
    protected $table      = 'harga_tiket';

    protected $allowedFields = [
        'tempat_wisata_id', 'keterangan', 'keterangan_hari', 'harga'
    ];

    public function getDataByIdWisata($id)
    {
        // if ($id == null) {
            
        //     return "Gratis";

        // }
        
        return $this->asArray()->where('tempat_wisata_id', $id)->findAll();
    }
}