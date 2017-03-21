
<?php
//memulai proses hapus data
 
 // definisi base url
	$base_url = $_SERVER['DOCUMENT_ROOT'].'/crudinphp/';
	$GLOBALS['base_url'] = $base_url;

//cek dahulu, apakah benar URL sudah ada GET id -> hapus.php?id=NIM
if(isset($_GET['id'])){
	
	//inlcude atau memasukkan file koneksi ke database
	include_once($base_url.'connections/DBconnection.php');
	
	//membuat variabel $id yg bernilai dari URL GET id -> hapus.php?id=siswa_id
	$id = $_GET['id'];
	
	//cek ke database apakah ada data siswa dengan siswa_id='$id'
	$cek = mysql_query("SELECT NIM FROM mahasiswa WHERE NIM='$id'") or die(mysql_error());
	
	//jika data siswa tidak ada
	if(mysql_num_rows($cek) == 0){
		
		//jika data tidak ada, maka redirect atau dikembalikan ke halaman beranda
		echo '<script>window.history.back()</script>';
	
	}else{
		
		//jika data ada di database, maka melakukan query DELETE table siswa dengan kondisi WHERE siswa_id='$id'
		$del = mysql_query("DELETE FROM mahasiswa WHERE NIM='$id'");
		
		//jika query DELETE berhasil
		if($del){
			
			echo 'Data siswa berhasil di hapus! ';		//Pesan jika proses hapus berhasil
			echo '<a href="index.php">Kembali</a>';	//membuat Link untuk kembali ke halaman beranda
			
		}else{
			
			echo 'Gagal menghapus data! ';		//Pesan jika proses hapus gagal
			echo '<a href="index.php">Kembali</a>';	//membuat Link untuk kembali ke halaman beranda
		
		}
		
	}
	
}else{
	
	//redirect atau dikembalikan ke halaman beranda
	echo '<script>window.history.back()</script>';
	
}
?>