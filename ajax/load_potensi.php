<?php
	$conn = mysqli_connect('localhost', 'root','', 'gis_v2');
	if(mysqli_connect_errno()) {
		echo "gagal terkoneksi dengan mysql: ". mysqli_connect_error();
	}
	if(isset($_POST["id_cabor"]))
	{
    	$id_cabor= $_POST["id_cabor"];
    	$year_list= $_POST["year"];
    	$kejuaraan = $_POST["kejuaraan"];
		$sql = "select tbl_medali.emas, tbl_medali.perak, tbl_medali.perunggu, tbl_medali.jml_medali, tbl_medali.tahun, tbl_medali.id_propinsi, tbl_propinsi.propinsi, tbl_cabor.cabor, tbl_kejuaraan.kejuaraan
				 from tbl_medali
				 join tbl_propinsi
				 on tbl_propinsi.id_propinsi = tbl_medali.id_propinsi
				 join tbl_cabor
				 on tbl_cabor.id_cabor = tbl_medali.id_cabor
				 join tbl_kejuaraan
				 on tbl_kejuaraan.id_kejuaraan = tbl_medali.kejuaraan
				 where jml_medali=(select max(jml_medali) from tbl_medali where tbl_medali.id_cabor=$id_cabor and tbl_medali.kejuaraan='$kejuaraan' and tahun=$year_list) and tbl_medali.id_cabor=$id_cabor and tbl_medali.kejuaraan='$kejuaraan' and tahun=$year_list";
		$result = mysqli_query($conn, $sql);
		
		$rows= array();
		$row;
		$id_propinsi = null;
		$html_string= '<h3 style="margin-bottom:20px; margin-top:0px;">Wilayah Potensi Atlet</h3>';
		
		
		if(mysqli_num_rows($result) != 1) {
			$html_string = $html_string."Tidak Ada Wilayah Potensial Atlet";
		}		
		else {
			while($row = mysqli_fetch_array($result)){
				//echo $row["jml_medali"];
				if($row["jml_medali"]>0) {
	   	
		   		$html_string = $html_string .'
		   		<table>
		   		<tr>
		   		<td>Propinsi</td><td style="padding:10px 20px 10px 20px;">:</td><td>'.$row["propinsi"].'</td>
		   		</tr>
		   		<tr>
					<td>Cabang Olahraga</td><td style="padding:10px 20px 10px 20px;">:</td><td>'. $row["cabor"].'</td>
					</tr>
					<tr>
					<td>Kejuaraan</td><td style="padding:10px 20px 10px 20px;">:</td><td>'. $row["kejuaraan"].'</td>
					</tr>
					<tr>
					<td>Emas</td><td style="padding:10px 20px 10px 20px;">:</td><td>'.$row["emas"].'</td>
					</tr>
					<tr>
					<td>Perak</td><td style="padding:10px 20px 10px 20px;">:</td><td> '.$row["perak"].'</td>
					</tr>
					<tr>
					<td>Perunggu</td><td style="padding:10px 20px 10px 20px;">:</td><td> '. $row["perunggu"].'</td>
					</tr>
					<tr>
					<td>Jumlah Medali</td><td style="padding:10px 20px 10px 20px;">:</td><td>'. $row["jml_medali"].'</td>
					</tr>
					<tr>
					<td>Tahun</td><td style="padding:10px 20px 10px 20px;">:</td><td> '.$row["tahun"].'</td>
					</tr>
					</table>
					<div id="button-graph" class="row text-center" style="margin-top:15px">
					<div class="btn-group-vertical" role="group" >
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#chart-modal" >
  							Grafik Peraihan Medali
						</button>
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#table-modal" >
  							Tabel Peraihan medali<br>(semua cabang olahraga)
						</button>
					</div>
					</div>
					
					';
					
					
					$id_propinsi = $row["id_propinsi"];
	   		}
	   		else {
   				$html_string = $html_string."Tidak Ada Wilayah Potensial Atlet";
   			}
	   		
   	 		
   		}
			
   		
   	}
   	$rows = ['html_string'=> $html_string, 'id_propinsi' => $id_propinsi];
   	echo json_encode($rows);
	}
