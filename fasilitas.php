<?php include 'header.php' ?>

		<!-- content -->
		<div class="content">

			<div class="container">

				<div class="box">

					<div class="box-header">
						Fasilitas
					</div>
					
					<div class="box-body">

						<a href="tambah-fasilitas.php" class="text-green"><i class="fa fa-plus"></i>  Tambah</a>		

						<?php 
							if(isset($_GET['success'])){
								echo "<div class='altert altert-success'>".$_GET['success']."</div>";
							}
						?>

						<form action="">
							<div class="input-group">
								<input type="text" name="key" placeholder="Pencarian" required>
								<button type="submit"><i class="fa fa-search"></i></button>
							</div>	
						</form>


						<table class="table">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Fasilitas</th>
									<th>Harga</th>
									<th>Keterangan</th>
									<th>Gambar</th>
									<th>Aksi</th>
								</tr>
							</thead>

							<tbody>
								<?php
								$no = 1;

								$where = " WHERE 1=1 ";
								if(isset($_GET['key'])){
									$where .= " AND nama_fasilitas LIKE '%".addslashes($_GET['key'])."%' ";
								}

								$fasilitas = mysqli_query($conn, "SELECT * FROM tb_fasilitas $where ORDER BY id_fasilitas DESC");
								if(mysqli_num_rows($fasilitas) > 0){
									while($p = mysqli_fetch_array($fasilitas)){
								?>

								<tr>
									<td><?= $no++ ?></td>
									<td><?= $p['nama_fasilitas'] ?></td>
									<td><?= $p['harga_fasilitas'] ?></td>
									<td><?= $p['ket_fasilitas'] ?></td>
									<td><img src="../upload/fasilitas/<?= $p['gambar_fasilitas'] ?>" width="100px"></td>
									<td>
										<a href="edit-fasilitas.php?id=<?= $p['id_fasilitas'] ?>" title="edit data" class="text-red" ><i class= "fa fa-edit"></i></a>
										<a href="hapus.php?id_fasilitas=<?= $p['id_fasilitas'] ?>" onclick="return confirm('Yakin ingin hapus ?')" title="Hapus Data" class="text-red"><i class="fa-solid fa-xmark"></i></a>
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