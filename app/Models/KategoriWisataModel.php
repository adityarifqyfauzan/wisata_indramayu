<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriWisataModel extends Model
{
    protected $table      = 'kategori_wisata';

    protected $allowedFields = [
        'kategori'
    ];

    public function getAll()
    {
        return $this->asArray()->findAll();
    }

    public function getById($id)
    {
        return $this->asArray()->where('id', $id)->first();
    }

}