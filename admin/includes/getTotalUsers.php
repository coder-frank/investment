<?php
if (isset($_SESSION['adminId']))
{
	require_once './includes/core.php';

	// RUN LOGIN FUNCTION
	$users = $admin->getUsers();
	if ($users != false)
	{
		echo $users->rowCount();
	} else
	{
		echo "0";
	}

}