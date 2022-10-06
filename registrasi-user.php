<?php include 'header.php' ?>

		<!-- content -->
		<div class="content">
			
			<div class="container">
				
				<div class="box">
					
					<div class="box-header">
						Registrasi User
					</div>

					<div class="box-body">

						<form action="" method="POST">
							<div class="form-group">
								<label>Nama</label>
								<input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" required>
							</div>

							<div class="form-group">
								<label>Username</label>
								<input type="text" name="username" placeholder="Username" class="input-control" required>
							</div>

							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" placeholder="Password" class="input-control" required>
							</div>

							<div class="form-group">
								<label>Akses Level</label>
								<select name="level" class="input-control" required>
									<option value="">Pilih</option>
									<option value="Super Admin">Super Admin</option>
									<option value="Admin">Admin</option>
								</select>
							</div>

							<div class="form-group">
								<label>No HP</label>
								<input type="text" name="telpon" placeholder="No Handphone" class="input-control" required>
							</div>

							<button type="button" class="btn" onclick="window.location = 'user.php'">Kembali</button>
							<input type="submit" name="submit" value="Simpan" class="btn btn-blue">

						</form>

						<?php

							if(isset($_POST['submit'])){

								$nama_user  = addslashes(ucwords($_POST['nama']));
								$username  = addslashes($_POST['username']);
								$akses_level  = $_POST['level'];
								$no_telpon  = $_POST['telpon'];
								$password  = $_POST['password'];

								$cek	= mysqli_query($conn, "SELECT username FROM tb_user  WHERE username = '".$username."' ");

								if(mysqli_num_rows($cek) > 0) {
									
									echo '<div class= "alert alert-error">Username Sudah Digunakan</div>';
									
								}else{

										$simpan = mysqli_query($conn, "INSERT INTO tb_user (nama, username, level, telpon, password) VALUES ( 
											'".$nama_user."',
											'".$username."',
											'".$akses_level."',
											'".$no_telpon."',
											'".$password."'

									)");

								if($simpan){
											echo "<script>window.location='user.php?success=Registrasi User Berhasil'</script>";
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