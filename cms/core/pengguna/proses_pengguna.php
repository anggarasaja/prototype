<?php

include 'config/application.php';
$id = $_SESSION['user_id'];
$username = $purifier->purify($_POST[username]);

$password = $UTILITY->sha512($_POST[password]);
$conf_password = $UTILITY->sha512($_POST[conf_password]);

$user_id = $purifier->purify($_POST[user_id]);
$level = $purifier->purify($_POST[level]);

$provinsi = $purifier->purify($_POST[provinsi]);
$kabupaten = $purifier->purify($_POST[kabupaten]);

//$hapuspengguna = $purifier->purify($_GET['hpengguna']);
$kondisi = $purifier->purify($_POST['kondisi']);

$data_pengguna = array("username" => $username,
    "password" => $password,
    "level" => $level,
    "keterangan" => $keterangan,
    "user_id" => $user_id);

if ($kondisi == "tambah") {
     if ($username == "") {
          $UTILITY->popup_message("'Mohon isi username terlebih dahulu");
          $UTILITY->location_goto("content/setting/tambah");
     } else if ($password == "") {
          $UTILITY->popup_message("'Mohon isi password terlebih dahulu");
          $UTILITY->location_goto("content/setting/tambah");
     } else if ($conf_password == "") {
          $UTILITY->popup_message("'Mohon isi confirmasi password terlebih dahulu");
          $UTILITY->location_goto("content/setting/tambah");
     } else if ($level == "") {
          $UTILITY->popup_message("'Mohon pilih level terlebih dahulu");
          $UTILITY->location_goto("content/setting/tambah");
     } else if ($conf_password != $password) {
          $UTILITY->popup_message("'Maaf password yang anda masukan tidak sama");
          $UTILITY->location_goto("content/setting/tambah");
     } else {

          $PENGGUNA->insertPengguna($data_pengguna);
          $UTILITY->location_goto("content/setting");
     }
} else if ($kondisi == "edit") {
     if ($username == "") {
          $UTILITY->popup_message("'Mohon isi username terlebih dahulu");
          $UTILITY->location_goto("content/setting/tambah");
     } else if ($password == "") {
          $UTILITY->popup_message("'Mohon isi password terlebih dahulu");
          $UTILITY->location_goto("content/setting/tambah");
     } else if ($conf_password == "") {
          $UTILITY->popup_message("'Mohon isi confirmasi password terlebih dahulu");
          $UTILITY->location_goto("content/setting/tambah");
     } else if ($level == "") {
          $UTILITY->popup_message("'Mohon pilih level terlebih dahulu");
          $UTILITY->location_goto("content/setting/tambah");
     } else if ($conf_password != $password) {
          $UTILITY->popup_message("'Maaf password yang anda masukan tidak sama");
          $UTILITY->location_goto("content/setting/tambah");
     } else {
          
          $PENGGUNA->updatePengguna($data_pengguna);
          $UTILITY->location_goto("content/setting");
     }
}
if ($hapuspengguna != "") {
   
     $PENGGUNA->deletePengguna($hapuspengguna);
     $UTILITY->location_goto("content/setting");
}
?>
