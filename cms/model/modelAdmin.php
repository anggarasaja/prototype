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

class modelAdmin extends mysql_db {

     //put your code here
     
     /* model data untuk gis bbsdm*/
     
     public function insertAdminData($data){
			$iduser = $data['user_id'];
			$username = $data['username'];
			$level = $data['level'];
			$keterangan = $data['keterangan'];
			$password = $data['password'];
			
          $query = "Insert into user
                         set user_id='$iduser',
                         username='$username',
                         level='$level',
                         keterangan='$keterangan',
                         password='$password'";
                    
         $result = $this->query($query);

         return $result;
     }
     	
     	public function readAdmin(){
     		$query = "select * from user";
     		$result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
     		
     	}
     	
     	public function updateAdmin($data){
     		$iduser = $data['user_id'];
			$username = $data['username'];
			$level = $data['level'];
			$keterangan = $data['keterangan'];
			$password = $data['password'];
			
          $query = "update user
                         set username='$username',
                         level='$level',
                         keterangan='$keterangan',
                         password='$password'
                         where user_id = $iduser"; 
			
			//$query ="UPDATE tbl_atlet SET atlet = '$atlet' , id_pelatih = '$id_pelatih' , id_propinsi = '$id_propinsi' , id_cabor = '$id_cabor' , id_jk = '$id_jk' , lat= '$lat' , lng = '$lng' WHERE id_atlet= $id_atlet";    	
			
			$result = $this->query($query);
			
     	}
     	
     	public function deleteAdmin($data){
     		$iduser = $data['user_id'];
			$query ="DELETE FROM user WHERE user_id = $iduser";
			
			$result = $this->query($query);
     	}
     	
		
}

?>
