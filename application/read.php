<!DOCTYPE html>
<html>
<head>
	<title>Simple CRUD from TUTORIALWEB.NET</title>

	<!-- Base url/ root dokumen; di simpan di variabel global-->
	<!-- note : seharusnya deklarasi ini disimpan pada bagian index/ di page yang pertama di load -->
	<?php 
		$base_url = $_SERVER['DOCUMENT_ROOT'].'/crudinphp/';
		$GLOBALS['base_url'] = $base_url;
	?>

</head>
<body>
	<h2>Simple CRUD</h2>
	
	<p><a href="home.php">Beranda</a> / <a href="create.php">Tambah Data</a></p>
	
	<h3>Data Siswa</h3>
	
	<table cellpadding="5" cellspacing="0" border="1">
		<tr bgcolor="#CCCCCC">
			<th>No.</th>
			<th>NIS</th>
			<th>Nama Lengkap</th>
			<th>Kelas</th>
			<th>Jurusan</th>
			<th>Opsi</th>
		</tr>
		
		<?php
		//iclude file koneksi ke database
		include_once($base_url.'connections/DBconnection.php');
		
		//query ke database dg SELECT table siswa diurutkan berdasarkan NIS paling besar
		$query = mysql_query("SELECT * FROM mahasiswa ORDER BY NIM DESC") or die(mysql_error());
		
		//cek, apakakah hasil query di atas mendapatkan hasil atau tidak (data kosong atau tidak)
		if(mysql_num_rows($query) == 0){	//ini artinya jika data hasil query di atas kosong			
			
			//jika data kosong, maka akan menampilkan row kosong
			echo '<tr><td colspan="6">Tidak ada data!</td></tr>';

		}else{	//else ini artinya jika data hasil query ada (data diu database tidak kosong)
			
			//jika data tidak kosong, maka akan melakukan perulangan while
			$no = 1;	//membuat variabel $no untuk membuat nomor urut
			while($data = mysql_fetch_assoc($query)){	//perulangan while dg membuat variabel $data yang akan mengambil data di database
				
				//menampilkan row dengan data di database
				echo '<tr>';
					echo '<td>'.$no.'</td>';	//menampilkan nomor urut
					echo '<td>'.$data['NIM'].'</td>';	//menampilkan data nis dari database
					echo '<td>'.$data['NAMA'].'</td>';	//menampilkan data nama lengkap dari database
					echo '<td>'.$data['KELAS'].'</td>';	//menampilkan data kelas dari database
					echo '<td>'.$data['JURUSAN'].'</td>';	//menampilkan data jurusan dari database
					echo '<td><a href="update.php?id='.$data['NIM'].'">Edit</a> / <a href="delete.php?id='.$data['NIM'].'" onclick="return confirm(\'Yakin?\')">Hapus</a></td>';	//menampilkan link edit dan hapus dimana tiap link terdapat GET id -> ?id=siswa_id
				echo '</tr>';
				
				$no++;	//menambah jumlah nomor urut setiap row
				
			}
			
		}
		?>

	</table>

	<br>
	<a href="backendcode/export-to-excel.php">Export Data to Excel</a>
	<span>
	<a href="backendcode/export-to-excel-using-phpexcel.php">Export Data to Excel using PHPEXCEL</a>


	<!-- footer -->
	<p><strong>sumber: </strong><?php echo "&nbsp;"; ?><a href="http://tutorialweb.net/membuat-aplikasi-crud-sederhana-dengan-php-dan-mysql/">TutorialWeb.net</a></p>
</body>
</html>