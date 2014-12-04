<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of utility_print
 *
 * @author andreas
 */
require_once __DIR__ . '/../config/config.php';

class utilityCode extends config {

     //put your code here

     public function popup_message($pesan) {
          echo "<script>alert('$pesan');</script>";
     }

     public function show_data($temp) {
          if ($this->debug != "") {
               echo "<pre>";
               print_r($temp);
               echo "</pre>";
          }
     }

     public function location_goto($lokasi) {
          $alamat = $this->url_rewrite_class;
          echo("<script language=\"javascript\">
                                   window.location.href=\"$alamat/$lokasi\";
                                    </script>");
     }

     public function sha512($string) {
          return hash('sha512', $string);
     }

     /*  Fungsi enkripsi_plain2 digunakan untuk algoritma block cipher dengan mode operasi selain stream */

     public function enkripsi($algoritma, $mode, $secretkey, $fileplain) {

          /* Membuka Modul untuk memilih Algoritma & Mode Operasi */
          $td = mcrypt_module_open($algoritma, '', $mode, '');

          /* Inisialisasi IV dan Menentukan panjang kunci yang digunakan */
          $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
          $ks = mcrypt_enc_get_key_size($td);

          /* Menghasilkan Kunci */
          $key = $secretkey;
          //echo "kuncinya : ". $key. "<br>";

          /* Inisialisasi */
          mcrypt_generic_init($td, $key, $iv);

          /* Enkripsi Data, dimana hasil enkripsi harus di encode dengan base64.\
            Hal ini dikarenakan web browser tidak dapat membaca karakter-karakter\
            ASCII dalam bentuk simbol-simbol */
          $buffer = $fileplain;
          $encrypted = mcrypt_generic($td, $buffer);
          $encrypted1 = base64_encode($iv) . ";" . base64_encode($encrypted);
          $encrypted2 = base64_encode($encrypted1);
          $filecipher = $encrypted2;

          /* Menghentikan proses enkripsi dan menutup modul */
          mcrypt_generic_deinit($td);
          mcrypt_module_close($td);


          return $filecipher;
     }

     /*  Fungsi dekripsi_cipher2 digunakan untuk algoritma block cipher dengan mode operasi selain stream */

     public function dekripsi($algoritma, $mode, $iv, $secretkey, $fileplain, $filecipher) {

          /* Membuka Modul untuk memilih Algoritma dan Mode Operasi */
          $td = mcrypt_module_open($algoritma, '', $mode, '');

          /* Inisialisasi IV dan Menentukan panjang kunci yang digunakan */
          $iv = base64_decode($iv);
          $ks = mcrypt_enc_get_key_size($td);

          /* Menghasilkan Kunci */

          $key = $secretkey;

          /* Inisialisasi */
          mcrypt_generic_init($td, $key, $iv);

          /* Dekripsi Data */
          $buffer = $filecipher;
          $buffer = base64_decode($buffer);
          $fileplain = mdecrypt_generic($td, $buffer);

          /* Menghentikan proses dekripsi dan menutup modul */
          mcrypt_generic_deinit($td);
          mcrypt_module_close($td);

          return $fileplain;
     }

     public function format_tanggal($tgl) {
          if ($tgl != "0000-00-00" && $tgl != "") {
               $temp = explode(" ", $tgl);
               $temp = explode("-", $temp[0]);
               $tahun = $temp[0];
               $bln = $temp[1];
               $hari = $temp[2];


               switch ($bln) {
                    case "01" : $namaBln = "Jan";
                         break;
                    case "02" : $namaBln = "Feb";
                         break;
                    case "03" : $namaBln = "Mar";
                         break;
                    case "04" : $namaBln = "Apr";
                         break;
                    case "05" : $namaBln = "May";
                         break;
                    case "06" : $namaBln = "Jun";
                         break;
                    case "07" : $namaBln = "Jul";
                         break;
                    case "08" : $namaBln = "Aug";
                         break;
                    case "09" : $namaBln = "Sep";
                         break;
                    case "10" : $namaBln = "Oct";
                         break;
                    case "11" : $namaBln = "Nov";
                         break;
                    case "12" : $namaBln = "Dec";
                         break;
               }
               $tgl_full = "$hari $namaBln $tahun";
               return $tgl_full;
          } else
               return "";
     }
     
     

     public function format_tanggal_time($tgl) {
          if ($tgl != "0000-00-00 00:00:00" && $tgl != "") {

               $temp = explode(" ", $tgl);
               $jam = $temp[1];

               $temp = explode("-", $temp[0]);
               $tahun = $temp[0];
               $bln = $temp[1];
               $hari = $temp[2];


               switch ($bln) {
                    case "01" : $namaBln = "Jan";
                         break;
                    case "02" : $namaBln = "Feb";
                         break;
                    case "03" : $namaBln = "Mar";
                         break;
                    case "04" : $namaBln = "Apr";
                         break;
                    case "05" : $namaBln = "May";
                         break;
                    case "06" : $namaBln = "Jun";
                         break;
                    case "07" : $namaBln = "Jul";
                         break;
                    case "08" : $namaBln = "Aug";
                         break;
                    case "09" : $namaBln = "Sep";
                         break;
                    case "10" : $namaBln = "Oct";
                         break;
                    case "11" : $namaBln = "Nov";
                         break;
                    case "12" : $namaBln = "Dec";
                         break;
               }
               $tgl_full = "$hari $namaBln $tahun $jam";
               return $tgl_full;
          } else
               return "";
     }

     public function format_tanggal_db($tgl) {
          if ($tgl != "") {
               $temp = explode(" ", $tgl);
               $hari = $temp[0];
               $bln = $temp[1];
               $tahun = $temp[2];
               
               $jam=$temp[3];


               switch ($bln) {
                    case "Jan" : $namaBln = "01";
                         break;
                    case "Feb" : $namaBln = "02";
                         break;
                    case "Mar" : $namaBln = "03";
                         break;
                    case "Apr" : $namaBln = "04";
                         break;
                    case "May" : $namaBln = "05";
                         break;
                    case "Jun" : $namaBln = "06";
                         break;
                    case "Jul" : $namaBln = "07";
                         break;
                    case "Aug" : $namaBln = "08";
                         break;
                    case "Sep" : $namaBln = "09";
                         break;
                    case "Oct" : $namaBln = "10";
                         break;
                    case "Nov" : $namaBln = "11";
                         break;
                    case "Dec" : $namaBln = "12";
                         break;
               }
               $tgl_full = "$tahun-$namaBln-$hari $jam ";
               return $tgl_full;
          } else
               return "";
     }
     
     

     //deleter direktori
     public function upload_gambar($file, $folder, $type,$filesave) {

          $folder_resize = $folder;
          if (!file_exists($folder)) {
               mkdir($folder, 0777);
            
          }

          if ($type == 1) {
               $allowed = array('image/pjpeg', 'image/jpeg', 'image/jpeg',
                   'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png',
                   'image/x-png');
          } else if ($type == 2) {
               $allowed = array('application/msword', 'application/pdf');
          }
          $c = $_FILES[$file]['type'];
          //echo("Masuk $c");
          $filename = $_FILES[$file]['name'];
          if (in_array($_FILES[$file]['type'], $allowed)) {
               //echo("Masuk 112");
               //Where the file must be uploaded to
               if ($folder)
                    $folder .= '/'; //Add a '/' at the end of the folder
               $uploadfile = $folder . $filesave;
               $result = "$uploadfile  ..";
               //Move the file from the stored location to the new location
               if (move_uploaded_file($_FILES[$file]['tmp_name'], $uploadfile)) {
                    chmod("$uploadfile", 0777);

                    $file1 = $_FILES[$file]['name'];
                   /* if ($type != 2)
                         resize("$file1", 300, 300, $folder_resize, "");
                    */
                    $result .= "harusnya masuk $uploadfile ....";
               } else {
                    if (!$_FILES[$file_id]['size']) { //Check if the file is made
                         unlink($uploadfile); //Delete the Empty file
                         $file_name = '';
                         $result .= "Empty file found - please use a valid file."; //Show the error message
                    } else {
                         chmod($uploadfile, 0777); //Make it universally writable.
                    }
               }
          }
          return $result;
     }

     public function delete_directory($dirname) {
          if (is_dir($dirname))
               $dir_handle = opendir($dirname);
          if (!$dir_handle)
               return false;
          while ($file = readdir($dir_handle)) {
               if ($file != "." && $file != "..") {
                    if (!is_dir($dirname . "/" . $file))
                         unlink($dirname . "/" . $file);
                    else
                         delete_directory($dirname . '/' . $file);
               }
          }
          closedir($dir_handle);
          rmdir($dirname);
          return true;
     }

}

?>
