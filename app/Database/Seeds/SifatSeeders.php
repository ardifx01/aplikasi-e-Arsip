<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SifatSeeders extends Seeder
{
    public function run()
    {
        $data = [
            ['kode_sifat' => '001', 'nama_sifat' => 'Biasa', 'keterangan' => 'Sifat Surat Biasa', 'created_dttm' => date('Y-m-d H:i:s')],
        ];
        $this->db->table('sifat')->insertBatch($data);
    }
}
