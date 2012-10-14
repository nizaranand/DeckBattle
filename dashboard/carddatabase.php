<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<title>Mtg CardDB</title>
		<link href="css/styles_carddatabase.css" rel="stylesheet" type="text/css" />
		<!--[if IE]> <link href="css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

		<script type="text/javascript" src="js/plugins/forms/ui.spinner.js"></script>

		<script type="text/javascript" src="js/plugins/forms/jquery.mousewheel.js"></script>

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
		<script type="text/javascript" src="js/files/functions_carddatabase.js"></script>
		<script type="text/javascript" src="js/charts/chart_side.js"></script>
		<script type="text/javascript" src="js/charts/hBar_side.js"></script>
		<style>
.btn-group:before, .btn-group:after {
	content: "";
	display: none;
}
</style>
<script>
$(document).ready(function() {
var oTable = $('#dyn2').dataTable();
oTable.fnLengthChange( 100 );
} );
</script>
		</head>

		<body>

<!-- Table with opened toolbar -->
<div class="widget" style="width:980px;margin-left:20px;">
          <div class="whead">
    <h6>Magic the Gathering Card Database</h6>
    <div class="clear"></div>
  </div>
          <div id="dyn2" class="shownpars" > <a class="tOptions act" title="Options"><img src="images/icons/options" alt="" /></a>
    <table cellpadding="0" cellspacing="0" border="0" class="dTable">
              <thead>
        <tr>
        <th>ID</th>
                  <th style="width:220px;">Name</th>
                  <th style="width:230px;">Type</th>
                  <th style="width:100px;">Cost</th>
                  <th style="width:80px;">Color</th>
                  <th style="width:30px;">EditionAbbreviation</th>
                  <th style="width:30px;">Edition</th>
                  <th style="width:30px;">Rarity</th>
                  <th style="width:30px;">#</th>
                  <th>Options</th>
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
</body>
</html>
