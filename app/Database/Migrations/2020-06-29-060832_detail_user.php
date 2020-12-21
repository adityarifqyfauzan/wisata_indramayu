<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailUser extends Migration
{
	public function up()
	{
		$this->forge->addField('id');
		$this->forge->addField(
			[
				'user_id' => [
					'type'			 => 'INT'
				],
				'nama_user' => [
					'type'			 => 'VARCHAR',
					'constraint'	 => 30,
				],
				'no_hp' => [
					'type'			 => 'VARCHAR',
					'constraint'	 => 14,
					'null'			 => true
				],
				'alamat' => [
					'type'			 => 'VARCHAR',
					'constraint'	 => 255,
					'null'			 => true
				],
				'jenis_kelamin' => [
					'type'			 => 'ENUM',
					'constraint'	 => ['L', 'P'],
					'null'			 => true
				],
				'foto'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '255',
					'default'		 => 'default.jpg'
				]
			]
		);

		$this->forge->addForeignKey('user_id', 'users', 'id');
		$this->forge->createTable('detail_user');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('detail_user');
	}
}