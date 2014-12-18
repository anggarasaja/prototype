<?php

include '../../config/application.php';

$result = $DATA->readCaborData();

//echo $result.length();
echo '<option value="">--Pilih Cabang Olahraga--</option>';
while($row = $result->fetch_object())
  {
    echo '<option value="'. $row->id_cabor .'">' . $row->cabor . "</option>";
  }

