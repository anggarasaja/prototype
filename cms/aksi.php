<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University

require_once './config/application.php';
$path = ltrim($_SERVER['REQUEST_URI'], '/');    // Trim leading slash(es)

$temp_path = explode($PROSES_REQUEST,$path);


$elements = explode('/', $temp_path[1]);                // Split path on slashes
$data = array_filter($elements);
//$UTILITY->show_data($data);
if (count($data) == 0)                       // No path elements means home
     include "./index.php";
else{
   //untuk main menu
     switch ($data[1]) {             // Pop off first item and switch
          case 'pengguna':
               if ($data[2] == "hpengguna") {
                    $hapuspengguna = $purifier->purify($data[3]);
               }

               include "./core/pengguna/proses_pengguna.php";
               break;
          case 'today':
               if ($data[2] == "hdata") {
                    $hapusdata = $purifier->purify($data[3]);
               } else if ($data[2] == "publish") {
                    $publishdata = $purifier->purify($data[3]);
                    $publishvalue = $purifier->purify($data[4]);
               }
               include "./core/today/proses_today.php";

               break;

          case 'shopping':
               if ($data[2] == "hdata") {
                    $hapusdata = $purifier->purify($data[3]);
               } else if ($data[2] == "publish") {
                    $publishdata = $purifier->purify($data[3]);
                    $publishvalue = $purifier->purify($data[4]);
               }
               include "./core/shopping/proses_shopping.php";

               break;

          case 'food':
               if ($data[2] == "hdata") {
                    $hapusdata = $purifier->purify($data[3]);
                    $hapusdatakategori = $purifier->purify($data[4]);
               } else if ($data[2] == "publish") {
                    $publishdata = $purifier->purify($data[3]);
                    $publishvalue = $purifier->purify($data[4]);
                    $publishkategori = $purifier->purify($data[5]);
               }
               include "./core/food/proses_food.php";

               break;

          case 'culture':
               if ($data[2] == "hdata") {
                    $hapusdata = $purifier->purify($data[3]);
                    $hapusdatakategori = $purifier->purify($data[4]);
               } else if ($data[2] == "publish") {
                    $publishdata = $purifier->purify($data[3]);
                    $publishvalue = $purifier->purify($data[4]);
                    $publishkategori = $purifier->purify($data[5]);
               }
               include "./core/culture/proses_culture.php";

               break;
               
           case 'attraction':
               if ($data[2] == "hdata") {
                    $hapusdata = $purifier->purify($data[3]);
                    $hapusdatakategori = $purifier->purify($data[4]);
               } else if ($data[2] == "publish") {
                    $publishdata = $purifier->purify($data[3]);
                    $publishvalue = $purifier->purify($data[4]);
                    $publishkategori = $purifier->purify($data[5]);
               }
               include "./core/attraction/proses_attraction.php";

               break;
               
           case 'destination':
               if ($data[2] == "hdata") {
                    $hapusdata = $purifier->purify($data[3]);
                    $hapusdatakategori = $purifier->purify($data[4]);
               } else if ($data[2] == "publish") {
                    $publishdata = $purifier->purify($data[3]);
                    $publishvalue = $purifier->purify($data[4]);
                    $publishkategori = $purifier->purify($data[5]);
               }
               include "./core/destination/proses_destination.php";

               break;    
               
           case 'about':
               if ($data[2] == "hdata") {
                    $hapusdata = $purifier->purify($data[3]);
                    $hapusdatakategori = $purifier->purify($data[4]);
               } else if ($data[2] == "publish") {
                    $publishdata = $purifier->purify($data[3]);
                    $publishvalue = $purifier->purify($data[4]);
                    $publishkategori = $purifier->purify($data[5]);
               }
               include "./core/about/proses_about.php";

               break;     
               
             case 'album':
               if ($data[2] == "hdata") {
                    $hapusdata = $purifier->purify($data[3]);
               } else if ($data[2] == "publish") {
                    $publishdata = $purifier->purify($data[3]);
                    $publishvalue = $purifier->purify($data[4]);
               }
               include "./core/album/proses_album.php";

               break;
             
            case 'foto':
               if ($data[2] == "hdata") {
                    $hapusdata = $purifier->purify($data[3]);
                    $albumdata = $purifier->purify($data[4]);
               } else if ($data[2] == "publish") {
                    $publishdata = $purifier->purify($data[3]);
                    $publishvalue = $purifier->purify($data[4]);
                      $publishalbum = $purifier->purify($data[5]);
               
                } else if ($data[2] == "headline") {
                    $headlinedata = $purifier->purify($data[3]);
                    $headlinevalue = $purifier->purify($data[4]);
                       $headlinealbum = $purifier->purify($data[5]);
               }
               include "./core/foto/proses_foto.php";

               break;
               
          default:
               header('HTTP/1.1 404 Not Found');
               include "view/404.php";
     }
}
     ?>
