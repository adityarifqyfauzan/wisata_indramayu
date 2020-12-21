<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Wisata Indramayu - <?= $title ?></title>

	<!-- Custom fonts for this template-->
	<link href="<?= base_url() ?>/dashboard_assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?= base_url() ?>/dashboard_assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

	<div class="container">

		<div class="card col-lg-6 offset-lg-3 o-hidden border-0 shadow-lg my-5">
			<div class="card-body p-0">
				<!-- Nested Row within Card Body -->
				<div class="row">
					<div class="col-lg-12">
						<div class="p-5">
							<div class="text-center">
								<h1 class="h4 text-gray-900 mb-4"><b>Registrasi Pengelola Tempat Wisata</b></h1>
							</div>
							<form class="user" method="POST" action="<?= base_url('/pengelola/registrasi') ?>">
								<?= csrf_field() ?>
								<div class="form-group">
									<input type="text" autofocus autocomplete="off" class="form-control form-control-user <?= ($validation->hasError('nama_wisata')) ? 'is-invalid' : '' ?>" placeholder="Nama Tempat Wisata" name="nama_wisata" value="<?= old('nama_wisata') ?>">
									<div class="invalid-feedback">
										<?= $validation->getError('nama_wisata') ?>
									</div>
								</div>
								<div class="form-group">
									<select name="kategori_id" class="form-control form-control-plaintext nice-select custom-select <?= ($validation->hasError('kategori_id')) ? 'is-invalid' : '' ?>">
										<option value="">--Pilih Kategori --</option>
										<?php foreach ($kategori as $dataKategori) : ?>
											<option value="<?= $dataKategori['id'] ?>"><?= $dataKategori['kategori'] ?></option>
										<?php endforeach ?>

									</select>

									<div class="invalid-feedback">
										<?= $validation->getError('kategori_id') ?>
									</div>
								</div>
								<div class="form-group">
									<input type="email" class="form-control form-control-user <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" placeholder="Email Aktif" autocomplete="off" name="email" value="<?= old('email') ?>">
									<div class="invalid-feedback">
										<?= $validation->getError('email') ?>
									</div>
								</div>
								<div class="form-group">
									<input type="text" class="form-control form-control-user <?= ($validation->hasError('no_hp')) ? 'is-invalid' : '' ?>" placeholder="No Handphone (cth : 081xxxxxxxx)" autocomplete="off" maxlength="15" name="no_hp" value="<?= old('no_hp') ?>">
									<div class="invalid-feedback">
										<?= $validation->getError('no_hp') ?>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-6 mb-3 mb-sm-0">
										<input type="password" class="form-control form-control-user <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" placeholder="Password" name="password">
										<div class="invalid-feedback">
											<?= $validation->getError('password') ?>
										</div>
									</div>
									<div class="col-sm-6">
										<input type="password" class="form-control form-control-user <?= ($validation->hasError('ulang_password')) ? 'is-invalid' : '' ?>" placeholder="Ulangi Password" name="ulang_password">
										<div class="invalid-feedback">
											<?= $validation->getError('ulang_password') ?>
										</div>
									</div>
								</div>


								<div class="form-group">
									<label>Alamat Lengkap</label>
									<textarea name="alamat" cols="30" rows="5" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : '' ?>"><?= old('alamat') ?></textarea>

									<div class="invalid-feedback">
										<?= $validation->getError('alamat') ?>
									</div>

								</div>

								<button type="submit" class="btn btn-primary btn-user btn-block">
									Daftarkan Akun
								</button>
							</form>
							<hr>
							<div class="text-center">
								<a class="small" href="/pengelola/forgot-password">Lupa Password?</a>
							</div>
							<div class="text-center">
								<a class="small" href="/pengelola/login">Sudah Punya Akun? Login Disini!</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="<?= base_url() ?>/dashboard_assets/vendor/jquery/jquery.min.js"></script>
	<script src="<?= base_url() ?>/dashboard_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="<?= base_url() ?>/dashboard_assets/vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?= base_url() ?>/dashboard_assets/js/sb-admin-2.min.js"></script>

</body>

</html>