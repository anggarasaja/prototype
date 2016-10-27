<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
require_once __DIR__ .'/../config/config.php';
require_once __DIR__ .'/../utility/database/mysql_db.php';
require_once __DIR__ .'/../utility/utilityCode.php';

//Untuk Model 
require_once __DIR__ . '/../model/modelPengguna.php';
//Akhir Model


$CONFIG= new config();
$DB=new mysql_db();
$UTILITY=new utilityCode();

$PENGGUNA=new modelPengguna();

$id = $_POST['Login'];
//echo "ID=$id";
if ( isSet($id)) {
     $user_name1 = $_POST['username'];
     $user_pass1 = $UTILITY->sha512($_POST['password']);
     
     if (!$user_pass1 || !$user_name1) {
          $UTILITY->popup_message("Maaf anda harus login terlebih dahulu!");
          $UTILITY->location_goto(".");
     } else {
          //$data = array("username" => "$user_name1", "status_user" => 1);
          $data = array("username" => "$user_name1");
          $hasil = $PENGGUNA->readPengguna($data);
          $panjang = count($hasil);
          if ($panjang < 1) {
               session_destroy();
               $UTILITY->location_goto(".");
          } else {
               $pass = $hasil->password;
               $nam = $hasil->username;
               $user_id = $hasil->user_id;
               $level = $hasil->level;
               $keterangan = $hasil->keterangan;
               $provinsi = $hasil->provinsi;
               $kabupaten = $hasil->kabupaten;
               $status_user = $hasil->status_user;
          }

          if (($user_name1 == $nam) && ($user_pass1 != $pass)) {
               $UTILITY->popup_message("Maaf password atau username tidak ada!");
               session_destroy();
               $UTILITY->location_goto(".");
          }
          if ($user_name1 != $nam && $user_pass1 == $pass) {
               $UTILITY->popup_message("Maaf password atau username tidak ada!");
               session_destroy();
               $UTILITY->location_goto(".");
          }
          if ($user_name1 != $nam && $user_pass1 != $pass) {
               $UTILITY->popup_message("Maaf password atau username tidak ada!");
               session_destroy();
               $UTILITY->location_goto(".");
          }

          if ($user_name1 == $nam && $user_pass1 == $pass) {
               $_SESSION['keterangan'] = $keterangan;
               $_SESSION['provinsi'] = $provinsi;
               $_SESSION['kabupaten'] = $kabupaten;
               $_SESSION['status_user'] = $status_user;
               $_SESSION['level'] = $level;
               $_SESSION['user_id'] = $user_id;
               $_SESSION['user_name'] = $nam;
                //enkripsi
              // $hash = $UTILITY->enkripsi($algoritma, $mode, $secretkey, "$user_id");
               //$user_id_hash = base64_decode($hash);
               //enkripsi
               //setting cookies --> paramater berasal dari application.php
                 //echo "MASUKKK";
             $user_id_hash=$user_id;  
             
               $status=setcookie($cookie_name, 'usr=' . $nam. '&hash=' . $user_id_hash, time() + $cookie_time,"/","$domain");
            //   $_SESSION['cookies'] = 'usr=' . $nam . '&hash=' . $user_id_hash;
              if ($level != ""){
                   //$UTILITY->show_data($_COOKIE);
                    $UTILITY->location_goto("content/home");
              }
 
          }
     }
}
else {
     //bila sudah teridentifikasi
     $username = $_SESSION['username'];
     if ($username != "")
          $UTILITY->location_goto("content/home");
     else
     //bila belum login
     echo "Belum masuk";
       //   $UTILITY->location_goto(".");
}
?>

