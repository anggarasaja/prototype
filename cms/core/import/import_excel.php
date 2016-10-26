<?php

include '../../config/application.php';
include '../../library/excel/PHPExcel/IOFactory.php';

	if(isset($_POST) && !empty($_FILES['fileimport']['name'])) {
        $path = $_FILES['fileimport']['name'];
        $ext  = pathinfo($path, PATHINFO_EXTENSION);
        if($ext != 'xls' && $ext != 'xlsx') {
          $UTILITY->popup_message("Maaf jenis file tidak sesuai");
          $UTILITY->location_goto("content/import_file");
        }
        else {
          $time        = time();
          $target_dir  = $path_upload;
          $target_name = basename(date("Ymd-His-\I\M\P\O\R\T.",$time).$ext);
          $target_file = $target_dir . $target_name;
          $response    = move_uploaded_file($_FILES['fileimport']['tmp_name'],$target_file);
          if($response) {
            try {
              $objPHPExcel = PHPExcel_IOFactory::load($target_file);
            }
            catch(Exception $e) {
              die('Kesalahan! Gagal dalam mengupload file : "'.pathinfo($_FILES['excelupload']['name'],PATHINFO_BASENAME).'": '.$e->getMessage());
            }
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(NULL,TRUE,FALSE,TRUE);
            $PELOPOR->importFile($allDataInSheet);
            $UTILITY->popup_message("Berhasil! Data telah di masukkan");
        	$UTILITY->location_goto("content/import_file");
          }
        }
      }
      else {
      	$UTILITY->popup_message("Maaf terjadi kesalahan dalam upload file");
        $UTILITY->location_goto("content/import_file");
      }

