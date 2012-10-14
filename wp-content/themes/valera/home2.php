<?php
	// Template Name: Home Page II
?>
<?php get_header(); ?>

	<!--WELCOME AREA-->
    <div class="gray_bg">
        <div class="container">
            <div class="row welcome">
                <div class="span12">
                    <h1><?php echo stripslashes($data['welcome_text1']) ?></h1>
                    <p><em><?php echo stripslashes($data['welcome_description1']) ?></em></p>
                </div>
            </div>
        </div>
    </div>
    <!--/WELCOME AREA-->
    <div class="slider_area">
        <div class="container">
            <div class="row">
                <div class="span12 mainslider">
                    <div class="flexslider">
                        <ul class="slides">
                        	<?php
							 $flexsliderr = $data['sl_flexsliderr'];                 
							 $i=0;
							 foreach($flexsliderr as $slide){
								 $i++;
							?>
                        	<li><a href="<?php echo stripslashes($flexsliderr[$i]['link']); ?>"><img src="<?php echo stripslashes($flexsliderr[$i]['url']); ?>" alt="" title="" /></a>
                            <?php if(($flexsliderr[$i]['description'] == true ) || ($flexsliderr[$i]['title'] == true ) ) { ?>
                            <div class="styleii">
                                <div class="flex-caption">
                                    <?php if($flexsliderr[$i]['title'] == true ) { ?>
                                        <h3><?php echo stripslashes($flexsliderr[$i]['title']); ?></h3>
                                    <?php } ?>  
                                    <?php if($flexsliderr[$i]['description'] == true ) { ?>  
                                        <p><?php echo stripslashes($flexsliderr[$i]['description']); ?></p>
                                    <?php } ?>
                                </div>
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
	<div class="container" style="margin-bottom:50px;">
        <section>
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <?php the_content(''); ?>
                <?php endwhile;  ?>
                <?php endif; ?>
        </section>
    </div>

          
<?php get_footer(); ?>