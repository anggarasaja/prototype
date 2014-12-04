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

class modelDestination extends mysql_db {

     //put your code here
     public function insertData($data) {
          $id = $data['id'];
          $judul = $data['judul'];
          $waktu = $data['waktu'];
          $sub_judul = $data['sub_judul'];
          $content = $data['content'];
          $short_content = $data['short_content'];
          $image= $data['image'];
          $kategori= $data['kategori'];
          $kategori_2= $data['kategori_2'];
          $status_display= $data['status_display'];
          $longitude= $data['longitude'];
          $latitude= $data['latitude'];
          $language= $data['language'];
          $kategori_3= $data['kategori_3'];
           $provinsi= $data['provinsi'];
           $kabupaten= $data['kabupaten'];
          
          $user_id=$_SESSION['user_id'];
                   
          $query = "Insert into destination
                         set judul='$judul',
                         sub_judul='$sub_judul',
                               waktu='$waktu',
                         content='$content',
                         short_content='$short_content',   
                         image='$image',
                         kategori='$kategori',
                         kategori_2='$kategori_2',
                        status_display='$status_display',
                        latitude='$latitude',
                        longitude='$longitude',
                        provinsi='$provinsi', kabupaten='$kabupaten',  kategori_3='$kategori_3',   
                        language='$language',"
                  . "user_id=$user_id";

          //Execute query
            $result = $this->query($query);

          return $result;
     }

     public function updateData($data) {
          $id = $data['id'];
          $judul = $data['judul'];
          $waktu = $data['waktu'];
          $sub_judul = $data['sub_judul'];
          $content = $data['content'];
          $short_content = $data['short_content'];
          $image= $data['image'];
          $kategori= $data['kategori'];
          $kategori_2= $data['kategori_2'];
          $status_display= $data['status_display'];
          $longitude= $data['longitude'];
          $latitude= $data['latitude'];
          $language= $data['language'];
           $kategori_3= $data['kategori_3'];
          $provinsi= $data['provinsi'];
           $kabupaten= $data['kabupaten'];
           
        $provinsi= $data['provinsi'];
           $kabupaten= $data['kabupaten'];
           
         $query = "update  destination
                         set judul='$judul',
                         sub_judul='$sub_judul',
                         waktu='$waktu',
                         content='$content',
                         short_content='$short_content',   
                         image='$image',
                         kategori='$kategori',
                         kategori_2='$kategori_2',
                        status_display='$status_display',
                        latitude='$latitude',
                        longitude='$longitude',
                              provinsi='$provinsi', kabupaten='$kabupaten',  kategori_3='$kategori_3',   
                        language='$language' where id='$id'";

          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function deleteData($id) {
          $query = "delete from destination where id='$id'";
          //Execute query
          $result = $this->query($query);

          return $result;
     }
     
       public function publishData($id,$value) {
          $query = "update destination set status_display=$value where id='$id'";
          //Execute query
           $result = $this->query($query);

          return $result;
     }

     public function readData($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from destination $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
        
          return $data;
     }
     
     public function readDataFull($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from destination $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
          
          return $data;
     }

}

?>
