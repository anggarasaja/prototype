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

class modelKNPI extends mysql_db {

     //put your code here
     
     /* model data untuk gis bbsdm*/
     
     public function insertKNPIData($data){
     		$nama = $data['KNPI'];
     		$alamat =$data['alamat'];
     		$logo =$data['logo'];
     		$pemimpin =$data['pemimpin'];
     		$telp =$data['telp'];
     		$lat =$data['lat'];
     		$lng =$data['lng'];
			$id_propinsi = $data['id_propinsi'];
						
         $query = "Insert into tbl_knpi
                         set nama='$nama',
                         alamat='$alamat',
                         logo='$logo',
                         pemimpin='$pemimpin',
                         telp='$telp',
                         lat=$lat ,
                         lng = $lng ,
                         id_propinsi = $id_propinsi ";
                    
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
     	
     	public function readKNPIData($data){
			$query = "select id_knpi, knpi from tbl_knpi where id_cabor = '$data'";
          //Execute query
         $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
			
     	}
     	
     	public function readAllKNPI(){
     		$query = "select tbl_knpi.id_knpi, tbl_knpi.nama, tbl_knpi.alamat, tbl_knpi.logo, tbl_knpi.pemimpin, tbl_knpi.telp,  tbl_knpi.lat, tbl_knpi.lng, tbl_propinsi.propinsi from tbl_knpi join tbl_propinsi on tbl_knpi.id_propinsi = tbl_propinsi.id_propinsi";
     		
     		$result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
     		
     	}
     	
     	public function readAllKNPI_prop($id_propinsi){
     		$query = "select tbl_knpi.id_knpi, tbl_knpi.nama, tbl_knpi.alamat, tbl_knpi.logo, tbl_knpi.pemimpin, tbl_knpi.telp,  tbl_knpi.lat, tbl_knpi.lng, tbl_propinsi.propinsi from tbl_knpi join tbl_propinsi on tbl_knpi.id_propinsi = tbl_propinsi.id_propinsi where tbl_knpi.id_propinsi = $id_propinsi";
     		$result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
     		
     	}
     	

		
     	
     	public function updateKNPI($data){
     		$id_knpi = $data['id_KNPI'];
     		$nama = $data['KNPI'];
     		$alamat =$data['alamat'];
     		$logo =$data['logo'];
     		$pemimpin =$data['pemimpin'];
     		$telp =$data['telp'];
     		$lat =$data['lat'];
     		$lng =$data['lng'];
			$id_propinsi = $data['id_propinsi'];
			if ($logo == ''){
				$query ="UPDATE tbl_knpi SET nama = '$nama' , alamat = '$alamat', pemimpin = '$pemimpin', telp = '$telp', lat = $lat , lng = $lng , id_propinsi = $id_propinsi WHERE id_knpi = $id_knpi";    	
			} else {
				$query ="UPDATE tbl_knpi SET nama = '$nama' , alamat = '$alamat', logo = '$logo', pemimpin = '$pemimpin', telp = '$telp', lat = $lat , lng = $lng , id_propinsi = $id_propinsi WHERE id_knpi = $id_knpi";    	
		}
			$result = $this->query($query);
			
     	}
     	
     	public function deleteKNPI($data){
     		$id_knpi = $data['id_KNPI'];
			$query ="DELETE FROM tbl_knpi WHERE id_knpi = $id_knpi";
			
			$result = $this->query($query);
     	}
     	
		
}

?>
