<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Menpora GIS V2</title>
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
		<script type="text/javascript" src="js/gmaps.js"></script>
		<script>
		function pageLoad(){
  			map = new google.maps.Map(document.getElementById('gmap_city'),
  		   {
      		zoom: 5,
      	 	mapTypeId: google.maps.MapTypeId.ROADMAP
 		   });
 		   
 		   map.setOptions({draggable: true, zoomControl: true, scrollwheel: false, disableDoubleClickZoom: true});
 		   addPoint(1, 'Kampus D', -6.369023, 106.833);
			addPoint(2, 'Kampus H', -6.353655, 106.8376);
			addPoint(3, 'Kampus E', -6.354671, 106.842176);
			addPoint(4, 'Kampus G', -6.354671, 106.843957);
			
			map.data.loadGeoJson('json/indonesia.json');
			map.data.setStyle(function(feature) {
    			return /** @type {google.maps.Data.StyleOptions} */({
      			fillColor: feature.getProperty('color'),
      			strokeWeight: 1
    			});
  			});
  			map.data.addListener('mouseover', function(event) {
   	 	map.data.revertStyle();
    		map.data.overrideStyle(event.feature, {strokeWeight: 3});
  			});
			map.data.addListener('click', function(event) {
				   	 		
   	 		/*$.getJSON('http://maps.google.com/maps/api/geocode/json?address=milano&sensor=false',function(data) {
    			var location = data.results[0].geometry.location;
   				alert(location.lat+","+location.lng);
    				// coordinates are location.lat and location.lng
				});*/
				$.getJSON('json/marker.json?=',function(data) {
    			var location = data.results[0].geometry.location;
   				alert(location.lat+","+location.lng);
   			});
  			});

	    	$('#city_list').change(function(){
      		var coordinate = $('option:selected',this).data('latlng')
        		map.panTo(new google.maps.LatLng(coordinate[0],coordinate[1]));
        		if (coordinate == '-1.5,117') {
        			map.setZoom(5);
        		}
        		else if (coordinate == '-6.22,106.86') {
        			map.setZoom(11);
        		}
        		else {
        			map.setZoom(8);
        		}
   		}).trigger('change');
   		setMarkers(map, beaches);
		}
		var beaches = [
  			['Bondi Beach', -6.569023, 106.833, 4],
  			['Coogee Beach', -6.369023, 107.833, 5],
  			['Cronulla Beach', -7.369023, 106.833, 3],
  			['Manly Beach', -6.569023, 108.833, 2],
  			['Maroubra Beach', -8.369023, 110.833, 1]
		];
		function setMarkers(map, locations) {
  			var image = {
    			url: 'icon/icon.png',
  			};
  			for (var i = 0; i < locations.length; i++) {
    			var beach = locations[i];
    			var myLatLng = new google.maps.LatLng(beach[1], beach[2]);
    			var marker = new google.maps.Marker({
        			position: myLatLng,
        			map: map,
        			icon: image,
        			title: beach[0],
        			zIndex: beach[3]
    			});
  			}
  			marker.info = new google.maps.InfoWindow({
				content: '<div style="width:70px; height:10px; text-align:center;"><strong>' + beach[0] + '</strong></div><br/>'
			});
  			google.maps.event.addListener(marker, 'mouseover', function() {
				marker.info.open(map, marker);
			});
			google.maps.event.addListener(marker, 'mouseout', function() {
				marker.info.close();
			});
			$('#enablemarker').click(function(){
    			if (this.checked) {
        			marker.setMap(map);
    			}
    			else {
    				marker.setMap(null);
    			}
			});
			
		}
		function addPoint(pid, name, lat, lng) {
			var point = new google.maps.LatLng(lat, lng);
			var marker = new google.maps.Marker({
				icon: 'img/gundar.png',
				position: point,
				map: map
			});
			marker.info = new google.maps.InfoWindow({
				content: '<div style="width:70px; height:10px; text-align:center;"><strong>' + name + '</strong></div><br/>'
			});
			google.maps.event.addListener(marker, 'mouseover', function() {
				marker.info.open(map, marker);
			});
			google.maps.event.addListener(marker, 'mouseout', function() {
				marker.info.close();
			});
			google.maps.event.addListener(marker, 'click', function() {
				map.setZoom(15);
				map.panTo(marker.getPosition());
				details.innerHTML = '<em>Mengambil Informasi</em>';
				showDivInfo(pid);
			});
			$('#enablelayer').click(function(){
    			if (this.checked) {
        			map.data.setMap(map);
    			}
    			else {
    				map.data.setMap(null);
    			}
			});
			$('#enablemarker').click(function(){
    			if (this.checked) {
        			marker.setMap(map);
    			}
    			else {
    				marker.setMap(null);
    			}
			});
		}
		
		function showDivInfo(pid) {
			$.get( "info.php?pid="+pid, function( data ) {
				details.innerHTML = data;
			});
		}
		
		function pageUnload() {
			GUnload();
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
								<li><span class="gn-icon gn-icon-download"><input name="Profil Prov" type="checkbox" value="Profil Prov" onClick="ContextSelector_SetGroupStatus('0', '0', this.checked)"  CHECKED><img width="14" height="14" src="icon/icon.png">Pemuda/Olahraga</span>
									<ul class="gn-submenu">
										<li><span class="label" style="margin-left:60px;"><input name="Profil Prov" type="checkbox" value="Profil Prov" onClick="ContextSelector_SetGroupStatus('0', '0', this.checked)"  CHECKED><img width="14" height="14" src="icon/indo.png">Profil Prov</span></li>
                              <li><span class="label" style="margin-left:60px;"><input name="Kepadatan Pmd" type="checkbox" value="Kepadatan Pmd" onClick="ContextSelector_SetGroupStatus('0', '1', this.checked)" ><img width="14" height="14" src="icon/terrain_16.png">Kepadatan Pmd</span></li>
                              <li><span class="label" style="margin-left:60px;"><input name="Angkatan Kerja" type="checkbox" value="Angkatan Kerja" onClick="ContextSelector_SetGroupStatus('0', '2', this.checked)" ><img width="14" height="14" src="icon/man.png">Angkatan Kerja</span></li>
                              <li><span class="label" style="margin-left:60px;"><input name="Cabang Olahraga" type="checkbox" value="Cabang Olahraga" onClick="ContextSelector_SetGroupStatus('0', '3', this.checked)" ><img width="14" height="14" src="icon/olahraga.png">Cabang Olahraga</span></li>
                              <li><span class="label" style="margin-left:60px;"><input name="CABOR Unggulan" type="checkbox" value="CABOR Unggulan" onClick="ContextSelector_SetGroupStatus('0', '4', this.checked)" ><img width="14" height="14" src="icon/trophy.png">CABOR Unggulan</span></li>
                              <li><span class="label" style="margin-left:60px;"><input name="Bantuan SOR" type="checkbox" value="Bantuan SOR" onClick="ContextSelector_SetGroupStatus('0', '5', this.checked)" ><img width="14" height="14" src="icon/SOR.png">Bantuan SOR</span></li>
                              <li><span class="label" style="margin-left:60px;"><input name="Tkt Pendidikan" type="checkbox" value="Tkt Pendidikan" onClick="ContextSelector_SetGroupStatus('0', '6', this.checked)" ><img width="14" height="14" src="icon/pmd.png">Tkt Pendidikan</span></li>
                              <li><span class="label" style="margin-left:60px;"><input name="Tidak Mampu Baca" type="checkbox" value="Tidak Mampu Baca" onClick="ContextSelector_SetGroupStatus('0', '7', this.checked)" ><img width="14" height="14" src="icon/pencil.png">Tidak Mampu Baca</span></li>
                              <li><span class="label" style="margin-left:60px;"><input name="PON XVII 2008" type="checkbox" value="PON XVII 2008" onClick="ContextSelector_SetGroupStatus('0', '8', this.checked)" ><img width="14" height="14" src="icon/Logo_ponxvii.png">PON XVII 2008</span></li>
                              <li><span class="label" style="margin-left:60px;"><input name="POPNAS 2009" type="checkbox" value="POPNAS 2009" onClick="ContextSelector_SetGroupStatus('0', '9', this.checked)" ><img width="14" height="14" src="icon/porpn.png">POPNAS 2009</span></li>
                              <li><span class="label" style="margin-left:60px;"><input name="KNPI" type="checkbox" value="KNPI" onClick="ContextSelector_SetGroupStatus('0', '10', this.checked)"  CHECKED><img width="14" height="14" src="icon/knpi.png">KNPI</span></li>
                              <li><span class="label" style="margin-left:60px;"><input name="OK Tkt Nasional" type="checkbox" value="OK Tkt Nasional" onClick="ContextSelector_SetGroupStatus('0', '11', this.checked)" ><img width="14" height="14" src="icon/okp.png">OK Tkt Nasional</span></li>
                              <li><span class="label" style="margin-left:60px;"><input name="OK Mahasiswa" type="checkbox" value="OK Mahasiswa" onClick="ContextSelector_SetGroupStatus('0', '12', this.checked)" ><img width="14" height="14" src="icon/OKP_mhs.png">OK Mahasiswa</span></li>
									</ul>
								</li>
								<li><a class="gn-icon gn-icon-cog">Settings</a></li>
								<li><a class="gn-icon gn-icon-help">Help</a></li>
								<li>
									<a class="gn-icon gn-icon-archive">Archives</a>
									<ul class="gn-submenu">
										<li><a class="gn-icon gn-icon-article">Articles</a></li>
										<li><a class="gn-icon gn-icon-pictures">Images</a></li>
										<li><a class="gn-icon gn-icon-videos">Videos</a></li>
									</ul>
								</li>
							</ul>
						</div><!-- /gn-scroller -->
					</nav>
				</li>
				<li><a href="index.php">HOME</a></li>
				<li><a>Quick View
				<select id="city_list">
					<option selected="selected" data-latlng="[-1.5, 117]" id="valid2">--Peta Indonesia--</option>
					<option data-latlng="[4.5,97]" >Nanggroe Aceh</option>
					<option data-latlng="[2.1,99.3]" >Sumatera Utara</option>
					<option data-latlng="[-0.8,101]" >Sumatera Barat</option>
					<option data-latlng="[0.2,102]" >Riau</option>
					<option data-latlng="[-1.72,102.7]" >Jambi</option>
					<option data-latlng="[-3.42,104.2]" >Sumatera Selatan</option>
					<option data-latlng="[-3.65,102.7]" >Bengkulu</option>
					<option data-latlng="[-4.75,105.5]" >Lampung</option>
					<option data-latlng="[-2.75,106.7]" >Bangka Belitung</option>
					<option data-latlng="[-6.22,106.86]" >DKI Jakarta</option>
				</select>
				</a></li>
				<li><a>Enable Layer <input id="enablelayer" type="checkbox" name="enable" checked="active"></a></li>
				<li><a>Enable Marker <input id="enablemarker" type="checkbox" name="enable" checked="active"></a></li>
				<li><a class="codrops-icon codrops-icon-drop" href="#"><span>GIS BETA V2</span></a></li>
			</ul>
			<div style="height:66px"></div>
		</div><!-- /container -->
	<div style="height:580px; width:100%;" id="gmap_city"></div>
	<div style="margin-top:6px; margin-bottom:6px; height:580px; width:100%; background-color:#EEEEEE;" id="details"></div>
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
	</body>
</html>