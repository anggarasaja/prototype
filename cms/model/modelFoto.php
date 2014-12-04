<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modelAlbum
 *
 * @author andreas
 */
require_once __DIR__ . "/../utility/database/mysql_db.php";

class modelFoto extends mysql_db {

     //put your code here
     public function insertFoto($data) {
          $id_foto = $data['id_foto'];
          $nama_file = $data['nama_file'];
          $ket = $data['ket'];
          $album = $data['album'];
          $waktu=$data['waktu'];
          $status_display= $data['status_display'];
          $status_headline= $data['status_headline'];
          
          $user_id=$_SESSION['user_id'];
          
          $query = "Insert into foto
                         set nama_file='$nama_file',
                         ket= '$ket',
                        waktu='$waktu',
                        album='$album',
                         status_display='$status_display',
                        status_headline='$status_headline',
                         user_id='$user_id';     
                         ";

          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function updateFoto($data) {
            $id_foto = $data['id_foto'];
          $nama_file = $data['nama_file'];
          $ket = $data['ket'];
          $album = $data['album'];
          $waktu=$data['waktu'];
          $status_display= $data['status_display'];
          $status_headline= $data['status_headline'];
          $user_id=$_SESSION['user_id'];
          
          $query = "update foto
                            set nama_file='$nama_file',
                         ket= '$ket',
                        waktu='$waktu',
                        album='$album',
                         status_display='$status_display',
                        status_headline='$status_headline'
                             
                         where id_foto='$id_foto' " ;
          //echo $query;
          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function deleteFoto($id) {
          $query = "delete from foto where id_foto='$id'";
          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function readFoto($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from foto  $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
        
          return $data;
     }
     
     public function readFotoFull($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from foto $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
          
          return $data;
     }
     
     public function publishFoto($id,$value) {
          $query = "update foto set status_display=$value where id_foto='$id'";
          //Execute query
           $result = $this->query($query);

          return $result;
     }
     
      public function headlineFoto($id,$value) {
          $query = "update foto set status_headline=$value where id_foto='$id'";
          //Execute query
           $result = $this->query($query);

          return $result;
     }

}


     
     

?>
