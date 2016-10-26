<?php
	$conn = mysqli_connect('localhost', 'root','admin', 'gis');
	if(mysqli_connect_errno()) {
		echo "gagal terkoneksi dengan mysql: ". mysqli_connect_error();
	}
	$sql = sprintf("select tbl_atlet.*, tbl_propinsi.propinsi, tbl_cabor.*, tbl_jk.*, tbl_pelatih.*
			  from tbl_atlet
			  join tbl_jk
			  on tbl_jk.id_jk = tbl_atlet.id_jk
			  join tbl_pelatih
			  on tbl_pelatih.id_pelatih = tbl_atlet.id_pelatih
			  join tbl_propinsi
			  on tbl_propinsi.id_propinsi = tbl_atlet.id_propinsi
			  join tbl_cabor
			  on tbl_cabor.id_cabor = tbl_atlet.id_cabor");
	$query = mysqli_query($conn, $sql);
	if ($query) {
		$jsonData = array();
		while ($array = mysqli_fetch_assoc($query)) {
   		$jsonData[] = [$array["atlet"],$array["lat"],$array["lng"],$array["jk"],$array["cabor"],$array["propinsi"],$array["pelatih"]];
   	}
		echo json_encode($jsonData);
	}
	else {
		echo 'error';
	}
?>
