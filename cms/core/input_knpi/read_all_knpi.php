<?php

include '../../config/application.php';

if(isset($_POST['id_propinsi'])) {
	if($_POST['id_propinsi']==0 ){
		$result = $KNPI->readAllKNPI();
		//echo "1";
	} else {
		$result = $KNPI->readAllKNPI_prop($_POST['id_propinsi']);	
		//echo "2";
	}
	

//echo $result.length();

while($array = $result->fetch_assoc())
  {
		$rows[] = [$array['id_knpi'],$array["nama"],$array["alamat"],$array["logo"],$array["pemimpin"],$array["telp"],$array["propinsi"],$array["lat"],$array["lng"]];
  }
  echo json_encode($rows);
  } else {
  echo "data tidak dikirim";
  }
  