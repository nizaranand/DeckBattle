<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
include 'dashboard/include/base_include.php';
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
		<script type="text/javascript" src="/dashboard/js/files/datatable_addtocollection.js"></script>
		<script type="text/javascript">
			$(function() {
			$("select, .check, .check :checkbox, input:radio, input:file").uniform();
			});

			function addcardstocollection(_cardid, _cardname, amount_normal, amount_foil,wn,wf,f) {
			$.post("/dashboard/services/addcards_collection.php", {
			cardid: _cardid,
			userid: '<?php echo $_SESSION['user_id']; ?>
				',
				amountn: amount_normal,
				amountf: amount_foil,
				wishamountn: wn,
				wishamountf: wf,
				addtofav: f
				}, function(response){
				setTimeout("finishAjax("+_cardid+",'"+_cardname+"','Collection','"+escape(response)+"')", 400);
				});
				}

				function finishAjax(id ,name,list,response) { //TODO: make json callback
				$.jGrowl('Card: '+ name +' added');
				if (response != "") {
				var n=response.split("/");
				$('#'+id).html(n[0] + '/' + n[1]);
				$('#usercardstotal').html(parseInt(n[4]));
				$('#usercardstotalTip').attr("original-title", parseInt(n[2]) + " Normal &amp; " + parseInt(n[3]) + " Foil");
				}
				}
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
			createPageHeader("Add Cards", $mysqli);
			?>
			<?php
			include 'dashboard/include/dashboard_breadcrumb.php';
			generateBreadcrumb("Dashboard", "Cards & Decks", "Add Cards");
			?>

			<!-- Main content -->
			<div class="wrapper">
				<div class="wButton grid6">
					<?php
					switch ($_GET['from']) {

						case "col" :
							echo '<a class="buttonL bBlue" style="margin-top: 10px;" title="" href="collection.php">Back to Collection</a>';
							break;

						case "wish" :
							echo '<a class="buttonL bBlue" style="margin-top: 10px;" title="" href="wishlist.php">Back to Wishlist</a>';
							break;

						case "fav" :
							echo '<a class="buttonL bBlue" style="margin-top: 10px;" title="" href="favorites.php">Back to Favorites</a>';
							break;
					}
					?>
				</div>
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
