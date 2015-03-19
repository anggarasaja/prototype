<?php

include '../../config/application.php';

if(isset($_POST['id'])) {
$result = $ATLET->readPelatihData($_POST['id']);

//echo $result.length();
echo '<option value="">--Pilih Pelatih--</option>';
while($row = $result->fetch_object())
  {
    echo '<option value="'. $row->id_pelatih .'">' . $row->pelatih . "</option>";
  }
echo '<option value="0">Belum Ada</option>';
  }