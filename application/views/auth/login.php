<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Kerja Praktik ITENAS</title>

    <link href="<?= base_url() ?>assets/css/login-styles.css" rel="stylesheet">
    <script src="<?= base_url('assets/vendor/jquery/jquery-3.5.1.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/vendor/sweetalert/sweetalert2.all.min.js'); ?>"></script>
</head>

<body>

    <section class="Form my-4 mx-5">
        <div class="container">
            <div class="flash-data-username" data-flashdata="<?= $this->session->flashdata('error_uname') ?>"></div>
            <div class="flash-data-password" data-flashdata="<?= $this->session->flashdata('error_pass') ?>"></div>
            <div class="row no-gutters">
                <div class="col-lg-7 px-5 pt-5">
                    <h1 class="logo"> <img src="assets/img/logo(1).png" alt=""> </h1>

                    <h4>Sistem Kerja Praktik ITENAS</h4>

                    <form method="POST" action="<?= site_url('auth'); ?>">

                        <div class="form-row">
                            <div class="col-lg-7">
                                <input type="text" name="username" placeholder="Username" class="form-control my-3 p-4" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-lg-7">
                                <input type="password" name="password" placeholder="******" class="form-control my-3 p-4" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-lg-7">
                                <button type="submit" class="btn1 mt-3 mb-5">Login</button>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="col-lg-5">
                    <img src="assets/img/itenas.jpeg" class="img-fluid" alt="">
                </div>
            </div>

            <footer class="sticky-footer bg-transparent">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; IOS Developer 2021</span>
                    </div>
                </div>
            </footer>
        </div>

    </section>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
    <script>
        $(document).ready(function() {
            let flashdatauname = $('.flash-data-username').data('flashdata');
            let flashdatapass = $('.flash-data-password').data('flashdata');
            if (flashdatauname) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Your Username Incorrect!',
                    type: 'error'
                })
            }

            if (flashdatapass) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Your Password Incorrect!',
                    type: 'error'
                })
            }
        })
    </script>
</body>

</html>