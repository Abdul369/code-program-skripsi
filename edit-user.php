<?php include 'header.php' ?>

<?php 
	$tb_user 	= mysqli_query($conn, "SELECT * FROM tb_user WHERE id = '".$_GET['id']."' ");

	if(mysqli_num_rows($tb_user) == 0 ){
		echo "<script>window.location='user.php'</script>";
	}

	$u 			= mysqli_fetch_object($tb_user);
?>

		<!-- content -->
		<div class="content">
			
			<div class="container">
				
				<div class="box">
					
					<div class="box-header">
						Edit Fasilitas
					</div>

					<div class="box-body">

						<form action="" method="POST">
							<div class="form-group">
								<label>Nama</label>
								<input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?= $u->nama?>" required>
							</div>

							<div class="form-group">
								<label>Username</label>
								<input type="text" name="username" placeholder="Username" class="input-control" value="<?= $u->username?>" required>
							</div>

							<div class="form-group">
								<label>Akses Level</label>
								<select name="level" class="input-control" required>
									<option value="">Pilih</option>
									<option value="Super Admin" <?= ($u->level == 'Super Admin')? 'selected':''; ?>>Super Admin</option>
									<option value="Admin" <?= ($u->level == 'Admin')? 'selected':''; ?>>Admin</option>
								</select>
							</div>

							<div class="form-group">
								<label>No HP</label>
								<input type="text" name="telpon" placeholder="No Handphone" class="input-control" value="<?= $u->telpon?>"  required>
							</div>

							<button type="button" class="btn" onclick="window.location = 'user.php'">Kembali</button>
							<input type="submit" name="submit" value="Simpan" class="btn btn-blue">

						</form>

						<?php

							if(isset($_POST['submit'])){

								$nama_user  = addslashes(ucwords($_POST['nama']));
								$username  = $_POST['username'];
								$akses_level  = $_POST['level'];
								$no_telpon  = $_POST['telpon'];
								
								$update = mysqli_query($conn, "UPDATE tb_user SET 
									nama = '".$nama_user."',
									username = '".$username."',
									level = '".$akses_level."',
									telpon = '".$no_telpon."'
									WHERE id = '".$_GET['id']."'
									");


								if($update){
									echo "<script>window.location='edit-user.php?success=Edit Data Berhasil'</script>";
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