<?php

namespace App\Models;

use CodeIgniter\Model;

class SifatModel extends Model
{
    protected $table            = 'sifat';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'kode_sifat', 'nama_sifat', 'keterangan', 'status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

    public function getSifat()
    {
        $query = $this->db->table('sifat');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->orderBy('id', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
    public function cekKode($kode_sifat)
    {
        $query = $this->db->table('sifat');
        $query->select('*');
        $query->where('kode_sifat', $kode_sifat);
        $query->where('status_cd', 'normal');
        $return = $query->get();
        return $return->getResult();
    }
    public function insertData($data)
    {
        $cek = $this->cekKode($data['kode_sifat']);
        if (count($cek) > 0) {
            $ret =  false;
        } else {
            $query = $this->db->table('sifat');
            $ret =  $query->insert($data);
        }
        return $ret;
    }
    public function updateData($id, $data)
    {
        $cek = $this->db->table('sifat')
            ->where('kode_sifat', $data['kode_sifat'])
            ->where('status_cd', 'normal')
            ->where('id !=', $id) // <<< abaikan record yang sedang diedit
            ->get()
            ->getResult();
        if (count($cek) > 0) {
            return false; // kode_jurusan sudah digunakan oleh record lain
        }

        // Update data
        return $this->db->table('sifat')
            ->where('id', $id)
            ->update($data);
    }
    public function get_by_id($id)
    {
        return $this->db->table('sifat')
            ->select('*')
            ->where('id', $id)
            ->get()
            ->getRowArray(); // ✅ langsung mengembalikan array, bukan stdClass
    }
    public function deleteSoft($id, $data)
    {
        $query = $this->db->table('sifat');
        $query->where('id', $id);
        $query->set($data);
        return $query->update();
    }
}
