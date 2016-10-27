<!DOCTYPE html>
<html>
<head>
   <?php include "view/head.php";?>
   <style type="text/css">
   	#dataTablesAtlet_paginate{
			width:600px;   	
   	}
   </style>
</head>
<body>
	<div id="wrapper">
   <?php include "view/default/right_menu.php";?>
   	<div id="page-wrapper" style="min-height:850px;">
	  		<div class="row">
   	   	<div class="col-lg-12"  style="margin-bottom:-20px;">
             	<label class="page-header title-page" style="background-color:#AAFFAA">Import File</label>
         	</div>
      	</div>
      	<div class="row">
      		<div class="col-lg-12">
         		<div class="panel ">
            		<div class="panel-body">
            			<div id="alert-input"></div>
                  	<div id="manage_admin" class="input-box2">
                  <form id="add_admin" style="margin-bottom:-5px;" action="<?php echo $url_rewrite.'core/import/import_excel.php'; ?>" method="POST" enctype="multipart/form-data">
						<div class="row">
						<div class="col-md-6">                  
                  <table width="100%">
						<tr>
							<td style="padding:10px 0px 10px 35px;">File Import</td><td style="padding:10px 22px 10px 6px;">:</td>
							<td>
                <div style="position:relative;">
        <a class='btn btn-primary' href='javascript:;'>
            Cari File Excel
            <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="fileimport" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
        </a>
        &nbsp;
        <span class='label label-info' id="upload-file-info"></span>
</div>       
              </td>
						</tr>
 				</table>
				</div>
				<div class="col-md-6">
				<table width="100%">
						<tr>
							<td style="padding:10px 43px 10px 35px;">Jenis Data</td><td style="padding:10px 23px 10px 6px;">:</td>
							<td>
							<select id="level" name="jenis" style="width:230px; height:34px;" class="form-control" required="">
								 <option value="" selected disabled="">--Pilih Jenis Data--</option>
								 <!-- <option value="tbl_atlet">Atlet</option>
                 <option value="tbl_pelatih">Pelatih</option>
                 <option value="tbl_pemuda">Kepemudaan</option>
                 <option value="tbl_knpi">KNPI</option>
                 <option value="tbl_medali">Medali</option>
                 <option value="tbl_sarpras">Sarana dan Prasarana</option> -->
								 <option value="tbl_pelopor">Pelopor Pemuda</option>
							</select>
							</td>						
						</tr>
					<tr>
						<td style="padding:10px 30px;" colspan="3" class="text-right">
              <input type="reset" value="Reset" class="btn btn-warning">
              <input type="submit" value="Submit" class="btn btn-primary">
            </td>
					</tr>
 				</table>				
				</div>
 				</div>
 			</form>
                  	</div>
                  	               	
							<div id="alert-hapus"></div>
                  	<div class="row" id="datatable" style="margin: 0; padding:10px; background-color:#AAFFAA; border-radius: 0 0 10px 10px" >
   
                  	

 						</div>
               	</div>
        			</div>
        		</div>
      	</div>
   	</div>
	</div>
	<div id="modal-hapus" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-sm modal-vertical-centered" >
   		<div class="modal-content">
      		<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			<h4 class="modal-title">Peringatan</h4>
      		</div>
      		<div class="modal-body">
        			<p>Anda ingin menghapus Admin ini?</p>
      		</div>
      		<div class="modal-footer">
        			<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        			<button type="button" class="btn btn-danger" id="hapus-data">Hapus !</button>
      		</div>
    		</div>
  		</div>
	</div>
</body>
<?php include "view/foot.php";?>
</html>
