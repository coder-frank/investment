<?php
if (isset($_POST['login']))
{
	require_once './core.php';

	// GET POSTED DATA AND SANITIZE
	$email = $user->sanitizeString($_POST['email']);
	$password = $user->sanitizeString($_POST['password']);


	// PROCESS DATA INTO CLASS
	$user->email = $email;

	// RUN LOGIN FUNCTION
	$login = $user->login($password);
	if ($login != false)
	{
		// START SESSION FOR USER
		session_start();
		$_SESSION['userId'] = $login['id'];
		$_SESSION['name'] = $login['fname']." ".$login['lname'];
		$_SESSION['userEmail'] = $email;
		header("location:../dashboard");
	} else
	{
		echo "Email/Password Incorrect";
	}

}