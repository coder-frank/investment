<?php
if (isset($_POST['adminLogin']))
{
	require_once './core.php';

	// GET POSTED DATA AND SANITIZE
	$email = $_POST['email'];
	$password = $_POST['password'];



	// RUN LOGIN FUNCTION
	$login = $admin->login($email, $password);
	if ($login != false)
	{
		// START SESSION FOR USER
		session_start();
		$_SESSION['adminId'] = $login['id'];
		$_SESSION['adminEmail'] = $email;
		header("location:../");
	} else
	{
		echo "Email/Password Incorrect";
	}

}