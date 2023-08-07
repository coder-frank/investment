<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Unknown</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="./universal/custom/custom.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="container-fluid">
	<header class="header">
        <a href="#" class="logo">Unknown</a>
        <i class='bx bx-menu' id="menu-icon"></i>

        <nav class="nav">
            <a href="./index.html">Home</a>
            <a href="#about">About</a>
            <a href="./vendors.php" class="active">Vendor</a>
            <a href="./register.php">Register</a>
            

        </nav>
		<a href="./login.php" class="btn">Login</a>
    </header>
<br><br><br><br><br><br>
<section class="vendors">
	<br><br>
	<center><h1><b>Recharge Code Vendors</b></h1></center>
	<br><br>
	<ul>
		<?php include_once './inc/getVendors.php' ?>
		
	</ul>
</section>

	<footer class="footer">
		<div class="footer-item">
			<div class="ft-bx">
				<h3> Quick Link</h3>
				<a href="#"> <i class="fas fa-chevron-right"></i> Home</a>
				<a href="#"> <i class="fas fa-chevron-right"></i> About</a>
				<a href="#"> <i class="fas fa-chevron-right"></i> Register</a>
				<a href="#"> <i class="fas fa-chevron-right"></i>Vendors</a>
			</div>
			<div class="ft-bx">
				<h3> Social Media</h3>
				<a href="#"><i class="fab fa-telegram"></i>  Telegram</a>
				<a href="#"><i class="fab fa-twitter"></i>Twitter</a>
				<a href="#"><i class="fab fa-facebook"></i>Facebook</a>
			</div>
			
		</div>
		<div class="credit"> © Copyright <span>Unknown</span> | all rights reserved </div>
	</footer>
	
<script src="./universal/custom/index.js"></script>
<!--  typed js  -->
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>