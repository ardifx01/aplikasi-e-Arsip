<script src="<?= base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
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
}
?>