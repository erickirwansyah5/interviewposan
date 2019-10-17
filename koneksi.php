<?php 
$conn =  mysqli_connect('localhost','root','','san');

if(!$conn) {
	throw new Exception("koneksi gagal");
	
}

 ?>