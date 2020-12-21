<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KategoriWisata extends Migration
{
	public function up()
	{
		$this->forge->addField('id');
		$this->forge->addField([
			'kategori' => [
				'type' 		 => 'VARCHAR',
				'constraint' => '50'
			]
		]);
		$this->forge->createTable('kategori_wisata');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('kategori_wisata');
	}
}
