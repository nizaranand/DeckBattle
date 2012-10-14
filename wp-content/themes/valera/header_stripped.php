<!DOCTYPE html>
<head>


<!-- styles -->

<link href="<?php echo get_template_directory_uri(); ?>/assets/js/google-code-prettify/prettify.css" rel="stylesheet">

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />

<!-- Placed at the end of the document so the pages load faster -->

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/google-code-prettify/prettify.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/bootstrap.min.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.easing.1.3.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.waitforimages.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.flexslider-min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.prettyPhoto.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.gmap.min.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.preloader.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.isotope.min.js"></script>


<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4f8811347196f281"></script>



<script type="text/javascript">var runFancy = true;</script>
<!--[if IE]>
<script type="text/javascript">
    runFancy = false;
</script>
<![endif]-->

<script type="text/javascript">
    if (runFancy) {
        jQuery.noConflict()(function($){
        $(".view").preloader();
        $(".flexslider").preloader();
        });
    }
	
	
jQuery.noConflict()(function($){
		$(window).load(function() {
			$('.flexslider').flexslider({
				animation: "fade",             //String: Select your animation type, "fade" or "slide"
				slideDirection: "horizontal",   //String: Select the sliding direction, "horizontal" or "vertical"
				slideshow: true,                //Boolean: Animate slider automatically
				slideshowSpeed: 7000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
				animationDuration: 600,         //Integer: Set the speed of animations, in milliseconds
				directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
				controlNav: true,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
				keyboardNav: true,              //Boolean: Allow slider navigating via keyboard left/right keys
				mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
				prevText: "<img src='<?php echo get_template_directory_uri(); ?>/assets/img/prev.png' alt='Prev' />",           //String: Set the text for the "previous" directionNav item
				nextText: "<img src='<?php echo get_template_directory_uri(); ?>/assets/img/next.png' alt='Next' />",               //String: Set the text for the "next" directionNav item
				pausePlay: true,               //Boolean: Create pause/play dynamic element
				pauseText: '<img src="<?php echo get_template_directory_uri(); ?>/assets/assets/img/next.png" alt="Next" />',             //String: Set the text for the "pause" pausePlay item
				playText: 'Play',               //String: Set the text for the "play" pausePlay item
				randomize: false,               //Boolean: Randomize slide order
				slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
				animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
				pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
				pauseOnHover: false,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
				controlsContainer: "",          //Selector: Declare which container the navigation elements should be appended too. Default container is the flexSlider element. Example use would be ".flexslider-container", "#container", etc. If the given element is not found, the default action will be taken.
				manualControls: "",             //Selector: Declare custom control navigation. Example would be ".flex-control-nav li" or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
				start: function(){},            //Callback: function(slider) - Fires when the slider loads the first slide
				before: function(){},           //Callback: function(slider) - Fires asynchronously with each slider animation
				after: function(){},            //Callback: function(slider) - Fires after each slider animation completes
				end: function(){}
			});
		});
		});
	
jQuery.noConflict()(function($){
	$(window).load(function() {
			$('.blogslider').flexslider({
			animation: "slide",              //String: Select your animation type, "fade" or "slide"
			slideDirection: "horizontal",   //String: Select the sliding direction, "horizontal" or "vertical"
			slideshow: false,                //Boolean: Animate slider automatically
			slideshowSpeed: 7000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
			animationDuration: 600,         //Integer: Set the speed of animations, in milliseconds
			directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
			controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
			keyboardNav: true,              //Boolean: Allow slider navigating via keyboard left/right keys
			mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
			prevText: "<img src='<?php echo get_template_directory_uri(); ?>/assets/img/prev.png' alt='Prev' />",           //String: Set the text for the "previous" directionNav item
			nextText: "<img src='<?php echo get_template_directory_uri(); ?>/assets/img/next.png' alt='Next' />",               //String: Set the text for the "next" directionNav item
			pausePlay: false,               //Boolean: Create pause/play dynamic element
			pauseText: 'Pause',             //String: Set the text for the "pause" pausePlay item
			playText: 'Play',               //String: Set the text for the "play" pausePlay item
			randomize: false,               //Boolean: Randomize slide order
			slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
			animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
			pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
			pauseOnHover: false,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
			controlsContainer: "",          //Selector: Declare which container the navigation elements should be appended too. Default container is the flexSlider element. Example use would be ".flexslider-container", "#container", etc. If the given element is not found, the default action will be taken.
			manualControls: "",             //Selector: Declare custom control navigation. Example would be ".flex-control-nav li" or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
			start: function(){},            //Callback: function(slider) - Fires when the slider loads the first slide
			before: function(){},           //Callback: function(slider) - Fires asynchronously with each slider animation
			after: function(){},            //Callback: function(slider) - Fires after each slider animation completes
			end: function(){}               //Callback: function(slider) - Fires when the slider reaches the last slide (asynchronous)
			  });
			});
		});
	
jQuery.noConflict()(function($){
	$(window).load(function() {
			$('.testimonialslider').flexslider({
			animation: "slide",              //String: Select your animation type, "fade" or "slide"
			slideDirection: "horizontal",   //String: Select the sliding direction, "horizontal" or "vertical"
			slideshow: true,                //Boolean: Animate slider automatically
			slideshowSpeed: 3000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
			animationDuration: 600,         //Integer: Set the speed of animations, in milliseconds
			directionNav: false,             //Boolean: Create navigation for previous/next navigation? (true/false)
			controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
			keyboardNav: false,              //Boolean: Allow slider navigating via keyboard left/right keys
			mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
			prevText: "<img src='assets/img/prev.png' alt='Prev' />",           //String: Set the text for the "previous" directionNav item
			nextText: "<img src='assets/img/next.png' alt='Next' />",               //String: Set the text for the "next" directionNav item
			pausePlay: false,               //Boolean: Create pause/play dynamic element
			pauseText: 'Pause',             //String: Set the text for the "pause" pausePlay item
			playText: 'Play',               //String: Set the text for the "play" pausePlay item
			randomize: false,               //Boolean: Randomize slide order
			slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
			animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
			pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
			pauseOnHover: false,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
			controlsContainer: "",          //Selector: Declare which container the navigation elements should be appended too. Default container is the flexSlider element. Example use would be ".flexslider-container", "#container", etc. If the given element is not found, the default action will be taken.
			manualControls: "",             //Selector: Declare custom control navigation. Example would be ".flex-control-nav li" or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
			start: function(){},            //Callback: function(slider) - Fires when the slider loads the first slide
			before: function(){},           //Callback: function(slider) - Fires asynchronously with each slider animation
			after: function(){},            //Callback: function(slider) - Fires after each slider animation completes
			end: function(){}               //Callback: function(slider) - Fires when the slider reaches the last slide (asynchronous)
			  });
			});
		});
</script>





<script type="text/javascript">
jQuery.noConflict()(function($){		
$(document).ready(function(){

$(".flip").click(function(){
$(".panel").slideToggle("normal");

var $map = $('#map');
google.maps.event.addDomListener(window, 'resize', function() {
	map.setCenter(homeLatlng);
});
if( $map.length ) {

	$map.gMap({
		address: '<?php echo stripslashes($data['header_map_adress']) ?>',
		zoom: 14,
		markers: [
			{ 'address' : '<?php echo stripslashes($data['header_map_adress']) ?>',}
		]
	});

}
});
});
});

</script>
<script>
jQuery.noConflict()(function($){
var $map = $('#map-contact');
		google.maps.event.addDomListener(window, 'resize', function() {
			map.setCenter(homeLatlng);
		});
		if( $map.length ) {

			$map.gMap({
				address: '<?php echo stripslashes($data['header_map_adress']) ?>',
				zoom: 14,
				markers: [
					{ 'address' : '<?php echo stripslashes($data['header_map_adress']) ?>',}
				]
			});

		}
});
</script>
<script type="text/javascript">
jQuery.noConflict()(function($){
$(document).ready(function ()
{ // after loading the DOM
    $("#ajax-contact-form").submit(function ()
    {
        // this points to our form
        var str = $(this).serialize(); // Serialize the data for the POST-request
        $.ajax(
        {
            type: "POST",
            url: '<?php echo get_template_directory_uri(); ?>/contact.php',
            data: str,
            success: function (msg)
            {
                $("#note").ajaxComplete(function (event, request, settings)
                {
                    if (msg == 'OK')
                    {
                        result = '<div class="notification_ok">Message was sent to website administrator, thank you!</div>';
                        $("#fields").hide();
                    }
                    else
                    {
                        result = msg;
                    }
                    $(this).html(result);
                });
            }
        });
        return false;
    });
});
});
</script>
