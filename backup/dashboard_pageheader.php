<?php

$n = $f = $d = 0;
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

?>
<div class="contentTop"> <span class="pageTitle"><span class="icon-screen"></span>Dashboard</span>
  <ul class="quickStats">
    <li> <a href="" class="blueImg tipN" title="Red: <br />Green: <br />White: <br />Black: <br />Blue: <br />Multi:"><img src="images/icons/quickstats/plus.png" alt="" /></a>
      <div class="floatR"><strong class="blue"><?php echo $d; ?></strong><span>Decks</span></div>
    </li>
    <li> <a href="" class="greenImg tipN" id="usercardstotalTip" title="<?php echo $n; ?> Normal &amp; <?php echo $f;?> Foil"><img src="images/icons/quickstats/money.png" alt="" /></a>
      <div class="floatR"><strong class="blue" id="usercardstotal"><?php echo ($n + $f); ?></strong><span>Cards</span></div>
    </li>
    <!--            <li>
                <a href="" class="redImg"><img src="images/icons/quickstats/user.png" alt="" /></a>
                <div class="floatR"><strong class="blue">4658</strong><span>users</span></div>
            </li>-->
  </ul>
  <div class="clear"></div>
</div>
