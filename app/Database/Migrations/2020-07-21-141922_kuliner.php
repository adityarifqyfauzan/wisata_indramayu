<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kuliner extends Migration
{
	public function up()
	{
		$this->forge->addField('id');
		$this->forge->addField(
			[
				'nama_kuliner' => [
					'type'			 => 'VARCHAR',
					'constraint'	 => 30,
				],
				'deskripsi' => [
					'type'			 => 'TEXT'
				],
				'alamat' => [
					'type'			 => 'VARCHAR',
					'constraint'	 => 255,
					'null'			 => true
				],
				'foto'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '255',
					'default'		 => 'default.jpg'
				]
			]
		);

		$this->forge->createTable('kuliner');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('kuliner');
	}
}
