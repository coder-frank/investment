<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Unknown - Register</title>

    <!-- Custom fonts for this template-->
    <link href="./universal/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="./universal/css/sb-admin-2.min.css" rel="stylesheet">


</head>

<body class="bg-gradient-dark">

    <nav class="navbar fixed-top navbar-expand-lg bg-light" data-bs-theme="light">
		<div class="container-fluid">
		<a class="navbar-brand" href="#">
			<!--<img src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top"> -->
				Unknown
		</a>
		  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNav">
		    <ul class="navbar-nav">
		      <li class="nav-item">
			<a class="nav-link active" aria-current="page" href="./">Home</a>
		      </li>
		      <li class="nav-item">
			<a class="nav-link" href="./vendors.html">Vendors</a>
		      </li>
		      <li class="nav-item">
			<a class="nav-link" href="./register.php">Register</a>
		      </li>
		      <li class="nav-item">
			<a class="nav-link" href="./login.php">Login</a>
		      </li>
		      
		    </ul>
		  </div>
		</div>
	      </nav>
<br><br>
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <?php
                            session_start();
                            if (isset($_SESSION['message']))
                            {
                            echo '<div class="alert alert-success">'.$_SESSION['message'].'</div>';
                            unset($_SESSION['message']);
                            }
                        ?>
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="post" action="./controllers/register.php">
                                <select class="form-select form-control" required name="type" aria-label="Default select example">
                                    <option disabled>Account Type</option>
                                    <option value="classic">Classic - ₦2500</option>
                                    <option value="silver">Silver - ₦4000</option>
                                    <option value="diamond">Diamond - ₦10,000</option>
                                </select>

                                <br>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="First Name" required name="fname">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Last Name" required name="lname">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address" required name="email">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Phone Number" required name="phone">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Referral Code (Optional)" name="code">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" required placeholder="Password" name="password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" required placeholder="Repeat Password" name="rpassword">
                                    </div>
                                </div>
                                <button type="submit" name="register" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                            </form>
                            <hr>
                            <!--
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div> -->
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="./admin/vendor/jquery/jquery.min.js"></script>
    <script src="./admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="./admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
</body>

</html>