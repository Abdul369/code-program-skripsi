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
<body>

<?php include 'header.php' ?>

<?php
	include 'koneksi.php';
	
	$pemesanan = mysqli_query($conn, "SELECT * FROM tb_pemesan WHERE disetujui= '1'");
	$p = mysqli_fetch_object($pemesanan);

?>
		<!-- content -->
		<div class="fasilitas">
			<div class="container text-center">
				<h2>Gambar Aula</h2>
					<div class="gambarl">
						<h4>Aula Tipe S</h4>
						<a href="fasilitas/aula S.jpeg"><img src="fasilitas/aula S.jpeg" width="300"></a>
						<p>Harga : Rp 600.000</p>
						<p>Include : Tikar, Grill, Speacer & Mic
						</p>
						<p>Ukuran : 5 X 10 M</p>
					</div>
			
					<div class="gambarr">
						<h4>Aula Tipe L</h4>
						<a href="fasilitas/aula L.jpeg"><img src="fasilitas/aula L.jpeg" width="300"></a>
						<p>Harga : Rp 1.200.000</p>
						<p>Include : Tikar, Grill, Speacer & Mic
						</p>
						<p>Ukuran : 6 X 15 M</p>
					</div>

			</div>
		</div>


		<div class="fasilitas">
			<div class="container text-center">
				<h2>Pemesanan Aula</h2>
				<div class="content">

					<div class="container">

						<div class="box">

							<div class="box-header">
								Ketersediaan Aula
							</div>
							
							<div class="box-body">		

								<?php 
									if(isset($_GET['success'])){
										echo "<div class='altert altert-success'>".$_GET['success']."</div>";
									}
								?>

								<form action="">
									<div class="input-tgl">
										<input type="date" name="key" placeholder="Tanggal" required>
										<button type="submit">Cari</i></button>
									</div>	
								</form>


								<div class="section">

									<div class="container text-center">
										<p>Informasi Ketersediaan Aula</p>
									</div>

								</div>



								<table class="table">
									<thead>
										<tr>
											<th>No</th>
											<th>Tanggal</th>
											<th>Nama Pemesan</th>
											<th>Tipe Aula</th>
											
										</tr>
									</thead>

									<tbody>
										<?php
										$no = 1;

										$where = " WHERE 1=1 ";
										if(isset($_GET['key'])){
											$where .= " AND tgl_pesanan LIKE '%".addslashes($_GET['key'])."%' ";
										}

										$pemesanan = mysqli_query($conn, "SELECT * FROM tb_pemesan WHERE disetujui= '1'");
										if(mysqli_num_rows($pemesanan) > 0){
											while($p = mysqli_fetch_array($pemesanan)){
										?>

										<tr>
											<td><?= $no++ ?></td>
											<td>
												<?php 
													if(isset($p['tgl_pesanan'])) {
														echo $p['tgl_pesanan'];
													} else { 
														echo "-";
													}
												?>
											</td>
											<td>
												<?php 
													if(isset($p['name_pemesan'])) {
														echo $p['name_pemesan'];
													} else { 
														echo "";
													}
												?>
											</td>
											<td>
												<?php 
													if(isset($p['tipeaula_'])) {
														echo $p['tipeaula_'];
													} else { 
														echo "";
													}
												?></td>
											
										</tr>


									<?php }}else{ ?>

										<tr>
											<th>
												<td colspan="4">Data tidak ada</td>
											</th>
										</tr>
									<?php } ?>
									</tbody>
								</table>

									<div class="text-center">
									<button type="button" class="btn btn-blue" onclick="window.location = 'pesan-aula.php'">Pesan Aula</button>
									</div>
							</div>

						</div>
						
					</div>
					
				</div>

			</div>

		</div>

<?php include 'footer.php' ?>