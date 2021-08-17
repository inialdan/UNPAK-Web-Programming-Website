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

    $user_id = $_GET["user_id"];
    $user = findOne("SELECT * FROM user WHERE id = '$user_id'");

    // Memeriksa method post yang dikirim ke halaman ini
    if(isset($_POST["update"])) {
        $user_id = $_POST["id"];
        $role  =  $_POST["role"];
        $username = $_POST["username"];
        $password = $_POST["password"];
		$email = $_POST["email"]; // string
        $avatar = $_POST["old_avatar"]; // string
        $file = $_FILES["new_avatar"]; // $file["name"];

        // $file => array asosiatif name(mungkin kosong), size, tmp_name

        // Memeriksa adanya file yang diupoload, (file baru, file lama)
        if($file["name"] != null) {
            $avatar = uploadAvatar($file, $avatar);
        }

        if ($password!="") {
            $password  =  password_hash($_POST["password"], PASSWORD_DEFAULT);
            $update_user = commit("UPDATE user SET role = '$role', username = '$username', password = '$password', email = '$email', avatar = '$avatar' WHERE id = '$user_id'");            
        } else {
            $update_user = commit("UPDATE user SET role = '$role', username = '$username', email = '$email', avatar = '$avatar' WHERE id = '$user_id'");            
        }

        if($update_user > 0) {
            echo"
            <script>
                alert('User berhasil diubah');
                document.location.href = 'admin.php';
            </script>";
        }
        else {
            echo"
            <script>
                alert('User gagal diubah');
                document.location.href = 'admin.php';
            </script>";
        }
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
									<input value="<?= $user["avatar"]; ?>" type="hidden" name="old_avatar">
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
                                        <select class="form-control" name="role">
                                            <?php
                                            if ($user["role"]=="admin") {
                                                $opt1 = "selected";
                                                $opt2 = "";
                                            } else {
                                                $opt1 = "";
                                                $opt2 = "selected";
                                            }
                                            ?>
                                            <option disabled="">-- Pilih Role --</option>
                                            <option value="admin" <?= $opt1; ?> >admin</option>
                                            <option value="member" <?= $opt2; ?>>member</option>
                                        </select>
                                        <div class="form-control-feedback">
                                            <i class="icon-user text-muted"></i>
                                        </div>
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
                                    <div class="field half">
                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                        <div class="form-control-feedback">
                                            <i class="icon-lock2 text-muted"></i>
                                        </div>
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