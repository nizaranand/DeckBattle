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

if (isset($_POST['syncDropbox'])) {

syncFiles($metaData["body"]->contents,$dropbox);

}



function getFiles($content,$db){
	$max = sizeof($content);
	if ($max > 0) {
		for ($i=0; $i<$max; $i++) {
			if ($content[$i]->is_dir == "1") {
				$metaDataDeep = $db->metaData($content[$i]->path);
				getFiles($metaDataDeep["body"]->contents,$db);
			}
			else {
	
				$modified = $content[$i]->modified;
				$date = strtotime($modified);
				$class = "uDone";

				if (checkExtension($content[$i]->path,"dec")) {
				
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
                                <span style="font-weight:bold;color:#2B6893;">No Files.</span>
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
        <input class="buttonL bGreen" style="margin-top: 10px;width:100%;" type="submit" name="syncDropbox" id="syncDropbox" value="Sync Dropbox files">

</div>	

        </form>

        <div class="widget">
                    <div class="whead"><h6>Dropbox Files <?php if ($accountInfo["body"]->email != "") echo "(". $accountInfo["body"]->email . ")"; ?></h6><div class="clear"></div></div>
                    <ul class="updates">
                    <?php      
						getFiles($metaData["body"]->contents,$dropbox);
					?>
                   </ul>
         </div>
    
        <!-- content ends-->
        <div class="clear"></div>
    </div>
    <!-- Main content ends -->
</div>
<!-- Content ends -->
</body>
</html>
<?php } ?>