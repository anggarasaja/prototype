<?php
	$conn = mysqli_connect('localhost', 'root','admin', 'gis');
	if(mysqli_connect_errno()) {
		echo "gagal terkoneksi dengan mysql: ". mysqli_connect_error();
	}
	$sql = sprintf("select * from tbl_propinsi");
	$query = mysqli_query($conn, $sql);
	if ($query) {
		$jsonData = array();
		while ($array = mysqli_fetch_assoc($query)) {
   		$jsonData[] = [$array["lat"],$array["lng"],$array["propinsi"]];
   	}
		echo json_encode($jsonData);
	}
	else {
		echo 'error';
	}
?>
