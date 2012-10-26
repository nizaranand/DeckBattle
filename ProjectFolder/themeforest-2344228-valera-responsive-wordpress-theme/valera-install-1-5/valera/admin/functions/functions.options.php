<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories = array();  
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp = array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp = array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select = array("one","two","three","four","five"); 
		$of_options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" => "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = STYLESHEETPATH. '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_bloginfo('template_url').'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		$of_portfolio_style = array("1" => "2 Columns Portfolio","2" => "3 Columns Portfolio","3" => "4 Columns Portfolio"); 
		$default_image_slider_flex['url']= get_template_directory_uri().'/assets/img/slide2.jpg';
		$default_image_slider_flexx['url']= get_template_directory_uri().'/assets/img/slide1-1.jpg';
	
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();



//Header
$of_options[] = array( "name" => "Header",
					"type" => "heading");
          

$of_options[] = array( "name" => "Upload your logo",
					"desc" => "",
					"id" => "header_logo",
					"std" => "http://www.orange-idea.com/valera/logo.png",
					"type" => "media");


$of_options[] = array( "name" => "Hiden map",
					"desc" => "Show hiden map?",
					"id" => "header_map",
					"std" => 1,
          			"folds" => 1,
					"type" => "checkbox");    

$of_options[] = array( "name" => "",
					"desc" => "Past your adress",
					"id" => "header_map_adress",
					"std" => "9930 124th Avenue Northeast Kirkland, Washington",
          			"fold" => "header_map", /* the checkbox hook */
					"type" => "text");
					
					
$of_options[] = array( "name" => "Social in header",
					"desc" => "Past your text or HTML",
					"id" => "header_social",
					"std" => "Follow us on <span class='badge'><a href='#'>Twitter</a></span> and <span class='badge'><a href='#'>Facebook</a></span>",
					"type" => "text");					



//Footer
$of_options[] = array( "name" => "Footer",
					"type" => "heading");

$of_options[] = array( "name" => "Footer settings",
					"desc" => "Show twitter block?",
					"id" => "twitter_block",
					"std" => 1,
          			"folds" => 1,
					"type" => "checkbox"); 

$of_options[] = array( "name" => "",
					"desc" => "Twitter Block Header",
					"id" => "twitter_block_header",
					"std" => "<span class='colored'>///</span> Our Twitter Feed",
          			"fold" => "twitter_block", /* the checkbox hook */
					"type" => "text");
					
$of_options[] = array( "name" => "",
					"desc" => "Twitter Block content",
					"id" => "twitter_block_content",
					"std" => "Find out what's happening, right now, with the people and organizations you care about.",
          			"fold" => "twitter_block", /* the checkbox hook */
					"type" => "text");

$of_options[] = array( "name" => "",
					"desc" => "Twitter account",
					"id" => "twitter_block_account",
					"std" => "Orange_idea_RU",
          			"fold" => "twitter_block", /* the checkbox hook */
					"type" => "text");

$of_options[] = array( "name" => "Block I settings",
					"desc" => "Upload your logo for Footer",
					"id" => "footer_logo",
					"std" => "http://www.orange-idea.com/valera/logo-footer.png",
					"type" => "media");

$of_options[] = array( "name" => "Blcok II settings",
					"desc" => "Header for Block II",
					"id" => "footer_block2_header",
					"std" => "<span class='colored'>///</span> Valera Company",
					"type" => "text");
					
$of_options[] = array( "name" => "",
					"desc" => "Content for Block II",
					"id" => "footer_block2_content",
					"std" => "Valera is designed to help people of all skill levels designer or developer, huge nerd or early beginner. Use it as a complete kit or use to start something more complex.",
					"type" => "textarea");


$of_options[] = array( "name" => "Blcok III settings",
					"desc" => "Header for Block III",
					"id" => "footer_block3_header",
					"std" => "<span class='colored'>///</span> Contact info",
					"type" => "text");
					
$of_options[] = array( "name" => "",
					"desc" => "Content for Block III",
					"id" => "footer_block3_content",
					"std" => "<span><strong class='colored'> Aress:</strong> 123456 Street Name, Los Angeles</span><hr class='hidden-phone'><br class='visible-phone'><span><strong class='colored'>Phone:</strong> (1800) 765-4321</span><hr class='visible-phone'>",
					"type" => "textarea");


$of_options[] = array( "name" => "Blcok IV settings",
					"desc" => "Header for Block IV",
					"id" => "footer_block4_header",
					"std" => "<span class='colored'>///</span> Stay in touch",
					"type" => "text");
					
$of_options[] = array( "name" => "",
					"desc" => "Content for Block IV",
					"id" => "footer_block4_content",
					"std" => "<p>Find out what's happening:</p><hr><a href='#'><div class='icon_t'></div></a><a href='#'><div class='icon_facebook'></div></a><a href='#'><div class='icon_dribbble'></div></a><a href='#'><div class='icon_google'></div></a><a href='#'><div class='icon_in'></div></a><a href='#'><div class='icon_flickr'></div></a>",
					"type" => "textarea");


$of_options[] = array( "name" => "Bottom Line",
					"desc" => "Show bottom line?",
					"id" => "bottom_line",
					"std" => 1,
          			"folds" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => "",
					"desc" => "Copyright",
					"id" => "bottom_line_content",
					"std" => "Copyright 2012 Valera - Company. Design by <span class='undercolored'><a href='#'>OrangeIde</a></span>",
          			"fold" => "bottom_line", /* the checkbox hook */
					"type" => "text");


/* Portfolio */
$of_options[] = array( "name" => "Portfolio",
					"type" => "heading");



$of_options[] = array( "name" => "Type Of Portfolio",
					"desc" => "",
					"id" => "sl_portfolio_style",
					"std" => "1",
					"type" => "select",
					"options" => $of_portfolio_style);  
					

$of_options[] = array("name" =>  "",
					"desc" => "Enter the number of projects to display",
					"id" => "sl_portfolio_projects",
					"std" => "10",
					"type" => "text");




/* Home Page */
$of_options[] = array( "name" => "HomePage",
					"type" => "heading");


$of_options[] = array( "name" => "Welcome Area",
					"desc" => "Welcome Text",
					"id" => "welcome_text",
					"std" => "Valera is <span class='undercolored'>clean</span> <span class='undercolored'>flexible</span> <span class='colored'>&amp;</span> <span class='undercolored'>responsive</span>",
					"type" => "textarea");
					

$of_options[] = array( "name" => "Welcome Area",
					"desc" => "Welcome Description",
					"id" => "welcome_description",
					"std" => "Powerful WordPress Theme very flexible, very easy for customizing and well documented, approaches for personal and professional use.",
					"type" => "textarea");



$of_options[] = array( "name" => "Block befor slider",
					"desc" => "",
					"id" => "slider_description",
					"std" => "
<h2><span class='label'>Designed for everyone!</span></h2>
<p class='intro'>Simple and flexible HTML, CSS, and Javascript for popular user interface components and interactions.</p>
<p><span class='pun'><em>Valera is designed to help people of all skill levels designer or developer, huge nerd or early beginner. Use it as a complete kit or use to start something more complex.</em></span></p>
<hr class='visible-desktop'>
<h4 class='visible-desktop'>Some of Template Features:</h4>
<div class='row visible-desktop'>
<div class='span2'>
<ul style='margin-top:10px;' class='unstyled'>
<li><i class='icon-user'></i> Built for and by nerds</li>
<li><i class='icon-th'></i> 12-column grid</li>
<li><i class='icon-resize-horizontal'></i> Max-width 1200px</li>
<li><i class='icon-book'></i> Growing library</li>
</ul>
</div>
<div class='span2'>
<ul style='margin-top:10px;' class='unstyled'>
<li><i class='icon-resize-small'></i> Responsive design</li>
<li><i class='icon-eye-open'></i> Cross-everything</li>
<li><i class='icon-list-alt'></i> Styleguide docs</li>
<li><i class='icon-cog'></i> jQuery plugins</li>
</ul>
</div>
</div>
<hr>
<a href='123' class='mybutton mega'><span>Purchase this theme for 35$</span></a>
					",
					"type" => "textarea");


$of_options[] = array( "name" => "",
					"desc" => "Add items for FlexSlider",
					"id" => "sl_flexslider",
					"std" => array('title' => 'Some Title Goes Here','url' => $default_image_slider_flex['url'],'link' => '#','description' => 'Lorem ipsum dolor sit ametconsectetuer adipiscing elit.'),					
					"type" => "slider");


$of_options[] = array( "name" => "Features Area",
					"desc" => "",
					"id" => "features_area",
					"std" => "
<div class='span4 clearfix'>
<img src='http://html.orange-idea.com/valera/assets/img/html5.png' class='pull-left' />
<h3>HTML 5 <span class='colored'>&amp;</span> CSS 3</h3>
<p><em>Built to support new HTML5 elements and syntax. Progressively enhanced components for ultimate style. Yes, Valera is awesome!</em></p>
</div>
<div class='span4 clearfix'>
<img src='http://html.orange-idea.com/valera/assets/img/resp.png' class='pull-left' />
<h3>Responsive Design</h3>
<p><em> Our components are scaled according to a range of resolutions and devices to provide a consistent experience, no matter what.</em></p>
</div>
<div class='span4 clearfix'>
<img src='http://html.orange-idea.com/valera/assets/img/doc.png' class='pull-left' />
<h3>Well Documented</h3>
<p><em>Valera was designed first and foremost as a styleguide to document not only our features, but best practices and living.</em></p>
</div>
					",
					"type" => "textarea");



/* Home Page Style II */
$of_options[] = array( "name" => "HomePage II",
					"type" => "heading");


$of_options[] = array( "name" => "Welcome Area",
					"desc" => "Welcome Text",
					"id" => "welcome_text1",
					"std" => "Valera is <span class='undercolored'>clean</span> <span class='undercolored'>flexible</span> <span class='colored'>&amp;</span> <span class='undercolored'>resposive</span>",
					"type" => "textarea");
					

$of_options[] = array( "name" => "Welcome Area",
					"desc" => "Welcome Description",
					"id" => "welcome_description1",
					"std" => "Powerful WordPress Theme very flexible, very easy for customizing and well documented, approaches for personal and professional use.",
					"type" => "textarea");


$of_options[] = array( "name" => "",
					"desc" => "Add items for FlexSlider",
					"id" => "sl_flexsliderr",
					"std" => array('title' => 'Some Title Goes Here','url' => $default_image_slider_flexx['url'],'link' => '#','description' => 'Powerful site template designed in a clean and minimalistic style. <br><br><a class="btn btn-success btn-small" style="margin-right:10%" href="http://themeforest.net/item/valera-responsive-html-template/2194402?ref=OrangeIdea"><i class="icon-download-alt icon-white"></i> Purchase for 15$</a>'),					
					"type" => "slider");







$of_options[] = array( "name" => "Styling",
					"type" => "heading");

$of_options[] = array( "name" =>  "Theme Color",
					"desc" => "Pick a color for the theme",
					"id" => "theme_colors",
					"std" => "#7DAF27",
					"type" => "color");
					
					

$of_options[] = array( "name" =>  "Body Background Color",
					"desc" => "Pick a background color for the theme (default: #fff).",
					"id" => "body_background",
					"std" => "#ffffff",
					"type" => "color");

$of_options[] = array( "name" => "Background Images",
					"desc" => "Select a background pattern.",
					"id" => "custom_bg",
					"std" => "",
					"type" => "tiles",
					"options" => $bg_images,
					);					
					
$of_options[] = array( "name" => "Body Font",
					"desc" => "Specify the body font properties",
					"id" => "body_font",
					"std" => array('size' => '12px','face' => 'arial','style' => 'normal','color' => '#666666'),
					"type" => "typography");  






$of_options[] = array("name" =>  "",
					"desc" => "Specify the h1 header font properties",
					"id" => "headers_font_one",
					"std" => array('size' => '30px', 'face' => 'Arial','style' => 'normal','color' => '#444444'),
					"type" => "typography");  

$of_options[] = array("name" =>  "",
					"desc" => "Specify the h2 header font properties",
					"id" => "headers_font_two",
					"std" => array('size' => '24px','face' => 'Arial','style' => 'normal','color' => '#444444'),
					"type" => "typography");  


$of_options[] = array("name" =>  "",
					"desc" => "Specify the h3 header font properties",
					"id" => "headers_font_three",
					"std" => array('size' => '18px','face' => 'Arial','style' => 'normal','color' => '#444444'),
					"type" => "typography");  

$of_options[] = array("name" =>  "",
					"desc" => "Specify the h4 header font properties",
					"id" => "headers_font_four",
					"std" => array('size' => '14px','face' => 'Arial','style' => 'normal','color' => '#444444'),
					"type" => "typography");  

$of_options[] = array("name" =>  "",
					"desc" => "Specify the h5 header font properties",
					"id" => "headers_font_five",
					"std" => array('size' => '12px','face' => 'Arial','style' => 'normal','color' => '#444444'),
					"type" => "typography");  

$of_options[] = array("name" =>  "",
					"desc" => "Specify the h6 header font properties",
					"id" => "headers_font_six",
					"std" => array('size' => '11px','face' => 'Arial','style' => 'normal','color' => '#444444'),
					"type" => "typography");  



	}
}
?>
