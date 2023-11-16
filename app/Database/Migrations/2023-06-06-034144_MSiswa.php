<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class MSiswa extends Migration
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
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'nisn' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama_siswa' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'jk' => [
                'type'       => 'VARCHAR',
                'constraint' => '12',
            ],
            'nama_ortu' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'hp_ortu' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'is_active' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('m_siswa');
    }

    public function down()
    {
        $this->forge->dropTable('m_siswa');
    }
}
