<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

include  'dashboard/include/db_connect.php';
include  'dashboard/include/login_functions.php';

sec_session_start();

if(login_check($mysqli) != true) {
 
 header('Location: http://www.deckbattle.com/dashboard/login.php?error=notloggedin');
  
} else {
	
	$deckid = $_GET['deckid'];
	$_SESSION['deckid'] = $deckid;
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>DeckBattle Deck Detail</title>
<link href="/dashboard/css/styles.css" rel="stylesheet" type="text/css" />
<!--[if IE]> <link href="/dashboard/css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->
<style>
.btn-group:before, .btn-group:after {
	content: "";
	display: none;
}
.btn-group.toolbar {
	margin-left: 8px;
}
.centeredtd {
	text-align: center;
}
label {
	padding-left: 10px;
}
.dataTables_length {
	padding-right: 10px;
}
</style>
<script type="text/javascript">
var userid = '<?php echo $_SESSION['user_id']; ?>';
var deckid = '<?php echo $deckid; ?>';

</script>
<?php include 'dashboard/include/script_include.php'; ?>
<script type="text/javascript" src="/dashboard/js/files/datatable_global.js"></script>
<script type="text/javascript" src="/dashboard/js/files/datatable_replacers.js"></script>
<script type="text/javascript" src="/dashboard/js/files/datatable_toolbars.js"></script>
<script type="text/javascript" src="/dashboard/js/files/datatable_deck.js"></script>
<script type="text/javascript" src="/dashboard/js/charts/pie_deckdetail.js"></script>
<script type="text/javascript" src="/dashboard/js/charts/bar_manacurve.js"></script>
<script type="text/javascript">
$(function() {
$("select, .check, .check :checkbox, input:radio, input:file").uniform();


});

</script>
</head>

<body>
<?php include 'dashboard/include/dashboard_header.php'; ?>
<?php include 'dashboard/include/dashboard_farleftsidebar.php'; ?>
<?php include 'dashboard/include/dashboard_leftsidebar_cardsdecks.php'; ?>

<!-- Content begins -->
<div id="content">
<?php include 'dashboard/include/dashboard_pageheader.php'; 
createPageHeader("Deck Detail",$mysqli);
?>
<?php include 'dashboard/include/dashboard_breadcrumb.php';
generateBreadcrumb("Dashboard","Cards & Decks","Deck Detail");
 ?>
<!-- Main content -->
<div class="wrapper">
  <div class="wButton grid6"> <a class="buttonL bGreen" style="margin-top: 10px;" title="" href="add_cards_deck.php">Add cards to Deck</a> <a class="buttonL bBlue" style="margin-top: 5px;" title="" href="decks.php">Back to Deck Collection</a> </div>
  <?php
		
		
		$id = 1;
		$class = "all";
		$imgurl = "/dashboard/images/decks/standardcovers/deckcover_nocards.png";
		$name = "";
		$totalamount = "0";
		$isFavorite = '<div class="fs1 iconb" data-icon="&#xe084;"></div>';
		$userid = $_SESSION['user_id'];
		
		if ($stmt = $mysqli->prepare("SELECT deckname, deckimage, isFavorite,color, (SELECT SUM(amount_normal) from user_decks_cards udc WHERE udc.deckid = ud.id) as totalnormal, (SELECT SUM(amount_foil) from user_decks_cards udc WHERE udc.deckid = ud.id) as totalfoil , markfordropbox FROM user_decks ud WHERE ud.id = ? AND userid = ?")) { 
		$stmt->bind_param('ss', $deckid,$userid); 
		$stmt->execute(); 
		$stmt->store_result();
		$stmt->bind_result($db_deckname, $db_deckimage, $db_isFavorite, $db_color, $db_totalnormal, $db_totalfoil,$db_isDropbox); // get variables from result.
		
		
 $stmt->fetch(); 

if ($db_total != "")
$totalamount = $db_total;
else
$totalamount = 0;

if ($db_deckimage != "")
{
	$imgurl = "/dashboard/images/decks/" + $db_deckimage;
}


if ($db_isFavorite == "1")
{
$isFavorite = '<div class="fs1 iconb"  style="display:inline-block;" data-icon="&#xe086;"></div>';
}
else
		$isFavorite = '<div class="fs1 iconb" style="display:inline-block;"  data-icon="&#xe084;"></div>';

if ($db_isDropbox == "1")
{
$dropbox = '<img src="/dashboard/images/icons/dropbox.png" style="display:inline-block;margin-top:2px;margin-left:5px;" />';
}
else
$dropbox = '';


$name = $db_deckname;

if ($imgurl != "")
{
//check main color, or type of colors.
if ($db_color == "")
{
$imgurl = "/dashboard/images/decks/standardcovers/deckcover_nocards.png";
$class = "none";
}
if ($db_color == "{R}")
{
$imgurl = "/dashboard/images/decks/standardcovers/deckcover_mountain.png";
$class = "red";
}
if ($db_color == "{G}")
{
$imgurl = "/dashboard/images/decks/standardcovers/deckcover_forest.png";
$class = "green";
}
if ($db_color == "{B}")
{
$imgurl = "/dashboard/images/decks/standardcovers/deckcover_swamp.png";
$class = "black";
}
if ($db_color == "{U}"){
$imgurl = "/dashboard/images/decks/standardcovers/deckcover_island.png";
$class = "blue";
}
if ($db_color == "{W}")
{
$imgurl = "/dashboard/images/decks/standardcovers/deckcover_plains.png";
$class = "white";
}
if ($db_color == "{A}")
{
$imgurl = "/dashboard/images/decks/standardcovers/deckcover_artifact.png";
$class = "artifact";
}

$temp = explode("}",$db_color);
$size = count($temp);

if ($size == 3)
{
$imgurl = "/dashboard/images/decks/standardcovers/deckcover_multicolor.png";
$class = "twocolors";
}

if ($size == 4)
{
$imgurl = "/dashboard/images/decks/standardcovers/deckcover_multicolor.png";
$class = "threecolors";
}

if ($size == 5)
{
$imgurl = "/dashboard/images/decks/standardcovers/deckcover_multicolor.png";
$class = "fourcolors";
}

if ($size == 6)
{
$imgurl = "/dashboard/images/decks/standardcovers/deckcover_multicolor.png";
$class = "fivecolors";
}

}
}



		?>
  <div class="fluid" style="margin-top:10px;">
    <div class="grid12">
     
      <h3 style="display: inline-block;margin-top:10px;font-size:32px"><?php echo $name; ?></h3>
    <ul class="titleToolbar" style="display: inline-block;">
                       <li><a class="" href="#">Mark/Unmark for Dropbox Sync.</a></li>
<!--                       
                       <li><a class="" href="#">Check Legality</a></li>
                        <li><a class="" href="#">Compare Deck</a></li>
                         <li><a class="" href="#"><span class="icos-heart"></span>Share Deck</a></li>
                        <li class="drd"><a data-toggle="dropdown" href="#">Version 1</a>
                            <ul class="dropdown-menu pull-right">
                                <li><a class="" href="#"><span class="icos-pencil"></span>Add new version</a></li>
                                <li><a class="" href="#"><span class="icos-pencil"></span>Select version</a></li>
                                <li><a href="#"><span class="icos-trash"></span>Remove</a></li>
                               
                            </ul>
                        </li>-->
                   </ul> 
    </div>
  </div>
        
  <div class="fluid">
    <div class="widget grid2">
      <div class="whead">
        <h6>Deck Cover</h6>
        <div class="titleOpt"> <a href="#" data-toggle="dropdown"><span class="icos-cog3"></span><span class="clear"></span></a>
          <ul class="dropdown-menu pull-right">
            <li><a href="#" class=""><span class="icos-pencil"></span>Change Cover</a></li>
            <li><a href="#" class=""><span class="icos-star"></span>Mark/Unmark as favorite</a></li>
          </ul>
        </div>
        <div class="clear"></div>
      </div>
      <div class="body" style="text-align:center;"> <img src="<?php echo $imgurl; ?>" alt="" /><br /> <?php echo $isFavorite; ?><?php echo $dropbox; ?> </div>
    </div>
    <div class="widget grid2">
      <div class="whead">
        <h6>Quickstats</h6>
        <div class="clear"></div>
      </div>
      <div class="body"> Amount Normal: <?php echo $db_totalnormal; ?> cards<br />
        Amount Foil: <?php echo $db_totalfoil; ?> cards<br />
        <div class="divider"></div>
        Average mana cost: 4.76<br />
        0 Colored Mana: 5 cards<br />
        1 Colored Mana: 18 cards<br />
        2 Colored Mana: 99 cards<br />
        3+ Colored Mana: 100 cards<br />
        <div class="divider"></div>
        Total missing: 10 cards </div>
    </div>
    <div class="widget grid4 chartWrapper">
      <div class="whead">
        <h6>Card Types</h6>
        <div class="titleOpt"> <a href="#" data-toggle="dropdown"><span class="icos-cog3"></span><span class="clear"></span></a>
          <ul class="dropdown-menu pull-right">
            <li><a onclick="pieCardtype()" href="#" class=""><span class="icos-coverflow"></span>Card Types</a></li>
            <li><a onclick="pieColors()" href="#" class=""><span class="icos-view"></span>Card Color</a></li>
          </ul>
        </div>
        <div class="clear"></div>
      </div>
      <div class="body">
        <div class="pie" id="donut"></div>
      </div>
    </div>
    <div class="widget grid4 chartWrapper">
      <div class="whead">
        <h6>Mana Curve</h6>
        <div class="titleOpt"> <a href="#" data-toggle="dropdown"><span class="icos-cog3"></span><span class="clear"></span></a>
          <ul class="dropdown-menu pull-right">
            <li><a onclick="barTotals()" href="#" class=""><span class="icos-fullscreen"></span>Totals</a></li>
            <li><a onclick="barColors()" href="#" class=""><span class="icos-view"></span>Card Color</a></li>
          </ul>
        </div>
        <div class="clear"></div>
      </div>
      <div class="body">
        <div class="bars" id="placeholder1"></div>
      </div>
    </div>
    </div>
    <div class="widget">
      <div class="whead">
        <h6>Main Deck</h6>
        <div class="clear"></div>
      </div>
      <div class="shownpars" >
        <table cellpadding="0" cellspacing="0" border="0" class="deck">
          <thead>
            <tr>
              <th>ID</th>
              <!--
                <th style="width:220px;">Name</th>
                <th style="width:230px;">Type</th>
                <th style="width:100px;">Cost</th>
                <th style="width:80px;">Color</th>
                <th style="width:30px;">EditionAbbreviation</th>
                <th style="width:30px;">Edition</th>
                <th style="width:30px;">Rarity</th>
                <th style="width:30px;">#</th>
                <th>Options</th>
                -->
              <th>Name</th>
              <th style="width:180px;">Type</th>
              <th style="width:120px;">Cost</th>
              <th style="width:90px;">Color</th>
              <th>EditionAbbreviation</th>
              <th style="width:30px;">Edition</th>
              <th style="width:30px;">Rarity</th>
              <th style="width:30px;">Normal</th>
              <th style="width:30px;">Foil</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td style="text-align:center;"></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="widget">
      <div class="whead">
        <h6>Sideboard</h6>
        <div class="clear"></div>
      </div>
      <div class="shownpars" >
        <table cellpadding="0" cellspacing="0" border="0" class="sideboard">
          <thead>
            <tr>
              <th>ID</th>
              <!--
                <th style="width:220px;">Name</th>
                <th style="width:230px;">Type</th>
                <th style="width:100px;">Cost</th>
                <th style="width:80px;">Color</th>
                <th style="width:30px;">EditionAbbreviation</th>
                <th style="width:30px;">Edition</th>
                <th style="width:30px;">Rarity</th>
                <th style="width:30px;">#</th>
                <th>Options</th>
                -->
              <th>Name</th>
              <th style="width:180px;">Type</th>
              <th style="width:120px;">Cost</th>
              <th style="width:90px;">Color</th>
              <th>EditionAbbreviation</th>
              <th style="width:30px;">Edition</th>
              <th style="width:30px;">Rarity</th>
              <th style="width:30px;">Normal</th>
              <th style="width:30px;">Foil</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td style="text-align:center;"></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- 
    <div class="widget grid12">
      <div class="whead">
        <h6>Notes</h6>
        <div class="clear"></div>
      </div>
      <div class="body">
        Notes
        &amp;
        Comments </div>
    </div>
    -->
    <div class="clear"></div>
  </div>
  <!-- Main content ends --> 
</div>
<!-- Content ends -->

</body>
</html>
<?php } ?>