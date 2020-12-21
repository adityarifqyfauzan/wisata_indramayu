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
				<h2>Contact Us</h2>
			</div>
		</div>
	</div>
</section>
<!--================End Home Banner Area =================-->

<!--================Contact Area =================-->
<section class="contact_area section_gap">
	<div class="container">
		<iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBJongUi8dEP6rjYVB7he5isojyllm-q9o&q=Dinas+Kebudayaan+Indramayu" allowfullscreen>
		</iframe>

		<div class="row">
			<div class="col-lg-6">
				<div class="contact_info">
					<div class="info_item">
						<i class="lnr lnr-home"></i>
						<h6>Dinas Kebudayaan dan Pariwiwsata Kabupaten Indramayu</h6>
						<p>Jl. Gatot Subroto No. 4</p>
					</div>
					<div class="info_item">
						<i class="lnr lnr-phone-handset"></i>
						<h6><a href="#">(0234) 272325</a></h6>
						<p>Senin - Jum'at jam 08.00 WIB </p>
					</div>
					<div class="info_item">
						<i class="lnr lnr-envelope"></i>
						<h6><a href="#">Kode Pos</a></h6>
						<p>Jawa Barat, Indramayu (45213)</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</section>
<!--================Contact Area =================-->
<?= $this->endSection() ?>