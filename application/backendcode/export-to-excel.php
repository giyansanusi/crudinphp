<?PHP
  // Original PHP code by Chirp Internet: www.chirp.com.au
  // Please acknowledge use of this code by including this header.
  // Edited by : Giyan
  // 18 April 2017

  //metode ini hanya bisa menampung 5000 data :(

  // definisi base url
  $base_url = $_SERVER['DOCUMENT_ROOT'].'/crudinphp/';
  $GLOBALS['base_url'] = $base_url;

  //inlcude atau memasukkan file koneksi ke database
  include_once($base_url.'connections/DBconnection.php');

  // Fungsi untuk meng handle karakter input
  function cleanData(&$str)
  {
    // handling karakter tab
    $str = preg_replace("/\t/", "\\t", $str);

    // handling karakter enter
    $str = preg_replace("/\r?\n/", "\\n", $str);

    // convert 't' and 'f' menjadi nilai boolean
    if($str == 't') $str = 'TRUE';
    if($str == 'f') $str = 'FALSE';

    // handle karakter doubel quotes
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

  // Nama File excel yang akan di download
  $filename = "Excel_report_" . date('Ymd') . ".xls";

  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  $result = mysql_query("SELECT * FROM mahasiswa ORDER BY NIM DESC") or die(mysql_error());
  while(false !== ($row = mysql_fetch_assoc($result))) {

    if(!$flag) {
      // Bagian ini untuk menampilkan nama kolom
      echo implode("\t", array_keys($row)) . "\r\n";
      $flag = true;
    }

    //menampilkan data
    array_walk($row, __NAMESPACE__ . '\cleanData');
    echo implode("\t", array_values($row)) . "\r\n";
  }
  exit;
?>