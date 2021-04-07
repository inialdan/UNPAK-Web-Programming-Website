<?php
	require "config.php";
	session_start();
	date_default_timezone_set("Asia/Jakarta");

	// Memeriksa user logout atau belum login
	if(!isset($_SESSION["login"]) || isset($_GET["logout"])) {
		session_destroy();
		echo"
		<script>
			document.location.href = 'login.php';
		</script>";
	}

	$user_id = $_SESSION["login"];
	$user = findOne("SELECT * FROM user WHERE id = '$user_id'");

	// Relasi antara tabel user dan post
	$posts = findAll("SELECT u.*, p.* FROM post p INNER JOIN user u WHERE p.user_id=u.id ORDER BY created_at DESC");
		
	// Memeriksa method post yang dikirim ke halaman ini
	if(isset($_POST["post"])) {
		$content = $_POST["content"];
		$created_at = date("Y-m-d H:i:s");

		$create_post = commit("INSERT INTO post SET user_id='$user_id', content='$content', created_at='$created_at'");
		if($create_post < 0) {
			echo"
			<script>
				alert('Post gagal dikirim');
				document.location.href = 'home.php';
			</script>";
		}
		echo"
		<script>
			document.location.href = 'home.php';
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
					<li><a href="profile.php">Profile</a></li>
					<li><a href="?logout">Logout</a></li>
				</ul>
			</nav>

			<section id="one" class="wrapper style">
				<div class="inner">
					<section>
						<div class="box">
							<div class="content">
								<h2 class="align-center">Hi, Kamu</h2>
								<hr />
								<form action="#" method="post">
									<center>
										Ceritakan Harimu <br/>
										<div class="field">
											<label for="content">Pesan</label>
											<textarea name="content" id="message" rows="6" placeholder="Ceritakan harimu disini ya"></textarea>
										</div>
										<ul class="actions align-center">
											<li>
												<input name="post" value="Bagikan" class="button special" type="submit">
											</li>
										</ul>
									</center>
								</form>
							</div>
						</div>
					</section>
				</div>
			</section>

			<section id="one" class="wrapper style3">
				<div class="inner">
					<div class="grid-style">

					<?php foreach($posts as $post) : ?>

						<div>
							<div class="box">
								<div class="content">
									<div class="row py-3 align-items-center">
										<div class="col-sm-3 text-center">

											<?php if($post["avatar"] != null) : ?>
												<img src="avatar/<?= $post["avatar"]; ?>" alt="Rounded image" class="img-fluid rounded shadow"
													width="120">
											<?php else : ?>
												<img src="assets/img/faces/team-1.jpg" alt="Rounded image" class="img-fluid rounded shadow"
													width="120">
											<?php endif; ?>
													
										</div>
										<div class="col-sm-9">
											<p class="font-weight-bold">
												<?= $post["username"]; ?><br/>
												<small class="text-muted"><?= $post["created_at"]; ?></small>
											</p>
											<p>
												<?= $post["content"]; ?>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>

					</div>
				</div>
			</section>

			<footer id="footer" class="wrapper">
				<div class="inner">
					<div class="copyright">
						&copy; Universitas Pakuan - Web Programming
					</div>
				</div
			</footer>

			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>