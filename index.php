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
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
		<script type="text/javascript" src="js/markerclusterer.js"></script>
		<script>

		var map;
		var markers = [];

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
  			controlText.style.paddingTop = '2px';
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
  			controlText.style.paddingTop = '2px';
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
      	 	mapTypeId: google.maps.MapTypeId.ROADMAP
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
			$.ajax({
				type:"POST",
				url : "ajax/load_knpi.php",
				dataType: 'json',
				success: function (knpi) {			
					setMarkersknpi(knpi);	
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
        		else {
        			map.setZoom(8)
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
		}
		
		function createMarkers(namatlet, lat, lon, jkel, cabor, prop, pel) {
			var image = {
    			url: 'icon/icon.png',
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
        		zIndex: 1000
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
					
		function toggle(source) {
  			checkboxes = document.getElementsByClassName('togglebox');
  			for(var i=0, n=checkboxes.length;i<n;i++) {
    			checkboxes[i].checked = source.checked;
  			}
		}  
	</script>
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
									<input placeholder="Search" type="search" class="gn-search">
									<a class="gn-icon gn-icon-search"><span>Search</span></a>
								</li>
								<li><span class="gn-icon gn-icon-download"><input id="toggleall" name="Profil Prov" type="checkbox" value="Profil Prov" onclick="toggle(this)" checked="active"> Select All</span>
									<ul class="gn-submenu">
										<li><span class="label" style="margin-left:60px;"><input id="atlet" class="togglebox" name="Profil Prov" type="checkbox" value="Profil Prov" checked="active"><img width="14" height="14" src="icon/icon.png">Atlet</span></li>
										<li><span class="label" style="margin-left:60px;"><input id="knpi" class="togglebox" name="KNPI" type="checkbox" value="KNPI" checked="active"><img width="14" height="14" src="icon/knpi.png">KNPI</span></li>
									</ul>
								</li>
								<li><a class="gn-icon gn-icon-cog">Settings</a></li>
								<li><a class="gn-icon gn-icon-help">Help</a></li>
								<li>
									<a class="gn-icon gn-icon-archive">Archives</a>
									<ul class="gn-submenu">
										<li><a class="gn-icon gn-icon-article">Articles</a></li>
									</ul>
								</li>
							</ul>
						</div>
					</nav>
				</li>
				<li><a href="index.php">HOME</a></li>
				<li><a id="aboutus">ABOUT US</a></li>
				<li><a>Quick View
				<select id="city_list">
					<option selected="selected" data-latlng="[-1.5, 117]" id="valid2">--Peta Indonesia--</option>
					<option data-latlng="[4.359558, 96.934570]" >Nanggroe Aceh Darussalam</option>x
               <option data-latlng="[2.264792,99.219727]" >Sumatera Utara</option>x
               <option data-latlng="[-0.973342,100.066002]" >Sumatera Barat</option>
               <option data-latlng="[0.312010,101.582001]" >Riau</option>
               <option data-latlng="[-1.654310,102.790001]" >Jambi</option>
               <option data-latlng="[-3.245820,104.228996]" >Sumatera Selatan</option>
               <option data-latlng="[-3.837950,102.251999]" >Bengkulu</option>
               <option data-latlng="[-5.009961,105.152344]" >Lampung</option>
               <option data-latlng="[-2.715901,106.557495]" >Kepulauan Bangka Belitung</option>
               <option data-latlng="[3.829178,108.131836]" >Kepulauan Riau</option>x
               <option data-latlng="[-6.211278,106.842316]" >DKI Jakarta</option>x
               <option data-latlng="[-6.932970,107.602295]" >Jawa Barat</option>x
               <option data-latlng="[-7.161940,110.184082]" >Jawa Tengah</option>x
               <option data-latlng="[-7.894941,110.432373]" >Daerah Istimewa Yogyakarta</option>x
               <option data-latlng="[-7.761069,112.645020]" >Jawa Timur</option>x
               <option data-latlng="[-6.451230,106.112000]" >Banten</option>x
               <option data-latlng="[-8.408255,115.170776]" >Bali</option>x
               <option data-latlng="[-8.696155,117.499878]" >Nusa Tenggara Barat</option>x
               <option data-latlng="[-8.647282,121.097900]" >Nusa Tenggara Timur</option>x
               <option data-latlng="[0.129638,111.106934]" >Kalimantan Barat</option>x
               <option data-latlng="[-1.518133,113.425049]" >Kalimantan Tengah</option>x
               <option data-latlng="[-3.043977,115.479492]" >Kalimantan Selatan</option>x
               <option data-latlng="[1.656507,116.545166]" >Kalimantan Timur</option>x
               <option data-latlng="[0.678940,124.235596]" >Sulawesi Utara</option>x
               <option data-latlng="[-1.430271,121.445068]" >Sulawesi Tengah</option>x
               <option data-latlng="[-3.598949,120.247559]" >Sulawesi Selatan</option>x
               <option data-latlng="[-4.129477,122.148193]" >Sulawesi Tenggara</option>x
               <option data-latlng="[0.678940,122.455811]" >Gorontalo</option>x
               <option data-latlng="[-2.183553,119.324707]" >Sulawesi Barat</option>x
               <option data-latlng="[-3.320404,130.126465]" >Maluku</option>x
               <option data-latlng="[1.423683,127.687500]" >Maluku Utara</option>x
               <option data-latlng="[-2.067178,132.585205]" >Irian Jaya Barat</option>x
               <option data-latlng="[-4.385847,138.177246]" >Papua</option>
				</select>
				</a></li>
				<li><a>Enable Layer <input id="enablelayer" type="checkbox" name="enable" checked="active"></a></li>
				<li><a class="codrops-icon codrops-icon-drop" href="#"><span>GIS Kemenpora V2</span></a></li>
			</ul>
			<div style="height:66px"></div>
		</div>
		<div style="height:590px; width:100%;">
		<div style="width: 70%; height: 100%;" id="gmap_city"></div>		
		<div style="padding-top:20px; position:absolute; right:0px; width: 404px; margin-top:-590px; height:590px; background-color:white; z-index:0;">
			<h1 style="text-align:center; color:#34495E;">Informasi Peta</h1>
			<div style="margin: 20px; border-width:1px; border-radius:20px; border-color:#34495E; box-shadow: 0px 0px 2px 0px #34495E; height:450px; width:366px;">
				<div id="details" style="padding:5px;"></div>			
			</div>		
		</div>		
		<div style="text-align:center; font-size:11px; position:absolute; right:410px;  width: 372px; margin-top:-15px; height:15px; background-color:white; z-index:0;">GIS Kemenpora V2 | Term of Use</div>		
		</div>
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
	</body>
</html>