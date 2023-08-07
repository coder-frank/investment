<?php


require_once './core.php';


	// GET VENDORS
	$vendors = $user->getVendors();
	if ($vendors != false)
	{
		while ($row = $vendors->fetch(PDO::FETCH_ASSOC))
		{
			echo '
				<li>
					<a target="_blank" href="https://api.whatsapp.com/send?phone='.$row['phone'].'&text='.$row['message'].'">
						<img src="./universal/custom/image/'.$row['image'].'">
						<div>
						<br>
							<h3>'.$row['name'].'</h3>
							<p></p>
						</div>
					</a>
				</li>
			';
		}
	} else
	{
		echo "<div class='alert alert-primary'>No Vendors found</div>";
	}