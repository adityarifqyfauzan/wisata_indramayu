<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FotoWisata extends Migration
{
	public function up()
	{
		$this->forge->addField('id');
		$this->forge->addField(
			[
				'wisata_id' => [
					'type' 	   => 'INT'
				],
				'foto' => [
					'type' 	   => 'VARCHAR',
					'constraint' => 255
				]
			]
		);

		$this->forge->addForeignKey('wisata_id', 'tempat_wisata', 'id');
		$this->forge->createTable('foto_wisata');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('foto_wisata');
	}
}