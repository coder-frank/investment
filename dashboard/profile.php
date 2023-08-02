<?php 
require_once '../universal/includes/header.php';
require_once '../universal/includes/sidebar.php';
?>

<h3>Bank Details</h3>

<?php include_once '../inc/bank.php'; ?>

<br><hr>

<h3>Change Password</h3>

<form class="user" method="post" action="./controllers/login.php">
        <div class="form-group">
        	<input type="password" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Old Password" name="opass">
        </div>

	<div class="form-group">
        	<input type="password" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="New Password" name="npass">
        </div>

	<div class="form-group">
        	<input type="password" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Retype Password" name="rpass">
        </div>
        
                <center><button type="submit" name="saveBank" class="btn btn-primary">Change Password</button></center>
</form>

<?php require_once '../universal/includes/footer.html'; ?>