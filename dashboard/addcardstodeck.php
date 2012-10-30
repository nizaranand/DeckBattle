<?php
include 'db_connect.php';
include 'login_functions.php';

sec_session_start();

if(login_check($mysqli) != true) {
 
 header('Location: ./login.php?error=notloggedin');
  
} else {
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



function addcardstocollection(_cardid, _cardname, amount_normal, amount_foil,wn,wf,f) {
 $.post("addcardstocollection_service.php", {
        cardid: _cardid,
		userid: '<?php echo $_SESSION['user_id']; ?>',
		amountn: amount_normal,
		amountf: amount_foil,
		wishamountn: wn,
		wishamountf: wf,
		addtofav: f
      }, function(response){
        setTimeout("finishAjax("+_cardid+",'"+_cardname+"','"+escape(response)+"')", 400);
      });
}

 function finishAjax(id ,name,response) {
	 $.jGrowl('Card: '+ name +' added to collection');
	 var n=response.split("/");
 	 $('#'+id).html(n[0] + '/' + n[1]);
	 $('#usercardstotal').html(parseInt(n[4]));
	 $('#usercardstotalTip').attr("original-title", parseInt(n[2]) + " Normal &amp; " + parseInt(n[3]) + " Foil");
 }


</script> 

<script type="text/javascript" src="js/files/functions.js"></script>

<script type="text/javascript" src="js/charts/chart.js"></script>
<script type="text/javascript" src="js/charts/hBar_side.js"></script>
 
 <style>
.btn-group:before, .btn-group:after {
	content: "";
	display: none;
}

.btn-group.toolbar {
	margin-left:8px;
}

.centeredtd {
	text-align:center;
	vertical-align: middle;
}

label {
	padding-left:10px;	
}

.dataTables_length {

padding-right:10px;	
	
}
</style>



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
<a class="buttonL bBlue" style="margin-top: 10px;" title="" href="deckdetail.php?deckid=<?php echo $deckid;?>">Back to deck</a>
</div>
  <div class="wButton grid6"></div>
      <div class="widget">
        <div class="whead">
          <h6>Card Database</h6>
          <div class="clear"></div>
        </div>
        <div class="shownpars" > 
          <table cellpadding="0" cellspacing="0" border="0" class="addtocollection">
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
                <th></th>
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