<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TempatWisata extends Migration
{
	public function up()
	{
		$this->forge->addField('id');
		$this->forge->addField([
			'kategori_id' => [
				'type' => 'INT'
			],
			'email'		=>	[
				'type'			 => 'VARCHAR',
				'constraint'	 => 100,
				'unique'		 => TRUE
			],
			'password'		=>	[
				'type'			 => 'VARCHAR',
				'constraint'	 => 255,
			],
			'nama_wisata'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'alamat'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null'			 => true
			],
			'akses_kendaraan' => [
				'type'			=> 'ENUM',
				'constraint'	=> ['Motor', 'Mobil', 'Semua']
			],
			'no_hp'       => [
				'type'           => 'VARCHAR',
				'constraint'	 => '16'
			],
			'dari_hari' => [
				'type'			 => 'VARCHAR',
				'constraint' 	 => '30'
			],
			'sampai_hari' => [
				'type'			 => 'VARCHAR',
				'constraint' 	 => '30'
			],
			'jam_buka'       => [
				'type'           => 'TIME'
			],
			'jam_tutup'       => [
				'type'           => 'TIME'
			],
			'is_active'       => [
				'type'           => 'ENUM',
				'constraint'     => ['0', '1', '2'],
				'default'		 => '0'
			],
			'deskripsi'       => [
				'type'           => 'TEXT',
				'null'			 => TRUE
			],
			'foto'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'google_maps'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null'			 => TRUE
			],
			'created_at'		=> [
				'type'	=> 'DATETIME',
			],
			'updated_at'		=> [
				'type'	=> 'DATETIME',
			]
				
		]);
		$this->forge->addForeignKey('kategori_id', 'kategori_wisata', 'id');
		$this->forge->createTable('tempat_wisata');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tempat_wisata');
	}
}