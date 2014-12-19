<?php

include '../../config/application.php';

$result = $ATLET->readCaborData();

//echo $result.length();
echo '<option value="0">--Pilih Cabang Olahraga--</option>';
while($row = $result->fetch_object())
  {
    echo '<option value="'. $row->id_cabor .'">' . $row->cabor . "</option>";
  }

