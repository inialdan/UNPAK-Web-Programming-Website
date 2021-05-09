<?php
    require "config.php";
    session_start();
    date_default_timezone_set("Asia/Jakarta");

    // Memeriksa user logout atau belum login
    if(!isset($_SESSION["login"]) || isset($_GET["logout"]) || !isset($_SESSION["admin"])) {
        session_destroy();
        echo"
        <script>
            document.location.href = 'login.php';
        </script>";
    }

    $user_id = $_SESSION['login'];
    // $user = findOne("SELECT * FROM user WHERE id = '$user_id'");

    $users = findAll("SELECT * FROM user");

    // Aksi ADD USER
    if(isset($_POST["register"])) {
        $role  =  $_POST["role"];
        $username  =  $_POST["username"];
        $email  =  $_POST["email"];
        $avatar = ""; // string
        $file = $_FILES["new_avatar"]; // $file["name"];

        // $file => array asosiatif name(mungkin kosong), size, tmp_name

        // Memeriksa adanya file yang diupoload, (file baru, file lama)
        if($file["name"] != null) {
            $avatar = uploadAvatar($file, $avatar);
        }

        // Enkripsi password
        $password  =  password_hash($_POST["password"], PASSWORD_DEFAULT);

        $user  =  findOne("SELECT  *  FROM user WHERE username = '$username'");
        if($user  !=  null) {
			echo"
            <script>
                alert('Username telah terdaftar, pilih username lain');
                document.location.href = 'admin.php';
            </script>";
        }
        else {
            $create_user  =  commit("INSERT  INTO user SET  role  = '$role', username = '$username', email = '$email', password  = '$password', avatar  = '$avatar'");
            if($create_user  >  0) {
                echo"
                <script>
                    alert('Tambah Akun User berhasil');
                    document.location.href = 'admin.php';
                </script>";
            }
            else {
                echo"
                <script>
                    alert('Tambah Akun User gagal');
                    document.location.href = 'admin.php';
                </script>";
            }
        }
    }

    if(isset($_GET["delete"])) {
        $user_id = $_GET["delete"];

        $delete_user = commit("DELETE FROM user WHERE id='$user_id'");
        if($delete_user < 0) {
            echo"
            <script>
                alert('User gagal dihapus');
                document.location.href = 'admin.php';
            </script>";
        }
        echo"
        <script>
            alert('User berhasil dihapus');
            document.location.href = 'admin.php';
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
		<link href="assets/global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
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
			<section id="three" class="wrapper style2">
				<div class="inner">
					<section>
						<div class="box">
							<div class="content">
								<h2 class="align-center">Tambah Akun</h2>
								<hr />
								<form role="form" method="post" enctype="multipart/form-data">
									<center>
										<div class="field half">
											<select class="form-control" name="role">
												<option selected="" disabled="">-- Pilih Role --</option>
												<option value="admin">admin</option>
												<option value="member">member</option>
											</select>
											<div class="form-control-feedback">
												<i class="icon-user text-muted"></i>
											</div>
										</div>
										<br>
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
                                        <?php 
                                        $no = 1;
                                        foreach ($users as $user) : ?>
                                            <tr>
                                                <td width="3%"><?= $no; ?>.</td>
                                                <td>
                                                    <?php if ($user["avatar"] != null) : ?>
                                                        <img src="avatar/<?= $user["avatar"]; ?>" width="60" height="60" alt="">
                                                    <?php else : ?>
                                                        <img src="assets/images/avatar-1.png" width="60" height="60" alt="">
                                                    <?php endif; ?>

                                                </td>
                                                <td><?= $user["role"]; ?></td>
                                                <td><?= $user["username"]; ?></td>
                                                <td><?= $user["email"]; ?></td>
                                                <td class="text-center" width="15%">    
                                                    <div class="btn-group">
                                                        <a href="edit.php?user_id=<?= $user['id']; ?>" class="btn btn-success btn-xs"  data-popup="tooltip" title="Ubah Data">
                                                            <i class="icon-pencil"></i> 
                                                        </a>&nbsp;
                                                        <a href="?delete=<?= $user['id']; ?>" class="btn btn-danger btn-xs"  data-popup="tooltip" title="Hapus Data">
                                                            <i class="icon-trash"></i>
                                                        </a>&nbsp;
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php 
                                            $no++;
                                        endforeach; ?>
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