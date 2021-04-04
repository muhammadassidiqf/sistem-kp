<!-- content -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- main content -->
    <div id="content">

        <div class="row mt-3 mb-4">
            <h2>Dashboard</h2>
        </div>

        <div class="row mb-4">
            <div class="card shadow mb-4">
                <div class="card-header h6 mb-0 py-3 font-weight-bold text-uppercase">
                    <h6 class="m-0 font-weight-bold">Form Pelaksanaan KP</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="text-center">No Pegawai</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Jumlah Bimbingan</th>
                                    <th class="text-center">Jumlah Yang Diuji</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                <?php foreach ($num as $k) { ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $k->nik ?></td>
                                        <td><?= $k->nama ?></td>
                                        <td><?= $k->num_kp ?></td>
                                        <td><?= $k->num_sidang ?></td>
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