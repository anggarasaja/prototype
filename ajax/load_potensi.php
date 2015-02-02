<?php
	$conn = mysqli_connect('localhost', 'root','', 'gis_v2');
	if(mysqli_connect_errno()) {
		echo "gagal terkoneksi dengan mysql: ". mysqli_connect_error();
	}
	if(isset($_POST["id_cabor"]))
	{
    	$id_cabor= $_POST["id_cabor"];
		$sql = "select tbl_medali.*, tbl_propinsi.propinsi, tbl_cabor.cabor
				 from tbl_medali
				 join tbl_propinsi
				 on tbl_propinsi.id_propinsi = tbl_medali.id_propinsi
				 join tbl_cabor
				 on tbl_cabor.id_cabor = tbl_medali.id_cabor
				 where jml_medali=(select max(jml_medali) from tbl_medali where tbl_medali.id_cabor=$id_cabor and kejuaraan=0 and tahun=2009) and tbl_medali.id_cabor=$id_cabor and kejuaraan=0 and tahun=2009";
		$result = mysqli_query($conn, $sql);?>
		<h2>Wilayah Potensi Atlet</h2><table><tr>
		<?php 
		if(mysqli_num_rows($result) != 1) {
			echo "Tidak Ada Wilayah Potensial Atlet";
		}		
		else {
			while($row = mysqli_fetch_array($result))
   	{?>
			<td>Propinsi</td><td style="padding:10px 20px 10px 20px;">:</td><td><?php echo $row["propinsi"]?></td></tr>
			<td>Cabang Olahraga</td><td style="padding:10px 20px 10px 20px;">:</td><td><?php echo $row["cabor"]?></td></tr>
			<td>Emas</td><td style="padding:10px 20px 10px 20px;">:</td><td><?php echo $row["emas"]?></td></tr>
			<td>Perak</td><td style="padding:10px 20px 10px 20px;">:</td><td><?php echo $row["perak"]?></td></tr>
			<td>Perunggu</td><td style="padding:10px 20px 10px 20px;">:</td><td><?php echo $row["perunggu"]?></td></tr>
			<td>Jumlah Medali</td><td style="padding:10px 20px 10px 20px;">:</td><td><?php echo $row["jml_medali"]?></td></tr>
			<td>Tahun</td><td style="padding:10px 20px 10px 20px;">:</td><td><?php echo $row["tahun"]?></td></tr>
   	<?php }
   	}
	}
?>