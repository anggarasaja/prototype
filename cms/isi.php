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
$temp_path = explode($REQUEST, $path);


$elements = explode('/', $temp_path[1]);                // Split path on slashes
$data = array_filter($elements);

if (count($data) == 0)                       // No path elements means home
     include "./index.php";
else
//untuk main menu
     switch ($data[1]) {             // Pop off first item and switch
          case 'home':
               include "view/home.php";
               break;
          case 'data_atlet':
               include "view/input_atlet.php";
               break;
          case 'data_pelatih':
               include "view/input_pelatih.php";
               break;
         case 'data_pemuda':
               include "view/input_pemuda.php";
               break;
         case 'data_knpi':
               include "view/input_knpi.php";
               break;
         case 'data_sarpras':
               include "view/input_sarpras.php";
               break;
         case 'data_pelopor':
               include "view/input_pelopor.php";
               break;
          case 'data_medali':
               include "view/input_medali.php";
               break;
          case 'manage_admin':
               include "view/manage_admin.php";
               break;
          case 'import_file':
               include "view/import_file.php";
               break;

          

          default:
               header('HTTP/1.1 404 Not Found');
               include "view/404.php";
     }
?>
