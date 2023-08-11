<?php

if (isset($_SESSION['userId']))
{

require_once '../inc/core.php';


	// STORE ID
	$uid = $_SESSION['userId'];

	// GETUSER STATUS
	return $user->getAccountStatus($uid);
	
	
}
?>