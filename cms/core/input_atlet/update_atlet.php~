<?php

include '../../config/application.php';
if(isset($_POST['lat'])){
$nama = $purifier->purify($_POST['namaatlet']);
$id_atlet = $purifier->purify($_POST['id_atlet']);
$jenkel = $purifier->purify($_POST['jenkel']);
$cabor = $purifier->purify($_POST['cabor']);
$propinsi = $purifier->purify($_POST['propinsi']);
$pelatih = $purifier->purify($_POST['pelatih']);
$lat = $purifier->purify($_POST['lat']);
$lng = $purifier->purify($_POST['lng']);


$data_form= array(
	"atlet"=> $nama,
	"id_atlet"=> $id_atlet,
	"id_jk"=> $jenkel,
	"id_cabor" =>$cabor,
	"id_propinsi" =>$propinsi,
	"id_pelatih" =>$pelatih,
	"lat"=>$lat,
	"lng"=>$lng
);

$ATLET->updateAtlet($data_form);
} else {
echo "data null";
}

