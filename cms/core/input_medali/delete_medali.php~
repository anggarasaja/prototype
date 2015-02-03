<?php

include '../../config/application.php';
if(isset($_POST['id_pelatih'])){
$id_pelatih = $purifier->purify($_POST['id_pelatih']);


$data_form= array(
	"id_pelatih"=> $id_pelatih,
);

$PELATIH->deletePelatih($data_form);

} else {
echo "data null";
}

