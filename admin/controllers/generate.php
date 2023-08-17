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
	} else if ($type == 2)
	{
		$type = "diamond";
	}


	// RUN LOGIN FUNCTION
	$code = $admin->generateCode();
	while ($admin->codeExits($code) == true) {
		$code = $admin->generateCode();
	}
	echo $code;
	// ADD CODE
	$add = $admin->addCode($code, $type);

	if ($add == true)
	{
		$_SESSION['message'] = ucfirst($type)." code: ".$code;
		header("location:../");
	} else {
		echo "s";
	}
		

} else {
	echo '1';
}