<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table      = 'administrator';

    protected $allowedFields = [
        'username', 'password', 'email'
    ];

}