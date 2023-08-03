<?php
if (isset($_SESSION['adminId']))
{
	require_once './includes/core.php';

	// RUN LOGIN FUNCTION
	$package = $admin->getPackages();
	$total = 0;
	if ($package != false)
	{
		while ($row = $package->fetch(PDO::FETCH_ASSOC)) {
			if ($row['type'] == "classic")
			{
				$total += 2500;
			} else if ($row['type'] == "silver")
			{
				$total += 5000;
			} else
			{
				$total += 10000;
			}
		}
		echo number_format($total);
	} else
	{
		echo $total;
	}

}