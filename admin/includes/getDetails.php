<?php
if (isset($_SESSION['adminId']))
{
	require_once './includes/core.php';

	// RUN LOGIN FUNCTION
	$users = $admin->getUsers();
	if ($users != false)
	{
		$count = 1;
		while ($row = $users->fetch(PDO::FETCH_ASSOC)) {
			$bName = "Not found";
			$accName = "Not found";
			$accNum = "Not found";
			$balance = 0;
			$bank = $admin->getBank($row['id']);
			if ($bank != false)
			{
				while ($a = $bank->fetch(PDO::FETCH_ASSOC)) {
					$bName = $a['bankName'];
					$accName = $a['accName'];
					$accNum = $a['accNumber'];
				}
			}

			$earning = $admin->getEarning($row['id']);
			if ($earning != false)
			{
				while ($b = $earning->fetch(PDO::FETCH_ASSOC)) {
					$balance += $b['balance'];
				}
			}

			$balance = number_format($balance);

			echo '
			<tr>
				<td>'.$count.'</td>
				<td>'.$row['fname'].' '.$row['lname'].'</td>
				<td>'.$row['email'].'</td>
				<td>'.$row['phone'].'</td>
				<td>₦'.$balance.'</td>
				<td>'.$bName.'</td>
				<td>'.$accName.'</td>
				<td>'.$accNum.'</td>
				<td><a href="./controllers/activate.php?uid='.$row['id'].'"><button class="btn btn-success">Activate</button></a></td>
				<td><a href="./controllers/suspend.php?uid='.$row['id'].'"><button class="btn btn-warning">Suspend</button></a></td>
				<td><a href="./controllers/delete.php?uid='.$row['id'].'"><button class="btn btn-danger">Delete</button></a></td>
			</tr>
			';
			$count++;
		}










	} else
	{
		echo "<div class='alert alert-dange'>No users Found</div>";
	}

}