<?php
if (isset($_SESSION['adminId']))
{
	require_once './includes/core.php';

	// RUN LOGIN FUNCTION
	$withdraw = $admin->getWithdrawal();
	if ($withdraw->rowCount() == 0)
	{
		echo "<div class='alert alert-primary'>No pending withdrawal found</div>";
		return;
	}
	if ($withdraw != false)
	{
		$count = 1;
		while ($row = $withdraw->fetch(PDO::FETCH_ASSOC)) {
			if ($row['status'] == "Pending")
			{
				$bank = $admin->getBank($row['uid']);
				$bName = "Not found";
				$aName = "Not found";
				$aNum = "Not found";
				if ($bank != false)
				{
					while ($a = $bank->fetch(PDO::FETCH_ASSOC))
					{
						$bName = $a['bankName'];
						$aName = $a['accName'];
						$aNum = $a['accNumber'];
					}
				}
				
				echo '
					<tr>
					<td>'.$count.'</td>
					<td>'.$row['type'].'</td>
					<td>'.$row['amount'].'</td>
					<td>'.$row['date'].'</td>
					<td>'.$bName.'</td>
					<td>'.$aNum.'</td>
					<td>'.$aName.'</td>
					<td><a href="./controllers/approve.php?wid='.$row['id'].'&uid='.$row['uid'].'&amount='.$row['amount'].'&type='.$row['type'].'"><button class="btn btn-success">Approve</button></a></td>
					<td><a href="./controllers/decline.php?wid='.$row['id'].'&uid='.$row['uid'].'&amount='.$row['amount'].'&type='.$row['type'].'"><button class="btn btn-danger">Decline</button></a></td>
					</tr>
					';
				$count++;
			}
		}
	}

}