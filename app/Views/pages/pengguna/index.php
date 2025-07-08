<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-file-text"></i> Tabel <?= $title; ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item active"><a href="#"><?= $title; ?></a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <a class="btn btn-rounded btn-primary mb-3" href="javascript:void(0)" onclick="_tambahData()">Tambah Data</a>
                    <?= form_open() ?>
                    <table class="table table-hover table-bordered" id="viewTable">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No.</th>
                                <th class="text-center"> <?= $title; ?></th>
                                <th class="text-center" style="width: 50px;">Status</th>
                                <th class="text-center" style="width: 200px;">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Form Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="#" id="formInput" class="form-data">
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama" onchange="remove(id)">
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin: <span class="text-danger">*</span></label>
                            <select class="form-control select2" id="jenis_kelamin" name="jenis_kelamin" style="width: 100%;">
                                <option disabled selected>-- Pilih Jenis Kelamin --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Telepon: <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="telepon" name="telepon" placeholder="Masukkan nomor telepon" onchange="remove(id)">
                        </div>

                        <div class="form-group">
                            <label>Email: <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" onchange="remove(id)">
                        </div>

                        <div class="form-group">
                            <label>Username: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" onchange="remove(id)">
                        </div>

                        <div class="form-group">
                            <label>Level Akses: <span class="text-danger">*</span></label>
                            <select class="form-control select2" id="level" name="level" style="width: 100%;">
                                <option disabled selected>-- Pilih Level Akses --</option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Status User: <span class="text-danger">*</span></label>
                            <select class="form-control select2" id="status_user" name="status_user" style="width: 100%;">
                                <option disabled selected>-- Pilih Status User --</option>
                                <option value="active">Aktif</option>
                                <option value="deactive">Tidak Aktif</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Alamat: <span class="text-danger">*</span></label>
                            <textarea rows="3" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat lengkap"></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="_simpanData()">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->
<?= $this->endSection() ?>