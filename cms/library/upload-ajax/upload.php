<?php
//file upload.php
   $fileName = $_FILES['picture']['name'];
   $fileSize = $_FILES['picture']['size'];
   $fileError = $_FILES['picture']['error'];
   $success = false;
   if($fileSize > 0 || $fileError == 0){
     $move = move_uploaded_file($_FILES['picture']['tmp_name'], 'photo/'.$fileName); //atau ke directory yang dinginkan
     if($move){
	$success = true;
     }
   }
?>
<script type="text/javascript">
<?php
  if($success){
    echo "parent.displayPicture('photo/$fileName');";
  }else{
    echo "alert('Upload gagal $fileError');";
  }
?>
</script>