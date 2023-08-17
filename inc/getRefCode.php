<?php

if (isset($_SESSION['userId']))
{

require_once '../inc/core.php';


	// STORE ID
	$user->id = $_SESSION['userId'];

	// GET REFERRAL COUNT
	$code = $user->getrefCode();
	return $code;
	
}
?>