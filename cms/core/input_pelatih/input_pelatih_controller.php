<?php

include '../../config/application.php';

if(isset($_POST['namapelatih']) && isset($_POST['jenkel']) && isset($_POST['cabor']) && isset($_POST['propinsi'])){
$nama = $purifier->purify($_POST['namapelatih']);
$jenkel = $purifier->purify($_POST['jenkel']);
$cabor = $purifier->purify($_POST['cabor']);
$propinsi = $purifier->purify($_POST['propinsi']);
$alamat = $purifier->purify($_POST['alamat']);

$data_form= array(
	"pelatih"=> $nama,
	"id_jk"=> $jenkel,
	"id_cabor" =>$cabor,
	"id_propinsi" =>$propinsi,
	"alamat" =>$alamat
);

$PELATIH->insertPelatihData($data_form);
} else {
echo "data null";
}


