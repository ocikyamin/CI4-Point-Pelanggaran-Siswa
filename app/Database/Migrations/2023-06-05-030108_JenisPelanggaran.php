<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisPelanggaran extends Migration
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
            'jenis' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('jenis_pelanggaran');

    }

    public function down()
    {
        $this->forge->dropTable('jenis_pelanggaran');
    }
}
