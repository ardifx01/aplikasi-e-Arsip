<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
    }
    public function index()
    {
        $mPengguna = new \App\Models\PenggunaModel();
        $mSurat = new \App\Models\SuratModel();

        $jumlahPengguna = $mPengguna->where('status_cd', 'normal')->countAllResults();
        $jumlahSuratMasuk = $mSurat->where('status_cd', 'normal')->where('tipe', 'suratmasuk')->countAllResults();
        $jumlahSuratKeluar = $mSurat->where('status_cd', 'normal')->where('tipe', 'suratkeluar')->countAllResults();

        $data = [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'jumlahPengguna' => $jumlahPengguna,
            'jumlahSuratMasuk' => $jumlahSuratMasuk,
            'jumlahSuratKeluar' => $jumlahSuratKeluar,
        ];
        return view('pages/dashboard/index', $data);
    }
}
