<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KlasifikasiSeeders extends Seeder
{
    public function run()
    {
        $data = [
            ['kode_klasifikasi' => '001', 'nama_klasifikasi' => 'Kepegawaian', 'keterangan' => 'Klasifikasi Surat Tentang Kepegawaian', 'created_dttm' => date('Y-m-d H:i:s')],
        ];
        $this->db->table('klasifikasi')->insertBatch($data);
    }
}
