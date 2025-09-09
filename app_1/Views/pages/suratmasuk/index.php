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
                    <?php if (in_array(session()->get('level'), ['admin', 'user'])) : ?>
                        <a class="btn btn-rounded btn-primary mb-3" href="javascript:void(0)" onclick="_tambahData()">Tambah Data</a>
                    <?php endif; ?>
                    <?= form_open() ?>
                    <table id="viewTable" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No.</th>
                                <th class="text-center"> <?= $title; ?></th>
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
<!-- Modal Surat Masuk -->
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Form Surat Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" id="formInput" class="form-data">
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="koresponden">Koresponden: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="koresponden" name="koresponden" placeholder="Masukkan koresponden" onchange="$('#'+this.id).removeClass('is-invalid')" value="<?= old('koresponden') ?>">
                                </div>
                                <div class="form-group">
                                    <label for="no_surat">Nomor Surat: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="no_surat" name="no_surat" placeholder="Masukkan nomor surat" onchange="$('#'+this.id).removeClass('is-invalid')" value="<?= old('no_surat') ?>">
                                </div>
                                <div class="form-group">
                                    <label for="tgl_surat">Tanggal Surat: <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tgl_surat" name="tgl_surat" value="<?= old('tgl_surat') ?>">
                                </div>
                                <div class="form-group">
                                    <label for="id_unit">Tujuan Unit Bagian: <span class="text-danger">*</span></label>
                                    <select class="form-control select2" id="id_unit" name="id_unit" style="width: 100%;">
                                        <option disabled selected>-- Pilih Unit Bagian --</option>
                                        <?php foreach ($unit as $u): ?>
                                            <option value="<?= $u->id ?>" <?= old('id_unit') == $u->id ? 'selected' : '' ?>>
                                                <?= esc($u->nama_unit) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_jenis">Nama Jenis Surat: <span class="text-danger">*</span></label>
                                    <select class="form-control select2" id="id_jenis" name="id_jenis" style="width: 100%;">
                                        <option disabled selected>-- Pilih Jenis Surat --</option>
                                        <?php foreach ($jenis as $j): ?>
                                            <option value="<?= $j->id ?>" <?= old('id_jenis') == $j->id ? 'selected' : '' ?>>
                                                <?= esc($j->nama_jenis) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_sifat">Nama Sifat Surat: <span class="text-danger">*</span></label>
                                    <select class="form-control select2" id="id_sifat" name="id_sifat" style="width: 100%;">
                                        <option disabled selected>-- Pilih Sifat Surat --</option>
                                        <?php foreach ($sifat as $s): ?>
                                            <option value="<?= $s->id ?>" <?= old('id_sifat') == $s->id ? 'selected' : '' ?>>
                                                <?= esc($s->nama_sifat) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_klasifikasi">Nama Klasifikasi Surat: <span class="text-danger">*</span></label>
                                    <select class="form-control select2" id="id_klasifikasi" name="id_klasifikasi" style="width: 100%;">
                                        <option disabled selected>-- Pilih Klasifikasi Surat --</option>
                                        <?php foreach ($klasifikasi as $k): ?>
                                            <option value="<?= $k->id ?>" <?= old('id_klasifikasi') == $k->id ? 'selected' : '' ?>>
                                                <?= esc($k->nama_klasifikasi) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_pengguna">Tujuan Disposisi: <span class="text-danger">*</span></label>
                                    <select class="form-control select2" id="id_sekretaris" name="id_sekretaris" style="width: 100%;">
                                        <option disabled selected>-- Pilih Disposisi Surat --</option>
                                        <?php foreach ($pengguna as $k): ?>
                                            <option value="<?= $k->id ?>" <?= old('id_pengguna') == $k->id ? 'selected' : '' ?>>
                                                <?= esc($k->nama) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="perihal">Perihal: <span class="text-danger">*</span></label>
                                    <textarea rows="3" class="form-control" id="perihal" name="perihal" placeholder="Masukkan Perihal" onchange="$('#perihal').removeClass('is-invalid')"><?= old('perihal') ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan: <span class="text-danger">*</span></label>
                                    <textarea rows="3" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan keterangan" onchange="$('#keterangan').removeClass('is-invalid')"><?= old('keterangan') ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="file_surat">File Surat <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="file_surat" name="file_surat" accept=".pdf,application/pdf">
                                            <label class="custom-file-label" for="file_surat">Pilih file .pdf</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="file-preview" style="display: none;">
                                        <label>File Sebelumnya:</label>
                                        <p><a href="#" id="file-link" target="_blank">Lihat File</a></p>
                                    </div>
                                </div>
                            </div>
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