<!-- content -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- main content -->
    <div id="content">

        <div class="row mt-3 mb-4">
            <h2>Profil</h2>
        </div>

        <div class="row  mb-4">

            <div class="col-lg-12 justify-content-center mb-4">

                <h6>Data Diri</h6>

                <!-- <div class="form-row my-3 profile-pic-div">
                    <img src="assets/img/perfil.jpg" id="photo">
                    <input type="file" id="file">
                    <label for="file" id="uploadBtn">Choose Photo</label>
                </div> -->

                <div class="form-row">
                    <div class="col-lg-7">
                        <input type="text" name="nama" value="<?= $prof['nama'] ?>" class="form-control my-3 p-4" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-lg-7">
                        <input type="text" name="nrp" value="<?= $prof['nrp'] ?>" class="form-control my-3 p-4" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-lg-7">
                        <input type="text" name="email" value="<?= $prof['email'] ?>" class="form-control my-3 p-4" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-lg-7">
                        <input type="text" name="no_telp" value="<?= $prof['no_telp'] ?>" class="form-control my-3 p-4" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-lg-7">
                        <button type="button" data-toggle="modal" data-target="#modal_edit<?= $prof['id_mahasiswa']; ?>" class="btn-mhs btn btn-lg font-weight-bold btn-primary">
                            Edit
                        </button>
                        <!-- <a href="" data-toggle="modal" data-target="#modal_edit<?= $prof['id_mahasiswa']; ?>" class="btn-mhs btn btn-lg font-weight-bold btn-primary">Edit</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="sticky-footer bg-transparant">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; IOS Developer 2021</span>
        </div>
    </div>
</footer>
<div class="modal fade" id="modal_edit<?= $prof['id_mahasiswa'] ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Profil</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <form class="form-horizontal" method="post" action="<?= site_url('edit_profil'); ?>">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input name="nrp" id="nrp" class="form-control" value="<?= $prof['nrp']; ?>" type="hidden" readonly required>
                        <label class="control-label col-xs-3">E-mail</label>
                        <div class="col-xs-8">
                            <input name="email" id="email" class="form-control" value="<?= $prof['email']; ?>" type="text" required placeholder="e.g : massidiqfattah@mhs.itenas.ac.id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">No Telepon</label>
                        <div class="col-xs-8">
                            <input name="no_telp" id="no_telp" class="form-control" value="<?= $prof['no_telp']; ?>" type="text" required placeholder="e.g : 1251274231">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Masukan Password Baru</label>
                        <div class="col-xs-8" style="position: relative;">
                            <span class="fa fa-fw fa-eye field_icon toggle-new" toggle="#password_field" style="position: absolute; right: 8px; top:10px; cursor: pointer;"></span>
                            <input id="newpass" name="newpass" class="form-control" type="password" onkeyup="check();" value="<?= $prof['password']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-8" style="position: relative;">
                            <label class="control-label col-xs-3">Masukan Confirm Password</label>
                            <span class="fa fa-fw fa-eye field_icon toggle-confirm" toggle="#password_field" style="position: absolute; right: 8px; top:40px; cursor: pointer;"></span>
                            <input id="confirm_pass" name="confirm_pass" class="form-control" type="password" onkeyup="check();" value="<?= $prof['password']; ?>" required>
                            <p id="match" class="invalid"><i class="fas fa-circle" aria-hidden="true"></i><b>Matching Password</b></p>
                            <p id="length" class="invalid"><i class="fas fa-circle" aria-hidden="true"></i>Minimum <b>6 characters</b></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="mb-2 btn btn-primary mr-2"><i class="fa fa-save"></i> Save Changes</button>
                        <button class="mb-2 btn btn-outline-danger mr-2" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    </div>
            </form>
        </div>
    </div>
</div>

</div>