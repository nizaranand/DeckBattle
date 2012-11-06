$(function(){

	$("#login").validationEngine();
	$("#recover").validationEngine();

	// Dialog
    $('#formDialogPassRecovery').dialog({
        autoOpen: false,
        width: 300
      /*  buttons: {
            "Request new password": function () {
			
                $(this).dialog("close");
					$("passwordrecoveryform").submit();
            },
            "Cancel": function () {
                $(this).dialog("close");
            }*/
        //}
    });

 // Dialog Link
    $('#formDialogPassRecovery_open').click(function () {
        $('#formDialogPassRecovery').dialog('open');
        return false;
    });

	
	// Checking for CSS 3D transformation support
	$.support.css3d = supportsCSS3D();
	
	var formContainer = $('.loginWrapper');
	
	// Listening for clicks on the ribbon links
	$('.flip').click(function(e){
		
		// Flipping the forms
		formContainer.toggleClass('flipped');
		
		// If there is no CSS3 3D support, simply
		// hide the login form (exposing the recover one)
		if(!$.support.css3d){
			$('#login').toggle();
		}
		e.preventDefault();
	});
	
	formContainer.find('form').submit(function(e){
		// Preventing form submissions. If you implement
		// a backend, you might want to remove this code
		//e.preventDefault();
	});
	
	
	// A helper function that checks for the 
	// support of the 3D CSS3 transformations.
	function supportsCSS3D() {
		var props = [
			'perspectiveProperty', 'WebkitPerspective', 'MozPerspective'
		], testDom = document.createElement('a');
		  
		for(var i=0; i<props.length; i++){
			if(props[i] in testDom.style){
				return true;
			}
		}
		
		return false;
	}
	
	//===== Login pic hover animation =====//
	
	$(".loginPic").hover(
		function() { 
		
		$('.logleft, .logback').animate({left:10, opacity:1},200); 
		$('.logright').animate({right:10, opacity:1},200); },
		
		function() { 
		$('.logleft, .logback').animate({left:0, opacity:0},200);
		$('.logright').animate({right:0, opacity:0},200); }
	);
	
});
