<?php
	$conn = mysqli_connect('localhost', 'root','', 'gis_v2');
	if(mysqli_connect_errno()) {
		echo "gagal terkoneksi dengan mysql: ". mysqli_connect_error();
	}
	//if(isset($_POST["id_cabor"]))
	//{
    	$id_cabor= 27;
		$sql = "select tbl_medali.*, tbl_propinsi.propinsi, tbl_cabor.cabor
				 from tbl_medali
				 join tbl_propinsi
				 on tbl_propinsi.id_propinsi = tbl_medali.id_propinsi
				 join tbl_cabor
				 on tbl_cabor.id_cabor = tbl_medali.id_cabor
				 where tbl_medali.id_cabor= $id_cabor and tbl_medali.id_propinsi = 1 and tbl_medali.kejuaraan = 0";
		$result = mysqli_query($conn, $sql);
		

		$rows = array();
		
		$prefix = '';
		
		
		//echo "[\n";
		while($array = mysqli_fetch_assoc($result))
		  {
		  		/*echo $prefix . " {\n";
		  		echo '  y: "' . $array['tahun'] . '",' . "\n";
		  		echo '  emas: ' . $array['emas'] . ',' . "\n";
		  		echo '  perak: ' . $array['perak'] . ',' . "\n";
		  		echo '  perunggu: ' . $array['perunggu'] . ',' . "\n";
		  		echo " }";
		  		$prefix = ",\n";*/
				/*$rows[] = array(
				'y' => $array["tahun"],
				'emas' => $array["emas"],
				'perak' => $array["perak"],
				'perunggu' => $array["perunggu"],
				
				);*/
				$rows[] = ['y'=>$array["tahun"], "emas"=>$array["emas"],'perak'=>$array["perak"],'perunggu'=>$array["perunggu"]];
  
		  }
		  //echo "\n]";
		  echo json_encode($rows);
  //}