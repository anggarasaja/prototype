<?php
	$conn = mysqli_connect('localhost', 'root','', 'gis_v2');
	if(mysqli_connect_errno()) {
		echo "gagal terkoneksi dengan mysql: ". mysqli_connect_error();
	}
	$sql = "select * from tbl_cabor order by id_cabor asc";
	$result = mysqli_query($conn, $sql);
	echo '<option value="0">--Cabang Olahraga--</option>';
	while($row = mysqli_fetch_array($result))
   {
   	echo '<option value="'. $row["id_cabor"] .'">' . $row["cabor"] . "</option>";
   }
?>