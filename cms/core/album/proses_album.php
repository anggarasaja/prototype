<?php

include 'config/application.php';



$nama_album= trim(addslashes($purifier->purify($_POST[nama_album])));
$ket= trim(addslashes($purifier->purify($_POST[ket])));
$waktu=$UTILITY->format_tanggal_db($purifier->purify($_POST[waktu]));
$id_album= trim(addslashes($purifier->purify($_POST[id_album])));

//$hapuspengguna = $purifier->purify($_GET['hpengguna']);
$kondisi = $purifier->purify($_POST['kondisi']);



 $data_form= array(
    "id_album" =>$id_album,
          "nama_album"=> $nama_album,
         "ket"=> $ket,
     "waktu"=>$waktu,
     "status_display"=> 0,
          );

//$UTILITY->show_data($data_form);
if ($kondisi == "tambah") {
     
          $ALBUM->insertAlbum($data_form);
         $UTILITY->location_goto("content/album");
     
} else if ($kondisi == "edit") {
               
             $ALBUM->updateAlbum($data_form);
          $UTILITY->location_goto("content/album");
     
}
if ($hapusdata!= "") {
    
     $qry = $DB->query("select id_foto from foto where album='$hapusdata'");
     $cek_eksist=0;
    while ($row = $DB->fetch_object($qry)) {

               $cek_eksist=1;
          }
      if($cek_eksist==0){
     $ALBUM->deleteAlbum($hapusdata);
     $UTILITY->location_goto("content/album");
      }
 else {
           $UTILITY->popup_message("Maaf hapus terlebih dahulu data foto bila ingin menghapus album ini");
           $UTILITY->location_goto("content/album");
      }
}
if ($publishdata!= "") {
  if($publishvalue=="Pending")
       $ALBUM->publishAlbum($publishdata,1);
  else
        $ALBUM->publishData($publishdata,0);
 // echo "content/food/$publishkategori";
   // $UTILITY->location_goto("content/album");
}
?>
