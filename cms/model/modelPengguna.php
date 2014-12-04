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

class modelPengguna extends mysql_db {

     //put your code here
     public function insertPengguna($data) {
          $username = $data['username'];
          $password = $data['password'];
          $level = $data['level'];
          $keterangan = $data['keterangan'];
          
          $query = "Insert into user 
                         set username='$username',
                         password= '$password',
                         level='$level'
                         ";

          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function updatePengguna($data) {
          $username = $data['username'];
          $password = $data['password'];
          $level = $data['level'];
          $keterangan = $data['keterangan'];
          
          $user_id = $data['user_id'];

          $query = "update user 
                         set username='$username',
                         password= '$password',
                         level='$level'
                        where user_id='$user_id'";

          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function deletePengguna($user_id) {
          $query = "delete from user where user_id='$user_id'";
          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function readPengguna($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from user $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
        
          return $data;
     }
     
     public function readPenggunaFull($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from user $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
          
          return $data;
     }

}

?>
