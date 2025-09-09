<?php

namespace App\Controllers;

use App\Models\SuratModel;
use App\Models\UnitModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LaporanController extends BaseController
{
    protected $m_surat;
    protected $m_unit;
    protected $session;
    public function __construct()
    {
        $this->m_surat = new SuratModel();
        $this->m_unit = new UnitModel();
        $this->session = \Config\Services::session();
        $this->session->start();
    }
    public function suratMasuk()
    {
        if (!session()->get('username')) {
            session()->setFlashdata('error', 'Anda belum login! Silakan login terlebih dahulu.');
            return redirect()->to(base_url('/login'));
        }

        $unitList = $this->m_unit->findAll();

        return view('pages/laporan/surat_masuk', [
            'title' => 'Data Laporan Surat Masuk',
            'unitList' => $unitList,
            'active'   => 'laporan_suratmasuk', // untuk highlight menu sidebar
        ]);
    }
    public function getSuratMasukByUnit()
    {
        if ($this->request->isAJAX()) {
            $id_unit = $this->request->getVar('id_unit');

            $data = $this->m_surat->where('tipe', 'suratmasuk')
                ->where('status_cd', 'normal')
                ->where('id_unit', $id_unit)
                ->findAll();

            return $this->response->setJSON(['data' => $data]);
        }
    }
    public function suratKeluar()
    {
        if (!session()->get('username')) {
            session()->setFlashdata('error', 'Anda belum login! Silakan login terlebih dahulu.');
            return redirect()->to(base_url('/login'));
        }

        $unitList = $this->m_unit->findAll();

        return view('pages/laporan/surat_keluar', [
            'title' => 'Data Laporan Surat Keluar',
            'unitList' => $unitList,
            'active'   => 'laporan_suratkeluar', // untuk highlight menu sidebar
        ]);
    }
    public function getSuratKeluarByUnit()
    {
        if ($this->request->isAJAX()) {
            $id_unit = $this->request->getVar('id_unit');

            $data = $this->m_surat->where('tipe', 'suratkeluar')
                ->where('status_cd', 'normal')
                ->where('id_unit', $id_unit)
                ->findAll();

            return $this->response->setJSON(['data' => $data]);
        }
    }
}
