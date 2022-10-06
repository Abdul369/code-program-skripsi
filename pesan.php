<?php include 'header.php' ?>

		<!-- content -->
		<div class="content">

			<div class="container">

				<div class="box">

					<div class="box-header">
						Pemesan Aula
					</div>
					
					<div class="box-body">		

						<?php 
							if(isset($_GET['success'])){
								echo "<div class='altert altert-success'>".$_GET['success']."</div>";
							}
						?>


						<table class="table">
							<thead>
								<tr>
									<th>No</th>
									<th>Tanggal</th>
									<th>Tipe Aula</th>
									<th>Nama Pemesan</th>
									<th>No HP</th>
									<th>Bukti Transfer</th>
									<th>Aksi</th>
								</tr>
							</thead>

							<tbody>
								<?php
								$no = 1;

								$where = " WHERE 1=1 ";
								if(isset($_GET['key'])){
									$where .= " AND tgl_pesanan LIKE '%".addslashes($_GET['key'])."%' ";
								}

								$pemesan = mysqli_query($conn, "SELECT * FROM tb_pemesan $where ORDER BY id_pemesan DESC");
								// var_dump(mysqli_fetch_array($pemesan));
								if(mysqli_num_rows($pemesan) > 0){
									while($p = mysqli_fetch_array($pemesan)){
								?>

								<tr>
									<td><?= $no++ ?></td>
									<td><?= $p['tgl_pesanan'] ?></td>
									<td><?= $p['tipeaula_'] ?></td>
									<td><?= $p['name_pemesan'] ?></td>
									<td><a href="https://wa.me/<?= $p['no_hp'] ?>"><?= $p['no_hp'] ?></a></td>
									<td><a href="../upload/pesanan/<?= $p['bukti_pembayaran'] ?>"><img src="../upload/pesanan/<?= $p['bukti_pembayaran'] ?>" width="100px"></a></td>
									<td>
										<a href="hapus.php?id_pemesan=<?= $p['id_pemesan'] ?>" onclick="return confirm('Yakin ingin hapus ?')" title="Hapus Data" class="text-red"><i class="fa-solid fa-xmark"></i></a>

										<?php if ($p['disetujui'] == 0) : ?>
                                            <form action="" method="POST">
                                                <input type="hidden" name="id" value="<?= $p['id_pemesan'] ?>" class="btn btn-blue">
                                                <input type="submit" name="approve" value="Approve" class="btn btn-blue">
                                            </form>
                                        <?php else : ?>
                                            <form action="" method="POST">
                                                <input type="hidden" name="id" value="<?= $p['id_pemesan'] ?>" class="btn btn-blue">
                                                <input type="submit" name="approve" value="Disapprove" class="btn btn-blue">
                                            </form>
                                        <?php endif ?>
									</td>

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

		<?php
			if (isset($_POST['approve'])) {
			    $id = $_POST['id'];

			    $findData = mysqli_query($conn, "SELECT * FROM `tb_pemesan` WHERE id_pemesan = $id");

			    if (mysqli_num_rows($findData) > 0) {
			        $p = mysqli_fetch_object($findData);
			        if ($p->disetujui == 0) {
			            $query = "UPDATE `tb_pemesan` SET `disetujui` = '1' WHERE `tb_pemesan`.`id_pemesan` = $id";
			            $save =  mysqli_query($conn, $query);

			            if ($save) {
			                echo "<script>window.location='ketersediaan.php?success= Registrasi Berhasil'</script>";
			                // echo '<div class="alert alert-success">Simpan Berhasil</div>';
			            } else {
			                echo 'Gagal Bosque' . mysqli_error($conn);
			            }
			        } else {
			            $query = "UPDATE `tb_pemesan` SET `disetujui` = '0' WHERE `tb_pemesan`.`id_pemesan` = $id";
			            $save =  mysqli_query($conn, $query);

			            if ($save) {
			                echo "<script>window.location='pesan.php?success= Registrasi Berhasil'</script>";
			                // echo '<div class="alert alert-success">Simpan Berhasil</div>';
			            } else {
			                echo 'Gagal Bosque' . mysqli_error($conn);
			            }
			        }
			    }

			    // if($simpan){
			    //     echo '<div class="alert alert-success">Simpan Berhasil</div>';
			    // }else{
			    //     echo 'Gagal Bosque' .mysqli_error($conn);
			    // }

			}
?>


<?php include 'footer.php' ?>