<?php

include '../../config/application.php';

if(isset($_POST['namapemuda']) && isset($_POST['jenkel']) && isset($_POST['propinsi']) && isset($_POST['keterangan'])){
$nama = $purifier->purify($_POST['namapemuda']);
$jenkel = $purifier->purify($_POST['jenkel']);
$propinsi = $purifier->purify($_POST['propinsi']);
$keterangan = $purifier->purify($_POST['keterangan']);

echo $keterangan;

$data_form= array(
	"pemuda"=> $nama,
	"id_jk"=> $jenkel,
	"id_propinsi" =>$propinsi,
	"keterangan" => $keterangan
);

$PEMUDA->insertPemudaData($data_form);
} else {
echo "data null";
}


