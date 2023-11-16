<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CatatanPPS extends Migration
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
            'rombel_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'siswa_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'jenis_pelanggaran_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'pelanggaran_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'poin_langgar' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'catatan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('siswa_pelanggaran');
        // $this->$forge->addForeignKey('siswa_id', 'catatan_pelanggaran', 'id', 'CASCADE', 'CASCADE', 'fk_siswa_id');
    }

    public function down()
    {
        $this->forge->dropTable('siswa_pelanggaran');
    }
}
