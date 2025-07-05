<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PenggunaSeeders extends Seeder
{
    public function run()
    {
        $data = [
            ['nama' => 'Administrator System', 'jenis_kelamin' => 'L', 'telepon' => '628 xxx-xxx-xxx', 'email' => 'binarykid1412@gmail.com', 'username' => 'admin', 'password' => sha1(md5('123456')), 'level' => 'admin', 'status_user' => 'active', 'alamat' => 'https://github/redhorivai', 'created_dttm' => date('Y-m-d H:i:s')],
        ];
        $this->db->table('pengguna')->insertBatch($data);
    }
}
