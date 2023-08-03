<?php
session_start();
if (isset($_SESSION['adminId']))
{
	require_once './core.php';

	// GET POSTED DATA AND SANITIZE
	$uid = $_GET['uid'];



	// RUN LOGIN FUNCTION
	$suspend = $admin->suspend($uid);
	if ($suspend == true)
	{
		// START SESSION FOR USER
		header("location:../");
	} else
	{
		echo "Something Went Wrong";
	}

}