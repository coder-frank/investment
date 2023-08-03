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
			if ($today == $dr)
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
		$amount = $user->getEarnings($pid);
		$withdraw = $user->addWithdraw($amount, "Classic");
		if ($withdraw != false)
		{
			header("location:../dashboard/withdraw.php");
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
	
			echo "you must have an active recharge to access full withdrawal,when u have active recharge, open the external wallet to withdraw your balance";
			header("location:../dashboard/withdraw.php");
		} else
		{
			echo "Something went wrong";
			return;
		}
	}
	

	
	if ($type == 0)
	{
		// E WALLET WITHDRAWAL
		$type = "E-Wallet";
		$old = $user->getWallet();
	} else if ($type == 1)
	{
		// REFERRAL BONUS WIITHDRAWAL
		$type = "Bonus";
		$old = $user->getrefEarning();

	} else {
		echo "Withdrawal Type not supported";
		return;
	}

	if ($old >= $amount)
	{
		// PROCEED WUTH THE WITHDRAWAL
		$withdraw = $user->addWithdraw($amount, $type);
		if ($withdraw != false)
		{
			header("location:../dashboard/withdraw.php");
		} else
		{
			echo "Something went wrong";
		}

	} else
	{
		// INSUFFICIENT FUNDS
		echo "Insufficient Funds";
	}

}