<?php 
require_once '../universal/includes/header.php';
require_once '../universal/includes/sidebar.php';
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
                                                Earnings </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php include_once '../inc/getEarning.php' ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
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
                                                Bonus </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php include_once '../inc/getRefEarning.php' ?></div>
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
                                                E-Wallet </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php include_once '../inc/wallet.php' ?></div>
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
                                                Refferals </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php include_once '../inc/getRefCount.php' ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
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
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" readonly value="Referral Code: <?php include_once '../inc/getRefCode.php' ?>" aria-label="Referral Code" aria-describedby="button-addon2">
                            <button class="btn btn-primary" type="button" id="button-addon2">Copy</button>
                            <br>
                        </div>
                        <br><br>
                        <div class="task-holder">
                            <?php include_once '../inc/package.php'; ?>
                        </div>



                    </div>

                </div>
                <!-- /.container-fluid 

<div class="alert alert-danger">Error</div>-->
<?php
require_once '../universal/includes/external.php';
require_once '../universal/includes/footer.html';
?>