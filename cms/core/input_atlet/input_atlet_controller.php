<?php

include '../../config/application.php';
var_dump($_POST);
if(isset($_POST['emas'])){
$nama = $purifier->purify($_POST['namaatlet']);
$jenkel = $purifier->purify($_POST['jenkel']);
$cabor = $purifier->purify($_POST['cabor']);
$propinsi = $purifier->purify($_POST['propinsi']);
$pelatih = $purifier->purify($_POST['pelatih']);
$lat = $purifier->purify($_POST['lat']);
$lng = $purifier->purify($_POST['lng']);
$alamat = $purifier->purify($_POST['alamat']);

$emas = $purifier->purify($_POST['emas']);
$perak = $purifier->purify($_POST['perak']);
$perunggu = $purifier->purify($_POST['perunggu']);
$kejuaraan = $purifier->purify($_POST['kejuaraan']);
$keterangan = $purifier->purify($_POST['keterangan']);

$data_form= array(
	"atlet"=> $nama,
	"id_jk"=> $jenkel,
	"id_cabor" =>$cabor,
	"id_propinsi" =>$propinsi,
	"id_pelatih" =>$pelatih,
	"lat"=>$lat,
	"lng"=>$lng,
	"alamat"=>$alamat
);
var_dump($data_form);

$id = $ATLET->insertAtletData($data_form);

echo "id =".$id;
$data_form2= array(
	"emas"=> $emas,
	"perak"=> $perak,
	"perunggu" =>$perunggu,
	"kejuaraan" =>$kejuaraan,
	"keterangan" =>$keterangan,
	"id_atlet"=>$id
);

$ATLET->insertPrestasiAtlet($data_form2);
} else {
echo "data null";
}


