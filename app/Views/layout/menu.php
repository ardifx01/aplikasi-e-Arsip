<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <?php
    $jenisKelamin = session()->get('jenis_kelamin');
    $avatar = ($jenisKelamin === 'L')
        ? base_url('assets/images/users/male.png')
        : base_url('assets/images/users/female.png');
    ?>

    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= $avatar; ?>" alt="User Image" width="48" height="48">
        <div>
            <p class="app-sidebar__user-name"><?= session()->get('username') ?></p>
            <p class="app-sidebar__user-designation"><?= session()->get('nama') ?></p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item <?php if ($active == "dashboard") {
                                            echo "active";
                                        } ?>" href="<?= base_url('/dashboard') ?>"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <?php if (session()->get('level') == 'admin') { ?>
            <li class="treeview <?php if ($active == "pengguna" || $active == "unit" || $active == "jenis" || $active == "sifat" || $active == "klasifikasi") {
                                    echo "is-expanded";
                                } ?>"><a class="app-menu__item <?php if ($active == "pengguna" || $active == "unit" || $active == "jenis" || $active == "sifat" || $active == "klasifikasi") {
                                                                    echo "active";
                                                                } ?>" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Data Master</span></span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item <?= ($active == 'pengguna') ? 'active' : '' ?>" href="<?= base_url('/pengguna') ?>">
                            <i class="icon fa fa-circle-o"></i>Data Pengguna
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item <?= ($active == 'unit') ? 'active' : '' ?>" href="<?= base_url('/unit') ?>">
                            <i class="icon fa fa-circle-o"></i>Data Unit
                        </a>
                    </li>
                    <li><a class="treeview-item <?= ($active == 'jenis') ? 'active' : '' ?>" href="<?= base_url('/jenis') ?>"><i class="icon fa fa-circle-o"></i>Data Jenis</a></li>
                    <li><a class="treeview-item <?= ($active == 'sifat') ? 'active' : '' ?>" href="<?= base_url('/sifat') ?>"><i class="icon fa fa-circle-o"></i>Data Sifat</a></li>
                    <li><a class="treeview-item <?= ($active == 'klasifikasi') ? 'active' : '' ?>" href="<?= base_url('/klasifikasi') ?>"><i class="icon fa fa-circle-o"></i>Data Klasifikasi</a></li>
                </ul>
            </li>
        <?php } ?>
        <li class="treeview <?php if ($active == "pengajuansuratmasuk" || $active == "verifikasisuratmasuk") {
                                echo "is-expanded";
                            } ?>"><a class="app-menu__item <?php if ($active == "pengajuansuratmasuk" || $active == "verifikasisuratmasuk") {
                                                                echo "active";
                                                            } ?>" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-envelope-o"></i><span class="app-menu__label">Surat Masuk</span></span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item <?= ($active == 'pengajuansuratmasuk') ? 'active' : '' ?>" href="<?= base_url('/pengajuansuratmasuk') ?>">
                        <i class="icon fa fa-circle-o"></i>Pengajuan Surat
                    </a>
                </li>
                <li>
                    <a class="treeview-item <?= ($active == 'verifikasisuratmasuk') ? 'active' : '' ?>" href="<?= base_url('/verifikasisuratmasuk') ?>">
                        <i class="icon fa fa-circle-o"></i>Verikasi Surat
                    </a>
                </li>
            </ul>
        </li>
        <li class="treeview <?php if ($active == "pengajuansuratkeluar" || $active == "verifikasisuratkeluar") {
                                echo "is-expanded";
                            } ?>"><a class="app-menu__item <?php if ($active == "pengajuansuratkeluar" || $active == "verifikasisuratkeluar") {
                                                                echo "active";
                                                            } ?>" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-envelope"></i><span class="app-menu__label">Surat Keluar</span></span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item <?= ($active == 'pengajuansuratkeluar') ? 'active' : '' ?>" href="<?= base_url('/pengajuansuratkeluar') ?>">
                        <i class="icon fa fa-circle-o"></i>Pengajuan Surat
                    </a>
                </li>
                <li>
                    <a class="treeview-item <?= ($active == 'verifikasisuratkeluar') ? 'active' : '' ?>" href="<?= base_url('/verifikasisuratkeluar') ?>">
                        <i class="icon fa fa-circle-o"></i>Verikasi Surat
                    </a>
                </li>
            </ul>
        </li>
        <li class="treeview <?= in_array($active, ['laporan_suratmasuk', 'laporan_suratkeluar']) ? 'is-expanded' : '' ?>">
            <a class="app-menu__item <?= in_array($active, ['laporan_suratmasuk', 'laporan_suratkeluar']) ? 'active' : '' ?>" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-list-alt"></i>
                <span class="app-menu__label">Laporan</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item <?= ($active == 'laporan_suratmasuk') ? 'active' : '' ?>" href="<?= base_url('laporan/suratmasuk') ?>">
                        <i class="icon fa fa-circle-o"></i> Surat Masuk
                    </a>
                </li>
                <li>
                    <a class="treeview-item <?= ($active == 'laporan_suratkeluar') ? 'active' : '' ?>" href="<?= base_url('laporan/suratkeluar') ?>">
                        <i class="icon fa fa-circle-o"></i> Surat Keluar
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</aside>