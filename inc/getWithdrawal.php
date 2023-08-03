<?php

if (isset($_SESSION['userId']))
{

require_once '../inc/core.php';


	// STORE ID
	$user->id = $_SESSION['userId'];

	// GET WITHDRAWAL HISTORY
	$withdraw = $user->getWithdrawalHistory();
	if ($withdraw != false)
	{
		$count = 1;
		while ($row = $withdraw->fetch(PDO::FETCH_ASSOC))
		{
			echo '
			<tr>
				<th scope="row">'.$count.'</th>
				<td>'.$row['type'].'</td>
				<td>₦'.number_format($row['amount']).'</td>
				<td>'.$row['date'].'</td>
				<td>'.$row['status'].'</td>
			</tr>
			';
			$count++;
		}
	} else
	{
		echo '<div class="alert alert-danger">No Records Found</div>';
	}
	
	
}
?>