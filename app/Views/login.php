<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Vali Admin</title>

    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/main.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/plugins/sweetalert2.min.css">
</head>

<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>

    <section class="login-content">
        <div class="logo">
            <h1>Vali</h1>
        </div>
        <div class="login-box">
            <form class="login-form" id="login_form" method="POST">
                <?= csrf_field(); ?>
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i> SIGN IN</h3>
                <div class="form-group">
                    <label class="control-label">USERNAME</label>
                    <input class="form-control" type="text" placeholder="Masukkan username" id="username" name="username" required autofocus>
                </div>
                <div class="form-group">
                    <label class="control-label">PASSWORD</label>
                    <input class="form-control" type="password" placeholder="Masukkan password" id="password" name="password" required>
                </div>
                <div class="form-group btn-container">
                    <button id="btnLogin" class="btn btn-primary btn-block">
                        <i class="fa fa-sign-in fa-lg fa-fw"></i> Login
                    </button>
                </div>
            </form>
        </div>
    </section>

    <?php if (session()->getFlashdata('sukses')) : ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Logout Berhasil',
                    text: '<?= session()->getFlashdata('sukses'); ?>',
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        </script>
    <?php endif; ?>

    <!-- Javascript -->
    <script src="<?= base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/main.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/pace.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/sweetalert2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#login_form').submit(function(e) {
                e.preventDefault();

                let username = $('#username').val().trim();
                let password = $('#password').val().trim();

                if (username === "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Username kosong!',
                        text: 'Silakan masukkan username Anda',
                    });
                    $('#username').focus();
                    return;
                }

                if (password === "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Password kosong!',
                        text: 'Silakan masukkan kata sandi Anda',
                    });
                    $('#password').focus();
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('login/get_login'); ?>",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    beforeSend: function() {
                        $('#btnLogin').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memproses...');
                    },
                    success: function(response) {
                        if (response.status === true) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Login',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.href = "<?= base_url('/dashboard'); ?>";
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Login Gagal',
                                text: response.message || "Username atau password salah."
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Gagal menghubungi server. Silakan coba lagi.'
                        });
                    },
                    complete: function() {
                        $('#btnLogin').prop('disabled', false).html('<i class="fa fa-sign-in fa-lg fa-fw"></i> Login');
                    }
                });
            });
        });
    </script>
</body>

</html>
