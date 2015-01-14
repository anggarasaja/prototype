<!DOCTYPE html>
<html>
<head>
   <?php include "view/head.php";?>
   <style type="text/css">
   	#dataTablesAtlet_paginate{
			width:600px;   	
   	}
   </style>
	<script type="text/javascript">
   var table;
   function pageLoad(){

    	$('#datatable').html( '<table cellpadding="10" cellspacing="5" border="0" class="table table-striped table-hover" width="100%" id="dataTablesAtlet"></table>' );
 		$.ajax({url: '<?php echo $url_rewrite.'core/manage_admin/read_admin.php'; ?>',
      	type: 'POST',
      	success: function(output) {
         	var op=JSON.parse(output);
         	table = $('#dataTablesAtlet').DataTable( {
         		"order": [[ 1, "asc" ]],
          		"language": {
            		"lengthMenu": "Tampilkan _MENU_ data per halaman",
            		"zeroRecords": "Tidak ada data yang ditampilkan",
            		"info": "Halaman _PAGE_ dari _PAGES_",
            		"infoEmpty": "Data tidak tersedia",
            		"search":         "Cari :",
            		"paginate": {
        					"first":      "Awal",
        					"last":       "Akhir",
        					"next":       "selanjutnya",
        					"previous":   "sebelumnya"
    					},
            		"infoFiltered": "(filtered from _MAX_ total records)"
        			},
        			"columns": [
						{ "title": "User ID" },
            		{ "title": "Username" },
            		{ "title": "Level" },
            		{ "title": "Keterangan" },
               	{	
               		"title":"Edit",
               		"orderable":      false,
                		"data":           null,
                		"defaultContent": '<div class="details-control"></div.'
            		}
        			],	
        			"data" : op,
				});
		   },
         error: function (xhr, ajaxOptions, thrownError) {
         	alert(xhr.status + " "+ thrownError);
         }
      });   	     
		
		$(document).on('click', '.details-control', function () {

		  var row;
        var user_id_row;
        var username_row ;
        var level_row;
        var keterangan_row;
        var password_row;
			
        var tr = $(this).closest('tr');
        var row = table.row(tr);
 
			user_id_row = row.data()[0];
        	username_row = row.data()[1];
        	level_row = row.data()[2];
        	keterangan_row = row.data()[3];
        	password_row = row.data()[4];
        	
        if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown warning');
         }
        	else {
            row.child( format(row.data()) ).show();
            tr.addClass('shown warning');
				
            var value2 = $("#level-update-"+user_id_row +"").val(level_row);   
  				
			$('#update_admin-'+user_id_row +'').submit(function(event) {
					      	event.preventDefault();
      	$('#alert-update').empty();
					      	var $form = $( this );
          var url = $form.attr( 'action' );

					var posting = $.post(url, {
										user_id:user_id_row,										
										username: $('#username-update-'+user_id_row +'').val(), 
										level: $('.level-update-'+user_id_row +'').val(), 
										keterangan: $('#keterangan-'+user_id_row +'').val(), 
										password: $('#password-'+user_id_row +'').val(), 
										} );
      		posting.done(function( data ) {
        		$('#alert-update-'+user_id_row+'').fadeTo(2000, 500).slideUp(500).html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>Data berhasil diubah.</div>');
				$('#dataTablesAtlet').dataTable().fnUpdate( 
								[
									user_id_row,
									$('#username-update-'+user_id_row +'').val(),
									$('#level-update-'+user_id_row+' option:selected').val(),
									$('#keterangan-update-'+user_id_row +'').val() 
								], tr[0] );
        		});
				});        
				
				$('#hapus-'+ user_id_row +'').click(function() {
        			$('#modal-hapus').modal('show');
        			$('#hapus-data').click(function() {
  				   $.ajax({url: '<?php echo $url_rewrite.'core/manage_admin/delete_admin.php'; ?>',
      				type: 'POST',
      				data: {user_id:user_id_row},
      				success: function(output) {
      			  		$.ajax({url: '<?php echo $url_rewrite.'core/manage_admin/read_admin.php'; ?>',
  								type: 'POST',
      						success: function(output) {
      							var op=JSON.parse(output);
                				table.clear().draw();
                                if (op!=null) {
                        table.rows.add(op).draw();
               		 }
								},
    							error: function (xhr, ajaxOptions, thrownError) {
     								alert(xhr.status + " "+ thrownError);
   							}
   						});
							$('#alert-hapus').fadeTo(2000, 500).slideUp(500).html('<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert">&times;</a>Data berhasil dihapus.</div>');
							$('#modal-hapus').modal('hide');
     			      },
     				  	error: function (xhr, ajaxOptions, thrownError) {
    			   		alert(xhr.status + " "+ thrownError);
    					}
    				});      
    				});			
    			});
       	}
    	}); 
	}
   </script>
</head>
<body onload="pageLoad()">
	<div id="wrapper">
   <?php include "view/default/right_menu.php";?>
   	<div id="page-wrapper" style="min-height:850px;">
	  		<div class="row">
   	   	<div class="col-lg-12"  style="margin-bottom:-20px;">
             	<label class="page-header title-page" style="background-color:#FFDADA">Manage Admin</label>
         	</div>
      	</div>
      	<div class="row">
      		<div class="col-lg-12">
         		<div class="panel ">
            		<div class="panel-body">
            			<div id="alert-input"></div>
                  	<div id="manage_admin" class="input-box">
                  <form id="add_admin" style="margin-bottom:-5px;" action="<?php echo $url_rewrite.'core/manage_admin/admin_controller.php'; ?>" method="POST">
						<div class="row">
						<div class="col-md-6">                  
                  <table width="100%">
						<tr>
							<td style="padding:10px 0px 10px 35px;">Username</td><td style="padding:10px 22px 10px 6px;">:</td>
							<td><input tabindex="1" required="required" style="width:230px; height:34px;" type="text" name="username" id="username" class="form-control"></td>
						</tr>
						<tr>
							<td style="padding:10px 0px 10px 35px;">Password</td><td style="padding:10px 22px 10px 6px;">:</td>
							<td><input tabindex="1" required="required" style="width:230px; height:34px;" type="password" name="password" id="password" class="form-control"></td>
						</tr>
						<tr>
							<td style="padding:10px 0px 10px 35px;">Re-type Password</td><td style="padding:10px 22px 10px 6px;">:</td>
							<td><input tabindex="1" required="required" style="width:230px; height:34px;" type="password" name="cekpassword" id="cekpassword" class="form-control"></td>
						</tr>
 				</table>
				</div>
				<div class="col-md-6">
				<table width="100%">
						<tr>
							<td style="padding:10px 43px 10px 35px;">Level Admin</td><td style="padding:10px 23px 10px 6px;">:</td>
							<td>
							<select id="level" name="level" style="width:230px; height:34px;" class="form-control">
								 <option value="0" selected>--Pilih Level Admin--</option>
								 <option value="1">Level 1 : Super Admin</option>
								 <option value="2">Level 2 : Admin</option>
							</select>
							</td>						
						</tr>
						<tr>
							<td style="padding:10px 43px 10px 35px;">Keterangan</td><td style="padding:10px 23px 10px 6px;">:</td>
							<td><input tabindex="1" style="width:230px; height:34px;" type="text" name="keterangan" id="keterangan" class="form-control"></td>
						</tr>
					<tr>
						<td style="padding:10px 20px;" colspan="3" class="text-center"><input type="reset" value="Reset" style="width:110px; height:34px;margin-left: 190px;margin-right:10px" class="btn btn-warning"><input type="submit" value="Submit" style="width:110px; height:34px;" class="btn btn-primary"></td>
					</tr>
 				</table>				
				</div>
 				</div>
 			</form>
                  	</div>
                  	<div class="informasibox" style="margin-top:10px;height:24px;border-radius:10px 10px 0px 0px;width:100%; padding-top:2px;background-color:#DAFADA; text-align:center;">
                     	<label>List Admin</label>                               
                  	</div>
                  	               	
							<div id="alert-hapus"></div>
                  	<div class="row" id="datatable" style="margin: 0; padding:10px; background-color:#FFDADA; border-radius: 0 0 10px 10px" >
   
                  	

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
	<script>
		$("#add_admin").submit(function(event) {
	  		event.preventDefault();
      	$('#alert-input').empty();
			var $form = $( this );
          var url = $form.attr( 'action' );
          if ($('#username').val()=="" || $('#level').val()==0 || $('#password').val()=="" || $('#cekpassword').val()=="" ) {
          	if($('#username').val()==""){
          		$('#alert-input').append('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Silakan isi username.</div>');
				}
				if($('#level').val()==0){
          		$('#alert-input').append('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Silakan pilih level admin.</div>');
				}
				if($('#password').val()==""){
          		$('#alert-input').append('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Silakan isi password.</div>');
				}
				if($('#cekpassword').val()==""){
          		$('#alert-input').append('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Silakan isi ketik ulang password.</div>');
				}
			 }
			 else {
				var posting = $.post( url, { username: $('#username').val(), level: $('#level').val(), password: $('#password').val(), keterangan: $('#keterangan').val()} );
				posting.done(function( data ) {
        		
        	$.ajax({url: '<?php echo $url_rewrite.'core/manage_admin/read_admin.php'; ?>',
  			type: 'POST',
      	success: function(output) {
      	var op=JSON.parse(output);
            table.clear().draw();
                                if (op!=null) {
                        table.rows.add(op).draw();
                }
         	$('#alert-input').fadeTo(2000, 500).slideUp(500).html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>Data berhasil ditambah.</div>');
				
         	
			},
    		error: function (xhr, ajaxOptions, thrownError) {
     			alert(xhr.status + " "+ thrownError);
   		}});
   		
   		$('#user_id').val('');
   		$('#username').val('');
   		$('#level').val(0);
   		$('#password').val('');
   		$('#cekpassword').val('');
   		$('#keterangan').val('');
    			});
    		}
    });

    function format ( d ) {
    var tableString = '<form id="update_admin-'+d[0] +'" action="<?php echo $url_rewrite.'core/manage_admin/update_admin.php'; ?>" method="POST">'+
		'<div class="row" style="background-color:white; margin:-8px -8px -24px -8px;">'+		
		'<div class="col-md-6">'+                  
      	'<table width="100%">'+
				'<tr>'+
					'<td style="padding:10px 0px 10px 35px;">Username</td><td style="padding:10px 22px 10px 6px;">:</td>'+
					'<td><input tabindex="1" required="required" style="width:230px; height:34px;" type="text" name="username-update-'+d[0]+'" id="username-update-'+d[0]+'" class="form-control" value="'+d[1]+'"></td>'+
				'</tr>'+
				'<tr>'+
					'<td style="padding:10px 0px 10px 35px;">Password</td><td style="padding:10px 22px 10px 6px;">:</td>'+
					'<td><input tabindex="1" required="required" style="width:230px; height:34px;" type="password" name="password-update-'+d[0]+'" id="password-update-'+d[0]+'" class="form-control" value="'+d[4]+'"></td>'+
				'</tr>'+
				'<tr>'+
					'<td style="padding:10px 0px 10px 35px;">Re-type Password</td><td style="padding:10px 22px 10px 6px;">:</td>'+
					'<td><input tabindex="1" required="required" style="width:230px; height:34px;" type="password" name="cekpassword-update-'+d[0]+'" id="cekpassword-update-'+d[0]+'" class="form-control" value="'+d[4]+'"></td>'+
				'</tr>'+
			'</table>'+
		'</div>'+		
		'<div class="col-md-6">'+
		'<table width="100%">'+
			'<tr>'+
				'<td style="padding:10px 43px 10px 35px;">Level Admin</td><td style="padding:10px 23px 10px 6px;">:</td>'+
				'<td>'+
					'<select id="level-update-'+d[0]+'" name="level-update-'+d[0]+'" style="width:230px; height:34px;" class="form-control">'+
						'<option value="0">--Pilih Level Admin--</option>'+
						'<option value="1">Level 1 : Super Admin</option>'+
						'<option value="2">Level 2 : Admin</option>'+
					'</select>'+
				'</td>'+						
			'</tr>'+
			'<tr>'+
				'<td style="padding:10px 43px 10px 35px;">Keterangan</td><td style="padding:10px 23px 10px 6px;">:</td>'+
				'<td><input tabindex="1" style="width:230px; height:34px;" type="text" name="keterangan-update-'+d[0]+'" id="keterangan-update-'+d[0]+'" class="form-control" value="'+d[3]+'"></td>'+
			'</tr>'+
			'<tr>'+
				'<td style="padding:10px;" colspan="3" class="text-center"><input type="submit" value="Update" style="width:110px; height:34px;margin-left: 30px;margin-right:50px" class="btn btn-primary"><input id="hapus-'+ d[0] +'" value="Hapus" style="width:110px; height:34px;" class="btn btn-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span></td>'+
			'</tr>'+
 		'</table>'+				
		'</div>'+    
		'</div>'+    
    '</form>';
    return tableString
		}
	</script>
</body>
<?php include "view/foot.php";?>
</html>
