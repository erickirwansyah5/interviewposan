<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Program Posan Bengkulu</title>
	 <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container">
			<form id="proses">
			<select name="dari" id="dari">
				<option selected="">-Pilih Start-</option>
				<?php $query = mysqli_query($conn,"SELECT * FROM dari"); ?>
				
				<?php 
					while($data = mysqli_fetch_assoc($query)) {
						?>
						<option value="<?= $data['kota'] ?>"><?= $data['kota'] ?></option>
					<?php 
						}

					 ?>
				 ?>
			</select>
			<select name="dari" id="tujuan">
				<?php $query = mysqli_query($conn,"SELECT * FROM tujuan"); ?>
					<option selected="">-Pilih Tujuan-</option>
				<?php 
					while($data = mysqli_fetch_assoc($query)) {
						?>
						<option value="<?= $data['kota'] ?>"><?= $data['kota'] ?></option>
					<?php 
						}

					 ?>
				 ?>
			</select>
			<select name="bus" id="bus">
				<option selected="">-Pilih Bus-</option>
			</select>
			<select name="rute" id="rute">
				<option selected="">-RUTE-</option>
			</select>
			<input type="text" id="date">
			<button type="submit">Order Now</button>
			</form>
	</div>
</body>
<script>
$('#date').datepicker({
	uiLibrary: 'bootstrap4'
})
const form = document.querySelector('#proses');
const dariEl = document.querySelector('#dari');
const dari = document.querySelector('#dari').value;
const tujuanEl = document.querySelector('#tujuan')
const tujuan = document.querySelector('#tujuan').value;
const bus = document.querySelector('#bus');
form.addEventListener('submit', (e)=> {
	e.preventDefault();
	// alert(dari);
	proceed();
}); 

tujuanEl.addEventListener('change', function(e){
	cekForm(tujuanEl.value,dariEl.value);
})

function cekForm(dariE,tujuanE) {
	if(dari && tujuan !== null) {
		var xhr = new XMLHttpRequest();

		xhr.open('GET','proses.php?dariE='+tujuanE+'&tujuanE='+dariE,true);
			xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		xhr.onload = () => {
			if(xhr.status === 200) {
				var data = JSON.parse(xhr.responseText);
				var html = `<option value="${data.bus}">${data.bus}</option>`;
				var html2 = `<option value="${data.rute}">${data.rute}</option>`;
				const bus = document.querySelector('#bus').innerHTML = html; 
				const rute = document.querySelector('#rute').innerHTML = html2
			}
		}
		xhr.send();
	}
}
function proceed() {
	var dariEl = document.querySelector('#dari');
	var tujuanEl = document.querySelector('#tujuan')
	var bus = document.querySelector('#bus')
	var rute = document.querySelector('#rute')
	var tanggal = document.querySelector('#date')
	 var params = 'dari='+dariEl.value+'&tujuan='+tujuanEl.value+'&nama_bus='+bus.value+'&tanggal='+tanggal.value+'&rute='+rute.value;
	var xhr = new XMLHttpRequest();
	xhr.open('POST','proses.php',true);
		xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.onload = function() {
		if(this.status == 200) {
			document.location.href = 'order.php'
			// var data =  this.responseText;
			// alert('sukses');
			// var data = JSON.parse(this.responseText);
		}
	}
	xhr.send(params);
}
</script>
</html>