<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
?>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../../index.php"><?=$TITLE?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
             
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <?=$_SESSION['user_name'] ?><i class="fa fa-caret-down"></i>
                        
                    </a>
                    <ul  class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?=$url_rewrite?>quit"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>    
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        <li>
                            <a href="<?=$url_rewrite?>content/home"><i class="fa fa-home  fa-fw"></i> Home</a>
                        </li>
                        <li>
                             <a href="#"><i class="fa fa-legal fa-fw"></i> Input Data<span class="fa arrow"></span></a>
                             
                             <ul class="nav nav-second-level">
                                  <li><a href="<?=$url_rewrite?>content/data_atlet"><i class="fa fa-map-marker  fa-fw"></i> Input Data Atlet</a></li>
                                  <li><a href="<?=$url_rewrite?>content/data_pelatih"><i class="fa fa-info-circle fa-fw"></i> Input Data Pelatih</a></li>
                             		 <li><a href="<?=$url_rewrite?>content/data_pemuda"><i class="fa fa-info-circle fa-fw"></i> Input Data Kepemudaan</a></li>
                                  <li><a href="<?=$url_rewrite?>content/data_knpi"><i class="fa fa-info-circle fa-fw"></i> Input Data KNPI</a></li>
                                  <li><a href="<?=$url_rewrite?>content/data_medali"><i class="fa fa-info-circle fa-fw"></i> Input Data Medali</a></li>
                                  <li><a href="<?=$url_rewrite?>content/data_sarpras"><i class="fa fa-info-circle fa-fw"></i> Input Data Sarana & Prasarana</a></li>
                                  <li><a href="<?=$url_rewrite?>content/data_pelopor"><i class="fa fa-info-circle fa-fw"></i> Input Data Pelopor Pemuda</a></li>
                             </ul>
                        </li>
                        <li>
                            <a href="<?=$url_rewrite?>content/import_file"><i class="fa fa-file-excel-o fa-fw"></i> Import File Excel</a>
                        </li>
                        <li>
                            <a href="<?=$url_rewrite?>content/manage_admin"><i class="fa fa-users fa-fw"></i> Manage Admin</a>
                        </li>
                    </ul>
                    
                    <!-- /#side-menu -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
