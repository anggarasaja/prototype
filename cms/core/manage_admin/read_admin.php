<?php

include '../../config/application.php';

$result = $ADMIN->readAdmin();

while($array = $result->fetch_assoc())
  {
		$rows[] = [$array['user_id'],$array["username"],$array["level"],$array["keterangan"],$array["password"]];
  }
  echo json_encode($rows);