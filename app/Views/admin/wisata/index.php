<?= $this->extend('admin/admin_layout') ?>

<?= $this->section('content') ?>

<div class="col-lg-12">

    <div class="card shadow mb-4">

        <div class="card-header py-3">Tabel Wisata</div>
        <div class="card-body">

            <div class="row">
                <div class="col-12">

                    <table class="table table-bordered table-striped table-hover table-responsive" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center" width="4%">No</th>
                                <th>Nama Tempat Wisata</th>
                                <th>Alamat</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama Tempat Wisata</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>

                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($wisata as $data) { ?>
                                <tr>
                                    <td class="text-center"><?= $i ?></td>
                                    <td><?= $data['nama_wisata'] ?></td>
                                    <td><?= $data['alamat'] ?></td>
                                    <td align="center"><a href="/admin/wisata/<?= $data['id'] ?>" class="btn btn-info">Lihat Detail</a></td>
                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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