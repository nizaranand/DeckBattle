	<?php  global $data;?>
	<?php if($data['twitter_block'] == true ) { ?>     
	<!--TWITTER AREA-->
    <div class="twitter-block">
        <div class="container">
            <div class="row">
                <div class="span3 header">
                    <h5><?php echo stripslashes($data['twitter_block_header']) ?></h5>
                    <p><?php echo stripslashes($data['twitter_block_content']) ?></p>
                </div>
                <div class="span9">
                    <div class="well">
                        <div class="tweet">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/TWITTER AREA-->
    <?php } ?>
    <!--FOOTER-->
   	<div class="footer">
        <div class="container">
            <div class="row">
                <div class="span3">
                    <img src="<?php echo stripslashes($data['footer_logo']) ?>" alt="logo" style="margin-bottom:7px; margin-top:7px;" />
                	<hr class="visible-phone">
                </div>
                <div class="span3">
                    <h5><?php echo stripslashes($data['footer_block2_header']) ?></h5>
                    <p><?php echo stripslashes($data['footer_block2_content']) ?></p>
                    <hr class="visible-phone">
                </div>
                <div class="span3 flickr">
                    <h5><?php echo stripslashes($data['footer_block3_header']) ?></h5>
                    <p><?php echo stripslashes($data['footer_block3_content']) ?></p>
                </div>
                <div class="span3 soc_icons">
                    <h5><?php echo stripslashes($data['footer_block4_header']) ?></h5>
                    <p><?php echo stripslashes($data['footer_block4_content']) ?></p>
                </div>
            </div>
        </div>
    </div>
    <!--/FOOTER-->
    <?php if($data['bottom_line'] == true ) { ?>
    <!--BOTTOM LINE-->
    <div class="bottom-block">
        <div class="container">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="span6">
                            <span><?php echo stripslashes($data['bottom_line_content']) ?></span>
                        </div>
                        <div class="span6">
                            <span class="pull-right visible-desktop"><?php wp_nav_menu( array('theme_location' => 'secondary_menu', 'menu_class' => 'footer_menu')); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<?php } ?>
</body>
<?php wp_footer(); ?>
</html>