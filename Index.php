<?php
	include 'koneksi.php';
	
	$about = mysqli_query($conn, "SELECT * FROM tb_aboutus ORDER BY id_us DESC LIMIT 1");
	$a = mysqli_fetch_object($about);

?>

<!DOCTYPE html>
<html>
<head>
	<title><?= $a->nama_us ?></title>
	<link rel="stylesheet" type="text/css" href="assets/css/style1.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<?php include 'header.php'; ?>

	<!-- bagian banner -->
	<div class="banner">
		<div class="banner-text">
			<div class="container">
				<h3>Selamat Datang di <?= $a->nama_us ?></h3>
				<p>Pantai Indah dengan berbagai fasilitas di dalamnya.</p>
			</div>
		</div>
	</div>

	<!-- bagian Galeri -->
	<div class="section">

		<div class="container text-center">
			<img src="upload/about_us/<?= $a->logo_us ?>" width="90">
			<h1>Pantai Glory Melur</h1>

			<p><?= $a->ket_us ?></p>
			
		</div>

	</div>

	<div class="section">

		<div class="container text-center">
			<h1>Daftar Harga Tiket</h1>
			<a href="upload/galeri/daftarharga.jpeg"><img src="upload/galeri/daftarharga.jpeg" width="500"></a>
		
		</div>

	</div>	

	<div class="section">

		<div class="container text-center">
			<h1>Galeri</h1>
			<a href="upload/galeri/glory5.jpeg"><img src="upload/galeri/glory5.jpeg" width="300"></a>
			<a href="upload/galeri/glory1.jpeg"><img src="upload/galeri/glory1.jpeg" width="300"></a>
			<a href="upload/galeri/glory2.jpeg"><img src="upload/galeri/glory2.jpeg" width="400"></a>
			<a href="upload/galeri/glory3.jpeg"><img src="upload/galeri/glory3.jpeg" width="300"></a>
			<a href="upload/galeri/glory4.jpeg"><img src="upload/galeri/glory4.jpeg" width="330"></a>
			<a href="upload/galeri/glory6.jpeg"><img src="upload/galeri/glory6.jpeg" width="300"></a>
		</div>

	</div>

<?php include 'footer.php' ?>
	