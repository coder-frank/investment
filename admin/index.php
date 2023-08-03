<?php
require_once './includes/header.php';
require_once './includes/sidebar.php';
?>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Users </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php include_once './includes/getTotalUsers.php'; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Invested Amount </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₦<?php include_once './includes/getPackages.php'; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Withdrawal </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₦<?php include_once './includes/getWithdrawal.php'; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-wallet fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Pending Withdrawal </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php include_once './includes/getPending.php'; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <?php
    if (isset($_SESSION['message']))
    {
     echo '<div class="alert alert-success">'.$_SESSION['message'].'</div>';
     unset($_SESSION['message']);
    }
    ?>

    <form action="./controllers/generate.php" method="post">

        <div class="input-group mb-3">
            <select name="type" class="form-control">
                <option value="0">Classic</option>
                <option value="1">Silver</option>
                <option value="2">Diamond</option>
            </select>
            <button class="btn btn-primary" type="submit" name="generate" id="button-addon2">Generate</button>
        </div>

    </form>


<br><br>
<h1><b>Users</b></h1>

<div class="table-responsive">
    <table class="table">
		<thead class="table-dark">
			<tr>
				<th scope="col">S/N</th>
				<th scope="col">Full Name</th>
				<th scope="col">Email</th>
				<th scope="col">Phone</th>
                <th scope="col">Total Earnings</th>
                <th scope="col">Bank Name</th>
                <th scope="col">Account Number</th>
                <th scope="col">Account Name</th>
                <th scope="col" colspan="3">Action</th>

			</tr>
		</thead>
		<tbody>
			<?php include_once './includes/getDetails.php'; ?>
		</tbody>
	</table>
</div>











<?php require_once './includes/footer.html'; ?>