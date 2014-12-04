<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
//error_reporting(E_ALL ^ E_NOTICE);
//seeting untuk session
session_start(); // Start Session
header('Cache-control: private'); // IE 6 FIX
// always modified 
header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
// HTTP/1.1 
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
// HTTP/1.0 
header('Pragma: no-cache');


$cookie_name = 'siteAuth';
$cookie_time = (3600 * 24 * 30); // 30 days
//akhir setting untuk session
//setting untuk configurasi enkripsi
$algoritma = "rijndael-256";
$mode = "cfb";
$secretkey = "menpora1234";
$TITLE="CMS GIS V2";
$url_rewrite = "http://localhost/menporamaps/cms/";
$url_img = "http://localhost/menporamaps/cms/";

$REQUEST="menporamaps/cms/content";
$PROSES_REQUEST="menporamaps/cms/proses";

$domain = "localhost";
$path="/srv/www/htdocs/menporamaps/cms/";

$path_upload="/srv/www/htdocs/menporamaps/img/";
$path_upload_album="/srv/www/htdocs/menporamaps/album";

class config {

     public $db_host = "localhost";
     public $db_user = "root";
     public $db_pass = "";
     public $database = "gis_v2";
     public $url_rewrite_class = "http://localhost/menporamaps/cms";
     public $session_expired_time = ""; //in second
     public $hashing_number = "d4t4b4s3_m3np0r41235";
     public $debug = 1;

     public function open_connection() {
        
          $this->link_db = mysqli_connect($this->db_host, $this->db_user, $this->db_pass,$this->database)
                  or die("Koneksi Database gagal");
          //$hasil = mysqli_select_db($this->database);

          return $this->link_db;
     }

}

?>
