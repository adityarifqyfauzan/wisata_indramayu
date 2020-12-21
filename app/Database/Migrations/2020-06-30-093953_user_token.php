<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserToken extends Migration
{
	public function up()
	{
		$this->forge->addField('id');
		$this->forge->addField(
			[
				'email' => [
					'type' 		 => 'VARCHAR',
					'constraint' => 100,
					'unique'	 => TRUE
				],
				'token' => [
					'type'		 => 'VARCHAR',
					'constraint' => 255
				],
				'created_at' => [
					'type'		=> 'INT'
				]
			]
		);

		$this->forge->createTable('user_token');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('user_token');
	}
}