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

class modelJenisKegiatan extends mysql_db {

     //put your code here
     public function insertJenis($data) {
          $kegiatan= $data['kegiatan'];
          $kategori= $data['kategori'];
          $user_id= $data['user_id'];
          $date = date('Y-m-d', time());
          $query = "Insert into jenis_kegiatan
                         set kegiatan='$kegiatan',
                         kategori= '$kategori', 
                              id_user='$user_id',
                         update_time='$date' ";

          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function updateJenis($data) {
           $kegiatan= $data['kegiatan'];
          $kategori= $data['kategori'];
          $user_id= $data['user_id'];
          $id_jenis_kegiatan= $data['id_jenis_kegiatan'];
          $date = date('Y-m-d', time());
          

          $query = "update  jenis_kegiatan
                         set kegiatan='$kegiatan',
                         kategori= '$kategori', 
                              id_user='$user_id',
                         update_time='$date' where id_jenis_kegiatan='$id_jenis_kegiatan'";

          //Execute query
        //  echo $query;
          $result = $this->query($query);

          return $result;
     }

     public function deleteJenisKegiatan($id_jenis_kegiatan) {
          $query = "delete from jenis_kegiatan where id_jenis_kegiatan='$id_jenis_kegiatan'";
          //Execute query
          $result = $this->query($query);

          return $result;
     }
     
      public function selectJenisKegiatan($id_jenis_kegiatan) {
          $query = "select * from jenis_kegiatan
                         where id_jenis_kegiatan='$id_jenis_kegiatan' ";

          //Execute query
          $result = $this->query($query);
          $data=$this->fetch_object($result);

          return $data;
     }
     
     
}

 

?>
