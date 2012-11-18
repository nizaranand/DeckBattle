<?php
function createPageHeader($pagename, $mysqli) {
	
if ($stmt = $mysqli->prepare("SELECT SUM(amount_normal), SUM(amount_foil) FROM user_cardcollection WHERE userid = ?")) { 
		$stmt->bind_param('s', $_SESSION['user_id']); 
		$stmt->execute(); 
		$stmt->store_result();
		$stmt->bind_result($n, $f); // get variables from result.
		$stmt->fetch();
}

if ($stmt = $mysqli->prepare("SELECT count(id) FROM user_decks WHERE userid = ?")) { 
		$stmt->bind_param('s', $_SESSION['user_id']); 
		$stmt->execute(); 
		$stmt->store_result();
		$stmt->bind_result($d); // get variables from result.
		$stmt->fetch();
}

if ($stmt = $mysqli->prepare("SELECT count(id) FROM user_decks WHERE userid = ? AND color = '{A}'")) { 
		$stmt->bind_param('s', $_SESSION['user_id']); 
		$stmt->execute(); 
		$stmt->store_result();
		$stmt->bind_result($artifact); // get variables from result.
		$stmt->fetch();
}

if ($stmt = $mysqli->prepare("SELECT count(id) FROM user_decks WHERE userid = ? AND color = ''")) { 
		$stmt->bind_param('s', $_SESSION['user_id']); 
		$stmt->execute(); 
		$stmt->store_result();
		$stmt->bind_result($none);
		$stmt->fetch();
}

if ($stmt = $mysqli->prepare("SELECT count(id) FROM user_decks WHERE userid = ? AND color = '{R}'")) { 
		$stmt->bind_param('s', $_SESSION['user_id']); 
		$stmt->execute(); 
		$stmt->store_result();
		$stmt->bind_result($red);
		$stmt->fetch();
}

if ($stmt = $mysqli->prepare("SELECT count(id) FROM user_decks WHERE userid = ? AND color = '{G}'")) { 
		$stmt->bind_param('s', $_SESSION['user_id']); 
		$stmt->execute(); 
		$stmt->store_result();
		$stmt->bind_result($green);
		$stmt->fetch();
}

if ($stmt = $mysqli->prepare("SELECT count(id) FROM user_decks WHERE userid = ? AND color = '{U}'")) { 
		$stmt->bind_param('s', $_SESSION['user_id']); 
		$stmt->execute(); 
		$stmt->store_result();
		$stmt->bind_result($blue);
		$stmt->fetch();
}

if ($stmt = $mysqli->prepare("SELECT count(id) FROM user_decks WHERE userid = ? AND color = '{W}'")) { 
		$stmt->bind_param('s', $_SESSION['user_id']); 
		$stmt->execute(); 
		$stmt->store_result();
		$stmt->bind_result($white);
		$stmt->fetch();
}

if ($stmt = $mysqli->prepare("SELECT count(id) FROM user_decks WHERE userid = ? AND color = '{B}'")) { 
		$stmt->bind_param('s', $_SESSION['user_id']); 
		$stmt->execute(); 
		$stmt->store_result();
		$stmt->bind_result($black);
		$stmt->fetch();
}

if ($stmt = $mysqli->prepare("SELECT count(id) FROM user_decks WHERE userid = ? AND NOT color = '{A}' AND NOT color = '{B}' AND NOT color = '{W}' AND NOT color = '{G}' AND NOT color = '{U}' AND NOT color = '{R}' AND NOT color = ''")) { 
		$stmt->bind_param('s', $_SESSION['user_id']); 
		$stmt->execute(); 
		$stmt->store_result();
		$stmt->bind_result($multi);
		$stmt->fetch();
}
?>
<div class="contentTop"> <span class="pageTitle"><!--<span class="icon-screen"></span>--><?php echo $pagename; ?></span>
  <ul class="quickStats">
    <li> <a href="/dashboard/collection/decks.php" class="blueImg tipN" title="Red: <?php echo $red; ?><br />Green: <?php echo $green; ?><br />White: <?php echo $white; ?><br />Black: <?php echo $black; ?><br />Blue: <?php echo $blue; ?><br />Multi: <?php echo $multi; ?><br />Artifact: <?php echo $artifact; ?><br />No Color: <?php echo $none; ?>"><img src="/dashboard/images/icons/quickstats/plus.png" alt="" /></a>
      <div class="floatR"><strong class="blue"><?php echo $d; ?></strong><span>Decks</span></div>
    </li>
    <li> <a href="/dashboard/collection/collection.php" class="greenImg tipN" id="usercardstotalTip" title="<?php echo $n; ?> Normal &amp; <?php echo $f; ?> Foil"><img src="/dashboard/images/icons/quickstats/money.png" alt="" /></a>
      <div class="floatR"><strong class="blue" id="usercardstotal"><?php echo($n + $f); ?></strong><span>Cards</span></div>
    </li>
    <!--
    	    <li>
                <a href="" class="redImg"><img src="images/icons/quickstats/user.png" alt="" /></a>
                <div class="floatR"><strong class="blue">4658</strong><span>users</span></div>
            </li>
            -->
  </ul>
  <div class="clear"></div>
</div>
<?php
}
?>