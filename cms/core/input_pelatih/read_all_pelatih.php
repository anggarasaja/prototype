<?php

include '../../config/application.php';

if(isset($_POST['id_propinsi']) or isset($_POST['id_cabor'])) {
	if($_POST['id_propinsi']==0 && $_POST['id_cabor']==0) {
		$result = $PELATIH->readAllPelatih();
		//echo "1";
	} elseif($_POST['id_propinsi']!=0 && $_POST['id_cabor']==0) {
		$result = $PELATIH->readAllPelatih_prop($_POST['id_propinsi']);	
		//echo "2";
	} elseif($_POST['id_propinsi']==0 && $_POST['id_cabor']!=0) {
		$result = $PELATIH->readAllPelatih_cabor($_POST['id_cabor']);	
		//echo "3";
	} else {
		$result = $PELATIH->readAllPelatih_caborProp($_POST['id_propinsi'],$_POST['id_cabor']);
		//echo $_POST['id_propinsi']." ".$_POST['id_cabor'];
	}
	

//echo $result.length();

while($array = $result->fetch_assoc())
  {
		$rows[] = [$array['id_pelatih'],$array["pelatih"],$array["cabor"],$array["jk"],$array["propinsi"]];
  }
  echo json_encode($rows);
  } else {
  echo "data tidak dikirim";
  }
  