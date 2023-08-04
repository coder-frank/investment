<?php
session_start();
if (isset($_SESSION['userId']))
{
	require_once './core.php';

	// GET FORM
	$pid = $user->sanitizeString($_GET['pid']);

	// STORE ID
	$user->id = $_SESSION['userId'];

	// CHECK PREVIOUS WITHDRAWAL
	$oldW = $user->getWithdrawalHistory();
	if ($oldW != false)
	{
		$todayW = 0;
		$today = date("Y-m-d");
		while ($row = $oldW->fetch(PDO::FETCH_ASSOC)) {
			$dr = explode(" ", $row['date']);
			$dr = $dr[0];
			if ($today == $dr && $row['status'] == "Pending")
			{
				$todayW++;
			}
		}
		if ($todayW >= 2)
		{
			$_SESSION['message'] = 'Sorry you cannot place withdrawal more than twice a day!';
			header("location:../dashboard");
		}
	}


	// CHECK IF E-WALLET IS EMPTY
	$amount = $user->getWallet($pid);
	if ($amount > 0)
	{
		$_SESSION['message'] = "Please first withdraw the money in your E-Wallet before initaiting withdrawal";
		header("location:../dashboard");
	}
	$amount = $user->getEarnings($pid);
	// CHECK ACTIVE PACKAGES
	$pCount = 0;
	$active = $user->getPackages();
	while ($row = $active->fetch(PDO::FETCH_ASSOC)) {
		if ($row['status'] == "active")
		{
			$pCount++;
		}
	}


	if ($pCount > 0 || $user->activeWithdrawal() == true)
	{
		$withdraw = $user->addWithdraw($amount, "Classic");
		if ($withdraw != false)
		{
			$user->deletePackage($pid);
			header("location:../dashboard");
		} else
		{
			$_SESSION['message'] = "Something went wrong";
			header("location:../dashboard");
		}

	} else {
		$amount = ($amount / 2);
		$withdraw = $user->addWithdraw($amount, "Classic");
		if ($withdraw != false)
		{
			$oldWallet = $user->getWallet();
			$user->topWallet($amount + $oldWallet);
			$user->deletePackage($pid);
			$_SESSION['message'] = "You must have an active recharge to access full withdrawal,when u have active recharge, open the external wallet to withdraw your balance";
			header("location:../dashboard");
		} else
		{
			$_SESSION['message'] = "Something went wrong";
			header("location:../dashboard");
		}
	}
	


}