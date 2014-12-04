<?php

include 'config/application.php';



$album= trim(addslashes($purifier->purify($_POST[album])));
$ket= trim(addslashes($purifier->purify($_POST[ket])));
$waktu=$UTILITY->format_tanggal_db($purifier->purify($_POST[waktu]));
$id_foto= trim(addslashes($purifier->purify($_POST[id_foto])));
$filesave_image=$purifier->purify($_POST[filesave_image]);
//$hapuspengguna = $purifier->purify($_GET['hpengguna']);
$kondisi = $purifier->purify($_POST['kondisi']);


if($_POST['ganti1'])
{
      $data_form= array(
    "id_foto" =>$id_foto,
          "album"=>$album,
          "nama_file"=>"",
         "ket"=> $ket,
     "waktu"=>$waktu,
     "status_display"=> 0,
     "status_headline"=> 0,
          );
        $FOTO->updateFoto($data_form);
          $UTILITY->location_goto("content/foto/$album/edit/$id_foto");
          exit;
}

$nama_file=$_FILES["nama_file"]['name'];
  $filesave="";
if($nama_file  !="")
{

     $filesave="album"."_$waktu"."_$nama_file";
     $path_upload_album=$path_upload_album."/$album/";
  $hasil=   $UTILITY->upload_gambar("nama_file",$path_upload_album, 1,$filesave);
  
}else{
    $filesave=$filesave_image;
}

$data_form= array(
    "id_foto" =>$id_foto,
          "album"=>$album,
          "nama_file"=>"$filesave",
         "ket"=> $ket,
     "waktu"=>$waktu,
     "status_display"=> 0,
     "status_headline"=> 0,
          );
 

//$UTILITY->show_data($data_form);
if ($kondisi == "tambah") {
     
          $FOTO->insertFoto($data_form);
         $UTILITY->location_goto("content/foto/$album");
     
} else if ($kondisi == "edit") {
               
             $FOTO->updateFoto($data_form);
          $UTILITY->location_goto("content/foto/$album");
     
}
if ($hapusdata!= "") {
   
     $FOTO->deleteFoto($hapusdata);
     $UTILITY->location_goto("content/foto/$albumdata ");
}
if ($publishdata!= "") {
  if($publishvalue=="Pending")
       $FOTO->publishFoto($publishdata,1);
  else
        $FOTO->publishFoto($publishdata,0);
 // echo "content/food/$publishkategori";
    $UTILITY->location_goto("content/foto/$publishalbum");
}

if ($headlinedata!= "") {
  if($headlinevalue=="-")
       $FOTO->headlineFoto($headlinedata,1);
  else
        $FOTO->headlineFoto($headlinedata,0);
  
    $UTILITY->location_goto("content/foto/$headlinealbum");
}
?>
