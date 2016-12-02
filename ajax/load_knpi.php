<?php
	include 'conn.php';
	if(mysqli_connect_errno()) {
		echo "gagal terkoneksi dengan mysql: ". mysqli_connect_error();
	}
	$sql = sprintf("select * from tbl_knpi where tahun = '$_POST[year]'");
	$query = mysqli_query($conn, $sql);
	if ($query) {
		$jsonData = array();
		while ($array = mysqli_fetch_assoc($query)) {
   		$jsonData[] = [$array["lat"],$array["lng"],$array["knpi"]];
   	}
		echo json_encode($jsonData);
	}
	else {
		echo 'error';
	}
?>
