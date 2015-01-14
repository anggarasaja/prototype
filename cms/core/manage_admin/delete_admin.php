<?php

include '../../config/application.php';
if(isset($_POST['user_id'])){
$iduser = $purifier->purify($_POST['user_id']);


$data_form= array(
	"user_id"=> $iduser,
);

$ADMIN->deleteAdmin($data_form);

} else {
echo "data null";
}

