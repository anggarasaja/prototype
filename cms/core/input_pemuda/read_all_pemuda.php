<?php

include '../../config/application.php';

if(isset($_POST['id_propinsi'])) {
	if($_POST['id_propinsi']==0 ){
		$result = $PEMUDA->readAllPemuda();
		//echo "1";
	} else {
		$result = $PEMUDA->readAllPemuda_prop($_POST['id_propinsi']);	
		//echo "2";
	}
	

//echo $result.length();

while($array = $result->fetch_assoc())
  {
		$rows[] = [$array['id_pemuda'],$array["pemuda"],$array["jk"],$array["propinsi"],$array["keterangan"],$array["alamat"]];
  }
  echo json_encode($rows);
  } else {
  echo "data tidak dikirim";
  }
  