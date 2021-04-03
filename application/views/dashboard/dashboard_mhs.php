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
                    <h6 class="m-0 font-weight-bold">Informasi KP</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td> <b> Judul </b> </td>
                                    <td><?= $sidang['judul'] ?></td>
                                </tr>
                                <tr>
                                    <td> <b> Perusahaan </b> </td>
                                    <td><?= $sidang['nama_per'] ?></td>
                                </tr>
                                <tr>
                                    <td> <b> Dosen Pembimbing </b> </td>
                                    <td><?= $sidang['nama_pemb'] ?></td>
                                </tr>
                                <tr>
                                    <td> <b> Dosen Penguji </b> </td>
                                    <td><?= $sidang['nama_peng'] ?></td>
                                </tr>
                                <tr>
                                    <td> <b> Jadwal Sidang </b> </td>
                                    <td><?php setlocale(LC_ALL, 'id-ID', 'id_ID');
                                        echo strftime("%d %B %Y", strtotime($sidang['tgl_pengajuan'])) . "\n"; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- </div> -->

    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; IOS Developer 2021</span>
            </div>
        </div>
    </footer>

</div>