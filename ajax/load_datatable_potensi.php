<?php
	$conn = mysqli_connect('localhost', 'root','admin', 'gis_v2');
	if(mysqli_connect_errno()) {
		echo "gagal terkoneksi dengan mysql: ". mysqli_connect_error();
	}
	if(isset($_POST["id_propinsi"]) && isset($_POST["kejuaraan"]))
	{
		$id_propinsi = $_POST["id_propinsi"];
    	$kejuaraan = $_POST["kejuaraan"];//isset($_POST["id_cabor"]);
		$sql = "select tbl_medali.*, cabor
				 from tbl_medali join tbl_cabor on tbl_medali.id_cabor = tbl_cabor.id_cabor
				 where id_propinsi = $id_propinsi and kejuaraan = '$kejuaraan'";
		
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
				$rows[] = [$array['cabor'],$array["tahun"],$array["emas"],$array["perak"],$array["perunggu"]];
  
		  }
		  //echo "\n]";
		  echo json_encode($rows);
  }
