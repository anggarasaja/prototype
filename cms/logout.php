<?php 
include 'config/config.php';
	session_destroy();
        setcookie ($cookie_name, '', time() - $cookie_time);
        $status=setcookie($cookie_name, '', time() - $cookie_time,"/","$domain");
        echo("<script language=\"javascript\">window.location.href=\"$url_rewrite\";</script>");
          
?>