<?php
    require "config.php";
    session_start();

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
    $posts = findAll("SELECT * FROM post WHERE user_id='$user_id' ORDER BY created_at DESC");

    // Memeriksa method post yang dikirim ke halaman ini
    if(isset($_POST["update"])) {
        $user_id = $_POST["id"];
        $username = $_POST["username"];
        $email = $_POST["email"];

        $exist = findOne("SELECT * FROM user WHERE username = '$username'");
        if($username != $user["username"] && $exist != null) {
            echo"
            <script>
                alert('Username telah terdaftar, pilih username lain');
                document.location.href = 'profile.php';
            </script>";
        }
        else {
            $update_user = commit("UPDATE user SET username = '$username', email = '$email' WHERE id = '$user_id'");
            if($update_user > 0) {
                echo"
                <script>
                    alert('Profile berhasil diubah');
                    document.location.href = 'profile.php';
                </script>";
            }
            else {
                echo"
                <script>
                    alert('Profile gagal diubah');
                    document.location.href = 'profile.php';
                </script>";
            }
        }
    }

    // Memeriksa method get yang dikirim ke halaman ini
    if(isset($_GET["delete"])) {
        $post_id = $_GET["delete"];

        $delete_post = commit("DELETE FROM post WHERE id='$post_id'");
        if($delete_post < 0) {
            echo"
            <script>
                alert('Post gagal dihapus');
                document.location.href = 'profile.php';
            </script>";
        }
        echo"
        <script>
            alert('Post berhasil dihapus');
            document.location.href = 'profile.php';
        </script>";
    }
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Profile</title>
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
				<li><a href="?logout">Logout</a></li>
			</ul>
		</nav>

		<section id="three" class="wrapper style">
			<div class="inner">
				<section>
					<div class="box">
						<div class="content">
							<h2 class="align-center">Profile</h2>
							<hr />
							<form method="post" enctype="multipart/form-data">
								<center>
									<input value="<?= $user["id"]; ?>" type="hidden" name="id">
									<div class="card-profile-image mt-3">
										<a href="javascript:;">
									
										<?php if($user["avatar"] != null) : ?>
											<img src="avatar/<?= $user["avatar"]; ?>" class="rounded-circle" width="170" height="170">
										<?php else : ?>
											<img src="assets/img/faces/team-1.jpg" class="rounded-circle" width="170" height="170">
										<?php endif; ?>
											
										</a>
									</div>
									<div class="text-center mt-9">
										<h3><?= $user["username"]; ?></h3>
										<div class="h6 font-weight-300"><?= $user["email"]; ?></div>
									</div>
									<br/>
									<div class="field half">
										<input name="username" value="<?= $user["username"]; ?>" id="username" type="text" placeholder="Username">
									</div>
									<br>
									<div class="field half">
										<input name="email" value="<?= $user["email"]; ?>" id="email" type="email" placeholder="Email">
									</div>
									<br>
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="customFile"
											name="new_avatar">
										<label class="custom-file-label" for="customFile">Pilih gambar</label>
									</div>
									<br/>
									<ul class="actions align-center">
										<li><input name="update" value="Simpan" class="button special" type="submit"></li>
									</ul>
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