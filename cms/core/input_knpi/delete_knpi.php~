<?php

include '../../config/application.php';
if(isset($_POST['id_KNPI'])){
$id_KNPI = $purifier->purify($_POST['id_KNPI']);


$data_form= array(
	"id_KNPI"=> $id_KNPI,
);

$KNPI->deleteKNPI($data_form);

} else {
echo "data null";
}

