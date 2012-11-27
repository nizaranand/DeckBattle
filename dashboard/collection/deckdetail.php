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
                $isFavorite = '<div id="'. $deckid .'"><a href="#" class="fs1 iconb"  style="display:inline-block;" data-icon="&#xe086;" onclick="return toggledeckfav()"></a></div>';
            }
            else {
                $isFavorite = '<div id="'. $deckid .'"><a href="#" class="fs1 iconb" style="display:inline-block;"  data-icon="&#xe084;" onclick="return toggledeckfav()"></a></div>';
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

        $averagemanacost = calcAverageManaCost($deckid,$mysqli);
        $zerocolored = calcColoredMana(0,$deckid,$mysqli);
       $onecolored = calcColoredMana(1,$deckid,$mysqli);
        $twocolored = calcColoredMana(2,$deckid,$mysqli);
        $threecolored = calcColoredMana(3,$deckid,$mysqli);
        
        $totalmissing = calcTotalMissing($deckid,$mysqli);
        
        }
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
         var currentviewPie = "";
         var currentviewBar = "";
         
         $(function() {
		$("select, .check, .check :checkbox, input:radio, input:file").uniform();
		 
		 updatePie('Type');
         updateBar('Totals');
         	 
	});
	
	function toggledeckfav() {
$.post("/dashboard/services/toggle_deckfavorite.php", {
deckid: '<?php echo $_SESSION['deckid']; ?>',
	}, function(response){
	setTimeout("finishAjaxdeckfav('"+escape(response)+"','"+<?php echo $_SESSION['deckid']; ?>+"')", 400);
	});
	
	return false;
	}

	function finishAjaxdeckfav(response,deckid) {
	if (response == "1")   {
	   $.jGrowl("Deck marked as favorite.");
	   $("#fav").html('<a href="#" class="fs1 iconb"  style="display:inline-block;" data-icon="&#xe086;" onclick="return toggledeckfav()"></a>')
	} else {
	   $.jGrowl("Deck UNmarked as favorite.");
$("#fav").html('<a href="#" class="fs1 iconb"  style="display:inline-block;" data-icon="&#xe084;" onclick="return toggledeckfav()"></a>')
	}
	}

function addcardstodeck(_cardid, _cardname, amount_normal, amount_foil,f) {
$.post("/dashboard/services/addcards_deck.php", {
cardid: _cardid,
userid: '<?php echo $_SESSION['user_id']; ?>',
deckid: '<?php echo $deckid; ?>',
    amountn: amount_normal,
    amountf: amount_foil,
    addtofav: f,
    loc: "Deck",
    cardname:_cardname
    }, function(response){
    setTimeout("finishAjaxdeck("+_cardid+",'"+_cardname+"','Collection','"+escape(response)+"')", 400);
    });
    return false;
    }

    function finishAjaxdeck(id ,name,list,response) { //TODO: make json callback

        if (response != "") {
                var n=response.split("/");
                $('#normal_'+id).html(n[1]);
                $('#foil_'+id).html(n[2]);
                
                //update stats
                updatePie('Refresh');        
                updateBar('Refresh');        
            }
        }
    


function addcardstoside(_cardid, _cardname, amount_normal, amount_foil,f) {
$.post("/dashboard/services/addcards_deck.php", {
cardid: _cardid,
userid: '<?php echo $_SESSION['user_id']; ?>',
deckid: '<?php echo $deckid; ?>',
    amountn: amount_normal,
    amountf: amount_foil,
    addtofav: f,
    loc: "SB",
    cardname:_cardname
    }, function(response){
    setTimeout("finishAjaxside("+_cardid+",'"+_cardname+"','Collection','"+escape(response)+"')", 400);
    });
    return false;
    }

    function finishAjaxside(id ,name,list,response) { //TODO: make json callback

        if (response != "") {
                var n=response.split("/");
                $('#sidenormal_'+id).html(n[1]);
                $('#sidefoil_'+id).html(n[2]);
            
            }
            
                //update stats
                updatePie('Refresh');
            updateBar('Refresh');
            
        }
   
   function updatePie(what)
   {
     if (what == 'Refresh')
     {
         if (currentviewPie == "Type"){                
                    pieCardtype(deckid);
                }
                else {
                    pieColors(deckid);
                }
         }  
         
         if (what == 'Type'){
             currentviewPie = "Type";
             pieCardtype(deckid);
         }
         if (what == 'Color'){
             currentviewPie = "Color"
             pieColors(deckid);
                }
         
       return false;
   }

function updateBar(what)
   {
     if (what == 'Refresh')
     {
         if (currentviewBar == "Totals"){                
                    barTotals(deckid);
                }
                else {
                    barColors(deckid);
                }
         }  
         
         if (what == 'Totals'){
             currentviewBar = "Totals";
             barTotals(deckid);
         }
         if (what == 'Colors'){
             currentviewBar = "Colors"
              barColors(deckid);
                }
         
       return false;
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
    <div class="wButton grid6"> <a class="buttonL bGreen" style="margin-top: 10px;" title="" href="add_cards_deck.php?loc=Deck&deckid=<?php echo $deckid;?>">Add cards to Deck</a> </div>
    <div class="wButton grid6"> <a class="buttonL bGreen" style="margin-top: 5px;" title="" href="add_cards_deck.php?loc=SB&deckid=<?php echo $deckid;?>">Add cards to Sideboard</a> <a class="buttonL bBlue" style="margin-top: 10px;" title="" href="decks.php">Back to Deck Overview</a> </div>
    <div class="fluid" style="margin-top:10px;">
      <div class="grid12">
        <h3 style="display: inline-block;margin-top:10px;font-size:32px"><?php echo $name; ?></h3>
        <ul class="titleToolbar" style="display: inline-block;">
                        <li class="drd"><a data-toggle="dropdown" href="#">Deck Options</a>
                            <ul class="dropdown-menu pull-right">
                                <li><a class="" href="#"><span class="icos-pencil"></span>Edit name</a></li>
                                <li><a class="" href="#"><span class="icos-pencil"></span>Dropbox Settings</a></li>
                                <li><a href="#"><span class="icos-trash"></span>Delete Deck</a></li>
                            </ul>
          
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
              <li><a href="#" class="" onclick="return toggledeckfav()"><span class="icos-star"></span>Mark/Unmark as favorite</a></li>
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
          Not in Collection: <?php echo $totalmissing ?> cards </div>
      </div>
      <div class="widget grid4 chartWrapper">
        <div class="whead">
          <h6>Card Types</h6>
          <div class="titleOpt"> <a href="#" data-toggle="dropdown"><span class="icos-cog3"></span><span class="clear"></span></a>
            <ul class="dropdown-menu pull-right">
              <li><a onclick="return updatePie('Type')" href="#" class=""><span class="icos-coverflow"></span>Card Types</a></li>
              <li><a onclick="return updatePie('Color')" href="#" class=""><span class="icos-view"></span>Card Color</a></li>
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
              <li><a onclick="return updateBar('Totals')" href="#" class=""><span class="icos-fullscreen"></span>Totals</a></li>
              <li><a onclick="return updateBar('Colors')" href="#" class=""><span class="icos-view"></span>Card Color</a></li>
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
                                    <th style="width:70px;">Add Normal</th>
                                    <th style="width:70px;">Add Foil</th>
                                    <th>Name</th>
                                    <th style="width:180px;">Type</th>
                                    <th style="width:120px;">Cost</th>
                                    <th style="width:90px;">Color</th>
                                    <th style="width:30px;">Edition</th>
                                    <th style="width:30px;">Rarity</th>
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
                                    <th style="width:70px;">Add Normal</th>
                                    <th style="width:70px;">Add Foil</th>
                                    <th>Name</th>
                                    <th style="width:180px;">Type</th>
                                    <th style="width:120px;">Cost</th>
                                    <th style="width:90px;">Color</th>
                                    <th style="width:30px;">Edition</th>
                                    <th style="width:30px;">Rarity</th>
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
      <input type="checkbox" id="check1" name="Red" value="{R}" <?php if (strpos($db_color, "R") > 0) echo "checked"; ?> />
      <label for="check1"  class="mr20">Red</label>
      <input type="checkbox" id="check2" name="Green" value="{G}" <?php if (strpos($db_color, "G") > 0) echo "checked"; ?> />
      <label for="check2"  class="mr20">Green</label>
      <input type="checkbox" id="check3" name="White" value="{W}" <?php if (strpos($db_color, "W") > 0) echo "checked"; ?> />
      <label for="check3"  class="mr20">White</label>
      <input type="checkbox" id="check4" name="Black" value="{B}" <?php if (strpos($db_color, "B") > 0) echo "checked"; ?> />
      <label for="check4"  class="mr20">Black</label>
      <input type="checkbox" id="check5" name="Blue" value="{U}" <?php if (strpos($db_color, "U") > 0) echo "checked"; ?> />
      <label for="check5"  class="mr20">Blue</label>
      <input type="checkbox" id="check6" name="Artifact" value="{A}" <?php if (strpos($db_color, "A") > 0) echo "checked"; ?> />
      <label for="check6"  class="mr20">Artifact</label>
    </div>
    <div style="clear:both;">
      <input type="submit" name="colorsused" value="Update Colors Used" class="buttonM bBlue" />
    </div>
  </form>
</div>

<div id="dbdialog" class="dialog" title="Add Deck" style="text-align:center;">
  <form id="dbform" action="" method="post">

</form>
</div>

</body>
</html>