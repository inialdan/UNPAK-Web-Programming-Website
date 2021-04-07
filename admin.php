<?php
	require "config.php";
	session_start();

	// Memeriksa user logout atau belum login
	if(!isset($_SESSION["login"]) || isset($_GET["logout"]) || !isset($_SESSION["admin"])) {
		session_destroy();
		echo"
		<script>
			document.location.href = 'login.php';
		</script>";
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
					<li><a href="index.php">Home</a></li>
					<li><a href="login.php">Login</a></li>
					<li><a href="register.php">Register</a></li>
					<li><a href="generic.html">Generic</a></li>
					<li><a href="elements.html">Elements</a></li>
				</ul>
			</nav>
			<section id="three" class="wrapper style2">
				<div class="inner">
					<section>
						<div class="box">
							<div class="content">
								<h2 class="align-center">Tambah Akun</h2>
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
										<br>
										<div class="field half">
											<input type="file" class="custom-file-input" id="customFile" name="new_avatar" placeholder="Foto">
										</div>
										<ul class="actions align-center">
											<li>
												<input name="register" value="Tambahkan Akun" class="button special" type="submit">
											</li>
										</ul>
									</center>
								</form>
							</div>

							<center>
							<h4>Data User</h4>
							<div class="table-wrapper">
								<table class="alt">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th>Avatar</th>
											<th>Role</th>
											<th>Username</th>
											<th>Email</th>
											<th>Opsi</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center align-middle">1</td>
											<td class="align-middle">
												<img src="assets/img/faces/team-1.jpg" alt="Rounded image" class="rounded shadow"
													width="70" height="70">
											</td>
											<td class="align-middle">member</td>
											<td class="align-middle">Harlequin</td>
											<td class="align-middle">harle@quin.oke</td>
											<td class="align-middle">
												<a type="button" rel="tooltip" class="btn btn-info btn-icon btn-sm mt-1" href="###">
													<i class="ni ni-settings-gear-65 pt-1 text-white"></i>
												</a>
												<a type="button" rel="tooltip" class="btn btn-danger btn-icon btn-sm mt-1 mr-2"
													href="###">
													<i class="ni ni-fat-remove pt-1 text-white"></i>
												</a>
											</td>
										</tr>
										<tr>
											<td class="text-center align-middle">2</td>
											<td class="align-middle">
												<img src="assets/img/faces/team-1.jpg" alt="Rounded image" class="rounded shadow"
													width="70" height="70">
											</td>
											<td class="align-middle">member</td>
											<td class="align-middle">Harlequin</td>
											<td class="align-middle">harle@quin.oke</td>
											<td class="align-middle">
												<a type="button" rel="tooltip" class="btn btn-info btn-icon btn-sm mt-1" href="###">
													<i class="ni ni-settings-gear-65 pt-1 text-white"></i>
												</a>
												<a type="button" rel="tooltip" class="btn btn-danger btn-icon btn-sm mt-1 mr-2"
													href="###">
													<i class="ni ni-fat-remove pt-1 text-white"></i>
												</a>
											</td>
										</tr>
										<tr>
											<td class="text-center align-middle">3</td>
											<td class="align-middle">
												<img src="assets/img/faces/team-1.jpg" alt="Rounded image" class="rounded shadow"
													width="70" height="70">
											</td>
											<td class="align-middle">member</td>
											<td class="align-middle">Harlequin</td>
											<td class="align-middle">harle@quin.oke</td>
											<td class="align-middle">
												<a type="button" rel="tooltip" class="btn btn-info btn-icon btn-sm mt-1" href="###">
													<i class="ni ni-settings-gear-65 pt-1 text-white"></i>
												</a>
												<a type="button" rel="tooltip" class="btn btn-danger btn-icon btn-sm mt-1 mr-2"
													href="###">
													<i class="ni ni-fat-remove pt-1 text-white"></i>
												</a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							</center>
							
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