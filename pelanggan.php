<?php require_once 'des/header-petugas.php';
if (isset($_GET['pnometer'])) {
	if (hapus_meter($_GET['pnometer'])) {
		$meter = $_GET['pnometer'];
		$_SESSION['alert'] = "<script>mscAlert('Nomor meter $meter telah di Hapus');</script>";
		header('location: pelanggan.php');
		die();
	}else{
		$meter = $_GET['pnometer'];
		$_SESSION['alert'] = "<script>mscAlert('Nomor meter $meter tidak dapat dihapus karena sesuatu');</script>";
		header('location: pelanggan.php');
		die();
	}
}
?>
<div id="atas">
	<div class="left">
		<form action="pelanggan.php" method="get">
			Cari Nomor Meter :<input type="search" name="search" class="inputext" maxlength="12">
			<a href="pelanggan.php" class="button">refresh</a>
		</form>
	</div>
	<div class="right"><br>
		<?php if($_SESSION['level'] == '100' or $_SESSION['level'] == '3' or $_SESSION['level'] == '2'): ?>
			<a href="recovery.php" class="button">Meter mati</a> 
			<a href="form-pelanggan.php" class="button">+Nomor Meter</a>
		<?php endif ?>
	</div>
	<div class="clear"></div>
</div>
<div id="badan">
	<table id="data">
		<tr>
			<th>No Meter</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>Telp</th>
			<th>Daya</th>
			<th>Action</th>
		</tr>
		<?php
		if (isset($_GET['search'])) {
			if (cek_meter($_GET['search'],'1')) {
				$_SESSION['alert'] = "<script>mscAlert('Nomor Meter Tidak ada atau telah hapus!');
				</script>";
				header('location: pelanggan.php');
				die();
			}else{
				$mt = cari_meter($_GET['search']);
			}
		}else{
			$mt = meter_tarif();
		}
		while ($pelanggan = mysqli_fetch_assoc($mt)) {
			?>
			<tr>
				<td><?= $pelanggan['no_meter']; ?></td>
				<td><?= $pelanggan['pemilik']; ?></td>
				<td width="200"><?= $pelanggan['alamat']; ?></td>
				<td><?= $pelanggan['telp']; ?></td>
				<td><?= $pelanggan['daya']; ?>VA</td>
				<td>
				<?php if($_SESSION['level'] == '100' or $_SESSION['level'] == '3' or $_SESSION['level'] == '2'): ?>
					<a href="form-pelanggan.php?mtr=<?= $pelanggan['no_meter'] ?>" class="button">Ubah data</a>
					<a onclick="hpspel('<?= $pelanggan['no_meter'] ?>')" class="button">Delete</a>
				<?php elseif($_SESSION['level'] == '0'): ?>
					<a href="penggunaan.php?serch=<?= $pelanggan['no_meter'] ?>" class="button">Penggunaan</a>
				<?php elseif($_SESSION['level'] == '1'): ?>
					<a href="pembayaran.php?search=<?= $pelanggan['no_meter'] ?>" class="button">Tagihan</a>
					<a href="pembayaran.php?hstr=1&serach=<?= $pelanggan['no_meter'] ?>" class="button">Histori</a>
				<?php endif ?>
				</td>
			</tr>
		<?php } ?>
	</table>
	<?php require_once 'des/footer-petugas.php'; ?>