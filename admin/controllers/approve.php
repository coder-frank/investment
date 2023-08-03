<?php
session_start();
if (isset($_SESSION['adminId']))
{
	require_once './core.php';

	// GET POSTED DATA AND SANITIZE
	$uid = $_GET['uid'];
	$wid = $_GET['wid'];
	$amount = $_GET['amount'];
	$type = $_GET['type'];



	// RUN LOGIN FUNCTION
	$approve = $admin->approve($wid);
	if ($approve == true)
	{
		// ADD TO HISTORY
		$admin->addHistory($uid, $amount, "Withdrawal");

		// DEDUCT THE MONEY

		if ($type == "Bonus")
		{
			$old = $admin->getBonus($uid);
			
			if ($old >= $amount)
			{
				$new = $old - $new;
				$admin->deductBonus($uid, $amount);
			} else
			{
				echo "Insufficient Balance, please decline this withdrawal";
				return;
			}
		} else if ($type == "E-Wallet")
		{
			$old = $admin->getWallet($uid);
			
			if ($old >= $amount)
			{
				$new = $old - $new;
				$admin->deductWallet($uid, $amount);
			} else
			{
				echo "Insufficient Balance, please decline this withdrawal";
			}
		}



		// START SESSION FOR USER
		header("location:../withdraw.php");
	} else
	{
		echo "Something Went Wrong";
	}

}