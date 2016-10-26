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

class modelPelopor extends mysql_db {

     //put your code here
     
     /* model data untuk gis bbsdm*/
     
     public function importFile($data){
		
        $query = "INSERT INTO tbl_pelopor (tahun, jenis, nama, gender, ttl, pendidikan, alamat, provinsi, kontak, lat, lng) VALUES ";
        for ($i=2; $i <= count($data); $i++) { 
            $query .= "('".trim($data[$i]["C"]," \t\n\r\0\x0B\xA0\x0D\x0A")."','".trim($data[$i]["B"]," \t\n\r\0\x0B\xA0\x0D\x0A")."','".trim($data[$i]["D"]," \t\n\r\0\x0B\xA0\x0D\x0A")."','".trim($data[$i]["F"]," \t\n\r\0\x0B\xA0\x0D\x0A")."','".trim($data[$i]["E"]," \t\n\r\0\x0B\xA0\x0D\x0A")."','".trim($data[$i]["G"]," \t\n\r\0\x0B\xA0\x0D\x0A")."','".trim($data[$i]["H"]," \t\n\r\0\x0B\xA0\x0D\x0A")."','".trim($data[$i]["I"]," \t\n\r\0\x0B\xA0\x0D\x0A")."','".trim($data[$i]["J"]," \t\n\r\0\x0B\xA0\x0D\x0A")."','".trim($data[$i]["K"]," \t\n\r\0\x0B\xA0\x0D\x0A")."','".trim($data[$i]["L"]," \t\n\r\0\x0B\xA0\x0D\x0A")."'),";
        }
        $query  = substr($query,0,-1);
        $result = $this->query($query);
        return $result;
     }
     public function readAllPelopor(){
            $query = "SELECT * FROM tbl_pelopor";
            $result = $this->query($query);
            return $result;	
    }
}

?>
