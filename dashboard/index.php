<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once 'dashboard/include/base_include.php';
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
		<script>
			$(function() {
				$("select, .check, .check :checkbox, input:radio, input:file").uniform();
			});
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
		require_once 'dashboard/include/dashboard_leftsidebar.php';
		?>

		<!-- Content begins -->
		<div id="content">
			<?php
			require_once 'dashboard/include/dashboard_pageheader.php';
			createPageHeader("Dashboard", $mysqli);
			?>
			<?php
			require_once 'dashboard/include/dashboard_breadcrumb.php';
			generateBreadcrumb("Dashboard", "");
			?>
			<!-- Main content -->
			<div class="wrapper">
				<ul class="middleNavR">
					<li>
						<a href="collection/collection.php" title="Edit Collection" class="tipN"><img src="images/icons/middlenav/create.png" alt="" /></a>
					</li>
<!--					<li>
						<a href="syncdropbox.php" title="Sync Dropbox" class="tipN"><img src="images/icons/middlenav/upload.png" alt="" /></a>
</li>-->
					<li>
						<a href="collection/decks.php" title="Edit Decks" class="tipN"><img src="images/icons/middlenav/add.png" alt="" /></a>
					</li>
					<li>
						<a href="statistics.php" title="Check Statistics" class="tipN"><img src="images/icons/middlenav/stats.png" alt="" /></a>
					</li>
				<!--	   <li>
                        <a href="messages.php" title="Messages" class="tipN"><img src="images/icons/middlenav/dialogs.png" alt="" /></a><!--<strong>8</strong>-->
                    <!--</li>-->
                
				</ul>
				<!-- content -->

				<!-- content ends-->
				<div class="clear"></div>
			</div>
			<!-- Main content ends -->
		</div>
		<!-- Content ends -->
	</body>
</html>