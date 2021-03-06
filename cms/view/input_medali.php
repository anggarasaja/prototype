<!DOCTYPE html>
<html>
	<head>
		<meta name="generator" content="Bluefish 2.2.6" >
		<meta name="generator" content="Bluefish 2.2.6" >
		<?php include "view/head.php";?>
		<script type="text/javascript" src=
		"http://maps.google.com/maps/api/js?sensor=true&amp;language=in">
		</script>
		<script type="text/javascript">
			var map;
			var propinsiValue;
			//var caborOutput;
			var table;
			var marker;
		   var markers = [];
			function pageLoad(){
				propinsiValue = $('#city_list').val()        	
		        	
				$('#datatable').html( '<table cellpadding="10" cellspacing="5" border="0" class="table table-striped table-hover" width="100%" id="dataTablesMedali"><\/table>' );
				//load data ke dalam datatables				
				$.ajax({url: '<?php echo $url_rewrite.'core/input_medali/read_all_medali.php'; ?>',
					type: 'POST',
					data: {id_propinsi:0},
					success: function(output) {
						var op=JSON.parse(output);
						table = $('#dataTablesMedali').DataTable( {
							stateSave: true,
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
								{ "title": "Emas" },
				            { "title": "Perak" },
				            { "title": "Perunggu", },
				            { "title": "Cabang<br>Olahraga", },
				            { "title": "Propinsi", },
				            { "title": "Tahun", },
				            { "title": "Kejuaraan", },
		            		{
									"orderable":      false,
									"data":           null,
			     					"defaultContent": '<div class="details-control"><\/div.'
		            		}
							],      
							"data" : op,
						});
		            var tableTools = new $.fn.dataTable.TableTools( table, {
        		"buttons": [
            	"copy",
            	"csv",
            	"xls",
            	"pdf",
            	{ "type": "print", "buttonText": "Print me!" }
        		]
    		});
		   $('div#button-table').append($( tableTools.fnContainer() ));
					},
					error: function (xhr, ajaxOptions, thrownError) {
						alert(xhr.status + " "+ thrownError);
					}
				});  
				map = new google.maps.Map(document.getElementById('gmap_city'),
				{
					zoom: 5,
		  			mapTypeId: google.maps.MapTypeId.ROADMAP,
		 			center: new google.maps.LatLng(-1.5,117)
		   	});
		   	map.setOptions({draggable: true, zoomControl: true, scrollwheel: false, disableDoubleClickZoom: true});
		    	google.maps.event.addListener(map, 'dblclick', function(event) {
		      	placeMarker(event.latLng);	function placeMarker(location) {
			 			if ( marker ) {
			    			marker.setPosition(location);
			  			}
			  			else {
			  				var image = {
			    				url: '../../icon/diamondadd.png',
			  				};
				    		marker = new google.maps.Marker({
					    		position: location,
					      	map: map,
					      	icon: image
				    		});
			  			}
					}
		 			$('#lat').val(event.latLng.lat());
					$('#lng').val(event.latLng.lng());
				});
		
				// map.data.loadGeoJson('../../json/indonesia_kab.json');
		 	// 	map.data.setStyle(function(feature) {
				// 	return({
				// 		fillColor: feature.getProperty('color'),
				// 		strokeWeight: 1
				// 	});
				// });
				map.data.addListener('mouseover', function(event) {
					map.data.revertStyle();
					map.data.overrideStyle(event.feature, {strokeWeight: 2});
				});
				map = new google.maps.Map(document.getElementById('gmap_city'),
				{
					zoom: 5,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					center: new google.maps.LatLng(-1.5,117)
		 		});
		 		map.setOptions({draggable: true, zoomControl: true, scrollwheel: false, disableDoubleClickZoom: true});
		 		map.data.addListener('dblclick', function(event) {
		  			placeMarker(event.latLng);
					$('#lat').val(event.latLng.lat());
					$('#lng').val(event.latLng.lng());
		  		});
		  		map.data.loadGeoJson('../../json/indonesia_kab.json');
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
				
				$('.cabor').html('<option value="">--Loading--<\/option>');
				$.ajax({url: "<?php echo $url_rewrite.'core/input_medali/read_cabor.php'; ?>",
        			success: function(output) {
	          		//alert(output);
	           		caborOutput = output;
	           		$('.cabor').html(caborOutput);
            	},
          		error: function (xhr, ajaxOptions, thrownError) {
            		alert(xhr.status + " "+ thrownError);
          		}
          	});
		          
		   	$('#city_list').change(function(){
		  			var coordinate = $('option:selected',this).data('latlng');
		 			propinsiValue = $(this).val();
		        	var caborValue = $('#cabor').val();
		        	var tahunValue = $('#tahun').val();
		 			map.panTo(new google.maps.LatLng(coordinate[0],coordinate[1]));
		   		if (coordinate == '-1.5,117') {
		     			map.setZoom(5);
		        	}
		        	else {
		        		map.setZoom(8)
		        	}
					$.ajax({url: '<?php echo $url_rewrite.'core/input_medali/read_all_medali.php'; ?>',
		 				type: 'POST',
		          	data: {id_propinsi:propinsiValue,id_cabor:caborValue, tahun:tahunValue},
		    			success: function(output) {
		     				var op=JSON.parse(output);
		             	//alert(output);
		              	table.clear().draw();
		              	if (op!=null) {
		              		//alert("op not null");
		                	table.rows.add(op).draw();
		            	}
		                        
		                
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
		          	}
		    		});
				});
		        
		      $('#cabor').change(function(){
					var propinsiValue = $('#city_list').val();
		       	var caborValue = $(this).val();
		       	var tahunValue = $('#tahun').val();
					$.ajax({url: '<?php echo $url_rewrite.'core/input_medali/read_all_medali.php'; ?>',
		         	type: 'POST',
		        		data: {id_propinsi:propinsiValue,id_cabor:caborValue, tahun:tahunValue},
		        		success: function(output) {
		        			var op=JSON.parse(output);
		             	//alert(output);
		             	table.clear().draw();
		              	if (op!=null) {
		              		//alert("op not null");
		                	table.rows.add(op).draw();
		             	}
				 		},
		          	error: function (xhr, ajaxOptions, thrownError) {
		            	alert(xhr.status + " "+ thrownError);
		           	}});
		   	});       
		   	
		   	$('#tahun').change(function(){
					var propinsiValue = $('#city_list').val();
		       	var caborValue = $('#cabor').val();
		       	var tahunValue = $(this).val();
					$.ajax({url: '<?php echo $url_rewrite.'core/input_medali/read_all_medali.php'; ?>',
		         	type: 'POST',
		        		data: {id_propinsi:propinsiValue,id_cabor:caborValue, tahun:tahunValue},
		        		success: function(output) {
		        			var op=JSON.parse(output);
		             	//alert(output);
		             	table.clear().draw();
		              	if (op!=null) {
		              		//alert("op not null");
		                	table.rows.add(op).draw();
		             	}
				 		},
		          	error: function (xhr, ajaxOptions, thrownError) {
		            	alert(xhr.status + " "+ thrownError);
		           	}});
		   	});   
		                
				$(document).on('click', '.details-control', function () {
		      	var row;
		  			var id_row;
		  			var emas_row ;
		  			var perak_row;
		  			var perunggu_row;
		  			var tahun_row;
		  			var cabor_row;
		  			var propinsi_row;
		  			var kejuaraan_row;
		        
		        	var tr = $(this).closest('tr');
		        	row = table.row(tr);
		        	id_row = row.data()[0];
		        	emas_row = row.data()[1];
		        	perak_row = row.data()[2];
		        	perunggu_row = row.data()[3];
		        	cabor_row = row.data()[4];
		        	propinsi_row = row.data()[5];
					tahun_row = row.data()[6];
					kejuaraan_row = row.data()[7];
		                               
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
		            var value = $("#cabor-update-"+id_row +" option").filter(function() {
		            	return $(this).text() == cabor_row;
		            }).first().attr("value");
		            
		            $("#cabor-update-"+id_row +"").val(value);
		                       
		            var value2 = $("#city_list-update-"+id_row +" option").filter(function() {
		            	return $(this).text() == propinsi_row;
		            }).first().attr("value");
      
		            $("#city_list-update-"+id_row +"").val(value2);
		            
		            var value3 = $("#kejuaraan-update-"+id_row +" option").filter(function() {
		            	return $(this).text() == kejuaraan_row;
		            }).first().attr("value");
		            
		            $("#kejuaraan-update-"+id_row +"").val(value3);
		            
		            $("#emas-update-"+id_row +"").val(emas_row);
		            $("#perak-update-"+id_row +"").val(perak_row);
		            $("#perunggu-update-"+id_row +"").val(perunggu_row);
		            $("#tahun-update-"+id_row +"").val(tahun_row);
                     
		            $('#update-medali-'+id_row +'').submit(function(event) {
		           		event.preventDefault();
				       	$('#alert-update').empty();
		      			var $form = $( this );
			          	var url = $form.attr( 'action' );
			          
			
			          //alert($('#lng-update-'+row.data()[0] +'').val() );
			          	/*var posting = $.post(url, {
				           id_KNPI: id_row, 
				           nama-KNPI: $('#nama-KNPI-update-'+id_row +'').val().trim(),
					   		alamat : $("#alamat-update-"+id_row +"").val().trim(),
		            		pemimpin : $("#pemimpin-update-"+id_row +"").val(),	
		            		telp : $("#telp-update-"+id_row +"").val(),
		            		lat: $("#lat-update-"+id_row +"").val();
		            		lng : $("#lng-update-"+id_row +"").val();
				           propinsi: $('#city_list-update-'+id_row +'').val(),
				           
				           
				           },function() {
				                   $('#alert-update-'+id_row +'').fadeTo(2000, 500).slideUp(500).html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;<\/a>Data berhasil diubah.<\/div>');
				  
				           } );*/
				          
				         	var fd = new FormData(this);
				           	fd.append( 'id_row', id_row );
		              		var posting = $.ajax({
									url: url, // Url to which the request is send
									type: "POST",             // Type of request to be send, called as method
									data: fd, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
									contentType: false,       // The content type used when sending data to the server.
									cache: false,             // To unable request pages to be cached
									processData:false,        // To send DOMDocument or non processed data file it is set to false
									success: function(data)   // A function to be called if request succeeds
									{
										$('#alert-update').fadeTo(2000, 500).slideUp(500).html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;<\/a>Data berhasil diubah.<\/div>');	
									}
								});
		
		      /* Alerts the results */
		                	posting.done(function( data ) {
			 	          		$.ajax({url: '<?php echo $url_rewrite.'core/input_medali/read_all_medali.php'; ?>',
									type: 'POST',
						        	data: {id_propinsi:propinsiValue},
						        	success: function(output) {
							        	var op=JSON.parse(output);
				               	//alert(output);
				                	table.clear().draw(false);
				                	if (op!=null) {      
				                  	table.rows.add(op).draw(false);
				                	} 
		                     },
		                		error: function (xhr, ajaxOptions, thrownError) {
		                        alert(xhr.status + " "+ thrownError);
		                		}});
								});
		         	});        
		    			$('#hapus-'+ id_row +'').click(function() {
		          		//Do stuff when clicked
			           	$('#modal-hapus').modal('show');
			           	$('#hapus-data').click(function() {
				           	propinsiValue = $('#city_list').val();
				           	//var caborValue = $(this).val();
				
								$.ajax({url: '<?php echo $url_rewrite.'core/input_medali/delete_medali.php'; ?>',
				           		type: 'POST',
				           		data: {id_medali:id_row},
				           		success: function(output) {
				             	//alert(output);
				          			$.ajax({url: '<?php echo $url_rewrite.'core/input_medali/read_all_medali.php'; ?>',
					                 	type: 'POST',
					               	data: {id_propinsi:propinsiValue},
					             		success: function(output) {
					               		var op=JSON.parse(output);
					               		//alert(output);
					                		table.clear().draw(false);
					                   	if (op!=null) {
					   							//alert("op not null");
					   							table.rows.add(op).draw(false);
					 							} 
					    						$('#alert-hapus').fadeTo(2000, 500).slideUp(500).html('<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert">&times;<\/a>Data berhasil dihapus.<\/div>');
							            },
					              		error: function (xhr, ajaxOptions, thrownError) {
					                		alert(xhr.status + " "+ thrownError);
					               	}
				          			});
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
		        
			function placeMarker(location) {
				if ( marker ) {
		    		marker.setPosition(location);
		  		}
		  		else {
		  			var image = {
		    			url: '../../icon/diamondadd.png',
		  			};
		    		marker = new google.maps.Marker({
			      	position: location,
			      	map: map,
			      	icon: image
		    		});
		  		}
			}
		        
		</script>
		<title>Input Medali</title>
	</head>
	<body onload="pageLoad()">
		<div id="wrapper">
			<?php include "view/default/right_menu.php";?>
			<div id="page-wrapper" style="min-height:850px;">
				<div class="row">
					<div class="col-lg-12" style="margin-bottom:-20px;"><label class="page-header title-page" style="background-color:#DD8888;">Input Data Medali</label></div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="panel">
							<div class="panel-body">
								<div id="gmap_city" class="rounded-map"></div>
								<div id="alert-input-failed"></div>
								<div id="alert-input-success"></div>
								<div id="inputMedali" class="input-box">
									<form id="input-medali" action="<?php echo $url_rewrite.'core/input_medali/input_medali_controller.php'; ?>" method="post">
										<div class="row">
											
											<div class="col-md-4">
												<select required="required" id="city_list" style="width:230px; height:34px;margin : 0 auto" name="propinsi" class="form-control">
													<option selected="selected" data-latlng="[-1.5, 117]" id="valid2"	value="0">Pilih Propinsi</option>
													<option data-latlng="[4.359558, 96.934570]" value="1">Nanggroe Aceh Darussalam</option>
													<option data-latlng="[2.264792,99.219727]" value="3">Sumatera Utara</option>
													<option data-latlng="[-0.973342,100.066002]" value="27">Sumatera Barat</option>
													<option data-latlng="[0.312010,101.582001]" value="26">Riau</option>
													<option data-latlng="[-1.654310,102.790001]" value="28">Jambi</option>
													<option data-latlng="[-3.245820,104.228996]" value="29">Sumatera Selatan</option>
													<option data-latlng="[-3.837950,102.251999]" value="33">Bengkulu</option>
													<option data-latlng="[-5.009961,105.152344]" value="31">Lampung</option>
													<option data-latlng="[-2.715901,106.557495]" value="30">Bangka Belitung</option>
													<option data-latlng="[3.829178,108.131836]" value="2">Kepulauan Riau</option>
													<option data-latlng="[-6.211278,106.842316]" value="5">DKI Jakarta</option>
													<option data-latlng="[-6.932970,107.602295]" value="6">Jawa Barat</option>
													<option data-latlng="[-7.161940,110.184082]" value="7">Jawa Tengah</option>
													<option data-latlng="[-7.894941,110.432373]" value="8">DI. Yogyakarta</option>
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
													<option data-latlng="[-2.067178,132.585205]" value="25">Papua Barat</option>
													<option data-latlng="[-4.385847,138.177246]" value="32">Papua</option>
												</select>
											</div>
											<div class="col-md-4 text-center">
												<select required="required" id="cabor" name="cabor" class="cabor form-control" style="width:230px; height:34px;margin : 0 auto"></select>
											</div>
											<div class="col-md-4">
												<select class="form-control" id="tahun" name="tahun">
													<option value="0">Tahun</option>
										      	<option value="2015">2015</option>
										      	<option value="2014">2014</option>
										      	<option value="2013">2013</option>
										      	<option value="2012">2012</option>
										      	<option value="2011">2011</option>
										      	<option value="2010">2010</option>
										      	<option value="2009">2009</option>
										      	<option value="2008">2008</option>
										      	<option value="2007">2007</option>
										      	<option value="2006">2006</option>
										      	<option value="2005">2005</option>
										      	<option value="2004">2004</option>
										      	<option value="2003">2003</option>
										      	<option value="2002">2002</option>
										      	<option value="2001">2001</option>
										      	<option value="2000">2000</option>
										      </select>
											</div>
											
										</div>
										<div class="row" style="margin-top:25px">
											<div class="col-md-2">
												<div class="form-group">
											      <label for="email">Emas :</label>
											      <input type="number" class="form-control" id="emas" name="emas">
											    </div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
											      <label for="email">Perak :</label>
											      <input type="number" class="form-control" id="perak" name="perak">
											    </div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
											      <label for="email">Perunggu :</label>
											      <input type="number" class="form-control" id="perunggu" name="perunggu">
											    </div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
											      <label for="email">Kejuaraan :</label>
											      <select class="form-control" id="kejuaraan" name="kejuaraan">
											      	<option value="0">daerah</option>
											      	<option value="1">nasional</option>
											      </select>
											    </div>
											</div>
											<div class="col-md-2">
												<input type="reset" value="Reset" style="width:110px; height:34px; margin-top:20px" class="btn btn-warning">
												
											</div>
											<div class="col-md-2">
												<input type="submit" value="Submit" style="width:110px; height:34px; margin-top:20px" class="btn btn-primary">
											      											
											</div>
											
										</div>
										<hr>
										
									</form>
								</div>
								<div id="alert-hapus" style="margin-top:10px"></div>
								<div id="alert-update" style="margin-top:10px"></div>
								<div class="informasibox" style="margin-top:10px;height:24px;border-radius:10px 10px 0px 0px;width:100%; background-color:#DD8888; text-align:center;">
									<label>Daftar Medali yang sudah ada</label>
								</div>
								<div class="row" id="datatable" style="margin:0;padding: 0 5px;background-color:#DD8888;">
								</div>
								<div id="button-table" style="background-color:#DD8888">
								Ekspor data ke : 
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="modal-hapus" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm modal-vertical-centered">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title">Peringatan</h4>
					</div>
					<div class="modal-body">
					<p>Anda yakin akan menghapus data Medali ini ?</p>
					</div>
					<div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Batal</button> <button type="button" class="btn btn-danger" id="hapus-data">Hapus!</button>
					</div>
				</div>
			</div>
		</div>
	<script type="text/javascript">
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
		$("#input-medali").submit(function(event) {
			/* stop form from submitting normally */
			event.preventDefault();
			$('#alert-input-failed').empty();
	
	      /* get some values from elements on the page: */
			var $form = $( this );
	 		var url = $form.attr( 'action' );
	          
	 		if ($('#emas').val()=="" || $('#city_list').val()==0 || $('#perak').val()=="" || $('#perunggu').val()=="" ||$('#kejuaraan').val()=="") {
	     		if($('#emas').val()==""){
	        		$('#alert-input-failed').append('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;<\/a>Silakan isi jumlah medali emas.<\/div>');
			  	} 
			  	if($('#perak').val()==""){
	        		$('#alert-input-failed').append('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;<\/a>Silakan isi jumlah medali perak.<\/div>');
			  	}
			  	if($('#perungg').val()==""){
	        		$('#alert-input-failed').append('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;<\/a>Silakan isi jumlah medali perunggu.<\/div>');
			  	}
			  	if($('#kejuaraan').val()==""){
	        		$('#alert-input-failed').append('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;<\/a>Silakan pilih kejuaraan.<\/div>');
			  	}
				if($('#city_list').val()==0){
					$('#alert-input-failed').append('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;<\/a>Silakan pilih propinsi.<\/div>');
	       	}
			
			
			} else {                   	
		   	var posting = $.ajax({
					url: url, // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					success: function(data)   // A function to be called if request succeeds
					{
						$('#alert-input-success').fadeTo(2000, 500).slideUp(500).html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;<\/a>Data berhasil ditambah.<\/div>');
		  
					}
				});
		
		      /* Alerts the results */
				posting.done(function( data ) {
					propinsiValue = $('#city_list').val();
		     		$.ajax({url: '<?php echo $url_rewrite.'core/input_medali/read_all_medali.php'; ?>',
		       		type: 'POST',
		        		data: {id_propinsi:propinsiValue},
		        		success: function(output) {
		        			var op=JSON.parse(output);
		              	//alert(output);
		             	table.clear().draw(false);
		              	if (op!=null) {
		                	//alert("op not null");
		                	table.rows.add(op).draw(false);
		             	} 
		     			},
		       		error: function (xhr, ajaxOptions, thrownError) {
		           		alert(xhr.status + " "+ thrownError);
		         	}});
						$('#emas').val('');
		      		$('#perak').val('');
		       		$('#perunggu').val('');
		    	});
			}
		});
	
		function format ( d ) {
			// `d` is the original data object for the row
			var tableString = '<form id="update-medali-'+d[0] +'" action="<?php echo $url_rewrite.'core/input_medali/update_medali.php'; ?>" method="POST">'+
				'<div class="row">'+
											
					'<div class="col-md-4">'+
						'<select id="city_list-update-'+d[0] +'"  name="propinsi-update-'+d[0] +'" class="form-control">'+
			    			'<option selected="selected" data-latlng="[-1.5, 117]" id="valid2" value="0">Pilih Propinsi<\/option>'+
			         	'<option data-latlng="[4.359558, 96.934570]" value="1">Nanggroe Aceh Darussalam<\/option>'+
			           	'<option data-latlng="[2.264792,99.219727]" value="3" >Sumatera Utara<\/option>'+
			        		'<option data-latlng="[-0.973342,100.066002]" value="27" >Sumatera Barat<\/option>'+
			        		'<option data-latlng="[0.312010,101.582001]" value="26">Riau<\/option>'+
			          	'<option data-latlng="[-1.654310,102.790001]" value="28">Jambi<\/option>'+
			          	'<option data-latlng="[-3.245820,104.228996]" value="29">Sumatera Selatan<\/option>'+
			          	'<option data-latlng="[-3.837950,102.251999]" value="33">Bengkulu<\/option>'+
			          	'<option data-latlng="[-5.009961,105.152344]" value="31">Lampung<\/option>'+
			          	'<option data-latlng="[-2.715901,106.557495]" value="30">Bangka Belitung<\/option>'+
			          	'<option data-latlng="[3.829178,108.131836]" value="2">Kepulauan Riau<\/option>'+
			          	'<option data-latlng="[-6.211278,106.842316]" value="5">DKI Jakarta<\/option>'+
			           	'<option data-latlng="[-6.932970,107.602295]" value="6">Jawa Barat<\/option>'+
			          	'<option data-latlng="[-7.161940,110.184082]" value="7">Jawa Tengah<\/option>'+
			           	'<option data-latlng="[-7.894941,110.432373]" value="8">DI. Yogyakarta<\/option>'+
			          	'<option data-latlng="[-7.761069,112.645020]" value="9">Jawa Timur<\/option>'+
			           	'<option data-latlng="[-6.451230,106.112000]" value="4">Banten<\/option>'+
			           	'<option data-latlng="[-8.408255,115.170776]" value="10">Bali<\/option>'+
			           	'<option data-latlng="[-8.696155,117.499878]" value="11">Nusa Tenggara Barat<\/option>'+
			           	'<option data-latlng="[-8.647282,121.097900]" value="12">Nusa Tenggara Timur<\/option>'+
			           	'<option data-latlng="[0.129638,111.106934]" value="13">Kalimantan Barat<\/option>'+
			           	'<option data-latlng="[-1.518133,113.425049]" value="14">Kalimantan Tengah<\/option>'+
			           	'<option data-latlng="[-3.043977,115.479492]" value="15">Kalimantan Selatan<\/option>'+
			           	'<option data-latlng="[1.656507,116.545166]" value="19">Kalimantan Timur<\/option>'+
			           	'<option data-latlng="[0.678940,124.235596]" value="22">Sulawesi Utara<\/option>'+
			           	'<option data-latlng="[-1.430271,121.445068]" value="20">Sulawesi Tengah<\/option>'+
			           	'<option data-latlng="[-3.598949,120.247559]" value="16">Sulawesi Selatan<\/option>'+
			           	'<option data-latlng="[-4.129477,122.148193]" value="18">Sulawesi Tenggara<\/option>'+
			           	'<option data-latlng="[0.678940,122.455811]" value="21">Gorontalo<\/option>'+
			           	'<option data-latlng="[-2.183553,119.324707]" value="17">Sulawesi Barat<\/option>'+
			   			'<option data-latlng="[-3.320404,130.126465]" value="24">Maluku<\/option>'+
			   			'<option data-latlng="[1.423683,127.687500]" value="23">Maluku Utara<\/option>'+
			           	'<option data-latlng="[-2.067178,132.585205]" value="25">Papua Barat<\/option>'+
			           	'<option data-latlng="[-4.385847,138.177246]" value="32">Papua<\/option>'+
			           	'<\/select>'+
					'<\/div>'+
					'<div class="col-md-4 text-center">'+  
						'<select required="required" id="cabor-update-'+d[0] +'" name="cabor-update-'+d[0] +'" class="cabor form-control" style="width:230px; height:34px;margin : 0 auto">'+
							caborOutput +						
						'<\/select>'+  
					'<\/div>'+  
					'<div class="col-md-4">'+  
						'<select class="form-control" id="tahun-update-'+d[0] +'" name="tahun-update-'+d[0] +'">'+  
							'<option value="0">Tahun<\/option>'+  
				      	'<option value="2015">2015<\/option>'+  
				      	'<option value="2014">2014<\/option>'+  
				      	'<option value="2013">2013<\/option>'+  
				      	'<option value="2012">2012<\/option>'+  
				      	'<option value="2011">2011<\/option>'+  
				      	'<option value="2010">2010<\/option>'+  
				      	'<option value="2009">2009<\/option>'+  
				      	'<option value="2008">2008<\/option>'+  
				      	'<option value="2007">2007<\/option>'+  
				      	'<option value="2006">2006<\/option>'+  
				      	'<option value="2005">2005<\/option>'+  
				      	'<option value="2004">2004<\/option>'+  
				      	'<option value="2003">2003<\/option>'+  
				      	'<option value="2002">2002<\/option>'+  
				      	'<option value="2001">2001<\/option>'+  
				      	'<option value="2000">2000<\/option>'+  
				     ' <\/select>'+  
					'<\/div>'+  
					
				'<\/div>'+   		
	   		
	   		'<div class="row" style="margin-top: 20px">'+
	   		'<div class="col-md-3">'+
					'<div class="form-group">'+
				      '<label for="email">Emas :<\/label>'+
				      '<input type="number" class="form-control" id="emas-update-'+d[0] +'" name="emas-update-'+d[0] +'" size="3" >'+
				    '<\/div>'+
				'<\/div>'+
				'<div class="col-md-3">'+
					'<div class="form-group">'+
				      '<label for="email">Perak :<\/label>'+
				      '<input type="number" class="form-control" id="perak-update-'+d[0] +'" name="perak-update-'+d[0] +'" size="3">'+
				    '<\/div>'+
				'<\/div>'+
				'<div class="col-md-3">'+
					'<div class="form-group">'+
				      '<label for="email">Perunggu :<\/label>'+
				      '<input type="number" class="form-control" id="perunggu-update-'+d[0] +'" name="perunggu-update-'+d[0] +'" size="3">'+
				   '<\/div>'+
				'<\/div>'+
				'<div class="col-md-3">'+
					'<div class="form-group">'+
				      '<label for="email">Kejuaraan :<\/label>'+
				      '<select class="form-control" id="kejuaraan-update-'+d[0] +'" name="kejuaraan-update-'+d[0] +'">'+
				      	'<option value="0">kejuaraan daerah<\/option>'+
				      	'<option value="1">kejuaraan nasional<\/option>'+
				      '<\/select>'+
				   '<\/div>'+
				'<\/div>'+
				
				
	   		'<\/div>'+
	   		
	   		'<div class="row" style="margin-top:20px">'+
	   			'<div class="col-md-6">'+
	            '<td colspan="3"><div class="text-center"><input type="submit" value="Update" style="width:110px; height:34px;" class="btn btn-primary"><\/div><\/td>'+
					'<\/div>'+
					'<div class="col-md-6">'+      		
	      		'<td colspan="3"><div class="text-center"><input id="hapus-'+ d[0] +'" value="Hapus" style="width:110px; height:34px;" class="btn btn-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"><\/span><\/div><\/td>'+
					'<\/div>'+
				'<\/div>'+
			'<div id="alert-update-'+d[0] +'" width="100%"><\/div>'+
	 		'<\/form>';
	    
	    	return tableString
		}
	</script>
	<?php include "view/foot.php";?>
	</body>
</html>
