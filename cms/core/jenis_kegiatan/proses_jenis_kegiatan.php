<?

include '../../config/application.php';
$user_id = $_SESSION['user_id'];
//data
$kegiatan= $purifier->purify($_POST["kegiatan"]);
$kategori= $purifier->purify($_POST["kategori"]);
$id_kegiatan= $purifier->purify($_POST["id_kegiatan"]);
$data_kegiatan= array(
    "kegiatan" => $kegiatan,
    "kategori" => $kategori,
    "id_jenis_kegiatan" => $id_kegiatan,
    "user_id" => $user_id);


$kondisi= $purifier->purify($_POST["kondisi"]);
$hapuskegiatan= $purifier->purify($_GET["hjenis_kegiatan"]);
if ($kondisi == "tambah") {
     if ($kegiatan == "") {
          $UTILITY->popup_message("Mohon isi kegiatan terlebih dahulu");
          $UTILITY->location_goto("jenis_kegiatan.php?act=tambah");
     } else if ($kategori== "") {
          $UTILITY->popup_message("Mohon isi kategori terlebih dahulu");
          $UTILITY->location_goto("jenis_kegiatan.php?act=tambah");
     }
      else {
           $UTILITY->popup_message("Data Jenis Kegiatan Telah Di Tambah");
          $JENIS->insertJenis($data_kegiatan);
          $UTILITY->location_goto("jenis_kegiatan.php?act=daftar");
     }
} else if ($kondisi == "edit") {
      if ($kegiatan == "") {
          $UTILITY->popup_message("Mohon isi kegiatan terlebih dahulu");
          $UTILITY->location_goto("jenis_kegiatan.php?act=tambah");
     } else if ($kategori== "") {
          $UTILITY->popup_message("Mohon isi kategori terlebih dahulu");
          $UTILITY->location_goto("jenis_kegiatan.php?act=tambah");
     }
     else {
          $UTILITY->popup_message("Data Jenis Kegiatan Telah Di Ubah");
          $JENIS->updateJenis($data_kegiatan);
          $UTILITY->location_goto("jenis_kegiatan.php?act=daftar");
     }
}
if ($hapuskegiatan!= "") {
     $JENIS->deleteJenisKegiatan($hapuskegiatan);
     $UTILITY->popup_message("Data Jenis Kegiatan Telah Di Hapus");
     $UTILITY->location_goto("jenis_kegiatan.php?act=daftar");
}
?>
