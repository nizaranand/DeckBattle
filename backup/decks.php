<?php
include 'db_connect.php';
include 'login_functions.php';

sec_session_start();

if(login_check($mysqli) != true) {
 
 header('Location: ./login.php?error=notloggedin');
  
} else {
	
	
	if (isset($_POST['deckname']) && $_POST['deckname'] != "")
	{
	
	$userid = $_SESSION['user_id'];
	$deckname = $_POST['deckname'];
	$decktype = $_POST['Red'] . $_POST['Green'] . $_POST['White'] . $_POST['Black']. $_POST['Blue']. $_POST['Artifact'];
	
	if ($insert = $mysqli->prepare("INSERT INTO user_decks (userid, deckname, color) VALUES (?,?,?);")) {    
					$insert->bind_param('sss',$userid,$deckname ,$decktype); 
					$insert->execute();
				}
	
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
  <title>DeckBattle Dashboard</title>
  <link href="css/styles.css" rel="stylesheet" type="text/css" />
  <!--[if IE]> <link href="css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
  <script type="text/javascript" src="js/plugins/forms/ui.spinner.js"></script>
  <script type="text/javascript" src="js/plugins/forms/jquery.mousewheel.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  <script type="text/javascript" src="js/plugins/charts/excanvas.min.js"></script>
  <script type="text/javascript" src="js/plugins/charts/jquery.flot.js"></script>
  <script type="text/javascript" src="js/plugins/charts/jquery.flot.orderBars.js"></script>
  <script type="text/javascript" src="js/plugins/charts/jquery.flot.pie.js"></script>
  <script type="text/javascript" src="js/plugins/charts/jquery.flot.resize.js"></script>
  <script type="text/javascript" src="js/plugins/charts/jquery.sparkline.min.js"></script>
  <script type="text/javascript" src="js/plugins/tables/jquery.dataTables.js"></script>
  <script type="text/javascript" src="js/plugins/tables/jquery.sortable.js"></script>
  <script type="text/javascript" src="js/plugins/tables/jquery.resizable.js"></script>
  <script type="text/javascript" src="js/plugins/forms/autogrowtextarea.js"></script>
  <script type="text/javascript" src="js/plugins/forms/jquery.uniform.js"></script>
  <script type="text/javascript" src="js/plugins/forms/jquery.inputlimiter.min.js"></script>
  <script type="text/javascript" src="js/plugins/forms/jquery.tagsinput.min.js"></script>
  <script type="text/javascript" src="js/plugins/forms/jquery.maskedinput.min.js"></script>
  <script type="text/javascript" src="js/plugins/forms/jquery.autotab.js"></script>
  <script type="text/javascript" src="js/plugins/forms/jquery.chosen.min.js"></script>
  <script type="text/javascript" src="js/plugins/forms/jquery.dualListBox.js"></script>
  <script type="text/javascript" src="js/plugins/forms/jquery.cleditor.js"></script>
  <script type="text/javascript" src="js/plugins/forms/jquery.ibutton.js"></script>
  <script type="text/javascript" src="js/plugins/forms/jquery.validationEngine-en.js"></script>
  <script type="text/javascript" src="js/plugins/forms/jquery.validationEngine.js"></script>
  <script type="text/javascript" src="js/plugins/uploader/plupload.js"></script>
  <script type="text/javascript" src="js/plugins/uploader/plupload.html4.js"></script>
  <script type="text/javascript" src="js/plugins/uploader/plupload.html5.js"></script>
  <script type="text/javascript" src="js/plugins/uploader/jquery.plupload.queue.js"></script>
  <script type="text/javascript" src="js/plugins/wizards/jquery.form.wizard.js"></script>
  <script type="text/javascript" src="js/plugins/wizards/jquery.validate.js"></script>
  <script type="text/javascript" src="js/plugins/wizards/jquery.form.js"></script>
  <script type="text/javascript" src="js/plugins/ui/jquery.collapsible.min.js"></script>
  <script type="text/javascript" src="js/plugins/ui/jquery.breadcrumbs.js"></script>
  <script type="text/javascript" src="js/plugins/ui/jquery.tipsy.js"></script>
  <script type="text/javascript" src="js/plugins/ui/jquery.progress.js"></script>
  <script type="text/javascript" src="js/plugins/ui/jquery.timeentry.min.js"></script>
  <script type="text/javascript" src="js/plugins/ui/jquery.colorpicker.js"></script>
  <script type="text/javascript" src="js/plugins/ui/jquery.jgrowl.js"></script>
  <script type="text/javascript" src="js/plugins/ui/jquery.fancybox.js"></script>
  <script type="text/javascript" src="js/plugins/ui/jquery.fileTree.js"></script>
  <script type="text/javascript" src="js/plugins/ui/jquery.sourcerer.js"></script>
  <script type="text/javascript" src="js/plugins/others/jquery.fullcalendar.js"></script>
  <script type="text/javascript" src="js/plugins/others/jquery.elfinder.js"></script>
  <script type="text/javascript" src="js/plugins/ui/jquery.easytabs.min.js"></script>
  <script type="text/javascript" src="js/files/bootstrap.js"></script>
  <script type="text/javascript" src="js/plugins/ui/jquery.easing.1.3.js"></script>
  <script type="text/javascript" src="js/plugins/ui/jquery.quicksand.js"></script>
  <script src="js/plugins/ui/jquery-css-transform.js" type="text/javascript"></script>
  <script src="js/plugins/ui/jquery-animate-css-rotate-scale.js" type="text/javascript"></script>
  <script type="text/javascript">
<?php
//check passrecovery active > show growl message
if ($_SESSION['passrecoveryactive'] == 1)
{
echo "var rec = true;";
 }
 else
 {
	echo "var rec = false;";
 }
 
 $deckid = $_GET['deckid'];
 
?>

var userid = '<?php echo $_SESSION['user_id']; ?>';
var deckid = '<?php echo $deckid; ?>';
  
  (function($) {
	$.fn.sorted = function(customOptions) {
		var options = {
			reversed: false,
			by: function(a) {
				return a.text();
			}
		};
		$.extend(options, customOptions);
	
		$data = $(this);
		arr = $data.get();
		arr.sort(function(a, b) {
			
		   	var valA = options.by($(a));
		   	var valB = options.by($(b));
			if (options.reversed) {
				return (valA < valB) ? 1 : (valA > valB) ? -1 : 0;				
			} else {		
				return (valA < valB) ? -1 : (valA > valB) ? 1 : 0;	
			}
		});
		return $(arr);
	};

})(jQuery);

$(function() {
  
  var read_button = function(class_names) {
    var r = {
      selected: false,
      type: 0
    };
    for (var i=0; i < class_names.length; i++) {
      if (class_names[i].indexOf('selected-') == 0) {
        r.selected = true;
      }
      if (class_names[i].indexOf('segment-') == 0) {
        r.segment = class_names[i].split('-')[1];
      }
    };
    return r;
  };
  
  var determine_sort = function($buttons) {
    var $selected = $buttons.parent().filter('[class*="selected-"]');
    return $selected.find('a').attr('data-value');
  };
  
  var determine_kind = function($buttons) {
    var $selected = $buttons.parent().filter('[class*="selected-"]');
    return $selected.find('a').attr('data-value');
  };
  
  var $preferences = {
    duration: 800,
    easing: 'easeInOutQuad',
    adjustHeight: false
  };
  
  var $list = $('#list');
  var $data = $list.clone();
  
  var $controls = $('ul.splitter ul');
  
  $controls.each(function(i) {
    
    var $control = $(this);
    var $buttons = $control.find('a');
    
    $buttons.bind('click', function(e) {
      
      var $button = $(this);
      var $button_container = $button.parent();
      var button_properties = read_button($button_container.attr('class').split(' '));      
      var selected = button_properties.selected;
      var button_segment = button_properties.segment;

      if (!selected) {

        $buttons.parent().removeClass('selected-0').removeClass('selected-1').removeClass('selected-2').removeClass('selected-3').removeClass('selected-4').removeClass('selected-5').removeClass('selected-6').removeClass('selected-7').removeClass('selected-8').removeClass('selected-9').removeClass('selected-10').removeClass('selected-11').removeClass('selected-12').removeClass('selected-13');
        $button_container.addClass('selected-' + button_segment);
        
        var sorting_type = determine_sort($controls.eq(1).find('a'));
        var sorting_kind = determine_kind($controls.eq(0).find('a'));
        
        if (sorting_kind == 'all') {
          var $filtered_data = $data.find('li');
        } else {
          var $filtered_data = $data.find('li.' + sorting_kind);
        }
        
        if (sorting_type == 'size') {
          var $sorted_data = $filtered_data.sorted({
			  reversed: true,
            by: function(v) {
              return parseFloat($(v).find('span').text());
            }
          });
        } else {
          var $sorted_data = $filtered_data.sorted({
            by: function(v) {
              return $(v).find('strong').text().toLowerCase();
            }
          });
        }
        
        $list.quicksand($sorted_data, $preferences);
        
      }
      
      e.preventDefault();
    });
    
  }); 

  
      $preferences.useScaling = true;
});	
  
  var userid = '<?php echo $_SESSION['user_id']; ?>';

  </script>
  <script type="text/javascript" src="js/files/functions.js"></script>
  <script type="text/javascript" src="js/charts/chart.js"></script>
  <script type="text/javascript" src="js/charts/hBar_side.js"></script>
  <style>
.image-grid {
	
	
	
}
.image-grid:after {
	clear: both;
	content: "";
	display: block;
	height: 0;
	overflow: hidden;
}
.image-grid li {
	color: #686F74;
	float: left;
	font-family: "Helvetica Neue", sans-serif;
	/* height: 178px;*/
	line-height: 17px;
	margin: 10px 0 0 10px;
	overflow: hidden;
	text-align: center;/*    width: 128px;*/
}
.image-grid li img, .image-grid li strong {
	display: block;
}
.image-grid li strong {
	color: #000;
}

strong {
	color: #000;
	font-weight: normal;
}
.splitter li, .splitter ul, .splitter ul li a {
	display: inline-block;
	line-height: 1;
}

.splitter li { margin-top:5px;
}
.splitter > li {
/*	padding-left: 8px;*/
}
</style>
  </head>

  <body>
  <?php include './dashboard_header.php'; ?>
  <?php include './dashboard_farleftsidebar.php'; ?>
    <?php include './dashboard_leftsidebar.php'; ?>

  <!-- Content begins -->
  <div id="content">
    <?php include './dashboard_pageheader.php'; ?>
    <?php include './dashboard_breadcrumb.php'; ?>
    <!-- Main content -->
    <div class="wrapper">
      <div class="wButton grid6 mb5"> <a class="buttonL bGreen" style="margin-top:10px;" title="" href="#" id="adddeckdialog_open">Add Deck</a> </div>
      <div>
        <ul class="splitter">
          <li>
            <ul>
              <li class="segment-1 selected-1"><a class="buttonS bSea " href="#" data-value="all">All Decks</a></li>
              <li class="segment-0 "><a class="buttonS bDefault " href="#" data-value="white">White</a></li>
              <li class="segment-2"><a class="buttonS bGreen " href="#" data-value="green">Green</a></li>
              <li class="segment-3"><a class="buttonS bRed " href="#" data-value="red">Red</a></li>
              <li class="segment-4"><a class="buttonS bBlue " href="#" data-value="blue">Blue</a></li>
              <li class="segment-5"><a class="buttonS bBlack  " href="#" data-value="black" >Black</a></li>
              <li class="segment-6"><a class="buttonS bGreyish " href="#" data-value="artifact">Artifact</a></li>
              <li class="segment-7"><a class="buttonS bGold " href="#" data-value="twocolors">Two colors</a></li>
              <li class="segment-8"><a class="buttonS bGold " href="#" data-value="threecolors">Three colors</a></li>
              <li class="segment-9"><a class="buttonS bGold " href="#" data-value="fourcolors">Four colors</a></li>
              <li class="segment-10"><a class="buttonS bGold " href="#" data-value="fivecolors">Five colors</a></li>
              <li class="segment-11"><a class="buttonS bGreyish " href="#" data-value="none">None</a></li>
            
            </ul>
          </li>
          <li>Sort by:
            <ul>
              <li class="segment-12"><a href="#" data-value="name">Name</a></li>
              <li class="segment-13"><a href="#" data-value="size">Size</a></li>
            </ul>
          </li>
         <!-- <li>View as:
            <ul>
              <li><a href="#" data-value="covers">Covers</a></li>
              <li><a href="#" data-value="list">List</a></li>
            </ul>
          </li>-->
        </ul>
      </div>
      <div> 
        <!-- read the documentation to understand what’s going on here -->
        <ul id="list" class="image-grid">
          <?php
		
		
		$id = 1;
		$class = "all";
		$imgurl = "/dashboard/images/decks/standardcovers/deckcover_nocards.png";
		$name = "";
		$totalamount = "0";
		$isFavorite = '<div class="fs1 iconb" data-icon="&#xe084;"></div>';
		
		
		if ($stmt = $mysqli->prepare("SELECT ud.id, deckname, deckimage, isFavorite,color, (SELECT SUM(amount_normal)+SUM(amount_foil) from user_decks_cards udc WHERE udc.deckid = ud.id) as totalcards FROM user_decks ud WHERE userid = ?")) { 
		$stmt->bind_param('s', $_SESSION['user_id']); 
		$stmt->execute(); 
		$stmt->store_result();
		$stmt->bind_result($deckid,$db_deckname, $db_deckimage, $db_isFavorite, $db_color, $db_total); // get variables from result.
		
		
 while ($stmt->fetch()) {

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
		?>
          <li data-id="id-<?php echo $id; ?>" class="<?php echo $class; ?>"><a href="deckdetail.php?deckid=<?php echo $deckid;?>" ><img src="<?php echo $imgurl; ?>" alt="" /></a><strong><?php echo $name; ?></strong><span><?php echo $totalamount; ?> cards</span><?php echo $isFavorite; ?></li>
          <?php
$id++;
 }
}
		?>
        </ul>
      </div>
    </div>
    <!-- Main content ends --> 
  </div>
  <!-- Main content ends -->
  </div>
  <!-- Content ends -->


           <!-- Dialog content -->
                        <div id="adddeckdialog" class="dialog" title="Add Deck" style="text-align:center;">
                            <form id="addeckform" action="" method="post">
                                <input type="text" name="deckname" class="clear" style="width:250px;" placeholder="Enter the name for your deck" />
                                
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
                                <input type="submit" name="submit" value="Create Deck" class="buttonM bBlue" /></div>
                            </form>
                        </div>

  </body>
</html>
<?php } ?>