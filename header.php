 <?php 
	session_start();
	include '../koneksi.php';
	if(!isset($_SESSION['status_login'])){
		echo "<script>window.location = '../login1.php?msg=Harap Login Terlebih Dahulu!'</script>";
	}

	$about = mysqli_query($conn, "SELECT * FROM tb_aboutus ORDER BY id_us DESC LIMIT 1");
	$a = mysqli_fetch_object($about);

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Panel Admin - <?= $a->nama_us ?> </title>
		<link rel="stylesheet" type="text/css" href="../assets/css/style1.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	</head>

		<!-- navbar -->
		<div class="navbar">
			
			<div class="container">

				<!-- navbar brand -->
				<h2 class="nav-brand float-left"><a href="index.php"><?= $a->nama_us ?></a></h2>

				<!-- navbar menu -->
				<ul class="nav-menu float-left">
					<li><a href="index.php">Home</a></li>
					<?php if($_SESSION['ulevel'] == 'Super Admin'){ ?>

						<li><a href="user.php">User</a></li>
						<li><a href="fasilitas.php">Fasilitas</a></li>
						<li><a href="ketersediaan.php">Ketersediaan Aula</a></li>
						<li><a href="pesan.php">Pemesanan</a></li>
						<li>
							<a href="#">About Us<i class="fa fa-caret-down"></i></a>

								<ul class="dropdown">
									<li><a href="about.php">About Us</a></li>
									<li><a href="keterangan.php">Keterangan</a></li>
								</ul>

						</li>

					<?php }elseif($_SESSION['ulevel'] == 'Admin'){ ?>

						<li><a href="fasilitas.php">Fasilitas</a></li>
						<li><a href="ketersediaan.php">Ketersediaan Aula</a></li>
						<li><a href="pesan.php">Pemesanan</a></li>
						<li>
							<a href="#">About Us<i class="fa fa-caret-down"></i></a>

								<ul class="dropdown">
									<li><a href="about.php">About Us</a></li>
									<li><a href="keterangan.php">Keterangan</a></li>
								</ul>

						</li>

					<?php } ?>
						
						<li>
							<a href="#"><?= $_SESSION['uname'] ?> (<?= $_SESSION['ulevel'] ?>) <i class="fa fa-caret-down"></i></a>

						<!-- sub menu -->
						<ul class="dropdown">
							<li><a href="ubah-password.php?id=uid">Ubah Password</a></li>
							<li><a href="logout.php">Keluar</a></li>
						</ul>
					</li>

				</ul>

				<div class="clearfix"></div>
			</div>

		</div>