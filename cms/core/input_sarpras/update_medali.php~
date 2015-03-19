<?php

include '../../config/application.php';
$id_row = $_POST['id_row'];
if(isset($_POST['emas-update-'.$id_row])){
$emas = $purifier->purify($_POST['emas-update-'.$id_row]);
$perak = $purifier->purify($_POST['perak-update-'.$id_row]);
$perunggu = $purifier->purify($_POST['perunggu-update-'.$id_row]);
$id_cabor = $purifier->purify($_POST['cabor-update-'.$id_row]);
$id_propinsi = $purifier->purify($_POST['propinsi-update-'.$id_row]);
$tahun = $purifier->purify($_POST['tahun-update-'.$id_row]);
$kejuaraan = $purifier->purify($_POST['kejuaraan-update-'.$id_row]);


$data_form= array(
	"emas"=> $emas,
	"perak"=> $perak,
	"perunggu"=> $perunggu,
	"id_cabor" =>$id_cabor,
	"id_propinsi" => $id_propinsi,
	"tahun" => $tahun,
	"kejuaraan" => $kejuaraan,
	"id_medali" => $id_row
);

$MEDALI->updateMedali($data_form);
} else {
echo "data null";
}

