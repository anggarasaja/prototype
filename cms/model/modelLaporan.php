<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modelPengguna
 *
 * @author andreas
 */
require_once __DIR__ . "/../utility/database/mysql_db.php";

class modelLaporan extends mysql_db {

     //put your code here
     public function insertLaporan($data) {
          $nama = $data['nama'];
            $nama_kegiatan = $data['nama_kegiatan'];
          $no_kode = $data['no_kode'];
          $jenis_kegiatan = $data['jenis_kegiatan'];
          $tempat = $data['tempat'];
          $partner = $data['partner'];
          $tgl_awal = $data['tgl_awal'];
          $tgl_akhir = $data['tgl_akhir'];
          $project = $data['project'];
          $laporan = $data['laporan'];
          $user_id = $data['user_id'];
          $date = date('Y-m-d', time());

          $query = "Insert into laporan set
                                   nama='$nama',
                                         no_kode='$no_kode',
            jenis_kegiatan='$jenis_kegiatan',
            nama_kegiatan='$nama_kegiatan',
            tempat='$tempat',
            partner='$partner',
            tgl_awal='$tgl_awal', 
            tgl_akhir='$tgl_akhir', 
            project='$project', 
            laporan='$laporan', 
            id_user='$user_id', 
            update_time='$date'  ";

          //Execute query
         $result = $this->query($query);

          return $result;
     }

     public function updateLaporan($data) {
          $id_laporan = $data['id_laporan'];
           $nama = $data['nama'];
           $nama_kegiatan = $data['nama_kegiatan'];
          $no_kode = $data['no_kode'];
          $jenis_kegiatan = $data['jenis_kegiatan'];
          $tempat = $data['tempat'];
          $partner = $data['partner'];
          $tgl_awal = $data['tgl_awal'];
          $tgl_akhir = $data['tgl_akhir'];
          $project = $data['project'];
          $laporan = $data['laporan'];
          $user_id = $data['user_id'];
          $date = date('Y-m-d', time());


          $query = "update laporan set
                                   nama='$nama',
                                        nama_kegiatan='$nama_kegiatan',
                                          no_kode='$no_kode',
            jenis_kegiatan='$jenis_kegiatan',
            tempat='$tempat',
            partner='$partner',
            tgl_awal='$tgl_awal', 
            tgl_akhir='$tgl_akhir', 
            project='$project', 
            laporan='$laporan', 
            id_user='$user_id', 
            update_time='$date'  where id_laporan='$id_laporan'";

          //Execute query
          //  echo $query;
          $result = $this->query($query);

          return $result;
     }

     public function deleteLaporan($id_laporan) {
          $query = "delete from laporan where id_laporan='$id_laporan'";
          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function selectLaporan($id_laporan) {
          $query = "select * from laporan
                         where id_laporan='$id_laporan' ";

          //Execute query
          $result = $this->query($query);
          $data = $this->fetch_object($result);

          return $data;
     }

}

?>
