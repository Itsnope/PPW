<?php 
$kodeErr = $namaErr = $hargaErr = $stokErr = $jenisErr = $deskripsiErr = "";
if(isset($_POST['save'])){
	if(!isset($_POST['kode_salad']) || !isset($_POST['nama_salad']) || !isset($_POST['jenis_salad']) || !isset($_POST['deskripsi_salad']) || !isset($_POST['harga_salad']) || !$_POST['stok_salad']){
		if($_POST['kode_salad'] == ""){
		$kodeErr = "Kode salad tidak boleh kosong!";
		}
		if($_POST['nama_salad'] == ""){
			$namaErr = "Nama salad tidak boleh kosong!";
		}
		if($_POST['harga_salad'] == ""){
			$hargaErr = "Harga salad tidak boleh kosong!";
		}
		if($_POST['stok_salad'] == ""){
			$stokErr = "Stok salad tidak boleh kosong!";
		}
		if($_POST['jenis_salad'] == ""){
			$stokErr = "Jenis salad tidak boleh kosong!";
		}
		if($_POST['deskripsi_salad'] == ""){
			$stokErr = "Deskripsi salad tidak boleh kosong!";
		}
	}else{
		$kode = $_POST['kode_salad'];
		$nama = $_POST['nama_salad'];
		$harga = $_POST['harga_salad'];
		$stok = $_POST['stok_salad'];
		$jenis = $_POST['jenis_salad'];
		$deskripsi = $_POST['deskripsi_salad'];

		$query = "INSERT INTO salad (kode_salad,nama_salad,harga_salad,stok_salad,jenis_salad,deskripsi_salad) VALUES('$kode', '$nama', '$harga', '$stok', '$jenis', '$deskripsi')";
		if (mysqli_query($connect, $query)) {
			echo "<div class=\"alert alert-success\" role=\"alert\">Berhasil disimpan</div>";
		}else{
			echo "<div class=\"alert alert-danger\" role=\"alert\">Gagal disimpan</div>";
		}
	}
}
 ?>

<a href="<?= $WEB_CONFIG['base_url'] ?>" class="btn btn-warning mb-3">
	<svg style="width:20px;height:20px" viewBox="0 0 24 24" class="mb-1">
    	<path fill="#000000" d="M2,12A10,10 0 0,1 12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12M18,11H10L13.5,7.5L12.08,6.08L6.16,12L12.08,17.92L13.5,16.5L10,13H18V11Z" />
	</svg> Back To Data
</a>
<div class="container">
	<form action="" method="post">
		<div class="form-group">
			<label for="inputKode">Kode salad</label>
			<input type="text" name="kode_salad" class="form-control" id="inputKode" maxlength="40" required autofocus>
			<small class="text-danger"><?= $kodeErr == "" ? "":"* $kodeErr " ?></small>
		</div>
		<div class="form-group">
			<label for="inputnama">Nama salad</label>
			<input type="text" name="nama_salad" class="form-control" id="inputnama" maxlength="30" required>
			<small class="text-danger"><?= $namaErr == "" ? "":"* $namaErr" ?></small>
		</div>
		<div class="form-group">
			<label for="inputHarga">Harga salad</label>
			<input type="text" name="harga_salad" class="form-control" id="inputHarga" maxlength="30" minlength="3" required>
			<small class="text-danger"><?= $hargaErr == "" ? "":"* $hargaErr" ?></small>
		</div>
		<div class="form-group">
			<label for="inputStok">Stok salad</label>
			<input type="text" name="stok_salad" class="form-control" id="inputStok" maxlength="50" required>
			<small class="text-danger"><?= $stokErr == "" ? "":"* $stokErr" ?></small>
		</div>
		<div class="form-group">
			<label for="inputJenis">Jenis salad</label>
			<select name="jenis_salad" class="form-control" id="inputJenis" required>
				<option value="" disabled selected>Pilih jenis salad</option>
				<option value="Vegetarian">Vegetarian</option>
				<option value="Non-Vegetarian">Non-Vegetarian</option>
				<option value="Fruit Salad">Fruit Salad</option>
			</select>
			<small class="text-danger"><?= $jenisErr == "" ? "":"* $jenisErr" ?></small>
		</div>
		<div class="form-group">
			<label for="inputDeskripsi">Deskripsi salad</label>
			<input type="text" name="deskripsi_salad" class="form-control" id="inputDeskripsi" required>
			<small class="text-danger"><?= $deskripsiErr == "" ? "":"* $deskrpsiErr" ?></small>
		</div>
		<input type="submit" class="btn btn-dark m-1" name="save" value="Save Now!">
	</form>
</div>
