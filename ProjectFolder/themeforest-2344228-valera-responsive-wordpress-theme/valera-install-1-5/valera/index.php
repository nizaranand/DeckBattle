<?php get_header(); ?>
<?php 
	global $more;
	$more = 0;	 
?>

	<div class="container inner_content">
        <div class="row">
            <!--Page contetn-->
            <div class="span12">
            	<section>
				<?php if (!(have_posts())) { ?><div class="span12"><h2 class="colored uppercase">There is no posts</h2></div><?php }  ?>   
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div><?php the_content(); ?></div>
                <?php endwhile;  ?> 
                <?php endif; ?>
                </section>
        	</div>
        </div>
    </div>




<?php get_footer(); ?>