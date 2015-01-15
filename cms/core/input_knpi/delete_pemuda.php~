<?php

include '../../config/application.php';
if(isset($_POST['id_pemuda'])){
$id_pemuda = $purifier->purify($_POST['id_pemuda']);


$data_form= array(
	"id_pemuda"=> $id_pemuda,
);

$PEMUDA->deletePemuda($data_form);

} else {
echo "data null";
}

