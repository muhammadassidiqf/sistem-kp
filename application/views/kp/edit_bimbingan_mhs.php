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
                                    <th>Tanggal Bimbingan</th>
                                    <th>Kegiatan Bimbingan</th>
                                    <?php if (($user['role'] == 'Koordinator') or ($user['role'] == 'Dosen')) { ?>
                                        <th>Approval Pembimbing</th>
                                    <?php } elseif ($user['role'] == 'Mahasiswa') { ?>

                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                <?php foreach ($bimbingan as $k) { ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?php setlocale(LC_ALL, 'id-ID', 'id_ID');
                                            echo strftime("%d %B %Y", strtotime($k->tgl_bimbingan)) . "\n"; ?></td>
                                        <td><?= $k->kegiatan ?></td>
                                        <?php if (($user['role'] == 'Koordinator') or ($user['role'] == 'Dosen')) { ?>
                                            <td class="text-center">
                                                <?php if ($k->status == 'Menunggu') { ?>
                                                    <a href="<?= site_url('kp/acc_bimbingan/' . $k->id_bimbingan) ?>" class="btn btn-success">
                                                        <i class="fa fa-check text-white"></i></a>
                                                    <a href="<?= site_url('kp/dec_bimbingan/' . $k->id_bimbingan) ?>" class="btn btn-danger">
                                                        <i class="fa fa-times text-white"></i></a>
                                                <?php } elseif ($k->status == 'Disetujui') { ?>
                                                    <span class="badge badge-success"><?= $k->status ?></span>
                                                <?php } elseif ($k->status == 'Tidak Disetujui') { ?>
                                                    <span class="badge badge-danger"><?= $k->status ?></span>
                                                <?php } ?>
                                            </td>
                                        <?php } elseif ($user['role'] == 'Mahasiswa') { ?>
                                        <?php } ?>
                                    </tr>
                                    <?php $no++ ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <a href="" data-toggle="modal" data-target="#modal_add" class="btn btn-secondary btn-md">Tambah Bimbingan</a>
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
<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Bimbingan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

            </div>
            <form class="form-horizontal" method="post" action="<?= site_url('kp/tambah_bimbingan'); ?>">
                <input name="id_kp" class="form-control" type="hidden" value="<?= $kp['id_kp']; ?>" required readonly>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-xs-3">Tanggal Bimbingan</label>
                        <div class="col-xs-8">
                            <input name="tgl_bimbingan" class="form-control" type="date" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Kegiatan Bimbingan</label>
                        <div class="col-xs-8">
                            <input name="kegiatan" class="form-control" type="text" required placeholder="Laporan KP" required>
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