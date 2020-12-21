<?php

namespace App\Models;

use CodeIgniter\Model;

class KulinerModel extends Model
{
    protected $table      = 'kuliner';

    protected $allowedFields = [
        'nama_kuliner', 'alamat', 'deskripsi', 'foto',
    ];

    public function getAll()
    {
        return $this->asArray()->findAll();
    }

    public function getKulinerById($id)
    {
        return $this->asArray()->where('id', $id)->first();
    }

}