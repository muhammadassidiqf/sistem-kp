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
                    <h6 class="m-0 font-weight-bold">Data Sidang</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NRP</th>
                                    <th>Nama</th>
                                    <th>Dosen Penguji</th>
                                    <th>Jadwal Sidang</th>
                                    <th>Metode</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                <?php foreach ($sidang as $s) { ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $s->nrp ?></td>
                                        <td><?= $s->nama ?></td>
                                        <td><?= $s->nama_peng ?></td>
                                        <td><?php setlocale(LC_ALL, 'id-ID', 'id_ID');
                                            echo strftime("%d %B %Y", strtotime($s->tgl_pengajuan)) . "\n"; ?></td>
                                        <?php if (($user['role'] == 'Koordinator') or ($user['role'] == 'Dosen')) { ?>
                                            <td class="text-center">
                                                <a href="<?= $s->link ?>" class="btn btn-md btn-info" target="_blank">Link</a>
                                            </td>
                                        <?php } elseif ($user['role'] == 'Mahasiswa') { ?>
                                            <td class="text-center">
                                                <a href="" data-toggle="modal" data-target="#modal_add_link" class="btn btn-md btn-info">Link</a>
                                            </td>
                                        <?php } ?>
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
<?php foreach ($sidang as $s) : ?>
    <div class="modal fade" id="modal_add_link" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Tambah Link Sidang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                </div>
                <form class="form-horizontal" method="post" action="<?= site_url('kp/edit_link/' . $s->id_sidang); ?>">
                    <input name="id_sidang" class="form-control" type="hidden" value="<?= $s->id_sidang; ?>" required readonly>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-xs-3">Link Video Conference</label>
                            <div class="col-xs-8">
                                <input name="link" class="form-control" type="text" value="<?= $s->link ?>" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="mb-2 btn btn-primary mr-2"><i class="fa fa-save"></i> Save</button>
                            <button class="mb-2 btn btn-outline-danger mr-2" data-dismiss="modal" aria-hidden="true">Cancel</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>

<?php endforeach; ?>