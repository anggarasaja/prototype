<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>GIS Kemenpora V2</title>
		<meta name="description" content="Geographic Information System Kemenpora V2" />
		<meta name="keywords" content="Sistem Informasi Geografi, SIG, Geographic Information System, GIS, Kemenpora" />
		<meta name="author" content="root-x" />
		<link rel="shortcut icon" href="icon/icon.png">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		
		<script src="js/modernizr.custom.js"></script>
		<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&libraries=visualization,places&language=id"></script>
		<script type="text/javascript" src="js/markerclusterer.js"></script>
		
		<script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
   		<link href="//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.css">
    	<script src="//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script>
				<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
		<style type="text/css">
			html, body{
				height:100%;
				width: 100%;
			}
			ul li a:hover select{
				text-decoration: none;
				color:#5f6f81;
			}
		</style>
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		
		<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
		<!-- morris -->
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

		<script>

		var map;
		var markers = [];
		var heatmaps = [];
		var heatmap;
		var markCluster;
		var chartMedali;
		var decodedDataChart;
		var decodedDataTable;
		var table;
		var autocomplete;

		function HybridControl(controlDiv, map) {
	  		controlDiv.style.paddingTop = '5px';
	  		controlDiv.style.marginRight = '-6px';
			var controlUI = document.createElement('div');
  			controlUI.style.backgroundColor = 'white';
  			controlUI.style.borderStyle = 'solid';
  			controlUI.style.borderWidth = '1px';
  			controlUI.style.borderColor = '#BBBBBB';
  			controlUI.style.cursor = 'pointer';
  			controlUI.style.textAlign = 'center';
  			controlUI.title = 'Click to set the map to Home';
  			controlDiv.appendChild(controlUI);
			var controlText = document.createElement('div');
  			controlText.style.fontFamily = 'Arial,sans-serif';
  			controlText.style.fontSize = '12px';
  			controlText.style.paddingLeft = '4px';
  			controlText.style.paddingRight = '4px';
  			controlText.style.paddingTop = '1px';
  			controlText.style.paddingBottom = '1px';
  			controlText.innerHTML = 'Hybrid';
  			controlUI.appendChild(controlText);
			google.maps.event.addDomListener(controlUI, 'click', function() {
    			map.setMapTypeId(google.maps.MapTypeId.HYBRID)
  			});
		}

		function TransControl(controlDiv, map) {
  			controlDiv.style.paddingTop = '5px';
	  		controlDiv.style.marginRight = '-1px';
			var controlUI = document.createElement('div');
  			controlUI.style.backgroundColor = 'white';
  			controlUI.style.borderStyle = 'solid';
  			controlUI.style.borderWidth = '1px';
  			controlUI.style.borderColor = '#BBBBBB';
  			controlUI.style.cursor = 'pointer';
  			controlUI.style.textAlign = 'center';
  			controlUI.title = 'Click to set the map to Home';
  			controlDiv.appendChild(controlUI);
			var controlText = document.createElement('div');
  			controlText.style.fontFamily = 'Arial,sans-serif';
  			controlText.style.fontSize = '12px';
  			controlText.style.paddingLeft = '4px';
  			controlText.style.paddingRight = '4px';
  			controlText.style.paddingTop = '1px';
  			controlText.style.paddingBottom = '1px';
  			controlText.innerHTML = 'Transportation';
  			controlUI.appendChild(controlText);
			google.maps.event.addDomListener(controlUI, 'click', function() {
    			var trafficLayer = new google.maps.TrafficLayer();
  				trafficLayer.setMap(map);
  			});
		}
		
		function pageLoad(){
			autocomplete = new google.maps.places.Autocomplete((document.getElementById('autocomplete')),
      		{ 
      			types: ['geocode'],
      			componentRestrictions: {country: "ID"} 
      		});
  			map = new google.maps.Map(document.getElementById('gmap_city'),
  		   {
      		zoom: 5,
      	 	mapTypeId: google.maps.MapTypeId.HYBRID
 		   });
 		   	google.maps.event.addListener(autocomplete, 'place_changed', function() {
				var place = autocomplete.getPlace();
			    if (!place.geometry) {
			      return;
			    }

			    if (place.geometry.viewport) {
			      map.fitBounds(place.geometry.viewport);
          		  map.setCenter(place.geometry.location);
          		  map.setZoom(10);
			    } else {
			      map.setCenter(place.geometry.location);
			      map.setZoom(15);  // Why 17? Because it looks good.
			    }
			    map.setPosition(place.geometry.location);
		  	});   
 		   var hybridControlDiv = document.createElement('div');
  			var hybridControl = new HybridControl(hybridControlDiv, map);
  			hybridControlDiv.index = 1;
  			map.controls[google.maps.ControlPosition.TOP_RIGHT].push(hybridControlDiv);
  			
  			var transControlDiv = document.createElement('div');
  			var transControl = new TransControl(transControlDiv, map);
  			transControlDiv.index = 1;
  			map.controls[google.maps.ControlPosition.TOP_RIGHT].push(transControlDiv);
			
 		   map.setOptions({draggable: true, zoomControl: true, scrollwheel: false, disableDoubleClickZoom: true});
 		   
			$.ajax({
				type:"POST",
				url : "ajax/load_atlet.php",
				dataType: 'json',
				data: {year:$('#year_list').val()},
				success: function (atlet) {
					setMarkers(atlet);	
				}
			});
			$('#year_list').change(function() {
				if (typeof heatmap != "undefined"){
					heatmap.setMap(null);
				}
				$.ajax({
					type:"POST",
					url : "ajax/load_atlet.php",
					dataType: 'json',
					data: {year:$('#year_list').val()},
					success: function (atlet) {			
						setMapOnAll();		
						setMarkers(atlet);	
					}
				});
			});
			$('#cabor_list').click(function() {
				heatmap.setMap(null);
			});
			$('input[name="kejuaraan"]').click(function() {
				heatmap.setMap(null);
			});

			$('#cabor_list').change(function(e) {		
				var selectvalue = $(this).val();
				var yearCab = $('#year_list').val();
				var valueCab = $('option:selected',this).val();
				var kejuaraanCab = $('input[name="kejuaraan"]:checked').val();
				$.ajax({url: "ajax/load_potensi.php",
      			type: 'POST',
      			data: {id_cabor:valueCab,year:yearCab, kejuaraan : kejuaraanCab},
      			success: function(output) {
      				var decodedData = $.parseJSON(output);
      				
      				//alert(decodedData.html_string);
      			   $("#details").html(decodedData.html_string);
		      		$.ajax({
							type:"POST",
							url : "ajax/load_heatmaps.php",
							dataType: 'json',
							data: {id:decodedData.id_propinsi},
							success: function (heat) {			
								setHeatmaps(heat);	
							}
						});
						
      			   //alert(output);
      			   $.ajax({url: "ajax/load_chart.php",
		      			type: 'POST',
		      			data: {id_cabor:valueCab, id_propinsi:decodedData.id_propinsi, kejuaraan : kejuaraanCab},
		      			success: function(output) {
		      				decodedDataChart = $.parseJSON(output);
		      				
		      				

		     			   },
		     				error: function (xhr, ajaxOptions, thrownError) {
		    			      alert(xhr.status + " "+ thrownError);
		    			}});
		    			
		    			$.ajax({url: "ajax/load_datatable_potensi.php",
		      			type: 'POST',
		      			data: {id_propinsi:decodedData.id_propinsi, kejuaraan : kejuaraanCab},
		      			success: function(output) {
		      				decodedDataTable = $.parseJSON(output);
		      				
		      				

		     			   },
		     				error: function (xhr, ajaxOptions, thrownError) {
		    			      alert(xhr.status + " "+ thrownError);
		    			}});
     			   },
     				error: function (xhr, ajaxOptions, thrownError) {
    			      alert(xhr.status + " "+ thrownError);
    			}});
    			
				
			});

			$('#year_list').change(function(e) {
				if ($("#cabor_list").val() != 0) {

				var selectvalue = $(this).val();
				var yearCab = $('option:selected',this).val();
				var valueCab = $('#cabor_list').val();
				var kejuaraanCab = $('input[name="kejuaraan"]:checked').val();
				$.ajax({url: "ajax/load_potensi.php",
      			type: 'POST',
      			data: {id_cabor:valueCab,year:yearCab, kejuaraan : kejuaraanCab},
      			success: function(output) {
      				var decodedData = $.parseJSON(output);
      				//alert(decodedData.html_string);
      			   $("#details").html(decodedData.html_string);
		      		$.ajax({
							type:"POST",
							url : "ajax/load_heatmaps.php",
							dataType: 'json',
							data: {id:decodedData.id_propinsi},
							success: function (heat) {			
								setHeatmaps(heat);	
							}
						});
						
      			   //alert(output);
      			   $.ajax({url: "ajax/load_chart.php",
		      			type: 'POST',
		      			data: {id_cabor:valueCab, id_propinsi:decodedData.id_propinsi, kejuaraan : kejuaraanCab},
		      			success: function(output) {
		      				decodedDataChart = $.parseJSON(output);
		      				
		      				

		     			   },
		     				error: function (xhr, ajaxOptions, thrownError) {
		    			      alert(xhr.status + " "+ thrownError);
		    			}});
		    			
		    			$.ajax({url: "ajax/load_datatable_potensi.php",
		      			type: 'POST',
		      			data: {id_propinsi:decodedData.id_propinsi, kejuaraan : kejuaraanCab},
		      			success: function(output) {
		      				decodedDataTable = $.parseJSON(output);
		      				
		      				

		     			   },
		     				error: function (xhr, ajaxOptions, thrownError) {
		    			      alert(xhr.status + " "+ thrownError);
		    			}});
     			   },
     				error: function (xhr, ajaxOptions, thrownError) {
    			      alert(xhr.status + " "+ thrownError);
    			}});
				}
			});
			
			$('input[name="kejuaraan"]').click(function(e) {		
				var selectvalue = $(this).val();
				var yearCab = $('#year_list').val();
				var valueCab = $('#cabor_list').val();
				var kejuaraanCab = $(this).val();
				$.ajax({url: "ajax/load_potensi.php",
      			type: 'POST',
      			data: {id_cabor:valueCab,year:yearCab, kejuaraan : kejuaraanCab},
      			success: function(output) {
      				var decodedData = $.parseJSON(output);
      			   $("#details").html(decodedData.html_string);
      			   
		      		$.ajax({
							type:"POST",
							url : "ajax/load_heatmaps.php",
							dataType: 'json',
							data: {id:decodedData.id_propinsi},
							success: function (heat) {			
								setHeatmaps(heat);	
							}
						});
						
      			   //alert(output);
      			   $.ajax({url: "ajax/load_chart.php",
		      			type: 'POST',
		      			data: {id_cabor:valueCab, id_propinsi:decodedData.id_propinsi, kejuaraan : kejuaraanCab},
		      			success: function(output) {
		      				decodedDataChart = $.parseJSON(output);
		      				
		      				

		     			   },
		     				error: function (xhr, ajaxOptions, thrownError) {
		    			      alert(xhr.status + " "+ thrownError);
		    			}});
		    			
		    			$.ajax({url: "ajax/load_datatable_potensi.php",
		      			type: 'POST',
		      			data: {id_propinsi:decodedData.id_propinsi, kejuaraan : kejuaraanCab},
		      			success: function(output) {
		      				decodedDataTable = $.parseJSON(output);
		      				
		      				

		     			   },
		     				error: function (xhr, ajaxOptions, thrownError) {
		    			      alert(xhr.status + " "+ thrownError);
		    			}});
     			   },
     				error: function (xhr, ajaxOptions, thrownError) {
    			      alert(xhr.status + " "+ thrownError);
    			}});
    			
				
			});
			
			$.ajax({
				type:"POST",
				url : "ajax/load_knpi.php",
				dataType: 'json',
				success: function (knpi) {			
					setMarkersknpi(knpi);	
				}
			});
			$.ajax({
				type:"POST",
				url : "ajax/load_sarpras.php",
				dataType: 'json',
				success: function (sarpras) {			
					setMarkerssarpras(sarpras);	
				}
			});
			$.ajax({
				type:"POST",
				url : "ajax/load_pelopor.php",
				dataType: 'json',
				success: function (pelopor) {			
					setMarkerspelopor(pelopor);	
				}
			});
			$.ajax({
				type:"POST",
				url : "ajax/load_ppikor.php",
				dataType: 'json',
				success: function (ppikor) {			
					setMarkersppikor(ppikor);	
				}
			});
			
			$.ajax({url: "ajax/load_cabor.php",
	   	success: function(output) {
         	loadCabor = output;
            $('#cabor_list').html(loadCabor);
         },
         error: function (xhr, ajaxOptions, thrownError) {
         	alert(xhr.status + " "+ thrownError);
         }
     		});
			
			map.data.loadGeoJson('json/indonesia_kab.json');
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
  			map.data.addListener('click', function(event) {
    			lettermap =	event.feature.getProperty('letter');
    			wilayah =	event.feature.getProperty('wilayah');
    			status =	event.feature.getProperty('status');
				details.innerHTML = '<h2 style="margin-bottom:30px; margin-top:0px;">Propinsi</h2><table>'+
				'<tr><td>Nama propinsi</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+lettermap+'</td></tr>'+
				'<tr><td>Nama wilayah</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+status+' '+wilayah+'</td></tr></table>'
        	});
	    	$('#city_list').change(function(){
      		var coordinate = $('option:selected',this).data('latlng')
        		map.panTo(new google.maps.LatLng(coordinate[0],coordinate[1]));
        		if (coordinate == '-1.5,117') {
        			map.setZoom(5);
        		}
        		else if (coordinate == '-6.211278,106.842316') {
        			map.setZoom(11);
        		}
        		else {
        			map.setZoom(8);
        		}
        		
   		}).trigger('change');
   		
   		$('#enablelayer').click(function(){
    			if (this.checked) {
        			map.data.setMap(map);
    			}
    			else {
    				map.data.setMap(null);
    			}
			});
			$("#aboutus").click(function(){
   			alert("Nama Tim\n\n- Andreas Hadiyono\n- Haris Anggara\n- Yohanes Christomas Daimler");
  			});
  			$("#cabor_list").change(function(){
  				
			});
			//var pointArray = new google.maps.MVCArray(taxiData);
  			//heatmap = new google.maps.visualization.HeatmapLayer({
    		//	data: pointArray
  			//});
  			//heatmap.setMap(map);
  			
      	chartMedali = Morris.Line({
			  element: 'chart-medali',
			  xkey: 'y',
			  ykeys: ['emas', 'perak', 'perunggu'],
			  labels: ['Emas', 'Perak', 'Perunggu'],
			  lineColors: ['red', 'green', 'blue']
			});
		
			//datatables
			$('#datatable').html( '<table cellpadding="10" cellspacing="5" border="0" class="table table-striped table-hover" width="inherit" id="dataTablesPotential"></table>' );
         	table = $('#dataTablesPotential').DataTable( {
         		"lengthMenu": [[5, 10, -1], [5, 10, "All"]],
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
						{ "title": "Cabang Olahraga" },
            		{ "title": "Tahun" },
            		{ "title": "Emas" },
            		{ "title": "Perak" },
            		{ "title": "Perunggu", "class": "center" }
        			]
				});
 
		}
		function setMapOnAll() {
			markCluster.setMap(null);
			markCluster.clearMarkers();
			for (var i = 0; i < markers.length; i++) {
				markers[i].setMap(null);
			}
            markers.length = 0;
		}
		function createMarkers(namatlet, lat, lon, jkel, cabor, prop, pel) {
			var image = {
    			url: 'icon/diamond.png',
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
      	google.maps.event.addListener(newmarker, 'click', function() {
					details.innerHTML = '<h2 style="margin-bottom:30px; margin-top:0px;">Profil Atlet</h2><table>'+
					'<tr><td>Nama Atlet</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+namatlet+'</td></tr>'+
					'<tr><td>Jenis Kelamin</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+jkel+'</td></tr>'+
					'<tr><td>Cabang Olahraga</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+cabor+'</td></tr>'+
					'<tr><td>Propinsi</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+prop+'</td></tr>'+
 					'<tr><td>Nama Pelatih</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+pel+'</td></tr></table>';
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
    			createMarkers(beach[0], beach[1], beach[2],beach[3],beach[4],beach[5],beach[6]);
    		}
		var mcOptions = {gridSize: 50, maxZoom: 7};
   		markCluster = new MarkerClusterer(map, markers, mcOptions);
   		$('#atlet').click(function(){
    			if (this.checked) {
        			markCluster.addMarkers(markers);
    			}
    			else {
    				markCluster.clearMarkers();
    			}
			});
			$('#toggleall').click(function(){
    			if (this.checked) {
        			markCluster.addMarkers(markers);
    			}
    			else {
    				markCluster.clearMarkers();
    			}
			});    		
		}		
		
		function createMarkersknpi(lat, lon, loc) {
			var image = {
    			url: 'icon/knpi.png',
  			};
			var newmarker = new google.maps.Marker({
      		position: new google.maps.LatLng(lat, lon),
        		map: map,
        		icon: image,
        		zIndex: 10
    		});
    		google.maps.event.addListener(newmarker, 'click', function() {
					details.innerHTML = '<h2 style="margin-bottom:30px; margin-top:0px;">KNPI</h2><table>'+
					'<tr><td>Latitude</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+lat+'</td></tr>'+
					'<tr><td>Longitude</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+lon+'</td></tr>'+
 					'<tr><td>Location</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+loc+'</td></tr></table>';
				});
    		$('#knpi').click(function(){
    			if (this.checked) {
        			newmarker.setMap(map);
    			}
    			else {
    				newmarker.setMap(null);
    			}
			});
			$('#toggleall').click(function(){
    			if (this.checked) {
        			newmarker.setMap(map);
    			}
    			else {
    				newmarker.setMap(null);
    			}
			});
		}
					
		function setMarkersknpi(locations) {
			for (var i = 0; i < locations.length; i++) {
    			var beach = locations[i];
    			createMarkersknpi(beach[0], beach[1], beach[2]);
    		}
		}

		function createMarkerssarpras(nam, lat, lon, prp, alm) {
			var image = {
    			url: 'icon/sarpras.png',
  			};
			var newmarker = new google.maps.Marker({
      		position: new google.maps.LatLng(lat, lon),
        		map: map,
        		icon: image,
        		zIndex: 10
    		});
    		google.maps.event.addListener(newmarker, 'click', function() {
					details.innerHTML = '<h2 style="margin-bottom:30px; margin-top:0px;">Sarana Prasarana</h2><table>'+
					'<tr><td>Nama Sarpras</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+nam+'</td></tr>'+
					'<tr><td>Latitude</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+lat+'</td></tr>'+
					'<tr><td>Longitude</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+lon+'</td></tr>'+
					'<tr><td>Propinsi</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+prp+'</td></tr>'+
 					'<tr><td>Alamat</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+alm+'</td></tr></table>';
				});
    		$('#sarpras').click(function(){
    			if (this.checked) {
        			newmarker.setMap(map);
    			}
    			else {
    				newmarker.setMap(null);
    			}
			});
			$('#toggleall').click(function(){
    			if (this.checked) {
        			newmarker.setMap(map);
    			}
    			else {
    				newmarker.setMap(null);
    			}
			});
		}
					
		function setMarkerssarpras(locations) {
			for (var i = 0; i < locations.length; i++) {
    			var beach = locations[i];
    			createMarkerssarpras(beach[0], beach[1], beach[2], beach[3], beach[4]);
    		}
		}

		function createMarkerspelopor(nam, lat, lon, prp, alm) {
			var image = {
    			url: 'icon/pelopor.png',
  			};
			var newmarker = new google.maps.Marker({
      		position: new google.maps.LatLng(lat, lon),
        		map: map,
        		icon: image,
        		zIndex: 10
    		});
    		google.maps.event.addListener(newmarker, 'click', function() {
					details.innerHTML = '<h2 style="margin-bottom:30px; margin-top:0px;">Pelopor Pemuda</h2><table>'+
					'<tr><td>Nama pelopor</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+nam+'</td></tr>'+
					'<tr><td>Latitude</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+lat+'</td></tr>'+
					'<tr><td>Longitude</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+lon+'</td></tr>'+
					'<tr><td>Propinsi</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+prp+'</td></tr>'+
 					'<tr><td>Alamat</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+alm+'</td></tr></table>';
				});
    		$('#pelopor').click(function(){
    			if (this.checked) {
        			newmarker.setMap(map);
    			}
    			else {
    				newmarker.setMap(null);
    			}
			});
			$('#toggleall').click(function(){
    			if (this.checked) {
        			newmarker.setMap(map);
    			}
    			else {
    				newmarker.setMap(null);
    			}
			});
		}
					
		function setMarkerspelopor(locations) {
			for (var i = 0; i < locations.length; i++) {
    			var beach = locations[i];
    			createMarkerspelopor(beach[0], beach[1], beach[2], beach[3], beach[4]);
    		}
		}
		
		function createMarkersppikor(nam, lat, lon, prp, alm) {
			var image = {
    			url: 'icon/ppikor.png',
  			};
			var newmarker = new google.maps.Marker({
      		position: new google.maps.LatLng(lat, lon),
        		map: map,
        		icon: image,
        		zIndex: 10
    		});
    		google.maps.event.addListener(newmarker, 'click', function() {
					details.innerHTML = '<h2 style="margin-bottom:30px; margin-top:0px;">PPIKor Kemenpora</h2><table>'+
					'<tr><td>Nama Pemuda</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+nam+'</td></tr>'+
					'<tr><td>Latitude</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+lat+'</td></tr>'+
					'<tr><td>Longitude</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+lon+'</td></tr>'+
					'<tr><td>Propinsi</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+prp+'</td></tr>'+
 					'<tr><td>Alamat</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+alm+'</td></tr></table>';
				});
    		$('#ppikor').click(function(){
    			if (this.checked) {
        			newmarker.setMap(map);
    			}
    			else {
    				newmarker.setMap(null);
    			}
			});
			$('#toggleall').click(function(){
    			if (this.checked) {
        			newmarker.setMap(map);
    			}
    			else {
    				newmarker.setMap(null);
    			}
			});
		}
					
		function setMarkersppikor(locations) {
			for (var i = 0; i < locations.length; i++) {
    			var beach = locations[i];
    			createMarkersppikor(beach[0], beach[1], beach[2], beach[3], beach[4]);
    		}
		}

		function setHeatmaps(locations) {
			heatmaps = [];
			for (var i = 0; i < locations.length; i++) {
    			var beach = locations[i];
    			createHeatmaps(beach[0], beach[1]);
    		}    		
  			heatmap.setMap(map);
		}
		function createHeatmaps(lat, lon) {			
        	heatmap = new google.maps.visualization.HeatmapLayer({
        		location: new google.maps.LatLng(lat, lon),
    			data: heatmaps
  			});
  			heatmaps.push(heatmap);
		}
					
		function toggle(source) {
  			checkboxes = document.getElementsByClassName('togglebox');
  			for(var i=0, n=checkboxes.length;i<n;i++) {
    			checkboxes[i].checked = source.checked;
  			}
		}
		function geolocate() {
  			if (navigator.geolocation) {
    			navigator.geolocation.getCurrentPosition(function(position) {
      				var geolocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
      				var circle = new google.maps.Circle({
        				center: geolocation,
        				radius: position.coords.accuracy
      				});
      			autocomplete.setBounds(circle.getBounds());
    			});
  			}
		}	
	</script>
	<script type="text/javascript" src="js/searchatlet.js"></script>
	</head>
	<body onload="pageLoad()">
		<div class="container" style="background-color: #5f6f81;">
			<ul id="gn-menu" class="gn-menu-main">
				<li class="gn-trigger">
					<a class="gn-icon gn-icon-menu"><span>Menu</span></a>
					<nav class="gn-menu-wrapper">
						<div class="gn-scroller">
							<ul class="gn-menu">
								<li class="gn-icon gn-icon-search">
									<input placeholder="Search Atlet" type="text" class="gn-search" id="search_atlet" onkeyup="searchtext()" style="padding-left:0; margin-left:-4px; width:70%;"/>
								</li>
								<ul id="search_list_atlet"></ul>
								<li class="gn-icon gn-icon-download">
									<input placeholder="Search Place" type="text" class="gn-search" id="autocomplete" onFocus="geolocate()" style="padding-left:0; margin-left:-4px; width:70%;" />
								</li>
								<li><span class="gn-icon gn-icon-cog"><input id="toggleall" name="Profil Prov" type="checkbox" value="Profil Prov" onclick="toggle(this)" checked="active"> Select All</span>
									<ul class="gn-submenu">
										<li><span style="margin-left:60px; color:#5f6f81;"><input id="atlet" class="togglebox" name="Profil Prov" type="checkbox" value="Profil Prov" checked="active"><img width="14" height="14" src="icon/diamond.png" style="margin-top:-5px;margin-left:4px;"> Atlet</span></li>
										<li><span style="margin-left:60px; color:#5f6f81;"><input id="knpi" class="togglebox" name="KNPI" type="checkbox" value="KNPI" checked="active"><img width="14" height="14" src="icon/knpi.png" style="margin-top:-5px;margin-left:4px;"> Knpi</span></li>
										<li><span style="margin-left:60px; color:#5f6f81;"><input id="sarpras" class="togglebox" name="sarpras" type="checkbox" value="sarpras" checked="active"><img width="14" height="14" src="icon/sarpras.png" style="margin-top:-5px;margin-left:4px;"> Sarana Prasarana</span></li>
										<li><span style="margin-left:60px; color:#5f6f81;"><input id="pelopor" class="togglebox" name="pelopor" type="checkbox" value="pelopor" checked="active"><img width="14" height="14" src="icon/pelopor.png" style="margin-top:-5px;margin-left:4px;"> Pelopor Pemuda</span></li>
										<li><span style="margin-left:60px; color:#5f6f81;"><input id="ppikor" class="togglebox" name="ppikor" type="checkbox" value="ppikor" checked="active"><img width="14" height="14" src="icon/ppikor.png" style="margin-top:-5px;margin-left:4px;"> PPIKor</span></li>
									</ul>
								</li>
								<li><a class="gn-icon gn-icon-article" href="dokumentasi/" target="_blank">Documentation</a></li>								
								<li><a id="aboutus" class="gn-icon gn-icon-help">About Us</a></li>
								<!-- <li><a class="gn-icon gn-icon-archive">Archives</a></li>
								<li><a class="gn-icon gn-icon-cog">Settings</a></li> -->
							</ul>
						</div>
					</nav>
				</li>
				<li><a href="">HOME</a></li>
				<li><a>Quick View
				<select id="city_list" style="border-radius:20px; background-color:white; padding-left:3px;">
					<option selected="selected" data-latlng="[-1.5, 117]" id="valid2">--Peta Indonesia--</option>
					<option data-latlng="[4.359558, 96.934570]" >Nanggroe Aceh Darussalam</option>
               <option data-latlng="[2.264792,99.219727]" >Sumatera Utara</option>
               <option data-latlng="[-0.973342,100.066002]" >Sumatera Barat</option>
               <option data-latlng="[0.312010,101.582001]" >Riau</option>
               <option data-latlng="[-1.654310,102.790001]" >Jambi</option>
               <option data-latlng="[-3.245820,104.228996]" >Sumatera Selatan</option>
               <option data-latlng="[-3.837950,102.251999]" >Bengkulu</option>
               <option data-latlng="[-5.009961,105.152344]" >Lampung</option>
               <option data-latlng="[-2.715901,106.557495]" >Kepulauan Bangka Belitung</option>
               <option data-latlng="[3.829178,108.131836]" >Kepulauan Riau</option>
               <option data-latlng="[-6.211278,106.842316]" >DKI Jakarta</option>
               <option data-latlng="[-6.932970,107.602295]" >Jawa Barat</option>
               <option data-latlng="[-7.161940,110.184082]" >Jawa Tengah</option>
               <option data-latlng="[-7.894941,110.432373]" >Daerah Istimewa Yogyakarta</option>
               <option data-latlng="[-7.761069,112.645020]" >Jawa Timur</option>
               <option data-latlng="[-6.451230,106.112000]" >Banten</option>
               <option data-latlng="[-8.408255,115.170776]" >Bali</option>
               <option data-latlng="[-8.696155,117.499878]" >Nusa Tenggara Barat</option>
               <option data-latlng="[-8.647282,121.097900]" >Nusa Tenggara Timur</option>
               <option data-latlng="[0.129638,111.106934]" >Kalimantan Barat</option>
               <option data-latlng="[-1.518133,113.425049]" >Kalimantan Tengah</option>
               <option data-latlng="[-3.043977,115.479492]" >Kalimantan Selatan</option>
               <option data-latlng="[1.656507,116.545166]" >Kalimantan Timur</option>
               <option data-latlng="[0.678940,124.235596]" >Sulawesi Utara</option>
               <option data-latlng="[-1.430271,121.445068]" >Sulawesi Tengah</option>
               <option data-latlng="[-3.598949,120.247559]" >Sulawesi Selatan</option>
               <option data-latlng="[-4.129477,122.148193]" >Sulawesi Tenggara</option>
               <option data-latlng="[0.678940,122.455811]" >Gorontalo</option>
               <option data-latlng="[-2.183553,119.324707]" >Sulawesi Barat</option>
               <option data-latlng="[-3.320404,130.126465]" >Maluku</option>
               <option data-latlng="[1.423683,127.687500]" >Maluku Utara</option>
               <option data-latlng="[-2.067178,132.585205]" >Irian Jaya Barat</option>
               <option data-latlng="[-4.385847,138.177246]" >Papua</option>
				</select>
				</a></li>
				<li><a>Potential
				<select id="cabor_list" style="border-radius:20px; background-color:white; padding-left:3px;">
					<option>-- Loading... --</option>
				</select>
				</a></li>
				<li><a>Enable Layer <input id="enablelayer" type="checkbox" name="enable" checked="active" style="margin-left:4px;"></a></li>
				<li><a class="codrops-icon codrops-icon-drop" href="#"><span>GIS Kemenpora V2</span></a></li>
			</ul>
		</div>
		<div style="height:100%; width:100%; padding-top:61px; background-color:#5f6f81;">

		<div style="width: 69.9%; height: 100%;" id="gmap_city"></div>		
		
		<div style=" padding:0 20px;position:absolute; right:0px; width: 30%; padding-top:61px; top:0px;height:100%; background-color:white; z-index:0;">
		<div style="padding:0 20px;position:absolute; right:0px; width: 100%; top:0px;height:61px; background-color:#5f6f81; z-index:0;"></div>
			<h1 style="text-align:center; color:#34495E;">Informasi Peta</h1>
			<div style="padding: 20px; border-width:1px; border-radius:5px; border-color:#34495E; box-shadow: 0px 0px 2px 0px #34495E; height:100%px; width:100%;">
				<div id="details" style="padding:5px 15px;">
					<div id="informasiawal" style="text-align:justify;">
						<h2 style="text-align:center; margin-bottom:30px; margin-top:0px;">GIS Kemenpora V2</h2>
						<p>Penjelasan Singkat Menu GIS<br>
							<table style="height:200px;">
							<tr>
								<td><li></li></td>
								<td>Quick View</td>
								<td>:</td>
								<td>Menentukan Wilayah Propinsi</td>							
							</tr>							
							<tr>
								<td><li></li></td>
								<td>Enable Layer</td>
								<td>:</td>
								<td>Menampilkan Layer Propinsi</td>							
							</tr>
							<tr>
								<td><li></li></td>
								<td>Enable Atlet</td>
								<td>:</td>
								<td>Menampilkan Marker Atlet</td>							
							</tr>
							<tr>
								<td><li></li></td>
								<td>Enable KNPI</td>
								<td>:</td>
								<td>Menampilkan Marker KNPI</td>							
							</tr>
							<tr>
								<td><li></li></td>
								<td>Icon KNPI</td>
								<td>:</td>
								<td>Mengetahui Informasi KNPI</td>							
							</tr>
							<tr>
								<td><li></li></td>
								<td>Icon Angka</td>
								<td>:</td>
								<td>Mengetahui Informasi Atlet</td>							
							</tr>
							</table>
						</p>					
					</div>
					
				</div>
				
			</div>		
		</div>
		<div style="font-size:12px; position:absolute; right:30.6%;  width: 130px; top:96px; height:120px; background-color:white; z-index:0; padding:0px 12px;"><h4 style="text-align:center; padding:0px;">Tahun</h4>
			<select id="year_list" style="border-radius:20px; background-color:white; padding-left:3px;">
				<option value="0">--Pilih Tahun--</option>				
				<option value="2009">2009</option>
				<option value="2010">2010</option>
				<option value="2011">2011</option>
				<option value="2012">2012</option>
				<option value="2013">2013</option>
				<option value="2014">2014</option>
				<option value="2015">2015</option>
				<option value="2016" selected>2016</option>
			</select><br><br>
			<input type="radio" name="kejuaraan"  value="0" style="vertical-align:middle;" checked> Daerah<br>
			<input type="radio" name="kejuaraan" value="1" style="vertical-align:middle;"> Nasional
		</div>		
		<div style="text-align:center; font-size:11px; position:absolute; right:30.1%;  width: 50%; bottom:0px; height:15px; background-color:white; z-index:0;">GIS Kemenpora V2 | Term of Use</div>					
		</div>
		<!-- Modal -->
		<div class="modal fade" id="chart-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Grafik Peraihan Medali</h4>
		      </div>
		      <div class="modal-body">
		      	<div class="row text-center">
		      		<div id="chart-medali" style="width:450px; margin:auto"></div>	
		      	</div>
		      		
		      	</div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
		<div class="modal fade" id="table-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Tabel peraihan medali untuk seluruh cabang olahraga</h4>
		      </div>
		      <div class="modal-body">
		      	
		      	<div class="row" id="datatable" style="margin: 15px auto"></div>
		      	</div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
			
			$('#chart-modal').on('shown.bs.modal', function () {
    			chartMedali.setData(decodedDataChart);
    			
    			
  			});
  			$('#table-modal').on('shown.bs.modal', function () {
    			
    			table.clear().draw();
          	if (decodedDataTable!=null) {
           		//alert("op not null");
            	table.rows.add(decodedDataTable).draw();
    			}
  			});
  			
  			
			
		</script>
	</body>
</html>