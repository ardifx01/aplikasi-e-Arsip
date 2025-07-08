<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisModel extends Model
{
    protected $table            = 'jenis';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'kode_jenis', 'nama_jenis', 'keterangan', 'status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

    public function getjenis()
    {
        $query = $this->db->table('jenis');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->orderBy('id', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
    public function cekKode($kode_jenis)
    {
        $query = $this->db->table('jenis');
        $query->select('*');
        $query->where('kode_jenis', $kode_jenis);
        $query->where('status_cd', 'normal');
        $return = $query->get();
        return $return->getResult();
    }
    public function insertData($data)
    {
        $cek = $this->cekKode($data['kode_jenis']);
        if (count($cek) > 0) {
            $ret =  false;
        } else {
            $query = $this->db->table('jenis');
            $ret =  $query->insert($data);
        }
        return $ret;
    }
    public function updateData($id, $data)
    {
        $cek = $this->db->table('jenis')
            ->where('kode_jenis', $data['kode_jenis'])
            ->where('status_cd', 'normal')
            ->where('id !=', $id) // <<< abaikan record yang sedang diedit
            ->get()
            ->getResult();
        if (count($cek) > 0) {
            return false; // kode_jurusan sudah digunakan oleh record lain
        }

        // Update data
        return $this->db->table('jenis')
            ->where('id', $id)
            ->update($data);
    }
    public function get_by_id($id)
    {
        return $this->db->table('jenis')
            ->select('*')
            ->where('id', $id)
            ->get()
            ->getRowArray(); // ✅ langsung mengembalikan array, bukan stdClass
    }
    public function deleteSoft($id, $data)
    {
        $query = $this->db->table('jenis');
        $query->where('id', $id);
        $query->set($data);
        return $query->update();
    }
}
