<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JenisSeeders extends Seeder
{
    public function run()
    {
        $data = [
            ['kode_jenis' => '001', 'nama_jenis' => 'Surat Perintah Tugas', 'keterangan' => 'Surat Perintah Tugas Inspektorat Provinsi Sumatera Selatan', 'created_dttm' => date('Y-m-d H:i:s')],
        ];
        $this->db->table('jenis')->insertBatch($data);
    }
}
