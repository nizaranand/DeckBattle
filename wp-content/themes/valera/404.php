<?php get_header(); ?>
   <div class="container inner_content">
        <div class="row">
            <!--Page contetn-->
            <div class="span8">
             <section>
            	<h3>Oops! The page you were looking for could not be found.</h3>
                <div class="well">
                <h5>But you can choose another page:</h5>
                <hr>
                <nav>
					<?php wp_nav_menu( array('theme_location' => 'main_menu', 'menu_class' => '')); ?>
                </nav>
                </div>
			</section>
            </div>
            
            <!--/Page contetn-->
           <div class="span4 side_bar">
                <section class="blog_cat">
                    <div class="well">
                        <?php get_sidebar(); ?>
                    </div>
                </section>
            </div>
		</div>
    </div>
<?php get_footer(); ?>