<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KelasRombel extends Migration
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
            'periode_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'sekolah_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
           
            'level_kelas_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'walas_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'rombel' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tm_kelas_rombel');
        // $this->$forge->addForeignKey('periode_id', 'tm_kelas_rombel', 'id', 'CASCADE', 'CASCADE', 'fk_periode_id');
    }

    public function down()
    {
        $this->forge->dropTable('tm_kelas_rombel');
    }
}
