<?php
//mulai proses tambah data

	// definisi base url
	$base_url = $_SERVER['DOCUMENT_ROOT'].'/crudinphp/';
	$GLOBALS['base_url'] = $base_url;

//cek dahulu, jika tombol tambah di klik
if(isset($_POST['btn_submit'])){
	
	//inlcude atau memasukkan file koneksi ke database
	include_once($base_url.'connections/DBconnection.php');
	
	//jika tombol tambah benar di klik maka lanjut prosesnya
	$nim		= $_POST['nim'];	//membuat variabel $nis dan datanya dari inputan NIS
	$nama		= $_POST['nama'];	//membuat variabel $nama dan datanya dari inputan Nama Lengkap
	$kelas		= $_POST['kelas'];	//membuat variabel $kelas dan datanya dari inputan dropdown Kelas
	$jurusan	= $_POST['jurusan'];	//membuat variabel $jurusan dan datanya dari inputan dropdown Jurusan
	
	//melakukan query dengan perintah INSERT INTO untuk memasukkan data ke database
	$input = mysql_query("INSERT INTO mahasiswa VALUES('$nim', '$nama', '$kelas', '$jurusan')") or die(mysql_error());
	
	//jika query input sukses
	if($input){
		
		echo 'Data berhasil di tambahkan! ';		//Pesan jika proses tambah sukses
		echo '<a href="tambah.php">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah
		
	}else{
		
		echo 'Gagal menambahkan data! ';		//Pesan jika proses tambah gagal
		echo '<a href="tambah.php">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah
		
	}
 
}else{	//jika tidak terdeteksi tombol tambah di klik
 
	//redirect atau dikembalikan ke halaman tambah
	echo '<script>window.history.back()</script>';
 
}
?>