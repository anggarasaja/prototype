<?php

include '../../config/application.php';

if(isset($_POST['nama']) && isset($_POST['alamat']) && isset($_POST['lat']) && isset($_POST['lng']) && isset($_POST['propinsi']))
{
$nama = $purifier->purify($_POST['nama']);
$alamat = $purifier->purify($_POST['alamat']);
$lat = $purifier->purify($_POST['lat']);
$lng = $purifier->purify($_POST['lng']);
$id_propinsi = $purifier->purify($_POST['propinsi']);

$data_form= array(
	"nama"=> $nama,
	"alamat"=> $alamat,
	"id_propinsi" => $id_propinsi,
	"lat"=> $lat,
	"lng" =>$lng
);

$SARPRAS->insertSarprasData($data_form);
} else {
echo "data null";
}


