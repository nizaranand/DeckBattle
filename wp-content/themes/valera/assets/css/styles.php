<?php  global $data ?>

.colored {color: <?php echo $data['theme_colors']; ?>;}
.undercolored { border-bottom:1px solid  <?php echo $data['theme_colors']; ?>;}
.undercolored a:hover { color:<?php echo $data['theme_colors']; ?>; }
::selection {background: <?php echo $data['theme_colors']; ?>;}
a { color: <?php echo $data['theme_colors']; ?>;}
a:hover { color: <?php echo $data['theme_colors']; ?>;}
.header_social .badge:hover, .comment .badge:hover { background-color: <?php echo $data['theme_colors']; ?>;}
.badge a {color: <?php echo $data['theme_colors']; ?>;}
.menu a:hover, .menu .hover > a, .menu .current-menu-item > a {background-color: <?php echo $data['theme_colors']; ?>; }
.menu ul li ul li a:hover > .menu ul li a {background-color: <?php echo $data['theme_colors']; ?>; !important;}
.menu a:hover, .menu .hover > a, .menu .current-menu-item > a, {background-color: <?php echo $data['theme_colors']; ?>;}
ul.menu li ul li:first-child > a:hover:after {border-bottom-color:<?php echo $data['theme_colors']; ?>;}
ul.menu li ul li.current_page_item > a:after {border-bottom-color:<?php echo $data['theme_colors']; ?>;}
h2 .label, h3 .label { background-color: <?php echo $data['theme_colors']; ?>;}
.footer_menu li a {border-bottom:1px solid <?php echo $data['theme_colors']; ?>;}
.footer_menu li a:hover { color: <?php echo $data['theme_colors']; ?> !important; }
.mybutton { background-color: <?php echo $data['theme_colors']; ?>;}
.mybutton:hover { background-color: <?php echo $data['theme_colors']; ?>;}