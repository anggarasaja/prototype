<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'mcrypt_function.php';

$filecipher=enkripsi_plain2("rijndael-256","cfb","helpdesk","user_id=1&status_user=1123asdad131");

$filecipher=base64_decode($filecipher);

echo("File chipper: $filecipher<br/>");
echo("<br/>File cipher: $filecipher<br/>");

//untuk dekripsi
list($iv,$filecipher)= explode (";", $filecipher);
/* Memanggil fungsi dekripsi_cipher2 algoritma blok*/
$fileplain=dekripsi_cipher2("rijndael-256","cfb",$iv,"helpdesk",$fileplain,$filecipher);
echo("<br/>File plain: $fileplain<br/>");


?>
