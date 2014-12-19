<?php

include '../../config/application.php';

if(isset($_POST['lat'])){
$nama = $purifier->purify($_POST['namaatlet']);
$jenkel = $purifier->purify($_POST['jenkel']);
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

$ATLET->insertAtletData($data_form);
$UTILITY->location_goto("content/data_atlet/");
exit;
} else {
echo "data null";
}


