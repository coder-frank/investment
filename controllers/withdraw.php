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
		$_SESSION['message'] = 'Sorry: Minimum withdrawal allowed is ₦1,500';
		header("location:../dashboard/withdraw.php");
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
			$_SESSION['message'] = 'Sorry you cannot place withdrawal more than twice a day!';
			header("location:../dashboard/withdraw.php");
		}
	}
	

	
	if ($type == 0)
	{
		// E WALLET WITHDRAWAL
		$type = "E-Wallet";

		// CHECK IF WITHDRAWAL HAS ALREADY BEEN MADE
		$check = $user->getWithdrawalHistory();
		if ($check != false)
		{
			$cCount = 0;
			while ($row = $check->fetch(PDO::FETCH_ASSOC)) {
				if ($row['type'] == "E-Wallet" && $row['status'] == "Pending")
				{
					$cCount++;
				}
			}

			if ($cCount > 0)
			{
				$_SESSION['message'] = "A similar withdrawal has already been initaited, please try again when it has been approved";
				header("location:../dashboard/withdraw.php");
			}
		}

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
			$_SESSION['message'] = "Sorry, you need to have an active package in order to withdraw from your E-Wallet";
			header("location:../dashboard/withdraw.php");
		}

	} else if ($type == 1)
	{
		// REFERRAL BONUS WIITHDRAWAL
		$type = "Bonus";
		// CHECK IF WITHDRAWAL HAS ALREADY BEEN MADE
		$check = $user->getWithdrawalHistory();
		if ($check != false)
		{
			$cCount = 0;
			while ($row = $check->fetch(PDO::FETCH_ASSOC)) {
				if ($row['type'] == "Bonus" && $row['status'] == "Pending")
				{
					$cCount++;
				}
			}

			if ($cCount > 0)
			{
				$_SESSION['message'] = "A similar withdrawal has already been initaited, please try again when it has been approved";
				header("location:../dashboard/withdraw.php");
			}
		}
		$old = $user->getrefEarning();

	} else {
		$_SESSION['message'] = "Withdrawal Type not supported";
		header("location:../dashboard/withdraw.php");
	}


	if ($old >= $amount)
	{
		// PROCEED WITH THE WITHDRAWAL
		$withdraw = $user->addWithdraw($amount, $type);
		if ($withdraw != false)
		{
			$_SESSION['message'] = "Withdrawal Successful";
			header("location:../dashboard/withdraw.php");
		} else
		{
			$_SESSION['message'] = "Something went wrong";
			header("location:../dashboard/withdraw.php");
			return;
		}

	} else
	{
		// INSUFFICIENT FUNDS
		$_SESSION['message'] = "Insufficient Funds";
		header("location:../dashboard/withdraw.php");
	}

}