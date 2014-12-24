<!DOCTYPE html>
<html>
<head>
   <?php include "view/head.php";?>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&language=in"></script>
	<script type="text/javascript" language="javascript" class="init">

	/*$(document).ready(function() {
		$('#dataTablesAtlet').dataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": "<?php echo $url_rewrite.'core/input_atlet/server_processing.php'; ?>"
		});
	});*/

	</script>
   <script type="text/javascript">
   var map;
   var caborOutput;
   function pageLoad(){
   	
		var table;
    	$('#datatable').html( '<table cellpadding="10" cellspacing="5" border="0" class="table table-striped table-hover" width="100%" id="dataTablesAtlet"></table>' );
 		$.ajax({url: '<?php echo $url_rewrite.'core/input_atlet/read_all_atlet.php'; ?>',
      			type: 'POST',
      			data: {id_propinsi:0},
             success: function(output) {
             	var op=JSON.parse(output);
                //alert(output);
                
               // $('#dataTablesAtlet').html(output);
                
                
          		//$('#dataTablesAtlet').DataTable();
          	table = $('#dataTablesAtlet').DataTable( {
          		"order": [[ 0, "desc" ]],
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
				{ "title": "ID" },
            { "title": "Nama Atlet" },
            { "title": "Cabang<br>Olahraga" },
            { "title": "Nama Pelatih" },
            { "title": "propinsi", "class": "center" },
            { "title": "Jenis<br>Kelamin", "class": "center" },
            { "title": "Posisi Lat", "class": "center" },
            { "title": "Posisi Lng", "class": "center" },
                    		{
                
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
          }});   	
   	
  		map = new google.maps.Map(document.getElementById('gmap_city'),
  			{
      		zoom: 5,
      		mapTypeId: google.maps.MapTypeId.ROADMAP,
      		center: new google.maps.LatLng(-1.5,117)
 			});
 		map.setOptions({draggable: true, zoomControl: true, scrollwheel: false, disableDoubleClickZoom: true});
	   	google.maps.event.addListener(map, 'dblclick', function(event) {
			//alert(event.latLng);
			$('#lat').val(event.latLng.lat());
			$('#lng').val(event.latLng.lng());
		});
		map.data.loadGeoJson('../../json/indonesia.json');
			map.data.setStyle(function(feature) {
    			return({
      			fillColor: feature.getProperty('color'),
      			strokeWeight: 1
    			});
  			});
  			map.data.addListener('mouseover', function(event) {
   	 	map.data.revertStyle();
    		map.data.overrideStyle(event.feature, {strokeWeight: 2});
  			});
  			map.data.addListener('dblclick', function(event) {
			$('#lat').val(event.latLng.lat());
			$('#lng').val(event.latLng.lng());
  			});
		$('.cabor').html('<option value="">--Loading--</option>');
 
		$.ajax({url: "<?php echo $url_rewrite.'core/input_atlet/read_cabor.php'; ?>",
             success: function(output) {
                //alert(output);
                caborOutput = output;
                $('.cabor').html(caborOutput);
            },
          error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " "+ thrownError);
          }});
          
    $('#pelatih').html('<option value="">Pilih Cabang Olahraga dulu ! </option>');
    $('#input-cabor').change(function(e) {
    //Grab the chosen value on first select list change
    var selectvalue = $(this).val();
 
    //Display 'loading' status in the target select list
    $('#pelatih').html('<option value="">Loading...</option>');
 
    if (selectvalue == "") {
        //Display initial prompt in target select if blank value selected
       $('#pelatih').html('<option value="">! Pilih Cabang Olahraga ! </option>');
    } else {
      //Make AJAX request, using the selected value as the GET
      $.ajax({url: '<?php echo $url_rewrite.'core/input_atlet/read_pelatih_controller.php'; ?>',
      			type: 'POST',
      			data: {id:selectvalue},
             success: function(output) {
                //alert(output);
                $('#pelatih').html(output);
            },
          error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " "+ thrownError);
          }});
        }
     });
     	
      
     	$('#city_list').change(function(){
   	var coordinate = $('option:selected',this).data('latlng');
   	var propinsiValue = $(this).val();
   	var caborValue = $('#cabor').val();
   	map.panTo(new google.maps.LatLng(coordinate[0],coordinate[1]));
   	if (coordinate == '-1.5,117') {
   		map.setZoom(5);
    	}
   	else {
      	map.setZoom(8)
    	}
	      $.ajax({url: '<?php echo $url_rewrite.'core/input_atlet/read_all_atlet.php'; ?>',
      			type: 'POST',
      			data: {id_propinsi:propinsiValue,id_cabor:caborValue},
             success: function(output) {
             	var op=JSON.parse(output);
                //alert(output);
                $('#dataTablesAtlet').dataTable().fnClearTable();
                $('#dataTablesAtlet').dataTable().fnAddData(op);
               // $('#dataTablesAtlet').html(output);
                
                
          		//$('#dataTablesAtlet').DataTable();
          		   /* $('#dataTablesAtlet').dataTable( {
        		"data": op,
        		"columns": [
            { "title": "Atlet" },
            { "title": "Cabang Olahraga" },
            { "title": "Pelatih" },
            { "title": "propinsi", "class": "center" },
            { "title": "Jenis Kelamin", "class": "center" },
            { "title": "Posisi Lat", "class": "center" },
            { "title": "Posisi Lng", "class": "center" }
        ]
    });*/
            },
          error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " "+ thrownError);
          }});
		
	});
	
     	$('#cabor').change(function(){
   	
   	var propinsiValue = $('#city_list').val();
   	var caborValue = $(this).val()
   	
	   $.ajax({url: '<?php echo $url_rewrite.'core/input_atlet/read_all_atlet.php'; ?>',
  			type: 'POST',
      	data: {id_propinsi:propinsiValue,id_cabor:caborValue},
       	success: function(output) {
      	var op=JSON.parse(output);
                //alert(output);
         	$('#dataTablesAtlet').dataTable().fnClearTable();
         	$('#dataTablesAtlet').dataTable().fnAddData(op);
			},
    		error: function (xhr, ajaxOptions, thrownError) {
     			alert(xhr.status + " "+ thrownError);
   		}});
       	//var selectvalue = $(this).val();
 
    		//Display 'loading' status in the target select list
    		$('#pelatih').html('<option value="">Loading...</option>');
 
    		if (caborValue == "") {
        		//Display initial prompt in target select if blank value selected
       		$('#pelatih').html('<option value="">! Pilih Cabang Olahraga ! </option>');
    		} else {
      		//Make AJAX request, using the selected value as the GET
      		$.ajax({url: '<?php echo $url_rewrite.'core/input_atlet/read_pelatih_controller.php'; ?>',
      			type: 'POST',
      			data: {id:caborValue},
             	success: function(output) {
                //alert(output);
               	$('#pelatih').html(output);
 
            	},
          		error: function (xhr, ajaxOptions, thrownError) {
            		alert(xhr.status + " "+ thrownError);
          		}
          	});
        	}
        	
		});	     
		
		$(document).on('click', '.details-control', function () {
			
        var tr = $(this).closest('tr');
        //alert(tr);
        var row = table.row(tr);
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown warning');
            
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown warning');
            //alert(row.data()[2])
            //$('#cabor-update').filter(function () { return $(this).html() == 'Atletik'; }).val();
           // $('#cabor-update').find('option[text="Atletik"]').val();
            //$("#cabor-update").val("23");
            //$("#city_list-update").val("7");
            var value = $("#cabor-update-"+row.data()[0] +" option").filter(function() {
  									return $(this).text() == row.data()[2];
								}).first().attr("value");
				$("#cabor-update-"+row.data()[0] +"").val(value);
				
            var value2 = $("#city_list-update-"+row.data()[0] +" option").filter(function() {
  									return $(this).text() == row.data()[4];
								}).first().attr("value");
				$("#city_list-update-"+row.data()[0] +"").val(value2);
								
				$('#pelatih-update-'+row.data()[0] +'').html('<option value="">Pilih Cabang Olahraga dulu ! </option>');	
				
				$("#cabor-update-"+row.data()[0] +"").change(function(e) {
   			 //Grab the chosen value on first select list change
   			var selectvalue = $(this).val();
 
    				//Display 'loading' status in the target select list
    					$('#pelatih-update-'+row.data()[0] +'').html('<option value="">Loading...</option>');
 
    						if (selectvalue == "") {
       			 //Display initial prompt in target select if blank value selected
      					 $('#pelatih-update-'+row.data()[0] +'').html('<option value="">! Pilih Cabang Olahraga ! </option>');
   					} else {
   				   //Make AJAX request, using the selected value as the GET
   							   $.ajax({url: '<?php echo $url_rewrite.'core/input_atlet/read_pelatih_controller.php'; ?>',
      							type: 'POST',
      						data: {id:selectvalue},
      			       success: function(output) {
      			          //alert(output);
        				        $('#pelatih-update-'+row.data()[0] +'').html(output);
     			       },
     				     error: function (xhr, ajaxOptions, thrownError) {
    			        alert(xhr.status + " "+ thrownError);
    					      }});
   				     }
  				   });
  				   
  				   $.ajax({url: '<?php echo $url_rewrite.'core/input_atlet/read_pelatih_controller.php'; ?>',
      							type: 'POST',
      						data: {id:value},
      			       success: function(output) {
      			          //alert(output);
        				        $('#pelatih-update-'+row.data()[0] +'').html(output);
        				        				 var value3 = $("#pelatih-update-"+row.data()[0] +" option").filter(function() {
  									return $(this).text() == row.data()[3];
								}).first().attr("value");
				$("#pelatih-update-"+row.data()[0] +"").val(value3);
				//alert(value3);
     			       },
     				     error: function (xhr, ajaxOptions, thrownError) {
    			        alert(xhr.status + " "+ thrownError);
    					      }});
				if(row.data()[5] == "Perempuan"){
					$('#jenkel-update-'+row.data()[0] +'-perempuan').prop("checked", true);
					
				}else{
					$('#jenkel-update-'+row.data()[0] +'-laki').prop("checked", true);
				}
        
				$('#update-atlet-'+row.data()[0] +'').submit(function(event) {
					      	event.preventDefault();
      	$('#alert-update').empty();
					      	var $form = $( this );
          var url = $form.attr( 'action' );
          

          //alert($('#lng-update-'+row.data()[0] +'').val() );
					var posting = $.post(url, {
										id_atlet: row.data()[0], 
										namaatlet: $('#nama-atlet-update-'+row.data()[0] +'').val(), 
										jenkel: $('.jenkel-update-'+row.data()[0] +':checked').val(), 
										cabor: $('#cabor-update-'+row.data()[0] +'').val(), 
										propinsi: $('#city_list-update-'+row.data()[0] +'').val(), 
										pelatih: $('#pelatih-update-'+row.data()[0] +'').val(), 
										lat: $('#lat-update-'+row.data()[0] +'').val(), 
										lng: $('#lng-update-'+row.data()[0] +'').val() 
										} );

      /* Alerts the results */
      		posting.done(function( data ) {
        		//alert('success');

        		$('#alert-update-'+row.data()[0] +'').fadeTo(2000, 500).slideUp(500).html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>Data berhasil diubah.</div>');
				          var jk;
          if ($('.jenkel-update-'+row.data()[0] +':checked').val()==1) {
          	jk = "Laki-laki";
          } else {
          	jk = "Perempuan";
          }
				$('#dataTablesAtlet').dataTable().fnUpdate( 
								[
									row.data()[0],
									$('#nama-atlet-update-'+row.data()[0] +'').val(),
									$('#cabor-update-'+row.data()[0] +' option:selected').text(), 
									$('#pelatih-update-'+row.data()[0] +' option:selected').text(),
									$('#city_list-update-'+row.data()[0] +' option:selected').text(),
									jk,
									$('#lat-update-'+row.data()[0] +'').val(), 
									$('#lng-update-'+row.data()[0] +'').val()
								], tr[0] );
        		//$('#dataTablesAtlet').dataTable().fnDraw();
        		 var propinsiValue = $('#city_list').val();
   				var caborValue = $('#cabor').val()
   				
   	
        		/*$.ajax({url: '<?php echo $url_rewrite.'core/input_atlet/read_all_atlet.php'; ?>',
  			type: 'POST',
      	data: {id_propinsi:propinsiValue,id_cabor:caborValue},
       	success: function(output) {
      	var op=JSON.parse(output);
                //alert(output);
         	$('#dataTablesAtlet').DataTable().fnClearTable();
         	$('#dataTablesAtlet').DataTable().fnAddData(op);
			},
    		error: function (xhr, ajaxOptions, thrownError) {
     			alert(xhr.status + " "+ thrownError);
   		}});*/

    			});
				});        
				$('#hapus-'+ row.data()[0] +'').click(function() {
        			//Do stuff when clicked
        			$('#modal-hapus').modal('show');
        			$('#hapus-data').click(function() {
        			var propinsiValue = $('#city_list').val();
   				var caborValue = $(this).val();
  				   $.ajax({url: '<?php echo $url_rewrite.'core/input_atlet/delete_atlet.php'; ?>',
      				type: 'POST',
      				data: {id_atlet:row.data()[0]},
      				success: function(output) {
      			          //alert(output);
      			   	$.ajax({url: '<?php echo $url_rewrite.'core/input_atlet/read_all_atlet.php'; ?>',
  								type: 'POST',
      						data: {id_propinsi:propinsiValue,id_cabor:caborValue},
       						success: function(output) {
      							var op=JSON.parse(output);
                				//alert(output);
         						$('#dataTablesAtlet').dataTable().fnClearTable();
         						$('#dataTablesAtlet').dataTable().fnAddData(op);
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
             	<h1 class="page-header">Input Data Atlet</h1>
         	</div>
      	</div>
      	<div class="row">
      		<div class="col-lg-12">
         		<div class="panel ">
            		<div class="panel-body">
            			<div id="gmap_city" style="height:380px; width:100%; border-radius:10px 10px 0px 0px;"></div>
      	      		<div class="informasibox" style="margin-bottom:10px;height:24px;border-radius:0px 0px 10px 10px;width:100%; background-color:#E7F7A7; text-align:center;">
                     	<p>Informasi : Klik 2x pada peta untuk menentukan lokasi atlet secara otomatis</p>                               
                  	</div>
                  	<div id="alert-input"></div>
                  	<div id="inputatlet" style="height:100%px; width:100%; border-radius:10px 10px 0px 0px; background-color:#F5F5F5; padding:20px 20px 20px 80px;">
                  	<form id="input-atlet" action="<?php echo $url_rewrite.'core/input_atlet/input_atlet_controller.php'; ?>" method="POST">
<div class="row">
                  		<div class="col-md-6">
                  			<select required="required" id="city_list" style="width:230px; height:34px;margin : 0 auto" name="propinsi" class="form-control">
							<option selected="selected" data-latlng="[-1.5, 117]" id="valid2" value="0">Pilih Propinsi</option>
							<option data-latlng="[4.359558, 96.934570]" value="1">Nanggroe Aceh Darussalam</option>
       						<option data-latlng="[2.264792,99.219727]" value="3" >Sumatera Utara</option>
        						<option data-latlng="[-0.973342,100.066002]" value="27" >Sumatera Barat</option>
       						<option data-latlng="[0.312010,101.582001]" value="26">Riau</option>
        						<option data-latlng="[-1.654310,102.790001]" value="28">Jambi</option>
       						<option data-latlng="[-3.245820,104.228996]" value="29">Sumatera Selatan</option>
        						<option data-latlng="[-3.837950,102.251999]" value="33">Bengkulu</option>
        						<option data-latlng="[-5.009961,105.152344]" value="31">Lampung</option>
        						<option data-latlng="[-2.715901,106.557495]" value="30">Kepulauan Bangka Belitung</option>
       						<option data-latlng="[3.829178,108.131836]" value="2">Kepulauan Riau</option>
       						<option data-latlng="[-6.211278,106.842316]" value="5">DKI Jakarta</option>
        						<option data-latlng="[-6.932970,107.602295]" value="6">Jawa Barat</option>
       						<option data-latlng="[-7.161940,110.184082]" value="7">Jawa Tengah</option>
       						<option data-latlng="[-7.894941,110.432373]" value="8">Daerah Istimewa Yogyakarta</option>
        						<option data-latlng="[-7.761069,112.645020]" value="9">Jawa Timur</option>
       						<option data-latlng="[-6.451230,106.112000]" value="4">Banten</option>
       						<option data-latlng="[-8.408255,115.170776]" value="10">Bali</option>
        						<option data-latlng="[-8.696155,117.499878]" value="11">Nusa Tenggara Barat</option>
        						<option data-latlng="[-8.647282,121.097900]" value="12">Nusa Tenggara Timur</option>
        						<option data-latlng="[0.129638,111.106934]" value="13">Kalimantan Barat</option>
        						<option data-latlng="[-1.518133,113.425049]" value="14">Kalimantan Tengah</option>
        						<option data-latlng="[-3.043977,115.479492]" value="15">Kalimantan Selatan</option>
        						<option data-latlng="[1.656507,116.545166]" value="19">Kalimantan Timur</option>
        						<option data-latlng="[0.678940,124.235596]" value="22">Sulawesi Utara</option>
        						<option data-latlng="[-1.430271,121.445068]" value="20">Sulawesi Tengah</option>
        						<option data-latlng="[-3.598949,120.247559]" value="16">Sulawesi Selatan</option>
        						<option data-latlng="[-4.129477,122.148193]" value="18">Sulawesi Tenggara</option>
        						<option data-latlng="[0.678940,122.455811]" value="21">Gorontalo</option>
     	 						<option data-latlng="[-2.183553,119.324707]" value="17">Sulawesi Barat</option>
       						<option data-latlng="[-3.320404,130.126465]" value="24">Maluku</option>
       						<option data-latlng="[1.423683,127.687500]" value="23">Maluku Utara</option>
        						<option data-latlng="[-2.067178,132.585205]" value="25">Irian Jaya Barat</option>
        						<option data-latlng="[-4.385847,138.177246]" value="32">Papua</option>
							</select>
                  		</div>
                  		<div class="col-md-6 text-center" >
                  		<select required="required" id="cabor" name="cabor" class="cabor form-control" style="width:230px; height:34px;margin : 0 auto" ></select>
                  		</div>
                  	</div>
							<hr>
                  		<table>
						<tr>
						<td>Nama Atlet</td><td style="padding:10px 20px 10px 20px;">:</td>
						<td><input tabindex="1" required="required" style="width:230px; height:34px;" type="text" name="nama-atlet" id="nama-atlet" class="form-control"></td>
						<td style="padding:10px 20px 10px 40px;">Latitude</td>
						<td style="padding:10px 20px 10px 20px;">:</td>
						<td><input tabindex="5" required="required" style="width:230px; height:34px;" type="text" autocomplete="on" required="required" name="lat" id="lat" class="form-control"></td><td><div id="nan1" hidden="true"><label style="color:red">Salah</label></div></td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td><td style="padding:10px 20px 10px 20px;">:</td>
						<td>
								<label class="radio-inline">
 										<input tabindex="2"  type="radio" name="jenkel" id="jenkel" value="1"> Laki-laki</input>
									</label>
									<label class="radio-inline">
  										<input tabindex="3" type="radio" name="jenkel" id="jenkel" value="2"> Perempuan</input>
									</label>
							</select>									
						</td>
						<td style="padding:10px 20px 10px 40px;">Longitude</td>
						<td style="padding:10px 20px 10px 20px;">:</td>
						<td><input tabindex="7" required="required" style="width:230px; height:34px;" type="text" name="lng" id="lng" required="required" class="form-control"></td><td><div id="nan2" hidden="true"><label style="color:red">Salah</label></div><td>
												
					</tr>
					<tr>
						
						
					</tr>
					<tr>
						<td>Nama Pelatih</td><td style="padding:10px 20px 10px 20px;">:</td>
						<td><select tabindex="4" required="required" name="pelatih" id="pelatih" style="width:230px; height:34px;" class="form-control"></select></td>						
						
						<td style="padding:10px 20px 10px 40px;" colspan="3" class="text-center"><input type="reset" value="Reset" style="width:110px; height:34px;margin-left: 10px;margin-right:40px" class="btn btn-warning"><input type="submit" value="Submit" style="width:110px; height:34px;" class="btn btn-primary"></td>
					</tr>
 				</table>
 			</form>
                  	</div>
                  	<div class="informasibox" style="height:24px; width:100%; background-color:#FADAAA; text-align:center;">
                     	<p>Informasi : Daftar atlet yang sudah di data</p>                               
                  	</div>
                  	               	
							<div id="alert-hapus"></div>
                  	<div class="row" id="datatable" style="margin-top:15px">
   
                  	

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
        			<p>Anda yakin akan menghapus data atlet ini ?</p>
      		</div>
      		<div class="modal-footer">
        			<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        			<button type="button" class="btn btn-danger" id="hapus-data">Hapus !</button>
      		</div>
    		</div>
  		</div>
	</div>
	<script>
$('#lat').keyup(function () {
			if($.isNumeric($('#lat').val())){
				$('#nan1').hide(500);
			} else if ($('#lat').val()=='' || $('#lat').val()=='-') {
				$('#nan1').hide(500);
			} else {
				$('#nan1').show(500);
			}

		});
		$('#lng').keyup(function () {
			if($.isNumeric($('#lng').val())){
				$('#nan2').hide(500);
			} else if ($('#lng').val()=='' || $('#lng').val()=='-') {
				$('#nan2').hide(500);
			} else {
				$('#nan2').show(500);
			}

		});
		$("#input-atlet").submit(function(event) {

      /* stop form from submitting normally */
      	event.preventDefault();
      	$('#alert-input').empty();

      /* get some values from elements on the page: */
      	var $form = $( this );
          var url = $form.attr( 'action' );
          if ($('#nama-atlet').val()=="" || $('#cabor').val()==0 || $('#pelatih').val()=="" || $('#city_list').val()==0 || $('#lat').val()=="" || !$.isNumeric($('#lat').val()) || $('#lng').val()=="" || !$.isNumeric($('#lng').val()) || $('#jenkel:checked').val()==undefined ) {
          	if($('#nama-atlet').val()==""){
          		$('#alert-input').append('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Silakan isi nama atlet.</div>');
					
				} 
				if($('#cabor').val()==0){
          		$('#alert-input').append('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Silakan pilih cabang olahraga.</div>');
				}
				if($('#pelatih').val()==""){
          		$('#alert-input').append('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Silakan pilih pelatih.</div>');
				}
				if($('#city_list').val()==0){
          		$('#alert-input').append('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Silakan pilih propinsi.</div>');
				}
				if($('#lat').val()=="" || !$.isNumeric($('#lat').val()) ){
          		$('#alert-input').append('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Silakan isi posisi latitude dengan benar.</div>');
				}
				if($('#lng').val()=="" || !$.isNumeric($('#lng').val()) ){
          		$('#alert-input').append('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Silakan isi posisi longitude dengan benar.</div>');
				}
				if($('#jenkel:checked').val()==undefined){
          		$('#alert-input').append('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Silakan pilih jenis kelamin.</div>');
				}
				//alert($('#jenkel:checked').val());
				         
          } else {
          	      /* Send the data using post */
     			var posting = $.post( url, { namaatlet: $('#nama-atlet').val(), jenkel: $('#jenkel:checked').val(), cabor: $('#cabor').val(), propinsi: $('#city_list').val(), pelatih: $('#pelatih').val(), lat: $('#lat').val(), lng: $('#lng').val() } );

      /* Alerts the results */
      		posting.done(function( data ) {
        		//alert('success');
        		
        		//$('#dataTablesAtlet').dataTable().fnDraw();
        		 var propinsiValue = $('#city_list').val();
   				var caborValue = $('#cabor').val()
   	
        		$.ajax({url: '<?php echo $url_rewrite.'core/input_atlet/read_all_atlet.php'; ?>',
  			type: 'POST',
      	data: {id_propinsi:propinsiValue,id_cabor:caborValue},
       	success: function(output) {
      	var op=JSON.parse(output);
                //alert(output);
         	$('#dataTablesAtlet').dataTable().fnClearTable();
         	$('#dataTablesAtlet').dataTable().fnAddData(op);
         	$('#alert-input').fadeTo(2000, 500).slideUp(500).html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>Data berhasil ditambah.</div>');
				
         	
			},
    		error: function (xhr, ajaxOptions, thrownError) {
     			alert(xhr.status + " "+ thrownError);
   		}});
   		
   		$('#nama-atlet').val('');
   		$('#jenkel').val('');
   		$('#pelatih').val('');
   		$('#lat').val('');
   		$('#lng').val('');
    			});
    		}
    });

    function format ( d ) {
    // `d` is the original data object for the row
    var tableString = '<form id="update-atlet-'+d[0] +'" action="<?php echo $url_rewrite.'core/input_atlet/update_atlet.php'; ?>" method="POST">'+
    '<table cellpadding="5" cellspacing="0" border="0"  class="table" style="padding-left:50px;border: 0;">'+
        '<tr>'+
        		'<td style="padding : 10px">ID Atlet</td><td style="padding:10px 20px 10px 20px;">:</td>'+
            '<td><input tabindex="1"  style="width:230px; height:34px;" type="text" name="id-atlet-update-'+d[0] +'" id="id-atlet-update-'+d[0] +'" class="form-control" value="'+d[0]+'" readonly></td>'+
      		
            '<td style="padding : 10px">Cabang Olahraga</td><td style="padding:10px 20px 10px 20px;">:</td>'+
            '<td><select  id="cabor-update-'+d[0] +'" name="cabor-update-'+d[0] +'" class="cabor form-control" >'+
            caborOutput +
            '</select></td>'+
  
        '</tr>'+
        '<tr>'+
        		'<td style="padding : 10px">Atlet</td><td style="padding:10px 20px 10px 20px;">:</td>'+
            '<td><input tabindex="1"  style="width:230px; height:34px;" type="text" name="nama-atlet-update-'+d[0] +'" id="nama-atlet-update-'+d[0] +'" class="form-control" value="'+d[1]+'"></td>'+
      		
            '<td style="padding : 10px">Propinsi</td><td style="padding:10px 20px 10px 20px;">:</td>'+
            '<td><select id="city_list-update-'+d[0] +'"  name="propinsi-update-'+d[0] +'" class="form-control">'+
							'<option selected="selected" data-latlng="[-1.5, 117]" id="valid2" value="0">Pilih Propinsi</option>'+
							'<option data-latlng="[4.359558, 96.934570]" value="1">Nanggroe Aceh Darussalam</option>'+
       						'<option data-latlng="[2.264792,99.219727]" value="3" >Sumatera Utara</option>'+
        						'<option data-latlng="[-0.973342,100.066002]" value="27" >Sumatera Barat</option>'+
       						'<option data-latlng="[0.312010,101.582001]" value="26">Riau</option>'+
        						'<option data-latlng="[-1.654310,102.790001]" value="28">Jambi</option>'+
       						'<option data-latlng="[-3.245820,104.228996]" value="29">Sumatera Selatan</option>'+
        						'<option data-latlng="[-3.837950,102.251999]" value="33">Bengkulu</option>'+
        						'<option data-latlng="[-5.009961,105.152344]" value="31">Lampung</option>'+
        						'<option data-latlng="[-2.715901,106.557495]" value="30">Kepulauan Bangka Belitung</option>'+
       						'<option data-latlng="[3.829178,108.131836]" value="2">Kepulauan Riau</option>'+
       						'<option data-latlng="[-6.211278,106.842316]" value="5">DKI Jakarta</option>'+
        						'<option data-latlng="[-6.932970,107.602295]" value="6">Jawa Barat</option>'+
       						'<option data-latlng="[-7.161940,110.184082]" value="7">Jawa Tengah</option>'+
       						'<option data-latlng="[-7.894941,110.432373]" value="8">Daerah Istimewa Yogyakarta</option>'+
        						'<option data-latlng="[-7.761069,112.645020]" value="9">Jawa Timur</option>'+
       						'<option data-latlng="[-6.451230,106.112000]" value="4">Banten</option>'+
       						'<option data-latlng="[-8.408255,115.170776]" value="10">Bali</option>'+
        						'<option data-latlng="[-8.696155,117.499878]" value="11">Nusa Tenggara Barat</option>'+
        						'<option data-latlng="[-8.647282,121.097900]" value="12">Nusa Tenggara Timur</option>'+
        						'<option data-latlng="[0.129638,111.106934]" value="13">Kalimantan Barat</option>'+
        						'<option data-latlng="[-1.518133,113.425049]" value="14">Kalimantan Tengah</option>'+
        						'<option data-latlng="[-3.043977,115.479492]" value="15">Kalimantan Selatan</option>'+
        						'<option data-latlng="[1.656507,116.545166]" value="19">Kalimantan Timur</option>'+
        						'<option data-latlng="[0.678940,124.235596]" value="22">Sulawesi Utara</option>'+
        						'<option data-latlng="[-1.430271,121.445068]" value="20">Sulawesi Tengah</option>'+
        						'<option data-latlng="[-3.598949,120.247559]" value="16">Sulawesi Selatan</option>'+
        						'<option data-latlng="[-4.129477,122.148193]" value="18">Sulawesi Tenggara</option>'+
        						'<option data-latlng="[0.678940,122.455811]" value="21">Gorontalo</option>'+
     	 						'<option data-latlng="[-2.183553,119.324707]" value="17">Sulawesi Barat</option>'+
       						'<option data-latlng="[-3.320404,130.126465]" value="24">Maluku</option>'+
       						'<option data-latlng="[1.423683,127.687500]" value="23">Maluku Utara</option>'+
        						'<option data-latlng="[-2.067178,132.585205]" value="25">Irian Jaya Barat</option>'+
        						'<option data-latlng="[-4.385847,138.177246]" value="32">Papua</option>'+
							'</select>'+
            '</td>'+
  
        '</tr>'+
        '<tr>'+
        		'<td style="padding : 10px">Pelatih</td><td style="padding:10px 20px 10px 20px;">:</td>'+
            '<td><select tabindex="3" name="pelatih-update-'+d[0] +'" id="pelatih-update-'+d[0] +'" style="width:230px; height:34px;" class="form-control"></select></td>'+
      		
            '<td style="padding : 10px">Jenis Kelamin</td><td style="padding:10px 20px 10px 20px;">:</td>'+
            '<td><label class="radio-inline">'+
 										'<input tabindex="2"  type="radio" name="jenkel-update-'+d[0] +'" class="jenkel-update-'+d[0] +'" id="jenkel-update-'+d[0] +'-laki" value="1"><label for="jenkel-update-'+d[0] +'-laki">Laki-laki</label></input>'+
									'</label>'+
									'<label class="radio-inline">'+
  										'<input tabindex="2" type="radio" name="jenkel-update-'+d[0] +'" class="jenkel-update-'+d[0] +'" id="jenkel-update-'+d[0] +'-perempuan" value="2"><label for="jenkel-update-'+d[0] +'-perempuan">Perempuan</label></input>'+
									'</label></td>'+
  
        '</tr>'+
        '<tr>'+
            '<td style="padding : 10px">Lat</td><td style="padding:10px 20px 10px 20px;">:</td>'+
            '<td><input tabindex="1" style="width:230px; height:34px;" type="text" name="lat-update-'+d[0] +'" id="lat-update-'+d[0] +'" class="form-control" value="'+d[6]+'"></td>'+
				'<td style="padding : 10px">Lng</td><td style="padding:10px 20px 10px 20px;">:</td>'+
            '<td><input tabindex="1" style="width:230px; height:34px;" type="text" name="lng-update-'+d[0] +'" id="lng-update-'+d[0] +'" class="form-control" value="'+d[7]+'"></td>'+      		
      		
  
        '</tr>'+
        
        '<tr>'+
            '<td colspan="3"><div class="text-center"><input type="submit" value="Update" style="width:110px; height:34px;" class="btn btn-primary"></div></td>'+
				'<td colspan="3"><div class="text-center"><input id="hapus-'+ d[0] +'" value="Hapus" style="width:110px; height:34px;" class="btn btn-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span></div></td>'+
  
        '</tr>'+
            
    '</table>'+
     '<div id="alert-update-'+d[0] +'" width="100%"></div>'+
    '</form>';
    
    return tableString
		}
	</script>
</body>
<?php include "view/foot.php";?>
</html>
