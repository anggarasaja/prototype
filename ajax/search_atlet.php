<?php
function connect() {
    return new PDO('mysql:host=localhost;dbname=gis_v2', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$pdo = connect();
$keyword = '%'.$_POST['keyword'].'%';
$sql = "SELECT * FROM tbl_atlet WHERE atlet LIKE (:keyword) ORDER BY atlet ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	$atlet_name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['atlet']);
   echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['atlet']).'\')"><a><div style="margin-left:60px; line-height:40px;">'.$atlet_name.'</div></a></li>';
}
?>