<?php

if (isset($_SESSION['userId']))
{

require_once '../inc/core.php';


	// STORE ID
	$user->id = $_SESSION['userId'];

	// GET EARNINGS
	$history = $user->getRechargeHistory();
	if ($history != false)
	{
		$count = 1;
		while ($row = $history->fetch(PDO::FETCH_ASSOC))
		{
			$pa = $row['amount'];
			if (is_numeric($pa))
			{
				$pa = "₦".$pa;
			} else
			{
				$pa = ucfirst($pa);
			}
			echo '
			<tr>
				<th scope="row">'.$count.'</th>
				<td>'.$row['type'].'</td>
				<td>'.$pa.'</td>
				<td>'.$row['date'].'</td>
			</tr>
			';
			$count++;
		}
	} else {
		echo "<div class='alert alert-danger'>No history found</div>";
	}
	
}
