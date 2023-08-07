<?php


require_once './includes/core.php';


	// GET VENDORS
	$vendors = $admin->getVendors();
	if ($vendors != false)
	{
		$count = 1;
		while ($row = $vendors->fetch(PDO::FETCH_ASSOC))
		{
			echo '
				<tr>
					<td>'.$count.'</td>
					<td>'.$row['name'].'</td>
					<td>'.$row['phone'].'</td>
					<td>'.$row['message'].'</td>
					<td><a href="./controllers/deletev.php?vid='.$row['id'].'&img='.$row['image'].'" class="btn btn-danger">Delete</a></td>
				</tr>
			';
			$count++;
		}
	} else
	{
		echo "<div class='alert alert-primary'>No Vendors found</div>";
	}