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
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
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

                        <h3><b>Active Packages</b></h3>

                        <div class="task-holder">
                        <div class="task">
                            <div class="head text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <br>    
                            <h4><b>Task 1</b></h4>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Withdraw</button>
                            </div>
                            <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <br>
                            <i>Expires: 05/08/2023</i>
                            <br>
                            <span> <i class="fa fa-circle" style="color: #159f6d"></i> &nbsp;Active</span>
                        <br>
                        </div>

                        <div class="task">
                            <div class="head text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <br>    
                            <h4><b>Task 2</b></h4>
                                    <button class="btn btn-success">Withdraw</button>
                            </div>
                            <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <br>
                            <i>Expires: 07/08/2023</i>
                            <br>
                            <span> <i class="fa fa-circle" style="color: red"></i> &nbsp;Expired</span>
                        <br>
                        </div>


                        </div>



                    </div>

                </div>
                <!-- /.container-fluid -->


<?php
require_once '../universal/includes/external.php';
require_once '../universal/includes/footer.html';
?>