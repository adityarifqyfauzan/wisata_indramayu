<?= $this->extend('pengelola/pengelola_layout') ?>

<?= $this->section('content') ?>
<div class="row">

    <div class="col-12">

        <p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addFoto">Tambah foto</button></p>
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Foto Galeri</h6>
            </div>

            <div class="card-body">
                <?php if ($foto == null) : ?>

                    Belum ada foto

                <?php else : ?>
                    <div class="row">

                        <?php foreach ($foto as $dataFoto) : ?>

                            <div class="col-lg-3 col-md-2 col-sm-1 mb-4">

                                <div class="card">
                                    <div class="card-body" style="width: 100%; height: 100%; object-fit: cover;">

                                        <img src="<?= base_url() ?>/assets/img/galeri/<?= $dataFoto['foto'] ?>" class="rounded img-thumbnail">

                                    </div>
                                    <div class="card-footer">

                                        <a href="<?= base_url() ?>/pengelola/hapus_foto_galeri/<?= $dataFoto['id'] ?>" class="btn btn-outline-danger btn-hapus btn-block" data-message="Ingin menghapus Foto ?"><i class="fas fa-trash-alt"></i></a>

                                    </div>
                                </div>

                            </div>

                        <?php endforeach ?>
                    </div>
                <?php endif  ?>

            </div>
        </div>

    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="addFoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="<?= base_url() ?>/pengelola/upload_foto" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label>Pilih Foto</label>
                        <input type="file" class="form-control-file <?= ($validation->hasError('foto') ? 'is-invalid' : ''); ?>" name="foto">
                        <div class="invalid-feedback">
                            <?= $validation->getError('foto') ?>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<script>
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
            confirmButtonText: "Ya, Hapus!"
        }).then((result) => {
            if (result.value) {
                document.location.href = href
            }
        })

    })
</script>

<?= $this->endSection() ?>