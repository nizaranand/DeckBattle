<?php
include 'db_connect.php';
include 'login_functions.php';

sec_session_start();

if(login_check($mysqli) != true) {
 
 header('Location: http://www.deckbattle.com/dashboard/login.php?error=notloggedin');
  
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>DeckBattle Dashboard</title>
 


</head>

<body>

<?php include './dashboard_header.php'; ?>
<?php include './dashboard_farleftsidebar.php'; ?>
<?php include './dashboard_leftsidebar_cardsdecks.php'; ?>
    
<!-- Content begins -->
<div id="content">
<?php include './dashboard_pageheader.php'; ?>
<?php include './dashboard_breadcrumb.php'; ?>  
    <!-- Main content -->
    <div class="wrapper">
      
        <div class="wButton grid6">
<a class="buttonL bGreen" style="margin-top: 10px;" title="" href="addcardstodeck.php?deckid=<?php echo $deckid; ?>">Add cards to Deck</a>
<a class="buttonL bBlue" style="margin-top: 5px;" title="" href="decks.php">Back to Deck Collection</a>
</div>

          <?php
		
		
		$id = 1;
		$class = "all";
		$imgurl = "/dashboard/images/decks/standardcovers/deckcover_nocards.png";
		$name = "";
		$totalamount = "0";
		$isFavorite = '<div class="fs1 iconb" data-icon="&#xe084;"></div>';
		$userid = $_SESSION['user_id'];
		
		if ($stmt = $mysqli->prepare("SELECT deckname, deckimage, isFavorite,color, (SELECT SUM(amount_normal) from user_decks_cards udc WHERE udc.deckid = ud.id) as totalnormal, (SELECT SUM(amount_foil) from user_decks_cards udc WHERE udc.deckid = ud.id) as totalfoil FROM user_decks ud WHERE ud.id = ? AND userid = ?")) { 
		$stmt->bind_param('ss', $deckid,$userid); 
		$stmt->execute(); 
		$stmt->store_result();
		$stmt->bind_result($db_deckname, $db_deckimage, $db_isFavorite, $db_color, $db_totalnormal, $db_totalfoil); // get variables from result.
		
		
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
$isFavorite = '<div class="fs1 iconb" data-icon="&#xe086;"></div>';
}
else
		$isFavorite = '<div class="fs1 iconb" data-icon="&#xe084;"></div>';

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
          <img src="<?php echo $imgurl; ?>" alt="" /></a><strong><?php echo $name; ?></strong><span> Amount Normal: <?php echo $db_totalnormal; ?> cards</span><span> Amount Foil: <?php echo $db_totalfoil; ?> cards</span>
          <?php echo $isFavorite; ?>
 
 Change images. change title  > ajax style.
  
 Stats:
 Bar chart: Land,Instants,Sorcery,Enchantment(Aura, Curse),Creatures,Artifact, planeswalker
 
 Total deck value
 
 Check Legality/Compare deck/Share deck
 
 Notes
 
 Comments
 
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

        
        
        <div class="clear"></div>
    </div>
    <!-- Main content ends -->
</div>
<!-- Content ends -->

</body>
</html>
<?php } ?>