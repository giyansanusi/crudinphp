<?php

  // definisi base url
  $base_url = $_SERVER['DOCUMENT_ROOT'].'/crudinphp/';
  $GLOBALS['base_url'] = $base_url;

  //inlcude atau memasukkan file koneksi ke database
  include_once($base_url.'connections/DBconnection.php');

  /** PHPExcel */
  require_once $base_url.'library/PHPExcel.php';
  
   
  $query = mysql_query("SELECT * FROM mahasiswa ORDER BY NIM ASC");
  // Create new PHPExcel object
  $object = new PHPExcel();
   
  // Set properties
  $object->getProperties()->setCreator("Sanusi")
                 ->setLastModifiedBy("Sanusi")
                 ->setCategory("Approve by ");
   
  //add data
  $flag = true;
  $counter = 1;
  $worksheet = $object->setActiveSheetIndex(0);
  while($row = mysql_fetch_assoc($query)){
             
        if ($flag == true) {
          $char = 'A';
          foreach ($row as $key => $value) { // Loops 4 times because there are 4 columns
              $worksheet->setCellValue($char.$counter,$key);
              $char++;
          }
          

          $counter++;
          $flag = false;
        }

        $worksheet->setCellValue("A".$counter,$row['NIM']);
        $worksheet->setCellValue("B".$counter,$row['NAMA']);
        $worksheet->setCellValue("C".$counter,$row['KELAS']);
        $worksheet->setCellValue("D".$counter,$row['JURUSAN']);
        
        $counter++;
             
  }    
   
  // Rename sheet
  //$object->getActiveSheet()->setTitle('Excel_Report_'. date('Ymd'));
   
   
  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
  $object->setActiveSheetIndex(0);
   
   
  // Redirect output to a client’s web browser (Excel2007)
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="Excel_Report_'. date('Ymd').'.xls');
  header('Cache-Control: max-age=0');
   
  $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
  $objWriter->save('php://output');
  exit;
?>