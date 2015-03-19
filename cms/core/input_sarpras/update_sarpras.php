<?php

include '../../config/application.php';
$id_row = $_POST['id_row'];
if(isset($_POST['nama-sarpras-update-'.$id_row])){
$nama = $purifier->purify($_POST['nama-sarpras-update-'.$id_row]);
$alamat = $purifier->purify($_POST['alamat-update-'.$id_row]);
$lat = $purifier->purify($_POST['lat-update-'.$id_row]);
$lng = $purifier->purify($_POST['lng-update-'.$id_row]);
$id_propinsi = $purifier->purify($_POST['propinsi-update-'.$id_row]);


$data_form= array(
	"nama"=> $nama,
	"alamat"=> $alamat,
	"lat"=> $lat,
	"lng" =>$lng,
	"id_propinsi" => $id_propinsi,
	"id_sarpras" => $id_row
);

$SARPRAS->updateSarpras($data_form);
} else {
echo "data null";
}

