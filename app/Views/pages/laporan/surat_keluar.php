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
                    <form id="filterForm">
                        <div class="form-group">
                            <label for="id_unit">Filter Unit:</label>
                            <select class="form-control" id="id_unit" name="id_unit" required>
                                <option value="" disabled selected>-- Pilih Unit --</option>
                                <?php foreach ($unitList as $unit): ?>
                                    <option value="<?= $unit['id'] ?>"><?= esc($unit['nama_unit']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Tampilkan</button>
                    </form>
                    <hr>
                    <table id="tableSuratKeluar" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Surat</th>
                                <th>Koresponden</th>
                                <th>Tanggal</th>
                                <th>Perihal</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection() ?>