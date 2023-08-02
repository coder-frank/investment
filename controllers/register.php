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
		echo "Password do not match";
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
		echo "Email Already exits";
		return;
	}


	// CHECK CODE EXITS
	if ($code != ""  && $user->codeExits() == false)
	{
		echo "Referral Code do not exit";
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
		$user->createEarnings();
		$user->createRefEarnings();
		$user->createWallet();
		
		echo "Registration successful";
	} else {
		echo "Something went wrong";
	}


}
