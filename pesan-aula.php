<?php include 'header.php' ?>

<?php
	include 'koneksi.php';
	
	$pesanan = mysqli_query($conn, "SELECT * FROM tb_pemesan ORDER BY id_pemesan DESC LIMIT 1");
	$n = mysqli_fetch_object($pesanan);

?>

		<!-- content -->
		<div class="content">
			
			<div class="container">
				
				<div class="box">
					
					<div class="box-header">
						Form Pemesanan Aula
					</div>

					<div class="box-body">		

						<?php 
							if(isset($_GET['success'])){
								echo "<div class='altert altert-success'>".$_GET['success']."</div>";
							}
						?>

						<div class="rekening">

							<div class="container text-center">
								<p><b> Transfer ke No. Rek BCA</b></p>
								<p><b>098776553264 a/n Gomo</b></p>
								<p>DP Aula S = Rp. 200.000</p>
								<p>DP Aula L = Rp. 500.000</p>
								
							</div>

						</div>

					<div class="box-body">

						<form action="" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label>Tanggal</label>
								<input type="date" name="tgl_pesanan" placeholder="Pilih Tanggal" class="input-control" required>
							</div>

							<div class="form-group">
								<label>Nama Pemesan</label>
								<input type="text" name="name_pemesan" placeholder="Nama Lengkap/Nama Organisasi" class="input-control" required>
							</div>

							<div class="form-group">
								<label>No Whatsapp</label>
								<input type="text" name="no_hp" placeholder="No Whatsapp" class="input-control" required>
							</div>


							<div class="form-group">
								<label>Tipe Aula</label>
								<select name="tipeaula_" class="input-control" required>
									<option value="Pilih Tipe Aula">Pilih Tipe Aula</option>
									<option value="S No 1" <?= ($n->tipeaula_ == 'S 1')? 'selected':''; ?>>S No 1</option>
									<option value="S No 2" <?= ($n->tipeaula_ == 'S 2')? 'selected':''; ?>>S No 2</option>
									<option value="L No 1" <?= ($n->tipeaula_ == 'L 1')? 'selected':''; ?>>L No 1</option>
									<option value="L No 2" <?= ($n->tipeaula_ == 'L 2')? 'selected':''; ?>>L No 2</option>
									<option value="L No 3" <?= ($n->tipeaula_ == 'L 3')? 'selected':''; ?>>L No 3</option>
									<option value="L No 4" <?= ($n->tipeaula_ == 'L 4')? 'selected':''; ?>>L No 4</option>
									<option value="L No 5" <?= ($n->tipeaula_ == 'L 5')? 'selected':''; ?>>L No 5</option>
									<option value="L No 6" <?= ($n->tipeaula_ == 'L 6')? 'selected':''; ?>>L No 6</option>
								</select>
							</div>

							<div class="form-group">
								<label>Upload Bukti Transfer</label>
								<input type="file" name="bukti_pembayaran" class="input-control" required>
							</div>

							<button type="button" class="btn" onclick="window.location = 'ketersediaan-aula.php'">Kembali</button>
							<input type="submit" name="submit" value="Pesan" class="btn btn-blue">

						</form>

						<?php
						if(isset($_POST['submit'])) {
							$tanggal  	= addslashes($_POST['tgl_pesanan']);
							$nama  	= addslashes(ucwords($_POST['name_pemesan']));
							$no_wa  	= addslashes($_POST['no_hp']);
							$tipe_aula  	= addslashes($_POST['tipeaula_']);
							$disetujui 	= 0;

							$filename_bukti  	= $_FILES['bukti_pembayaran']['name'];
							$tmpname_bukti  	= $_FILES['bukti_pembayaran']['tmp_name'];
							$filesize_bukti 	= $_FILES['bukti_pembayaran']['size'];

							$formatfile_bukti = pathinfo($filename_bukti, PATHINFO_EXTENSION);
							$rename_bukti		= 'tb_pemesan'.time().'.'.$formatfile_bukti;


							$allowedtype_bukti = array('png', 'jpg', 'jpeg', 'gif');

							if(!in_array($formatfile_bukti, $allowedtype_bukti)) {
								echo '<div class="alert alert-error">Format file tidak diizinkan.</div>';
							} elseif($filesize_bukti > 1000000) {
								echo '<div class="alert alert-error">Ukuran file tidak boleh lebih dari 1 MB.</div>';
							} else {
								move_uploaded_file($tmpname_bukti, "upload/pesanan/".$rename_bukti);

								$simpan = mysqli_query($conn, "INSERT INTO tb_pemesan (tgl_pesanan, name_pemesan, no_hp, tipeaula_, bukti_pembayaran, disetujui) VALUES (
										'".$tanggal."',
										'".$nama."',
										'".$no_wa."',
										'".$tipe_aula."',
										'".$rename_bukti."',
										'".$disetujui."'

									)");
							}

							if($simpan) {
								echo '<div class= "alert alert-success">Pemesanan anda sedang diproses</div>';
							} else {
								echo 'Gagal Simpan' .mysqli_error($conn);
							}	

						}

							// if(isset($_POST['submit'])){

							// 	//print_r($FILES['gambar']);

							// 	$tanggal  	= addslashes($_POST['tgl_pesanan']);
							// 	$nama  	= addslashes(ucwords($_POST['name_pemesan']));
							// 	$tipe_aula  	= addslashes($_POST['tipeaula_']);

							// 	$filename_bukti  	= $_FILES['bukti_pembayaran']['name'];
							// 	$tmpname_bukti  	= $_FILES['bukti_pembayaran']['tmp_name'];
							// 	$filesize_bukti 	= $_FILES['bukti_pembayaran']['size'];

							// 	$formatfile_bukti = pathinfo($filename_bukti, PATHINFO_EXTENSION);
							// 	$rename_bukti		= 'tb_pemesan'.time().'.'.$formatfile_bukti;


							// 	$allowedtype_bukti = array('png', 'jpg', 'jpeg', 'gif');


							// 		if(!in_array($formatfile_bukti, $allowedtype_bukti)){

							// 			echo '<div class="alert alert-error">Format file tidak diizinkan.</div>';

							// 		}elseif($filesize_bukti > 1000000){
								
							// 		echo '<div class="alert alert-error">Ukuran file tidak boleh lebih dari 1 MB.</div>';

							// 		}else{
							// 		move_uploaded_file($tmpname_bukti, "../upload/pesanan/".$rename_bukti);

							// 		//move_uploaded_file($tmpname_bukti, "../upload/bukti_transfer/".$rename_bukti);

							// 		$simpan = mysqli_query($conn, "INSERT INTO tb_pesanan (tgl_pesanan, name_pemesan, tipeaula, bukti_pembayaran) VALUES (
							// 				'".$tanggal."',
							// 				'".$nama."',
							// 				'".$tipe_aula."',
							// 				'".$rename_bukti."'
							// 		)");

							// 	if($simpan){
							// 				echo '<div class= "alert alert-success">Berhasil Disimpan</div>';
							// 	}else{
							// 		echo 'Gagal Simpan' .mysqli_error($conn);
							// 	}

							// 	}	

							// }

						?>

					</div>

				</div>

			</div>

		</div>

<?php include 'footer.php' ?>	