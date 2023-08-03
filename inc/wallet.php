<?php

if (isset($_SESSION['userId']))
{

require_once '../inc/core.php';


	// STORE ID
	$user->id = $_SESSION['userId'];

	// GET WALLET BALANCE
	$wallet = $user->getWallet();
	echo "₦".number_format($wallet);
	
}
?>