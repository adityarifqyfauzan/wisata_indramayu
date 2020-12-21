<?php

namespace App\Database\Seeds;

class AdminSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            'username'  => 'admin',
            'password'  => password_hash('admin', PASSWORD_DEFAULT),
            'email'     => 'wisataindramayu8@gmail.com'
        ];

        $this->db->table('administrator')->insert($data);
    }
}