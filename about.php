<?php include 'header.php' ?>

		<!-- content -->
		<div class="content">
			
			<div class="container">
				
				<div class="box">
					
					<div class="box-header">
						About Us
					</div>

					<div class="box-body">

						<?php 
							if(isset($_GET['success'])){
								echo "<div class='altert altert-success'>".$_GET['success']."</div>";
							}
						?>

						<form action="" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label>Nama</label>
								<input type="text" name="nama_us" placeholder="Nama Pantai" value="<?= $a->nama_us ?>" class="input-control" required>
							</div>

							<div class="form-group">
								<label>Whatsapp</label>
								<input type="text" name="wa_us" placeholder="No Whatsapp" value="<?= $a->wa_us ?>" class="input-control" required>
							</div>

							<div class="form-group">
								<label>Facebook</label>
								<input type="text" name="fb_us" placeholder="Facebook" value="<?= $a->fb_us ?>" class="input-control" required>
							</div>

							<div class="form-group">
								<label>Instagram</label>
								<input type="text" name="ig_us" placeholder="Instagram" value="<?= $a->ig_us ?>" class="input-control" required>
							</div>

							<div class="form-group">
								<label>Alamat</label>
								<textarea name="alamat_us" placeholder="Alamat" class="input-control"><?= $a->alamat_us ?></textarea>
							</div>

							<div class="form-group">
								<label>Google Maps</label>
								<textarea name="maps_us" placeholder="Google Maps" class="input-control"><?= $a->maps_us ?></textarea>
							</div>

							<div class="form-group">
								<label>Logo</label>
								<img src="../upload/about_us/<?= $a->logo_us ?>" width="200px" class="image">
								<input type="hidden" name="logo_lama" value="<?= $a->logo_us ?>">
								<input type="file" name="logo_baru" class="input-control"> 
							</div>

							<input type="submit" name="submit" value="Simpan Perubahan" class="btn btn-blue">

						</form>
						<?php

							if(isset($_POST['submit'])){

								$nama  	= addslashes(ucwords($_POST['nama_us']));
								$wa  	= addslashes($_POST['wa_us']);
								$fb  	= addslashes($_POST['fb_us']);
								$ig  	= addslashes($_POST['ig_us']);
								$alamat  	= addslashes($_POST['alamat_us']);
								$maps  	= addslashes($_POST['maps_us']);

								//menampung dan validasi data logo
								if($_FILES['logo_baru']['name'] != ''){

									//echo 'user ganti gambar';

									$filename_logo  	= $_FILES['logo_baru']['name'];
									$tmpname_logo   	= $_FILES['logo_baru']['tmp_name'];
									$filesize_logo  	= $_FILES['logo_baru']['size'];

									$formatfile_logo    = pathinfo($filename_logo , PATHINFO_EXTENSION);
									$rename_logo 		= 'logo_us'.time().'.'.$formatfile_logo ;


									$allowedtype_logo  = array('png', 'jpg', 'jpeg', 'gif');

									if(!in_array($formatfile_logo , $allowedtype_logo )){

										echo '<div class="alert alert-error">Format file tidak diizinkan.</div>';

										return false;

									}elseif($filesize_logo > 1000000){
									
										echo '<div class="alert alert-error">Ukuran file tidak boleh lebih dari 1 MB.</div>';

										return false;

									}else{

										if(file_exists("../upload/about_us/".$_POST['logo_lama'])){

											unlink("../upload/about_us/".$_POST['logo_lama']);
										}

										move_uploaded_file($tmpname_logo , "../upload/about_us/".$rename_logo );
									}

								}else{

									//echo 'user tidak ganti gambar';

									$rename_logo 		= $_POST['logo_lama'];

								}

								$update = mysqli_query($conn, "UPDATE tb_aboutus SET 
									nama_us = '".$nama."',
									wa_us = '".$wa."',
									fb_us = '".$fb."',
									ig_us = '".$ig."',
									alamat_us = '".$alamat."',
									maps_us = '".$maps."',
									logo_us = '".$rename_logo."'
									WHERE id_us = '".$a->id_us."'
									");


								if($update){
									echo "<script>window.location='about.php?success=Edit Data Berhasil'</script>";
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