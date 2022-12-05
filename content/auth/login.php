<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../../config/koneksi.php');

session_start();

$title = "SISTEM PAKAR MENDIAGNOSA HAMA DAN PENYAKIT TANAMAN TEMBAKAU MENGGUNAKAN METODE CERTAINTY FACTOR";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>LOGIN .:. <?= $title ?></title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">

	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="../../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

	<!-- Theme style -->
	<link rel="stylesheet" href="../../assets/admin/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<!-- <a href="../../index2.html"><b>Admin</b>LTE</a> -->
		</div>

		<!-- cek login, jika login maka lempar ke admin -->
		<?php
		if (isset($_SESSION['auth'])) :
		?>
			<div class="alert alert-success">
				<strong>Login Berhasil!</strong> <i class="fas fa-spinner fa-pulse float-right mt-1"></i>
			</div>
		<?php
			header("refresh:1.5; url=../admin/content.php");
		endif;
		?>
		<!-- cek login, jika login maka lempar ke admin -->

		<!-- cek pesan error -->
		<?php
		if (isset($_SESSION['response'])) :
			if ($_SESSION['response']['status'] == 'error' || $_SESSION['response']['status'] == 'error_login') :
		?>
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

					<h5><i class="icon fas fa-ban"></i> Login Gagal!</h5>

					Silahkan cek kembali email dan password anda!
				</div>
		<?php
			endif;

			// hapus session error
			unset($_SESSION['response']);
		endif;
		?>
		<!-- cek pesan error -->

		<!-- post form -->
		<?php
		if (isset($_POST['submit'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];

			// echo "<pre>";
			// print_r($_POST);
			// echo "</pre>";

			// cek username dan password
			$query = $koneksi->query("SELECT * FROM tbl_login where username='" . $username . "' AND password='" . $password . "'");
			if ($query->num_rows  > 0) :
				$data_user = $query->fetch_array();

				$_SESSION['auth'] = [
					'status' => 'login',
					'id' => $data_user['id'],
					'username' => $data_user['username'],
					'nama' => $data_user['nama'],
				];

				setcookie('username', $data_user['username'], time() + (60 * 60 * 24 * 5), '/');
				setcookie('nama', $data_user['nama'], time() + (60 * 60 * 24 * 5), '/');

				header('location: login.php');
			else :
				$_SESSION['response'] = ['status' => 'error_login'];
				header('location: login.php');
			endif;

			$koneksi->close();
		}
		?>
		<!-- post form -->

		<!-- /.login-logo -->
		<div class="card bg-gradient-warning">
			<div class="card-header text-center">
				<h4>Silahkan Login Terlebih Dahulu..!</h4>
			</div>

			<div class="card-body login-card-body">
				<!-- <p class="login-box-msg">Sign in to start your session</p> -->

				<form action="login.php" method="post">
					<div class="input-group mb-3">
						<input type="text" class="form-control" id="username" name="username" placeholder="Username">

						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>

					<div class="input-group mb-3">
						<input type="password" class="form-control" id="password" name="password" placeholder="Password">

						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-8">
							<div class="icheck-primary">
								<input type="checkbox" id="remember" checked>
								<label for="remember">
									Remember Me
								</label>
							</div>
						</div>
						<!-- /.col -->

						<div class="col-4">
							<button type="submit" class="btn btn-warning btn-block btn-flat" name="submit">Sign In</button>
						</div>
						<!-- /.col -->
					</div>
				</form>

				<p class="mb-0">
					<a href="../../index.php">Home</a>
				</p>
			</div>
			<!-- /.login-card-body -->
		</div>
	</div>
	<!-- /.login-box -->

	<!-- jQuery -->
	<script src="../../assets/plugins/jquery/jquery.min.js"></script>

	<!-- Bootstrap 4 -->
	<script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- AdminLTE App -->
	<script src="../../assets/admin/js/adminlte.min.js"></script>
</body>

</html>