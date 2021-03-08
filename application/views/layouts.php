<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css' rel='stylesheet'>

    <!-- ===== CSS ===== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/jquery-ui-1.12.1/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/select2-bootstrap4-theme/dist/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/styles.css">

    <script src="<?= base_url('assets/vendor/jquery/jquery-3.5.1.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/DataTables/datatables.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/select2/dist/js/select2.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/vendor/sweetalert/sweetalert2.all.min.js'); ?>"></script>
    <title>Sistem KP ITENAS</title>
</head>

<body id="body-pd">

    <div id="wrapper">

        <!-- header -->
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>

            <h4>Sistem Kerja Praktik ITENAS</h4>

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
                        <?php if ($user['role'] == 'Mahasiswa') { ?>
                            <li class="nav__item dropdown">
                                <a class="nav__link dropdown__link">
                                    <i class='bx bx-file nav__icon'></i>
                                    <span class="nav__name">Pengajuan</span>
                                    <i class='bx bx-chevron-down dropdown__icon'></i>
                                </a>
                                <ul class="dropdown__menu">
                                    <li class="dropdown__item"><a href="<?= site_url('pengajuan') ?>" style="margin-left: -10px;" class="nav__link"><i class="fas fa-briefcase"></i>Pengajuan
                                            KP</a></li>
                                    <li class="dropdown__item"><a href="<?= site_url('pengajuan_sidang') ?>" style="margin-left: -10px;" class="nav__link"><i class="fas fa-clipboard-check"></i>Pengajuan
                                            Sidang</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if ($user['role'] == 'Mahasiswa') { ?>
                            <a href="<?= site_url('bimbingan') ?>" class="nav__link">
                                <i class='bx bx-detail  nav__icon'></i>
                                <span class="nav__name">Bimbingan</span>
                            </a>
                        <?php } ?>
                        <a href="<?= site_url('perusahaan') ?>" class="nav__link">
                            <i class='bx bx-buildings nav__icon'></i>
                            <span class="nav__name">Perusahaan</span>
                        </a>
                        <?php if ($user['role'] == 'Mahasiswa') { ?>
                            <a href="<?= site_url('sidang') ?>" class="nav__link">
                                <i class="far fa-list-alt nav__icon"></i>
                                <span class="nav__name">Sidang</span>
                            </a>
                        <?php } ?>
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
    <!--===== MAIN JS =====-->
    <script src="<?= base_url() ?>assets/js/main.js"></script>
</body>

</html>