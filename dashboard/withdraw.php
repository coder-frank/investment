<?php
require_once '../universal/includes/header.php';
require_once '../universal/includes/sidebar.php';
?>

<h3>Withdrawal</h3>
<br><br>

<form class="user" method="post" action="../controllers/withdraw.php">
	<select class="form-select form-control" required name="type" aria-label="Default select example">
		<option disabled>Withdrawal Type</option>
		<option value="0">E-Wallet</option>
		<option value="1">Referral Bonus</option>
	</select>

	<br>
	<div class="form-group">
		<input type="number" class="form-control form-control-user" id="exampleInputEmail" placeholder="Withdrawal Amount" required name="amount">
	</div>
	<button type="submit" name="withdraw" class="btn btn-primary btn-user btn-block">
		Withdraw
	</button>
</form>

<br><br>

<div class="table-responsive">
    <table class="table">
        <thead class="table-dark">
             <tr>
                <th scope="col">S/N</th>
                <th scope="col">Type</th>
                <th scope="col">Amount</th>
                <th scope="col">Date</th>
		<th scope="col">Status</th>
             </tr>   
        </thead>
        <tbody>
        <?php include_once '../inc/getWithdrawal.php'; ?>
        </tbody>
    </table>
</div>

<?php require_once '../universal/includes/footer.html'; ?>