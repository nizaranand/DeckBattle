<?php 
if ($success != "") { ?>
    <div class="nNote nSuccess">
    <p><?php echo $success; ?></p>
    </div>
<?php
		}

		if ($success2 != "") {
 ?>
    <div class="nNote nSuccess">
    <p><?php echo $success2; ?></p>
    </div>
<?php
		}

		if ($info != "") {
 ?>
    <div class="nNote nInformation">
    <p><?php echo $info; ?></p>
    </div>
<?php
		}

		if ($info2 != "") {
 ?>
    <div class="nNote nInformation">
    <p><?php echo $info2; ?></p>
    </div>
<?php
		}

		if ($error != "") {
 ?>
    <div class="nNote nFailure">
    <p><?php echo $error; ?></p>
    </div>
<?php
		}

		if ($error2 != "") {
 ?>
    <div class="nNote nFailure">
    <p><?php echo $error2; ?></p>
    </div>
<?php
		}

		$success = "";
		$success2 = "";
		$info = "";
		$info2 = "";
		$error = "";
		$error2 = "";
	?>
