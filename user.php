<?php include 'header.php' ?>

		<!-- content -->
		<div class="content">
			
			<div class="container">
				
				<div class="box">
					
					<div class="box-header">
						User
					</div>

					<div class="box-body">

						<a href="registrasi-user.php" class="text-green"><i class="fa fa-plus"></i> Tambah</a>

						<?php 
							if(isset($_GET['success'])){
								echo "<div class='altert altert-success'>".$_GET['success']."</div>";
							}
							
						?>	

						<form action="">
							<div class="input-group">
								<input type="text" name="key" placeholder="Pencarian" required>
								<button type="submit"><i class= "fa fa-search"></i></button>
							</div>	
						</form>
						
						<table class="table">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Username</th>
									<th>Level</th>
									<th>No HP</th>
									<th>Password</th>
									<th>Aksi</th>
								</tr>
							</thead>

							<tbody>
								<?php
								$no = 1;

								$where = " WHERE 1=1 ";
								if(isset($_GET['key'])){
									$where .= " AND nama LIKE '%".addslashes($_GET['key'])."%' ";
								}	

									$tb_user = mysqli_query($conn, "SELECT * FROM tb_user $where ORDER BY id DESC");
									if(mysqli_num_rows($tb_user) > 0) {
										while($u = mysqli_fetch_array($tb_user)){

								?> 
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $u['nama'] ?></td>
									<td><?= $u['username'] ?></td>
									<td><?= $u['level'] ?></td>
									<td><?= $u['telpon'] ?></td>
									<td><?= $u['password'] ?></td>
									<td>
										<a href="edit-user.php?id=<?= $u['id'] ?>" title="Edit Data" class="text-orange"><i class="fa fa-edit"></i></a> 
										<a href="hapus.php?id=<?= $u['id'] ?>" onclick="return confirm('Yakin ingin hapus?')" title="Hapus Data" class="text-red"><i class="fa fa-times"></i></a>
									</td>
								</tr>

							<?php }}else{ ?> 
								<tr>
									<td colspan="6">Data tidak ada</td>
								</tr>
							<?php } ?>
							</tbody>

						</table>

					</div>
				</div>

			</div>

		</div>

<?php include 'footer.php' ?>	