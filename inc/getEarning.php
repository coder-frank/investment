<?php

if (isset($_SESSION['userId']))
{

require_once '../inc/core.php';


	// STORE ID
	$user->id = $_SESSION['userId'];

	// GET EARNINGS
	$balance = 0;
	$earning = $user->getWithdrawal();
	if ($earning != false)
	{
		while ($row = $earning->fetch(PDO::FETCH_ASSOC))
		{
			$balance += $row['amount'];
		}
	}
	echo "₦".$balance;
	
}
