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

class modelAlbum extends mysql_db {

     //put your code here
     public function insertAlbum($data) {
          $id_album = $data['id_album'];
          $nama_album = $data['nama_album'];
          $ket = $data['ket'];
          $waktu=$data['waktu'];
          $status_display= $data['status_display'];
          
          $user_id=$_SESSION['user_id'];
          $query = "Insert into album
                         set nama_album='$nama_album',
                         ket= '$ket',
                              waktu='$waktu',
                         status_display='$status_display',
                         user_id='$user_id';     
                         ";

          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function updateAlbum($data) {
             $id_album = $data['id_album'];
          $nama_album = $data['nama_album'];
          $ket = $data['ket'];
            $waktu=$data['waktu'];
          $status_display= $data['status_display'];
          $user_id=$_SESSION['user_id'];
          
          $query = "update album
                         set nama_album='$nama_album',
                         ket= '$ket',
                                 waktu='$waktu',
                         status_display='$status_display'
                             
                         where id_album='$id_album' " ;
          //echo $query;
          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function deleteAlbum($id) {
          $query = "delete from album where id_album='$id'";
          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function readAlbum($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from album  $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
        
          return $data;
     }
     
     public function readAlbumFull($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from album $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
          
          return $data;
     }
     
     public function publishAlbum($id,$value) {
          $query = "update album set status_display=$value where id_album='$id'";
         // echo $query;
          //Execute query
           $result = $this->query($query);

          return $result;
     }

}


     
     

?>
