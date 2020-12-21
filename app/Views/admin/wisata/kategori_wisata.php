<?= $this->extend('admin/admin_layout') ?>

<?= $this->section('content') ?>

<div class="col-lg-12">
    <p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addKategori">Tambah Kategori</button></p>
    <div class="card shadow mb-4">

        <div class="card-header py-3">Tabel Kategori</div>
        <div class="card-body">

            <div class="row">
                <div class="col-12">

                    <table class="table table-bordered table-striped table-hover table-responsive" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center" width="4%">No</th>
                                <th>Kategori Wisata</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Kategori Wisata</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </tfoot>

                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($kategori as $data) { ?>
                                <tr>
                                    <td class="text-center"><?= $i ?></td>
                                    <td><?= $data['kategori'] ?></td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-info btn-edit" data-value="<?= $data['kategori'] ?>" data-id="<?= $data['id'] ?>" data-toggle="modal" data-target="#editKategori"><i class="fas fa-edit"></i></a>

                                        <a href="<?= base_url() ?>/admin/hapus_kategori_wisata/<?= $data['id'] ?>" class="btn btn-outline-danger btn-hapus" data-message="Ingin Menghapus Kategori <?= $data['kategori'] ?> ?"><i class="fas fa-trash-alt"></i></a>
                                    </td>
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

<!-- Modal add Kategori -->
<div class="modal fade" id="addKategori" tabindex="-1" role="dialog" aria-labelledby="addKategoriLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addKategoriLabel">Form Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url() ?>/admin/kategori_wisata">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label>Kategori Wisata</label>
                        <input type="text" class="form-control <?= ($validation->hasError('kategori') ? 'is-invalid' : ''); ?>" name="kategori" value="<?= old('kategori') ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('kategori') ?>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambahkan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Kategori -->
<div class="modal fade" id="editKategori" tabindex="-1" role="dialog" aria-labelledby="editKategoriLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKategoriLabel">Form Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url() ?>/admin/update_kategori_wisata" id="editForm">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <input type="hidden" name="id" class="id-input-kategori">
                        <label>Kategori Wisata</label>
                        <input type="text" class="form-control <?= ($validation->hasError('kategori') ? 'is-invalid' : ''); ?> kategori-input" name="kategori">
                        <div class="invalid-feedback">
                            <?= $validation->getError('kategori') ?>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Perbarui Data</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    $(document).on('click', '.btn-edit', function(e) {

        e.preventDefault();

        const data = $(this).data('value');
        const id = $(this).data('id');

        $('.kategori-input').val(data);
        $('.id-input-kategori').val(id);

    })

    $(document).on('click', '.btn-hapus', function(e) {

        e.preventDefault();
        const href = $(this).attr('href');

        const message = $(this).attr('data-message');

        Swal.fire({
            title: 'Anda yakin',
            text: message,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#5bc0de',
            cancelButtonColor: '#d33',
            confirmButtonText:  "Ya, Hapus!"
        }).then((result) => {
            if (result.value) {
                document.location.href = href
            }
        })

    })
</script>
<!-- Page level plugins -->
<script src="<?= base_url() ?>/dashboard_assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/dashboard_assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url() ?>/dashboard_assets/js/demo/datatables-demo.js"></script>
<?= $this->endSection() ?>