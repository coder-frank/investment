<?php
if (isset($_POST['login']))
{
	require_once './core.php';

	// GET POSTED DATA AND SANITIZE
	$email = $user->sanitizeString($_POST['email']);
	$password = $user->sanitizeString($_POST['password']);

	// HASH PASSWORD
	$password = $user->passHash();

	// PROCESS DATA INTO CLASS
	$user->email = $email;
	$user->password = $password;

	// RUN LOGIN FUNCTION
	if ($user->login() == true)
	{
		// START SESSION FOR USER
		session_start();
		$_SESSION['userEmail'] = $email;
		header("location:../dashboard");
	} else
	{
		echo "Email/Password Incorrect";
	}

}