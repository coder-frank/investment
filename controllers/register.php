<?php

if (isset($_POST['register']))
{
	require_once './core.php';

	// GET AND SANITIZE FORM DATA
	$type = $user->sanitizeString($_POST['type']);
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
		$_SESSION['message'] = "Password do not match";
		header("location:../register.php");
		return;
	}

	// HASH THEE PASSWORD
	$password = $user->passHash($password);

	// ASSIGN VARIBLES TO CLASS
	$user->type = $type;
	$user->fname = $fname;
	$user->lname = $lname;
	$user->email = $email;
	$user->phone = $phone;
	$user->code = $code;
	$user->password = $password;
	$user->status = "active";

	// CHECK USER EXITS
	if ($user->emailExits($email) == false)
	{
		$_SESSION['message'] = "Email Already exits";
		header("location:../register.php");
		return;
	}


	// CHECK CODE EXITS
	if ($code != ""  && $user->codeExits() == false)
	{
		$_SESSION['message'] = "Referral Code do not exit";
		header("location:../register.php");
		return;
	} else {
		// GET AND ASSIGN REF ID
		$refId = $user->getRefId();
		$user->refId = $refId;
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
		// CREATE ALL WALLET
		$user->code = $myCode;
		$user->id = $user->getRefId();
		$user->createRefEarnings();
		$user->createWallet();
		
		$_SESSION['message'] = "Registration successful";
	} else {
		$_SESSION['message'] = "Something went wrong";
	}

	header("location:../register.php");
}
