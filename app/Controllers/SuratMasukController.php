<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SuratModel;
use App\Models\UnitModel;
use App\Models\JenisModel;
use App\Models\SifatModel;
use App\Models\KlasifikasiModel;
use App\Models\PenggunaModel;
use CodeIgniter\HTTP\ResponseInterface;

class SuratMasukController extends BaseController
{
    protected $m_surat;
    protected $m_unit;
    protected $m_jenis;
    protected $m_sifat;
    protected $m_klasifikasi;
    protected $m_pengguna;
    protected $db;
    protected $session;

    public function __construct()
    {
        $this->m_surat = new SuratModel();
        $this->m_unit = new UnitModel();
        $this->m_jenis = new JenisModel();
        $this->m_sifat = new SifatModel();
        $this->m_klasifikasi = new KlasifikasiModel();
        $this->m_pengguna = new PenggunaModel();
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
        $this->session->start();
    }
    // fungsi getData Pengajuan Surat Masuk
    public function index()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/login'));
        }
        $res1 = $this->m_unit->getUnit();
        $res2 = $this->m_jenis->getJenis();
        $res3 = $this->m_sifat->getSifat();
        $res4 = $this->m_klasifikasi->getKlasifikasi();
        $res5 = $this->m_pengguna->getSekretaris();
        $data = [
            'title' => 'Data Surat Masuk',
            'menuactive' => 'is-expanded',
            'active' => 'pengajuansuratmasuk',
            'unit' => $res1,
            'jenis' => $res2,
            'sifat' => $res3,
            'klasifikasi' => $res4,
            'pengguna' => $res5
        ];
        return view('pages/suratmasuk/index', $data);
    }
    public function getData()
    {
        $res = $this->m_surat->getSuratMasuk();
        $nomor = 1;
        $output = [];
        $level = session()->get('level');

        if (count($res) > 0) {
            foreach ($res as $key) {
                $linkPreview = base_url('uploads/surat/' . $key->file_surat);

                $btnVerifikasi = '';
                $btnEdit = '';
                $btnDelete = '';

                // Tombol Verifikasi hanya untuk sekretaris dan jika surat belum ada id_kepala
                if ($level === 'verifikasi' && !$key->id_kepala) {
                    $btnVerifikasi = "
                    <button type='button' class='btn btn-sm btn-success rounded-circle d-flex align-items-center justify-content-center'
                        style='width:32px; height:32px;' title='Verifikasi'
                        onclick='_btnVerifikasi(\"{$key->id}\")'>
                        <i class='fa fa-check text-white'></i>
                    </button>";
                }

                // Tombol Edit dan Hapus untuk level tertentu
                if (in_array($level, ['admin', 'user'])) {
                    $btnEdit = "
                    <button type='button' class='btn btn-sm btn-info rounded-circle' title='Edit'
                        onclick='_btnEdit(\"{$key->id}\", \"{$key->no_surat}\")'>
                        <i class='fa fa-edit text-white'></i>
                    </button>";

                    $btnDelete = "
                    <button type='button' class='btn btn-sm btn-danger rounded-circle' title='Hapus'
                        onclick='_btnDelete(\"{$key->id}\", \"{$key->no_surat}\")'>
                        <i class='fa fa-trash text-white'></i>
                    </button>";
                }

                // Untuk level lain, tampilkan badge info
                if (!in_array($level, ['admin', 'verifikasi'])) {
                    $btnVerifikasi = "<span class='badge bg-secondary'>Pengajuan</span>";
                }

                $output[] = [
                    'DT_RowId' => 'row_' . $key->id,
                    'col1' => "<div class='text-center'>" . ($nomor++) . "</div>",
                    'col2' => "
                    <div class='d-flex align-items-start'>
                        <div style='margin-left: 12px;'>
                            <div class='fw-bold'>
                                <a href='javascript:void(0)' onclick='_btnDetail(\"{$key->id}\")'>
                                    {$key->koresponden} | {$key->no_surat}
                                </a>
                            </div>
                            <small class='text-muted'>{$key->perihal} | {$key->tgl_surat}</small><br>
                            <div class='fw-bold'>{$key->keterangan}</div>
                            <div class='mt-2'>
                                <a href='{$linkPreview}' target='_blank' class='badge badge-primary'>
                                    <i class='fa fa-file-pdf-o'></i> Lihat PDF
                                </a>
                            </div>
                        </div>
                    </div>",
                    'col3' => "
                    <div class='text-center d-flex justify-content-center gap-1'>
                        {$btnDelete}
                        {$btnEdit}
                        {$btnVerifikasi}
                    </div>"
                ];
            }
        }

        return $this->response->setJSON(['data' => $output]);
    }
    public function verifikasiSurat()
    {
        $idSurat = $this->request->getPost('id_surat');

        // Ambil kepala yang aktif
        $kepala = $this->db->table('pengguna')->where([
            'level' => 'kepala',
            'status_cd' => 'normal'
        ])->get()->getFirstRow();

        if (!$kepala) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Tidak ada kepala yang tersedia.'
            ]);
        }

        // Update surat
        $this->m_surat->update($idSurat, [
            'id_kepala' => $kepala->id,
            'status' => 'proses',
            'updated_user' => session()->get('id'),
            'updated_dttm' => date('Y-m-d H:i:s')
        ]);

        return $this->response->setJSON([
            'status' => 'ok',
            'message' => 'Surat berhasil diverifikasi dan diteruskan ke kepala.'
        ]);
    }
    // // fungsi getData Verfikasi Surat Masuk
    public function verifikasiView()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/login'));
        }

        $data = [
            'title' => 'Verifikasi Surat Masuk',
            'menuactive' => 'is-expanded',
            'active' => 'verifikasisuratmasuk',
            'unit' => $this->m_unit->getUnit(),
            'jenis' => $this->m_jenis->getJenis(),
            'sifat' => $this->m_sifat->getSifat(),
            'klasifikasi' => $this->m_klasifikasi->getKlasifikasi(),
            'pengguna' => $this->m_pengguna->getPengguna()
        ];
        return view('pages/suratmasuk/index', $data);
    }

    public function getDataVerifikasi()
    {
        $res = $this->m_surat->getVerifikasiSuratMasuk(); // Ambil dari model
        $output = [];
        $nomor = 1;
        $level = session()->get('level');

        foreach ($res as $key) {
            $linkPreview = base_url('uploads/surat/' . $key->file_surat);
            $btnSetujui = '';

            if ($key->status === 'setuju') {
                $btnSetujui = "<span class='badge bg-primary'>Disetujui</span>";
            } elseif ($level === 'kepala' && $key->status === 'proses') {
                $btnSetujui = "
                <button type='button' class='btn btn-sm btn-success rounded-circle d-flex align-items-center justify-content-center'
                    style='width:32px; height:32px;' title='Setujui'
                    onclick='_btnSetujui(\"{$key->id}\")'>
                    <i class='fa fa-check text-white'></i>
                </button>";
            } else {
                $btnSetujui = "<span class='badge bg-success'>Menunggu Persetujuan</span>";
            }

            $output[] = [
                'DT_RowId' => 'row_' . $key->id,
                'col1' => "<div class='text-center'>" . ($nomor++) . "</div>",
                'col2' => "
                <div class='d-flex align-items-start'>
                    <div style='margin-left: 12px;'>
                        <div class='fw-bold'>
                            <a href='javascript:void(0)' onclick='_btnDetail(\"{$key->id}\")'>
                                {$key->koresponden} | {$key->no_surat}
                            </a>
                        </div>
                        <small class='text-muted'>{$key->perihal} | {$key->tgl_surat}</small><br>
                        <div class='fw-bold'>{$key->keterangan}</div>
                        <div class='mt-2'>
                            <a href='{$linkPreview}' target='_blank' class='badge badge-primary'>
                                <i class='fa fa-file-pdf-o'></i> Lihat PDF
                            </a>
                        </div>
                    </div>
                </div>",
                'col3' => "
                <div class='text-center d-flex justify-content-center gap-1'>
                    {$btnSetujui}
                </div>"
            ];
        }

        return $this->response->setJSON(['data' => $output]);
    }
    public function setujuiSurat()
    {
        $idSurat = $this->request->getPost('id_surat');

        if (session()->get('level') !== 'kepala') {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Akses ditolak.'
            ]);
        }

        $this->db->table('surat')
            ->where('id', $idSurat)
            ->update([
                'status' => 'setuju',
                'updated_user' => session()->get('id'),
                'updated_dttm' => date('Y-m-d H:i:s')
            ]);

        return $this->response->setJSON([
            'status' => 'ok',
            'message' => 'Surat telah disetujui.'
        ]);
    }
    public function insert_data()
    {
        if ($this->request->isAJAX()) {
            $file_surat = $this->request->getFile('file_surat');

            // Validasi file: hanya PDF
            if (!$file_surat->isValid() || $file_surat->getClientMimeType() !== 'application/pdf') {
                return $this->response->setJSON(['gagal' => TRUE, 'pesan' => 'File harus berupa PDF yang valid.']);
            }

            // Proses upload jika file valid
            $newName = $file_surat->getRandomName();
            $file_surat->move('uploads/surat', $newName);

            $prefix     = 'SM'; // Untuk surat masuk
            $tanggal    = date('Ymd'); // Format tanggal sekarang
            $randomNum  = str_pad(random_int(1, 9999), 4, '0', STR_PAD_LEFT); // 4 digit angka acak
            $trackID    = $prefix . $tanggal . $randomNum;

            $data = [
                'tipe'            => 'suratmasuk',
                'trackID'         => $trackID,
                'koresponden'     => ucwords($this->request->getVar('koresponden')),
                'no_surat'        => $this->request->getVar('no_surat'),
                'tgl_surat'       => $this->request->getVar('tgl_surat'),
                'id_unit'         => $this->request->getVar('id_jenis'),
                'id_jenis'        => $this->request->getVar('id_jenis'),
                'id_sifat'        => $this->request->getVar('id_sifat'),
                'id_klasifikasi'  => $this->request->getVar('id_klasifikasi'),
                'id_sekretaris'   => $this->request->getVar('id_sekretaris'),
                'status'          => 'pengajuan',
                'perihal'         => ucwords($this->request->getVar('perihal')),
                'keterangan'      => ucwords($this->request->getVar('keterangan')),
                'file_surat'      => $newName,
                'status_cd'       => 'normal',
                'created_user'    => session()->get('id'),
                'created_dttm'    => date('Y-m-d H:i:s'),
            ];

            $insert = $this->m_surat->insertData($data);
            if ($insert) {
                return $this->response->setJSON(['sukses' => TRUE]);
            } else {
                return $this->response->setJSON(['gagal' => TRUE, 'pesan' => 'Gagal menyimpan data.']);
            }
        } else {
            exit('Request Error');
        }
    }
    public function get_edit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = $this->m_surat->get_by_id($id);

            if ($data) {
                return $this->response->setJSON($data);
            } else {
                return $this->response->setJSON(['error' => 'Data tidak ditemukan.']);
            }
        } else {
            exit('Request Error');
        }
    }
    public function update_data()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setBody('Metode tidak diizinkan.');
        }

        $id = $this->request->getVar('id');
        if (!$id || !is_numeric($id)) {
            return $this->response->setJSON(['gagal' => TRUE, 'pesan' => 'ID tidak valid.']);
        }

        // Ambil data lama dari model (gunakan fungsi yang sama seperti get_edit)
        $existing = $this->m_surat->get_by_id($id);
        if (!$existing) {
            return $this->response->setJSON(['gagal' => TRUE, 'pesan' => 'Data tidak ditemukan.']);
        }

        // Handle file
        $file_surat = $this->request->getFile('file_surat');
        $newName = $existing['file_surat']; // default gunakan file lama

        if ($file_surat && $file_surat->isValid()) {
            if ($file_surat->getClientMimeType() !== 'application/pdf') {
                return $this->response->setJSON(['gagal' => TRUE, 'pesan' => 'File harus berupa PDF yang valid.']);
            }

            // Hapus file lama jika ada
            if ($existing['file_surat'] && file_exists('uploads/surat/' . $existing['file_surat'])) {
                unlink('uploads/surat/' . $existing['file_surat']);
            }

            // Simpan file baru
            $newName = $file_surat->getRandomName();
            $file_surat->move('uploads/surat', $newName);
        }

        // Siapkan data update
        $data = [
            'koresponden'     => ucwords($this->request->getVar('koresponden')),
            'no_surat'        => $this->request->getVar('no_surat'),
            'tgl_surat'       => $this->request->getVar('tgl_surat'),
            'id_unit'         => $this->request->getVar('id_unit'),
            'id_jenis'        => $this->request->getVar('id_jenis'),
            'id_sifat'        => $this->request->getVar('id_sifat'),
            'id_klasifikasi'  => $this->request->getVar('id_klasifikasi'),
            'perihal'         => ucwords($this->request->getVar('perihal')),
            'keterangan'      => ucwords($this->request->getVar('keterangan')),
            'file_surat'      => $newName,
            'updated_user'    => session()->get('id'),
            'updated_dttm'    => date('Y-m-d H:i:s'),
        ];

        // Jalankan update
        $update = $this->m_surat->updateData($id, $data);
        if ($update) {
            return $this->response->setJSON(['sukses' => TRUE]);
        } else {
            return $this->response->setJSON(['gagal' => TRUE, 'pesan' => 'Gagal mengupdate data.']);
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
            $this->m_surat->deleteSoft($id, $data);
            $msg = ['sukses' => 'Data surat masuk telah dihapus.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }






}
