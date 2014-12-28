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

class modelPelatih extends mysql_db {

     //put your code here
     
     /* model data untuk gis bbsdm*/
     
     public function insertPelatihData($data){
			$id_propinsi = $data['id_propinsi'];
			$id_cabor = $data['id_cabor'];
			$pelatih = $data['pelatih'];
			$id_jk = $data['id_jk']; 
			
          $query = "Insert into tbl_pelatih
                         set id_propinsi='$id_propinsi',
                         id_cabor='$id_cabor',
                         pelatih='$pelatih',
                         id_jk='$id_jk'";
                    
         $result = $this->query($query);

         return $result;
     }
     
     public function readCaborData(){
			$query = "select * from tbl_cabor";
          //Execute query
         $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
			
     	}
     	
     	public function readPelatihData($data){
			$query = "select id_pelatih, pelatih from tbl_pelatih where id_cabor = '$data'";
          //Execute query
         $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
			
     	}
     	
     	public function readAllPelatih(){
     		$query = "select tbl_pelatih.id_pelatih, tbl_pelatih.pelatih, tbl_cabor.cabor, tbl_jk.jk, tbl_propinsi.propinsi from tbl_pelatih join tbl_cabor on tbl_pelatih.id_cabor = tbl_cabor.id_cabor join tbl_jk on tbl_pelatih.id_jk = tbl_jk.id_jk join tbl_propinsi on tbl_pelatih.id_propinsi = tbl_propinsi.id_propinsi";
     		
     		$result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
     		
     	}
     	
     	public function readAllPelatih_prop($id_propinsi){
     		$query = "select tbl_pelatih.id_pelatih, tbl_pelatih.pelatih, tbl_cabor.cabor, tbl_jk.jk, tbl_propinsi.propinsi from tbl_pelatih join tbl_cabor on tbl_pelatih.id_cabor = tbl_cabor.id_cabor join tbl_jk on tbl_pelatih.id_jk = tbl_jk.id_jk join tbl_propinsi on tbl_pelatih.id_propinsi = tbl_propinsi.id_propinsi where tbl_pelatih.id_propinsi = $id_propinsi";
     		$result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
     		
     	}
     	
     	public function readAllPelatih_cabor($id_cabor){
     		$query = "select tbl_pelatih.id_pelatih, tbl_pelatih.pelatih, tbl_cabor.cabor, tbl_jk.jk, tbl_propinsi.propinsi from tbl_pelatih join tbl_cabor on tbl_pelatih.id_cabor = tbl_cabor.id_cabor join tbl_jk on tbl_pelatih.id_jk = tbl_jk.id_jk join tbl_propinsi on tbl_pelatih.id_propinsi = tbl_propinsi.id_propinsi where tbl_pelatih.id_cabor=$id_cabor";
     		
     		$result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
     		
     	}

     	public function readAllPelatih_caborProp($id_propinsi,$id_cabor){
     		$query = "select tbl_pelatih.id_pelatih, tbl_pelatih.pelatih, tbl_cabor.cabor, tbl_jk.jk, tbl_propinsi.propinsi from tbl_pelatih join tbl_cabor on tbl_pelatih.id_cabor = tbl_cabor.id_cabor join tbl_jk on tbl_pelatih.id_jk = tbl_jk.id_jk join tbl_propinsi on tbl_pelatih.id_propinsi = tbl_propinsi.id_propinsi where tbl_pelatih.id_cabor=$id_cabor and tbl_pelatih.id_propinsi=$id_propinsi";
     		
     		$result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
     		
     	}		
     	
     	public function updatePelatih($data){
     		$id_pelatih = $data['id_pelatih'];
     		$id_propinsi = $data['id_propinsi'];
			$id_cabor = $data['id_cabor'];
			$id_jk = $data['id_jk'];
			$pelatih = $data['pelatih'];  
			
			$query ="UPDATE tbl_pelatih SET pelatih = '$pelatih' , id_propinsi = $id_propinsi , id_cabor = $id_cabor , id_jk = $id_jk WHERE id_pelatih = $id_pelatih";    	
			
			$result = $this->query($query);
			
     	}
     	
     	public function deletePelatih($data){
     		$id_pelatih = $data['id_pelatih'];
			$query ="DELETE FROM tbl_pelatih WHERE id_pelatih = $id_pelatih";
			
			$result = $this->query($query);
     	}
     	
		
}

?>
