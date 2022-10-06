<?php include 'header.php' ?>

<?php 
$id = $_GET['id'];

	$fasilitas = mysqli_query($conn, "SELECT * FROM tb_fasilitas WHERE id_fasilitas = $id");
	// $f = mysqli_fetch_object($fasilitas);
	// var_dump($fasilitas->id);
	$f = $fasilitas->fetch_all(MYSQLI_ASSOC);
	// var_dump($f);
	$oldFile = '';
?>

		<!-- content -->
		<div class="content">
			
			<div class="container">
				
				<div class="box">
					
					<div class="box-header">
						Edit Fasilitas
					</div>


					<div class="box-body">
						<?php foreach ($f as $result) : ?>
						<?php 
						// var_dump($result['nama_fasilitas'])
						?>

						<form action="" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label>Nama Fasilitas</label>
								<input type="text" name="nama_fasilitas" placeholder="Nama Fasilitas" value=" <?php echo($result['nama_fasilitas']) ?> " class="input-control" required>
							</div>

							<div class="form-group">
								<label>Harga</label>
								<input type="text" name="harga_fasilitas" placeholder="Harga Fasilitas" value=" <?php echo($result['harga_fasilitas']) ?> " class="input-control" required>
							</div>

							<div class="form-group">
								<label>Keteranga</label>
								<input type="text" name="ket_fasilitas" placeholder="Keterangan" value=" <?php echo($result['ket_fasilitas']) ?> " class="input-control" required>
							</div>

							<div class="form-group">
								<label>Gambar</label>
								<img src="../upload/fasilitas/<?php echo($result['gambar_fasilitas']); $oldFile = $result['gambar_fasilitas']; ?>" widht="200" class="">
								<input type="hidden" name="gambar_fasilitas2" value="<?php echo($result['gambar_fasilitas']) ?>">
								<input type="file" name="gambar_fasilitas" class="input-control"> 
							</div>

							<button type="button" class="btn" onclick="window.location = 'fasilitas.php'">Kembali</button>
							<input type="submit" name="submit" value="Simpan" class="btn btn-blue">

						</form>
					<?php endforeach; ?>
						<?php

							if(isset($_POST['submit'])){

								$nama  	= addslashes(ucwords($_POST['nama_fasilitas']));
								$harga  	= addslashes(ucwords($_POST['harga_fasilitas']));
								$ket  	= addslashes($_POST['ket_fasilitas']);
								$rename = '';


								if($_FILES['gambar_fasilitas']['name'] != ''){

									//echo 'user ganti gambar';

									$filename  	= $_FILES['gambar_fasilitas']['name'];
									$tmpname  	= $_FILES['gambar_fasilitas']['tmp_name'];
									$filesize 	= $_FILES['gambar_fasilitas']['size'];

									$formatfile = pathinfo($filename, PATHINFO_EXTENSION);
									$rename		= 'tb_fasilitas'.time().'.'.$formatfile;


									$allowedtype = array('png', 'jpg', 'jpeg', 'gif');

									if(!in_array($formatfile, $allowedtype)){

										echo '<div class="alert alert-error">Format file tidak diizinkan.</div>';

										return false;

									}elseif($filesize > 1000000){
									
										echo '<div class="alert alert-error">Ukuran file tidak boleh lebih dari 1 MB.</div>';

										return false;

									}else{

										// if(file_exists("../upload/fasilitas/" . $_POST['gambar_fasilitas2'])){
										if(file_exists("../upload/fasilitas/" . $oldFile)){

											// unlink("../upload/fasilitas/" . $_POST['gambar_fasilitas2']);
											unlink("../upload/fasilitas/" . $oldFile);
										}

										move_uploaded_file($tmpname, "../upload/fasilitas/".$rename);
									}

								}else{

									//echo 'user tidak ganti gambar';

									$rename		= $_POST['gambar_fasilitas2'];

								}

								$update = mysqli_query($conn, "UPDATE tb_fasilitas SET 
									nama_fasilitas = '".$nama."',
									harga_fasilitas = '".$harga."',
									ket_fasilitas = '".$ket."',
									gambar_fasilitas = '".$rename."'
									WHERE id_fasilitas = '".$_GET['id']."'
									");


								if($update){
									echo "<script>window.location='fasilitas.php?success=Edit Data Berhasil'</script>";
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