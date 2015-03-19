<?php

include '../../config/application.php';

if(isset($_POST['id_atlet'])) {
	$id_atlet = $_POST['id_atlet'];
	$result = $ATLET->readPrestasi($id_atlet);
//echo $result.length();
while($array = $result->fetch_assoc())
  {
		$rows = [$array['emas'],$array["perak"],$array["perunggu"],$array["kejuaraan"],$array["keterangan"]];
  }
		echo json_encode($rows);
  } else {
  	echo "data null";
  }