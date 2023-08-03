<?php
if (isset($_SESSION['adminId']))
{
	require_once './includes/core.php';

	// RUN LOGIN FUNCTION
	$withdraw = $admin->getWithdrawal();
	$total = 0;
	if ($package != false)
	{
		while ($row = $withdraw->fetch(PDO::FETCH_ASSOC)) {
			if ($row['status'] == "Pending")
			{
				$total++;
			}
		}
		echo number_format($total);
	} else
	{
		echo $total;
	}

}