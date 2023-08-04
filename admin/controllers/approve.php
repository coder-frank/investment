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
			echo "Uid: ".$uid."Old: ".$old."<br>";
			if ($old >= $amount)
			{
				$new = $old - $amount;
				$deduct = $admin->deductBonus($uid, $new);
				if ($deduct == true)
				{
					$_SESSION['message']  = "Transaction approved";
				} else {
					$_SESSION['message']  = "Something went wrong";
				}
			} else
			{
				$_SESSION['message']  = "Insufficient Balance, please decline this withdrawal";
			}
		} else if ($type == "E-Wallet")
		{
			$old = $admin->getWallet($uid);
			
			if ($old >= $amount)
			{
				$new = $old - $amount;
				$admin->deductWallet($uid, $amount);
			} else
			{
				$_SESSION['message'] = "Insufficient Balance, please decline this withdrawal";
			}
		}



		// START SESSION FOR USER
		header("location:../withdraw.php");
	} else
	{
		$_SESSION['message'] = "Something Went Wrong";
	}

}