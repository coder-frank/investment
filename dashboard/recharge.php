<?php 
require_once '../universal/includes/header.php';
require_once '../universal/includes/sidebar.php';
?>

<h2>Recharge</h2>
<br>
<form action="../controllers/recharge.php" method="post">

<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Enter Code" aria-label="Enter Code" aria-describedby="button-addon2" name="code">
  <button class="btn btn-primary" type="submit" name="recharge" id="button-addon2">Recharge</button>
</div>

</form>
<br>

<h3>Recharge Histories</h3>
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
        <?php include_once '../inc/getRechargeHistory.php'; ?>
        </tbody>
    </table>
</div>


<?php require_once '../universal/includes/footer.html'; ?>