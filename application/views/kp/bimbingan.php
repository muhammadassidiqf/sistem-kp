<!-- content -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- main content -->
    <div id="content">

        <div class="row mt-3 mb-4">
            <h2>Dosen</h2>
        </div>

        <div class="row mb-4">

            <div class="card shadow mb-4">
                <div class="card-header h6 mb-0 py-3 font-weight-bold text-uppercase">
                    <h6 class="m-0 font-weight-bold">Form Pembimbingan Pelaksanaan KP</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NRP</th>
                                    <th>Nama</th>
                                    <th>Perusahaan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                <?php foreach ($kp as $k) { ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $k->nrp ?></td>
                                        <td><?= $k->nama ?></td>
                                        <td><?= $k->nama_per ?></td>
                                        <td class="text-center">
                                            <a href="<?= site_url('kp/edit_bimbingan/' . $k->id_kp) ?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    <?php $no++ ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12">
                            <a href="" class="btn btn-secondary btn-md">Tambah Bimbingan</a>
                        </div>
                    </div>

                </div>

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