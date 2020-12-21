<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HargaTiket extends Migration
{
	public function up()
	{
		$this->forge->addField('id');
		$this->forge->addField([
			'tempat_wisata_id' => [
				'type'	=> 'INT',
			],
			'keterangan' => [
				'type'	=> 'ENUM',
				'constraint' => ['Anak-Anak', 'Dewasa', 'Semua']
			],
			'keterangan_hari' => [
				'type'	=> 'ENUM',
				'constraint' => ['Biasa', 'Libur']
			],
			'harga' => [
				'type' => 'INT'
			]
		]);
		
		$this->forge->addForeignKey('tempat_wisata_id', 'tempat_wisata', 'id');
		$this->forge->createTable('harga_tiket');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('harga_tiket');
	}
}
