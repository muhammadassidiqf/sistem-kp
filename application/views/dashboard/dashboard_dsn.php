<!-- content -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- main content -->
    <div id="content">

        <div class="row mt-3 mb-4">
            <h2>Dashboard</h2>
        </div>

        <div class="row mb-4">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2">
                    <div class="card-header h6 mb-0 py-3 font-weight-bold text-uppercase">Sedang KP</div>
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h6 mb-0 py--1 font-weight-bold "><?= $num_kp_dsn ?></div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn2">Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2">
                    <div class="card-header h6 mb-0 py-3 font-weight-bold text-uppercase">Sidang</div>
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h6 mb-0 py--1 font-weight-bold "><?= $num_sidang_dsn ?></div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn2">Details</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="row mb-4">
            <div class="card shadow mb-4 mr-4">
                <div class="card-header h6 mb-0 py-3 font-weight-bold text-uppercase">
                    <h6 class="m-0 font-weight-bold">Mahasiswa Bimbingan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NRP</th>
                                    <th>Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                <?php foreach ($kp as $k) { ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $k->nrp ?></td>
                                        <td><?= $k->nama ?></td>
                                    </tr>
                                    <?php $no++ ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header h6 mb-0 py-3 font-weight-bold text-uppercase">
                    <h6 class="m-0 font-weight-bold">Mahasiswa Sidang</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable_sidang" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NRP</th>
                                    <th>Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                <?php foreach ($sidang as $s) { ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $s->nrp ?></td>
                                        <td><?= $s->nama ?></td>
                                    </tr>
                                    <?php $no++ ?>
                                <?php } ?>
                            </tbody>
                        </table>
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
</div>