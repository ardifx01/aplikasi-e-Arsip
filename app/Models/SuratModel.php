<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratModel extends Model
{
    protected $table            = 'surat';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'tipe', 'trackID', 'koresponden', 'no_surat', 'tgl_surat', 'id_unit', 'id_jenis', 'id_sifat', 'id_klasifikasi', 'id_sekretaris', 'id_kepala', 'status', 'perihal', 'keterangan', 'file_surat', 'status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

    public function getSuratMasuk()
    {
        $query = $this->db->table('surat s');
        $query->select('s.*, p.nama as nama_kepala');
        $query->join('pengguna p', 'p.id = s.id_kepala', 'left');
        $query->where('s.tipe', 'suratmasuk');
        $query->where('s.status', 'pengajuan');
        $query->where('s.status_cd', 'normal');
        $query->orderBy('s.id', 'DESC');
        return $query->get()->getResult();
    }

    public function getVerifikasiSuratMasuk()
    {
        $query = $this->db->table('surat s');
        $query->select('s.*, p.nama as nama_kepala');
        $query->join('pengguna p', 'p.id = s.id_sekretaris', 'left');
        $query->where('s.tipe', 'suratmasuk');
        $query->whereIn('s.status', ['proses', 'setuju']);
        $query->where('s.status_cd', 'normal');
        $query->orderBy('s.id', 'DESC');
        return $query->get()->getResult();
    }
    
    public function getSuratKeluar()
    {
        $query = $this->db->table('surat s');
        $query->select('s.*, p.nama as nama_kepala');
        $query->join('pengguna p', 'p.id = s.id_kepala', 'left');
        $query->where('s.tipe', 'suratkeluar');
        $query->where('s.status', 'pengajuan');
        $query->where('s.status_cd', 'normal');
        $query->orderBy('s.id', 'DESC');
        return $query->get()->getResult();
    }

    public function getVerifikasiSuratKeluar()
    {
        $query = $this->db->table('surat s');
        $query->select('s.*, p.nama as nama_kepala');
        $query->join('pengguna p', 'p.id = s.id_sekretaris', 'left');
        $query->where('s.tipe', 'suratkeluar');
        $query->whereIn('s.status', ['proses', 'setuju']);
        $query->where('s.status_cd', 'normal');
        $query->orderBy('s.id', 'DESC');
        return $query->get()->getResult();
    }
    public function cekNoSurat($no_surat)
    {
        $query = $this->db->table('surat');
        $query->select('*');
        $query->where('no_surat', $no_surat);
        $query->where('status_cd', 'normal');
        $return = $query->get();
        return $return->getResult();
    }
    public function insertData($data)
    {
        $cek = $this->cekNoSurat($data['no_surat']);
        if (count($cek) > 0) {
            $ret =  false;
        } else {
            $query = $this->db->table('surat');
            $ret =  $query->insert($data);
        }
        return $ret;
    }
    public function updateData($id, $data)
    {
        $cek = $this->db->table('surat')
            ->where('no_surat', $data['no_surat'])
            ->where('status_cd', 'normal')
            ->where('id !=', $id) // <<< abaikan record yang sedang diedit
            ->get()
            ->getResult();
        if (count($cek) > 0) {
            return false; // kode_jurusan sudah digunakan oleh record lain
        }
        // Update data
        return $this->db->table('surat')
            ->where('id', $id)
            ->update($data);
    }
    public function get_by_id($id)
    {
        return $this->db->table('surat')
            ->where('id', $id)
            ->where('status_cd', 'normal')
            ->get()
            ->getRowArray();
    }
    public function deleteSoft($id, $data)
    {
        $query = $this->db->table('surat');
        $query->where('id', $id);
        $query->set($data);
        return $query->update();
    }
}
