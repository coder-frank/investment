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
			$last = $user->getLastClaimed($package['id']);
			if ($last != false) {
				// Assuming you have a DateTime object, $dateTime, representing the date you want to check.
				$dateTime = new DateTime($last);

				// Get the current date in the "Y-m-d" format (without time)
				$currentDate = date("Y-m-d");

				// Format the DateTime object to get its date part in the "Y-m-d" format (without time)
				$dateTimeDate = $dateTime->format("Y-m-d");
				if ($dateTimeDate !== $currentDate)
				{
					$button = '<a href="../controllers/claim.php?pid='.$package['id'].'"><button class="btn btn-primary">Claim</button></a>';
				}
			}
		}
		echo '
		<div class="task">
			<div class="head text-xs font-weight-bold text-primary text-uppercase mb-1">
			<br>    
			<h4><b>'.ucfirst($package['type']).'</b></h4>
				'.$button.'
			</div>
			<h5>Total Claimed: ₦'.number_format($user->getEarnings($package['id'])).'</h5>
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

