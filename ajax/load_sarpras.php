<?php
	$conn = mysqli_connect('localhost', 'root','admin', 'gis');
	if(mysqli_connect_errno()) {
		echo "gagal terkoneksi dengan mysql: ". mysqli_connect_error();
	}
	$sql = sprintf("select tbl_sarpras.lat, tbl_sarpras.lng, tbl_sarpras.nama, tbl_propinsi.propinsi, tbl_sarpras.alamat from tbl_sarpras join tbl_propinsi on tbl_propinsi.id_propinsi=tbl_sarpras.id_propinsi");
	$query = mysqli_query($conn, $sql);
	if ($query) {
		$jsonData = array();
		while ($array = mysqli_fetch_assoc($query)) {
   		$jsonData[] = [$array["nama"],$array["lat"],$array["lng"],$array["propinsi"],$array["alamat"]];
   	}
		echo json_encode($jsonData);
	}
	else {
		echo 'error';
	}
?>
