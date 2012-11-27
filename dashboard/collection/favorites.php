<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once 'dashboard/include/base_include.php';
require_once 'dashboard/include/resize_images.php';
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
		height: 250px;
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
	.splitter li {
		margin-top: 5px;
	}
	.splitter > li {
		/*  padding-left: 8px;*/
	}
</style>
<?php
require_once 'dashboard/include/script_include.php';
 ?>
<script type="text/javascript">
 
 	function toggledeckfav(did) {
$.post("/dashboard/services/toggle_deckfavorite.php", {
deckid:did,
    }, function(response){
    setTimeout("finishAjaxdeckfav('"+escape(response)+"','"+did+"')", 400);
    });
    
    return false;
    }

    function finishAjaxdeckfav(response,deckid) {
    if (response == "1")   {
       $.jGrowl("Deck marked as favorite.");
       $("#"+deckid).html('<a href="#" class="fs1 iconb"  style="display:inline-block;" data-icon="&#xe086;" onclick="return toggledeckfav('+ deckid+')"></a>')
    } else {
       $.jGrowl("Deck UNmarked as favorite.");
$("#"+deckid).html('<a href="#" class="fs1 iconb"  style="display:inline-block;" data-icon="&#xe084;" onclick="return toggledeckfav('+deckid+')"></a>')
    }
    }

 
  $(function() {
       $("select, .check, .check :checkbox, input:radio, input:file").uniform();

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

});

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
}); </script>
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
createPageHeader("Favorite Cards Collection", $mysqli);
?>
  <?php
require_once 'dashboard/include/dashboard_breadcrumb.php';
generateBreadcrumb("Dashboard", "Cards & Decks", "Favorite Card Collection");
?>
  <!-- Main content -->
  <div class="wrapper">
    <?php
    require_once 'dashboard/include/messages.php';
 ?>
    <div class="wButton grid6 mb5"> <a class="buttonL bGreen" style="margin-top:10px;" title="" href="#" >Add Cards</a> </div>
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
            <li class="segment-10"><a class="buttonS bGold " href="#" data-value="fivecolors">Five+ colors</a></li>
            <li class="segment-11"><a class="buttonS bGreyish " href="#" data-value="none">None</a></li>
          </ul>
        </li>
        <li>Sort by:
          <ul>
            <li class="segment-12"><a href="#" data-value="name">Name</a></li>
            <!--<li class="segment-13"><a href="#" data-value="size">Size</a></li>-->
            <!-- <li class="segment-13"><a href="#" data-value="size">New</a></li> -->
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
      <ul id="list" class="image-grid">
        <?php
        $id = 1;
        $class = "all";
        $name = "";
        $totalamount = "0";
        $isFavorite = '<div class="fs1 iconb" data-icon="&#xe084;"></div>';
        
        if ($stmt = $mysqli->prepare("SELECT Ncardid, Ncardname,Ncolor,Nset FROM user_favoritecards JOIN Ncards on Ncardid = cardid WHERE userid = ?")) { 
        $stmt->bind_param('s', $_SESSION['user_id']); 
        $stmt->execute(); 
        $stmt->store_result();
        $stmt->bind_result($db_id,$db_name, $db_color,$db_set); 
        
        while ($stmt->fetch()) {
        
            $name =str_replace('"','',$db_name);
                                    
                $isFavorite = '<div id="'. $db_id .'"><a href="#" class="fs1 iconb"  style="display:inline-block;" data-icon="&#xe086;" onclick="toggledeckfav('. $db_id.')"></a></div>';
            
            $temparray = determineClass($db_color);
            $class =  $temparray['class'];
            
              $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/dashboard/images/cards/resized/' . $db_set . '/';
                    if (!is_dir($uploaddir)) {
                        mkdir($uploaddir);
                    }
                      
              if (is_file($uploaddir . $name . ".jpg" ) ){
            $imageurl = "/dashboard/images/cards/resized/". $db_set . "/" . $name . ".jpg";
              }
               else {
                $imgurl =  $_SERVER['DOCUMENT_ROOT'] . '/mtgcardscans/' . $db_set . '/' . $name . '.full.jpg';
            //resize image
                  if (is_file($imgurl)){
            $manipulator = new ImageManipulator($imgurl);
            
             // resizing to 200x200
            $newImage = $manipulator->resample($manipulator -> getWidth(), 178);
            
            $width = $manipulator -> getWidth();
            $height = $manipulator -> getHeight();
            $centreX = round($width / 2);
            $centreY = round($height / 2);
            // our dimensions will be 128x178
            $x1 = $centreX - 64;
            // 128 / 2
            $y1 = $centreY - 89;
            // 178 / 2

            $x2 = $centreX + 64;
            // 128 / 2 = 64
            $y2 = $centreY + 89;
            // 178 / 2 = 89

            // center cropping
            $newImage = $manipulator -> crop($x1, $y1, $x2, $y2);
            // saving file to uploads folder
            $manipulator -> save($uploaddir . $name . ".jpg");
            $imageurl = "/dashboard/images/cards/resized/". $db_set . "/" . $name . ".jpg";
            }
else {
	$imageurl = $noColorDeckImage;
}
            }
            if (strlen($name) > 22){
                $name = substr($name,0, 19) . "...";
            }
            
        ?>
        <li data-id="id-<?php echo $id; ?>" class="<?php echo $class; ?>"><a href="carddetail.php?cardid=<?php echo $db_id; ?>" >
            <img src='<?php echo $imageurl; ?>' alt="" height="178" width="128" /></a><strong><?php echo htmlspecialchars($name); ?></strong><span><div><?php echo $isFavorite; ?><?php echo showCardColors($db_color); ?></div>
        </li>
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
<!-- Content ends --> 

</body>
</html>