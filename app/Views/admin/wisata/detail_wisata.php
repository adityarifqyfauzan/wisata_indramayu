<?= $this->extend('admin/admin_layout') ?>

<?= $this->section('content') ?>

<div class="row">

    <div class="col-lg-8">

        <div class="card shadow mb-4">

            <div class="card-header py-3">Data Wisata</div>
            <div class="card-body">

                <div class="row">
                    <div class="col-12">

                        <table class="table table-bordered" width="100%" cellspacing="0">

                            <tr>
                                <th width="30%">Nama Tempat Wisata</th>
                                <td width="2%">:</td>
                                <td><?= $wisata['nama_wisata'] ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>:</td>
                                <td><?= $wisata['email'] ?></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>:</td>
                                <td><?= $wisata['alamat'] ?></td>
                            </tr>
                            <tr>
                                <th>No Handphone</th>
                                <td>:</td>
                                <td><?= $wisata['no_hp'] ?></td>
                            </tr>
                            <tr>
                                <th>Harga Tiket</th>
                                <td>:</td>
                                <td><?= $wisata['deskripsi'] ?></td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>:</td>
                                <td><?= $wisata['deskripsi'] ?></td>
                            </tr>

                        </table>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <div class="col-lg-4">

        <div class="card shadow mb-4">

            <div class="card-header py-3">Status Akun</div>
            <div class="card-body">

                <div class="row">
                    <div class="col-12">

                        <?php if ($wisata['is_active'] == '0') { ?>
                            <div class="alert alert-warning text-center">
                                <h3><b>Belum Aktif</b></h3>
                            </div>
                        <?php } else if ($wisata['is_active'] == '1') { ?>
                            <div class="alert alert-success text-center">
                                <h3><b>Aktif</b></h3>
                            </div>
                        <?php } else if ($wisata['is_active'] == '2') { ?>
                            <div class="alert alert-danger text-center">
                                <h3><b>Blacklist</b></h3>
                            </div>
                        <?php } ?>

                    </div>
                </div>

            </div>
            <div class="card-footer">
                <?php if ($wisata['is_active'] == '0') { ?>
                    <a href="/admin/aktifkan_wisata/<?= $wisata['id'] ?>" data-message="Aktifkan" class="btn btn-info btn-block btn-aktif">Aktifkan</a>
                <?php } else if ($wisata['is_active'] == '1') { ?>
                    <a href="/admin/nonaktif_wisata/<?= $wisata['id'] ?>" data-message ="Nonaktifkan" class="btn btn-info btn-block btn-aktif">Nonaktifkan</a>
                    <a href="/admin/dashboard" data-message="Blacklist" class="btn btn-outline-danger btn-block btn-aktif">Blacklist</a>
                <?php } ?>
            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Page level plugins -->
<script src="<?= base_url() ?>/dashboard_assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/dashboard_assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url() ?>/dashboard_assets/js/demo/datatables-demo.js"></script>
<?= $this->endSection() ?>