<!DOCTYPE html>
<html>
<head>
   <?php include "view/head.php";?>
</head>
<body onload="pageLoad()">
	<div id="wrapper">
   <?php include "view/default/right_menu.php";?>
   	<div id="page-wrapper" style="min-height:850px;">
	  		<div class="row">
   	   	<div class="col-lg-12"  style="margin-bottom:-20px;">
             	<h1 class="page-header">Input Data Pelatih</h1>
         	</div>
      	</div>
      	<div class="row">
      		<div class="col-lg-12">
         		<div class="panel ">
            		<div class="panel-body">
            			<div id="inputatlet" style="height:100%px; width:100%; border-radius:10px; background-color:#F5F5F5; padding:20px 20px 20px 80px;">
                  	<form action="<?php echo $url_rewrite.'core/input_atlet/input_atlet_controller.php'; ?>" method="POST">
                  		<table>
						<tr>
						<td>Nama Atlet</td><td style="padding:10px 20px 10px 20px;">:</td>
						<td><input style="width:230px; height:34px;" type="text" name="nama-atlet"></td>
						<td style="padding:10px 20px 10px 40px;">Propinsi</td><td style="padding:10px 20px 10px 20px;">:</td>
						<td>
							<select id="city_list" style="width:230px; height:34px;" name="propinsi">
							<option selected="selected" data-latlng="[-1.5, 117]" id="valid2">--Peta Indonesia--</option>
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
						</td>			
					</tr>
					<tr>
						<td>Jenis Kelamin</td><td style="padding:10px 20px 10px 20px;">:</td>
						<td>
							<select id="jkel" style="width:230px; height:34px;" name="jenis-kelamin">
								<option selected="selected">--Pilih Jenis Kelamin--</option>
								<option value="1">Laki-laki</option>
								<option value="2">Perempuan</option>
							</select>									
						</td>
						<td style="padding:10px 20px 10px 40px;">Latitude</td>
						<td style="padding:10px 20px 10px 20px;">:</td>
						<td><input style="width:230px; height:34px;" type="text" name="lat" id="lat" ></td>						
					</tr>
					<tr>
						<td>Cabang Olahraga</td><td style="padding:10px 20px 10px 20px;">:</td>
						<td><select name="cabor" id="cabor" style="width:230px; height:34px;"></select></td>
						<td style="padding:10px 20px 10px 40px;">Longitude</td>
						<td style="padding:10px 20px 10px 20px;">:</td>
						<td><input style="width:230px; height:34px;" type="text" name="lng" id="lng" ><td>
					</tr>
					<tr>
						<td>Nama Pelatih</td><td style="padding:10px 20px 10px 20px;">:</td>
						<td><select name="pelatih" id="pelatih" style="width:230px; height:34px;"></select></td>
						<td></td>						
						<td style="padding:10px 20px 10px 40px;">
						</td>
						<td><input type="submit" value="Submit" style="width:110px; height:34px;"><input type="reset" value="Reset" style="width:110px; height:34px;margin-left: 10px;"></td>
					</tr>
 				</table>
 			</form>
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