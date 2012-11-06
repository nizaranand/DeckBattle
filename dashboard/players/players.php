<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

include  'dashboard/include/db_connect.php';
include  'dashboard/include/login_functions.php';

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

<link href="/dashboard/css/styles.css" rel="stylesheet" type="text/css" />
<!--[if IE]> <link href="/dashboard/css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->
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
}

label {
	padding-left:10px;	
}

.dataTables_length {

padding-right:10px;	
	
}
</style>

<script type="text/javascript">
var userid = '<?php echo $_SESSION['user_id']; ?>';
</script> 

<?php include 'dashboard/include/script_include.php'; ?>


<script type="text/javascript" src="/dashboard/js/files/datatable_global.js"></script>
<script type="text/javascript" src="/dashboard/js/files/datatable_replacers.js"></script>
<script type="text/javascript" src="/dashboard/js/files/datatable_toolbars.js"></script>

<script type="text/javascript" src="/dashboard/js/files/datatable_collection.js"></script>

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
createPageHeader("Collection",$mysqli);
?>
<?php include 'dashboard/include/dashboard_breadcrumb.php';
generateBreadcrumb("Dashboard","Collection");
 ?>  
    <!-- Main content -->
    <div class="wrapper">
        <div class="wButton grid6">
<a class="buttonL bGreen" style="margin-top: 10px;" title="" href="/dashboard/collection/add_cards_collection-wishlist-favorites.php">Add cards to Collection</a>
</div>
      <div class="widget">
        <div class="whead">
          <h6>Card Collection</h6>
          <div class="clear"></div>
        </div>
        <div class="shownpars" > 
          <table cellpadding="0" cellspacing="0" border="0" class="collection">
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