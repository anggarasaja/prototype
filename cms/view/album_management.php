<!DOCTYPE html>
<html>

     <head>

          <?php
          include "view/head.php";
          ?>
          <?php
          $qWhere = array("id_album" => $id_album);
          $data = $ALBUM->readAlbum($qWhere);
          //Hitung jmlh data
          if ($data != "")
               $jData = count($data);
          else
               $jData = 0;
          if ($jData > 0) {
               $id_album = $data->id_album;
               $nama_album = $data->nama_album;
              $waktu= $UTILITY->format_tanggal_time($data->waktu);
               $ket= $data->ket;
         
               $cek_eksist = 1;
          } else {
               $cek_eksist = 0;
               $id_album = "";
               $nama_album = "";
              $waktu= "";
               $ket= "";
          }
          if ($status_edit == 1) {

               if ($cek_eksist == 0) {

                    $UTILITY->popup_message("Maaf data album tidak ada");
                    $UTILITY->location_goto("content/album");
               }
          }
          ?>
          <script>
               $().ready(function() {
                    // validate signup form on keyup and submit
                    $("#dataForm").validate({
                          ignore: [],
                         rules: {
                              nama_album: {
                                   required: true,
                                   
                              },

                             waktu: {
                                   required: true,
                              },
                              ket: {
                                   required: true,
                              }
                              
                         },
                         messages: {
                              nama_album: {
                                   required: "Please enter a album title",
                              },
                              waktu: {
                                   required: "Please choose date",
                              },
                              ket: {
                                   required: "Please enter information ",
                              }


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
?>
               <div id="page-wrapper">
                    <div class="row">
                         <div class="col-lg-12">
                              <h1 class="page-header">About</h1>
                         </div>
                         <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="panel panel-default">
                                   <div class="panel-info">
                                        <ul class="breadcrumb">
                                             <li ><a href="<?= $url_rewrite ?>content/album">Album</a></li>
                                             <li class="active" ><?= $title_tab ?></li>
                                        </ul>
                                   </div>
                                   <div class="panel-body">
                                        <div class="row">
                                             <div class="col-lg-12">
                                                  <form enctype="multipart/form-data" id="dataForm"name="berita" method="post" action="<?php echo "$url_rewrite"."proses/album"; ?>">
                                                       <div class="form-group">
                                                            <label>Nama Album</label>
<?php
if ($id_album!= "")
     echo("<input class=\"form-control\" id=\"nama_album\" name=\"nama_album\" type=\"text\" placeholder=\"Enter Nama Album\" value=\"$nama_album\" />");
else
     echo("<input class=\"form-control\"  id=\"nama_album\" name=\"nama_album\" type=\"text\" placeholder=\"Enter Nama Album\" value=\"\" />");
?>
                                                       </div>
                                                       <div class="form-group">
                                                            <label>Keterangan</label>
<?php
if ($id_album!= "")
     echo("<textarea class=\"form-control\" id=\"ket\" name=\"ket\" type=\"text\" placeholder=\"Enter Information\" value=\"$ket\" />$ket</textarea>");
else
     echo("<textarea  class=\"form-control\"  id=\"ket\" name=\"ket\" type=\"text\" placeholder=\"Enter Information\" value=\"\" /></textarea>");
?>
                                                       </div>
                                                  
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
if ($id_album!= "")
     echo("<input class=\"form-control\" id=\"waktu\" name=\"waktu\" type=\"text\" value=\"$waktu\" placeholder=\"Click to open calender\" readonly/>");
else
     echo("<input class=\"form-control\" id=\"waktu\" name=\"waktu\" type=\"text\" value=\"$waktu\" placeholder=\"Click to open calender\" readonly/>");
?>
                                                       </div>
                                                       
                                                       

<?php
if ($id_album!= "")
     echo"<input type=\"hidden\"  name=\"kondisi\" value=\"edit\">";
else
     echo"<input type=\"hidden\"  name=\"kondisi\" value=\"tambah\">";

echo"<input type=\"hidden\"  name=\"id_album\" value=\"$id_album\">";
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
