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
        <li><a class="app-menu__item <?php if ($active == "dashboard") {echo "active"; } ?>" href="<?= base_url('/dashboard') ?>"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li class="treeview <?php if ($active == "pengguna") {echo "is-expanded"; } ?>"><a class="app-menu__item <?php if ($active == "pengguna") {echo "active"; } ?>" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Data Master</span></span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item <?php if ($active == "pengguna") {
                                                echo "active";
                                            } ?>" href="<?= base_url('/pengguna') ?>"><i class="icon fa fa-circle-o"></i>Data Pengguna</a></li>
                <li><a class="treeview-item" href="javascript:void(0)"><i class="icon fa fa-circle-o"></i>Data Unit</a></li>
                <li><a class="treeview-item" href="javascript:void(0)"><i class="icon fa fa-circle-o"></i>Data Jenis</a></li>
                <li><a class="treeview-item" href="javascript:void(0)"><i class="icon fa fa-circle-o"></i>Data Sifat</a></li>
                <li><a class="treeview-item" href="javascript:void(0)"><i class="icon fa fa-circle-o"></i>Data Klasifikasi</a></li>
            </ul>
        </li>
        <li><a class="app-menu__item" href="javascript:void(0)"><i class="app-menu__icon fa fa-envelope-o"></i><span class="app-menu__label">Surat Masuk</span></a></li>
        <li><a class="app-menu__item" href="javascript:void(0)"><i class="app-menu__icon fa fa fa-envelope"></i><span class="app-menu__label">Surat Keluar</span></a></li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-list-alt"></i><span class="app-menu__label">Laporan</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="javascript:void(0)"><i class="icon fa fa-circle-o"></i> Rekapitulasi Surat</a></li>
                <li><a class="treeview-item" href="javascript:void(0)"><i class="icon fa fa-circle-o"></i> Data Tables</a></li>
            </ul>
        </li>
    </ul>
</aside>