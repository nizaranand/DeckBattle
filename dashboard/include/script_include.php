<script>var userid =  '<?php echo $_SESSION['user_id']; ?>
	';
	var deckid = '
<?php echo $_SESSION['deckid']; ?>';</script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

<script type="text/javascript" src="/dashboard/js/plugins/forms/ui.spinner.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/forms/jquery.mousewheel.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<script src="/dashboard/js/plugins/charts/excanvas.min.js" type="text/javascript"></script>

<script src="/dashboard/js/plugins/charts/jquery.flot.js" type="text/javascript"></script>
<script src="/dashboard/js/plugins/charts/jquery.flot.orderBars.js" type="text/javascript"></script>
<script src="/dashboard/js/plugins/charts/jquery.flot.pie.js" type="text/javascript"></script>
<script src="/dashboard/js/plugins/charts/jquery.flot.resize.js" type="text/javascript"></script>

<script type="text/javascript" src="/dashboard/js/plugins/charts/jquery.sparkline.min.js"></script>

<script type="text/javascript" src="/dashboard/js/plugins/tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/tables/jquery.sortable.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/tables/jquery.resizable.js"></script>

<script type="text/javascript" src="/dashboard/js/plugins/forms/autogrowtextarea.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/forms/jquery.uniform.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/forms/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/forms/jquery.autotab.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/forms/jquery.chosen.min.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/forms/jquery.dualListBox.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/forms/jquery.cleditor.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/forms/jquery.ibutton.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/forms/jquery.validationEngine.js"></script>

<script type="text/javascript" src="/dashboard/js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/ui/jquery.breadcrumbs.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/ui/jquery.progress.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/ui/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/ui/jquery.colorpicker.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/ui/jquery.fancybox.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/ui/jquery.fileTree.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/ui/jquery.sourcerer.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/ui/jquery.easytabs.min.js"></script>

<script type="text/javascript" src="/dashboard/js/files/standard/bootstrap.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/ui/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/ui/jquery.quicksand.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/ui/jquery-css-transform.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/ui/jquery-animate-css-rotate-scale.js"></script>

<script type="text/javascript" src="/dashboard/js/files/tipsy_functions.js"></script>

<script type="text/javascript" src="/dashboard/js/files/standard/functions.js"></script>
<script type="text/javascript"><?php
//check passrecovery active > show growl message
if ($_SESSION['passrecoveryactive'] == 1)
{
?>
	$(function() {
		$.jGrowl("You have recovered your password but didn't changed it yet!<br /><br />Please change your password at the<br /><a href='profile.php' style='color:#68A341;'>'My Profile' page</a>.", {
			sticky : true
		});
	})
<?php
}
?></script>
