<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once 'dashboard/include/db_connect.php';

header('Content-Type: text/html; charset=utf-8');

$userid = $_GET['userid'];

$aColumns = array('Ncardid','Ncardid', 'Ncardname', 'Ntype', 'Nmanacost', 'Ncolor', 'Nname', 'Nrarity', 'Ncardid','Nset');
$sIndexColumn = "Ncardid";

/* DB table to use */
$sTable = "Ncards c JOIN Nsets on Ncode = Nset";

/*
 * Paging
 */
$sLimit = "";
if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
	$sLimit = "LIMIT " . mysqli_real_escape_string($mysqli,$_GET['iDisplayStart']) . ", " . mysqli_real_escape_string($mysqli,$_GET['iDisplayLength']);
}

/*
 * Ordering
 */
$sOrder = "";
if (isset($_GET['iSortCol_0'])) {
	$sOrder = "ORDER BY  ";
	for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
		if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
			$sOrder .= "`" . $aColumns[intval($_GET['iSortCol_' . $i])] . "` " . mysqli_real_escape_string($mysqli,$_GET['sSortDir_' . $i]) . ", ";
		}
	}

	$sOrder = substr_replace($sOrder, "", -2);
	if ($sOrder == "ORDER BY") {
		$sOrder = "";
	}
}

$sWhere = "";
if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
	$sWhere = "WHERE (";
	for ($i = 0; $i < count($aColumns); $i++) {
		$sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . mysqli_real_escape_string($mysqli,$_GET['sSearch']) . "%' OR ";
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
		$sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . mysqli_real_escape_string($mysqli,$_GET['sSearch_' . $i]) . "%' ";
	}
}

/*
 * SQL queries
 * Get data to display
 */
$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS `" . str_replace(" , ", " ", implode("`, `", $aColumns)) . "`, (SELECT amount_normal FROM user_cardcollection col WHERE col.cardid = c.Ncardid AND userid=". $userid ." LIMIT 1) as n, (SELECT amount_foil FROM user_cardcollection col WHERE  col.cardid = c.Ncardid AND userid=". $userid ." LIMIT 1) as f, (SELECT COUNT(id) FROM user_favoritecards fav WHERE  fav.cardid = c.Ncardid AND userid=". $userid ." LIMIT 1) as fav 
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
		";
           //echo $sQuery;
$rResult = $mysqli->query($sQuery); //or fatal_error('MySQL Error: ' . mysql_errno());

/* Data set length after filtering */
$sQuery = "
		SELECT FOUND_ROWS()
	";
$rResultFilterTotal = $mysqli->query($sQuery);
$aResultFilterTotal = $rResultFilterTotal->fetch_array(MYSQLI_BOTH);
$iFilteredTotal = $aResultFilterTotal[0];

/* Total data set length */
$sQuery = "
		SELECT COUNT(`" . $sIndexColumn . "`)
		FROM   $sTable
	";
$rResultTotal = $mysqli->query($sQuery);
$aResultTotal = $rResultTotal->fetch_array(MYSQLI_BOTH);
$iTotal = $aResultTotal[0];

/*
 * Output
 */
$output = array("sEcho" => intval($_GET['sEcho']), "iTotalRecords" => $iTotal, "iTotalDisplayRecords" => $iFilteredTotal, "aaData" => array());

while ($aRow = $rResult->fetch_array(MYSQL_BOTH)) {
	    
	$row = array();
	for ($i = 0; $i < (count($aColumns)+3); $i++) {
	    if ($i == 10)    {
	        if ($aRow['n'] != '')
	           $row[] = $aRow['n'];
            else
                $row[] = '';
           
            }
else if ($i == 11) {
	        if ($aRow['f'] != '')
               $row[] = $aRow['f'];
             else
                $row[] = '';
           
}
else if ($i == 12) {
            if ($aRow['fav'] != '')
               $row[] = $aRow['fav'];
             else
                $row[] = '0';
           
}else {
	        	$row[] = $aRow[$aColumns[$i]];
        }
	}

	$row[3] = utf8_encode($row[3]);
	//		$row[2]= str_replace("\u0097","-",$row[2]);
	//echo $row[2];
	$output['aaData'][] = $row;

}
//	echo json_encode($output, JSON_UNESCAPED_UNICODE);
echo json_encode($output);
?>
