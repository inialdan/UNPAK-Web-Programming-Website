<?php
 	require "config.php";

 	// Memeriksa method post yang dikirim ke halaman ini
 	if(isset($_POST["register"])) {
 		$username = $_POST["username"];
 		$email = $_POST["email"];

 		// Enkripsi password
 		$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

 		$user = findOne("SELECT * FROM user WHERE username = '$username'");
 		if($user != null) {
 			echo"
 			<script>
 				alert('Username telah terdaftar, pilih username lain');
 				document.location.href = 'register.php';
 			</script>";
 		}
 		else {
 			$create_user = commit("INSERT INTO user SET role = 'member', username = '$username', email = '$email', password = '$password'");
 			if($create_user > 0) {
 				echo"
 				<script>
 					alert('Register berhasil');
 					document.location.href = 'login.php';
 				</script>";
 			}
 			else {
 				echo"
 				<script>
 					alert('Register gagal');
 					document.location.href = 'register.php';
 				</script>";
 			}
 		}
 	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Web Programming</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>
					<!-- Header -->
			<header id="header" class="alt">
				<div class="logo"><a href="index.html">Web Programming <span>Kelompok 1</span></a></div>
				<a href="#menu" class="toggle"><span>Menu</span></a>
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<li><a href="home.php">Home</a></li>
					<li><a href="login.php">Login</a></li>
					<li><a href="register.php">Register</a></li>
				</ul>
			</nav>
			<section id="three" class="wrapper style2">
				<div class="inner">
					<section>
						<div class="box">
							<div class="content">
								<h2 class="align-center">Daftar</h2>
								<hr />
								<form role="form" method="post">
									<center>
										<div class="field half">
											<input name="username" id="username" type="text" placeholder="Username">
										</div>
										<br>
										<div class="field half">
											<input name="email" id="email" type="email" placeholder="Email">
										</div>
										<br>
										<div class="field half">
											<input name="password" id="password" type="password" placeholder="Password">
										</div>
										<ul class="actions align-center">
											<li>
												<input name="register" value="Daftar" class="button special" type="submit">
											</li>
										</ul>
										<a href="login.php">Sudah punya akun?</a>
									</center>
								</form>
							</div>
						</div>
					</section>
					<div class="copyright">
						&copy; Universitas Pakuan - Web Programming
					</div>
				</div>
			</section>

			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>