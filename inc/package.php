<?php

require_once '../inc/core.php';
$user->id = $_SESSION['userId'];
if ($user->packageExits() == true)
{
	$date = date("Y-m-d");
	$row = $user->getPackages();
	while ($package = $row->fetch(PDO::FETCH_ASSOC)) {
		$exp = explode(" ", $package['date_expire']);
		$exp = $exp[0];
		$dateStarted =  explode(" ", $package['date_created']);
		$dateStarted = $dateStarted[0];
		$button = "";
		$startDate = new DateTime($dateStarted);
		$endDate = new DateTime($exp);

		// Calculate the difference between the two dates
		$interval = $startDate->diff($endDate);

		// Get the number of days from the interval
		$daysDifference = $interval->days;
		$progress = 20;
		switch ($daysDifference) {
			case '2':
				$progress = 80;
				break;
			case '3':
				$progress = 60;
				break;
			case '4':
				$progress = 40;
				break;
			case '5':
				$progress = 20;
				break;
			
			default:
				$progress = 100;
				break;
		}

		if ($date == $exp)
		{
			$button = '<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Withdraw</button>';
		} else {
			$button = '<button class="btn btn-primary">Claim</button>';
		}
		echo '
		<div class="task">
			<div class="head text-xs font-weight-bold text-primary text-uppercase mb-1">
			<br>    
			<h4><b>'.ucfirst($package['type']).'</b></h4>
				'.$button.'
			</div>
			<h5>Total Claimed: ₦5,000</h5>
			<div class="progress progress-sm mr-2">
			<div class="progress-bar bg-info" role="progressbar" style="width: '.$progress.'%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
			<br>
			<i>Expires: '.$package['date_expire'].'</i>
			<br>
			<span> <i class="fa fa-circle" style="color: #159f6d"></i> &nbsp;'.ucfirst($package['status']).'</span>
			<br>
		</div>
		';
}

} else
{
	//DISPLAY FORM
	echo '
	<div class="alert alert-danger">Sorry, you do not have any active package</div>
	';
}

?>

