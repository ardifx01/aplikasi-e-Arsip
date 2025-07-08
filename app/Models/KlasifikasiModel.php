<?php

namespace App\Models;

use CodeIgniter\Model;

class KlasifikasiModel extends Model
{
    protected $table            = 'klasifikasi';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'kode_klasifikasi', 'nama_klasifikasi', 'keterangan', 'status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

    public function getKlasifikasi()
    {
        $query = $this->db->table('klasifikasi');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->orderBy('id', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
    public function cekKode($kode_klasifikasi)
    {
        $query = $this->db->table('klasifikasi');
        $query->select('*');
        $query->where('kode_klasifikasi', $kode_klasifikasi);
        $query->where('status_cd', 'normal');
        $return = $query->get();
        return $return->getResult();
    }
    public function insertData($data)
    {
        $cek = $this->cekKode($data['kode_klasifikasi']);
        if (count($cek) > 0) {
            $ret =  false;
        } else {
            $query = $this->db->table('klasifikasi');
            $ret =  $query->insert($data);
        }
        return $ret;
    }
    public function updateData($id, $data)
    {
        $cek = $this->db->table('klasifikasi')
            ->where('kode_klasifikasi', $data['kode_klasifikasi'])
            ->where('status_cd', 'normal')
            ->where('id !=', $id) // <<< abaikan record yang sedang diedit
            ->get()
            ->getResult();
        if (count($cek) > 0) {
            return false; // kode_jurusan sudah digunakan oleh record lain
        }

        // Update data
        return $this->db->table('klasifikasi')
            ->where('id', $id)
            ->update($data);
    }
    public function get_by_id($id)
    {
        return $this->db->table('klasifikasi')
            ->select('*')
            ->where('id', $id)
            ->get()
            ->getRowArray(); // ✅ langsung mengembalikan array, bukan stdClass
    }
    public function deleteSoft($id, $data)
    {
        $query = $this->db->table('klasifikasi');
        $query->where('id', $id);
        $query->set($data);
        return $query->update();
    }
}
