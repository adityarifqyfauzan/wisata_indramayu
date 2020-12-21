<?= $this->extend('general_layout') ?>

<?= $this->section('content') ?>

<!--================Hero Banner Area Start =================-->

<section id="intro">
	<div class="video-background-holder">
		<div class="video-background-overlay"></div>
		<video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
			<source src="<?= base_url() ?>/general_assets/video/video2.mp4" type="video/mp4">
		</video>
		<div class="video-background-content container h-100">
			<div class="d-flex h-100 text-center align-items-center">
				<div class="int-info">
					<h2>Wisata Indramayu</h2>
				</div>
			</div>
		</div>
	</div>
	</div>
</section>

<!--============== About Us Start =================-->
<div class="cta-area section_gap">
	<div class="container">
		<div class="row">
			<div class="col-lg-5">
				<h1>Wisata Indramayu
				</h1>
				<p>
					Kabupaten Indramayu adalah salah satu kabupaten di Provinsi Jawa Barat, Indonesia. Ibu kotanya
					adalah Indramayu. Nama Indramayu berasal dari kecantikan putri Arya wira lodra bernama Nyi
					Endang Ayu, yaitu salah satu pendiri Indramayu abad 1527 M. Nyi endang ayu.
				</p>
				<a href="#" class="primary-btn">Selengkapnya</a>
			</div>
			<div class="offset-lg-1 col-lg-6">
				<img class="cta-img img-fluid" src="img/cta-img.png" alt="">
			</div>
		</div>
	</div>
</div>
<!--================About Us End =================-->

<!--================Feature Area Start =================-->

<!--================ Start Popular Places Area =================-->
<section class="popular-places-area section_gap_bottom">
	<div class="container">
		<div class="row d-flex justify-content-center">
			<div class="col-lg-12">
				<div class="main_title">
					<h1>Kategori Wisata Indramayu</h1>
					<!-- <h1>Popular Places Around the World</h1> -->
					<span class="title-widget-bg"></span>
				</div>
			</div>
		</div>
	</div>
	<div class="popular-places-slider owl-carousel" style="width: 100%; height: 300px;">
		<a href="<?= base_url() ?>/wisata/2" class="single-popular-places d-block">
			<div class="popular-places-img" style="width: 100%; height: 300px;">
				<img src="<?= base_url() ?>/general_assets/img/banner/tugu.jpg" style="width: 100%; height: 100%; object-fit: cover;" alt="">
			</div>
			<div class="popular-places-text">
				<p>Wisata Budaya</p>
				<h4>
					Selengkapnya
				</h4>
			</div>
		</a>
		<a href="<?= base_url() ?>/wisata/1" class="single-popular-places d-block">
			<div class="popular-places-img" style="width: 100%; height: 300px;">
				<img src="<?= base_url() ?>/general_assets/img/banner/b.jpg" style="width: 100%; height: 100%; object-fit: cover;" alt="">
			</div>
			<div class="popular-places-text">
				<p>Wisata Alam</p>
				<h4>
					Selengkapnya
				</h4>
			</div>
		</a>
		<a href="<?= base_url() ?>/wisata/5" class="single-popular-places d-block">
			<div class="popular-places-img" style="width: 100%; height: 300px;">
				<img src="<?= base_url() ?>/general_assets/img/banner/ic.jpg" style="width: 100%; height: 100%; object-fit: cover;" alt="">
			</div>
			<div class="popular-places-text">
				<p>Wisata Religi</p>
				<h4>
					Selengkapnya
				</h4>
			</div>
		</a>
		<a href="<?= base_url() ?>/wisata/4" style="width: 100%; height: 100%; object-fit: cover;" alt="" class="single-popular-places d-block">
			<div class="popular-places-img" style="width: 100%; height: 300px;">
				<img src="<?= base_url() ?>/general_assets/img/banner/kulinercimanuk.jpg" style="width: 100%; height: 100%; object-fit: cover;" alt="">
			</div>
			<div class="popular-places-text">
				<p>Wisata Kuliner</p>
				<h4>
					Selengkapnya
				</h4>
			</div>
		</a>
		<a href="<?= base_url() ?>/wisata/3" style="width: 100%; height: 100%; object-fit: cover;" alt="" class="single-popular-places d-block">
			<div class="popular-places-img" style="width: 100%; height: 300px;">
				<img src="<?= base_url() ?>/general_assets/img/banner/waterpark-bojongsari.jpg" style="width: 100%; height: 100%; object-fit: cover;" alt="">
			</div>
			<div class="popular-places-text">
				<p>Wisata Rekreasi</p>
				<h4>
					Selengkapnya
				</h4>
			</div>
		</a>
	</div>
	<div class="cta-area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-5">
					<h1>Anda Pengelola Wisata ?
					</h1>
					<p>
						Segera daftarkan tempat wisata Anda
					</p>
					<a href="/pengelola/registrasi" class="primary-btn">Daftar</a>
				</div>
				<div class="offset-lg-1 col-lg-6">
					<img class="cta-img img-fluid" src="img/cta-img.png" alt="">
				</div>
			</div>
		</div>
	</div>
</section>
<!--================End Popular Places Area=================-->
<!-- GetButton.io widget -->
<script type="text/javascript">
	(function() {
		var options = {
			whatsapp: "+6289661043429", // WhatsApp number
			call_to_action: "Hubungi Kami", // Call to action
			position: "left", // Position may be 'right' or 'left'
		};
		var proto = document.location.protocol,
			host = "getbutton.io",
			url = proto + "//static." + host;
		var s = document.createElement('script');
		s.type = 'text/javascript';
		s.async = true;
		s.src = url + '/widget-send-button/js/init.js';
		s.onload = function() {
			WhWidgetSendButton.init(host, proto, options);
		};
		var x = document.getElementsByTagName('script')[0];
		x.parentNode.insertBefore(s, x);
	})();
</script>
<!-- /GetButton.io widget -->
<?= $this->endSection() ?>