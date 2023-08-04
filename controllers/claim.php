<?php
session_start();
if (isset($_SESSION['userId']))
{
	require_once './core.php';

	// GET ACCOUNT TYPE
	$user->id = $_SESSION['userId'];
	$type = $user->accType();

	$daily = 0;
	if ($type == "classic")
	{
		$daily = 1000;
	} else if ($type == "silver")
	{
		$daily = 2000;
	} else if ($type == "diamond")
	{
		$daily = 4000;
	}

	// GET OLD EARNING
	$pid = $_GET['pid'];
	$old = $user->getEarnings($pid);

	// TOP UP USER
	$topUp = $user->topEarnings($old + $daily, $pid);

	if ($topUp != false)
	{
		$_SESSION['message'] = "Claimed Successfully";
	} else
	{
		$_SESSION['message'] = "Something went wrong";
	}
	header("location:../dashboard");

}