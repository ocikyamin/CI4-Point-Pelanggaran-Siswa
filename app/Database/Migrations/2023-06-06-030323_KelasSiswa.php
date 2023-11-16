<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;
class KelasSiswa extends Migration
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
            'status_kelas' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'status_naik_kelas' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'ket_naik_kelas' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tm_kelas_siswa');
        // $this->$forge->addForeignKey('rombel_id', 'kelas_siswa', 'id', 'CASCADE', 'CASCADE', 'fk_rombel_id');
    }

    public function down()
    {
        $this->forge->dropTable('tm_kelas_siswa');
    }
}
