<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<main class="app-content">
    <div class="row user">
        <div class="col-md-12">
            <div class="profile">
                <div class="info text-center">
                    <?php
                    $namaLengkap  = session()->get('nama') ?? 'Pengguna';
                    $jenisKelamin = session()->get('jenis_kelamin') ?? 'L';
                    $level        = session()->get('level') ?? 'pengguna';

                    // Tentukan gambar berdasarkan jenis kelamin
                    $genderImg = ($jenisKelamin === 'P' || strtolower($jenisKelamin) === 'perempuan') ? 'female.png' : 'male.png';
                    $foto = base_url('assets/images/users/' . $genderImg);
                    ?>
                    <img class="user-img rounded-circle" src="<?= esc($foto) ?>" alt="Foto Pengguna" style="width: 100px; height: 100px;">
                    <h4><?= esc($namaLengkap) ?></h4>
                    <p><?= esc(ucwords($level)) ?></p>
                </div>
                <div class="cover-image"></div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="tile p-0">
                <ul class="nav flex-column nav-tabs user-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#user-settings" data-toggle="tab">Pengaturan Akun</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="user-settings">
                    <div class="tile user-settings">
                        <h4 class="line-head">Informasi Akun</h4>
                        <form action="<?= base_url('akun/updatePassword') ?>" method="post">
                            <?= csrf_field() ?>
                            <?php
                            $jk = ($jenisKelamin == 'L') ? 'Laki-laki' : 'Perempuan';
                            ?>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label>Nama Lengkap</label>
                                    <input class="form-control" type="text" value="<?= esc(session()->get('nama')) ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label>Username</label>
                                    <input class="form-control" type="text" value="<?= esc(session()->get('username')) ?>" readonly>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label>Jenis Kelamin</label>
                                    <input class="form-control" type="text" value="<?= esc($jk) ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label>Email</label>
                                    <input class="form-control" type="email" value="<?= esc(session()->get('email')) ?>" readonly>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label>Telepon</label>
                                    <input class="form-control" type="text" value="<?= esc(session()->get('telepon')) ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label>Alamat</label>
                                    <input class="form-control" type="text" value="<?= esc(session()->get('alamat')) ?>" readonly>
                                </div>
                            </div>

                            <hr>
                            <h4 class="line-head mt-4">Ubah Password</h4>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label>Password Baru</label>
                                    <input class="form-control" type="password" name="password_baru" required autocomplete="off">
                                </div>
                                <div class="col-md-6">
                                    <label>Konfirmasi Password</label>
                                    <input class="form-control" type="password" name="konfirmasi_password" required autocomplete="off">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-fw fa-lg fa-check-circle"></i> Simpan Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> <!-- tab-pane -->
            </div> <!-- tab-content -->
        </div>
    </div>
</main>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Notifikasi -->
<?php if (session()->getFlashdata('success')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '<?= esc(session()->getFlashdata('success')) ?>',
            confirmButtonColor: '#3085d6'
        });
    </script>
<?php elseif (session()->getFlashdata('error')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '<?= esc(session()->getFlashdata('error')) ?>',
            confirmButtonColor: '#d33'
        });
    </script>
<?php endif; ?>

<?= $this->endSection() ?>