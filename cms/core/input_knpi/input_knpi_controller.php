<?php

include '../../config/application.php';

if(isset($_POST['nama-KNPI']) && isset($_POST['alamat']) && isset($_POST['pemimpin']) && isset($_POST['telp'])){
$nama = $purifier->purify($_POST['nama-KNPI']);
$alamat = $purifier->purify($_POST['alamat']);
$logo = $purifier->purify($_POST['logo']);
$pemimpin = $purifier->purify($_POST['pemimpin']);
$telp = $purifier->purify($_POST['telp']);
$lat = $purifier->purify($_POST['lat']);
$lng = $purifier->purify($_POST['lng']);
$id_propinsi = $purifier->purify($_POST['propinsi']);

echo $pemimpin;



//upload logo

$target_dir = "/opt/lampp/htdocs/prototype/cms/images/uploads/logo-knpi/";
$target_file = $target_dir . basename($_FILES["logo"]["name"]);
$path = $_FILES['logo']['name'];
$filename = pathinfo($path, PATHINFO_FILENAME)."-".date("Y-m-d-H:i:s").".".pathinfo($path, PATHINFO_EXTENSION);
$targetfile = $target_dir . $filename;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["logo"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($targetfile)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["logo"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["logo"]["tmp_name"], $targetfile)) {
			echo "The file ". basename( $_FILES["logo"]["name"]). " has been uploaded.";
			echo $filename;
			$data_form= array(
				"KNPI"=> $nama,
				"alamat"=> $alamat,
				"pemimpin" => $pemimpin,
				"telp" => $telp,
				"lat" => $lat,
				"lng" => $lng,
				"id_propinsi" => $id_propinsi,
				"logo" => "images/uploads/logo-knpi/". $filename
			);

			$KNPI->insertKNPIData($data_form);
    } else {
        echo "Sorry, there was an error uploading your file.";
        echo $_FILES["logo"]["tmp_name"]. "  ". $filename;
    }
}

//end upload logo
} else {
echo "data null";
}


