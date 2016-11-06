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

class modelPpikor extends mysql_db {

     //put your code here
     
     /* model data untuk gis bbsdm*/
     
     public function importFile($data){
        $query = "INSERT INTO tbl_ppikor (jenis, tahun, nama, gender, provinsi, thn_berangkat, agama, alamat, ttl, kontak, pendidikan, pekerjaan, lat, lng) VALUES ";
        for ($i=2; $i <= count($data); $i++) {
            $pecah = explode(',', trim($data[$i]["M"]," \t\n\r\0\x0B\xA0\x0D\x0A"));
            $query .= "('".trim($data[$i]["A"]," \t\n\r\0\x0B\xA0\x0D\x0A")."','".trim($data[$i]["B"]," \t\n\r\0\x0B\xA0\x0D\x0A")."','".trim($data[$i]["C"]," \t\n\r\0\x0B\xA0\x0D\x0A")."','".trim($data[$i]["D"]," \t\n\r\0\x0B\xA0\x0D\x0A")."','".trim($data[$i]["E"]," \t\n\r\0\x0B\xA0\x0D\x0A")."','".trim($data[$i]["F"]," \t\n\r\0\x0B\xA0\x0D\x0A")."','".trim($data[$i]["G"]," \t\n\r\0\x0B\xA0\x0D\x0A")."','".trim($data[$i]["H"]," \t\n\r\0\x0B\xA0\x0D\x0A")."','".trim($data[$i]["I"]," \t\n\r\0\x0B\xA0\x0D\x0A")."','".trim($data[$i]["J"]," \t\n\r\0\x0B\xA0\x0D\x0A")."','".trim($data[$i]["K"]," \t\n\r\0\x0B\xA0\x0D\x0A")."','".trim($data[$i]["L"]," \t\n\r\0\x0B\xA0\x0D\x0A")."','".trim($pecah[0]," \t\n\r\0\x0B\xA0\x0D\x0A")."','".trim($pecah[1]," \t\n\r\0\x0B\xA0\x0D\x0A")."'),";
        }
        $query  = substr($query,0,-1);
        $result = $this->query($query);
        return $result;
     }
     public function readAllPpikor(){
            $query = "SELECT * FROM tbl_ppikor";
            $result = $this->query($query);
            return $result;	
    }
}

?>
