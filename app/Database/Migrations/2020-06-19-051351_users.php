<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		$this->forge->addField('id');
		$this->forge->addField([
			'email'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
				'unique'		 => TRUE
			],
			'password'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'is_active'       => [
				'type'           => 'ENUM',
				'constraint'     => ['0', '1']
			],
			'created_at'       => [
				'type'           => 'DATETIME',
				'null'			 => true,
			],
			'updated_at'       => [
				'type'           => 'DATETIME',
				'null'			 => true,
			],

		]);

		$this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('users');
	}
}