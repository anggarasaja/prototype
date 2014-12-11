<?php

include '../../config/application.php';

if(isset($_POST['lat'])){
$nama = $purifier->purify($_POST['nama-atlet']);
$jenkel = $purifier->purify($_POST['jenis-kelamin']);
$cabor = $purifier->purify($_POST['cabor']);
$propinsi = $purifier->purify($_POST['propinsi']);
$pelatih = $purifier->purify($_POST['pelatih']);
$lat = $purifier->purify($_POST['lat']);
$lng = $purifier->purify($_POST['lng']);

$data_form= array(
	"atlet"=> $nama,
	"id_jk"=> $jenkel,
	"id_cabor" =>$cabor,
	"id_propinsi" =>$propinsi,
	"id_pelatih" =>$pelatih,
	"lat"=>$lat,
	"lng"=>$lng
);

$DATA->insertAtletData($data_form);
$UTILITY->location_goto("content/today/");
exit;
} else {
echo "data null";
}


