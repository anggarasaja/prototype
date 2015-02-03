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

class modelMedali extends mysql_db {

     //put your code here
     
     /* model data untuk gis bbsdm*/
     
     public function insertMedaliData($data){
			$emas = $data['emas'];
			$perak = $data['perak'];
			$perunggu = $data['perunggu'];
			$jml_medali = $emas + $perak + $perunggu; 
			$id_cabor = $data['id_cabor'];
			$id_propinsi = $data['id_propinsi'];
			$tahun = $data['tahun'];
			$kejuaraan = $data['kejuaraan'];
			
          $query = "Insert into tbl_medali
                         set emas=$emas ,
                         perak=$perak ,
                         perunggu= $medali ,
                         jml_medali=$jml_medali ,
                         id_cabor = $id_cabor ,
                         id_propinsi = $id_propinsi ,
                         tahun = $tahun ,
                         kejuaraan = $kejuaraan";
                    
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
     	
     	public function readAllMedali(){
     		$query = "select tbl_medali.id_medali, tbl_medali.emas, tbl_medali.perak, tbl_medali.perunggu, tbl_medali.jml_medali, tbl_cabor.cabor, tbl_propinsi.propinsi, tbl_medali.tahun, tbl_kejuaraan.kejuaraan from tbl_medali join tbl_cabor on tbl_medali.id_cabor = tbl_cabor.id_cabor join tbl_propinsi on tbl_medali.id_propinsi = tbl_propinsi.id_propinsi join tbl_kejuaraan on tbl_medali.kejuaraan = tbl_kejuaraan.id_kejuaraan";
     		
     		$result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
     		
     	}
     	
     	public function readAllMedali_prop($id_propinsi){
     		$query = "select tbl_medali.id_medali, tbl_medali.emas, tbl_medali.perak, tbl_medali.perunggu, tbl_medali.jml_medali, tbl_cabor.cabor, tbl_propinsi.propinsi, tbl_medali.tahun, tbl_kejuaraan.kejuaraan from tbl_medali join tbl_cabor on tbl_medali.id_cabor = tbl_cabor.id_cabor join tbl_propinsi on tbl_medali.id_propinsi = tbl_propinsi.id_propinsi join tbl_kejuaraan on tbl_medali.kejuaraan = tbl_kejuaraan.id_kejuaraan where tbl_medali.id_propinsi = $id_propinsi";
     		$result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
     		
     	}
     	
     	public function readAllMedali_cabor($id_cabor){
     		$query = "select tbl_medali.id_medali, tbl_medali.emas, tbl_medali.perak, tbl_medali.perunggu, tbl_medali.jml_medali, tbl_cabor.cabor, tbl_propinsi.propinsi, tbl_medali.tahun, tbl_kejuaraan.kejuaraan from tbl_medali join tbl_cabor on tbl_medali.id_cabor = tbl_cabor.id_cabor join tbl_propinsi on tbl_medali.id_propinsi = tbl_propinsi.id_propinsi join tbl_kejuaraan on tbl_medali.kejuaraan = tbl_kejuaraan.id_kejuaraan where tbl_medali.id_cabor=$id_cabor";
     		
     		$result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
     		
     	}
     	
     	public function readAllMedali_tahun($tahun){
     		$query = "select tbl_medali.id_medali, tbl_medali.emas, tbl_medali.perak, tbl_medali.perunggu, tbl_medali.jml_medali, tbl_cabor.cabor, tbl_propinsi.propinsi, tbl_medali.tahun, tbl_kejuaraan.kejuaraan from tbl_medali join tbl_cabor on tbl_medali.id_cabor = tbl_cabor.id_cabor join tbl_propinsi on tbl_medali.id_propinsi = tbl_propinsi.id_propinsi join tbl_kejuaraan on tbl_medali.kejuaraan = tbl_kejuaraan.id_kejuaraan where tbl_medali.tahun=$tahun";
     		
     		$result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
     		
     	}

     	public function readAllMedali_caborProp($id_propinsi,$id_cabor){
     		$query = "select tbl_medali.id_medali, tbl_medali.emas, tbl_medali.perak, tbl_medali.perunggu, tbl_medali.jml_medali, tbl_cabor.cabor, tbl_propinsi.propinsi, tbl_medali.tahun, tbl_kejuaraan.kejuaraan from tbl_medali join tbl_cabor on tbl_medali.id_cabor = tbl_cabor.id_cabor join tbl_propinsi on tbl_medali.id_propinsi = tbl_propinsi.id_propinsi join tbl_kejuaraan on tbl_medali.kejuaraan = tbl_kejuaraan.id_kejuaraan where tbl_medali.id_cabor=$id_cabor and tbl_medali.id_propinsi=$id_propinsi";
     		
     		$result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
     		
     	}
     	
     	public function readAllMedali_tahunProp($tahun,$id_propinsi){
     		$query = "select tbl_medali.id_medali, tbl_medali.emas, tbl_medali.perak, tbl_medali.perunggu, tbl_medali.jml_medali, tbl_cabor.cabor, tbl_propinsi.propinsi, tbl_medali.tahun, tbl_kejuaraan.kejuaraan from tbl_medali join tbl_cabor on tbl_medali.id_cabor = tbl_cabor.id_cabor join tbl_propinsi on tbl_medali.id_propinsi = tbl_propinsi.id_propinsi join tbl_kejuaraan on tbl_medali.kejuaraan = tbl_kejuaraan.id_kejuaraan where tbl_medali.tahun=$tahun and tbl_medali.id_propinsi=$id_propinsi";
     		
     		$result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
     		
     	}
     	
     	public function readAllMedali_caborTahun($id_cabor,$tahun){
     		$query = "select tbl_medali.id_medali, tbl_medali.emas, tbl_medali.perak, tbl_medali.perunggu, tbl_medali.jml_medali, tbl_cabor.cabor, tbl_propinsi.propinsi, tbl_medali.tahun, tbl_kejuaraan.kejuaraan from tbl_medali join tbl_cabor on tbl_medali.id_cabor = tbl_cabor.id_cabor join tbl_propinsi on tbl_medali.id_propinsi = tbl_propinsi.id_propinsi join tbl_kejuaraan on tbl_medali.kejuaraan = tbl_kejuaraan.id_kejuaraan where tbl_medali.id_cabor=$id_cabor and tbl_medali.tahun=$tahun";
     		
     		$result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
     		
     	}
     	
     	public function readAllMedali_caborPropTahun($id_propinsi,$id_cabor,$tahun){
     		$query = "select tbl_medali.id_medali, tbl_medali.emas, tbl_medali.perak, tbl_medali.perunggu, tbl_medali.jml_medali, tbl_cabor.cabor, tbl_propinsi.propinsi, tbl_medali.tahun, tbl_kejuaraan.kejuaraan from tbl_medali join tbl_cabor on tbl_medali.id_cabor = tbl_cabor.id_cabor join tbl_propinsi on tbl_medali.id_propinsi = tbl_propinsi.id_propinsi join tbl_kejuaraan on tbl_medali.kejuaraan = tbl_kejuaraan.id_kejuaraan where tbl_medali.id_cabor=$id_cabor and tbl_medali.id_propinsi=$id_propinsi and tbl_medali.tahun = $tahun" ;
     		
     		$result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
         //$data=$this->fetch_object($result);
         return $result;
     		
     	}		
     	
     	public function updateMedali($data){
     		$emas = $data['emas'];
			$perak = $data['perak'];
			$perunggu = $data['perunggu'];
			$jml_medali = $emas + $perak + $perunggu; 
			$id_cabor = $data['id_cabor'];
			$id_propinsi = $data['id_propinsi'];
			$tahun = $data['tahun'];
			$kejuaraan = $data['kejuaraan'];
			
			$query ="UPDATE tbl_medali SET emas = $emas , perak = $perak , perunggu = $perunggu , jml_medali = $jml_medali , id_cabor = $id_cabor , id_propinsi = $id_propinsi , tahun = $tahun , kejuaraan = $id_kejuaraan WHERE id_medali = $id_medali";    	
			
			$result = $this->query($query);
			
     	}
     	
     	public function deleteMedali($data){
     		$id_medali = $data['id_medali'];
			$query ="DELETE FROM tbl_medali WHERE id_medali = $id_medali";
			
			$result = $this->query($query);
     	}
     	
		
}

?>
