<?php

include '../../config/application.php';

if(isset($_POST['id_propinsi']) or isset($_POST['id_cabor']) or isset($_POST['tahun'])) {
	$id_propinsi = $_POST['id_propinsi'];
	$id_cabor = $_POST['id_cabor'];
	$tahun = $_POST['tahun'];
	
	//echo $tahun;
	if($id_propinsi==0 && $id_cabor==0 && $tahun == 0) {
		$result = $MEDALI->readAllMedali();
		//echo "1";
	} elseif($id_propinsi!=0 && $id_cabor==0 && $tahun==0) {
		$result = $MEDALI->readAllMedali_prop($id_propinsi);	
		//echo "2";
	} elseif($id_propinsi==0 && $id_cabor!=0 && $tahun==0) {
		$result = $MEDALI->readAllMedali_cabor($id_cabor);	
		//echo "3";
	} elseif($id_propinsi==0 && $id_cabor==0 && $tahun!=0) {
		$result = $MEDALI->readAllMedali_tahun($tahun);
		//echo "tahun";
	} elseif($id_propinsi!=0 && $id_cabor!=0 && $tahun==0) {
		$result = $MEDALI->readAllMedali_caborProp($id_propinsi,$id_cabor);
		
	} elseif($id_propinsi!=0 && $id_cabor==0 && $tahun!=0) {
		$result = $MEDALI->readAllMedali_tahunProp($tahun,$propinsi);
		
	} elseif($id_propinsi==0 && $id_cabor!=0 && $tahun!=0) {
		$result = $MEDALI->readAllMedali_caborTahun($id_cabor,$tahun);
		
	} else {
		$result = $MEDALI->readAllMedali_caborPropTahun($id_propinsi,$id_cabor,$tahun);
		//echo $_POST['id_propinsi']." ".$_POST['id_cabor'];
	}
	

//echo $result.length();

while($array = $result->fetch_assoc())
  {
		$rows[] = [$array['id_medali'],$array["emas"],$array["perak"],$array["perunggu"],$array["cabor"],$array["propinsi"],$array["tahun"],$array["kejuaraan"]];
  }
  echo json_encode($rows);
  } else {
  echo "data tidak dikirim";
  }
  