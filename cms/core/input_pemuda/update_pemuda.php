<?php

include '../../config/application.php';
if(isset($_POST['namapemuda'])){
$nama = $purifier->purify($_POST['namapemuda']);
$id_pemuda = $purifier->purify($_POST['id_pemuda']);
$jenkel = $purifier->purify($_POST['jenkel']);
$propinsi = $purifier->purify($_POST['propinsi']);
$keterangan = $purifier->purify($_POST['keterangan']);
$alamat = $purifier->purify($_POST['alamat']);

echo $keterangan;

$data_form= array(
	"pemuda"=> $nama,
	"id_pemuda"=> $id_pemuda,
	"id_jk"=> $jenkel,
	"id_propinsi" =>$propinsi,
	"keterangan" => $keterangan,
	"alamat" => $alamat
);

$PEMUDA->updatePemuda($data_form);
} else {
echo "data null";
}

