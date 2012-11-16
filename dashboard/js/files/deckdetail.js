$(function() {
		$('#uploadimagedialog').dialog({
        autoOpen: false,
        width: 380
    });
	
   
	$('#uploadimagedialog_open').click(function () {
    	$('#uploadimagedialog').dialog('open');
      	return false;
  	});

});