<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'mcrypt_function.php';

$temp= str_replace ("%20"," ",$_GET['text']);
$filecipher=  str_replace("%21", "+", $temp);
$filecipher2="0BYzMOV+laqiY90/M4R0A4DP0Fvtn6/ZZFf+Uu6/758=;Drkx/YN1MZVeHNy47DTjat8XIZjk0D89PvYQUEDe9jzXSg==";

if($filecipher==$filecipher2)
     echo "<h1>Sama</h1>";
echo("<br/>File cipher: $filecipher<br/>$filecipher2");
list($iv,$filecipher)= explode (";", $filecipher);
/* Memanggil fungsi dekripsi_cipher2 algoritma blok*/
$fileplain=dekripsi_cipher2("rijndael-256","cfb",$iv,"helpdesk",$fileplain,$filecipher);
echo("<br/>File plain: $fileplain<br/>")
?>
