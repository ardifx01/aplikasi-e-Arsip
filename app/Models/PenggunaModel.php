<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table            = 'pengguna';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'nama', 'jenis_kelamin', 'telepon', 'email', 'username', 'password', 'level', 'status_user', 'alamat', 'status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

    public function getPengguna()
    {
        $query = $this->db->table('pengguna');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->orderBy('id', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
    public function cekUsername($username)
    {
        $query = $this->db->table('pengguna');
        $query->select('*');
        $query->where('username', $username);
        $query->where('status_cd', 'normal');
        $return = $query->get();
        return $return->getResult();
    }

    public function insertData($data)
    {
        $cek = $this->cekUsername($data['username']);
        if (count($cek) > 0) {
            $ret =  false;
        } else {
            $query = $this->db->table('pengguna');
            $ret =  $query->insert($data);
        }
        return $ret;
    }
    public function deleteSoft($id, $data)
    {
        $query = $this->db->table('pengguna');
        $query->where('id', $id);
        $query->set($data);
        return $query->update();
    }
    public function updateData($id, $data)
    {
        $cek = $this->db->table('pengguna')
            ->where('username', $data['username'])
            ->where('status_cd', 'normal')
            ->where('id !=', $id)
            ->get()
            ->getResult();
        if (count($cek) > 0) {
            return false;
        }

        // Update data
        return $this->db->table('pengguna')
            ->where('id', $id)
            ->update($data);
    }
    public function get_by_id($id)
    {
        return $this->db->table('pengguna')
            ->select('*')
            ->where('id', $id)
            ->get()
            ->getRowArray(); // ✅ langsung mengembalikan array, bukan stdClass
    }
    public function getUserById($id)
    {
        return $this->where('id', $id)->first();
    }
    public function updatePasswordOnly($id, $data)
    {
        return $this->db->table('pengguna')
            ->where('id', $id)
            ->update($data);
    }
    public function getSekretaris()
    {
        $query = $this->db->table('pengguna');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->where('level', 'verifikasi'); // ← filter berdasarkan level
        $query->orderBy('id', 'DESC');
        return $query->get()->getResult();
    }
}
