<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailUserModel extends Model
{
    protected $table = 'detail_user';

    protected $allowedFields = [
        'user_id', 'nama_user', 'no_hp', 'alamat', 'jenis_kelamin', 'foto'
    ];
}  