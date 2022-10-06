<?php include 'header.php' ?>

		<!-- content -->
		<div class="content">
			
			<div class="container">
				
				<div class="box">
					
					<div class="box-header">
						Tambah Fasilitas
					</div>

					<div class="box-body">

						<form action="" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label>Nama Fasilitas</label>
								<input type="text" name="nama_fasilitas" placeholder="Nama Fsilitas" class="input-control" required>
							</div>

							<div class="form-group">
								<label>Harga</label>
								<input type="text" name="harga_fasilitas" placeholder="Harga Fasilitas" class="input-control" required>
							</div>

							<div class="form-group">
								<label>Keteranga</label>
								<input type="text" name="ket_fasilitas" placeholder="Keterangan" class="input-control" required>
							</div>

							<div class="form-group">
								<label>Gambar</label>
								<input type="file" name="gambar_fasilitas" class="input-control" required>
							</div>

							<button type="button" class="btn" onclick="window.location = 'fasilitas.php'">Kembali</button>
							<input type="submit" name="submit" value="Simpan" class="btn btn-blue">

						</form>

						<?php

							if(isset($_POST['submit'])){

								//print_r($FILES['gambar']);

								$nama  	= addslashes(ucwords($_POST['nama_fasilitas']));
								$harga  	= addslashes(ucwords($_POST['harga_fasilitas']));
								$ket  	= addslashes($_POST['ket_fasilitas']);

								$filename  	= $_FILES['gambar_fasilitas']['name'];
								$tmpname  	= $_FILES['gambar_fasilitas']['tmp_name'];
								$filesize 	= $_FILES['gambar_fasilitas']['size'];

								$formatfile = pathinfo($filename, PATHINFO_EXTENSION);
								$rename		= 'tb_fasilitas'.time().'.'.$formatfile;


								$allowedtype = array('png', 'jpg', 'jpeg', 'gif');


								if(!in_array($formatfile, $allowedtype)){

									echo '<div class="alert alert-error">Format file tidak diizinkan.</div>';

								}elseif($filesize > 1000000){
								
									echo '<div class="alert alert-error">Ukuran file tidak boleh lebih dari 1 MB.</div>';

								}else{

									move_uploaded_file($tmpname, "../upload/fasilitas/".$rename);

								$simpan = mysqli_query($conn, "INSERT INTO tb_fasilitas (nama_fasilitas, harga_fasilitas, ket_fasilitas, gambar_fasilitas) VALUES (
											'".$nama."',
											'".$harga."',
											'".$ket."',
											'".$rename."'

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