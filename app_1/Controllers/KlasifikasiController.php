<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KlasifikasiModel;
use CodeIgniter\HTTP\ResponseInterface;

class KlasifikasiController extends BaseController
{
    protected $m_klasifikasi;
    protected $session;

    public function __construct()
    {
        $this->m_klasifikasi = new KlasifikasiModel();
        $this->session = \Config\Services::session();
        $this->session->start();
    }
    public function index()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/login'));
        }
        $data = [
            'title' => 'Data Klasifikasi',
            'menuactive' => 'is-expanded',
            'active' => 'klasifikasi'
        ];
        return view('pages/klasifikasi/index', $data);
    }
    public function getData()
    {
        $res = $this->m_klasifikasi->getKlasifikasi();
        $nomor = 1;
        $output = [];

        if (count($res) > 0) {
            foreach ($res as $key) {
                $output[] = [
                    'col1' => "<div class='text-center'>" . $nomor++ . "</div>",
                    'col2' => "<div class='d-flex align-items-center'>
                                <div style='margin-left: 12px;'>
                                    <div class='fw-bold'>$key->nama_klasifikasi</div>
                                    <small class='text-muted'>$key->kode_klasifikasi</small>
                                    <div class='fw-bold'>$key->keterangan</div>
                                </div>
                               </div>",
                    'col3' => "<div class='text-center d-flex justify-content-center gap-1'>
                                <button type='button' class='btn btn-sm btn-danger rounded-circle d-flex align-items-center justify-content-center' style='width:32px; height:32px;' title='Hapus' onclick='_btnDelete(\"$key->id\",\"$key->nama_klasifikasi\")'>
                                    <i class='fa fa-trash text-white' style='width: 8px;'></i>
                                </button>
                                <button type='button' class='btn btn-sm btn-info rounded-circle d-flex align-items-center justify-content-center' style='width:32px; height:32px;' title='Edit' onclick='_btnEdit(\"$key->id\",\"$key->nama_klasifikasi\")'>
                                    <i class='fa fa-edit text-white' style='width: 8px;'></i>
                                </button>
                                </div>"
                ];
            }
        }
        return $this->response->setJSON(['data' => $output]);
    }
    public function insert_data()
    {
        if ($this->request->isAJAX()) {
            $kode_klasifikasi                    = $this->request->getVar('kode_klasifikasi');
            $nama_klasifikasi                    = ucwords($this->request->getVar('nama_klasifikasi'));
            $keterangan                   = ucwords($this->request->getVar('keterangan'));
            $data = [
                'kode_klasifikasi'               => $kode_klasifikasi,
                'nama_klasifikasi'               => $nama_klasifikasi,
                'keterangan'              => $keterangan,
                'created_user'            => session()->get('id'),
                'created_dttm'            => date('Y-m-d H:i:s'),
            ];
            $insert    = $this->m_klasifikasi->insertData($data);
            if ($insert == TRUE) {
                echo json_encode(['sukses' => TRUE]);
            } else {
                echo json_encode(['gagal' => TRUE]);
            }
        } else {
            exit('Request Error');
        }
    }
    public function get_edit()
    {
        if ($this->request->isAJAX()) {
            $id        = $this->request->getVar('id');
            $data = (array) $this->m_klasifikasi->get_by_id($id);
            // print_r($data);
            echo json_encode($data);
        } else {
            exit('Request Error');
        }
    }
    public function update_data()
    {
        if ($this->request->isAJAX()) {
            $id                           = $this->request->getVar('id');
            $kode_klasifikasi             = $this->request->getVar('kode_klasifikasi');
            $nama_klasifikasi             = ucwords($this->request->getVar('nama_klasifikasi'));
            $keterangan                   = ucwords(($this->request->getVar('keterangan')));
            $data = [
                'kode_klasifikasi'        => $kode_klasifikasi,
                'nama_klasifikasi'        => $nama_klasifikasi,
                'keterangan'              => $keterangan,
                'updated_user'            => session()->get('id'),
                'updated_dttm'            => date('Y-m-d H:i:s'),
            ];
            $insert    = $this->m_klasifikasi->updateData($id, $data);
            if ($insert == TRUE) {
                echo json_encode(['sukses' => TRUE]);
            } else {
                echo json_encode(['gagal' => TRUE]);
            }
        } else {
            exit('Request Error');
        }
    }
    public function del_data()
    {
        if ($this->request->isAJAX()) {
            $id      = $this->request->getPost('id');
            $data    = [
                'status_cd'      => 'nullified',
                'nullified_user' => session()->get('id'),
                'nullified_dttm' => date('Y-m-d H:i:s'),
            ];
            $this->m_klasifikasi->deleteSoft($id, $data);
            $msg = ['sukses' => 'Data klasifikasi telah dihapus.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
}
