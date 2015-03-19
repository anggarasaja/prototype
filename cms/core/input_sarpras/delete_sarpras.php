<?php

include '../../config/application.php';
if(isset($_POST['id_sarpras'])){
$id_sarpras = $purifier->purify($_POST['id_sarpras']);


$data_form= array(
	"id_sarpras"=> $id_sarpras,
);

$SARPRAS->deleteSarpras($data_form);

} else {
echo "data null";
}

