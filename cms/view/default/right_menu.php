<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
session_start();
if (isset($_SESSION['level']))
{
 
   if ($_SESSION['level'] == "1")
   {
      include 'admin_menu.php';
   }
   else if ($_SESSION['level'] == "2")
   {
      include 'user_menu.php';
   }
}
?>