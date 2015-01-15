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

class modelPemuda extends mysql_db {

     //put your code here
     
     /* model data untuk gis bbsdm*/
     
     public function insertPemudaData($data){
			$id_propinsi = $data['id_propinsi'];
			$id_cabor = $data['id_cabor'];
			$pemuda = $data['pemuda'];
			$id_jk = $data['id_jk']; 
			$keterangan = $data["keterangan"];
			
          $query = "Insert into tbl_pemuda
                         set id_propinsi='$id_propinsi',
                         pemuda='$pemuda',
                         id_jk='$id_jk',
                         keterangan = '$keterangan'";
                    
         $result = $this->query($query);

         return $result;
     }
     
     	
     	public function readAllPemuda(){
     		$query = "select tbl_pemuda.id_pemuda, tbl_pemuda.pemuda, tbl_jk.jk, tbl_propinsi.propinsi, tbl_pemuda.keterangan from tbl_pemuda join tbl_jk on tbl_pemuda.id_jk = tbl_jk.id_jk join tbl_propinsi on tbl_pemuda.id_propinsi = tbl_propinsi.id_propinsi";
     		
     		$result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
     		
     	}
     	
     	public function readAllPemuda_prop($id_propinsi){
     		$query = "select tbl_pemuda.id_pemuda, tbl_pemuda.pemuda, tbl_jk.jk, tbl_propinsi.propinsi, tbl_pemuda.keterangan from tbl_pemuda join tbl_jk on tbl_pemuda.id_jk = tbl_jk.id_jk join tbl_propinsi on tbl_pemuda.id_propinsi = tbl_propinsi.id_propinsi where tbl_pemuda.id_propinsi = $id_propinsi";
     		$result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
     		
     	}
     	

		
     	
     	public function updatePemuda($data){
     		$id_pemuda = $data['id_pemuda'];
     		$id_propinsi = $data['id_propinsi'];
			$id_jk = $data['id_jk'];
			$pemuda = $data['pemuda'];  
			$keterangan = $data['keterangan'];
			echo $keterangan;
			
			$query ="UPDATE tbl_pemuda SET pemuda = '$pemuda' , id_propinsi = $id_propinsi , id_jk = $id_jk , keterangan = '$keterangan'  WHERE id_pemuda = $id_pemuda";    	
			
			$result = $this->query($query);
			
     	}
     	
     	public function deletePemuda($data){
     		$id_pemuda = $data['id_pemuda'];
			$query ="DELETE FROM tbl_pemuda WHERE id_pemuda = $id_pemuda";
			
			$result = $this->query($query);
     	}
     	
		
}

?>
