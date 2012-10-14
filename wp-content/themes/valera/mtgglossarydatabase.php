<?php
/*
Template Name: Mtg Glossary Database
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

<title>
<?php wp_title('|',true,'right'); ?>
<?php bloginfo('name'); ?>
</title>

<meta name="description" content="<?php bloginfo('description'); ?>" />  
<meta name="keywords" content="<?php bloginfo('name'); ?>" />

<?php wp_enqueue_style('custom-options',get_template_directory_uri().'/assets/css/options.css','','','all'); ?>
<link href="/dashboard/css/styles_carddatabase.css" rel="stylesheet" type="text/css" />

<link href="<?php echo get_template_directory_uri(); ?>/assets/css/docs.css" rel="stylesheet">
<link href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
<!--[if IE]> <link href="css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/ie.css" />
<![endif]-->

<?php wp_head(); ?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>	
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.js"></script>

<script type="text/javascript" src="/dashboard/js/plugins/forms/ui.spinner.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/forms/jquery.mousewheel.js"></script>
 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<script type="text/javascript" src="/dashboard/js/plugins/charts/excanvas.min.js"></script>

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

<script type="text/javascript" src="/dashboard/js/plugins/uploader/plupload.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/uploader/jquery.plupload.queue.js"></script>

<script type="text/javascript" src="/dashboard/js/plugins/wizards/jquery.form.wizard.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/wizards/jquery.validate.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/wizards/jquery.form.js"></script>

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

<script type="text/javascript" src="/dashboard/js/plugins/others/jquery.fullcalendar.js"></script>
<script type="text/javascript" src="/dashboard/js/plugins/others/jquery.elfinder.js"></script>

<script type="text/javascript" src="/dashboard/js/plugins/ui/jquery.easytabs.min.js"></script>
<script type="text/javascript" src="/dashboard/js/files/bootstrap.js"></script>
<script type="text/javascript" src="/dashboard/js/files/functions_glossarydatabase.js"></script>

<script type="text/javascript" src="/dashboard/js/charts/hBar_side.js"></script>

<!-- original theme -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/superfish-menu/superfish.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.tweet.js"></script>


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

<style>
.btn-group:before, .btn-group:after {
	content: "";
	display: none;
}

.btn-group.toolbar {
	margin-left:8px;
}

.centeredtd {
	text-align:center;
}

label {
	padding-left:10px;	
}

.dataTables_length {

padding-right:10px;	
	
}
</style>


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
            <div class="row">
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
            <div class="row welcome_inner" style="padding-top:10px;">
                <div class="span12">
                    <h1><span class="colored">///</span> <?php if (!(is_archive()) & (!(is_search()))) { ?><?php the_title(); ?><?php } ?> <?php if ((is_post_type_archive('portfolio-type'))) { ?>Portfolio<?php } ?><?php if ((is_archive() & (!(is_post_type_archive('portfolio-type'))))) { ?>Blog Archive<?php } ?><?php if (is_search()) { ?>Search Results: <?php } ?></h1>
                </div>
            </div>
        </div>
    </div>
	<?php } ?>
    
<div class="container inner_content">
  <div class="row"> 
    <!--Page content-->
    <div class="span12"> 
      
      <!-- Table with opened toolbar -->
      <div class="widget">
        <div class="whead">
          <h6>Magic the Gathering Glossary Database</h6>
          <div class="clear"></div>
        </div>
        <div class="shownpars" > 
          <table cellpadding="0" cellspacing="0" border="0" class="dTable">
            <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
     
       <!-- Table with opened toolbar -->
      <div class="widget">
        <div class="whead">
          <h6>Magic the Gathering Extensive Rule Database</h6>
          <div class="clear"></div>
        </div>
        <div class="shownpars" > 
          <table cellpadding="0" cellspacing="0" border="0" class="dTable2">
            <thead>
              <tr>
                <th>Chapter</th>
                <th>Paragraph</th>
   	             <th>Rule</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
     
    </div>
    <!--/Page content--> 
    
  </div>
</div>
<?php get_footer(); ?>
