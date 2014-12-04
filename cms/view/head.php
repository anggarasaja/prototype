<?php
include "config/application.php";
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CMS GIS V2</title>

<!-- Core CSS - Include with every page -->
<link href="<?=$url_rewrite?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?=$url_rewrite?>font-awesome/css/font-awesome.css" rel="stylesheet">

<!-- SB Admin CSS - Include with every page -->
<link href="<?=$url_rewrite?>css/sb-admin.css" rel="stylesheet">


<!-- Core Scripts - Include with every page -->
    <script src="<?=$url_rewrite?>js/jquery-1.10.2.js"></script>
    <script src="<?=$url_rewrite?>js/bootstrap.min.js"></script>
    <script src="<?=$url_rewrite?>js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="<?=$url_rewrite?>js/sb-admin.js"></script>

    
   <script src="<?=$url_rewrite?>js/jquery.dataTables.js"></script>
   <!-- <script src="<?=$url_rewrite?>js/plugins/dataTables/jquery.dataTables.js"></script>-->
    <script src="<?=$url_rewrite?>js/plugins/dataTables/dataTables.bootstrap.js"></script>
     <script type="text/javascript" src="<?=$url_rewrite?>js/jquery.validate.js"></script> 
     
      <script type="text/javascript" src="<?=$url_rewrite?>js/jquery-ui.js"></script> 
     <link href="<?=$url_rewrite?>css/jquery-ui.css" rel="stylesheet">
     <script language="javaScript">
var form_id;
function confirm_delete(go_url)
{
	var answer = confirm("Are you sure to delete the  selected row?");
	if (answer)
	{
              
	       location=go_url;
	}
}
</script>

<script src="<?=$url_rewrite?>js/combo.js"></script>

<script>
     function tampilkanKabupaten()
{
   var id_prov= document.getElementById("provinsi").value;

   if (id_prov!= "")
   {

         var url = "<?=$url_rewrite?>api/kode_pilihan.php?kategori=kabupaten&id_provinsi=" + id_prov;
        ambilData(url, "kabupaten_isi");

      return;
   }


}


  function tampilkanProvinsi()
{
   var region= document.getElementById("kategori_2").value;

   if (region!= "")
   {

         var url = "<?=$url_rewrite?>api/kode_pilihan.php?kategori=provinsi&region=" + region;
        ambilData(url, "provinsi_isi");

      return;
   }


}
$('form').keyup(function(e) {
  return e.which !== 13  
});

</script>
          <link href="<?=$url_rewrite?>css/jquery.datetimepicker.css" rel="stylesheet">
          <script src="<?=$url_rewrite?>js/jquery.datetimepicker.js"></script>
          
          