<?php
session_start();
if (isset($_SESSION['adminId']))
{
	require_once './core.php';

	// GET POSTED DATA AND SANITIZE
	$vid = $_GET['vid'];
	$img = $_GET['img'];



	// RUN LOGIN FUNCTION
	$delete = $admin->deleteVendor($vid);
	if ($delete == true)
	{
		unlink("../../universal/custom/image/".$img);
		$_SESSION['message'] = "Vendor deleted successfully";
		header("location:../vendors.php");
	} else
	{
		$_SESSION['message']  = "Something Went Wrong";
	}

}