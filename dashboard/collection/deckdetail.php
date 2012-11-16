<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
include 'dashboard/include/base_include.php';

//
$class = "all";
$imgurl = $noColorDeckImage;
$name = "";
$totalamount = "0";
$userid = $_SESSION['user_id'];
$dropbox = '';

$deckid = $_GET['deckid'];

if (intval($deckid) > 0) {
	include 'dashboard/services/uploaddeckcover.php';

	$_SESSION['deckid'] = $deckid;

	if ($stmt = $mysqli -> prepare("SELECT deckname, deckimage, isFavorite,color, (SELECT SUM(amount_normal) from user_decks_cards udc WHERE udc.deckid = ud.id) as totalnormal, (SELECT SUM(amount_foil) from user_decks_cards udc WHERE udc.deckid = ud.id) as totalfoil , markfordropbox FROM user_decks ud WHERE ud.id = ? AND userid = ?")) {
		$stmt -> bind_param('ss', $deckid, $userid);
		$stmt -> execute();
		$stmt -> store_result();
		$stmt -> bind_result($db_deckname, $db_deckimage, $db_isFavorite, $db_color, $db_totalnormal, $db_totalfoil, $db_isDropbox);
		$stmt -> fetch();

		$name = $db_deckname;

		if ($db_total != "") {
			$totalamount = $db_total;
		}

		if ($db_isFavorite == "1") {
			$isFavorite = '<div class="fs1 iconb"  style="display:inline-block;" data-icon="&#xe086;"></div>';
		} else {
			$isFavorite = '<div class="fs1 iconb" style="display:inline-block;"  data-icon="&#xe084;"></div>';
		}

		if ($db_isDropbox == "1") {
			$dropbox = '<img src="/dashboard/images/icons/dropbox.png" style="display:inline-block;margin-top:2px;margin-left:5px;" />';
		}

		$temparray = determineImageAndClass($db_color);

		$imgurl = $temparray['url'];
		$class = $temparray['class'];

		if ($db_deckimage != "") {

			$checkimgurl = $dir_usercovers . $db_deckimage;

			if (file_exists($checkimgurl)) {
				$imgurl = $checkimgurl;
			}
		}
	}
}
//
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>DeckBattle</title>
<link href="/dashboard/css/styles.css" rel="stylesheet" type="text/css" />
<!--[if IE]> <link href="/dashboard/css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->
<link href="/dashboard/css/datatable_styles_override.css" rel="stylesheet" type="text/css" />
<?php
	include 'dashboard/include/script_include.php';
 ?>
<script type="text/javascript" src="/dashboard/js/files/datatable_global.js"></script>
<script type="text/javascript" src="/dashboard/js/files/datatable_replacers.js"></script>
<script type="text/javascript" src="/dashboard/js/files/datatable_toolbars.js"></script>
<script type="text/javascript" src="/dashboard/js/files/datatable_deck.js"></script>
<script type="text/javascript" src="/dashboard/js/files/deckdetail.js"></script>
<script type="text/javascript" src="/dashboard/js/charts/pie_deckdetail.js"></script>
<script type="text/javascript" src="/dashboard/js/charts/bar_manacurve.js"></script>
<script type="text/javascript">
	$(function() {
		$("select, .check, .check :checkbox, input:radio, input:file").uniform();
	}); 
</script>
</head>

<body>
<?php
	include 'dashboard/include/dashboard_header.php';
 ?>
<?php
	include 'dashboard/include/dashboard_farleftsidebar.php';
 ?>
<?php
	include 'dashboard/include/dashboard_leftsidebar_cardsdecks.php';
 ?>

<!-- Content begins -->
<div id="content">
  <?php
	include 'dashboard/include/dashboard_pageheader.php';
	createPageHeader("Deck Detail", $mysqli);
?>
  <?php
	include 'dashboard/include/dashboard_breadcrumb.php';
	generateBreadcrumb("Dashboard", "Cards & Decks", "Deck Detail");
?>
  <!-- Main content -->
  <div class="wrapper">
    <div class="wButton grid6"> <a class="buttonL bGreen" style="margin-top: 10px;" title="" href="add_cards_deck.php">Add cards to Deck</a> <a class="buttonL bBlue" style="margin-top: 5px;" title="" href="decks.php">Back to Deck Collection</a> </div>
    <div class="fluid" style="margin-top:10px;">
      <div class="grid12">
        <h3 style="display: inline-block;margin-top:10px;font-size:32px"><?php echo $name; ?></h3>
        <ul class="titleToolbar" style="display: inline-block;">
          <li><a class="" href="#">Dropbox Settings</a></li>
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
              <li><a href="#" class="" id="uploadimagedialog_open"><span class="icos-pencil"></span>Change Cover</a></li>
              <li><a href="#" class=""><span class="icos-star"></span>Mark/Unmark as favorite</a></li>
            </ul>
          </div>
          <div class="clear"></div>
        </div>
        <div class="body" style="text-align:center;"> <img src="<?php echo $imgurl; ?>" alt="" /><br />
          <?php echo $isFavorite; ?><?php echo $dropbox; ?> </div>
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
<div id="uploadimagedialog" class="dialog" title="Upload Deckcover" style="text-align:center;">
<form action="" method="post" enctype="multipart/form-data" class="main" id="imageupload">
  <label><strong>.jpg/.png/.gif || Width: 128px, Height: 178. Image will be cropped if larger.</strong></label>
  <input type="file" class="fileInput" id="imagefile" name="imagefile" />
  <div>
    <input type="submit" class="buttonS bGreyish" name="uploadimage" value="Upload Image" />
  </div>
</form>
</body>
</html>