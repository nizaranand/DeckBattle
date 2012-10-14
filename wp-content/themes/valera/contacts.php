<?php
	// Template Name: Contact Page
?>
<?php get_header(); ?>
    <div id="map-contact">
    </div>
    <div class="container inner_content">
    	<section>
    		<div class="row">
            	<div class="span4">
                	<?php if (!(have_posts())) { ?><div class="span12"><h2 class="colored uppercase">There is no posts</h2></div><?php }  ?>   
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <div class="well"><?php the_content(); ?></div>
                    <?php endwhile;  ?> 
                    <?php endif; ?>
				</div>
                <div class="span8">
                    <h3><span class="colored">///</span> Feel free to contact us</h3>
                    <div id="note"></div>
                    	<div id="fields">
                            <form class="form" id="ajax-contact-form" action="javascript:alert('Was send!');">
                                <!--[if IE]><label for="name">Name</label><![endif]--><input type="text" id="name" name="name" class="span4" style="margin-right:25px;" placeholder="Name" />
                                <!--[if IE]><label for="email">E-mail</label><![endif]--><input id="email"  class="span4" name="email" placeholder="Email" />
                                <!--[if IE]><label for="message">Message</label><![endif]--><textarea id="message" type="text" name="message" placeholder="Message" rows="8" class="span8"></textarea>
                                <button type="submit"  class="mybutton">Send message</button>
                            </form>
                        </div>
                </div>
        	</div>
    	</section>
    </div>



<?php get_footer(); ?>