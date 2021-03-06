<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
ob_clean();

//error_reporting("E_ALL");
require_once __DIR__ .'/config.php';
require_once __DIR__ .'/../utility/database/mysql_db.php';
require_once __DIR__ .'/../utility/utilityCode.php';

//Untuk Model 
require_once __DIR__ . '/../model/modelPengguna.php';
require_once __DIR__ . '/../model/modelData.php';
require_once __DIR__ . '/../model/modelAlbum.php';
require_once __DIR__ . '/../model/modelFoto.php';
require_once __DIR__ . '/../model/modelDestination.php';
require_once __DIR__ . '/../model/modelAtlet.php';
require_once __DIR__ . '/../model/modelPelatih.php';
require_once __DIR__ . '/../model/modelPemuda.php';
require_once __DIR__ . '/../model/modelKNPI.php';
require_once __DIR__ . '/../model/modelAdmin.php';
require_once __DIR__ . '/../model/modelMedali.php';
require_once __DIR__ . '/../model/modelSarpras.php';
require_once __DIR__ . '/../model/modelPelopor.php';
require_once __DIR__ . '/../model/modelPpikor.php';

//Akhir Model

require_once __DIR__ ."/../library/security/HTMLPurifier.auto.php";
$config_security = HTMLPurifier_Config::createDefault();
$config_security->set('URI.HostBlacklist', array('google.com'));
$purifier = new HTMLPurifier($config_security);


$CONFIG= new config();
$DB=new mysql_db();
$UTILITY=new utilityCode();


$PENGGUNA=new modelPengguna();
$DATA=new modelData();
$ALBUM=new modelAlbum();
$FOTO=new modelFoto();
$DESTINATION=new modelDestination();
$ATLET= new modelAtlet();
$PELATIH = new modelPelatih();
$PEMUDA = new modelPemuda();
$KNPI = new modelKNPI();
$ADMIN = new modelAdmin();
$MEDALI = new modelMedali();
$SARPRAS = new modelSarpras();
$PELOPOR = new modelPelopor();
$PPIKOR = new modelPpikor();
//$data= $_SESSION['cookies']; 
//setcookie($cookie_name, $data, time() + $cookie_time);

 //$UTILITY->show_data($_COOKIE);
 //  $UTILITY->show_data($_SESSION);

$cek=$_SERVER['SCRIPT_NAME'];
$temp=explode("/", $cek);
$file=  end($temp);
 //if($status_index!="1"){
     if ($_SESSION["user_name"]=="") {
          if( isset($_COOKIE[$cookie_name])){ 
             //  echo "loginnn 11";
             include 'autologin.php';
          }else{
               if($file!="index.php"){
                    $UTILITY->popup_message("Maaf anda harus login terlebih dahulu");
                     session_destroy();
                     $UTILITY->location_goto("#");
               }
          }
   }

//}
?>
