<?php

require_once '../inc/core.php';
$user->id = $_SESSION['userId'];
if ($user->bankExits() == true)
{
	//DISPLAY BANK
	$user->getBank();
	echo '
		<br>
		<h5><b>Bank Name:</b> <span>'.$user->bankName.'</span></h5>
		<br>
		<h5><b>Account Name:</b> <span>'.$user->bankAccName.'</span></h5>
		<br>
		<h5><b>Account Number:</b> <span>'.$user->bankAccNum.'</span></h5>
	';

} else
{
	//DISPLAY FORM
	echo '
	<form class="user" method="post" action="../controllers/addBank.php">
		<div class="form-group">
			<input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Bank Name" name="bankName">
		</div>

		<div class="form-group">
			<input type="number" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Account Number" name="accNum">
		</div>

		<div class="form-group">
			<input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Account Name" name="accName">
		</div>
        
                <center><button type="submit" name="addBank" class="btn btn-primary">Add Bank</button></center>
	</form>
	';
}

?>

