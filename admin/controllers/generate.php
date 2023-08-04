<?php
session_start();
if (isset($_POST['generate']) && isset($_SESSION['adminId']))
{
	require_once './core.php';

	// GET POSTED DATA AND SANITIZE
	$type = $_POST['type'];
	if ($type == 0)
	{
		$type = "classic";
	} else if ($type == 1)
	{
		$type = "silver";
	} else
	{
		$type = "diamond";
	}


	// RUN LOGIN FUNCTION
	$code = $admin->generateCode($type);
	if ($code != false)
	{
		while ($admin->codeExits($code) == true) {
			$code = $admin->generateCode();
		}
		// ADD CODE
		$add = $admin->addCode($code, $type);

		if ($add == true)
		{
			$_SESSION['message'] = ucfirst($type)." code: ".$code;
			header("location:../");
		}
		
	} else
	{
		$_SESSION['message']  = "Something went wrong";
	}

}