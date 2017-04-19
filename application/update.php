<!DOCTYPE html>
<html>
<head>
	<title>Simple CRUD by TUTORIALWEB.NET</title>
	<?php 
		$base_url = $_SERVER['DOCUMENT_ROOT'].'/crudinphp/';
		$GLOBALS['base_url'] = $base_url;
	?>
</head>
<body>
	<h2>Simple CRUD</h2>
	
	<p><a href="home.php">Beranda</a> / <a href="create.php">Tambah Data</a></p>
	
	<h3>Edit Data Siswa</h3>
	
	<?php
	//proses mengambil data ke database untuk ditampilkan di form edit berdasarkan NIM yg didapatkan dari GET id -> edit.php?id=siswa_id
	
	//include atau memasukkan file koneksi ke database
	include_once($base_url.'connections/DBconnection.php');
	
	//membuat variabel $id yg nilainya adalah dari URL GET id -> edit.php?id=siswa_id
	$id = $_GET['id'];
	
	//melakukan query ke database dg SELECT table siswa dengan kondisi WHERE siswa_id = '$id'
	$query = mysql_query("SELECT * FROM mahasiswa WHERE NIM='$id'");
	
	//cek apakah data dari hasil query ada atau tidak
	if(mysql_num_rows($query) == 0){
		
		//jika tidak ada data yg sesuai maka akan langsung di arahkan ke halaman depan atau beranda -> index.php
		echo '<script>window.history.back()</script>';
		
	}else{
	
		//jika data ditemukan, maka membuat variabel $data
		$data = mysql_fetch_assoc($query);	//mengambil data ke database yang nantinya akan ditampilkan di form edit di bawah
	
	}
	?>
	
	<form action="backendcode/edit-proses.php" method="post">
		<table cellpadding="3" cellspacing="0">
			<tr>
				<td>NIS</td>
				<td>:</td>
				<td><input type="text" name="nim" value="<?php echo $data['NIM']; ?>" required></td>	<!-- value diambil dari hasil query -->
			</tr>
			<tr>
				<td>Nama Lengkap</td>
				<td>:</td>
				<td><input type="text" name="nama" size="30" value="<?php echo $data['NAMA']; ?>" required></td> <!-- value diambil dari hasil query -->
			</tr>
			<tr>
				<td>Kelas</td>
				<td>:</td>
				<td>
					<select name="kelas" required>
						<option value="">Pilih Kelas</option>
						<option value="A" <?php if($data['KELAS'] == 'A'){ echo 'selected'; } ?>>A</option>	<!-- jika data di database sama dengan value maka akan terselect/terpilih -->
						<option value="B" <?php if($data['KELAS'] == 'B'){ echo 'selected'; } ?>>B</option>	<!-- jika data di database sama dengan value maka akan terselect/terpilih -->
						<option value="C" <?php if($data['KELAS'] == 'C'){ echo 'selected'; } ?>>C</option>	<!-- jika data di database sama dengan value maka akan terselect/terpilih -->
					</select>
				</td>
			</tr>
			<tr>
				<td>Jurusan</td>
				<td>:</td>
				<td>
					<select name="jurusan" required>
						<option value="">Pilih Jurusan</option>
						<option value="Teknik Komputer dan Jaringan" <?php if($data['JURUSAN'] == 'Teknik Komputer dan Informatika'){ echo 'selected'; } ?>>Teknik Komputer dan Informatika</option>	<!-- jika data di database sama dengan value maka akan terselect/terpilih -->
						<option value="Multimedia" <?php if($data['JURUSAN'] == 'Multimedia'){ echo 'selected'; } ?>>Multimedia</option>	<!-- jika data di database sama dengan value maka akan terselect/terpilih -->
						<option value="Akuntansi" <?php if($data['JURUSAN'] == 'Akuntansi'){ echo 'selected'; } ?>>Akuntansi</option>	<!-- jika data di database sama dengan value maka akan terselect/terpilih -->
						<option value="Perbankan" <?php if($data['JURUSAN'] == 'Perbankan'){ echo 'selected'; } ?>>Perbankan</option>	<!-- jika data di database sama dengan value maka akan terselect/terpilih -->
						<option value="Pemasaran" <?php if($data['JURUSAN'] == 'Pemasaran'){ echo 'selected'; } ?>>Pemasaran</option>	<!-- jika data di database sama dengan value maka akan terselect/terpilih -->
					</select>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td></td>
				<td><input type="submit" name="btn_simpan" value="Simpan"></td>
			</tr>
		</table>
	</form>
</body>
</html>