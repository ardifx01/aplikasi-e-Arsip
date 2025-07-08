<?php

namespace App\Models;

use CodeIgniter\Model;

class UnitModel extends Model
{
    protected $table            = 'unit';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'kode_unit', 'nama_unit', 'keterangan', 'status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

    public function getUnit()
    {
        $query = $this->db->table('unit');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->orderBy('id', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
    public function cekKode($kode_unit)
    {
        $query = $this->db->table('unit');
        $query->select('*');
        $query->where('kode_unit', $kode_unit);
        $query->where('status_cd', 'normal');
        $return = $query->get();
        return $return->getResult();
    }
    public function insertData($data)
    {
        $cek = $this->cekKode($data['kode_unit']);
        if (count($cek) > 0) {
            $ret =  false;
        } else {
            $query = $this->db->table('unit');
            $ret =  $query->insert($data);
        }
        return $ret;
    }
    public function updateData($id, $data)
    {
        $cek = $this->db->table('unit')
            ->where('kode_unit', $data['kode_unit'])
            ->where('status_cd', 'normal')
            ->where('id !=', $id) // <<< abaikan record yang sedang diedit
            ->get()
            ->getResult();
        if (count($cek) > 0) {
            return false; // kode_jurusan sudah digunakan oleh record lain
        }

        // Update data
        return $this->db->table('unit')
            ->where('id', $id)
            ->update($data);
    }
    public function get_by_id($id)
    {
        return $this->db->table('unit')
            ->select('*')
            ->where('id', $id)
            ->get()
            ->getRowArray(); // ✅ langsung mengembalikan array, bukan stdClass
    }
    public function deleteSoft($id, $data)
    {
        $query = $this->db->table('unit');
        $query->where('id', $id);
        $query->set($data);
        return $query->update();
    }
}
