<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="<?= base_url() ?>/general_assets/img/logoc.png" type="image/png">
	<title>Wisata Indramayu - <?= $title ?></title>

	<!-- Custom fonts for this template-->
	<link href="<?= base_url() ?>/dashboard_assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?= base_url() ?>/dashboard_assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

	<div class="container">

		<!-- Outer Row -->
		<div class="row justify-content-center">

			<div class="col-xl-6 col-lg-6 col-md-9">

				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"><b>Login Pengelola</b></h1>
									</div>

									<?php if (session()->getFlashdata('error')) { ?>

										<div class="alert alert-danger" role="alert">
											<?= session()->getFlashdata('error') ?>
										</div>

									<?php } ?>

									<?php if (session()->getFlashdata('success')) { ?>

										<div class="alert alert-success" role="alert">
											<?= session()->getFlashdata('success') ?>
										</div>

									<?php } ?>

									<form class="user" method="POST" action="<?= base_url('/pengelola/login') ?>">
										<?= csrf_field() ?>
										<div class="form-group">
											<input type="text" name="email" class="form-control 
											<?= ($validation->hasError('email') ? 'is-invalid' : '') ?>
											form-control-user" placeholder="Enter email" value="<?= old('email') ?>">
											<div class="invalid-feedback">
												<?= $validation->getError('email') ?>
											</div>
										</div>

										<div class="form-group">
											<input type="password" name="password" class="form-control form-control-user
											<?= ($validation->hasError('password') ? 'is-invalid' : '') ?>
											" placeholder="Password">
											<div class="invalid-feedback">
												<?= $validation->getError('password') ?>
											</div>
										</div>

										<button type="submit" class="btn btn-primary btn-user btn-block mb-2">
											Login
										</button>
									</form>
									<div class="text-center">
										<a class="small" href="<?= base_url() ?>/pengelola/lupa-password">Lupa Password?</a>
									</div>
									<div class="text-center">
										<a class="small" href="/pengelola/registrasi">Belum Punya Akun? Registrasi Disini!</a>
									</div>
								</div>
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