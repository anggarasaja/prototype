<?php
	$conn = mysqli_connect('localhost', 'root','admin', 'gis');
	if(mysqli_connect_errno()) {
		echo "gagal terkoneksi dengan mysql: ". mysqli_connect_error();
	}
	if(isset($_POST["id"]))
	{
		$id= $_POST["id"];
		$sql = sprintf("select * from tbl_atlet where id_propinsi = $id");
		$query = mysqli_query($conn, $sql);
			if ($query) {
				$jsonData = array();
				while ($array = mysqli_fetch_assoc($query)) {
   				$jsonData[] = [$array["lat"],$array["lng"]];
   			}
			echo json_encode($jsonData);
			}
		else {
		echo 'error';
		}
	}
	else {
		echo 'error';
	}
?>
