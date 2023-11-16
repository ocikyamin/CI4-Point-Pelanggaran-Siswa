<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TmKelasNama extends Migration
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
            'sekolah_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'level_kelas_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'nama_kelas' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tm_kelas_nama');
        // $this->$forge->addForeignKey('sekolah_id', 'tm_level_kelas', 'id', 'CASCADE', 'CASCADE', 'fk_sekolah_id');
    }

    public function down()
    {
        $this->forge->dropTable('tm_kelas_nama');
    }
}
