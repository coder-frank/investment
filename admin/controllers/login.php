<?php
if (isset($_POST['adminLogin']))
{
	require_once './core.php';

	// GET POSTED DATA AND SANITIZE
	$email = $_POST['email'];
	$password = $_POST['password'];



	// RUN LOGIN FUNCTION
	$login = $admin->login($email, $password);
	session_start();
	if ($login != false)
	{
		// START SESSION FOR USER
		$_SESSION['adminId'] = $login['id'];
		$_SESSION['adminEmail'] = $email;
		header("location:../");
	} else
	{
		$_SESSION['message']  = "Email/Password Incorrect";
		header("location:../login.php");
	}

}