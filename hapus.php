<?php 
include 'koneksi.php';
if(isset($_GET['id_keberangkatan'])) {
	$id_keberangkatan = $_GET['id_keberangkatan'];
	$query = "DELETE FROM keberangkatan WHERE id_keberangkatan = '$id_keberangkatan'";
	$exec = mysqli_query($conn,$query);
	if($exec) {
		header('Location: order.php');
	}
}

 ?>