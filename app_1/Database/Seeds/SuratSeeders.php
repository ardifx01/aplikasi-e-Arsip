<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SuratSeeders extends Seeder
{
    public function run()
    {
        $data = [
            ['tipe' => 'suratmasuk', 'trackID' => 'SM/001/07/9/2025/xx', 'koresponden' => 'Sekretriat Kerjasama Kota Palembang', 'no_surat' => 'setdapemkot/001/07/9/2025', 'tgl_surat' => '2025/07/09', 'id_unit' => 1, 'id_jenis' => 1, 'id_sifat' => 1, 'id_klasifikasi' => 1, 'perihal' => 'Kerjasama Pemkot Palembang', 'keterangan' => 'Menindaklanjuti Kerjasama Terkait di Bidang Teknologi', 'file_surat' => NULL, 'created_dttm' => date('Y-m-d H:i:s')],
        ];
        $this->db->table('surat')->insertBatch($data);
    }
}
