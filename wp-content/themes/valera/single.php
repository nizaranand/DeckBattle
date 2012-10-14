<?php get_header(); ?>

        	<div class="container inner_content">
                <div class="row">
                    <!--Page contetn-->
                    <div class="span8">
                        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); ?>
                        <section>
                            <div class="row <?php post_class(); ?>" id="post-<?php the_ID(); ?>">
                                <div class="span8">
                                	<?php if (get_post_meta($post->ID, video, true));{ ?>
										<?php echo get_post_meta($post->ID, video, true); ?>
                                    <?php }?>
                                	<?php if (( has_post_thumbnail())) { ?>
                                    <div class="view view-first">
                                        <a href="<?php echo $large_image_url[0]; ?>" rel="prettyPhoto"><img src="<?php echo $large_image_url[0]; ?>" alt="" /></a>
                                        <div clas="mask">
                                            <a href="<?php echo $large_image_url[0]; ?>" rel="prettyPhoto" class="info"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/plus.png" alt="" /></a>
                                            <a href="<?php echo the_permalink(); ?>" class="link"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/link.png" alt="Visit link" /></a>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="span2" <?php if ((get_post_meta($post->ID, video, true) || (has_post_thumbnail())) ) { ?> style="margin-top:35px;"<?php } ?>>
                                    <div class="ddate">
                                        <h5><i class="icon-calendar"></i> <?php the_time('d') ?> <?php the_time('M') ?> / <?php the_time('Y') ?></h5>
                                        <div class="firstA"></div>
                                    </div>
                                    <div class="meta">
                                        <span><strong><i class="icon-user"></i> Author:</strong> <?php the_author_meta('nickname'); ?></span>
                                        <span><strong><i class="icon-list-alt"></i> Tags:</strong> <?php $tag = get_the_tags(); if (! $tag) { ?> There is no tags<?php } else { ?><?php the_tags(''); ?><?php } ?></span>
                                        <span><strong><i class="icon-comment"></i> Comments:</strong> <a href="<?php the_permalink() ?>#comments"><?php comments_number('0','1','%')?></a></span>
                                    </div>
                                    <hr>
                                    <span class="share">Share: </span>
                                    <!-- AddThis Button BEGIN -->
                                    <a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;pubid=ra-4f8811347196f281"><img src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a>
                                    <!-- AddThis Button END -->
                                    <hr>
                                </div>
                                <div class="span6" <?php if ((get_post_meta($post->ID, video, true) || (has_post_thumbnail())) ) { ?> style="margin-top:35px;"<?php } ?>>
                                    <div>
                                        <?php the_content(''); ?>
                                    </div>
                                </div>
                                <div class="span8"><hr></div>
                                <div class="span8">
									<?php comments_template(); ?>
                                </div>
                            </div>
                        </section>
						<?php endwhile;  ?> 
						<?php endif; ?>
                        <section>
	                        <hr style="margin-top:0px;">
							<?php if (function_exists('wp_corenavi')) ?><ul class="pager" style="float:left;"> <?php wp_corenavi(); ?></ul>
                        </section>
                    </div>
                    <!--/Page contetn-->
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