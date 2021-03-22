<div id="content-wrapper" class="d-flex flex-column">

    <!-- main content -->
    <div id="content">

        <div class="row mt-3 mb-4">
            <h2>Profil</h2>
        </div>

        <div class="row  mb-4">
            <div class="table-responsive">
                <table id="masuk" class="table-lg mb-0 table table-hover" style="min-width: 100% !important;">
                    <thead>
                        <tr role="row">
                            <th scope="col">Pengirim</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Perusahaan</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kp as $k) : ?>
                            <tr>
                                <td>
                                    <?= $k->nama_mhs ?>
                                </td>
                                <td>
                                    <?php setlocale(LC_ALL, 'id-ID', 'id_ID');
                                    echo strftime("%d %B %Y", strtotime($k->tanggal)) . "\n"; ?>
                                </td>
                                <td><?= $k->nama_per ?></td>
                                <td>
                                    <?= $k->status2 ?>
                                </td>
                                <td>
                                    <a href="" data-remote="<?= site_url('kp/edit_kp/' . $k->id_kp) ?>" data-toggle="modal" data-target="#modal_kp" data-title="Detail Pengajuan KP" class="btn btn-info btn-sm" data-dismiss="modal">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#masuk').DataTable({
            "responsive": true,
            "autoWidth": true,
            "language": {
                "emptyTable": "Tidak ada email"
            },
            "order": [],
            'columnDefs': [{
                "targets": [4],
                "searchable": false,
            }],
        });
    });
</script>