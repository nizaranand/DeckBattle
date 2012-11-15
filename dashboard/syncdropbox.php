<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

include  'dashboard/include/db_connect.php';
include  'dashboard/include/login_functions.php';
include  'dashboard/include/dropbox_functions.php';
include  'dashboard/services/dropboxsync_functions.php';
include  'dashboard/services/reader_deckedbuilder.php';
include  'dashboard/services/reader_deckbattle.php';

sec_session_start();

if(login_check($mysqli) != true) {
 
 header('Location: http://www.deckbattle.com/dashboard/login.php?error=notloggedin');
  
} else {

$userID = $_SESSION['user_id'];

$storage = new \Dropbox\OAuth\Storage\PDO($encrypter, $userID);
$storage->connect('localhost', 'w6022388_mtgdb', 'w6022388_mtgdb', 'OWVDPN1b', 3306);
$storage->setTable('dropbox_oauth_tokens');

//HANDLE FIRST TIME DROPBOX LINK
if (isset($_POST['linkDropbox'])) {
	$OAuth = new \Dropbox\OAuth\Consumer\Curl($key, $secret, $storage, $callback);
	$dropbox = new \Dropbox\API($OAuth);	
}

//WHEN REDIRECTED FROM DROPBOX FIRST LINK
if (isset($_GET['uid']) && isset($_GET['oauth_token'])) { 
	$OAuth = new \Dropbox\OAuth\Consumer\Curl($key, $secret, $storage, $callback);
	$dropbox = new \Dropbox\API($OAuth);	
	$accountInfo = $dropbox->accountInfo();
}

//SYNCHRONIZE
if (isset($_POST['syncDropbox'])) {
	$OAuth = new \Dropbox\OAuth\Consumer\Curl($key, $secret, $storage, $callback);
	$dropbox = new \Dropbox\API($OAuth);	
	addFilesToDropbox($dropbox,$mysqli);
	syncFiles($metaData["body"]->contents,$dropbox);
}


//CHECK IF WE HAVE A DROPBOX ACCOUNT OTHERWISE SHOW BUTTON TO LINK FIRST
if ($stmt = $mysqli->prepare("SELECT userID FROM dropbox_oauth_tokens WHERE userID = ?")) { 
	$stmt->bind_param('s', $userID); 
	$stmt->execute(); 
	$stmt->store_result();
			
	if($stmt->num_rows == 0) { 
		$showbutton = true;
	}
	else {
		$showbutton = false;
		
		//connect
		$OAuth = new \Dropbox\OAuth\Consumer\Curl($key, $secret, $storage, $callback);
		$dropbox = new \Dropbox\API($OAuth);
		
		// Retrieve the account information
		$accountInfo = $dropbox->accountInfo();
		
		// Get the metadata for the file/folder specified in $path
		$path = "/";
		$metaData = $dropbox->metaData($path);

	}
}


function getFilesMarkedForDropbox($mysqli,$db){

$result = false;

if ($stmt = $mysqli->prepare("SELECT id, deckname, updated,dropboxPath, extension FROM user_decks WHERE userid = ? AND markfordropbox = 1")) { 
	$stmt->bind_param('s', $_SESSION['user_id']); 
	$stmt->execute(); 
	$stmt->store_result();
	$stmt->bind_result($deckid,$db_deckname, $updated, $dropboxPath,$extension); // get variables from result.
	
	while ($stmt->fetch()) {
		$path = "/";
		$metaData = $db->metaData($path);
		$content = $metaData["body"]->contents;
		
		if (!checkIfDeckInDropbox($content,$db_deckname,$db)) {
			$result = true;
			$date = strtotime($updated);
			
			?>
			<li style="background-color:#FFF"><span class="uPut"><span style="font-weight:bold;color:#2B6893;"><?php echo ($db_deckname . $extension); ?></span>
			<!--<span>We've just set up a new server. Our gurus ...</span> -->
			</span><span class="uDate"><span><?php echo strftime("%d",$date); ?></span><?php echo  strftime("%b",$date);  ?></span><span class="clear"></span></li>
			<?
		}
	}
}

return $result;
}


function getFilesFromDropbox($content,$db,$mysqli){
	$max = sizeof($content);
	if ($max > 0) {
		for ($i=0; $i<$max; $i++) {
			if ($content[$i]->is_dir == "1") {
				$metaDataDeep = $db->metaData($content[$i]->path);
				getFiles($metaDataDeep["body"]->contents,$db,$mysqli);
			}
			else {
	
				$modified = $content[$i]->modified;
				$date = strtotime($modified);
				$class = checkIfDeckExistsInDatabase($content[$i]->path,$db,$mysqli);
	
				if (checkExtension($content[$i]->path,"dec") || checkExtension($content[$i]->path,"db1")) {
				
				?>
<li style="background-color:#FFF"><span class="<?php echo $class; ?>"><span style="font-weight:bold;color:#2B6893;"><?php echo $content[$i]->path; ?></span>
  <!--<span>We've just set up a new server. Our gurus ...</span> -->
  </span><span class="uDate"><span><?php echo strftime("%d",$date); ?></span><?php echo  strftime("%b",$date);  ?></span><span class="clear"></span></li>
<?
				}
			}
		}
	}
	else
	{
		?>
<li style="background-color:#FFF"><span><span style="font-weight:bold;color:#2B6893;">No Files at /App/DeckBattle of your Dropbox Account.<br />
  If you just uploaded new decks to your account, please wait a second, browse DeckBattle and return to this page.It sometimes takes a couple of seconds to get a new listing from dropbox.</span>
  <!--<span>We've just set up a new server. Our gurus ...</span> -->
  </span><span class="uDate"><span></span></span><span class="clear"></span></li>
<?php
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>DeckBattle Dashboard</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<!--[if IE]> <link href="css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->

<?php include 'dashboard/include/script_include.php'; ?>
<script>
$(function() {
$("select, .check, .check :checkbox, input:radio, input:file").uniform();

});
</script>
</head>

<body>
<?php include 'dashboard/include/dashboard_header.php'; ?>
<?php include 'dashboard/include/dashboard_farleftsidebar.php'; ?>
<?php include 'dashboard/include/dashboard_leftsidebar.php'; ?>

<!-- Content begins -->
<div id="content">
  <?php include 'dashboard/include/dashboard_pageheader.php'; 
createPageHeader("Sync Dropbox",$mysqli);
?>
  <?php include 'dashboard/include/dashboard_breadcrumb.php';
generateBreadcrumb("Dashboard","Sync Dropbox");
 ?>
  <!-- Main content -->
  <div class="wrapper"> 
    <!-- content -->
    <?php
        if ($showbutton)
{
?>
    <form action="" method="post" >
      <div class="wButton">
        <input class="buttonL bRed" style="margin-top: 10px;width:100%;" type="submit" name="linkDropbox" id="linkDropbox" value="No Dropbox account linked to DeckBattle. Click here to link your Dropbox account to DeckBattle.">
      </div>
    </form>
    <?php } 
	else {
        ?>
    <form action="" method="post" >
      <div class="wButton">
        <input class="buttonL bGreen" style="margin-top: 10px;width:100%;" type="submit" name="syncDropbox" id="syncDropbox" value="Synchronize your Decks with Dropbox">
      </div>
    </form>
     <?php } 
        ?>
    <div class="fluid">
      <div class="widget grid6">
        <div class="whead">
          <h6>Synchronisation Listing |
            <?php if ($accountInfo["body"]->email != "") echo "Dropbox account: ". $accountInfo["body"]->email . ""; ?>
          </h6>
          <div class="clear"></div>
        </div>
        <ul class="updates">
          <li> <span> <span style="font-weight:bold;color:#2B6893;">DeckBattle Decks</span> <span>To mark a deck for Dropbox syncing go to the deck and change the Dropbox Settings.</span> </span> <span class="uDate"><span></span></span> <span class="clear"></span> </li>
          <?php    
					 $check = getFilesMarkedForDropbox($mysqli,$dropbox);  
					 if (!$check) {
						?>
          <li style="background-color:#FFF"> <span> <span style="font-weight:bold;color:#2B6893;">All decks marked for Dropbox are uploaded in your dropbox folder</span> <span></span> </span> <span class="uDate"><span></span></span> <span class="clear"></span> </li>
          <?php
						 
					 }
					 ?>
          <li> <span> <span style="font-weight:bold;color:#2B6893;">Dropbox File Listing</span> <span>These are the files located in your Dropbox account at /Apps/Deckbattle (including subfolders).</span> </span> <span class="uDate"><span></span></span> <span class="clear"></span> </li>
          <?php
						getFilesFromDropbox($metaData["body"]->contents,$dropbox,$mysqli);
					?>
        </ul>
      </div>
      <div class="widget grid6">
        <div class="whead">
          <h6>Important Notes</h6>
          <div class="clear"></div>
        </div>
        <div class="body">
          <ul class="liWarning">
            <li>For your safety, DeckBattle only looks in the folder "/App/DeckBattle" in your Dropbox account.</li>
            <li>The <strong>LATEST VERSION</strong> takes priority. So if the file in Dropbox has been changed last, it will overwrite the deck on DeckBattle and vice versa.</li>
            <li>Syncing will <strong>OVERWRITE</strong> a deck.</li>
            <li>Foil cards are <strong>NOT</strong> supported in .dec files. If you export your deck with foil cards to a .dec file they are replaced by normal cards.</li>
            <li>Decks are synced by <strong>NAME WITHOUT EXTENSION</strong>. So keep that in mind when you have files with the same name but different extensions.</li>
          </ul>
          <ul class="liInfo">
            <li>.dec files are supported. These files are created by Deckedbuilder.</li>
            <li>.db1 files are supported. These are native DeckBattle exports, Version 1.</li>
            <li>.txt files are supported. Download example file for the structure.</li>
            <li>Cards are synced by Name (.txt) <strong>OR</strong> Multiverse ID if available (.dec / .db1).</li>
          </ul>
        </div>
      </div>
      <!-- content ends--> 
    </div>
    <div class="clear"></div>
  </div>
  <!-- Main content ends --> 
</div>
<!-- Content ends -->
</body>
</html>
<?php } ?>