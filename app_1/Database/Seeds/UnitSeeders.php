<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UnitSeeders extends Seeder
{
    public function run()
    {
        $data = [
            ['kode_unit' => '001', 'nama_unit' => 'Bagian Umum', 'keterangan' => 'Bagian Umum di Inspektorat Provinsi Sumatera Selatan','created_dttm' => date('Y-m-d H:i:s')],
        ];
        $this->db->table('unit')->insertBatch($data);
    }
}
