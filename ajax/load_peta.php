<?php
if(isset($_POST['propinsi'])===true && empty($_POST['propinsi'])===false)
{
$conn = mysqli_connect('localhost', 'root','', 'gis_v2');

if(mysqli_connect_errno()) {
	echo "gagal terkoneksi dengan mysql: ". mysqli_connect_error();
}

$sql = sprintf("select lng, lat from tbl_propinsi where propinsi = '%s' ",  mysqli_real_escape_string($conn, trim($_POST['propinsi'])));

$query = mysqli_query($conn, $sql);

if ($query) {
	$result = mysqli_fetch_assoc($query);

	echo(mysqli_num_rows($query) !== 0) ? json_encode(array("lat"=>$result["lat"],"lng"=>$result["lng"])): 'not found';
	
	/*$jsonData = array();
	while ($array = mysqli_fetch_row($query)) {
   	$jsonData[] = $array;
	}*/
	//echo json_encode($jsonData);

} else {
	echo 'eror';
}
} else{
echo 'kosong';
}