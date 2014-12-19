<?php

include '../../config/application.php';

if(isset($_POST['id_propinsi'])) {
	if($_POST['id_propinsi']==0 && $_POST['id_cabor']==0) {
		$result = $ATLET->readAllAtlet();
	} elseif($_POST['id_propinsi']!=0 && $_POST['id_cabor']==0) {
		$result = $ATLET->readAllAtlet_prop($_POST['id_propinsi']);	
	} elseif($_POST['id_propinsi']==0 && $_POST['id_cabor']!=0) {
		$result = $ATLET->readAllAtlet_cabor($_POST['id_cabor']);	
	} else {
		$result = $ATLET->readAllAtlet_caborProp($_POST['id_propinsi'],$_POST['id_cabor']);
	}
	

//echo $result.length();

while($array = $result->fetch_assoc())
  {
		$rows[] = [$array["atlet"],$array["cabor"],$array["pelatih"],$array["propinsi"],$array["jk"],$array["lat"],$array["lng"]];
  }
  echo json_encode($rows);
  }