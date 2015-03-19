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

class modelAtlet extends mysql_db {

     //put your code here
     
     /* model data untuk gis bbsdm*/
     
     public function insertAtletData($data){
			$id_propinsi = $data['id_propinsi'];
			$id_cabor = $data['id_cabor'];
			$atlet = $data['atlet'];
			$id_jk = $data['id_jk'];
			$id_pelatih = $data['id_pelatih'];
			$lat = $data['lat'];
			$lng = $data['lng'];   
			
          $query = "Insert into tbl_atlet
                         set id_propinsi=$id_propinsi ,
                         id_cabor=$id_cabor ,
                         atlet='$atlet' ,
                         id_jk=$id_jk ,
                         id_pelatih=$id_pelatih ,
                         lat= $lat ,   
                         lng= $lng";
                    
         $this->query($query);

         return $this->connect->insert_id;
     }
     
     public function insertPrestasiAtlet($data){
			$emas = $data['emas'];
			$perak = $data['perak'];
			$perunggu = $data['perunggu'];
			$kejuaraan = $data['kejuaraan'];
			$keterangan = $data['keterangan'];
			$id_atlet = $data['id_atlet'];
			
          $query = "Insert into tbl_prestasi
                         set emas= $emas ,
                         perak=$perak ,
                         perunggu=$perunggu ,
                         kejuaraan=$kejuaraan ,
                         keterangan='$keterangan',
                         id_atlet= $id_atlet ";
                    
         $result = $this->query($query);

         return result;
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
     	
     	public function readPrestasi($id_atlet){
     		$query = "select tbl_prestasi.emas, tbl_prestasi.perak, tbl_prestasi.perunggu, tbl_prestasi.keterangan, tbl_prestasi.kejuaraan from tbl_prestasi where tbl_prestasi.id_atlet=$id_atlet";
     		
     		$result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
     		
     	}
     	
     	public function readAllAtlet(){
     		$query = "select tbl_atlet.id_atlet, tbl_atlet.atlet, tbl_pelatih.pelatih, tbl_cabor.cabor, tbl_jk.jk, tbl_propinsi.propinsi, tbl_atlet.lat, tbl_propinsi.lng from tbl_atlet join tbl_pelatih on tbl_pelatih.id_pelatih = tbl_atlet.id_pelatih join tbl_cabor on tbl_cabor.id_cabor = tbl_atlet.id_cabor join tbl_jk on tbl_jk.id_jk = tbl_atlet.id_jk join tbl_propinsi on tbl_propinsi. id_propinsi = tbl_atlet.id_propinsi";
     		
     		$result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
     		
     	}
     	
     	public function readAllAtlet_prop($id_propinsi){
     		$query = "select tbl_atlet.id_atlet, tbl_atlet.atlet, tbl_pelatih.pelatih, tbl_cabor.cabor, tbl_jk.jk, tbl_propinsi.propinsi, tbl_atlet.lat, tbl_propinsi.lng from tbl_atlet join tbl_pelatih on tbl_pelatih.id_pelatih = tbl_atlet.id_pelatih join tbl_cabor on tbl_cabor.id_cabor = tbl_atlet.id_cabor join tbl_jk on tbl_jk.id_jk = tbl_atlet.id_jk join tbl_propinsi on tbl_propinsi. id_propinsi = tbl_atlet.id_propinsi where tbl_atlet.id_propinsi=$id_propinsi";
     		
     		$result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
     		
     	}
     	
     	public function readAllAtlet_cabor($id_cabor){
     		$query = "select tbl_atlet.id_atlet, tbl_atlet.atlet, tbl_pelatih.pelatih, tbl_cabor.cabor, tbl_jk.jk, tbl_propinsi.propinsi, tbl_atlet.lat, tbl_propinsi.lng from tbl_atlet join tbl_pelatih on tbl_pelatih.id_pelatih = tbl_atlet.id_pelatih join tbl_cabor on tbl_cabor.id_cabor = tbl_atlet.id_cabor join tbl_jk on tbl_jk.id_jk = tbl_atlet.id_jk join tbl_propinsi on tbl_propinsi. id_propinsi = tbl_atlet.id_propinsi where tbl_atlet.id_cabor=$id_cabor";
     		
     		$result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
     		
     	}

     	public function readAllAtlet_caborProp($id_propinsi,$id_cabor){
     		$query = "select tbl_atlet.id_atlet, tbl_atlet.atlet, tbl_pelatih.pelatih, tbl_cabor.cabor, tbl_jk.jk, tbl_propinsi.propinsi, tbl_atlet.lat, tbl_propinsi.lng from tbl_atlet join tbl_pelatih on tbl_pelatih.id_pelatih = tbl_atlet.id_pelatih join tbl_cabor on tbl_cabor.id_cabor = tbl_atlet.id_cabor join tbl_jk on tbl_jk.id_jk = tbl_atlet.id_jk join tbl_propinsi on tbl_propinsi. id_propinsi = tbl_atlet.id_propinsi where tbl_atlet.id_cabor=$id_cabor and tbl_atlet.id_propinsi=$id_propinsi";
     		
     		$result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
     		
     	}		
     	
     	public function updateAtlet($data){
     		$id_atlet = $data['id_atlet'];
     		$id_propinsi = $data['id_propinsi'];
			$id_cabor = $data['id_cabor'];
			$atlet = $data['atlet'];
			$id_jk = $data['id_jk'];
			$id_pelatih = $data['id_pelatih'];
			$lat = $data['lat'];
			$lng = $data['lng'];  
			
			$query ="UPDATE tbl_atlet SET atlet = '$atlet' , id_pelatih = '$id_pelatih' , id_propinsi = '$id_propinsi' , id_cabor = '$id_cabor' , id_jk = '$id_jk' , lat= '$lat' , lng = '$lng' WHERE id_atlet= $id_atlet";    	
			
			$result = $this->query($query);
			
     	}
     	
     	public function deleteAtlet($data){
     		$id_atlet = $data['id_atlet'];
			$query ="DELETE FROM tbl_atlet WHERE id_atlet = $id_atlet";
			
			$result = $this->query($query);
     	}
     	
		
}

?>
