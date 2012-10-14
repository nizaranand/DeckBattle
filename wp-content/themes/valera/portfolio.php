<?php
// Template Name: Portfolio Template
$paged = 1;
if ( get_query_var('paged') ) $paged = get_query_var('paged');
if ( get_query_var('page') ) $paged = get_query_var('page');
query_posts( '&post_type=portfolio-type&paged=' . $paged );
?>
<?php
$title = get_the_title();
if ( $title == "2 Columns Portfolio")  $data['sl_portfolio_style'] = "2 Columns Portfolio";
if ( $title == "3 Columns Portfolio")  $data['sl_portfolio_style'] = "3 Columns Portfolio";
if ( $title == "4 Columns Portfolio")  $data['sl_portfolio_style'] = "4 Columns Portfolio";
if ( $title == "Portfolio and Right Sidebar")  $data['sl_portfolio_style'] = "Portfolio and Right Sidebar";
if ( $title == "2 Columns Portfolio")  query_posts( '&post_type=portfolio-type&posts_per_page=4&paged=' . $paged );
if ( $title == "4 Columns Portfolio")  query_posts( '&post_type=portfolio-type&posts_per_page=8&paged=' . $paged );
if ( $title == "Portfolio and Right Sidebar")  query_posts( '&post_type=portfolio-type&posts_per_page=8&paged=' . $paged );
if ( $title == "3 Columns Portfolio")  query_posts( '&post_type=portfolio-type&posts_per_page=6&paged=' . $paged );
?>


			<?php get_header(); ?>
            
            <div class="container inner_content">
                <div class="row hidden-phone">
                    <div class="span12">
                        <section>
                            <div id="filters" class="btn-group ">
                                <button data-filter="*" class="mybutton" style='margin-right:6px;'>All Works</button> <?php 
									$categories = get_categories(array('type' => 'post', 'taxonomy' => 'portfolio-category')); 
									foreach($categories as $category) {
									$group = $category->slug;
									  echo "<button data-filter='.$group' class='mybutton' style='margin-right:10px;'>".$category->cat_name."</button>";
									}
									echo "</ul>";
									
								?>
                            </div>
                        </section>
                    </div>
                </div>
                
                <section style="padding-top:25px;">
                <div class="row">
                    <div class="span12">
                        <div id="portfolio" class="row">
							<?php if ($data['sl_portfolio_style'] == "4 Columns Portfolio") { ?>
								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> 
                                <?php
                                    $custom = get_post_custom($post->ID);
                                    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); 
                                     
                                    $cat = get_the_category($post->ID); 
                                ?>
                                <?php $cur_terms = get_the_terms( $post->ID, 'portfolio-category' ); 
										foreach($cur_terms as $cur_term){  
									};
									
									$catt = get_the_terms( $post->ID, 'portfolio-category' );
									$slugg = ''; 
									
									foreach($catt  as $vallue=>$key){
										$slugg .= strtolower($key->slug) . " ";
									}
								?>
                                
                                    <div class="span3 block <?php echo $slugg; ?>"data-filter="">
                                        <div class="view view-first">
                                            <a href="<?php echo $large_image_url[0]; ?>" rel="prettyPhoto"><img src="<?php echo $large_image_url[0]; ?>" alt="" /></a>
                                            <div class="mask">
                                                <a href="<?php echo $large_image_url[0]; ?>" rel="prettyPhoto" class="info"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/plus.png" alt="" /></a>
                                                <a href="<?php echo get_permalink(); ?>" class="link"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/link.png" alt="Visit link" /></a>
                                            </div>
                                        </div>
                                        <h5><?php if (get_post_meta($post->ID, port-icon, true));{ ?><i class="<?php echo get_post_meta($post->ID, 'port-icon', 1); ?>"></i><?php } ?> <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h5>
                                        <div class="description">
                                            <p class="clo"><?php echo get_post_meta($post->ID, 'port-descr', 1); ?></p>
                                        </div>
                                    </div>
                                
                                <?php endwhile; endif; ?>
                            <?php } ?>
        
                        
                        	<?php if ($data['sl_portfolio_style'] == "3 Columns Portfolio") { ?>
								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> 
                                <?php
                                    $custom = get_post_custom($post->ID);
                                    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); 
                                     
                                    $cat = get_the_category($post->ID); 
                                ?>
                                <?php $cur_terms = get_the_terms( $post->ID, 'portfolio-category' ); 
										foreach($cur_terms as $cur_term){  
									};
									
									$catt = get_the_terms( $post->ID, 'portfolio-category' );
									$slugg = ''; 
									
									foreach($catt  as $vallue=>$key){
										$slugg .= strtolower($key->slug) . " ";
									}
								?>
                                
                                    <div class="span4 block <?php echo $slugg; ?>"data-filter="">
                                        <div class="view view-first">
                                            <a href="<?php echo $large_image_url[0]; ?>" rel="prettyPhoto"><img src="<?php echo $large_image_url[0]; ?>" alt="" /></a>
                                            <div class="mask">
                                                <a href="<?php echo $large_image_url[0]; ?>" rel="prettyPhoto" class="info"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/plus.png" alt="" /></a>
                                                <a href="<?php echo get_permalink(); ?>" class="link"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/link.png" alt="Visit link" /></a>
                                            </div>
                                        </div>
                                        <h5><?php if (get_post_meta($post->ID, port-icon, true));{ ?><i class="<?php echo get_post_meta($post->ID, 'port-icon', 1); ?>"></i><?php } ?> <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h5>
                                        <div class="description">
                                            <p class="clo"><?php echo get_post_meta($post->ID, 'port-descr', 1); ?></p>
                                        </div>
                                    </div>
                                
                                <?php endwhile; endif; ?>
                            <?php } ?>
                        
                        	<?php if ($data['sl_portfolio_style'] == "2 Columns Portfolio") { ?>
								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> 
                                <?php
                                    $custom = get_post_custom($post->ID);
                                    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); 
                                     
                                    $cat = get_the_category($post->ID); 
                                ?>
                                <?php $cur_terms = get_the_terms( $post->ID, 'portfolio-category' ); 
										foreach($cur_terms as $cur_term){  
									};
									
									$catt = get_the_terms( $post->ID, 'portfolio-category' );
									$slugg = ''; 
									
									foreach($catt  as $vallue=>$key){
										$slugg .= strtolower($key->slug) . " ";
									}
								?>
                                
                                    <div class="span6 block <?php echo $slugg; ?>"data-filter="">
                                        <div class="view view-first">
                                            <a href="<?php echo $large_image_url[0]; ?>" rel="prettyPhoto"><img src="<?php echo $large_image_url[0]; ?>" alt="" /></a>
                                            <div class="mask">
                                                <a href="<?php echo $large_image_url[0]; ?>" rel="prettyPhoto" class="info"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/plus.png" alt="" /></a>
                                                <a href="<?php echo get_permalink(); ?>" class="link"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/link.png" alt="Visit link" /></a>
                                            </div>
                                        </div>
                                        <h5><?php if (get_post_meta($post->ID, port-icon, true));{ ?><i class="<?php echo get_post_meta($post->ID, 'port-icon', 1); ?>"></i><?php } ?> <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h5>
                                        <div class="description">
                                            <p class="clo"><?php echo get_post_meta($post->ID, 'port-descr', 1); ?></p>
                                        </div>
                                    </div>
                                
                                <?php endwhile; endif; ?>
                            <?php } ?>
                        
                        </div>
                    </div>
                </div>
                </section>
                <hr style="margin-top:0px;">
                    <ul class="pager" style="float:left;">
						<?php paginate(); ?>
                    </ul>
            </div>

            
            
            
            
            
            
            

        <?php get_footer(); ?>