<?php

include '../../config/application.php';
if(isset($_POST['id_medali'])){
$id_medali = $purifier->purify($_POST['id_medali']);


$data_form= array(
	"id_medali"=> $id_medali,
);

$MEDALI->deleteMedali($data_form);

} else {
echo "data null";
}

