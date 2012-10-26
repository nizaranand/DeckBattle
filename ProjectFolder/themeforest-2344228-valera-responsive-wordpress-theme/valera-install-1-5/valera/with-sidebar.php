<?php
	// Template Name: Page with Sidebar
?>
<?php get_header(); ?>
<?php 
	global $more;
	$more = 0;	 
?>

	<div class="container inner_content">
        <div class="row">
            <!--Page contetn-->
            <div class="span8">
            	<section>
				<?php if (!(have_posts())) { ?><div class="span12"><h2 class="colored uppercase">There is no posts</h2></div><?php }  ?>   
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div><?php the_content(); ?></div>
                <?php endwhile;  ?> 
                <?php endif; ?>
                </section>
        	</div>
            <!--Sidebar-->
            <div class="span4 side_bar">
                <section class="blog_cat">
                    <div class="well">
                        <?php get_sidebar(); ?>
                    </div>
                </section>
            </div>
            <!--/Sidebar-->
        </div>
    </div>




<?php get_footer(); ?>