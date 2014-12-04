<?php

include 'config/application.php';


$id = $purifier->purify($_POST[id]);
$judul = trim(addslashes($purifier->purify($_POST[judul])));
$sub_judul = trim(addslashes($purifier->purify($_POST[sub_judul])));
$content = trim(addslashes($purifier->purify($_POST[content])));
$short_content = trim(addslashes($purifier->purify($_POST[short_content])));
//$image = $purifier->purify($_POST[image]);
$filesave_image=$purifier->purify($_POST[filesave_image]);
$waktu= $UTILITY->format_tanggal_db($purifier->purify($_POST[waktu]));

$provinsi= $_POST[provinsi];
$kabupaten = $_POST[kabupaten];

if($provinsi=="")
     $provinsi=0;
if($kabupaten=="")
     $kabupaten=0;

$kategori = $_POST[kategori];
$kategori_3 = $_POST[kategori_3];


$kategori_2 = $purifier->purify($_POST[kategori_2]);
$status_display = $purifier->purify($_POST[status_display]);
$longitude = $purifier->purify($_POST[longitude]);
$latitude = $purifier->purify($_POST[latitude]);
$language = $purifier->purify($_POST[language]);

//$UTILITY->show_data($kategori);
for ($i=0;$i<count($kategori);$i++){
     if($i==0)
          $temp_kategori=$kategori[$i];
     else
          $temp_kategori.=",".$kategori[$i];
}
$kategori=$temp_kategori;

//$UTILITY->show_data($kategori);
for ($i=0;$i<count($kategori_3);$i++){
     if($i==0)
          $temp_kategori=$kategori_3[$i];
     else
          $temp_kategori.=",".$kategori_3[$i];
}
$kategori_3=$temp_kategori;
//$hapuspengguna = $purifier->purify($_GET['hpengguna']);
$kondisi = $purifier->purify($_POST['kondisi']);



if($_POST['ganti1'])
{
     $data_form= array(
    "id" =>$id,
          "judul"=> $judul,
         "waktu"=> $waktu,
          "sub_judul" =>$sub_judul,
          "content" =>$content,
          "short_content" =>$short_content,
          "image"=>"",
          "kategori"=>$kategori ,
          "kategori_2"=>$kategori_2,
          "status_display"=>0,
          "longitude"=>"0",
          "latitude"=>"0",
         "kategori_3"=>"$kategori_3",
         "provinsi"=>"$provinsi",
         "kabupaten"=>"$kabupaten",
          "language"=>"en");
          $DESTINATION->updateData($data_form);
        
          $UTILITY->location_goto("content/destination/edit/$id");
          exit;
}

$image_file=$_FILES["image"]['name'];
  $filesave="";
if($image_file!="")
{

     $filesave="destination"."_$waktu"."_$image_file";
     $UTILITY->upload_gambar("image",$path_upload , 1,$filesave);
}else{
    $filesave=$filesave_image;
}

$data_form= array(
    "id" =>$id,
          "judul"=> $judul,
    "waktu"=> $waktu,
          "sub_judul" =>$sub_judul,
          "content" =>$content,
          "short_content" =>$short_content,
          "image"=>$filesave,
          "kategori"=>$kategori ,
          "kategori_2"=>$kategori_2,
          "status_display"=>0,
          "longitude"=>"0",
          "latitude"=>"0",
       "kategori_3"=>"$kategori_3",
       "provinsi"=>"$provinsi",
         "kabupaten"=>"$kabupaten",
          "language"=>"en");

//$UTILITY->show_data($data_form);
if ($kondisi == "tambah") {
     
          $DESTINATION->insertData($data_form);
         $UTILITY->location_goto("content/destination/$kategori");
     
} else if ($kondisi == "edit") {
            //echo "masuk";
          $DESTINATION->updateData($data_form);
          $UTILITY->location_goto("content/destination/$kategori");
     
}
if ($hapusdata!= "") {
   
     $DESTINATION->deleteData($hapusdata);
     $UTILITY->location_goto("content/destination/$hapusdatakategori");
}
if ($publishdata!= "") {
  if($publishvalue=="Pending")
       $DESTINATION->publishData($publishdata,1);
  else
        $DESTINATION->publishData($publishdata,0);
 // echo "content/destination/$publishkategori";
    $UTILITY->location_goto("content/destination/$publishkategori");
}
?>
