<?php
include '../config/application.php';
$id=$_SESSION['user_id'];//Nanti diganti

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

/* Array of database columns which should be read and sent back to DataTables. Use a space where
 * you want to insert a non-database field (for example a counter or static image)
 */
$aColumns = array('nama_album', 'ket','waktu','id_album','status_display');

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "id_album";

/* DB table to use */
$sTable = "album";

/*
 * Paging
 */
$sLimit = "";
if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
     $sLimit = "LIMIT " . intval($_GET['iDisplayStart']) . ", " .
             intval($_GET['iDisplayLength']);
}


/*
 * Ordering
 */
$sOrder = "";
if (isset($_GET['iSortCol_0'])) {
     $sOrder = "ORDER BY  ";
     for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
          if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
               $sOrder .= "`" . $aColumns[intval($_GET['iSortCol_' . $i])] . "` " .
                       ($_GET['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
          }
     }

     $sOrder = substr_replace($sOrder, "", -2);
     if ($sOrder == "ORDER BY") {
          $sOrder = "";
     }
}


/*
 * Filtering
 * NOTE this does not match the built-in DataTables filtering which does it
 * word by word on any field. It's possible to do here, but concerned about efficiency
 * on very large tables, and MySQL's regex functionality is very limited
 */
$sWhere = "";
if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
     $sWhere = "WHERE (";
     for ($i = 0; $i < count($aColumns); $i++) {
          if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
               $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
          }
     }
     $sWhere = substr_replace($sWhere, "", -3);
     $sWhere .= ')';
}

/* Individual column filtering */
for ($i = 0; $i < count($aColumns); $i++) {
     if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
          if ($sWhere == "") {
               $sWhere = "WHERE ";
          } else {
               $sWhere .= " AND ";
          }
          $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . mysql_real_escape_string($_GET['sSearch_' . $i]) . "%' ";
     }
}


/*
 * SQL queries
 * Get data to display
 */
$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS `" . str_replace(" , ", " ", implode("`, `", $aColumns)) . "`
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
		";

$rResult = $DB->query($sQuery);

/* Data set length after filtering */
$sQuery = "
		SELECT FOUND_ROWS()
	";
$rResultFilterTotal = $DB->query($sQuery);
$aResultFilterTotal = $DB->fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];

/* Total data set length */
$sQuery = "
		SELECT COUNT(`" . $sIndexColumn . "`)
		FROM   $sTable
	";
$rResultTotal = $DB->query($sQuery);
$aResultTotal = $DB->fetch_array($rResultTotal);
$iTotal = $aResultTotal[0];


/*
 * Output
 */
$output = array(
    "sEcho" => intval($_GET['sEcho']),
    "iTotalRecords" => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData" => array()
);

while ($aRow =$DB->fetch_array($rResult)) {
     $row = array();
     
     $nama_album=$aRow['nama_album'];
     $id_album=$aRow['id_album'];
     $waktu=$UTILITY->format_tanggal($aRow['waktu']);
     $ket=$aRow['ket'];
     $status_display=$aRow['status_display'];
     if($status_display==1)
          $text_publish="Publish";
     else
          $text_publish="Pending";
  

     $row[] =$nama_album;
     $row[] =$ket;
     $row[] =$waktu ;
     //  $row[] ="<img src=\"$url_img/img/$image\" style=\"border: 1px solid #000; max-width:500px; max-height:500px;\" border=\"0\" />";      
       $row[]=$text_publish;
             $delete="";
             $edit="";
            
		$delete="<a href=\"#\" class=\"btn btn-danger\" onClick=\"confirm_delete('$url_rewrite"."proses/album/hdata/$id_album') \"title=\"Hapus\">Hapus</a>";
	
            $edit="<a href=\"$url_rewrite"."content/album/edit/$id_album \" class=\"btn btn-success\" title=\"Edit\">Edit</a>";
             $foto="<a href=\"$url_rewrite"."content/foto/$id_album \" class=\"btn btn-warning\" title=\"Edit\">Foto</a>";
             $publish="<a href=\"$url_rewrite"."proses/album/publish/$id_album/$text_publish\" class=\"btn btn-info\" title=\"Publish\">Publish</a>";
		
      
$row[] =$edit." $foto $publish ".$delete;
      
      

     $output['aaData'][] = $row;
}

echo json_encode($output);

?>

