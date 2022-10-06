<?php include 'header.php' ?>

		<!-- content -->
		<div class="content">
			
			<div class="container">
				
				<div class="box">
					
					<div class="box-header">
						Keterangan
					</div>

					<div class="box-body">

						<?php 
							if(isset($_GET['success'])){
								echo "<div class='altert altert-success'>".$_GET['success']."</div>";
							}
						?>

						<form action="" method="POST" enctype="multipart/form-data">
							<div class="form-group">
							
							<div class="form-group">
								<label>Keterangan</label>
								<textarea name="ket_us" placeholder="Keterangan" class="input-control"><?= $a->ket_us ?></textarea>
							</div>

							<div class="form-group">
								<label>Foto</label>
								<img src="../upload/about_us/<?= $a->foto_us ?>" width="200px" class="image">
								<input type="hidden" name="foto_lama" value="<?= $a->foto_us ?>">
								<input type="file" name="foto_baru" class="input-control"> 
							</div>

							<input type="submit" name="submit" value="Simpan Perubahan" class="btn btn-blue">

						</form>
						<?php

							if(isset($_POST['submit'])){

								$keterangan  	= addslashes($_POST['ket_us']);

								//menampung dan validasi data foto
								if($_FILES['foto_baru']['name'] != ''){

									//echo 'user ganti gambar';

									$filename_foto  	= $_FILES['foto_baru']['name'];
									$tmpname_foto  	= $_FILES['foto_baru']['tmp_name'];
									$filesize_foto  	= $_FILES['foto_baru']['size'];

									$formatfile_foto    = pathinfo($filename_foto , PATHINFO_EXTENSION);
									$rename_foto 		= 'foto'.time().'.'.$formatfile_foto ;


									$allowedtype_foto  = array('png', 'jpg', 'jpeg', 'gif');

									if(!in_array($formatfile_foto , $allowedtype_foto )){

										echo '<div class="alert alert-error">Format file tidak diizinkan.</div>';

										return false;

									}elseif($filesize_foto > 1000000){
									
										echo '<div class="alert alert-error">Ukuran file tidak boleh lebih dari 1 MB.</div>';

										return false;

									}else{

										if(file_exists("../upload/about_us/".$_POST['foto_lama'])){

											unlink("../upload/about_us/".$_POST['foto_lama']);
										}

										move_uploaded_file($tmpname_foto , "../upload/about_us/".$rename_foto );
									}

								}else{

									//echo 'user tidak ganti gambar';

									$rename_foto 		= $_POST['foto_lama'];

								}

								$update = mysqli_query($conn, "UPDATE tb_aboutus SET 
									ket_us = '".$keterangan."',
									foto_us = '".$rename_foto."'
									WHERE id_us = '".$a->id_us."'
									");


								if($update){
									echo "<script>window.location='keterangan.php?success=Edit Data Berhasil'</script>";
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