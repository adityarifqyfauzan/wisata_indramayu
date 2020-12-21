<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Administrator extends Migration
{
	public function up()
	{
		$this->forge->addField('id');
		$this->forge->addField(
			[
				'username' => [
					'type'		 => 'VARCHAR',
					'constraint' => 20
				],
				'password' => [
					'type'		 => 'VARCHAR',
					'constraint' => 255
				],
				'email'	   => [
					'type'		 => 'VARCHAR',
					'constraint' => 100
				]
			]
		);

		$this->forge->createTable('administrator');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('administrator');
	}
}