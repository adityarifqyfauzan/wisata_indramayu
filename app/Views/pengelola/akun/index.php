<?= $this->extend('pengelola/pengelola_layout') ?>

<?= $this->section('content') ?>

<div class="row">

    <div class="col-md-4">
        <div class="row">
            <div class="col-12">

                <div class="card shadow mb-3">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Foto Utama</h6>
                    </div>

                    <!-- <div class="card-body align-content-center">
                        </div>
                        -->
                    <div class="card-body">

                        <?php if ($dataPengelola['foto'] != null) : ?>
                            <img src="<?= base_url() ?>/assets/img/profile_pengelola/<?= $dataPengelola['foto'] ?>" class="rounded img-thumbnail mb-2">
                        <?php else : ?>
                            Belum ada foto
                        <?php endif ?>

                        <form method="POST" action="<?= base_url('pengelola/upload_gambar_utama') ?>" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" value="<?= $dataPengelola['id']; ?>">
                            <div class="form-group">
                                <input type="file" class="form-control-file <?= ($validation->hasError('foto') ? 'is-invalid' : ''); ?>" id="gambarutama" name="foto">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('foto') ?>
                                </div>
                            </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-info btn-block">Simpan</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="card shadow mb-3">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Hari Operasional</h6>
                    </div>

                    <div class="card-body">
                        <form action="<?= base_url('/pengelola/set_waktu_operasional') ?>" method="POST">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" value="<?= $dataPengelola['id'] ?>">
                            <label>Hari</label>
                            <div class="row mb-2">
                                <div class="col">
                                    <select name="dari_hari" id="dari_hari" class="form-control">
                                        <option value="">--Dari--</option>
                                        <option value="Senin" <?= ($dataPengelola['dari_hari'] == 'Senin') ? 'selected' : '' ?>>Senin</option>
                                        <option value="Selasa" <?= ($dataPengelola['dari_hari'] == 'Selasa') ? 'selected' : '' ?>>Selasa</option>
                                        <option value="Rabu" <?= ($dataPengelola['dari_hari'] == 'Rabu') ? 'selected' : '' ?>>Rabu</option>
                                        <option value="Kamis" <?= ($dataPengelola['dari_hari'] == 'Kamis') ? 'selected' : '' ?>>Kamis</option>
                                        <option value="Jumat" <?= ($dataPengelola['dari_hari'] == 'Jumat') ? 'selected' : '' ?>>Jumat</option>
                                        <option value="Sabtu" <?= ($dataPengelola['dari_hari'] == 'Sabtu') ? 'selected' : '' ?>>Sabtu</option>
                                        <option value="Minggu" <?= ($dataPengelola['dari_hari'] == 'Minggu') ? 'selected' : '' ?>>Minggu</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <select name="sampai_hari" id="sampai_hari" class="form-control">
                                        <option value="">--Sampai--</option>
                                        <option value="Senin" <?= ($dataPengelola['sampai_hari'] == 'Senin') ? 'selected' : '' ?>>Senin</option>
                                        <option value="Selasa" <?= ($dataPengelola['sampai_hari'] == 'Selasa') ? 'selected' : '' ?>>Selasa</option>
                                        <option value="Rabu" <?= ($dataPengelola['sampai_hari'] == 'Rabu') ? 'selected' : '' ?>>Rabu</option>
                                        <option value="Kamis" <?= ($dataPengelola['sampai_hari'] == 'Kamis') ? 'selected' : '' ?>>Kamis</option>
                                        <option value="Jumat" <?= ($dataPengelola['sampai_hari'] == 'Jumat') ? 'selected' : '' ?>>Jumat</option>
                                        <option value="Sabtu" <?= ($dataPengelola['sampai_hari'] == 'Sabtu') ? 'selected' : '' ?>>Sabtu</option>
                                        <option value="Minggu" <?= ($dataPengelola['sampai_hari'] == 'Minggu') ? 'selected' : '' ?>>Minggu</option>
                                    </select>
                                </div>
                            </div>
                            <p class="text-center">--- atau ---</p>
                            <div class="row mb-2">
                                <div class="col-lg-12">
                                    <div class="form-check">
                                        <input class="form-check-input" name="setiap_hari" <?= ($dataPengelola['dari_hari'] != null && $dataPengelola['dari_hari'] == 'Setiap Hari') ? 'checked' : '' ?> type="checkbox" value="Setiap Hari" id="setiap_hari">
                                        <label class="form-check-label" for="defaultCheck1">
                                            Setiap Hari
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <button class="btn btn-info btn-block" type="submit">Atur Hari Operasional</button>
                                </div>
                        </form>
                    </div>
                </div>

                <div class="card-footer">
                    Pilih salah satu
                </div>
            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-3">

                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Waktu Operasional</h6>
                </div>

                <div class="card-body">
                    <form action="<?= base_url('pengelola/setJam') ?>" method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id" value="<?= $dataPengelola['id'] ?>">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group text-center">
                                    <label>Jam Buka</label>
                                    <input type="time" class="form-control" name="jam_buka" value="<?= $dataPengelola['jam_buka'] ?>">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group text-center">
                                    <label>Jam Tutup</label>
                                    <input type="time" class="form-control" name="jam_tutup" value="<?= $dataPengelola['jam_tutup'] ?>">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-lg-12">
                            <button class="btn btn-info btn-block" type="submit">Atur Jam Operasional</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <?php if ($dataKategoriWisata['kategori'] != "Wisata Kuliner") : ?>

        <div class="row">
            <div class="col-12">

                <div class="card shadow mb-3">

                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Harga Tiket</h6>
                    </div>

                    <div class="card-body">
                        <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#addTiket">Tambah tiket</button></p>

                        <?php if ($dataTiket == null) : ?>
                            <b>Belum ada data tiket</b>, Apabila tempat wisata Anda tidak menggunakan tiket <b>(Gratis)</b>, Anda tidak perlu menambahkan data tiket
                        <?php else : ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Usia</th>
                                        <th>Hari</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($dataTiket as $tiket) : ?>

                                        <tr style="font-size: 11px;">
                                            <td><?= $tiket['keterangan'] ?></td>
                                            <td><?= $tiket['keterangan_hari'] ?></td>
                                            <td><?= "Rp " . number_format($tiket['harga']) ?></td>
                                            <td>
                                                <a href="#" class="btn btn-info btn-edit" data-keterangan="<?= $tiket['keterangan'] ?>" data-keteranganhari="<?= $tiket['keterangan_hari'] ?>" data-harga="<?= $tiket['harga'] ?>" data-key="<?= $tiket['id'] ?>" data-toggle="modal" data-target="#editKategori"><i class="fas fa-edit"></i></a>

                                                <a href="<?= base_url() ?>/pengelola/hapus_tiket/<?= $tiket['id'] ?>" class="btn btn-outline-danger btn-hapus" data-message="Ingin menghapus data tiket ?"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>

                                    <?php endforeach ?>

                                </tbody>
                            </table>
                        <?php endif ?>
                    </div>

                </div>

            </div>
        </div>
    <?php endif ?>
</div>

<div class="col-lg-8">
    <div class="row">

        <div class="col-12">

            <div class="card shadow mb-4">

                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Data Akun Pengelola</h6>
                </div>

                <div class="card-body">
                    <form method="POST" action="<?= base_url('/pengelola/perbarui_data') ?>">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id" value="<?= $dataPengelola['id'] ?>">
                        <div class="form-group">
                            <label><b>Nama Tempat Wisata</b></label>
                            <input type="text" class="form-control" name="nama_wisata" value="<?= $dataPengelola['nama_wisata'] ?>">
                        </div>

                        <div class="form-group">
                            <label><b>Email Pengelola</b></label>
                            <input type="email" class="form-control" name="email" value="<?= $dataPengelola['email'] ?>">
                        </div>

                        <div class="form-group">
                            <label><b>Nomor Telepone/Handphone</b></label>
                            <input type="text" class="form-control" name="no_hp" value="<?= $dataPengelola['no_hp'] ?>">
                        </div>

                        <div class="form-group">
                            <label><b>Deskripsi</b></label>
                            <textarea name="deskripsi" cols="30" rows="5" class="form-control"><?= $dataPengelola['deskripsi'] ?></textarea>
                        </div>

                        <div class="form-group">
                            <label><b>Alamat</b></label>
                            <textarea name="alamat" cols="30" rows="5" class="form-control"><?= $dataPengelola['alamat'] ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-7">

                                <div class="form-group">
                                    <label><b>Nama Lokasi di Maps (Google Maps)</b></label>
                                    <input type="text" class="form-control" name="google_maps" value="<?= $dataPengelola['google_maps'] ?>">
                                </div>

                            </div>

                            <div class="col-5">

                                <div class="form-group">
                                    <label><b>Akses Kendaraan</b></label>
                                    <div class="col">
                                        <?php if ($dataPengelola['akses_kendaraan'] == null) : ?>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="motor" value="Motor">
                                                <label class="form-check-label" for="inlineCheckbox1">Motor (Roda 2)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="mobil" value="Mobil">
                                                <label class="form-check-label" for="inlineCheckbox2">Mobil (Roda 4)</label>
                                            </div>

                                        <?php endif ?>

                                        <?php if ($dataPengelola['akses_kendaraan'] == "Motor") : ?>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" checked id="inlineCheckbox1" name="motor" value="Motor">
                                                <label class="form-check-label" for="inlineCheckbox1">Motor (Roda 2)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="mobil" value="Mobil">
                                                <label class="form-check-label" for="inlineCheckbox2">Mobil (Roda 4)</label>
                                            </div>

                                        <?php endif ?>

                                        <?php if ($dataPengelola['akses_kendaraan'] == "Mobil") : ?>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="motor" value="Motor">
                                                <label class="form-check-label" for="inlineCheckbox1">Motor (Roda 2)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" checked id="inlineCheckbox2" name="mobil" value="Mobil">
                                                <label class="form-check-label" for="inlineCheckbox2">Mobil (Roda 4)</label>
                                            </div>

                                        <?php endif ?>

                                        <?php if ($dataPengelola['akses_kendaraan'] == "Semua") : ?>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" checked id="inlineCheckbox1" name="motor" value="Motor">
                                                <label class="form-check-label" for="inlineCheckbox1">Motor (Roda 2)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" checked id="inlineCheckbox2" name="mobil" value="Mobil">
                                                <label class="form-check-label" for="inlineCheckbox2">Mobil (Roda 4)</label>
                                            </div>

                                        <?php endif ?>

                                    </div>
                                    
                                </div>

                            </div>
                        </div>

                        <?php if ($dataPengelola['google_maps'] == null) { ?>

                        <?php } else { ?>
                            <iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBJongUi8dEP6rjYVB7he5isojyllm-q9o
                                    &q=<?= $dataPengelola['google_maps'] ?>" allowfullscreen>
                            </iframe>
                        <?php } ?>

                </div>
                <div class="card-footer">
                    <button class="btn btn-info">Perbarui Data</button>
                    </form>
                </div>
            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-12">

        </div>
    </div>

</div>

<!-- Modal Add data tiket -->
<div class="modal fade" id="addTiket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Keterangan Tiket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="<?= base_url() ?>/pengelola/tambah_tiket" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="tempat_wisata_id" value="<?= $dataPengelola['id'] ?>">

                    <div class="form-group">
                        <label><b>Keterangan Usia</b></label>
                        <select class="form-control" name="keterangan">
                            <option value="Anak-Anak">Anak-Anak</option>
                            <option value="Dewasa">Dewasa</option>
                            <option value="Semua">Semua</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><b>Keterangan Hari</b></label>
                        <select class="form-control" name="keterangan_hari">
                            <option value="Biasa">Biasa</option>
                            <option value="Libur">Libur</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><b>Harga Tiket</b></label>
                        <input type="text" name="harga" class="form-control <?= ($validation->hasError('harga') ? 'is-invalid' : ''); ?>" placeholder="cth : 10000">
                        <div class="invalid-feedback">
                            <?= $validation->getError('harga') ?>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit data tiket -->
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
                <form method="POST" action="<?= base_url() ?>/pengelola/perbarui_tiket">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" class="id-tiket">
                    <div class="form-group">
                        <label><b>Keterangan Usia</b></label>
                        <select class="form-control keterangan" name="keterangan">
                            <option value="Anak-Anak">Anak-Anak</option>
                            <option value="Dewasa">Dewasa</option>
                            <option value="Semua">Semua</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><b>Keterangan Hari</b></label>
                        <select class="form-control keterangan-hari" name="keterangan_hari">
                            <option value="Biasa">Biasa</option>
                            <option value="Libur">Libur</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><b>Harga Tiket</b></label>
                        <input type="text" name="harga" class="form-control harga <?= ($validation->hasError('harga') ? 'is-invalid' : ''); ?>" placeholder="cth : 10000">
                        <div class="invalid-feedback">
                            <?= $validation->getError('harga') ?>
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

        const id = $(this).data('key');
        const keterangan = $(this).data('keterangan');
        const keterangan_hari = $(this).data('keteranganhari');
        const harga = $(this).data('harga');

        $('.id-tiket').val(id);
        $('.keterangan').val(keterangan);
        $('.keterangan-hari').val(keterangan_hari);
        $('.harga').val(harga);

        console.log(id);

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
            confirmButtonText: "Ya, Hapus!"
        }).then((result) => {
            if (result.value) {
                document.location.href = href
            }
        })

    })
</script>

<script src="<?= base_url('dashboard_assets/js/akun_pengelola.js') ?>"></script>

<?= $this->endSection() ?>