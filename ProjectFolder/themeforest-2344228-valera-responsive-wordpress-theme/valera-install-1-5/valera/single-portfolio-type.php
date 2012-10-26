			<?php get_header(); ?>
            <?php
				$custom = get_post_custom($post->ID);
				$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); 
				$small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog'); 
				$small_p_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'portfolio-three'); 
				$cat = get_the_category($post->ID); 
				$cat = $cat[0]; 
			?>
            <?php $img1 = get_post_meta($post->ID, 'image', true); ?>
            <?php $img2 = get_post_meta($post->ID, 'image2', true); ?>
            <?php $img3 = get_post_meta($post->ID, 'image3', true); ?>            
            
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
                <div class="container inner_content">
                    <section>
                        <div class="row">
                            <div class="span8 portfolio-slider">
                            	<?php if (!((get_post_meta($post->ID, image, true)) || (get_post_meta($post->ID, image2, true)) || (get_post_meta($post->ID, image3, true)) || (get_post_meta($post->ID, video, true)))) { ?>
                                	<img src="<?php echo $large_image_url[0]; ?>" alt="" />
								<?php } ?>
                                <?php if (get_post_meta($post->ID, video, true));{ ?>
									<?php echo get_post_meta($post->ID, video, true); ?>
                                <?php }?>	
								<?php if ((get_post_meta($post->ID, 'image', true)) || (get_post_meta($post->ID, 'image2', true)) || (get_post_meta($post->ID, 'image3', true))){ ?>
                                <div class="flexslider">
                                    <ul class="slides">
                                    	<?php if (get_post_meta($post->ID, 'image', true)) { ?>
                                        <li>
                                            <img src="<?php echo get_post_meta($post->ID, image, true); ?>" alt="" />
                                        </li>
                                        <?php } ?>
                                        <?php if (get_post_meta($post->ID, 'image2', true)) { ?>
                                        <li>
                                            <img src="<?php echo get_post_meta($post->ID, image2, true); ?>" alt="" />
                                        </li>
                                        <?php } ?>
                                        <?php if (get_post_meta($post->ID, 'image3', true)) { ?>
                                        <li>
                                            <img src="<?php echo get_post_meta($post->ID, image3, true); ?>" alt="" />
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="span4 portfolio-description">
                                <h2><span class="label"><?php the_title(); ?></span></h2>
                                <section>
                                    <?php the_content(''); ?>
                                </section>
                            </div>
                        </div>
                    </section>
                </div>
           
            <?php endwhile;  ?>
	 		<?php endif; ?>
        <!--End main container-->
        <!--Footer-->
        <?php get_footer(); ?>