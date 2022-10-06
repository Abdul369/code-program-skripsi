<?php include 'header.php' ?>

<?php 
	$tb_pemesanan 	= mysqli_query($conn, "SELECT * FROM tb_pemesanan WHERE id_pemesanan = '".$_GET['id']."' ");

	if(mysqli_num_rows($tb_pemesanan) == 0 ){
		echo "<script>window.location='ketersediaan.php'</script>";
	}

	$p			= mysqli_fetch_object($tb_pemesanan);

	$oldFile = '';

?>

		<!-- content -->
		<div class="content">
			
			<div class="container">
				
				<div class="box">
					
					<div class="box-header">
						Edit Pesanan
					</div>

					<div class="box-body">
						
							<form action="" method="POST" enctype="multipart/form-data">
								<div class="form-group">
									<label>Tanggal</label>
									<input type="date" name="tgl_pemesan" placeholder="tanggal" value="<?= $p->tgl_pemesan?>" class="input-control" required>
								</div>

								<div class="form-group">
									<label>Tipe Aula</label>
									<select name="tipe_aula" class="input-control" required>
										<option value="">Pilih Tipe Aula</option>
										<option value="S 1" <?= ($p->tipe_aula == 'S 1')? 'selected':''; ?>>S 1</option>
										<option value="S 2" <?= ($p->tipe_aula == 'S 2')? 'selected':''; ?>>S 2</option>
										<option value="L 1" <?= ($p->tipe_aula == 'L 1')? 'selected':''; ?>>L 1</option>
										<option value="L 2" <?= ($p->tipe_aula == 'L 2')? 'selected':''; ?>>L 2</option>
										<option value="L 3" <?= ($p->tipe_aula == 'L 3')? 'selected':''; ?>>L 3</option>
										<option value="L 4" <?= ($p->tipe_aula == 'L 4')? 'selected':''; ?>>L 4</option>
										<option value="L 5" <?= ($p->tipe_aula == 'L 5')? 'selected':''; ?>>L 5</option>
										<option value="L 6" <?= ($p->tipe_aula == 'L 6')? 'selected':''; ?>>L 6</option>
									</select>
								</div>

								<div class="form-group">
									<label>Nama Pemesan</label>
									<input type="text" name="nama_pemesan" placeholder="Nama Lengkap/Nama Organisasi" value="<?= $p->nama_pemesan?>" class="input-control" required>
								</div>

								<div class="form-group">
									<label>Nomor Whatsapp</label>
									<input type="text" name="no_wa" placeholder="No Whatsapp" class="input-control" required>
								</div>

								<div class="form-group">
									<label>DP Pemesan</label>
									<input type="text" name="dp_pemesanan" placeholder="DP" value="<?= $p->dp_pemesanan?>" class="input-control" required>
								</div>

								<div class="form-group">
									<label>Sisa Pembayaran</label>
									<input type="text" name="sisa_pembayaran" placeholder="Sisa Pembayaran" value="<?= $p->sisa_pembayaran?>" class="input-control" required>
								</div>

								<div class="form-group">
									<label>Gambar</label>
									<img src="../upload/bukti_transfer/<?= $p->bukti_transfer?>" widht="200" class="">
									<input type="hidden" name="bukti_transfer2" value="<?= $p->bukti_transfer?>">
									<input type="file" name="bukti_transfer" class="input-control"> 
								</div>

								<button type="button" class="btn" onclick="window.location = 'ketersediaan.php'">Kembali</button>
								<input type="submit" name="submit" value="Simpan" class="btn btn-blue">

							</form>

						<?php

							if(isset($_POST['submit'])){

								//print_r($FILES['gambar']);

								$tanggal  	= addslashes($_POST['tgl_pemesan']);
								$tipe_aula  	= addslashes(ucwords($_POST['tipe_aula']));
								$nama  	= addslashes(ucwords($_POST['nama_pemesan']));
								$no_wa  = addslashes($_POST['no_wa']);
								$dp  	= addslashes($_POST['dp_pemesanan']);
								$sisa  	= addslashes($_POST['sisa_pembayaran']);

								if($_FILES['bukti_transfer']['name'] != ''){

									$filename_bukti  	= $_FILES['bukti_transfer']['name'];
									$tmpname_bukti  	= $_FILES['bukti_transfer']['tmp_name'];
									$filesize_bukti 	= $_FILES['bukti_transfer']['size'];

									$formatfile_bukti = pathinfo($filename_bukti, PATHINFO_EXTENSION);
									$rename_bukti		= 'tb_pemesanan'.time().'.'.$formatfile_bukti;


									$allowedtype_bukti = array('png', 'jpg', 'jpeg', 'gif');


									if(!in_array($formatfile_bukti, $allowedtype_bukti)){

										echo '<div class="alert alert-error">Format file tidak diizinkan.</div>';

									}elseif($filesize_bukti > 1000000){
									
										echo '<div class="alert alert-error">Ukuran file tidak boleh lebih dari 1 MB.</div>';

									}else{

										// if(file_exists("../upload/bukti_transfer/" . $_POST['bukti_transfer'])){
											if(file_exists("../upload/bukti_transfer/" . $oldFile)){

												// unlink("../upload/bukti_transfer/" . $_POST['bukti_transfer2']);
												unlink("../upload/bukti_transfer/" . $oldFile);
											}

											move_uploaded_file($tmpname_bukti, "../upload/bukti_transfer/".$rename_bukti);
								

									}
								} else {

										//echo 'user tidak ganti gambar';

										$rename_bukti		= $_POST['bukti_transfer2'];

								}

									$update = mysqli_query($conn, "UPDATE tb_pemesanan SET 
										tgl_pemesan = '".$tanggal."',
										tipe_aula = '".$tipe_aula."',
										nama_pemesan = '".$nama."',
										no_wa = '".$no_wa."',
										dp_pemesanan = '".$dp."',
										sisa_pembayaran = '".$sisa."',
										bukti_transfer = '".$rename_bukti."'
										WHERE id_pemesanan = '".$_GET['id']."'
										");


									if($update){
										echo "<script>window.location='ketersediaan.php?success=Edit Data Berhasil'</script>";
										// echo "Berhasil";
									}else{
										echo 'Gagal Edit' .mysqli_error($conn);
									}

							}

						?>

					</div>

				</div>

			</div>

		</div>

<?php include 'footer.php' ?>	