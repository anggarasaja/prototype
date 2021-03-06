<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'tbl_atlet';

// Table's primary key
$primaryKey = 'id_atlet';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => 'atlet', 'dt' => 0, 'field' => 'atlet' ),
	array( 'db' => 'cabor',  'dt' => 1, 'field' => 'cabor' ),
	array( 'db' => 'pelatih',   'dt' => 2, 'field' => 'pelatih' ),
	array( 'db' => 'propinsi',     'dt' => 3, 'field' => 'propinsi' ),
	array( 'db' => 'jk',     'dt' => 4, 'field' => 'jk' ),
	array( 'db' => '`tbl_atlet`.`lat`',     'dt' => 5, 'field' => 'lat' ),
	array( 'db' => '`tbl_atlet`.`lng`',     'dt' => 6, 'field' => 'lng' )
);

// SQL server connection information
$sql_details = array(
	'user' => 'root',
	'pass' => '',
	'db'   => 'gis_v2',
	'host' => 'localhost'
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( 'ssp.class.php' );
$sJoin = "from `tbl_atlet` join `tbl_pelatih` on (`tbl_pelatih`.`id_pelatih` = `tbl_atlet`.`id_pelatih`) join `tbl_cabor` on (`tbl_cabor`.`id_cabor` = `tbl_atlet`.`id_cabor`) join `tbl_jk` on (`tbl_jk`.`id_jk` = `tbl_atlet`.`id_jk`) join tbl_propinsi on (`tbl_propinsi`.`id_propinsi` = `tbl_atlet`.`id_propinsi`)";
echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns,$sJoin )
);