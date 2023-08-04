<?php
session_start();
if (isset($_POST['addBank']) && isset($_SESSION['userId']))
{
	require_once './core.php';

	// GET POSTED DATA AND SANITIZE
	$bankName = $user->sanitizeString($_POST['bankName']);
	$accName = $user->sanitizeString($_POST['accName']);
	$accNum = $user->sanitizeString($_POST['accNum']);


	// PROCESS DATA INTO CLASS
	$user->bankName = $bankName;
	$user->bankAccName = $accName;
	$user->bankAccNum = $accNum;
	$user->id = $_SESSION['userId'];

	// RUN LOGIN FUNCTION
	$add = $user->addBank();
	if ($add == true)
	{
		// REDIRECT USER
		$_SESSION['message'] = "Bank Added Successfully";
	} else
	{
		$_SESSION['message'] = "Something went wrong";
	}
	header("location:../dashboard");
}