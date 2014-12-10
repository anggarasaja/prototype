<!DOCTYPE html>
<html>
<head>
   <?php include "view/head.php";?>
   <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
   <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
   <script type="text/javascript">
   var map;
   function pageLoad(){
  		map = new google.maps.Map(document.getElementById('gmap_city'),
  			{
      		zoom: 5,
      		mapTypeId: google.maps.MapTypeId.ROADMAP,
      		center: new google.maps.LatLng(-1.5,117)
 			});
 		map.setOptions({draggable: true, zoomControl: true, scrollwheel: false, disableDoubleClickZoom: true});
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
            			<div id="gmap_city" style="height:380px; width:100%; border-radius:10px;"></div>
      	      		<div class="informasibox" style="margin-top:5px; margin-bottom:5px;height:24px; width:100%; background-color:#E7F7A7; text-align:center;">
                     	<p>Informasi : Klik pada peta untuk menentukan posisi atlet secara otomatis</p>                               
                  	</div>
                  	<div id="inputatlet" style="height:100%px; width:100%; border-radius:10px; background-color:#F5F5F5; padding:20px 20px 20px 100px;">
                  		<table>
									<tr>
									<td>Nama Atlet</td><td style="padding:10px 20px 10px 20px;">:</td><td><input style="width:230px; height:34px;" type="text" name="namaatlet"></td>
									<td style="padding:10px 20px 10px 40px;">Latitude</td><td style="padding:10px 20px 10px 20px;">:</td><td><input style="width:230px; height:34px;" type="text" name="lat" disabled></td>									
									</tr>
									<tr>
									<td>Jenis Kelamin</td><td style="padding:10px 20px 10px 20px;">:</td><td>
									<select id="jkel" style="width:230px; height:34px;">
										<option selected="selected">--Pilih Jenis Kelamin--</option>
										<option>Laki-laki</option>
										<option>Perempuan</option>
									</select>									
									</td>
									<td style="padding:10px 20px 10px 40px;">Longitude</td><td style="padding:10px 20px 10px 20px;">:</td><td><input style="width:230px; height:34px;" type="text" name="long" disabled></td>									
									</tr>
									<tr><td>Cabang Olahraga</td><td style="padding:10px 20px 10px 20px;">:</td><td><input style="width:230px; height:34px;" type="text" name="cabor"></td></tr>
									<tr><td>Propinsi</td><td style="padding:10px 20px 10px 20px;">:</td><td>
									<select id="city_list" style="width:230px; height:34px;">
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
									</td></tr>
 									<tr><td>Nama Pelatih</td><td style="padding:10px 20px 10px 20px;">:</td><td><input style="width:230px; height:34px;" type="text" name="pelatih"></td></tr>
 								</table>
                  	</div>
               	</div>
        			</div>
        		</div>
      	</div>
   	</div>
	</div>
	<script>
		$(document).ready(function() {
   		$('#dataTables-example').dataTable();
   	});
	</script>
</body>
</html>
