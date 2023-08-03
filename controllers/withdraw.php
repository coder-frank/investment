<?php
session_start();
if (isset($_SESSION['userId']) && isset($_POST['withdraw']))
{
	require_once './core.php';

	// GET FORM
	$type = $user->sanitizeString($_POST['type']);
	$amount = $user->sanitizeString($_POST['amount']);

	// STORE ID
	$user->id = $_SESSION['userId'];

	// CHECK FOR MINIMUM WITHDRAWAL
	if ($amount < 1500)
	{
		echo 'Sorry: Minimum withdrawal allowed is ₦1,500';
		return;
	}

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
	

	
	if ($type == 0)
	{
		// E WALLET WITHDRAWAL
		$type = "E-Wallet";



		// CHECK ACTIVE PACKAGES
		$user->id = $_SESSION['userId'];
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
			$old = $user->getWallet();
		} else {
			echo "Sorry, you need to have an active package in order to withdraw from your E-Wallet";
			return;
		}

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