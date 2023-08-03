<?php
session_start();
if (isset($_SESSION['adminId']))
{
	require_once './core.php';

	// GET POSTED DATA AND SANITIZE
	$wid = $_GET['wid'];



	// RUN LOGIN FUNCTION
	$decline = $admin->decline($wid);
	if ($decline == true)
	{
		header("location:../withdraw.php");
	} else
	{
		echo "Something Went Wrong";
	}

}