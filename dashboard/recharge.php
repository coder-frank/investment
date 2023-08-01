<?php 
require_once '../universal/includes/header.php';
require_once '../universal/includes/sidebar.php';
?>

<h2>Recharge</h2>
<br>
<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Enter Code" aria-label="Enter Code" aria-describedby="button-addon2">
  <button class="btn btn-outline-secondary" type="button" id="button-addon2">Recharge</button>
</div>
<br>

<h3>Recharge Histories</h3>
<div class="table-responsive">
    <table class="table">
        <thead class="table-dark">
             <tr>
                <th scope="col">S/N</th>
                <th scope="col">Amount</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
             </tr>   
        </thead>
        <tr>
				<th scope="row">1</th>
				<td>₦4000</td>
				<td>01/07/2023</td>
				<td class="alert-success">Success</td>
			</tr>
                    <tr>
				<th scope="row">2</th>
				<td>₦1000</td>
				<td>03/07/2023</td>
				<td class="alert-danger">failed</td>
			</tr>

    </table>
</div>


<?php require_once '../universal/includes/footer.html'; ?>