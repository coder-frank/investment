<?php
require_once './includes/header.php';
require_once './includes/sidebar.php';
?>

<?php
    if (isset($_SESSION['message']))
    {
     echo '<div class="alert alert-success">'.$_SESSION['message'].'</div>';
     unset($_SESSION['message']);
    }
?>

<div class="table-responsive">
    <table class="table">
		<thead class="table-dark">
			<tr>
				<th scope="col">S/N</th>
				<th scope="col">Type</th>
				<th scope="col">Amount</th>
				<th scope="col">Date</th>
				<th scope="col">Bank Name</th>
				<th scope="col">Account Number</th>
				<th scope="col">Account Name</th>
				<th scope="col" colspan="2">Action</th>

			</tr>
		</thead>
		<tbody>
			<?php include_once './includes/getWithdraw.php'; ?>
		</tbody>
	</table>
</div>


<?php require_once './includes/footer.html'; ?>