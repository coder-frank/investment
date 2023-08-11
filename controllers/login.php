<?php
if (isset($_POST['login']))
{
	require_once './core.php';
	// START SESSION
	session_start();

	// GET POSTED DATA AND SANITIZE
	$email = $user->sanitizeString($_POST['email']);
	$password = $user->sanitizeString($_POST['password']);


	// PROCESS DATA INTO CLASS
	$user->email = $email;

	// RUN LOGIN FUNCTION
	$login = $user->login($password);
	if ($login != false)
	{
		if ($login['status'] == "suspended")
		{
			$_SESSION['message'] = "Opps! Looks like your account has been suspended, contact us to reactivate your account";
			header("location:../login.php");
			die();
			return;
		}
		// START SESSION FOR USER
		$_SESSION['userId'] = $login['id'];
		$_SESSION['name'] = $login['fname']." ".$login['lname'];
		$_SESSION['userEmail'] = $email;
		$_SESSION['status'] = $login['status'];
		header("location:../dashboard");
	} else
	{
		$_SESSION['message'] = "Email/Password Incorrect";
	}

}