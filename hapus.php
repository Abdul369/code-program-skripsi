<?php 

	include '../koneksi.php';

	if(isset($_GET['id'])){

		$user = mysqli_query($conn, "SELECT nama FROM tb_user WHERE id = '".$_GET['id']."' ");

		if(mysqli_num_rows($user) > 0) {

			$u = mysqli_fetch_object($user);

		}

		$delete = mysqli_query($conn, "DELETE FROM tb_user WHERE id = '".$_GET['id']."' ");
		echo "<script>window.location = 'user.php'</script>";
	}


	

	if(isset($_GET['id_fasilitas'])){

		$fasilitas = mysqli_query($conn, "SELECT gambar_fasilitas FROM tb_fasilitas WHERE id_fasilitas = '".$_GET['id_fasilitas']."' ");

		if(mysqli_num_rows($fasilitas) > 0) {

			$p = mysqli_fetch_object($fasilitas);

			if(file_exists("../upload/fasilitas/".$p->gambar_fasilitas)){

				unlink("../upload/fasilitas/".$p->gambar_fasilitas);
			}


		}

		$delete = mysqli_query($conn, "DELETE FROM tb_fasilitas WHERE id_fasilitas = '".$_GET['id_fasilitas']."' ");
		echo "<script>window.location = 'fasilitas.php'</script>";
	}

	if(isset($_GET['id_pemesanan'])){

		$pemesanan = mysqli_query($conn, "SELECT nama_pemesan FROM tb_pemesanan WHERE id_pemesanan = '".$_GET['id_pemesanan']."' ");

		if(mysqli_num_rows($pemesanan) > 0) {

			$p = mysqli_fetch_object($pemesanan);

				if(file_exists("../upload/bukti_transfer/".$p->bukti_transfer)){

				unlink("../upload/bukti_transfer/".$p->bukti_transfer);

			// if(file_exists("../upload/bukti_transfer/".$p->bukti_transfer)){

			// 	unlink("../upload/bukti_transfer/".$p->bukti_transfer);
			}


		}

		$delete = mysqli_query($conn, "DELETE FROM tb_pemesanan WHERE id_pemesanan = '".$_GET['id_pemesanan']."' ");
		echo "<script>window.location = 'ketersediaan.php'</script>";
		}


	if(isset($_GET['id_pemesan'])){

		$pemesan = mysqli_query($conn, "SELECT bukti_pembayaran FROM tb_pemesan WHERE id_pemesan = '".$_GET['id_pemesan']."' ");

		if(mysqli_num_rows($pemesan) > 0) {

			$p = mysqli_fetch_object($pemesan);

			if(file_exists("../upload/pesanan/".$p->bukti_pembayaran)){

				unlink("../upload/pesanan/".$p->bukti_pembayaran);
			}


		}

		$delete = mysqli_query($conn, "DELETE FROM tb_pemesan WHERE id_pemesan = '".$_GET['id_pemesan']."' ");
		echo "<script>window.location = 'pesan.php'</script>";
	}
?>

