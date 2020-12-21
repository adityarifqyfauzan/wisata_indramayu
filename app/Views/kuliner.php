<?= $this->extend('general_layout') ?>

<?= $this->section('content') ?>

<<!--================Home Banner Area =================-->
<section class="banner_area ">
		<div class="banner_inner overlay d-flex align-items-center">
			<div class="container">
				<div class="banner_content">
					<div class="page_link">
						<a href="index.html">Home</a>
						<a href="about-us.html">About Us</a>
					</div>
					<h2>About Us</h2>
				</div>
			</div>
		</div>
	</section>
	<!--================End Home Banner Area =================-->

	<!--================ Start About Area =================-->
	<section class="section_gap about-area">
		<div class="container">
			<div class="single-about row">
				<div class="col-lg-4 col-md-6 no-padding about-left">
					<div class="about-content">
						<h1>
							Mengenal <br>
							Pariwisata di<br>
							Indramayu
						</h1>
						<p>
						Wisata adalah proses berpergian yang bersifat sementara yang dilakukan
seseorang untuk menuju tempat lain di luar tempat tinggalnya. Motif kepergiannya
tersebut bisa karena kepentingan ekonomi, kesehatan, agama, budaya, sosial,
politik, dan kepentingan lainnya. (Gamal: 2004).
						</p>
					</div>
				</div>
				<div class="col-lg-8 col-md-6 text-center no-padding about-right">
					<div class="about-thumb">
						<img src="img/about-img.jpg" class="img-fluid info-img" alt="">
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ End About Area =================-->

	<!--================ Start CTA Area =================-->
	<div class="cta-area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-5">
					<h1>Kabupaten Indramayu</h1>
					<p>
					Kabupaten Indramayu merupakan salah satu kabupaten dipropinsi Jawa Barat.
Dengan banyaknya tempat wisata diberbagai kawasan yang ada di kabupaten
Indramayu, dengan perkembangan yang terjadi maka menjadi banyak pilihan bagi
masyarakat atau wisatawan untuk melakukan travelling. Dengan demikian
masyarakat harus dapat mendapatkan informasi tentang tempat wisata yang ada di
kabupaten Indramayu dengan berbagai informasi yang diberikan seperti lokasi
wisata, harga tiket masuk wisata dan data tempat wisata.
					</p>
					<!-- <a href="#" class="primary-btn">Book a Trip</a>
				</div> -->
				<div class="offset-lg-1 col-lg-6">
					<img class="cta-img img-fluid" src="img/cta-img.png" alt="">
				</div>
			</div>
		</div>
	</div>
	<!--================ End CTA Area =================-->

<?= $this->endSection() ?>