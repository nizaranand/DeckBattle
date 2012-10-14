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
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div class="blockquote4" style="border-top:none!important;">
                	<a href="<?php the_permalink(); ?>"><h3 class="colored"><?php the_title(); ?></h3></a><?php the_time('l, F j, Y'); ?>
                </div>
                <?php endwhile; else: ?>

                <?php endif; ?>
                <?php if (function_exists('wp_corenavi')) ?><ul class="pager" style="float:left;"> <?php wp_corenavi(); ?></ul>
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