<?php 
require_once '../universal/includes/header.php';
require_once '../universal/includes/sidebar.php';
?>

<h1><b>History</b></h1>
<span><i>Top 10 recent history</i></span>
<br><br>
<div class="table-responsive">
	<table class="table">
		<thead class="table-dark">
			<tr>
				<th scope="col">S/N</th>
				<th scope="col">Type</th>
				<th scope="col">Package / Amount</th>
				<th scope="col">Date</th>
			</tr>
		</thead>
		<tbody>
			<?php include_once '../inc/getHistory.php'; ?>
		</tbody>
	</table>
</div>


<?php require_once '../universal/includes/footer.html'; ?>