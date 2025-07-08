<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Klasifikasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 8,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_klasifikasi'      => [
                'type'       => 'CHAR',
                'constraint' => '50',
            ],
            'nama_klasifikasi'      => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'keterangan'          => [
                'type'          => 'TEXT',
                'null'          => false,
            ],
            'status_cd'      => [
                'type'       => 'ENUM',
                'constraint' => ['normal', 'nullified'],
                'default'     => 'normal',
            ],
            'created_user'     => [
                'type'       => 'INT',
                'constraint' => 8,
                'null'         => true,
            ],
            'created_dttm'      => [
                'type'       => 'DATETIME',
                'null'         => true,
            ],
            'updated_user'     => [
                'type'       => 'INT',
                'constraint' => 8,
                'null'         => true,
            ],
            'updated_dttm'      => [
                'type'       => 'DATETIME',
                'null'         => true,
            ],
            'nullified_user' => [
                'type'       => 'INT',
                'constraint' => 8,
                'null'         => true,
            ],
            'nullified_dttm'     => [
                'type'       => 'DATETIME',
                'null'         => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('klasifikasi');
    }

    public function down()
    {
        $this->forge->dropTable('klasifikasi');
    }
}
