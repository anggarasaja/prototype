<?php

include '../../config/application.php';

if(isset($_POST['emas']) && isset($_POST['perak']) && isset($_POST['perunggu']) && isset($_POST['id_cabor'])){
$emas = $purifier->purify($_POST['emas']);
$perak = $purifier->purify($_POST['perak']);
$perunggu = $purifier->purify($_POST['perunggu']);
$id_cabor = $purifier->purify($_POST['id_cabor']);
$id_propinsi = $purifier->purify($_POST['id_propinsi']);
$tahun = $purifier->purify($_POST['tahun']);
$kejuaraan = $purifier->purify($_POST['kejuaraan']);

$data_form= array(
	"emas"=> $emas,
	"perak"=> $perak,
	"perunggu"=> $perunggu,
	"id_cabor" =>$id_cabor,
	"id_propinsi" => $id_propinsi,
	"tahun" => $tahun,
	"kejuaraan" => $kejuaraan
);

$MEDALI->insertMedaliData($data_form);
} else {
echo "data null";
}


