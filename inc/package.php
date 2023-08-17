<?php

require_once '../inc/core.php';
$user->id = $_SESSION['userId'];
if ($user->packageExits() == true)
{
	$date = date("Y-m-d");
	$color = "#159f6d";
	$row = $user->getPackages();
	$count = 1;
	while ($package = $row->fetch(PDO::FETCH_ASSOC)) {
		// GET AND STRIP DATE (-)
		$exp = explode(" ", $package['date_expire']);
		$dateStarted =  explode(" ", $package['date_created']);

		// ASSIGN FIRST VALUE (DATE)
		$exp = $exp[0];
		$dateStarted = $dateStarted[0];

		$button = "";
		$status = $package['status'];
		$d_E = $exp;

		$today = date("Ymd");
		$dateStarted = str_replace('-', '', $dateStarted);
		$exp = str_replace('-', '', $exp);




		if ($exp > $dateStarted && $today >= $exp)
		{

			$color = "red";
			$status = "Expired";
			$button = '<a href="../controllers/withdrawPackage.php?pid='.$package['id'].'"><button class="btn btn-success">Withdraw</button></a>';
		} else {
			$last = $user->getLastClaimed($package['id']);
			if ($last != false) {
				// REMOVE - 
				$today = str_replace('-', '', date("Y-m-d"));
				$last = str_replace('-', '', $last);

				// CONVERT TO INTEGER
				$today = intval($today);
				$last = intval($last);

				
				if ($today > $last)
				{
					$button = '<a href="../controllers/claim.php?pid='.$package['id'].'"><button class="btn btn-primary">Claim</button></a>';
				}
			}
		}
		echo '
		<div class="task">
			<div class="head text-xs font-weight-bold text-primary text-uppercase mb-1">
			<br>    
			<h4><b>'.ucfirst($package['type']).' '.$count.' </b></h4>
				'.$button.'
			</div>
			<h5>Total Claimed: ₦'.number_format($user->getEarnings($package['id'])).'</h5>
			<div class="progress">
			<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
			<br>
			<i>Expires: '.$d_E.'</i>
			<br>
			<span> <i class="fa fa-circle" style="color: '.$color.'"></i> &nbsp;'.ucfirst($status).'</span>
			<br>
		</div>
		';
		$count++;
}

} else
{
	//DISPLAY FORM
	echo '
	<div class="alert alert-danger">Sorry, you do not have any active package</div>
	';
}

?>

