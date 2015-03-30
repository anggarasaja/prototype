<?php

include '../../config/application.php';
if(isset($_POST['namapelatih'])){
$nama = $purifier->purify($_POST['namapelatih']);
$id_pelatih = $purifier->purify($_POST['id_pelatih']);
$jenkel = $purifier->purify($_POST['jenkel']);
$cabor = $purifier->purify($_POST['cabor']);
$propinsi = $purifier->purify($_POST['propinsi']);
$alamat = $purifier->purify($_POST['alamat']);


$data_form= array(
	"pelatih"=> $nama,
	"id_pelatih"=> $id_pelatih,
	"id_jk"=> $jenkel,
	"id_cabor" =>$cabor,
	"id_propinsi" =>$propinsi,
	"alamat" =>$alamat,
);

$PELATIH->updatePelatih($data_form);
} else {
echo "data null";
}

