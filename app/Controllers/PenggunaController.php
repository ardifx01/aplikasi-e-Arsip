<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PenggunaModel;

class PenggunaController extends BaseController
{
    protected $m_pengguna;
    protected $session;

    public function __construct()
    {
        $this->m_pengguna = new PenggunaModel();
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
            'title' => 'Data Pengguna',
            'menuactive' => 'is-expanded',
            'active' => 'pengguna'
        ];

        return view('pages/pengguna/index', $data);
    }
    public function getData()
    {
        $res = $this->m_pengguna->getPengguna();
        $nomor = 1;
        $output = [];

        if (count($res) > 0) {
            foreach ($res as $key) {
                // Gambar avatar berdasarkan jenis kelamin
                $jk = ($key->jenis_kelamin == 'L')
                    ? "<img src='" . base_url('assets/images/users/male.png') . "' alt='avatar' class='rounded-circle' style='width:32px; height:32px; object-fit:cover;'>"
                    : "<img src='" . base_url('assets/images/users/female.png') . "' alt='avatar' class='rounded-circle' style='width:32px; height:32px; object-fit:cover;'>";

                // Status user dan tombol aksi aktif/non-aktif
                if ($key->status_user == 'active') {
                    $status = "<span class='badge badge-success'><i class='fa fa-circle'></i> Aktif</span>";
                } else {
                    $status = "<span class='badge badge-danger'><i class='fa fa-circle'></i> Tidak Aktif</span>";
                }

                // Tambahkan baris data ke dalam output
                $output[] = [
                    'col1' => "<div class='text-center'>" . $nomor++ . "</div>",
                    'col2' => "<div class='d-flex align-items-center'>
                                $jk
                                <div style='margin-left: 12px;'>
                                    <div class='fw-bold'>$key->nama</div>
                                    <small class='text-muted'>$key->username</small>
                                </div>
                               </div>",
                    'col3' => "<div>$status</div>",
                    'col4' => "<div class='text-center d-flex justify-content-center gap-1'>
                                <button type='button' class='btn btn-sm btn-warning rounded-circle d-flex align-items-center justify-content-center' style='width:32px; height:32px;' title='Reset' onclick='_btnReset(\"$key->id\",\"$key->nama\")'><i class='fa fa-key text-white' style='width: 8px;'></i>
                                </button>
                                <button type='button' class='btn btn-sm btn-danger rounded-circle d-flex align-items-center justify-content-center' style='width:32px; height:32px;' title='Hapus' onclick='_btnDelete(\"$key->id\",\"$key->nama\")'>
                                    <i class='fa fa-trash text-white' style='width: 8px;'></i>
                                </button>
                                <button type='button' class='btn btn-sm btn-info rounded-circle d-flex align-items-center justify-content-center' style='width:32px; height:32px;' title='Edit' onclick='_btnEdit(\"$key->id\",\"$key->nama\")'>
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
            $nama                    = ucwords($this->request->getVar('nama'));
            $jenis_kelamin           = $this->request->getVar('jenis_kelamin');
            $telepon                 = $this->request->getVar('telepon');
            $email                   = $this->request->getVar('email');
            $username                = strtolower($this->request->getVar('username'));
            $level                   = $this->request->getVar('level');
            $status_user             = $this->request->getVar('status_user');
            $alamat                  = $this->request->getVar('alamat');
            $data = [
                'nama'                    => $nama,
                'jenis_kelamin'            => $jenis_kelamin,
                'telepon'                => $telepon,
                'email'                    => $email,
                'username'                => $username,
                'level'                    => $level,
                'status_user'                    => $status_user,
                'alamat'                => $alamat,
                'password'                => sha1(md5('123456')),
                'created_user'            => session()->get('id'),
                'created_dttm'            => date('Y-m-d H:i:s'),
            ];
            $insert    = $this->m_pengguna->insertData($data);
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
            $data = (array) $this->m_pengguna->get_by_id($id);
            // print_r($data);
            echo json_encode($data);
        } else {
            exit('Request Error');
        }
    }
    public function update_data()
    {
        if ($this->request->isAJAX()) {
            $id                 = $this->request->getVar('id');
            $nama               = ucwords($this->request->getVar('nama'));
            $jenis_kelamin      = $this->request->getVar('jenis_kelamin');
            $telepon            = $this->request->getVar('telepon');
            $email              = $this->request->getVar('email');
            $username           = strtolower($this->request->getVar('username'));
            $level              = $this->request->getVar('level');
            $status_user        = $this->request->getVar('status_user');
            $alamat             = $this->request->getVar('alamat');
            $data = [
                'nama'                => $nama,
                'jenis_kelamin'       => $jenis_kelamin,
                'telepon'             => $telepon,
                'email'               => $email,
                'username'            => $username,
                'level'               => $level,
                'status_user'         => $status_user,
                'alamat'              => $alamat,
                'updated_user'        => session()->get('id'),
                'updated_dttm'        => date('Y-m-d H:i:s'),
            ];
            $insert    = $this->m_pengguna->updateData($id, $data);
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
            $this->m_pengguna->deleteSoft($id, $data);
            $msg = ['sukses' => 'Data user telah dihapus.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function reset_data()
    {
        if ($this->request->isAJAX()) {
            $id        = $this->request->getPost('id');
            $data    = [
                'password'           => sha1(md5('123456')),
                'created_user'       => session()->get('id'),
                'created_dttm'       => date('Y-m-d H:i:s'),
            ];
            $this->m_pengguna->update($id, $data);
            $msg = ['sukses' => 'Data user telah dihapus.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
}
