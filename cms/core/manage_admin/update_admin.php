<?php

include '../../config/application.php';

if(isset($_POST['password'])){
$iduser = $purifier->purify($_POST['user_id']);
$username = $purifier->purify($_POST['username']);
$level = $purifier->purify($_POST['level']);
$keterangan = $purifier->purify($_POST['keterangan']);
$password = $purifier->purify($_POST['password']);

$data_form= array(
	"user_id"=> $iduser,
	"username"=> $username,
	"level" =>$level,
	"keterangan" =>$keterangan,
	"password" =>$password
);

$ADMIN->updateAdmin($data_form);
} else {
echo "data null";
}

