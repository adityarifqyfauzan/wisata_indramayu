<?= $this->extend('pengelola/pengelola_layout') ?>

<?= $this->section('content') ?>
<div class="row">

    <div class="col-xl-8 col-md-8 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Selamat Datang</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Admin Pengelola <?= $dataPengelola['nama_wisata'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-4 col-md-4 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Status Akun</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php if ($dataPengelola['is_active'] == 1) { ?>
                                Aktif
                            <?php } else { ?>
                                Belum Aktif
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-circle text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Pengelola</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">

                <table class="table table-bordered">

                    <tr>
                        <th width="30%">Nama Wisata</th>
                        <th width="2%">:</th>
                        <td><?= $dataPengelola['nama_wisata'] ?></td>
                    </tr>

                    <tr>
                        <th>Email Pengelola</th>
                        <th>:</th>
                        <td><?= $dataPengelola['email'] ?></td>
                    </tr>

                    <tr>
                        <th>Alamat</th>
                        <th>:</th>
                        <td><?= $dataPengelola['alamat'] ?></td>
                    </tr>

                    <tr>
                        <th>Deskripsi</th>
                        <th>:</th>
                        <td align="justify"><?= substr($dataPengelola['deskripsi'], 0, 600) ?> ...</td>
                    </tr>

                    <tr>
                        <th>No. HP/Telp</th>
                        <th>:</th>
                        <td><?= $dataPengelola['no_hp'] ?></td>
                    </tr>

                    <tr>
                        <th>Google Maps</th>
                        <th>:</th>
                        <td><?= $dataPengelola['google_maps'] ?></td>
                    </tr>

                    <tr>
                        <th>Akses Kendaraan</th>
                        <th>:</th>
                        <td>
                            <?php if ($dataPengelola['akses_kendaraan'] == "Motor") : ?>

                                Hanya dapat diakses oleh kendaraan roda 2 (Motor)

                            <?php endif ?>

                            <?php if ($dataPengelola['akses_kendaraan'] == "Mobil") : ?>

                                Hanya dapat diakses oleh kendaraan roda 4 (Mobil)

                            <?php endif ?>

                            <?php if ($dataPengelola['akses_kendaraan'] == "Semua") : ?>

                                Dapat diakses oleh semua kendaraan, baik roda 2 maupun roda 4

                            <?php endif ?>

                        </td>
                    </tr>


                </table>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card border-left-warning">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jam Operasional</div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            <?php if ($dataPengelola['jam_buka'] == null && $dataPengelola['jam_tutup'] == null) : ?>
                                                Silahkan atur jam operasional
                                            <?php else : ?>
                                                <?= substr($dataPengelola['jam_buka'], 0, 5) . " - " . substr($dataPengelola['jam_tutup'], 0, 5) ?>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-fw fa-clock fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card border-left-warning">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Hari Operasional</div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            <?php if ($dataPengelola['dari_hari'] == null && $dataPengelola['jam_tutup'] == null) : ?>
                                                
                                                Silahkan atur hari operasional
                                            
                                            <?php endif ?>
                                            <?php if ($dataPengelola['dari_hari'] == "Setiap Hari") : ?>
                                                
                                                <?= $dataPengelola['dari_hari'] ?>
                                                
                                            <?php endif ?>
                                            
                                            <?php if ($dataPengelola['dari_hari'] && $dataPengelola['sampai_hari'] != null) : ?>
                                                
                                                <?= $dataPengelola['dari_hari'] ?> - <?= $dataPengelola['sampai_hari'] ?>
                                                
                                            <?php endif ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-fw fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card-footer text-right">
                <a href="/pengelola/akun" class="btn btn-info">Edit Informasi</a>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Google Maps</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <?php if ($dataPengelola['google_maps'] == null) { ?>
                    Belum ada Maps
                <?php } else { ?>
                    <iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBJongUi8dEP6rjYVB7he5isojyllm-q9o&q=<?= $dataPengelola['google_maps'] ?>" allowfullscreen>
                    </iframe>
                <?php } ?>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>