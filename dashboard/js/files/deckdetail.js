$(function() {
		$('#uploadimagedialog').dialog({
        autoOpen: false,
        width: 380
    });
	
   
	$('#uploadimagedialog_open').click(function () {
    	$('#uploadimagedialog').dialog('open');
      	return false;
  	});

	$('#colorsuseddialog').dialog({
        autoOpen: false,
        width: 380
    });
	
   
	$('#colorsuseddialog_open').click(function () {
    	$('#colorsuseddialog').dialog('open');
      	return false;
  	});
});