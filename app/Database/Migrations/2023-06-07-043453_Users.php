<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'user_fullname' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'user_password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'dscription' => [
                'type'       => 'TEXT',
            ],
            'is_active' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
