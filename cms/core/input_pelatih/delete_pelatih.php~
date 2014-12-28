<?php

include '../../config/application.php';
if(isset($_POST['id_atlet'])){
$id_atlet = $purifier->purify($_POST['id_atlet']);


$data_form= array(
	"id_atlet"=> $id_atlet,
);

$ATLET->deleteAtlet($data_form);

} else {
echo "data null";
}

