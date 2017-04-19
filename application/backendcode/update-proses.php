
<?php
//mulai proses edit data
	
	// definisi base url
	$base_url = $_SERVER['DOCUMENT_ROOT'].'/crudinphp/';
	$GLOBALS['base_url'] = $base_url;
 
//cek dahulu, jika tombol simpan di klik
if(isset($_POST['btn_simpan'])){
	
	//inlcude atau memasukkan file koneksi ke database
	include_once($base_url.'connections/DBconnection.php');
	
	//jika tombol tambah benar di klik maka lanjut prosesnya
	$nim		= $_POST['nim'];	//membuat variabel $nis dan datanya dari inputan NIM
	$nama		= $_POST['nama'];	//membuat variabel $nama dan datanya dari inputan Nama Lengkap
	$kelas		= $_POST['kelas'];	//membuat variabel $kelas dan datanya dari inputan dropdown Kelas
	$jurusan	= $_POST['jurusan'];	//membuat variabel $jurusan dan datanya dari inputan dropdown Jurusan
	
	//melakukan query dengan perintah UPDATE untuk update data ke database dengan kondisi WHERE siswa_id='$id' <- diambil dari inputan hidden id
	$update = mysql_query("UPDATE mahasiswa SET NIM='$nim', NAMA='$nama', KELAS='$kelas', JURUSAN='$jurusan' WHERE NIM='$nim'") or die(mysql_error());
	
	//jika query update sukses
	if($update){
		
		echo 'Data berhasil di simpan! ';		//Pesan jika proses simpan sukses
		echo '<a href="update.php?id='.$nim.'">Kembali</a>';	//membuat Link untuk kembali ke halaman edit
		
	}else{
		
		echo 'Gagal menyimpan data! ';		//Pesan jika proses simpan gagal
		echo '<a href="update.php?id='.$nim.'">Kembali</a>';	//membuat Link untuk kembali ke halaman edit
		
	}
 
}else{	//jika tidak terdeteksi tombol simpan di klik
 
	//redirect atau dikembalikan ke halaman edit
	echo '<script>window.history.back()</script>';
 
}
?>