<!-- Secondary nav -->

<div class="secNav">
  <div class="secWrapper">
    <div class="secTop">
<?php set_include_path($_SERVER['DOCUMENT_ROOT']);
 include "dashboard/include/battlesplayed_sidebarheader.php"; ?>    
    
    <!-- Tabs container -->
    <div id="tab-container" class="tab-container">
      <ul class="iconsLine ic3 etabs">
        <li><a href="#general" title=""><span class="icos-fullscreen"></span></a></li>
        <li><a href="#alt1" title=""><span class="icos-user"></span></a></li>
        <li><a href="#alt2" title=""><span class="icos-archive"></span></a></li>
      </ul>
      <div class="divider"><span></span></div>
      
      <div id="general">
        <div id="">
          <ul class="subNav">
            <li><a href="/dashboard/collection/collection.php" title=""><span class="icos-images2"></span>Card Collection</a></li>
            <li><a href="/dashboard/collection/decks.php" title=""><span class="icos-fullscreen"></span>Deck Collection</a></li>
            <li><a href="/dashboard/collection/favorites.php" title=""><span class="icos-coverflow"></span>Favorite Cards</a></li>
            <li><a href="/dashboard/collection/tradelist.php" title=""><span class="icos-view"></span>Trade List</a></li>
            <li><a href="/dashboard/collection/wishlist.php" title=""><span class="icos-beta"></span>Wish List</a></li>
          </ul>
        </div>
              <div class="divider"><span></span></div>

        <div class="fluid sideWidget">
                            <div class="formRow">
                             <form action="/dashboard/collection/decks.php" method="post" enctype="multipart/form-data" class="main" id="validate">
                    
                    <label><strong>Import Deck (.db1/.dec/.txt)</strong></label>
                    <input type="file" class="fileInput" id="deckimport" name="deckimport" />
                </div>

                <div><input type="submit" class="buttonS bGreyish" value="Import Deck" /></div>
                <h6>OR</h6>
                <a class="buttonL bGreen" href="/dashboard/syncdropbox.php">Sync with Dropbox</a>
            </div>


      </div>
      
      <!-- tab 2 -->
      <div id="alt1"> 
        <!-- Sidebar user list -->
        <ul class="userList">
          <li> <a href="#" title=""> <img src="/dashboard/images/live/face1.png" alt="" /> <span class="contactName"> <strong>Eugene Kopyov <span>(5)</span></strong> <i>web &amp; ui designer</i> </span> <span class="status_away"></span> <span class="clear"></span> </a> </li>
          <li> <a href="#" title=""> <img src="/dashboard/images/live/face2.png" alt="" /> <span class="contactName"> <strong>Lucy Wilkinson <span>(12)</span></strong> <i>Team leader</i> </span> <span class="status_off"></span> <span class="clear"></span> </a> </li>
          <li> <a href="#" title=""> <img src="/dashboard/images/live/face3.png" alt="" /> <span class="contactName"> <strong>John Dow</strong> <i>PHP developer</i> </span> <span class="status_available"></span> <span class="clear"></span> </a> </li>
        </ul>
      </div>
      <div id="alt2"> 
        
        <!-- Sidebar forms -->
        <div class="sideWidget">
          <div class="formRow">
            <label>Usual input field:</label>
            <input type="text" name="regular" placeholder="Your name" />
          </div>
          <div class="formRow">
            <label>Usual textarea:</label>
            <textarea rows="8" cols="" name="textarea" placeholder="Your message"></textarea>
          </div>
          <div class="formRow">
            <input type="submit" class="buttonS bLightBlue" value="Submit button" />
          </div>
        </div>
      </div>
    </div>
    <div class="divider"><span></span></div>
  </div>
  <div class="clear"></div>
</div>
</div>
<!-- Sidebar ends --> 
