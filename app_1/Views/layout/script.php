<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="<?= base_url(); ?>assets/js/plugins/pace.min.js"></script>
<!-- Page specific javascripts-->
<script type="text/javascript" src="<?= base_url(); ?>assets/js/plugins/chart.js"></script>
<!-- datatable -->
<script type="text/javascript" src="<?= base_url(); ?>assets/js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/plugins/select2.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/plugins/sweetalert2.min.js"></script>

<?php
if ($active == 'pengguna') {
  echo view('pages/pengguna/js');
} elseif ($active == 'unit') {
  echo view('pages/unit/js');
} elseif ($active == 'jenis') {
  echo view('pages/jenis/js');
} elseif ($active == 'sifat') {
  echo view('pages/sifat/js');
} elseif ($active == 'klasifikasi') {
  echo view('pages/klasifikasi/js');
} elseif ($active == 'pengajuansuratmasuk' || $active == 'verifikasisuratmasuk') {
  echo view('pages/suratmasuk/js');
} elseif ($active == 'pengajuansuratkeluar' || $active == 'verifikasisuratkeluar') {
  echo view('pages/suratkeluar/js');
} elseif ($active == 'laporan_suratmasuk' || $active == 'laporan_suratkeluar') {
  echo view('pages/laporan/js');
}
?>