<?php include 'header.php' ?>


		<!-- content -->
		<div class="content">
			
			<div class="container">
				
				<div class="box">
					
					<div class="box-header">
						Tambah Pesanan
					</div>

					<div class="box-body">

						<form action="" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label>Tanggal</label>
								<input type="date" name="tgl_pemesan" placeholder="tanggal" class="input-control" required>
							</div>

							<div class="form-group">
								<label>Tipe Aula</label>
								<select name="tipe_aula" class="input-control" required>
									<option value="">Pilih Tipe Aula</option>
									<option value="S 1">S 1</option>
									<option value="S 2">S 2</option>
									<option value="L 1">L 1</option>
									<option value="L 2">L 2</option>
									<option value="L 3">L 3</option>
									<option value="L 4">L 4</option>
									<option value="L 5">L 5</option>
									<option value="L 6">L 6</option>
								</select>
							</div>

							<div class="form-group">
								<label>Nama Pemesan</label>
								<input type="text" name="nama_pemesan" placeholder="Nama Lengkap/Nama Organisasi" class="input-control" required>
							</div>

							<div class="form-group">
								<label>Nomor Whatsapp</label>
								<input type="text" name="no_wa" placeholder="No Whatsapp" class="input-control" required>
							</div>

							<div class="form-group">
								<label>DP Pemesan</label>
								<input type="text" name="dp_pemesanan" placeholder="DP" class="input-control" required>
							</div>

							<div class="form-group">
								<label>Sisa Pembayaran</label>
								<input type="text" name="sisa_pembayaran" placeholder="Sisa Pembayaran" class="input-control" required>
							</div>

							<div class="form-group">
								<label>Bukti Transfer</label>
								<input type="file" name="bukti_transfer" class="input-control" required>
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

								$filename_bukti  	= $_FILES['bukti_transfer']['name'];
								$tmpname_bukti  	= $_FILES['bukti_transfer']['tmp_name'];
								$filesize_bukti 	= $_FILES['bukti_transfer']['size'];

								$formatfile_bukti = pathinfo($filename_bukti, PATHINFO_EXTENSION);
								$rename_bukti		= 'tb_pemesanan'.time().'.'.$formatfile_bukti;


								$allowedtype_bukti = array('png', 'jpg', 'jpeg', 'gif');

								if (!in_array($formatfile_bukti, $allowedtype_bukti)) {
									echo '<div class="alert alert-error">Format file tidak diizinkan.</div>';
								} elseif ($filesize_bukti > 1000000) {
									echo '<div class="alert alert-error">Ukuran file tidak boleh lebih dari 1 MB.</div>';
								} else {
									move_uploaded_file($tmpname_bukti, "../upload/bukti_transfer/".$rename_bukti);

									$simpan = mysqli_query($conn, "INSERT INTO tb_pemesanan (tgl_pemesan, tipe_aula, nama_pemesan, no_wa, dp_pemesanan, sisa_pembayaran, bukti_transfer) VALUES (
											'".$tanggal."',
											'".$tipe_aula."',
											'".$nama."',
											'".$dp."',
											'".$no_wa."',
											'".$sisa."',
											'".$rename_bukti."'

									)");

									if($simpan){
												echo '<div class= "alert alert-success">Berhasil Disimpan</div>';
									}else{
										echo 'Gagal Simpan' .mysqli_error($conn);
									}
								}

							}

						?>

					</div>

				</div>

			</div>

		</div>

<?php include 'footer.php' ?>	