<?= $this->extend('general_layout') ?>

<?= $this->section('content') ?>

<!--================Home Banner Area =================-->
<section class="banner_area ">
	<div class="banner_inner overlay d-flex align-items-center">
		<div class="container">
			<div class="banner_content">
				<div class="page_link">
					<a href="index.html">Home</a>
					<a href="contact.html">Contact Us</a>
				</div>
				<h2>Detail Wisata</h2>
			</div>
		</div>
	</div>
</section>
<!--================End Home Banner Area =================-->

<section id="berita">
	<div class="container">
		<header class="section-header">
			<h3> <?= $wisata['nama_wisata'] ?> </h3>
		</header>
		<div class="row">
			<div class="col-sm-12">
				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
						<!-- pertama -->
						<div class="col-sm-12 ">
							<div class="row rowberita">
								<div class="card mb-3 mr-3 ">
									<div class="row no-gutters">
										<div class="col-sm-12 col-md-4 col-lg-12" style="width: 100%; height: 600px;">
											<img src="<?= base_url() ?>/assets/img/profile_pengelola/<?= $wisata['foto'] ?>" style="width: 100%; height: 100%; object-fit: cover;">
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 col-md-8 col-sm-8  text-dark">
											<div class="card-body">
												<h2 class="card-title text-responsive sm-2"><?= $wisata['nama_wisata'] ?></h2>
												<p class="card-text-responsive"><i><?= $wisata['alamat'] ?></i></p>
												<p class="card-text"><?= $wisata['deskripsi'] ?></p>
												<p>
													<table class="table table-bordered">
														<tr>
															<th>Alamat Lengkap</th>
															<th width="20">:</th>
															<td><?= $wisata['alamat'] ?></td>
														</tr>
														<tr>
															<th>Akses Kendaraan</th>
															<th width="20">:</th>
															<td>
																<?php
																if ($wisata['akses_kendaraan'] == "Semua") {
																	echo "Bisa diakses oleh semua kendaraan, baik roda 2 maupun roda 4";
																} else if ($wisata['akses_kendaraan'] == "Motor") {

																	echo "Untuk menuju lokasi hanya bisa menggunakan kendaraan roda 2";
																} else if ($wisata['akses_kendaraan'] == "Mobil") {

																	echo "Untuk menuju lokasi hanya bisa menggunakan kendaraan roda 4";
																} else if ($wisata['akses_kendaraan'] == null) {
																	echo "";
																}
																?>
															</td>
														</tr>
														<tr>
															<th>Hari operasional</th>
															<th width="20">:</th>
															<td>
																<?php if ($wisata['dari_hari'] == "Setiap Hari") : ?>
																	Buka Setiap Hari dari Jam <?= substr($wisata['jam_buka'], 0, 5) ?> - <?= substr($wisata['jam_tutup'], 0, 5) ?>
																<?php endif ?>
																Hari <?= $wisata['dari_hari'] ?> sampai hari <?= $wisata['sampai_hari'] ?> dari Jam <?= substr($wisata['jam_buka'], 0, 5) ?> - <?= substr($wisata['jam_tutup'], 0, 5) ?>
															</td>
														</tr>
														<tr>
															<th>Harga Tiket</th>
															<th width="20">:</th>
															<?php if ($tiket == null) : ?>
																<td>
																	Gratis
																<?php endif ?>

																<?php if ($tiket != null) : ?>
																<td class="p-0">
																	<table class="table table-borderless">

																		<tr>
																			<th>Keterangan Usia</th>
																			<th>Keterangan Hari</th>
																			<th>Harga</th>
																		</tr>
																		<?php foreach ($tiket as $dataTiket) : ?>
																			<tr>
																				<td><?= $dataTiket['keterangan'] ?></td>
																				<td>Hari <?= $dataTiket['keterangan_hari'] ?></td>
																				<td>Rp <?= number_format($dataTiket['harga']) ?></td>
																			</tr>
																		<?php endforeach ?>
																	</table>
																<?php endif ?>
																</td>
														</tr>
													</table>
												</p>

												<h2 class="card-title text-responsive sm-2">Galeri</h2>

												<p class="mb-3">
													<div class="row">
														<?php foreach ($foto_wisata as $dataFoto) : ?>
															<div class="col-4" style="width: 100%; height: 200px;">
																<img style="width: 100%; height: 100%; object-fit: cover;" src="<?= base_url() ?>/assets/img/galeri/<?= $dataFoto['foto'] ?>" width="100%" alt="" srcset="">
															</div>
														<?php endforeach ?>
													</div>
												</p>

												
												<?php if ($wisata['google_maps'] == null) { ?>
													
													<?php } else { ?>
												
												<h2 class="card-title text-responsive sm-2">Lokasi</h2>
												
												<p>
														<iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBJongUi8dEP6rjYVB7he5isojyllm-q9o
                                    &q=<?= $wisata['google_maps'] ?>" allowfullscreen>
														</iframe>
													<?php } ?>
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
</section>
<?= $this->endSection() ?>