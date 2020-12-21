<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoWisataModel extends Model
{
    protected $table      = 'foto_wisata';

    protected $allowedFields = [
        'wisata_id', 'foto'
    ];

    public function getDataFoto($id)
    {
        return $this->asArray()->where('wisata_id', $id)->findAll();
    }

    public function getDataById($id)
    {
        return $this->asArray()->where('id', $id)->first();
    }
}