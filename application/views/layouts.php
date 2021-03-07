<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <!-- ===== CSS ===== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/styles.css">

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
                <img src="assets/img/perfil.jpg" alt="">
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
                        <li class="nav__item dropdown">
                            <a class="nav__link dropdown__link">
                                <i class='bx bx-file nav__icon'></i>
                                <span class="nav__name">Pengajuan</span>
                                <i class='bx bx-chevron-down dropdown__icon'></i>
                            </a>


                            <ul class="dropdown__menu">
                                <li class="dropdown__item"><a href="<?= site_url('pengajuan') ?>" class="nav__link">Pengajuan
                                        KP</a></li>
                                <li class="dropdown__item"><a href="<?= site_url('pengajuan_sidang') ?>" class="nav__link">Pengajuan
                                        Sidang</a></li>
                            </ul>
                        </li>

                        <a href="<?= site_url('bimbingan') ?>" class="nav__link">
                            <i class='bx bx-building nav__icon'></i>
                            <span class="nav__name">Bimbingan</span>
                        </a>

                        <a href="<?= site_url('perusahaan') ?>" class="nav__link">
                            <i class='bx bx-buildings nav__icon'></i>
                            <span class="nav__name">Perusahaan</span>
                        </a>

                        <a href="<?= site_url('sidang') ?>" class="nav__link">
                            <i class='bx bx-detail  nav__icon'></i>
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
    <!--===== MAIN JS =====-->
    <script src="<?= base_url() ?>assets/js/main.js"></script>
</body>

</html>