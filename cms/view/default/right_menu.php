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
                <a class="navbar-brand" href="index.html"><?=$TITLE?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
             
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <?=$_SESSION['user_name'] ?><i class="fa fa-caret-down"></i>
                        
                    </a>
                    <ul class="dropdown-menu dropdown-user">
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
                            <a href="<?=$url_rewrite?>content/today"><i class="fa fa-calendar  fa-fw"></i> Today's  Festivial</a>
                        </li>
                        <li>
                             <a href="<?=$url_rewrite?>"><i class="fa fa-legal fa-fw"></i> About Indonesia<span class="fa arrow"></span></a>
                             
                             <ul class="nav nav-second-level">
                                  <li><a href="<?=$url_rewrite?>content/about/1"><i class="fa fa-map-marker  fa-fw"></i> Location</a></li>
                                  <li><a href="<?=$url_rewrite?>content/about/2"><i class="fa fa-info-circle fa-fw"></i> General Info</a></li>
                                  <li><a href="<?=$url_rewrite?>content/about/3"><i class="fa fa-bus fa-fw"></i> Traveller's Essential</a></li>
                             </ul>
                        </li>
                        <li>
                             <a href="<?=$url_rewrite?>"><i class="fa fa-road fa-fw"></i> Destination<span class="fa arrow"></span></a>
                             
                             <ul class="nav nav-second-level">
                                  <li><a href="<?=$url_rewrite?>content/destination/1"><i class="fa fa-trophy fa-fw"></i> Recommended</a></li>
                                  <li><a href="<?=$url_rewrite?>content/destination/2"><i class="fa fa-heart fa-fw"></i> Spectacular indonesia Spot</a></li>
                                  <li><a href="<?=$url_rewrite?>content/destination/3"><i class="fa fa-send fa-fw"></i> Region</a></li>
                             </ul>
                        </li>
                        <li>
                             <a href="<?=$url_rewrite?>"><i class="fa fa-check fa-fw"></i> Attraction<span class="fa arrow"></span></a>
                             
                             <ul class="nav nav-second-level">
                                  <li><a href="<?=$url_rewrite?>content/attraction/1"><i class="fa fa-trophy fa-fw"></i> Travel Highlights</a></li>
                                  <li><a href="<?=$url_rewrite?>content/attraction/2"><i class="fa fa-calendar fa-fw"></i> Events</a></li>
                                  
                             </ul>
                        </li>
                        
                        <li>
                             <a href="<?=$url_rewrite?>"><i class="fa fa-users fa-fw"></i> Culture & Art Life<span class="fa arrow"></span></a>
                             
                             <ul class="nav nav-second-level">
                                  <li><a href="<?=$url_rewrite?>content/culture/1"><i class="fa fa-leaf fa-fw"></i> Culture & Life</a></li>
                                  <li><a href="<?=$url_rewrite?>content/culture/2"><i class="fa fa-bullseye fa-fw"></i> Arts</a></li>
                                   <li><a href="<?=$url_rewrite?>content/culture/3"><i class="fa fa-eye fa-fw"></i> Craft</a></li>
                                   <li><a href="<?=$url_rewrite?>content/culture/4><i class="fa fa-music fa-fw"></i> Music/Instrument</a></li>

                             </ul>
                        </li>
                        <li>
                             <a href="<?=$url_rewrite?>"><i class="fa fa-globe fa-fw"></i> Food<span class="fa arrow"></span></a>
                             
                             <ul class="nav nav-second-level">
                                  <li><a href="<?=$url_rewrite?>content/food/1"><i class="fa fa-lemon-o fa-fw"></i> Regional Dishes</a></li>
                                  <li><a href="<?=$url_rewrite?>content/food/2"><i class="fa fa-caret-down fa-fw"></i> Feast</a></li>
                                   <li><a href="<?=$url_rewrite?>content/food/3"><i class="fa fa-eye fa-fw"></i> Beverages</a></li>
                                   <li><a href="<?=$url_rewrite?>content/food/4"><i class="fa fa-thumb-tack fa-fw"></i> Eating Establishment</a></li>
                                   <li><a href="<?=$url_rewrite?>content/food/5"><i class="fa fa-check fa-fw"></i> Snack</a></li>
                                   <li><a href="<?=$url_rewrite?>content/food/6"><i class="fa fa-thumbs-o-up fa-fw"></i> Fruit</a></li>

                             </ul>
                        </li>
                        <li>
                            <a href="<?=$url_rewrite?>content/album"><i class="fa fa-image  fa-fw"></i> Imaging Indonesia</a>
                        </li>
                        <li>
                            <a href="<?=$url_rewrite?>content/shopping"><i class="fa fa-money  fa-fw"></i> Shopping</a>
                        </li>
                        <?php
                        if($_SESSION['level']==1){
                         ?>    
                        
                        <li>
                            <a href="<?=$url_rewrite?>content/setting"><i class="fa fa-lock  fa-fw"></i> Setting</a>
                        </li>
                        <?php
                        } 
                       
                        ?>
                    </ul>
                    
                    <!-- /#side-menu -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>