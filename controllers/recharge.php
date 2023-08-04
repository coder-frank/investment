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
	if ($rCode == false)
	{
		$_SESSION['message'] = "Invalid code";
		header("location:../dashboard/recharge.php");
		die();
	}

	if ($type != $rCode['type']) {
		$_SESSION['message'] = "This code is not meant for your account type";
		header("location:../dashboard/recharge.php");
		die();
	}

	if ($rCode['status'] != "active") {
		$_SESSION['message'] = "Sorry, Looks like this code has been used!";
		header("location:../dashboard/recharge.php");
		die();
	}

	// CHECK ACTIVE PACKAGES
	$check = $user->getPackages();
	if ($check->rowCount() >= 2) {
		$_SESSION['message'] = "You cannot have more than two active packages";
		header("location:../dashboard/recharge.php");
		die();
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
		$type = $user->accType();
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
		$user->addHistory($commision, "Referral");

		$user->id = $_SESSION['userId'];

		//GET RECENT RECHARGE
		$pid = $user->getRecentRecharge();
		$user->createEarnings($pid);
		$user->addHistory($type, "Recharge");

		// REDIRECT USER
		$user->deactivateCode($code);
		$_SESSION['message'] = "Recharge Successful";
	} else {
		$_SESSION['message'] = "Something went wrong";
	}
	header("location:../dashboard/recharge.php");
}
