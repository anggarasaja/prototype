<?php

include '../../config/application.php';

$id_row = $_POST['id_row'];
if(isset($_POST['nama-KNPI-update-'.$id_row]) && isset($_POST['alamat-update-'.$id_row]) && isset($_POST['pemimpin-update-'.$id_row]) && isset($_POST['telp-update-'.$id_row])){
$id_knpi = $purifier->purify($_POST['id-KNPI-update-'.$id_row]);
$nama = $purifier->purify($_POST['nama-KNPI-update-'.$id_row]);
$alamat = $purifier->purify($_POST['alamat-update-'.$id_row]);
$pemimpin = $purifier->purify($_POST['pemimpin-update-'.$id_row]);
$telp = $purifier->purify($_POST['telp-update-'.$id_row]);
$lat = $purifier->purify($_POST['lat-update-'.$id_row]);
$lng = $purifier->purify($_POST['lng-update-'.$id_row]);
$id_propinsi = $purifier->purify($_POST['propinsi-update-'.$id_row]);


	
	//upload logo
	
	$target_dir = "/opt/lampp/htdocs/prototype/cms/images/uploads/logo-knpi/";
	$target_file = $target_dir . basename($_FILES["logo-update-".$id_row]["name"]);
	$path = $_FILES["logo-update-".$id_row]['name'];
	$filename = pathinfo($path, PATHINFO_FILENAME)."-".date("Y-m-d-H:i:s").".".pathinfo($path, PATHINFO_EXTENSION);
	$targetfile = $target_dir . $filename;
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["logo-update-".$id_row]["tmp_name"]);
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
	if ($_FILES["logo-update-".$id_row]["size"] > 500000) {
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
	    
	// if everything is ok, try to upload file
				$data_form= array(
		"id_KNPI" => $id_knpi,
		"KNPI"=> $nama,
		"alamat"=> $alamat,
		"pemimpin" => $pemimpin,
		"telp" => $telp,
		"lat" => $lat,
		"lng" => $lng,
		"id_propinsi" => $id_propinsi,
		"logo" => ''
	);
	
	$KNPI->updateKNPI($data_form);
	echo "Sorry, your file was not uploaded.";
	} else {
	    if (move_uploaded_file($_FILES["logo-update-".$id_row]["tmp_name"], $targetfile)) {
				echo "The file ". basename( $_FILES["logo-update-".$id_row]["name"]). " has been uploaded.";
				echo $filename;
				$data_form= array(
					"id_KNPI" => $id_knpi,
					"KNPI"=> $nama,
					"alamat"=> $alamat,
					"pempimpin" => $pemimpin,
					"telp" => $telp,
					"lat" => $lat,
					"lng" => $lng,
					"id_propinsi" => $id_propinsi,
					"logo" => "images/uploads/logo-knpi/". $filename
				);
				
				$KNPI->updateKNPI($data_form);
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	        echo $_FILES["logo-update-".$id_row]["tmp_name"]. "  ". $filename;
	    }
	}
	
	//end upload logo
	
	echo "berhasil diupdate";
} else {
echo "data null";
}

