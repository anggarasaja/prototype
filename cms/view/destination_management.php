<!DOCTYPE html>
<html>

     <head>

          <?php
          include "view/head.php";
          ?>
          <?php
          $qWhere = array("id" => $id);
          $data = $DATA->readData($qWhere, "destination");
          //Hitung jmlh data
          if ($data != "")
               $jData = count($data);
          else
               $jData = 0;
          if ($jData > 0) {
               $id = $data->id;
               $judul = $data->judul;
               $waktu = $UTILITY->format_tanggal_time($data->waktu);
               $sub_judul = $data->sub_judul;
               $content = $data->content;
               $short_content = $data->short_content;
               $image = $data->image;
               $kategori = explode(",", $data->kategori);
               $kategori_2 = $data->kategori_2;
               $status_display = $data->status_display;
               $longitude = $data->longitude;
               $latitude = $data->latitude;
               $language = $data->language;
               $provinsi= $data->provinsi;
               $kabupaten= $data->kabupaten;
               $kategori_3= explode(",", $data->kategori_3);
               

               $cek_eksist = 1;
          } else {
               $cek_eksist = 0;
               $judul = "";
               $waktu = "";
               $sub_judul = "";
               $content = "";
               $short_content = "";
               $image = "";
               $kategori = "";
               $kategori_2 = "";
               $status_display = "";
               $longitude = "";
               $latitude = "";
               $language = "";
                $provinsi = "";
               $kabupaten = "";
          }
          if ($status_edit == 1) {

               if ($cek_eksist == 0) {

                    $UTILITY->popup_message("Maaf data destination tidak ada");
                    $UTILITY->location_goto("content/destination");
               }
          }
          ?>
          <script>
               $().ready(function() {
                    // validate signup form on keyup and submit
                    $("#dataForm").validate({
                         ignore: [],
                         rules: {
                              judul: {
                                   required: true,
                              },
                              waktu: {
                                   required: true,
                              },
                              image: {
                                   required: true,
                              },
                              content: {
                                   required: function()
                                   {
                                        CKEDITOR.instances.content.updateElement();
                                   },
                              },
                              short_content: {
                                   required: function()
                                   {
                                        CKEDITOR.instances.short_content.updateElement();
                                   },
                              },
                              kategori: "required",
                         },
                         messages: {
                              judul: {
                                   required: "Please enter a title",
                              },
                              waktu: {
                                   required: "Please choose date",
                              },
                              image: {
                                   required: "Please choose file",
                              },
                              content: {
                                   required: "Please fill content",
                              },
                              short_content: {
                                   required: "Please fill short contet",
                              },
                              kategori: {
                                   required: "Please choose kategori",
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
                              <h1 class="page-header">Destination</h1>
                         </div>
                         <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="panel panel-default">
                                   <div class="panel-info">
                                        <ul class="breadcrumb">
                                             <li ><a href="<?= $url_rewrite ?>content/destination">Destination</a></li>
                                             <li class="active" ><?= $title_tab ?></li>
                                        </ul>
                                   </div>
                                   <div class="panel-body">
                                        <div class="row">
                                             <div class="col-lg-12">
                                                  <form enctype="multipart/form-data" id="dataForm"name="berita" method="post" action="<?php echo "$url_rewrite" . "proses/destination"; ?>">
                                                       <div class="form-group">
                                                            <label>Judul</label>
                                                            <?php
                                                           // $UTILITY->show_data($kategori_3);
                                                            if ($id != "")
                                                                 echo("<input class=\"form-control\" id=\"judul\" name=\"judul\" type=\"text\" placeholder=\"Enter Title\" value=\"$judul\" />");
                                                            else
                                                                 echo("<input class=\"form-control\"  id=\"judul\" name=\"judul\" type=\"text\" placeholder=\"Enter Title\" value=\"\" />");
                                                            ?>
                                                       </div>
                                                       <div class="form-group">
                                                            <label>Sub-Judul</label>
                                                            <?php
                                                            if ($id != "")
                                                                 echo("<input class=\"form-control\" id=\"sub_judul\" name=\"sub_judul\" type=\"text\" placeholder=\"Enter Sub Title\" value=\"$sub_judul\" />");
                                                            else
                                                                 echo("<input class=\"form-control\"  id=\"sub_judul\" name=\"sub_judul\" type=\"text\" placeholder=\"Enter Sub Title\" value=\"\" />");
                                                            ?>
                                                       </div>


                                                       <div class="form-group">
                                                            <label>Kategori</label>

                                                            <?php
                                                            $qry = $DB->query("select id_kategori,kategori from kategori_destination");
                                                            while ($row = $DB->fetch_object($qry)) {
                                                                 $id_kategori = $row->id_kategori;
                                                                 $kategori_fix = $row->kategori;
                                                                 
                                                                 if ($id!=''&&in_array($id_kategori, $kategori))
                                                                      echo "<div class=\"checkbox\">"
                                                                      . "<input type=\"checkbox\" name=\"kategori[]\" value=\"$id_kategori\" checked/> "
                                                                      . "<label>&nbsp;$kategori_fix</label></div>";
                                                                 else
                                                                      echo "<div class=\"checkbox\">"
                                                                      . "<input type=\"checkbox\" name=\"kategori[]\" value=\"$id_kategori\" > "
                                                                      . "<label>&nbsp;    $kategori_fix</label></div>";
                                                            }
                                                            ?>

                                                       </div>
                                                       
                                                       <div class="form-group">
                                                            <label>Activity</label>

                                                            <?php
                                                            $qry = $DB->query("select id_kategori,kategori from kategori_activity");
                                                            while ($row = $DB->fetch_object($qry)) {
                                                                 $id_kategori = $row->id_kategori;
                                                                 $kategori_fix = $row->kategori;
                                                        //         echo $id_kategori;
                                                                 if ($id!=''&&in_array($id_kategori, $kategori_3))
                                                                      echo "<div class=\"checkbox\">"
                                                                      . "<input type=\"checkbox\" name=\"kategori_3[]\" value=\"$id_kategori\" checked/> "
                                                                      . "<label>&nbsp;$kategori_fix</label></div>";
                                                                 else
                                                                      echo "<div class=\"checkbox\">"
                                                                      . "<input type=\"checkbox\" name=\"kategori_3[]\" value=\"$id_kategori\" > "
                                                                      . "<label>&nbsp;    $kategori_fix</label></div>";
                                                            }
                                                            ?>

                                                       </div>
                                                       <div class="form-group">
                                                            <label>Region</label>
                                                            <select class="form-control" id="kategori_2" name="kategori_2" onchange="tampilkanProvinsi();">
                                                                 <option value="0" >None</option>
                                                                 <?php
                                                                 $qry = $DB->query("select id_kategori,kategori from kategori_region");
                                                                 while ($row = $DB->fetch_object($qry)) {
                                                                      $id_kategori = $row->id_kategori;
                                                                      $kategori_fix = $row->kategori;
                                                                      if ($id_kategori == $kategori_2)
                                                                           echo "<option value=\"$id_kategori\" selected>$kategori_fix</option>";
                                                                      else
                                                                           echo "<option value=\"$id_kategori\" >$kategori_fix</option>";
                                                                 }
                                                                 ?>
                                                            </select>
                                                       </div>
                                                       
                                                       <div class="panel panel-default">
                                                       <div class="breadcrumb">
                                                            <h4 class="panel-title">
                                                                 <a href="#collapseOne" data-parent="#accordion" data-toggle="collapse" class=""> 
                                                                      <label>#Wilayah (Optional)</label></a>
                                                            </h4>
                                                       </div>
                                                       <div class="panel-collapse collapse in" id="collapseOne" style="height: auto;">
                                                            <div class="panel-body">
                                                                 <div id="provinsi_isi">
                                                                      <?php
                                                                       if ($id != ""){
                                                                      echo("<div class=\"form-group\">
        <label>Provinsi</label>");
                                                                      echo("<select class=\"form-control\" id=\"provinsi\" name=\"provinsi\" onChange=\"tampilkanKabupaten();\"> ");
                                                                      echo("<option value=\"\">None</option>");
                                                                      $query_provinsi = "select * from Data_Provinsi order by id_provinsi";
                                                                      $result_provinsi = $DB->query($query_provinsi)or die(mysql_error());
                                                                      while ($row_provinsi = $DB->fetch_object($result_provinsi)) {
                                                                           $id_provinsi = $row_provinsi->id_provinsi;
                                                                           $nama_provinsi = $row_provinsi->nama_provinsi;
                                                                           if ($id_provinsi == $provinsi)
                                                                                echo("<option value='$id_provinsi' selected>$nama_provinsi</option>");
                                                                           else
                                                                                echo("<option value='$id_provinsi'>$nama_provinsi</option>");
                                                                      }
                                                                      echo("</select>");
                                                                      echo("</div>");
                                                                       }
                                                                      ?>      
                                                                 </div>
                                                                 <div id="kabupaten_isi">
                                                                      <?php
                                                                         if ($id != ""){
                                                                      echo("<div class=\"form-group\">
        <label>Kabupaten</label>
          <select class=\"form-control\" name=\"kabupaten\" id=\"kabupaten\">
             <option value=\"\">None</option>");
                                                                      $query_kabupaten = "select * from Data_Kabupaten
                                where id_provinsi='$provinsi' order by id_kabupaten";
                                                                     
                                                                      $result_kabupaten = $DB->query($query_kabupaten)or die(mysql_error());
                                                                      while ($row_kabupaten = $DB->fetch_object($result_kabupaten)) {
                                                                           $id_kabupaten = $row_kabupaten->id_kabupaten;
                                                                           $nama_kabupaten = $row_kabupaten->nama_kabupaten;
                                                                          if ($id_kabupaten == $kabupaten)
                                                                                
                                                                                echo("<option value='$id_kabupaten' selected>$nama_kabupaten</option>");
                                                                           echo("<option value='$id_kabupaten'>$nama_kabupaten</option>");
                                                                      }


                                                                      echo("</select></div>");
                                                                         }
                                                                      ?>
                                                                 </div>                       </div>
                                                       </div>
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
                                                            if ($id != "")
                                                                 echo("<input class=\"form-control\" id=\"waktu\" name=\"waktu\" type=\"text\" value=\"$waktu\" placeholder=\"Click to open calender\" readonly/>");
                                                            else
                                                                 echo("<input class=\"form-control\" id=\"waktu\" name=\"waktu\" type=\"text\" value=\"$waktu\" placeholder=\"Click to open calender\" readonly/>");
                                                            ?>
                                                       </div>

                                                       <div class="form-group">
                                                            <label>Image Utama</label>
                                                            <?php
                                                            if ($id != "") {
                                                                 if ($image == "") {
                                                                      echo"
			<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"4194304\">
			<input type=\"file\" id=\"image'\" name=\"image\" size=\"75%\" value=\"\">
			<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" />
			";
                                                                 } else {
                                                                      $t = 0;
                                                                      echo"<br/>
			<img src=\"$url_img/img/$image\" style=\"border: 1px solid #000; max-width:500px; max-height:500px;\" border=\"0\" alt=\"Tinjau\"/>
                                        <input type=\"hidden\" value=\"$image\" name=\"filesave_image\"/>
			<input type=\"submit\"  name=\"ganti1\" class=\"btn btn-warning\" value=\"Ganti Foto\">
			";
                                                                 }
                                                            } else {
                                                                 echo"
        <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"4194304\">
        <input type=\"file\" id=\"image'\" name=\"image\" size=\"75%\" value=\"\">
        <input type=\"hidden\" name=\"submitted\" value=\"TRUE\" />
		 ";
                                                            }
                                                            ?>
                                                       </div>



                                                       <div class="form-group">
                                                            <label>Short Content</label>
                                                            <?php
                                                            include_once "library/ckeditor/ckeditor.php";
                                                            $CKEditor = new CKEditor();
                                                            $CKEditor->basePath = "$url_rewrite/library/ckeditor/";
                                                            $CKEditor->config['filebrowserBrowseUrl'] = "$url_rewrite/library/ckeditor/kcfinder/browse.php?type-files";
                                                            $CKEditor->config['filebrowserImageBrowseUrl'] = "$url_rewrite/library/ckeditor/kcfinder/browse.php?type=images";
                                                            $CKEditor->config['filebrowserFlashBrowseUrl'] = "$url_rewrite/library/ckeditor/kcfinder/browse.php?type=flash";
                                                            $CKEditor->config['filebrowserUploadUrl'] = "$url_rewrite/library/ckeditor/kcfinder/upload.php?type=files";
                                                            $CKEditor->config['filebrowserImageUploadUrl'] = "$url_rewrite/library/ckeditor/kcfinder/upload.php?type=images";
                                                            $CKEditor->config['filebrowserFlashUploadUrl'] = "$url_rewrite/library/ckeditor/kcfinder/upload.php?type=flash";
                                                            $CKEditor->editor("short_content", $short_content);
                                                            ?>
                                                       </div>

                                                       <div class="form-group">
                                                            <label>Content</label>
                                                            <?php
                                                            include_once "library/ckeditor/ckeditor.php";
                                                            $CKEditor = new CKEditor();
                                                            $CKEditor->basePath = "$url_rewrite/library/ckeditor/";
                                                            $CKEditor->config['filebrowserBrowseUrl'] = "$url_rewrite/library/ckeditor/kcfinder/browse.php?type-files";
                                                            $CKEditor->config['filebrowserImageBrowseUrl'] = "$url_rewrite/library/ckeditor/kcfinder/browse.php?type=images";
                                                            $CKEditor->config['filebrowserFlashBrowseUrl'] = "$url_rewrite/library/ckeditor/kcfinder/browse.php?type=flash";
                                                            $CKEditor->config['filebrowserUploadUrl'] = "$url_rewrite/library/ckeditor/kcfinder/upload.php?type=files";
                                                            $CKEditor->config['filebrowserImageUploadUrl'] = "$url_rewrite/library/ckeditor/kcfinder/upload.php?type=images";
                                                            $CKEditor->config['filebrowserFlashUploadUrl'] = "$url_rewrite/library/ckeditor/kcfinder/upload.php?type=flash";
                                                            $CKEditor->editor("content", $content);
                                                            ?>
                                                       </div>

                                                       <?php
                                                       if ($id != "")
                                                            echo"<input type=\"hidden\"  name=\"kondisi\" value=\"edit\">";
                                                       else
                                                            echo"<input type=\"hidden\"  name=\"kondisi\" value=\"tambah\">";

                                                       echo"<input type=\"hidden\"  name=\"id\" value=\"$id\">";
                                                       ?>
                                                       <button type="submit" class="btn btn-success">Submit</button>
                                                       <button type="button" class="btn btn-info" onClick=javascript:window.location.href = "../" >Back</button>                 


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
