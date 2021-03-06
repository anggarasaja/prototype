<!DOCTYPE html>
<html>
	<head>
		<meta name="generator" content="Bluefish 2.2.6" >
		<meta name="generator" content="Bluefish 2.2.6" >
		<?php include "view/head.php";?>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&libraries=visualization,places&language=id"></script>
		<script type="text/javascript">
			var map;
			var propinsiValue;
			//var caborOutput;
			var table;
			var marker;
		   var markers = [];
			function pageLoad(){
				propinsiValue = $('#city_list').val()        	
		        	
				$('#datatable').html( '<table cellpadding="10" cellspacing="5" border="0" class="table table-striped table-hover" width="100%" id="dataTablesSarpras"><\/table>' );
				//load data ke dalam datatables				
				$.ajax({url: '<?php echo $url_rewrite.'core/input_sarpras/read_all_sarpras.php'; ?>',
					type: 'POST',
					data: {id_propinsi:0},
					success: function(output) {
						var op=JSON.parse(output);
						table = $('#dataTablesSarpras').DataTable( {
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
								{ "title": "Nama" },
								{ "title": "Propinsi" },
				            { "title": "Alamat" },
				            { "title": "Latitude", },
				            { "title": "Longitude", },
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
				autocomplete = new google.maps.places.Autocomplete((document.getElementById('autocomplete')),
        { 
          types: ['geocode'],
          componentRestrictions: {country: "ID"} 
        });  
				map = new google.maps.Map(document.getElementById('gmap_city'),
				{
					zoom: 5,
		  			mapTypeId: google.maps.MapTypeId.ROADMAP,
		 			center: new google.maps.LatLng(-1.5,117)
		   	});
				google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
          return;
        }
        if (place.geometry.viewport) {
          map.fitBounds(place.geometry.viewport);
          map.setCenter(place.geometry.location);
          map.setZoom(13);
        }
        else {
          map.setCenter(place.geometry.location);
          map.setZoom(15);  // Why 17? Because it looks good.
        }
        placeMarker(place.geometry.location);
        $('#lat').val(place.geometry.location.lat());
        $('#lng').val(place.geometry.location.lng());
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
				$.ajax({
			type:"POST",
			url : "../../ajax/load_sarpras.php",
			dataType: 'json',
			success: function (atlet) {			
				setMarkers(atlet);	
			}
		});
				$('.cabor').html('<option value="">--Loading--<\/option>');
				$.ajax({url: "<?php echo $url_rewrite.'core/input_sarpras/read_cabor.php'; ?>",
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
					$.ajax({url: '<?php echo $url_rewrite.'core/input_sarpras/read_all_sarpras.php'; ?>',
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
					$.ajax({url: '<?php echo $url_rewrite.'core/input_sarpras/read_all_sarpras.php'; ?>',
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
					$.ajax({url: '<?php echo $url_rewrite.'core/input_sarpras/read_all_sarpras.php'; ?>',
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
		        	nama_row = row.data()[1];
		        	alamat_row = row.data()[3];
		        	lat_row = row.data()[4];
		        	lng_row = row.data()[5];
		        	propinsi_row = row.data()[2];
		                               
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
		            
		                       
		            var value2 = $("#city_list-update-"+id_row +" option").filter(function() {
		            	return $(this).text() == propinsi_row;
		            }).first().attr("value");
      
		            $("#city_list-update-"+id_row +"").val(value2);
		            
		            $("#nama-sarpras-update-"+id_row +"").val(nama_row);
		            $("#alamat-update-"+id_row +"").val(alamat_row);
		            $("#lat-update-"+id_row +"").val(lat_row);
		            $("#lng-update-"+id_row +"").val(lng_row);
                     
		            $('#update-sarpras-'+id_row +'').submit(function(event) {
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
			 	          		$.ajax({url: '<?php echo $url_rewrite.'core/input_sarpras/read_all_sarpras.php'; ?>',
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
				
								$.ajax({url: '<?php echo $url_rewrite.'core/input_sarpras/delete_sarpras.php'; ?>',
				           		type: 'POST',
				           		data: {id_sarpras:id_row},
				           		success: function(output) {
				             	//alert(output);
				          			$.ajax({url: '<?php echo $url_rewrite.'core/input_sarpras/read_all_sarpras.php'; ?>',
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
		     
	function createMarkers(namatlet, lat, lon) {
		var image = {
   		url: '../../icon/sarpras.png',
  		};
		var newmarker = new google.maps.Marker({
     		position: new google.maps.LatLng(lat, lon),
     		map: map,
     		icon: image
   	});
   	markers.push(newmarker); 
   	newmarker['infowindow'] = new google.maps.InfoWindow({
    		content: namatlet
    	});
    	google.maps.event.addListener(newmarker, 'mouseover', function() {
      	this['infowindow'].open(map, this);
    	});
    	google.maps.event.addListener(newmarker, 'mouseout', function() {
      	this['infowindow'].close();
    	});
	}

	function setMarkers(locations) {
		for (var i = 0; i < locations.length; i++) {
   		var beach = locations[i];
   		createMarkers(beach[0], beach[1], beach[2]);
   	}
		var mcOptions = {gridSize: 50, maxZoom: 7};
   	var mc = new MarkerClusterer(map, markers, mcOptions);
	}   
		</script>
		<title>Input Sarpras</title>
	</head>
	<body onload="pageLoad()">
		<div id="wrapper">
			<?php include "view/default/right_menu.php";?>
			<div id="page-wrapper" style="min-height:850px;">
				<div class="row">
					<div class="col-lg-12" style="margin-bottom:-20px;"><label class="page-header title-page" style="background-color:whitesmoke;">Input Data Sarpras</label></div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="panel">
							<div class="panel-body">
								<div id="gmap_city" class="rounded-map"></div>
								<div id="alert-input-failed"></div>
								<div id="alert-input-success"></div>
								<div id="inputSarpras" class="input-box">
									<form class="form-horizontal" id="input-sarpras" action="<?php echo $url_rewrite.'core/input_sarpras/input_sarpras_controller.php'; ?>" method="post">
										<div class="row">
											
											<div class="col-md-12">
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
										</div>
										<div class="row" style="margin-top:25px">
											<div class="col-md-6">
												<div class="form-group">
											      <label for="nama" class="col-md-3">Nama :</label>
											      <div class="col-md-9">
											      	<input type="text" class="form-control" id="nama" name="nama">
											      </div>
											    </div>
											    
											    <div class="form-group">
											      <label for="email" class="col-md-3">Alamat :</label>
											      <div class="col-md-9">
											      	<textarea class="form-control" rows="2" tabindex="1" required="required" id="autocomplete" name="alamat" onFocus="geolocate()" style="resize: none;"></textarea>
											      </div>
											    </div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
											      <label for="email" class="col-md-3">Latitude :</label>
											      <div class="col-md-9">
											      <input type="text" class="form-control" id="lat" name="lat">
											      </div>
											    </div>
											    <div class="form-group">
											      <label for="email" class="col-md-3">Longitude :</label>
											      <div class="col-md-9">
											      <input type="text" class="form-control" id="lng" name="lng">
											      </div>
											    </div>
											</div>
											
											
											
											
										</div>
										<div class="row">
											<div class="col-md-6 text-center">
												
												
											</div>
											<div class="col-md-6 text-center">
											<input type="reset" style="width:110px; height:34px;margin:auto 10px" value="Reset" class="btn btn-warning">
												<input type="submit" style="width:110px; height:34px;margin:auto 10px" value="Submit" class="btn btn-primary">
											      											
											</div> 
										</div>
										<hr>
										
									</form>
								</div>
								<div id="alert-hapus" style="margin-top:10px"></div>
								<div id="alert-update" style="margin-top:10px"></div>
								<div class="informasibox" style="margin-top:10px;height:24px;border-radius:10px 10px 0px 0px;width:100%; background-color:whitesmoke; text-align:center;">
									<label>Daftar Sarpras yang sudah ada</label>
								</div>
								<div class="row" id="datatable" style="margin:0;padding: 0 5px;background-color:whitesmoke;">
								</div>
								<div id="button-table" style="background-color:whitesmoke">
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
					<p>Anda yakin akan menghapus data Sarana Dan Prasarana ini ?</p>
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
		$("#input-sarpras").submit(function(event) {
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
		     		$.ajax({url: '<?php echo $url_rewrite.'core/input_sarpras/read_all_sarpras.php'; ?>',
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
			var tableString = '<form id="update-sarpras-'+d[0] +'" action="<?php echo $url_rewrite.'core/input_sarpras/update_sarpras.php'; ?>" method="POST">'+
    '<table cellpadding="5" cellspacing="0" border="0"  class="table" style="padding-left:50px;border: 0;">'+
        
        '<tr>'+
        		'<td style="padding : 10px">Nama</td><td style="padding:10px 20px 10px 20px;">:</td>'+
            '<td><input tabindex="1"  style="width:230px; height:34px;" type="text" name="nama-sarpras-update-'+d[0] +'" id="nama-sarpras-update-'+d[0] +'" class="form-control" ></td>'+
      		
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
        						'<option data-latlng="[-2.715901,106.557495]" value="30">Bangka Belitung</option>'+
       						'<option data-latlng="[3.829178,108.131836]" value="2">Kepulauan Riau</option>'+
       						'<option data-latlng="[-6.211278,106.842316]" value="5">DKI Jakarta</option>'+
        						'<option data-latlng="[-6.932970,107.602295]" value="6">Jawa Barat</option>'+
       						'<option data-latlng="[-7.161940,110.184082]" value="7">Jawa Tengah</option>'+
       						'<option data-latlng="[-7.894941,110.432373]" value="8">DI. Yogyakarta</option>'+
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
        						'<option data-latlng="[-2.067178,132.585205]" value="25">Papua Barat</option>'+
        						'<option data-latlng="[-4.385847,138.177246]" value="32">Papua</option>'+
							'</select>'+
            '</td>'+
  
        '</tr>'+
        '<tr>'+
            '<td  style="padding : 10px">Alamat</td><td style="padding:10px 20px 10px 20px;">:</td>'+
            '<td colspan="4"><textarea style="width:100%" class="form-control" id="alamat-update-'+d[0] +'" name="alamat-update-'+d[0] +'"></textarea></td>'+
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
	<?php include "view/foot.php";?>
	</body>
</html>
