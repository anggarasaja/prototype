<!DOCTYPE html>
<html>

     <head>

          <?php
          include "view/head.php";
          ?>
          <?php
          $qWhere = array("id_foto" => $id_foto);
          $data = $FOTO->readFOTO($qWhere);
          //Hitung jmlh data
          if ($data != "")
               $jData = count($data);
          else
               $jData = 0;
          if ($jData > 0) {
               $id_foto = $data->id_foto;
               $nama_file= $data->nama_file;
               $ket = $data->ket;
               $waktu= $UTILITY->format_tanggal_time($data->waktu);
               $id_album= $data->album;
             
               $cek_eksist = 1;
          } else {
               $cek_eksist = 0;
               $id_foto = "";
               $nama_file="";
               $ket ="";
               $waktu="";
         
          }

          if ($status_edit == 1) {

               if ($cek_eksist == 0) {

                    $UTILITY->popup_message("Maaf data foto tidak ada");
                    $UTILITY->location_goto("content/foto/$id_album");
               }
          }
          ?>
          <script>
               $().ready(function() {
                    // validate signup form on keyup and submit
                    $("#dataForm").validate({
                          ignore: [],
                         rules: {
                              ket: {
                                   required: true,
                                   
                              },
                               waktu: {
                                   required: true,
                                   
                              },     
                             nama_file: {
                                   required: true,
                              }
                             
                         },
                         messages: {
                              ket: {
                                   required: "Please enter information",
                              },
                              waktu: {
                                   required: "Please choose date",
                              },
                              nama_file: {
                                   required: "Please choose file",
                              },
                              


                         }
                    });
               });
          </script>
          <style type="text/css">
               #dataForm label.error {
                    margin-left: 10px;
                    width: auto;
                    display: inline;
                    color: red;
               }
          </style>
     </head>

     <body>

          <div id="wrapper">

<?php
include "view/default/right_menu.php";

$cek_eksist=0;
          $qry = $DB->query("select nama_album,id_album from album where id_album='$id_album' " );
          while ($row = $DB->fetch_object($qry)) {
               $nama_album=$row->nama_album;
               $id_album=$row->id_album;
               $cek_eksist=1;
          }
            if($cek_eksist==0){
                          
                            $UTILITY->popup_message("Maaf data foto tidak memiliki album");
                          $UTILITY->location_goto("content/album");
                        }
?>
               
               
               <div id="page-wrapper">
                    <div class="row">
                         <div class="col-lg-12">
                              <h1 class="page-header">Foto (Album <?=$nama_album?>) </h1>
                         </div>
                         <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="panel panel-default">
                                   <div class="panel-info">
                                        <ul class="breadcrumb">
                                             <li ><a href="<?= $url_rewrite ?>content/foto/<?=$id_album?>">Foto</a></li>
                                             <li class="active" ><?= $title_tab ?></li>
                                        </ul>
                                   </div>
                                   <div class="panel-body">
                                        <div class="row">
                                             <div class="col-lg-12">
                                                  <form enctype="multipart/form-data" id="dataForm"name="berita" method="post" action="<?php echo "$url_rewrite"."proses/foto"; ?>">
                                                                                                            
                                                         
                                                       <div class="form-group">
                                                            <label>Waktu</label>

                                                            <script>
                                                                 $(function() {
                                                                      $("#waktu").datetimepicker({
                                                                           format: 'd M y H:i:s ',
                                                                           
                                formatTime:'H:i',
	formatDate:'d.m.Y',
		defaultTime:'10:00'
                                                                      });
                                                                 });
                                                            </script>   

<?php
if ($id_foto!= "")
     echo("<input class=\"form-control\" id=\"waktu\" name=\"waktu\" type=\"text\" value=\"$waktu\" placeholder=\"Click to open calender\" readonly/>");
else
     echo("<input class=\"form-control\" id=\"waktu\" name=\"waktu\" type=\"text\" value=\"$waktu\" placeholder=\"Click to open calender\" readonly/>");
?>
                                                       </div>
                                                       
                                                       <div class="form-group">
                                                            <label>Foto</label>
                                                            <?php
if($id_foto!="")
{
   if($nama_file=="")
   {
		echo"
			<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"4194304\">
			<input type=\"file\" id=\"nama_file'\" name=\"nama_file\" size=\"75%\" value=\"\">
			<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" />
			";
		
   }
   else{
		$t=0;
		echo"<br/>
			<img src=\"$url_img/album/$id_album/$nama_file\" style=\"border: 1px solid #000; max-width:500px; max-height:500px;\" border=\"0\" alt=\"Tinjau\"/>
                                        <input type=\"hidden\" value=\"$nama_file\" name=\"filesave_image\"/>
			<input type=\"submit\"  name=\"ganti1\" class=\"btn btn-warning\" value=\"Ganti Foto\">
			";
		}
}
else
{
    echo"
        <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"4194304\">
        <input type=\"file\" id=\"nama_file'\" name=\"nama_file\" size=\"75%\" value=\"\">
        <input type=\"hidden\" name=\"submitted\" value=\"TRUE\" />
		 ";
    
}
?>
                                                       </div>
                                                       
                                                       <div class="form-group">
                                                            <label>Keterangan</label>
<?php
if ($id_foto!= "")
     echo("<textarea class=\"form-control\" id=\"ket\" name=\"ket\" type=\"text\" placeholder=\"Enter Information\" value=\"$ket\" />$ket</textarea>");
else
     echo("<textarea  class=\"form-control\"  id=\"ket\" name=\"ket\" type=\"text\" placeholder=\"Enter Information\" value=\"\" /></textarea>");
?>
                                                       </div>
                                                       


<?php
if ($id_foto!= "")
     echo"<input type=\"hidden\"  name=\"kondisi\" value=\"edit\">";
else
     echo"<input type=\"hidden\"  name=\"kondisi\" value=\"tambah\">";
echo"<input type=\"hidden\"  name=\"album\" value=\"$id_album\">";
echo"<input type=\"hidden\"  name=\"id_foto\" value=\"$id_foto\">";
?>
                                                       <button type="submit" class="btn btn-success">Submit</button>
                                                       <button type="button" class="btn btn-info" onClick=javascript:window.location.href="../" >Back</button>                 


                                                  </form>



                                             </div>

                                             <!-- /.col-lg-12 (nested) -->
                                        </div>
                                        <!-- /.row (nested) -->
                                   </div>
                                   <!-- /.panel-body -->
                              </div>
                              <!-- /.panel -->
                         </div>
                         <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
               </div>
               <!-- /#page-wrapper -->

          </div>
          <!-- /#wrapper -->


     </body>

</html>
