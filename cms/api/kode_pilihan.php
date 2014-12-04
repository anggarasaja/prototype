<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include '../config/application.php';
$kategori=$purifier->purify($_GET[kategori]);



if($kategori=="kabupaten"){
    $id_provinsi=$purifier->purify($_GET[id_provinsi]);
    //untuk kabupaten
   echo("<div class=\"form-group\">
        <label>Kabupaten</label>
          <select class=\"form-control\" name=\"kabupaten\" id=\"kabupaten\">
             <option value=\"\">None</option>");
            $query_kabupaten="select * from Data_Kabupaten
                                where id_provinsi='$id_provinsi' order by id_kabupaten";
            echo($query_kabupaten);
            $result_kabupaten=$DB->query($query_kabupaten)or die(mysql_error());
            while($row_kabupaten=  $DB->fetch_object($result_kabupaten)){
                   $id_kabupaten=$row_kabupaten->id_kabupaten;
                   $nama_kabupaten=$row_kabupaten->nama_kabupaten;
                   echo("<option value='$id_kabupaten'>$nama_kabupaten</option>");
            }


     echo("</select></div>");
     //akhir untuk kabupaten
}
else if($kategori=="provinsi")
{
       $region=$purifier->purify($_GET[region]);   
     echo("<div class=\"form-group\">
        <label>Provinsi</label>");
            echo("<select class=\"form-control\" id=\"provinsi\" name=\"provinsi\" onChange=\"tampilkanKabupaten();\"> ");
            echo("<option value=\"\">None</option>");
            $query_provinsi="select * from Data_Provinsi where region='$region' order by id_provinsi";
            
            $result_provinsi=$DB->query($query_provinsi)or die(mysql_error());
            while($row_provinsi=  $DB->fetch_object($result_provinsi)){
                $id_provinsi=$row_provinsi->id_provinsi;
                $nama_provinsi=$row_provinsi->nama_provinsi;
                if($id_provinsi==$provinsi_kantor)
                    echo("<option value='$id_provinsi' selected>$nama_provinsi</option>");
                else
                    echo("<option value='$id_provinsi'>$nama_provinsi</option>");
            }
            echo("</select>");
        echo("</div>");
  
        //Akhir Provinsi Kantor
    }


?>
