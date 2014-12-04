<!DOCTYPE html>
<html>

<head>

     <?php
   include "view/head.php";
   ?>
<?php
             
               $qWhere = array("user_id" => $user_id);
               $data = $PENGGUNA->readPengguna($qWhere);
               //Hitung jmlh data
               if($data!="")
                    $jData = count($data);
               else
                    $jData=0;
               if ($jData > 0) {
                    $username = $data->username;
                    $password = $data->password;
                    $level = $data->level;
                    $provinsi = $data->provinsi;
                    $kabupaten = $data->kabupaten;
                    $cek_eksist=1;
               } else {
                    $cek_eksist=0;
                    $username = "";
                    $password = "";
                    $level = "";
                    $provinsi = "";
                    $kabupaten = "";
               }
               if($status_edit==1){
    
                       if($cek_eksist==0){
                          
                            $UTILITY->popup_message("Maaf data user tidak ada2");
                            $UTILITY->location_goto("content/setting");
                        }
               }
               ?>
               <script>
               $().ready(function() {
	// validate signup form on keyup and submit
	$("#penggunaForm").validate({
		rules: {
			username: {
				required: true,
				minlength: 2
			},
			password: {
				required: true,
				minlength: 5
			},
         
			conf_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},
			level: "required"
		},
		messages: {
			username: {
				required: "Please enter a username",
				minlength: "Your username must consist of at least 2 characters"
			},
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
            		conf_password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			},
                                   level: {
				required: "Please choose level user"
			}
			
			
		}
	});
               });
          </script>
               <style type="text/css">
#penggunaForm label.error {
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
                    <h1 class="page-header">Setting</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-info">
                             <ul class="breadcrumb">
                                  <li ><a href="<?=$url_rewrite?>content/setting">Setting</a></li>
                                  <li class="active" ><?=$title_tab?></li>
                             </ul>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                      <form enctype="multipart/form-data" id="penggunaForm"name="berita" method="post" action="<?php echo "$url_rewrite"."proses/pengguna";?>">
                                       <div class="form-group">
                                            <label>Username</label>
                                             <?php
                                                                           if ($user_id != "")
                                                                                echo("<input class=\"form-control\" id=\"username\" name=\"username\" type=\"text\" placeholder=\"Enter username\" value=\"$username\" />");
                                                                           else
                                                                                echo("<input class=\"form-control\"  id=\"username\" name=\"username\" type=\"text\" placeholder=\"Enter username\" value=\"\" />");
                                                                           ?>
                                        </div>
                                           
                                          <div class="form-group">
                                            <label>Password</label>
                                             <?php
                                                                           if ($user_id != "")
                                                                                echo("<input class=\"form-control\" id=\"password\" name=\"password\"  placeholder=\"Enter password\" type=\"password\" value=\"\" />");
                                                                           else
                                                                                echo("<input  class=\"form-control\" id=\"password\" name=\"password\" placeholder=\"Enter password\" type=\"password\" value=\"\" />");
                                                                           ?>
                                        </div> 
                                           
                                           <div class="form-group">
                                            <label>Confirmation Password</label>
                                             <?php
                                                                           if ($user_id != "")
                                                                                echo("<input class=\"form-control\" id=\"conf_password\" name=\"conf_password\"  placeholder=\"Enter Confirmation password\" type=\"password\"  size=\"60%\" value=\"\" />");
                                                                           else
                                                                                echo("<input  class=\"form-control\" id=\"conf_password\" name=\"conf_password\" placeholder=\"Enter Confirmation password\" type=\"password\"  size=\"60%\" value=\"\" />");
                                                                           ?>
                                        </div> 
                                      <div class="form-group">
                                            <label>Level User</label>
                                            <select class="form-control" id="level" name="level" >
                                                                                <option value="" >None</option>
                                                                                <?php
                                                                                $qry = $DB->query("select id_level,nama_level from level");
                                                                                while ($row = $DB->fetch_object($qry)) {
                                                                                     $id_level = $row->id_level;
                                                                                     $nama_level = $row->nama_level;
                                                                                     if ($id_level == $level)
                                                                                          echo "<option value=\"$id_level\" selected>$nama_level</option>";
                                                                                     else
                                                                                          echo "<option value=\"$id_level\" >$nama_level</option>";
                                                                                }
                                                                                ?>
                                                                           </select>
                                      </div>
                                      <?php
if ($user_id != "")
     echo"<input type=\"hidden\"  name=\"kondisi\" value=\"edit\">";
else
     echo"<input type=\"hidden\"  name=\"kondisi\" value=\"tambah\">";

echo"<input type=\"hidden\"  name=\"user_id\" value=\"$user_id\">";
?>
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        <button type="button" class="btn btn-info" onClick=javascript:window.location.href="daftar_pengguna.php" >Back</button>                 
                                  
                                
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
