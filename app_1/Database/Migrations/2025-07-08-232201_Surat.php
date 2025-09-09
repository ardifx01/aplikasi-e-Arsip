<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Surat extends Migration
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
            'tipe'           => [
                'type'       => 'ENUM',
                'constraint' => ['suratmasuk', 'suratkeluar'],
            ],
            'trackID'        => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'koresponden'    => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'no_surat'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'tgl_surat'      => [
                'type'       => 'DATE',
                'null'       => true,
            ],
            'id_unit'        => [
                'type'       => 'INT',
                'unsigned'   => true, 
                'null'       => true,
            ],
            'id_jenis'       => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true,
            ],
            'id_sifat'       => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true,
            ],
            'id_klasifikasi' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true,
            ],
            'id_sekretaris' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true,
            ],
            'id_kepala' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true,
            ],
            'status'      => [
                'type'       => 'ENUM',
                'constraint' => ['pengajuan', 'proses', 'selesai'],
                'default'     => 'normal',
            ],
            'perihal'        => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'keterangan'     => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'file_surat'     => [
                'type'       => 'TEXT',
                'null'       => true,
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
        // Tambahkan foreign key
        $this->forge->addForeignKey('id_unit', 'unit', 'id', 'CASCADE', 'SET NULL');
        $this->forge->addForeignKey('id_jenis', 'jenis', 'id', 'CASCADE', 'SET NULL');
        $this->forge->addForeignKey('id_sifat', 'sifat', 'id', 'CASCADE', 'SET NULL');
        $this->forge->addForeignKey('id_klasifikasi', 'klasifikasi', 'id', 'CASCADE', 'SET NULL');

        $this->forge->addKey('id', true);
        $this->forge->createTable('surat');
    }

    public function down()
    {
        $this->forge->dropTable('surat');
    }
}
