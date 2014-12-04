<?php

include '../../config/application.php';
$user_id = $_SESSION['user_id'];
//data


 $id_laporan = $purifier->purify($_POST['id_laporan']);
  $nama = $purifier->purify($_POST['nama']);
  $nama_kegiatan = $purifier->purify($_POST['nama_kegiatan']);
          $no_kode = $purifier->purify($_POST['no_kode']);

          $jenis_kegiatan_dosen = $_POST['chk_group_dosen'];
          $jenis_kegiatan_mahasiswa = $_POST['chk_group_mahasiswa'];
          $i=0;
          $jenis_data_dosen="";
          $jenis_data_mahasiswa="";
          foreach($jenis_kegiatan_dosen as $dosen){
               if($i==0)
                    $jenis_data_dosen="Dosen#".$dosen;
               else
                    $jenis_data_dosen.=",Dosen#".$dosen;
               $i++;
          }
          $i=0;
            foreach($jenis_kegiatan_mahasiswa as $mahasiswa){
               if($i==0)
                    $jenis_data_mahasiswa="Mahasiswa#".$mahasiswa;
               else
                    $jenis_data_mahasiswa.=",Mahasiswa#".$mahasiswa;
               $i++;
          }
          $jenis_kegiatan="$jenis_data_dosen|$jenis_data_mahasiswa";
          $tempat = $purifier->purify($_POST['tempat']);
          $partner = $purifier->purify($_POST['partner']);
          $tgl_awal = $UTILITY->format_tanggal_db($purifier->purify($_POST['tgl_awal']));
          $tgl_akhir = $UTILITY->format_tanggal_db($purifier->purify($_POST['tgl_akhir']));
          //$tgl_akhir = $purifier->purify($_POST['tgl_akhir']);
          $project = $purifier->purify($_POST['project']);
          $laporan = $purifier->purify($_POST['laporan']);
          
$data_laporan= array(
    "nama" => $nama,
    "no_kode" => $no_kode,
    "nama_kegiatan"=>$nama_kegiatan,
     "tempat" => $tempat,
     "partner" => $partner,
    "jenis_kegiatan" => $jenis_kegiatan,
     "tgl_awal" => $tgl_awal,
    "tgl_akhir" => $tgl_akhir,
    "project" => $project,
    "laporan" => $laporan,
    "id_laporan" => $id_laporan,
    "user_id" => $user_id);

//$UTILITY->show_data($data_laporan);

$kondisi= $purifier->purify($_POST["kondisi"]);
$hapuslaporan= $purifier->purify($_GET["hlaporan"]);
if ($kondisi == "tambah") {
    
         $UTILITY->popup_message("Data Laporan Telah Di Tambah");
         $LAPORAN->insertLaporan($data_laporan);
          $UTILITY->location_goto("laporan.php?act=daftar");
      
//    echo "$tes". count($jenis_kegiatan_dosen);
    
} else if ($kondisi == "edit") {
   
          $UTILITY->popup_message("Data Laporan Telah Di Ubah");
          $LAPORAN->updateLaporan($data_laporan);
          $UTILITY->location_goto("laporan.php?act=daftar");
    
}
if ($hapuslaporan!= "") {
   
     $LAPORAN->deleteLaporan($hapuslaporan);
     $UTILITY->popup_message("Data Laporan Telah Di Hapus");
    $UTILITY->location_goto("laporan.php?act=daftar");
}
?>
