<header class="app-header"><a class="app-header__logo" href="javascript:void(0)">e-Arsip Inspektorat</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
        <li class="app-search">
            <input class="app-search__input" type="search" placeholder="Search">
            <button class="app-search__button"><i class="fa fa-search"></i></button>
        </li>
        <!--Notification Menu-->
        <li class="dropdown">
            <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications">
                <i class="fa fa-bell-o fa-lg"></i>
                <span class="badge badge-danger" id="notif-count" style="display:none;position:absolute;top:8px;right:6px;font-size:10px;"></span>
            </a>
            <ul class="app-notification dropdown-menu dropdown-menu-right" id="notif-list">
                <li class="app-notification__title" id="notif-title">Memuat notifikasi...</li>
                <div class="app-notification__content" id="notif-content"></div>
                <li class="app-notification__footer"><a href="#">Lihat semua notifikasi.</a></li>
            </ul>
        </li>
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li><a class="dropdown-item" href="<?= base_url('/akun') ?>"><i class="fa fa-user fa-lg"></i> Profile</a></li>
                <li><a class="dropdown-item" href="<?= base_url('login/logout'); ?>"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
            </ul>
        </li>
    </ul>
</header>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Cek notifikasi surat masuk
        $.get("<?= base_url('pengajuansuratmasuk/getNotifications') ?>", function(res1) {
            // Cek notifikasi surat keluar
            $.get("<?= base_url('pengajuansuratkeluar/getNotifications') ?>", function(res2) {
                let notifCount = (res1.count || 0) + (res2.count || 0);
                let notifList = [];
                if (res1.notifications) notifList = notifList.concat(res1.notifications);
                if (res2.notifications) notifList = notifList.concat(res2.notifications);

                if (notifCount > 0) {
                    $('#notif-count').text(notifCount).show();
                    $('#notif-title').text(`Anda memiliki ${notifCount} notifikasi baru.`);
                    let html = '';
                    notifList.forEach(function(n) {
                        html += `<li>
                            <a class="app-notification__item" href="${n.url}">
                                <span class="app-notification__icon">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x text-${n.color}"></i>
                                        <i class="fa ${n.icon} fa-stack-1x fa-inverse"></i>
                                    </span>
                                </span>
                                <div>
                                    <p class="app-notification__message">${n.message}</p>
                                    <p class="app-notification__meta">${n.meta}</p>
                                </div>
                            </a>
                        </li>`;
                    });
                    $('#notif-content').html(html);
                } else {
                    $('#notif-count').hide();
                    $('#notif-title').text('Tidak ada notifikasi baru.');
                    $('#notif-content').html('');
                }
            }, 'json');
        }, 'json');
    });
</script>