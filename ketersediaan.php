<?php include 'header.php' ?>

		<!-- content -->
		<div class="content">

			<div class="container">

				<div class="box">

					<div class="box-header">
						Ketersediaan Aula
					</div>
					
					<div class="box-body">

						<div class="input-tgl">

							<a href="tambah-pemesan.php" class="text-green"><i class="fa fa-plus"></i>  Tambah</a>		


							<?php 
								if(isset($_GET['success'])){
									echo "<div class='altert altert-success'>".$_GET['success']."</div>";
								}
							?>

							<form action="">
									<input type="date" name="key" placeholder="Tanggal" required>
									<button type="submit">Cari</button>	
							</form>
						</div>

						<table class="table">
							<thead>
								<tr>
									<th>No</th>
									<th>Tanggal</th>
									<th>Tipe Aula</th>
									<th>Nama Pemesan</th>
									<th>No Whatsapp</th>
									<th>DP</th>
									<th>Sisa Pembayaran</th>
									<th>Bukti Transfer</th>
									<th>Aksi</th>
								</tr>
							</thead>

							<tbody>
								<?php

								$pemesanan = null;

								if (isset($_GET['key'])) {
									$key = $_GET['key'];
									$pemesanan = mysqli_query($conn,"SELECT * FROM `tb_pemesan` WHERE tgl_pesanan ='$key' AND disetujui = 1");
								} else {
									$pemesanan = mysqli_query($conn, "SELECT * FROM tb_pemesan WHERE disetujui = '1' ORDER BY id_pemesan DESC");
								}

								$datum = null;

								if (mysqli_num_rows($pemesanan) > 0) {
									// $datum = mysqli_fetch_array($pemesanan, MYSQLI_ASSOC);
									$datum = $pemesanan->fetch_all(MYSQLI_ASSOC);
								} else {
									$datum = null;
								}

								// var_dump($datum);

								?>
								<?php if($datum != null) : ?>
									<?php foreach($datum as $key => $data) : ?>
										<tr>
											<td><?= ++$key ?></td>
											<td><?= $data['tgl_pesanan'] ?></td>
											<td><?= $data['tipeaula_'] ?></td>
											<td><?= $data['name_pemesan'] ?></td>
											<td><a href="https://wa.me/<?= $data['no_hp'] ?>"><?= $data['no_hp'] ?></a></td>
											<td><?= $data['dp_pembayaran'] ?></td>
											<td><?= $data['sisa_pembayaran'] ?></td>
											<td><img src="../upload/pesanan/<?= $data['bukti_pembayaran'] ?>" width="100px"></td>
        									<td>
        										<a href="edit-pemesanan.php?id=<?= $data['id_pemesan'] ?>" title="edit data" class="text-orange" ><i class= "fa fa-edit"></i></a>
        										<a href="hapus.php?id_pemesan=<?= $data['id_pemesan'] ?>" onclick="return confirm('Yakin ingin hapus ?')" title="Hapus Data" class="text-red"><i class="fa-solid fa-xmark"></i></a>
        									</td>
										</tr>
									<?php endforeach ?>
								<?php else : ?>	
									<tr>
										<td colspan="9">Data tidak ada</td>
									</tr>
								<?php endif ?>
							</tbody>
						</table>
						
					</div>

				</div>
				
			</div>
			
		</div>

<?php include 'footer.php' ?>