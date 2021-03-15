<!-- content -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- main content -->

    <div id="content">

        <div class="row mt-3 mb-4">
            <h2>Pengajuan KP</h2>
        </div>

        <div class="row mb-4">

            <div class="col-lg-9 mb-4">
                <form action="<?= site_url('pengajuan_kp') ?>" method="post">
                    <h6>Pengajuan KP</h6>
                    <div class="form-row">

                        <div class="col-lg-7">
                            <input type="text" name="nrp" placeholder="NRP" class="form-control my-3 p-4" value="<?= $mhs['nrp'] ?>" readonly required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="text" name="nama" placeholder="Name" class="form-control my-3 p-4" value="<?= $mhs['nama'] ?>" readonly required>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <input type="text" name="no_telp" placeholder="No. WhatsApp" class="form-control my-3 p-4" value="<?= $mhs['no_telp'] ?>" readonly required>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <select type="text" name="perusahaan" id="pers" placeholder="Nama Perusahaan" class="custom-select custom-select-lg" required>
                                <option value="" selected disabled>Pilih Perusahaan</option>
                                <?php foreach ($perusahaan as $p) { ?>
                                    <option value="<?= $p->id_perusahaan ?>"><?= $p->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- <script>
                            $(document).ready(function() {
                                $('#pers').select2();
                            });
                        </script> -->
                    <div class="form-row">
                        <div class="col-lg-7">
                            <textarea type="text" name="penugasan" placeholder="Penugasan KP" class="form-control my-3 p-4" required></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <!-- <input type="text" name="dosen_wali" placeholder="Wali Dosen" class="form-control my-3 p-4"> -->
                            <select type="text" name="dosen" id="dsn" placeholder="Nama Dosen" class="custom-select custom-select-lg">
                                <option value="" selected disabled>Pilih Dosen Wali</option>
                                <?php foreach ($dosen as $d) { ?>
                                    <option value="<?= $d->id_dosen ?>"><?= $d->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="col-lg-7">
                            <input type="date" name="tanggal" placeholder="Tanggal Pengajuan" class="form-control my-3 p-4" required>
                        </div> -->
                    <div class="form-row">
                        <div class="col-lg-7">
                            <button type="submit" class="btn1 mt-3 mb-5">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-3 text-align-left">
                <img class="img-fluid" style="width: 25rem;" src="assets/img/profile.svg" alt="">
            </div>
        </div>
    </div>

    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; IOS Developer 2021</span>
            </div>
        </div>
    </footer>

</div>