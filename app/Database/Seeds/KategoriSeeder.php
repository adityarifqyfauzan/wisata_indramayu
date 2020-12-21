<?php

namespace App\Database\Seeds;

class KategoriSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            'kategori' => 'Wisata Alam'
        ];
        $this->db->table('kategori_wisata')->insert($data);
        
        $data = [
            'kategori' => 'Wisata Budaya'
        ];
        $this->db->table('kategori_wisata')->insert($data);
        
        $data = [
            'kategori' => 'Wisata Rekreasi'
        ];
        $this->db->table('kategori_wisata')->insert($data);
        
        $data = [
            'kategori' => 'Wisata Kuliner'
        ];
        $this->db->table('kategori_wisata')->insert($data);
        
        $data = [
            'kategori' => 'Wisata Religi'
        ];
        $this->db->table('kategori_wisata')->insert($data);
            
    }
}