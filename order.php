<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Orderan</title>
	<link rel="stylesheet" href="style.css">
	<style>
		body{
			background: #333;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="judul"><h1>Orderan</h1></div>
		<div class="table">
			<table id="table" style="border-collapse: collapse;"border="1">
				<tr>
				<th>ID keberangkatan</th>
				<th>Nama Bus</th>
				<th>Dari</th>
				<th>Tujuan</th>
				<th>Tanggal</th>
				<th>Rute</th>
				<th>aksi</th>
			</tr>
			<?php $query = mysqli_query($conn,"SELECT * FROM keberangkatan");
				while($data = mysqli_fetch_assoc($query)) {
			 ?>
			<tr>
				<td align="center"><?= $data['id_keberangkatan'] ?></td>
				<td align="center"><?= $data['nama_bus'] ?></td>
				<td align="center"><?= $data['dari'] ?></td>
				<td align="center"><?= $data['tujuan'] ?></td>
				<td align="center"><?= $data['tanggal'] ?></td>
				<td><?= $data['rute'] ?></td>
				<td><a href="hapus.php?id_keberangkatan=<?= $data['id_keberangkatan'] ?>">Hapus</a></td>
			</tr>
		<?php } ?>
			</table>
		</div>
		<a href="index.php">Back</a>
	</div>
</body>
</html>