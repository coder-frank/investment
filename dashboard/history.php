<?php 
require_once '../universal/includes/header.php';
require_once '../universal/includes/sidebar.php';
?>

<h1>History</h1>
<br>
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
			<tr>
				<th scope="row">1</th>
				<td>Recharge</td>
				<td>₦5000</td>
				<td>01/08/2023</td>
				<td class="alert-success">Success</td>
			</tr>
            <tr>
				<th scope="row">2</th>
				<td>Recharge</td>
				<td>₦3000</td>
				<td>04/08/2023</td>
				<td class="alert-danger">failed</td>
			</tr>
            <tr>
				<th scope="row">3</th>
				<td>Recharge</td>
				<td>₦2000</td>
				<td>05/08/2023</td>
				<td class="alert-primary">pending</td>
			</tr>
		</tbody>
	</table>
</div>


<?php require_once '../universal/includes/footer.html'; ?>