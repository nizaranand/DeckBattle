<!-- Secondary nav -->
<div class="secNav">
	<div class="secWrapper">
		<div class="secTop">
			<?php set_include_path($_SERVER['DOCUMENT_ROOT']);
			include 'dashboard/include/battlesplayed_sidebarheader.php';
 ?>
			<!-- Tabs container -->
			<div id="tab-container" class="tab-container">
				<ul class="iconsLine ic3 etabs">
					<li>
						<a href="#general" title=""><span class="icos-fullscreen"></span></a>
					</li>
					<li>
						<a href="#alt1" title=""><span class="icos-user"></span></a>
					</li>
					<li>
						<a href="#alt2" title=""><span class="icos-archive"></span></a>
					</li>
				</ul>
				<div class="divider">
					<span></span>
				</div>

				<div id="general">
					<!-- Sidebar big buttons -->
					<div class="sidePad">
						<a href="#" title="" class="sideB bLightBlue">Add Deck</a>
					</div>
					<div class="sidePad">
						<a href="#" title="" class="sideB bGreen">Add Cards</a>
					</div>
				</div>

				<!-- tab 2 -->
				<div id="alt1">
					<!-- Sidebar user list -->
					<ul class="userList">
						<li>
							<a href="#" title=""> <img src="/dashboard/images/live/face1.png" alt="" /> <span class="contactName"> <strong>Eugene Kopyov <span>(5)</span></strong> <i>web &amp; ui designer</i> </span> <span class="status_away"></span> <span class="clear"></span> </a>
						</li>
						<li>
							<a href="#" title=""> <img src="/dashboard/images/live/face2.png" alt="" /> <span class="contactName"> <strong>Lucy Wilkinson <span>(12)</span></strong> <i>Team leader</i> </span> <span class="status_off"></span> <span class="clear"></span> </a>
						</li>
						<li>
							<a href="#" title=""> <img src="/dashboard/images/live/face3.png" alt="" /> <span class="contactName"> <strong>John Dow</strong> <i>PHP developer</i> </span> <span class="status_available"></span> <span class="clear"></span> </a>
						</li>
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
			<div class="divider">
				<span></span>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<!-- Sidebar ends -->
