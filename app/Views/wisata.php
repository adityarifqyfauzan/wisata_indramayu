<?= $this->extend('general_layout') ?>

<?= $this->section('content') ?>

<!--================Home Banner Area =================-->
<section class="banner_area ">
	<div class="banner_inner overlay d-flex align-items-center">
		<div class="container">
			<div class="banner_content">
				<div class="page_link">
					<a href="<?= base_url() ?>">Home</a>
				</div>
				<h2>Tempat Wisata</h2>
			</div>
		</div>
	</div>
</section>
<!--================End Home Banner Area =================-->
<!--==========================
	berita Section
	============================-->
<section id="berita">
	<div class="container">
		<header class="section-header">

			<h3> <?= $kategoriWisata['kategori'] ?> </h3>
		</header>
		<!-- percobaan data target -->

		<div class="row">
			<?php foreach ($wisata as $dataWisata) : ?>
				<div class="col-sm-12">
					<div class="tab-content" id="nav-tabContent">
						<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
							<!-- pertama -->
							<div class="col-sm-12 ">
								<div class="row rowberita">
									<div class="card mb-3 mr-3 ">
										<div class="row no-gutters">
											<div class="col-sm-5 col-md-5 col-lg-5" style="width: 100%; height: 300px;">
												<img src="<?= base_url() ?>/assets/img/profile_pengelola/<?= $dataWisata['foto'] ?>" style="width: 100%; height: 100%; object-fit: cover;" class="card-img img-responsive">
											</div>
											<div class="col-lg-7 col-md-7 col-sm-7 text-dark">
												<div class="card-body">
													<h2 class="card-title text-responsive sm-2"><?= $dataWisata['nama_wisata'] ?></h2>
													<p class="card-text-responsive"><small><i><?= $dataWisata['alamat'] ?></i></small></p>
													<p class="card-text"><?= substr($dataWisata['deskripsi'], 0, 200) ?><a href="" class="text-dark">(Selanjutnya)</a></p>
													<p><a href="<?= base_url("/detail_wisata/$dataWisata[id]") ?>" class="btn btn-info">Lihat Selengkapnya</a></p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach ?>
</section>

<?= $this->endSection() ?>