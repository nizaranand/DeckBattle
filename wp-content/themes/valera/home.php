<?php
	// Template Name: Home Page
?>
<?php get_header(); ?>

	<!--WELCOME AREA-->
    <div class="gray_bg">
        <div class="container">
            <div class="row welcome">
                <div class="span12">
                    <h1><?php echo stripslashes($data['welcome_text']) ?></h1>
                    <p><em><?php echo stripslashes($data['welcome_description']) ?></em></p>
                </div>
            </div>
        </div>
    </div>
    <!--/WELCOME AREA-->
    <div class="slider_area">
        <div class="container">
            <div class="row">
                <div class="span4 hidden-phone">
                    <?php echo stripslashes($data['slider_description']) ?>
                </div>
                <div class="span8 mainslider">
                    <div class="flexslider">
                        <ul class="slides">
                        	<?php
							 $flexslider = $data['sl_flexslider'];                 
							 $i=0;
							 foreach($flexslider as $slide){
								 $i++;
							?>
                        	<li><a href="<?php echo stripslashes($flexslider[$i]['link']); ?>"><img src="<?php echo stripslashes($flexslider[$i]['url']); ?>" alt="" title="" /></a>
                            <?php if(($flexslider[$i]['description'] == true ) || ($flexslider[$i]['title'] == true ) ) { ?>
                            <div class="flex-caption">
                            	<?php if($flexslider[$i]['title'] == true ) { ?>
                            		<h3><?php echo stripslashes($flexslider[$i]['title']); ?></h3>
                                <?php } ?>  
                                <?php if($flexslider[$i]['description'] == true ) { ?>  
									<p><?php echo stripslashes($flexslider[$i]['description']); ?></p>
								<?php } ?>
                            </div>
                            <?php } ?>
                            </li>       
                    		<?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/SLIDER AREA-->
	<!--FEATURES AREA-->
    <div class="gray_bg">
        <div class="container">
            <div class="row m25">
            	<?php echo stripslashes($data['features_area']) ?>
            </div>
        </div>
    </div>
    <!--FEATURES AREA-->
	<div class="container" style="margin-bottom:50px;">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php the_content(''); ?>
    <?php endwhile;  ?>
    <?php endif; ?>
    </div>

          
<?php get_footer(); ?>