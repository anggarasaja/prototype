<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>GIS Kemenpora V2</title>
		<meta name="description" content="A sidebar menu as seen on the Google Nexus 7 website" />
		<meta name="keywords" content="google nexus 7 menu, css transitions, sidebar, side menu, slide out menu" />
		<meta name="author" content="Christomas Daimler" />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<script src="js/modernizr.custom.js"></script>
		<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&libraries=visualization"></script>
		<script type="text/javascript" src="js/markerclusterer.js"></script>
		<script>

		var map;
		var markers = [];
		var heatmaps = [];
		var pointarray, heatmap;

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
  			map = new google.maps.Map(document.getElementById('gmap_city'),
  		   {
      		zoom: 5,
      	 	mapTypeId: google.maps.MapTypeId.HYBRID
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
				success: function (atlet) {			
					setMarkers(atlet);	
				}
			});
			
			$('#cabor_list').change(function(e) {		
				var selectvalue = $(this).val();
				if (selectvalue == 0) {
        			alert(selectvalue);
    			}
    			else {	
					$.ajax({
						type:"POST",
						url : "ajax/load_heatmaps.php",
						dataType: 'json',
						data: {id:selectvalue},
						success: function (heat) {			
							setHeatmaps(heat);	
						}
					});
				}
			});
			
			$.ajax({
				type:"POST",
				url : "ajax/load_knpi.php",
				dataType: 'json',
				success: function (knpi) {			
					setMarkersknpi(knpi);	
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
			
			map.data.loadGeoJson('json/indonesia.json');
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
				details.innerHTML = '<h2>Propinsi</h2><table>'+
				'<tr><td>Nama propinsi</td><td style="padding:10px 20px 10px 20px;">:</td><td>'+lettermap+'</td></tr></table>'
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
				var valueCab = $('option:selected',this).val();
				$.ajax({url: "ajax/load_potensi.php",
      			type: 'POST',
      			data: {id_cabor:valueCab},
      			success: function(output) {
      			   $("#details").html(output);
      			   //alert(output);
     			   },
     				error: function (xhr, ajaxOptions, thrownError) {
    			      alert(xhr.status + " "+ thrownError);
    			}});
			});
			//var pointArray = new google.maps.MVCArray(taxiData);
  			//heatmap = new google.maps.visualization.HeatmapLayer({
    		//	data: pointArray
  			//});
  			//heatmap.setMap(map);
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
					details.innerHTML = '<h2>Profil Atlet</h2><table>'+
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
    		$('#atlet').click(function(){
    			if (this.checked) {
        			newmarker.setMap(map);
    			}
    			else {
    				newmarker.setMap(null);
    			}
			});
		}
		
		function setMarkers(locations) {
			for (var i = 0; i < locations.length; i++) {
    			var beach = locations[i];
    			createMarkers(beach[0], beach[1], beach[2],beach[3],beach[4],beach[5],beach[6]);
    		}
			var mcOptions = {gridSize: 50, maxZoom: 7};
   		var mc = new MarkerClusterer(map, markers, mcOptions);
   		$('#atlet').click(function(){
    			if (this.checked) {
        			mc.addMarkers(markers);
    			}
    			else {
    				mc.clearMarkers();
    			}
			});
			$('#toggleall').click(function(){
    			if (this.checked) {
        			mc.addMarkers(markers);
    			}
    			else {
    				mc.clearMarkers();
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
					details.innerHTML = '<h2>KNPI</h2><table>'+
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
		
		function setHeatmaps(locations) {
			for (var i = 0; i < locations.length; i++) {
    			var beach = locations[i];
    			createHeatmaps(beach[0], beach[1]);
    		}
		}
		function createHeatmaps(lat, lon) {
			var pointArray = new google.maps.MVCArray({
				position: new google.maps.LatLng(lat, lon),
        		map: map
        	});
        	heatmaps.push(pointArray);
        	heatmap = new google.maps.visualization.HeatmapLayer({
    			data: heatmaps
  			});
  			heatmap.setMap(map);
		}
					
		function toggle(source) {
  			checkboxes = document.getElementsByClassName('togglebox');
  			for(var i=0, n=checkboxes.length;i<n;i++) {
    			checkboxes[i].checked = source.checked;
  			}
		}  
	</script>
	<script type="text/javascript" src="js/searchatlet.js"></script>
	</head>
	<body onload="pageLoad()">
		<div class="container">
			<ul id="gn-menu" class="gn-menu-main">
				<li class="gn-trigger">
					<a class="gn-icon gn-icon-menu"><span>Menu</span></a>
					<nav class="gn-menu-wrapper">
						<div class="gn-scroller">
							<ul class="gn-menu">
								<li class="gn-search-item">
									<input placeholder="Search Atlet" type="text" class="gn-search" id="search_atlet" onkeyup="searchtext()"/>
									<a class="gn-icon gn-icon-search"><span>Search</span></a>
								</li>
								<ul id="search_list_atlet"></ul>
								<li><span class="gn-icon gn-icon-download"><input id="toggleall" name="Profil Prov" type="checkbox" value="Profil Prov" onclick="toggle(this)" checked="active"> Select All</span>
									<ul class="gn-submenu">
										<li><span class="label" style="margin-left:60px;"><input id="atlet" class="togglebox" name="Profil Prov" type="checkbox" value="Profil Prov" checked="active"><img width="14" height="14" src="icon/diamond.png">Atlet</span></li>
										<li><span class="label" style="margin-left:60px;"><input id="knpi" class="togglebox" name="KNPI" type="checkbox" value="KNPI" checked="active"><img width="14" height="14" src="icon/knpi.png">KNPI</span></li>
									</ul>
								</li>
								<li><a class="gn-icon gn-icon-help" href="dokumentasi/gis_v2.pdf" target="_blank">Documentation</a></li>								
								<li><a id="aboutus" class="gn-icon gn-icon-article">About Us</a></li>
								<li><a class="gn-icon gn-icon-archive">Archives</a></li>
								<li><a class="gn-icon gn-icon-cog">Settings</a></li>									
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
				<li><a>Enable Layer <input id="enablelayer" type="checkbox" name="enable" checked="active" style="vertical-align:middle;"></a></li>
				<li><a class="codrops-icon codrops-icon-drop" href="#"><span>GIS Kemenpora V2</span></a></li>
			</ul>
			<div style="height:66px"></div>
		</div>
		<div style="height:590px; width:100%;">
		<div style="width: 70%; height: 100%;" id="gmap_city"></div>		
		<div style="padding-top:20px; position:absolute; right:0px; width: 404px; margin-top:-590px; height:590px; background-color:white; z-index:0;">
			<h1 style="text-align:center; color:#34495E;">Informasi Peta</h1>
			<div style="margin: 20px; border-width:1px; border-radius:20px; border-color:#34495E; box-shadow: 0px 0px 2px 0px #34495E; height:450px; width:366px;">
				<div id="details" style="padding:5px 15px;">
					<div id="informasiawal" style="text-align:justify;">
						<h2 style="text-align:center;">GIS Kemenpora V2</h2>
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
		<div style="font-size:12px; position:absolute; right:416px;  width: 130px; margin-top:-540px; height:120px; background-color:white; z-index:0; padding:0px 12px;"><h3 style="text-align:center; padding:0px;">Tahun</h3>
			<select id="city_list" style="border-radius:20px; background-color:white; padding-left:3px;">
				<option selected="selected">--Pilih Tahun--</option>
				<option>2009</option>
				<option>2010</option>
				<option>2011</option>
				<option>2012</option>
				<option>2013</option>
				<option>2014</option>
			</select><br><br>
			<input type="radio" name="sex" value="male" style="vertical-align:middle;" checked="active"> Daerah<br>
			<input type="radio" name="sex" value="female" style="vertical-align:middle;"> Nasional
		</div>		
		<div style="text-align:center; font-size:11px; position:absolute; right:410px;  width: 460px; margin-top:-15px; height:15px; background-color:white; z-index:0;">GIS Kemenpora V2 | Term of Use</div>					
		</div>
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
	</body>
</html>