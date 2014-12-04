<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../utility/database/mysql_db.php';
require_once __DIR__ . '/../utility/utilityCode.php';

//Untuk Model 
require_once __DIR__ . '/../model/modelPengguna.php';
//Akhir Model

$CONFIG = new config();
$DB = new mysql_db();
$UTILITY = new utilityCode();

$PENGGUNA = new modelPengguna();
 if (isSet($cookie_name)) {
     // Check if the cookie exists
      $UTILITY->show_data("asdasd");
      if (isSet($_COOKIE[$cookie_name])) {
          parse_str($_COOKIE[$cookie_name]);
     
         //list($iv,$hash)= explode (";", $hash);
          //$fileplain=  $UTILITY->dekripsi($algoritma, $mode, $iv, $secretkey, $fileplain, $hash);
          
         // $hash=$fileplain;
          $data = array("username" => "$usr", "user_id" => $hash);
           
          $hasil = $PENGGUNA->readPengguna($data);
          $panjang = count($hasil);
            $UTILITY->show_data($hasil);
            echo "Panjangg $panjang";
          if ($panjang < 1) {
               session_destroy();
               $UTILITY->location_goto("index.php");
          } else {
               $pass = $hasil->password;
               $nam = $hasil->username;
               $user_id = $hasil->user_id;
               $level = $hasil->level;
               $keterangan = $hasil->keterangan;
               $provinsi = $hasil->provinsi;
               $kabupaten = $hasil->kabupaten;
               $status_user = $hasil->status_user;

               //set session
               $_SESSION['keterangan'] = $keterangan;
               $_SESSION['provinsi'] = $provinsi;
               $_SESSION['kabupaten'] = $kabupaten;
               $_SESSION['status_user'] = $status_user;
               $_SESSION['level'] = $level;
               $_SESSION['user_id'] = $user_id;
               $_SESSION['user_name'] = $nam;

               $UTILITY->location_goto("#");
          }
          // Make a verification
     } 
     else{
          session_destroy();
          $UTILITY->location_goto("index.php");
     }
} else {
     $UTILITY->popup_message("Maaf anda harus login terlebih dahulu!!");
     session_destroy();
     
     $UTILITY->location_goto("#");
}
?>
