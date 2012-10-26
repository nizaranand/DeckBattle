<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>
<?php wp_title('|',true,'right'); ?>
<?php bloginfo('name'); ?>
</title>
<meta name="description" content="<?php bloginfo('description'); ?>" />  
<meta name="keywords" content="<?php bloginfo('name'); ?>" />
<!-- styles -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo get_template_directory_uri(); ?>/assets/css/docs.css" rel="stylesheet">
<link href="<?php echo get_template_directory_uri(); ?>/assets/js/google-code-prettify/prettify.css" rel="stylesheet">
<?php wp_enqueue_style('custom-options',get_template_directory_uri().'/assets/css/options.css','','','all'); ?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/ie.css" />
<![endif]-->
<?php wp_head(); ?>
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>	
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/google-code-prettify/prettify.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.easing.1.3.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.waitforimages.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.flexslider-min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/superfish-menu/superfish.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.tweet.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.gmap.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.preloader.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.isotope.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/custom.js"></script>
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

<?php  global $data; ?>
<?php 
	$head_font_one = $data['headers_font_one'];
	$head_font_two = $data['headers_font_two'];
	$head_font_three = $data['headers_font_three'];
	$head_font_four = $data['headers_font_four'];
	$head_font_five = $data['headers_font_five'];
	$head_font_six = $data['headers_font_six'];					

 ?>

<?php  $body_style = $data['body_font']; ?>
<style>


body {
	background-image: <?php echo 'url("'.strip_tags($data['custom_bg']).'")'; ?>; 
	background-color: <?php echo strip_tags($data['body_background'])." !important"; ?>;
	font-family: <?php echo $body_style['face']; ?>;
	color: <?php echo $body_style['color']; ?>;
	font-style: <?php echo $body_style['style']; ?>;
	font-size: <?php echo $body_style['size']; ?>;
	
}
h1 {
	font-family: <?php echo $head_font_one['face']; ?>;
	color: <?php echo $head_font_one['color']; ?>;
	font-style: <?php echo $head_font_one['style']; ?>;
	font-size: <?php echo $head_font_one['size']; ?>; 
	
}
h2{
	font-family: <?php echo $head_font_two['face']; ?>;
	color: <?php echo $head_font_two['color']; ?>;
	font-style: <?php echo $head_font_two['style']; ?>;
	font-size: <?php echo $head_font_two['size']; ?>; 
	
}
h3 {
	font-family: <?php echo $head_font_three['face']; ?>;
	color: <?php echo $head_font_three['color']; ?>;
	font-style: <?php echo $head_font_three['style']; ?>;
	font-size: <?php echo $head_font_three['size']; ?>; 
	
}
h4{
	font-family: <?php echo $head_font_four['face']; ?>;
	color: <?php echo $head_font_four['color']; ?>;
	font-style: <?php echo $head_font_four['style']; ?>;
	font-size: <?php echo $head_font_four['size']; ?>; 
	
}
h5 {
	font-family: <?php echo $head_font_five['face']; ?>;
	color: <?php echo $head_font_five['color']; ?>;
	font-style: <?php echo $head_font_five['style']; ?>;
	font-size: <?php echo $head_font_five['size']; ?>; 
	
}
h6 {
	font-family: <?php echo $head_font_six['face']; ?>;
	color: <?php echo $head_font_six['color']; ?>;
	font-style: <?php echo $head_font_six['style']; ?>;
	font-size: <?php echo $head_font_six['size']; ?>; 
	
}
.colored {color: <?php echo $data['theme_colors']; ?>;}
.undercolored { border-bottom:1px solid  <?php echo $data['theme_colors']; ?>;}
.undercolored a:hover { color:<?php echo $data['theme_colors']; ?>; }
::selection {background: <?php echo $data['theme_colors']; ?>;}
a { color: <?php echo $data['theme_colors']; ?>;}
a:hover { color: <?php echo $data['theme_colors']; ?>;}
.header_social .badge:hover, .comment .badge:hover { background-color: <?php echo $data['theme_colors']; ?>;}
.badge a {color: <?php echo $data['theme_colors']; ?>;}
.menu a:hover, .menu .hover > a, .menu .current-menu-item > a {background-color: <?php echo $data['theme_colors']; ?>; }
.menu ul li ul li a:hover > .menu ul li a {background-color: <?php echo $data['theme_colors']; ?>; !important;}
.menu a:hover, .menu .hover > a, .menu .current-menu-item > a, {background-color: <?php echo $data['theme_colors']; ?>;}
ul.menu li ul li:first-child > a:hover:after {border-bottom-color:<?php echo $data['theme_colors']; ?>;}
ul.menu li ul li.current_page_item > a:after {border-bottom-color:<?php echo $data['theme_colors']; ?>;}
h2 .label, h3 .label { background-color: <?php echo $data['theme_colors']; ?>;}
.footer_menu li a {border-bottom:1px solid <?php echo $data['theme_colors']; ?>;}
.footer_menu li a:hover { color: <?php echo $data['theme_colors']; ?> !important; }
.mybutton { background-color: <?php echo $data['theme_colors']; ?>;}
.mybutton:hover { background-color: <?php echo $data['theme_colors']; ?>;}
.progress-success.progress-striped .bar { background-color: <?php echo $data['theme_colors']; ?>;}
.block a:hover { color:<?php echo $data['theme_colors']; ?>;}
.blog_cat .side_bar_widget ul li:hover { background-color:<?php echo $data['theme_colors']; ?>;}
.progress-success .bar {
  background-color: <?php echo $data['theme_colors']; ?> !important;
  background-image: -ms-linear-gradient(-45deg, rgba(255, 255, 255, 1) 100%, transparent 25%, transparent 50%, rgba(255, 255, 255, 1) 50%, rgba(255, 255, 255, 1) 75%, transparent 75%, transparent) !important;
}

</style>

<!--[if IE]>
<style>
.progress-success .bar {  
background-color: <?php echo $data['theme_colors']; ?> !important;
background: <?php echo $data['theme_colors']; ?> !important;
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $data['theme_colors']; ?>', endColorstr='<?php echo $data['theme_colors']; ?>', GradientType=0);}
</style>
<![endif]-->
<script type="text/javascript">
/***************************************************
			TWITTER FEED
***************************************************/

jQuery.noConflict()(function($){
$(document).ready(function() {  

	  $(".tweet").tweet({
        	count: 1,
        	username: '<?php echo $data['twitter_block_account']; ?>',
        	loading_text: "loading twitter..."      
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
<?php if ( ! isset( $content_width ) ) $content_width = 900;?>
<?php wp_link_pages(); ?>

</head>
<body <?php body_class('main_body'); ?>>

	<!--TOP-->
    <div class="top_line"></div>
    <div class="panel hidden-phone">
        <div id="map">
        </div>
    </div>
    <!--/TOP-->
    <!--HEADER-->
	<header>
        <div class="container">
            <div class="row hidden-phone">
               <?php if($data['header_map'] == true ) { ?><img class="flip" src="<?php echo get_template_directory_uri(); ?>/assets/img/panel.jpg" style="float: right; margin-left:20px !important;"/><?php } ?><span class="header_social"><?php echo stripslashes($data['header_social']) ?></span>
            </div>
            <div class="row">
                <div class="span4 logo">
                    <a href="<?php bloginfo('url'); ?>"><img src="<?php echo stripslashes($data['header_logo']) ?>" alt="logo" style="margin-bottom:7px; margin-top:7px;" /></a>
                </div>
                <div class="span8">
                    <nav id="main-nav">
                        <?php wp_nav_menu( array('theme_location' => 'main_menu', 'menu_class' => 'menu')); ?>
                    </nav><!-- end #main-nav -->
                </div>

            </div>
		</div>
	</header>
	<?php if (!(is_front_page()) & (!(is_page_template('home2.php')))) { ?>
    <div class="gray_bg">
        <div class="container">
            <div class="row welcome_inner">
                <div class="span12">
                    <h1><span class="colored">///</span> <?php if (!(is_archive()) & (!(is_search()))) { ?><?php the_title(); ?><?php } ?> <?php if ((is_post_type_archive('portfolio-type'))) { ?>Portfolio<?php } ?><?php if ((is_archive() & (!(is_post_type_archive('portfolio-type'))))) { ?>Blog Archive<?php } ?><?php if (is_search()) { ?>Search Results: <?php } ?></h1>
                </div>
            </div>
        </div>
    </div>
	<?php } ?>