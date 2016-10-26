<?php

include '../../config/application.php';

$result = $PELOPOR->readAllPelopor();	

//echo $result.length();

while($array = $result->fetch_assoc())
  {
		$rows[] = [$array['id_pelopor'],$array["nama"],$array["ttl"],$array["gender"],$array["pendidikan"],$array["alamat"],$array["kontak"],$array["jenis"],$array["tahun"]];
  }
  echo json_encode($rows);