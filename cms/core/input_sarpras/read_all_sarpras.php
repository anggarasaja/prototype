<?php

include '../../config/application.php';

if(isset($_POST['id_propinsi'])) {
	$id_propinsi = $_POST['id_propinsi'];
	
	//echo $tahun;
	if($id_propinsi==0 ) {
		$result = $SARPRAS->readAllSarpras();
		//echo "1";
	} else {
		$result = $SARPRAS->readAllSarpras_prop($id_propinsi);	
		//echo "2";
	} 
	

//echo $result.length();

while($array = $result->fetch_assoc())
  {
		$rows[] = [$array['id_sarpras'],$array["nama"],$array['propinsi'],$array["alamat"],$array["lat"],$array["lng"]];
  }
  echo json_encode($rows);
  } else {
  echo "data tidak dikirim";
  }
  