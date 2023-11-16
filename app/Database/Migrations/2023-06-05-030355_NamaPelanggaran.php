<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NamaPelanggaran extends Migration
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
            'jenis_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'nama_pelanggaran' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addKey('id', true);
        // $this->$forge->addForeignKey('jenis_id', 'pelanggaran', 'id', 'CASCADE', 'CASCADE', 'fk_jenis_pelanggaran');

        $this->forge->createTable('daftar_pelanggaran');
    }

    public function down()
    {
        $this->forge->dropTable('daftar_pelanggaran');
    }
}
