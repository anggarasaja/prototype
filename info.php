<?php
if(!preg_match('/^[0-7]{1,1}$/', $_GET['pid'])) {
	die('Input values out of range');
}
else {
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "maps_gundar";
	
	mysql_connect($host, $user, $pass) or die('Cannot connect to database server');
	mysql_select_db($db) or die('Cannot select database');
	
	$sql = "SELECT * FROM maps_table WHERE record_id = $_GET[pid]";
	$rs = mysql_query($sql) or die('Cannot parse query');
 
	if(mysql_num_rows($rs) == 0) {
		echo "<p><em>No matching record found.</em></p>\n";
	}
	else {
    $row = mysql_fetch_array($rs);
    if(!is_null($row['item_image'])) {
        echo "<img src='img/$row[item_image]' alt='$row[item_title]' style='float: right; margin-left: 5px;' />\n";
    }
    echo "<h1>$row[item_title]</h1>\n";
    echo "<p><strong>Dibangun pada tahun:</strong> $row[item_year]</p>\n";
    echo str_replace("\n", "<br />", $row['item_description']);
	}
}
?>