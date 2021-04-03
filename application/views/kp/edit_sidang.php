<?php foreach ($sidang as $k) { ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Tanggal</th>
                <td>
                    <?php setlocale(LC_ALL, 'id-ID', 'id_ID');
                    echo strftime("%d %B %Y", strtotime($k->tanggal)) . "\n"; ?>
                </td>
            </tr>
            <tr>
                <th>Tanggal Sidang</th>
                <td>
                    <?php setlocale(LC_ALL, 'id-ID', 'id_ID');
                    echo strftime("%d %B %Y", strtotime($k->tgl_pengajuan)) . "\n"; ?>
                </td>
            </tr>
            <tr>
                <th>Pengirim</th>
                <td>
                    <?= $k->nama_mhs ?>
                </td>
            </tr>
            <tr>
                <th>Penerima</th>
                <td>
                    <?= $k->nama_dsn ?>
                </td>
            </tr>
            <tr>
                <th>Perusahaan</th>
                <td>
                    <?= $k->nama_per ?>
                </td>
            </tr>
            <tr>
                <th>Judul</th>
                <td>
                    <?= $k->judul ?>
                </td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <?= $k->status2 ?>
                </td>
            </tr>
            <tr>
                <th>Dosen Pembimbing</th>
                <td>
                    <?= $k->nama_pemb ?>
                </td>
            </tr>
            <tr>
                <th>Dosen Penguji</th>
                <td>
                    <?= $k->nama_peng ?>
                </td>
            </tr>
            <?php if ($k->status == 'Disetujui' && $user['role'] == 'Koordinator') { ?>
                <tr>
                    <th>Pilih Dosen Penguji</th>
                    <td>
                        <form action="<?= site_url('kp/update_peng/' . ($k->id_sidang)) ?>" method="POST" enctype="multipart/form-data">
                            <select type="text" name="dosen_peng" id="dsn" placeholder="Nama Dosen" class="custom-select custom-select-lg my-0 p-4">
                                <option value="" selected disabled>Pilih Dosen Penguji</option>
                                <?php foreach ($dosen as $d) { ?>
                                    <option value="<?= $d->id_dosen ?>"><?= $d->nama ?></option>
                                <?php } ?>
                            </select>
                            <div class="my-3">
                                <button type="submit" class="btn btn-warning btn-md">Update</button>
                            </div>
                        </form>
                        <script>
                            $(document).ready(function() {
                                $('#dsn').select2();
                            });
                        </script>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php if ($user['role'] == 'Dosen' || $user['role'] == 'Koordinator') { ?>
        <div class="row">
            <?php if (($k->statuspemeriksa == 'Menunggu') && ($k->status == 'Menunggu')) { ?>
                <div class="col-4">
                    <a href="<?= site_url('kp/acc_pemeriksa_sidang/' . $k->id_sidang) ?>" class="btn btn-success btn-block">
                        <i class="fa fa-check text-white"></i>&nbsp;Terima</a>
                </div>
                <div class="col-4">
                    <a href="<?= site_url('kp/dec_pemeriksa_sidang/' . $k->id_sidang) ?>" class="btn btn-danger btn-block">
                        <i class="fa fa-times text-white"></i>&nbsp;Terima</a>
                </div>
            <?php } elseif (($k->statuspemeriksa == 'Disetujui') && ($k->status2 == 'Menunggu') && ($k->pemeriksa2 == $prof['id_dosen'])) { ?>
                <div class="col-4">
                    <a href="<?= site_url('kp/acc_pemeriksa2_sidang/' . $k->id_sidang) ?>" class="btn btn-success btn-block">
                        <i class="fa fa-check text-white"></i>&nbsp;Terima</a>
                </div>
                <div class="col-4">
                    <a href="<?= site_url('kp/dec_pemeriksa_sidang/' . $k->id_sidang) ?>" class="btn btn-danger btn-block">
                        <i class="fa fa-times text-white"></i>&nbsp;Terima</a>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
<?php } ?>