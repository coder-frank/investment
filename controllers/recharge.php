<?php
session_start();
if (isset($_POST['recharge']) && isset($_SESSION['userId'])) {
	require_once './core.php';

	// GET POSTED DATA AND SANITIZE
	$code = $user->sanitizeString($_POST['code']);


	// PROCESS DATA INTO CLASS
	$user->id = $_SESSION['userId'];

	// GET ACCOUNT TYPE
	$type = $user->accType();

	// GET RECHARGE CODE DETAILS
	$rCode = $user->getRechargeCode($code);

	if ($type != $rCode['type']) {
		echo "This code is not meant for your account type";
		return;
	}

	if ($rCode['status'] != "active") {
		echo "Sorry, Looks like this code has been used!";
		return;
	}

	// CHECK ACTIVE PACKAGES
	$check = $user->getPackages();
	if ($check->rowCount() >= 2) {
		echo "You cannot have more than two active packages";
	}
	$today = date("Y-m-d H:i:s");

	$dateTime = new DateTime($today);

	// Add 5 days to the DateTime object
	$dateTime->modify('+5 days');

	// Format the modified date and time as per your preference
	$expire = $dateTime->format('Y-m-d H:i:s');

	// RUN RECHARGE FUNCTION
	$recharge = $user->recharge($type, "active", $expire);
	if ($recharge == true) {
		//GENERATE COMMISSION
		$refId = $user->getRefBy();
		$user->id = $refId;
		$oldBonus = $user->getrefEarning();
		$new = 0;
		$commision = 0;

		if ($type == "classic") {
			$commision = (3 * 2500) / 100;
		} else if ($type == "silver") {
			$commision = (3 * 5000) / 100;
		} else if ($type == "diamond") {
			$commision = (3 * 10000) / 100;
		}
		$new = $oldBonus + $commision;

		$user->topBonus($new);

		// REDIRECT USER
		$user->deactivateCode($code);
		header("location:../dashboard");
	} else {
		echo "Something went wrong";
	}
}
