<!-- Sidebar begins -->
<div id="sidebar">
<div class="mainNav">
  <div class="user"> <a title="" class="leftUserDrop">
  
  <?php
	if ($_SESSION['avatar'] != "") {
		echo '<img src="/avatars/' . $_SESSION['avatar'] . '" alt="" />';
	} else {
		echo '<img src="/dashboard/images/user.png" alt="" />';
	}
  ?>
  <!-- TODO: label messages <span><strong>3</strong></span>--></a><span><?php echo $_SESSION['username']; ?></span>
    <ul class="leftUser">
      <li><a href="/dashboard/profile.php" title="" class="sProfile">My profile</a></li>
      <li><a href="/dashboard/settings.php" title="" class="sSettings">Settings</a></li>
      <li><a href="/dashboard/login.php?logout=true" title="" class="sLogout">Logout</a></li>
    </ul>
  </div>
  
  <!-- Responsive nav -->
  <div class="altNav"> 
    <!--            <div class="userSearch">
                <form action="">
                    <input type="text" placeholder="search..." name="userSearch" />
                    <input type="submit" value="" />
                </form>
            </div> 
      --> 
    
    <!-- User nav -->
    <ul class="userNav">
      <li><a href="/dashboard/profile.php" title="" class="profile"></a></li>
      <li><a href="/dashboard/settings.php" title="" class="settings"></a></li>
      <li><a href="/dashboard/login.php?logout=true" title="" class="logout"></a></li>
    </ul>
  </div>
  
  <!-- Main nav -->
  <ul class="nav">
    <li><a href="/dashboard/index.php" title=""><img src="/dashboard/images/icons/mainnav/dashboard.png" alt="" /><span>Dashboard</span></a></li>
    <li><a href="/dashboard/collection/collection.php" title=""><img src="/dashboard/images/icons/mainnav/forms.png" alt="" /><span>Cards & Decks</span></a>
      <ul>
        <li><a href="/dashboard/collection/collection.php" title=""><span class="icol-list"></span>Card Collection</a></li>
        <li><a href="/dashboard/collection/decks.php" title=""><span class="icol-alert"></span>Deck Collection</a></li>
        <li><a href="/dashboard/collection/favorites.php" title=""><span class="icol-pencil"></span>Favorite Cards</a></li>
        <li><a href="/dashboard/collection/tradelist.php" title=""><span class="icol-pencil"></span>Trade List</a></li>
        <li><a href="/dashboard/collection/wishlist.php" title=""><span class="icol-signpost"></span>Wish List</a></li>
      </ul>
    </li>
    <li><a href="/dashboard/battles/battles.php" title=""><img src="/dashboard/images/icons/mainnav/other.png" alt="" /><span>Battles</span></a>
      <ul>
        <li><a href="/dashboard/battles/battle_start.php" title=""><span class="icol-dcalendar"></span>Start Battle</a></li>
        <li><a href="/dashboard/battles/battle_invite.php" title=""><span class="icol-images2"></span>Invite for Battle</a></li>
      </ul>
    </li>
    <li><a href="/dashboard/tools/tools.php" title=""><img src="/dashboard/images/icons/mainnav/tables.png" alt="" /><span>Tools</span></a>
      <ul>
        <li><a href="/dashboard/tools/tools_tester.php" title=""><span class="icol-frames"></span>Deck Tester</a></li>
        <li><a href="/dashboard/tools/tools_combo.php" title=""><span class="icol-refresh"></span>Combo Checker</a></li>
        <li><a href="/dashboard/tools/tools_notes.php" title=""><span class="icol-bullseye"></span>Notes</a></li>
      </ul>
    </li>
    <li><a href="/dashboard/statistics.php" title=""><img src="/dashboard/images/icons/mainnav/statistics.png" alt="" /><span>Statistics</span></a></li>
    <li><a href="/dashboard/players.php" title=""><img src="/dashboard/images/icons/mainnav/ui.png" alt="" /><span>Players</span></a></li>
    <li><a href="/dashboard/messages.php" title=""><img src="/dashboard/images/icons/mainnav/messages.png" alt="" /><span>Messages</span></a></li>
  </ul>
</div>
