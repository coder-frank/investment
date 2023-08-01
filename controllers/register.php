<?php

if (isset($_POST['register']))
{
	require_once './core.php';

	// GET AND SANITIZE FORM DATA
	$fname = $user->sanitizeString($_POST['fname']);
	$lname = $user->sanitizeString($_POST['lname']);
	$email = $user->sanitizeString($_POST['email']);
	$phone = $user->sanitizeString($_POST['phone']);
	$code = $user->sanitizeString($_POST['code']);
	$password = $user->sanitizeString($_POST['password']);
	$rpassword = $user->sanitizeString($_POST['rpassword']);

	// CHECK IF PASSWORDS MATCH
	if ($password != $rpassword)
	{
		echo "Password do not match";
		return;
	}

	// HASH THEE PASSWORD
	$password = $user->passHash($password);

	// ASSIGN VARIBLES TO CLASS
	$user->fname = $fname;
	$user->lname = $lname;
	$user->email = $email;
	$user->phone = $phone;
	$user->code = $code;
	$user->password = $password;

	// CHECK USER EXITS
	if ($user->emailExits($email) == false)
	{
		echo "Email Already exits";
		return;
	}


	// CHECK CODE EXITS
	if ($code != ""  && $user->codeExits($email) == false)
	{
		echo "Referral Code do not exit";
		return;
	}

	// GENERATE AND ASSIGN CODE
	$myCode = $user->generateCode($code);
	while ($user->codeExits($code) == false)
	{
		$myCode = $user->generateCode($code);
	}
	$user->myCode = $myCode;


	$register = $user->register();
	if ($register == true)
	{
		echo "Registration successful";
	} else {
		echo "Something went wrong";
	}


}

?>