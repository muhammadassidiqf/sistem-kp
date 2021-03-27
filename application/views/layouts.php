<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css' rel='stylesheet'>

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/jquery-ui-1.12.1/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/select2-bootstrap4-theme/dist/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/styles.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="<?= base_url('assets/vendor/jquery/jquery-3.5.1.min.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script> -->
    <script src="<?= base_url('assets/vendor/DataTables/datatables.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/select2/dist/js/select2.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/vendor/sweetalert/sweetalert2.all.min.js'); ?>"></script>
    <title>Sistem KP ITENAS</title>
</head>
<style>
    .valid {
        color: green;
        margin-bottom: auto;
    }

    .valid:before {
        position: relative;
        left: -35px;
    }

    /* Add a red text color and an "x" icon when the requirements are wrong */
    .invalid {
        color: red;
        margin-bottom: auto;
    }

    .invalid:before {
        position: relative;
        left: -35px;
    }

    .fa-circle {
        font-size: 6px;
    }

    .fa-check {
        color: green;
    }
</style>

<body id="body-pd">

    <div id="wrapper">

        <!-- header -->
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>

            <span style="text-align: center;">
                <h4>Sistem Kerja Praktik ITENAS</h4>
            </span>
            <div class="header__img">
                <img src="assets/img/programmer.svg" alt="">
            </div>
        </header>

        <!-- sidebar -->
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="#" class="nav__logo">
                        <!-- <i class='bx bx-layer nav__logo-icon'></i> -->
                        <img class="nav__logo-icon" src="<?= base_url() ?>assets/img/logoitenas2.png" style="width: 30px;height: 25px;">
                        <span class="nav__logo-name">Kerja Praktik</span>
                    </a>

                    <div class="nav__list">
                        <a href="<?= site_url('dashboard') ?>" class="nav__link">
                            <i class='bx bx-grid-alt nav__icon'></i>
                            <span class="nav__name">Dashboard</span>
                        </a>

                        <a href="<?= site_url('profil') ?>" class="nav__link">
                            <i class='bx bx-user nav__icon'></i>
                            <span class="nav__name">Profil</span>
                        </a>
                        <a href="<?= site_url('masuk') ?>" class="nav__link">
                            <i class="fas fa-sign-in-alt"></i>
                            <span class="nav__name">Kotak Masuk</span>
                        </a>
                        <?php if ($user['role'] == 'Mahasiswa') { ?>
                            <li class="nav__item dropdown">
                                <a class="nav__link dropdown__link">
                                    <i class='bx bx-file nav__icon'></i>
                                    <span class="nav__name">Pengajuan</span>
                                    <i class='bx bx-chevron-down dropdown__icon'></i>
                                </a>
                                <ul class="dropdown__menu">
                                    <?php if ($num_kp < 1) { ?>
                                        <li class="dropdown__item"><a href="<?= site_url('pengajuan') ?>" style="margin-left: -10px;" class="nav__link"><i class="fas fa-briefcase"></i>Pengajuan
                                                KP</a></li>
                                    <?php } ?>
                                    <?php if ($num_kp <= 1) { ?>
                                        <li class="dropdown__item"><a href="<?= site_url('pengajuan_sidang') ?>" style="margin-left: -10px;" class="nav__link"><i class="fas fa-clipboard-check"></i>Pengajuan
                                                Sidang</a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                        <a href="<?= site_url('bimbingan') ?>" class="nav__link">
                            <i class='bx bx-detail  nav__icon'></i>
                            <span class="nav__name">Bimbingan</span>
                        </a>
                        <a href="<?= site_url('perusahaan') ?>" class="nav__link">
                            <i class='bx bx-buildings nav__icon'></i>
                            <span class="nav__name">Perusahaan</span>
                        </a>
                        <a href="<?= site_url('sidang') ?>" class="nav__link">
                            <i class="far fa-list-alt nav__icon"></i>
                            <span class="nav__name">Sidang</span>
                        </a>
                    </div>
                </div>

                <a href="<?= site_url('logout') ?>" class="nav__link">
                    <i class='bx bx-log-out nav__icon'></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>
        <?= $contents ?>
    </div>
    <div class="modal" id="modal_kp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 50px;overflow:scroll;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
            </div>
        </div>
    </div>
    <script>
        jQuery(document).ready(function($) {
            $('#modal_kp').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                var modal = $(this);
                modal.find('.modal-body').load(button.data("remote"));
                modal.find('.modal-title').html(button.data("title"));
            });
        });
        $(document).on('click', '.toggle-new', function() {

            $(this).toggleClass("fa-eye fa-eye-slash");

            var input = $("#newpass");
            input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
        });
        $(document).on('click', '.toggle-confirm', function() {

            $(this).toggleClass("fa-eye fa-eye-slash");

            var input = $("#confirm_pass");
            input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
        });

        function check() {
            var match = document.getElementById("match");
            var match_i = document.querySelector('.invalid i');
            if (document.getElementById('newpass').value ==
                document.getElementById('confirm_pass').value) {
                match.classList.remove("invalid");
                match.classList.add("valid");
                match_i.classList.remove("fa-circle");
                match_i.classList.add("fa-check");
            } else {
                match.classList.remove("valid");
                match.classList.add("invalid");
                match_i.classList.add("fa-circle");
                match_i.classList.remove("fa-check");
            }
            var length = document.getElementById("length");
            var length_i = document.querySelector('.invalid i');
            if (document.getElementById('newpass').value.length >= 6 &&
                document.getElementById('confirm_pass').value.length >= 6) {
                length.classList.remove("invalid");
                length.classList.add("valid");
                length_i.classList.remove("fa-circle");
                length_i.classList.add("fa-check");
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
                length_i.classList.add("fa-circle");
                length_i.classList.remove("fa-check");
            }
        }
    </script>
    <!--===== MAIN JS =====-->
    <script src="<?= base_url() ?>assets/js/main.js"></script>
</body>

</html>