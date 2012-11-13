<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

include  'dashboard/include/db_connect.php';
include  'dashboard/include/login_functions.php';
include  'dashboard/include/dropbox_functions.php';
include  'dashboard/services/reader_deckedbuilder.php';

sec_session_start();

if(login_check($mysqli) != true) {
 
 header('Location: http://www.deckbattle.com/dashboard/login.php?error=notloggedin');
  
} else {

$userID = $_SESSION['user_id'];

$storage = new \Dropbox\OAuth\Storage\PDO($encrypter, $userID);
$storage->connect('localhost', 'w6022388_mtgdb', 'w6022388_mtgdb', 'OWVDPN1b', 3306);
$storage->setTable('dropbox_oauth_tokens');

if (isset($_POST['linkDropbox'])) {
	$OAuth = new \Dropbox\OAuth\Consumer\Curl($key, $secret, $storage, $callback);
	$dropbox = new \Dropbox\API($OAuth);	
}

//to handle first linkage
if (isset($_GET['uid']) && isset($_GET['oauth_token'])) {
	$OAuth = new \Dropbox\OAuth\Consumer\Curl($key, $secret, $storage, $callback);
	$dropbox = new \Dropbox\API($OAuth);	
	$accountInfo = $dropbox->accountInfo();
}

//check if we have an auth tokenSELECT * FROM `dropbox_oauth_tokens`

if ($stmt = $mysqli->prepare("SELECT userID FROM dropbox_oauth_tokens WHERE userID = ?")) { 
	$stmt->bind_param('s', $userID); 
	$stmt->execute(); 
	$stmt->store_result();
			
	if($stmt->num_rows == 0) { 
		$haveToken = false;
	}
	else {
		$haveToken = true;
	}
}


if ($haveToken) {
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
else {
	$showbutton = true;
}

function syncFiles($content,$db){
	$max = sizeof($content);
	if ($max > 0) {
		for ($i=0; $i<$max; $i++) {
			if ($content[$i]->is_dir == "1") {
				$metaDataDeep = $db->metaData($content[$i]->path);
				syncFiles($metaDataDeep["body"]->contents,$db);
			}
			else {
	
				$modified = $content[$i]->modified;
				$date = strtotime($modified);
			
				$outFile = false;
				$fileForname = $db->getFile($content[$i]->path, $outFile);
				$Deckname = urldecode($fileForname["name"]);
								
				
				$outFile = $_SESSION['user_id'] . "_" . $Deckname;
				$file = $db->getFile($content[$i]->path, $outFile);
				
				if (checkExtension($file["name"],"dec")) {
					$info = importDeckedBuilder($_SESSION['user_id'],"" . $file["name"],$Deckname);
				}
				if (checkExtension($file["name"],"db1")) {
//					$info = importDeckBattle($_SESSION['user_id'],"" . $file["name"],$Deckname);
				}
				unlink($file["name"]);
			}
		}
	}
}

function checkExtension($file,$extensionToCheck)
{
				$tempar = explode(".",$file);
				$extension = end($tempar);
				
				if ($extension == $extensionToCheck){
					return true;
				}
				
				return false;
}

function getFilesMarkedForDropbox($mysqli,$db){

		if ($stmt = $mysqli->prepare("SELECT id, deckname, updated,dropboxPath FROM user_decks WHERE userid = ? AND markfordropbox = 1")) { 
		$stmt->bind_param('s', $_SESSION['user_id']); 
		$stmt->execute(); 
		$stmt->store_result();
		$stmt->bind_result($deckid,$db_deckname, $updated, $dropboxPath); // get variables from result.
		
		
 while ($stmt->fetch()) {
    $path = "/";
	$metaData = $db->metaData($path);
	$content = $metaData["body"]->contents;

	 if (!checkIfDeckInDropbox($content,$db_deckname,$db))
	 {
	 				$date = strtotime($updated);

				?>
					 <li>
								<span class="uPut">
									<span style="font-weight:bold;color:#2B6893;"><?php echo $db_deckname; ?></span>
									<!--<span>We've just set up a new server. Our gurus ...</span> -->
								</span>
								
								<span class="uDate"><span><?php echo strftime("%d",$date); ?></span><?php echo  strftime("%b",$date);  ?></span>
								<span class="clear"></span>
					</li>
	   
				
				<?
	 }
 		}
		}
}


function checkIfDeckInDropbox($content,$deckname_input,$db){
	$result = false;
	
	$max = sizeof($content);
	if ($max > 0) {
		for ($i=0; $i<$max; $i++) {
			if ($content[$i]->is_dir == "1") {
				$metaDataDeep = $db->metaData($content[$i]->path);
				checkIfDeckInDropbox($metaDataDeep["body"]->contents,$deckname_input,$db);
			}
			else {
	
				$modified = $content[$i]->modified;
				$date = strtotime($modified);
				
				$outFile = false;
				$fileForname = $db->getFile($content[$i]->path, $outFile);
				$Deckname = urldecode($fileForname["name"]);

				if (checkExtension($Deckname,"dec"))
				{
					$Deckname = str_replace(".dec","",$Deckname);
				}
				if (checkExtension($Deckname,"db1"))
				{
					$Deckname = str_replace(".db1","",$Deckname);
				}
				
				if ($Deckname == $deckname_input)
				$result = true;
			}
		}
	}
	
	return($result);
}



function checkIfDeckExists($deckpath,$db,$mysqli)
{
	$outFile = false;
	$fileForname = $db->getFile($deckpath, $outFile);
	$deckname = urldecode($fileForname["name"]);

	if (checkExtension($deckname,"dec"))
	{
		$deckname = str_replace(".dec","",$deckname);
	}
	if (checkExtension($deckname,"db1"))
	{
		$deckname = str_replace(".db1","",$deckname);
	}
	if ($stmt = $mysqli->prepare("SELECT deckname FROM user_decks WHERE deckname = ?")) { 
		$stmt->bind_param('s', $deckname); 
		$stmt->execute(); 
		$stmt->store_result();
		
		if($stmt->num_rows == 0) {
			return "uNew";
		}
		else
		{
			return "uSync";
		}
	}
	
}

function addFilesToDropbox($db,$mysqli){
	if ($stmt = $mysqli->prepare("SELECT id, deckname, updated,dropboxPath,extension FROM user_decks WHERE userid = ? AND markfordropbox = 1")) { 
	$stmt->bind_param('s', $_SESSION['user_id']); 
	$stmt->execute(); 
	$stmt->store_result();
	$stmt->bind_result($deckid,$db_deckname, $updated, $dropboxPath,$extension); // get variables from result.
		
		 while ($stmt->fetch()) {
			$path = "/";
			$metaData = $db->metaData($path);
			$content = $metaData["body"]->contents;
		
			 if (!checkIfDeckInDropbox($content,$db_deckname,$db))
			 {
				//create file
				$ourFileName = $db_deckname . $extension;
				$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
				//put in data
				
if ($stmt1 = $mysqli->prepare("SELECT cardid, amount_normal, amount_foil, location,Ncardname FROM user_decks_cards join Ncards on cardid=Ncardid WHERE deckid = ? ")) { 
	$stmt1->bind_param('s', $deckid); 
	$stmt1->execute(); 
	$stmt1->store_result();
	$stmt1->bind_result($cardid,$an, $af, $location,$cardname); // get variables from result.
		
		 while ($stmt1->fetch()) {
				$stringData = $cardid . ";" . $an . ";" . $af. ";" .$location. ";" . $cardname. "\n";
				fwrite($ourFileHandle, $stringData);
		 }
}
				fclose($ourFileHandle);
				
				//put file
				$put = $db->putFile($ourFileName);
				//add file path to database
				//update dropbox path
		
				//delete original file
				unlink($ourFileName);
		
			 }
		  }
	}
}

if (isset($_POST['syncDropbox'])) {
	addFilesToDropbox($dropbox,$mysqli);
	syncFiles($metaData["body"]->contents,$dropbox);
}



function getFiles($content,$db,$mysqli){
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
				$class = checkIfDeckExists($content[$i]->path,$db,$mysqli);
	
				if (checkExtension($content[$i]->path,"dec") || checkExtension($content[$i]->path,"db1")) {
				
				?>
					 <li>
								<span class="<?php echo $class; ?>">
									<span style="font-weight:bold;color:#2B6893;"><?php echo $content[$i]->path; ?></span>
									<!--<span>We've just set up a new server. Our gurus ...</span> -->
								</span>
								
								<span class="uDate"><span><?php echo strftime("%d",$date); ?></span><?php echo  strftime("%b",$date);  ?></span>
								<span class="clear"></span>
							</li>
	   
				
				<?
				}
			}
		}
	}
	else
	{
		?>
		 <li>
                            <span>
                                <span style="font-weight:bold;color:#2B6893;">No Files at /App/DeckBattle of your Dropbox Account. If you just uploaded new decks to your account, please wait a second, browse DeckBattle and return to this page.It sometimes takes a couple of seconds to get a new listing from dropbox.</span>
                                <!--<span>We've just set up a new server. Our gurus ...</span> -->
                            </span>
                            
                            <span class="uDate"><span></span></span>
                            <span class="clear"></span>
                        </li>
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
        ?>
		<form action="" method="post" >
	<div class="wButton">
        <input class="buttonL bGreen" style="margin-top: 10px;width:100%;" type="submit" name="syncDropbox" id="syncDropbox" value="Synchronize your Decks with Dropbox">

</div>	

        </form>
<div class="fluid">
        <div class="widget grid6">
                    <div class="whead"><h6>Synchronisation Listing | <?php if ($accountInfo["body"]->email != "") echo "Dropbox account: ". $accountInfo["body"]->email . ""; ?></h6><div class="clear"></div></div>
                    <ul class="updates">
                    <?php    
						getFilesMarkedForDropbox($mysqli,$dropbox);  
						getFiles($metaData["body"]->contents,$dropbox,$mysqli);
					?>
                   </ul>
         </div>
    
     <div class="widget grid6">
                    <div class="whead"><h6>Important Notes</h6><div class="clear"></div></div><div class="body">
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
                    </ul></div>
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