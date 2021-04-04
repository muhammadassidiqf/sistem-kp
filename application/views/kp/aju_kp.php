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
                    <label for="nrp" class="col-sm-2 col-form-label">NRP</label>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="hidden" name="id_mhs" placeholder="NRP" class="form-control my-0 p-4" value="<?= $mhs['id_mahasiswa'] ?>" readonly required>
                            <input type="text" name="nrp" placeholder="NRP" class="form-control my-0 p-4" value="<?= $mhs['nrp'] ?>" readonly required>
                        </div>
                    </div>
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="text" name="nama" placeholder="Name" class="form-control my-0 p-4" value="<?= $mhs['nama'] ?>" readonly required>
                        </div>
                    </div>
                    <label for="no_telp" class="col-sm-2 col-form-label">No Handphone</label>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="text" name="no_telp" placeholder="No. WhatsApp" class="form-control my-0 p-4" value="<?= $mhs['no_telp'] ?>" readonly required>
                        </div>
                    </div>
                    <label for="nama" class="col-sm-4 col-form-label">Nama Dosen Wali</label>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <select name="dosen" placeholder="Nama Dosen" class="form-control" readonly>
                                <option value="<?= $mhs['dosen_wali'] ?>" selected><?= $mhs['dosenwali'] ?></option>
                            </select>
                        </div>
                    </div>
                    <!-- <script>
                        $(document).ready(function() {
                            $('#dsn').select2();
                        });
                    </script> -->
                    <label for="nama_per" class="col-sm-4 col-form-label">Nama Perusahaan</label>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <select type="text" name="perusahaan" id="pers" placeholder="Nama Perusahaan" class="form control custom-select custom-select-lg my-0 p-4" required>
                                <option value="" selected disabled>Pilih Perusahaan</option>
                                <?php foreach ($perusahaan as $p) { ?>
                                    <option value="<?= $p->id_perusahaan ?>"><?= $p->nama ?></option>
                                <?php } ?>
                            </select>
                            <a href="<?= site_url('perusahaan') ?>" class="col-lg-12 btn btn-primary btn-sm my-2">Tambah Perusahaan&nbsp;<i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function() {
                            $('#pers').select2();
                        });
                    </script>
                    <label for="penugasan" class="col-sm-2 col-form-label">Penugasan KP</label>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <textarea type="text" name="penugasan" placeholder="Penugasan KP" class="form-control my-0 p-4" required></textarea>
                        </div>
                    </div>
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