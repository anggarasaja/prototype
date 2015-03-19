<?php

include '../../config/application.php';

$result = $PELATIH->readCaborData();

//echo $result.length();
echo '<option value="0">--Pilih Cabang Olahraga--</option>';
while($row = $result->fetch_object())
  {
    echo '<option value="'. $row->id_cabor .'">' . $row->cabor . "</option>";
  }

