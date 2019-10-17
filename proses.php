<?php 
include 'koneksi.php';
if(isset($_GET['dariE'])) {
	$tujuan = strtoupper($_GET['tujuanE']);
	$dari = strtoupper($_GET['dariE']);
	$data['rute'] = "";
	$data['rute'] ="";
	$query = "SELECT * FROM dari WHERE kota = '$dari'";
	// $result = mysqli_query($conn,$query);
	if($query) {
		$query2  ="SELECT * FROM tujuan WHERE kota = '$tujuan'";
		$result = mysqli_query($conn,$query2);
		$bus = mysqli_fetch_assoc($result);
		$id_bus = $bus['id_bus'];
		$data['rute'] .= $bus['rute'];
		if($query2) {
			$query3  ="SELECT * FROM bus WHERE id_bus = '$id_bus'";
			$result = mysqli_query($conn,$query3);
			$data = mysqli_fetch_assoc($result);
			$data['bus'] = $data['nama_bus'];
			$data['rute'] = $bus['rute'];
			echo json_encode($data);
		}
		
	}
}
if(isset($_POST['dari'])) {
	$dari = $_POST['dari'];
	$tujuan = $_POST['tujuan'];
	$nama_bus = $_POST['nama_bus'];
	$tanggal = $_POST['tanggal'];
	$rute = $_POST['rute'];
	$query = "INSERT INTO keberangkatan(nama_bus,dari,tujuan,tanggal,rute) VALUES('$nama_bus','$dari','$tujuan','$tanggal','$rute')";
	$exec = mysqli_query($conn,$query);
	if($exec) {
		header('Location: order.php');
	}else {
		header('Location: index.php');
	}
}

 ?>