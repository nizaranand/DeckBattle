<?php
header('Content-Type: text/html; charset=utf-8');
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

/* Array of database columns which should be read and sent back to DataTables. Use a space where
 * you want to insert a non-database field (for example a counter or static image)
 */
$aColumns = array('Ncardid', 'Ncardname', 'ntype', 'nmanacost', 'ncolor', 'Nset', 'Nname', 'nrarity', 'nnumber', 'nnumber', 'Ncardid');

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "Ncardid";

/* DB table to use */
$sTable = "Ncards join Nsets on nset = ncode";

/* Database connection information */
$gaSql['user'] = "w6022388_mtgdb";
$gaSql['password'] = "OWVDPN1b";
$gaSql['db'] = "w6022388_mtgdb";
$gaSql['server'] = "localhost";

/* REMOVE THIS LINE (it just includes my SQL connection user/pass) */
//	include( $_SERVER['DOCUMENT_ROOT']."/datatables/mysql.php" );

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
 * no need to edit below this line
 */

/*
 * Local functions
 */
function fatal_error($sErrorMessage = '') {
	header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
	die($sErrorMessage);
}

/*
 * MySQL connection
 */
if (!$gaSql['link'] = mysql_pconnect($gaSql['server'], $gaSql['user'], $gaSql['password'])) {
	fatal_error('Could not open connection to server');
}

if (!mysql_select_db($gaSql['db'], $gaSql['link'])) {
	fatal_error('Could not select database ');
}

/*
 * Paging
 */
$sLimit = "";
if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
	$sLimit = "LIMIT " . mysql_real_escape_string($_GET['iDisplayStart']) . ", " . mysql_real_escape_string($_GET['iDisplayLength']);
}

/*
 * Ordering
 */
$sOrder = "";
if (isset($_GET['iSortCol_0'])) {
	$sOrder = "ORDER BY  ";
	for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
		if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
			$sOrder .= "`" . $aColumns[intval($_GET['iSortCol_' . $i])] . "` " . mysql_real_escape_string($_GET['sSortDir_' . $i]) . ", ";
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
		$sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
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
$rResult = mysql_query($sQuery, $gaSql['link']) or fatal_error('MySQL Error: ' . mysql_errno());

/* Data set length after filtering */
$sQuery = "
		SELECT FOUND_ROWS()
	";
$rResultFilterTotal = mysql_query($sQuery, $gaSql['link']) or fatal_error('MySQL Error: ' . mysql_errno());
$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];

/* Total data set length */
$sQuery = "
		SELECT COUNT(`" . $sIndexColumn . "`)
		FROM   $sTable
	";
$rResultTotal = mysql_query($sQuery, $gaSql['link']) or fatal_error('MySQL Error: ' . mysql_errno());
$aResultTotal = mysql_fetch_array($rResultTotal);
$iTotal = $aResultTotal[0];

/*
 * Output
 */
$output = array("sEcho" => intval($_GET['sEcho']), "iTotalRecords" => $iTotal, "iTotalDisplayRecords" => $iFilteredTotal, "aaData" => array());

while ($aRow = mysql_fetch_array($rResult)) {
	$row = array();
	for ($i = 0; $i < count($aColumns); $i++) {
		if ($aColumns[$i] == "version") {
			/* Special output formatting for 'version' column */
			$row[] = ($aRow[$aColumns[$i]] == "0") ? '-' : $aRow[$aColumns[$i]];
		} else if ($aColumns[$i] != ' ') {
			/* General output */
			$row[] = $aRow[$aColumns[$i]];
		}

	}

	$row[2] = utf8_encode($row[2]);
	//		$row[2]= str_replace("\u0097","-",$row[2]);
	//echo $row[2];
	$output['aaData'][] = $row;

}

//	echo json_encode($output, JSON_UNESCAPED_UNICODE);
echo json_encode($output);
?>
