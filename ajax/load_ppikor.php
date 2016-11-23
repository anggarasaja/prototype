<?php
	include 'conn.php';
	if(mysqli_connect_errno()) {
		echo "gagal terkoneksi dengan mysql: ". mysqli_connect_error();
	}
	$sql = sprintf("SELECT * FROM tbl_ppikor");
	$query = mysqli_query($conn, $sql);
	if ($query) {
		$jsonData = array();
		while ($array = mysqli_fetch_assoc($query)) {
   		$jsonData[] = [$array["nama"],$array["lat"],$array["lng"],$array["provinsi"],$array["alamat"]];
   	}
		echo json_encode($jsonData);
	}
	else {
		echo 'error';
	}
?>
