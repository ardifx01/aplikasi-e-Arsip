<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= base_url(); ?>assets/images/users/male.png" alt="User Image" width="48" height="48">
        <div>
            <p class="app-sidebar__user-name">admin</p>
            <p class="app-sidebar__user-designation">Administrator System</p>
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
        <li><a class="app-menu__item <?= ($active == 'suratmasuk') ? 'active' : '' ?>" href="<?= base_url('/suratmasuk') ?>"><i class="app-menu__icon fa fa-envelope-o"></i><span class="app-menu__label">Surat Masuk</span></a></li>
        <li><a class="app-menu__item <?= ($active == 'suratkeluar') ? 'active' : '' ?>" href="<?= base_url('/suratkeluar') ?>"><i class="app-menu__icon fa fa fa-envelope"></i><span class="app-menu__label">Surat Keluar</span></a></li>
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