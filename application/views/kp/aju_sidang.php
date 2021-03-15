<div id="content-wrapper" class="d-flex flex-column">

    <!-- main content -->
    <div id="content">

        <div class="row mt-3 mb-4">
            <h2>Pengajuan Sidang</h2>
        </div>

        <div class="row mb-4">

            <div class="col-lg-9 mb-4">

                <h6>Pengajuan Sidang</h6>
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

                <div class="form-row">
                    <div class="col-lg-7">
                        <input type="text" name="perusahaan" value="<?= $kp['nama_per'] ?>" class="form-control my-3 p-4" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-lg-7">
                        <textarea type="text" name="penugasan" class="form-control my-3 p-4" readonly><?= $kp['penugasan'] ?></textarea>
                    </div>
                </div>


                <div class="form-row">
                    <div class="col-lg-7">
                        <input type="text" name="dosen_pemb" value="<?= $kp['nama_pemb'] ?>" class="form-control my-3 p-4" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-lg-7">
                        <input type="text" name="judul" placeholder="Judul" class="form-control my-3 p-4">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-lg-7">
                        <button type="button" class="btn1 mt-3 mb-5">Submit</button>
                    </div>
                </div>

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