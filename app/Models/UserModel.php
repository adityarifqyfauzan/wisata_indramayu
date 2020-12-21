<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';

    protected $allowedFields = [
        'email', 'password', 'is_active'
    ];

    protected $useTimestamps = true;

    public function getNamaID($email)
    {
        return $this->asArray()->where('email', $email)->first();
    }
}