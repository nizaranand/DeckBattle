<!-- Sidebar begins -->
<div id="sidebar">
<div class="mainNav">
  <div class="user"> <a title="" class="leftUserDrop">
  
  <?php 
  if ($_SESSION['avatar'] != "")
  {
   echo '<img src="/avatars/'. $_SESSION['avatar'].'" alt="" />';
  }
  else
  {
	  echo '<img src="images/user.png" alt="" />';
  }
  ?>
  <span><strong>3</strong></span></a><span><?php echo $_SESSION['username']; ?></span>
    <ul class="leftUser">
      <li><a href="profile.php" title="" class="sProfile">My profile</a></li>
      <li><a href="settings.php" title="" class="sSettings">Settings</a></li>
      <li><a href="login.php?logout=true" title="" class="sLogout">Logout</a></li>
    </ul>
  </div>
  
  <!-- Responsive nav -->
  <div class="altNav"> 
    <!--            <div class="userSearch">
                <form action="">
                    <input type="text" placeholder="search..." name="userSearch" />
                    <input type="submit" value="" />
                </form>
            </div> --> 
    
    <!-- User nav -->
    <ul class="userNav">
      <li><a href="profile.php" title="" class="profile"></a></li>
      <li><a href="settings.php" title="" class="settings"></a></li>
      <li><a href="login.php?logout=true" title="" class="logout"></a></li>
    </ul>
  </div>
  
  <!-- Main nav -->
  <ul class="nav">
    <li><a href="index.php" title="" class="active"><img src="images/icons/mainnav/dashboard.png" alt="" /><span>Dashboard</span></a></li>
    <li><a href="collection.php" title=""><img src="images/icons/mainnav/forms.png" alt="" /><span>Cards & Decks</span></a>
      <ul>
        <li><a href="collection.php" title=""><span class="icol-list"></span>Card Collection</a></li>
        <li><a href="decks.php" title=""><span class="icol-alert"></span>Deck Collection</a></li>
        <li><a href="favorites.php" title=""><span class="icol-pencil"></span>Favorites List</a></li>
        <li><a href="trades" title=""><span class="icol-pencil"></span>Trade List</a></li>
        <li><a href="wishlist" title=""><span class="icol-signpost"></span>Wish List</a></li>
      </ul>
    </li>
    <li><a href="" title=""><img src="images/icons/mainnav/other.png" alt="" /><span>Battles</span></a>
      <ul>
        <li><a href="other_calendar.html" title=""><span class="icol-dcalendar"></span>Calendar</a></li>
        <li><a href="other_gallery.html" title=""><span class="icol-images2"></span>Images gallery</a></li>
        <li><a href="other_file_manager.html" title=""><span class="icol-files"></span>File manager</a></li>
        <li><a href="#" title="" class="exp"><span class="icol-alert"></span>Error pages <span class="dataNumRed">6</span></a>
          <ul>
            <li><a href="other_403.html" title="">403 error</a></li>
            <li><a href="other_404.html" title="">404 error</a></li>
            <li><a href="other_405.html" title="">405 error</a></li>
            <li><a href="other_500.html" title="">500 error</a></li>
            <li><a href="other_503.html" title="">503 error</a></li>
            <li><a href="other_offline.html" title="">Website is offline error</a></li>
          </ul>
        </li>
        <li><a href="other_typography.html" title=""><span class="icol-create"></span>Typography</a></li>
        <li><a href="other_invoice.html" title=""><span class="icol-money2"></span>Invoice template</a></li>
      </ul>
    </li>
    <li><a href="" title=""><img src="images/icons/mainnav/tables.png" alt="" /><span>Tools</span></a>
      <ul>
        <li><a href="" title=""><span class="icol-frames"></span>Deck Tester</a></li>
        <li><a href="" title=""><span class="icol-refresh"></span>Combo Checker</a></li>
        <li><a href="" title=""><span class="icol-bullseye"></span>Notes</a></li>
        <li><a href="" title=""><span class="icol-transfer"></span>--</a></li>
      </ul>
    </li>
    <li><a href="statistics.html" title=""><img src="images/icons/mainnav/statistics.png" alt="" /><span>Statistics</span></a></li>
    <li><a href="ui.html" title=""><img src="images/icons/mainnav/ui.png" alt="" /><span>Players</span></a>
      <ul>
        <li><a href="ui.html" title=""><span class="icol-fullscreen"></span>General elements</a></li>
        <li><a href="ui_icons.html" title=""><span class="icol-images2"></span>Icons</a></li>
        <li><a href="ui_buttons.html" title=""><span class="icol-coverflow"></span>Button sets</a></li>
        <li><a href="ui_grid.html" title=""><span class="icol-view"></span>Grid</a></li>
        <li><a href="ui_custom.html" title=""><span class="icol-cog2"></span>Custom elements</a></li>
        <li><a href="ui_experimental.html" title=""><span class="icol-beta"></span>Experimental</a></li>
      </ul>
    </li>
    <li><a href="messages.html" title=""><img src="images/icons/mainnav/messages.png" alt="" /><span>Messages</span></a></li>
  </ul>
</div>
