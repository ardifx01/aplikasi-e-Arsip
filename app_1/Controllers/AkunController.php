<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PenggunaModel;


class AkunController extends BaseController
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
        // Cek apakah user sudah login
        if (!session()->get('username')) {
            session()->setFlashdata('error', 'Anda belum login!');
            return redirect()->to(base_url('/login'));
        }

        $user = $this->m_pengguna->getUserById(session()->get('id'));

        // Data untuk dikirim ke view
        $data = [
            'active' => 'akun', // untuk penanda menu aktif
            'title'  => 'Profil Pengguna',
            'user' => $user // jika pakai model user
        ];

        return view('pages/akun/index', $data);
    }
    public function updatePassword()
    {
        if (!session()->get('id')) {
            return redirect()->to('/login');
        }

        $passwordBaru = $this->request->getPost('password_baru');
        $konfirmasi   = $this->request->getPost('konfirmasi_password');

        if ($passwordBaru !== $konfirmasi) {
            return redirect()->back()->with('error', 'Password dan konfirmasi tidak cocok.');
        }

        if (strlen($passwordBaru) < 6) {
            return redirect()->back()->with('error', 'Password minimal 6 karakter.');
        }

        $id = session()->get('id');

        // Gunakan password_hash agar lebih aman
        $hashedPassword = sha1(md5($passwordBaru));

        $data = [
            'password'       => $hashedPassword,
            'updated_user'   => session()->get('id'),
            'updated_dttm'   => date('Y-m-d H:i:s'),
        ];

        $update = $this->m_pengguna->updatePasswordOnly($id, $data);

        if ($update) {
            return redirect()->to('/akun')->with('success', 'Password berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui password.');
        }
    }
}
