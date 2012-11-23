<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once 'dashboard/include/base_include.php';

//
$class = "all";
$imgurl = $noColorDeckImage;
$name = "";
$totalamount = "0";
$userid = $_SESSION['user_id'];
$dropbox = '';

$deckid = $_GET['deckid'];

if (intval($deckid) > 0) {
    require_once 'dashboard/services/uploaddeckcover.php';

    $_SESSION['deckid'] = $deckid;

//TODO:move to a service!!!
if (isset($_POST['colorsused'])) {
    $userid = $_SESSION['user_id'];
    $decktype = $_POST['Red'] . $_POST['Green'] . $_POST['White'] . $_POST['Black'] . $_POST['Blue'] . $_POST['Artifact'];

    if ($insert = $mysqli -> prepare("UPDATE user_decks SET color=? WHERE id=? and userid = ?")) {
        $insert -> bind_param('sss', $decktype, $_SESSION['deckid'],$userid );
        $insert -> execute();
    }
}

//BUILD CHART DATA




//GET DECK DETAILS
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
                $imgurl = $dir_imagedeckcover . $db_deckimage;
            }
        }    
    }

     $averagemanacost = calcAverageManaCost($deckid);
        $zerocolored = calcColoredMana(0);
        $onecolored = calcColoredMana(1);
        $twocolored = calcColoredMana(2);
        $threecolored = calcColoredMana(3);
        
        $totalmissing = calcTotalMissing($deckid);
   
   $value = array(array(label => "Creature",data => "3"),array(label => "Enchantment", data => "1"));
   $deckdata = json_encode($value);
   echo $deckdata; 
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
require_once 'dashboard/include/script_include.php';
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
		pieCardtype(<?php echo $deckdata; ?>);
	});
	
	function toggledeckfav() {
$.post("/dashboard/services/toggle_deckfavorite.php", {
deckid: '<?php echo $_SESSION['deckid']; ?>',
	}, function(response){
	setTimeout("finishAjax('"+escape(response)+"')", 400);
	});
	}

	function finishAjax(response) {
	if (response == "1")   {
	   $.jGrowl("Deck marked as favorite.");
	   $("#fav").html('<div id="fav" class="fs1 iconb"  style="display:inline-block;" data-icon="&#xe086;"></div>')
	} else {
	   $.jGrowl("Deck UNmarked as favorite.");
$("#fav").html('<div id="fav" class="fs1 iconb"  style="display:inline-block;" data-icon="&#xe084;"></div>')
	}
	}

</script>
</head>

<body>
<?php
require_once 'dashboard/include/dashboard_header.php';
 ?>
<?php
require_once 'dashboard/include/dashboard_farleftsidebar.php';
 ?>
<?php
require_once 'dashboard/include/dashboard_leftsidebar_cardsdecks.php';
 ?>

<!-- Content begins -->
<div id="content">
  <?php
require_once 'dashboard/include/dashboard_pageheader.php';
createPageHeader("Deck Detail", $mysqli);
?>
  <?php
require_once 'dashboard/include/dashboard_breadcrumb.php';
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
          <h6>Deck</h6>
          <div class="titleOpt"> <a href="#" data-toggle="dropdown"><span class="icos-cog3"></span><span class="clear"></span></a>
            <ul class="dropdown-menu pull-right">
              <li><a href="#" class="" id="uploadimagedialog_open"><span class="icos-pencil"></span>Change Cover</a></li>
              <li><a href="#" class="" onclick="toggledeckfav()"><span class="icos-star"></span>Mark/Unmark as favorite</a></li>
              <li><a href="#" class="" id="colorsuseddialog_open"><span class="icos-view"></span>Colors Used</a></li>
            </ul>
          </div>
          <div class="clear"></div>
        </div>
        <div class="body" style="text-align:center;"> <img src="<?php echo $imgurl; ?>" alt="" /><br /><div id="fav">
          <?php echo $isFavorite; ?></div><?php echo $dropbox; ?><?php echo showDeckColors($db_color); ?></div>
      </div>
      <div class="widget grid2">
        <div class="whead">
          <h6>Quickstats</h6>
          <div class="clear"></div>
        </div>
        <div class="body"> Amount Normal: <?php if ($db_totalnormal == "") echo "0"; else echo $db_totalnormal; ?> cards<br />
          Amount Foil: <?php if ($db_totalfoil == "") echo "0"; else echo $db_totalfoil; ?> cards<br />
          <div class="divider"></div>
          Average mana cost: <?php echo $averagemanacost; ?><br />
          0 Colored Mana: <?php echo $zerocolored; ?> cards<br />
          1 Colored Mana: <?php echo $onecolored; ?> cards<br />
          2 Colored Mana: <?php echo $twocolored; ?> cards<br />
          3+ Colored Mana: <?php echo $threecolored; ?> cards<br />
          <div class="divider"></div>
          Total missing: <?php echo $totalmissing ?> cards </div>
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
</div>
<div id="colorsuseddialog" class="dialog" title="Colors used in deck" style="text-align:center;">
  <form id="colorsusedform" action="" method="post">
    <div class="grid9 check">
      <input type="checkbox" id="check1" name="Red" value="{R}" />
      <label for="check1"  class="mr20">Red</label>
      <input type="checkbox" id="check2" name="Green" value="{G}" />
      <label for="check2"  class="mr20">Green</label>
      <input type="checkbox" id="check3" name="White" value="{W}" />
      <label for="check3"  class="mr20">White</label>
      <input type="checkbox" id="check4" name="Black" value="{B}" />
      <label for="check4"  class="mr20">Black</label>
      <input type="checkbox" id="check5" name="Blue" value="{U}" />
      <label for="check5"  class="mr20">Blue</label>
      <input type="checkbox" id="check6" name="Artifact" value="{A}" />
      <label for="check6"  class="mr20">Artifact</label>
    </div>
    <div style="clear:both;">
      <input type="submit" name="colorsused" value="Update Colors Used" class="buttonM bBlue" />
    </div>
  </form>
</div>

</body>
</html>