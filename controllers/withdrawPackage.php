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
			echo 'Sorry you cannot place withdrawal more than twice a day!';
			return;
		}
	}


	// CHECK IF E-WALLET IS EMPTY
	$amount = $user->getWallet($pid);
	if ($amount > 0)
	{
		echo "Please first withdraw the money in your E-Wallet before initaiting withdrawal";
		return;
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
			return;
		} else
		{
			echo "Something went wrong";
			return;
		}

	} else {
		$amount = ($amount / 2);
		$withdraw = $user->addWithdraw($amount, "Classic");
		if ($withdraw != false)
		{
			$oldWallet = $user->getWallet();
			$user->topWallet($amount + $oldWallet);
			$user->deletePackage($pid);
			echo "you must have an active recharge to access full withdrawal,when u have active recharge, open the external wallet to withdraw your balance";
			header("location:../dashboard");
		} else
		{
			echo "Something went wrong";
			return;
		}
	}
	


}