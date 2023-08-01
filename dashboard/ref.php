<?php 
require_once '../universal/includes/header.php';
require_once '../universal/includes/sidebar.php';
?>

<h1>Referrals</h1>
<br>
<div class="input-group mb-3">
  <input type="text" readonly class="form-control" placeholder="155767" aria-describedby="button-addon2">
  <button class="btn btn-primary" type="button" id="button-addon2">Copy</button>
</div>
<br>
<div class="table-responsive">
	<table class="table">
		<thead class="table-dark">
			<tr>
				<th scope="col">S/N</th>
				<th scope="col">Referral Name</th>
				<th scope="col">Package</th>
				<th scope="col">Date</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th scope="row">1</th>
				<td>John Doe</td>
				<td>Silver</td>
				<td>01/08/2023</td>
			</tr>
            		<tr>
				<th scope="row">2</th>
				<td>Mary Jean</td>
				<td>Gold</td>
				<td>04/08/2023</td>
			</tr>
           		<tr>
				<th scope="row">3</th>
				<td>James Doe</td>
				<td>Premium</td>
				<td>05/08/2023</td>
			</tr>
		</tbody>
	</table>
</div>


<?php require_once '../universal/includes/footer.html'; ?>