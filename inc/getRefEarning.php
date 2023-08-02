<?php

if (isset($_SESSION['userId']))
{

require_once '../inc/core.php';


	// STORE ID
	$user->id = $_SESSION['userId'];

	// GET EARNINGS
	$refEarning = $user->getrefEarning();
	echo "₦".number_format($refEarning);
	
}
