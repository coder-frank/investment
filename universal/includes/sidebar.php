<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon rotate-n-15">
	<i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">UNKNOWN</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="index.php">
	<i class="fas fa-fw fa-tachometer-alt"></i>
	<span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<li class="nav-item active">
    <a class="nav-link" href="recharge.php">
	<i class="fas fa-fw fa-wallet"></i>
	<span>Recharge</span></a>
</li>

<hr class="sidebar-divider">

<li class="nav-item active">
    <a class="nav-link" href="history.php">
	<i class="fas fa-fw fa-list"></i>
	<span>Histories</span></a>
</li>

<hr class="sidebar-divider">

<li class="nav-item active">
    <a class="nav-link" href="profile.php">
	<i class="fas fa-fw fa-user"></i>
	<span>Profile</span></a>
</li>

<hr class="sidebar-divider">

<li class="nav-item active">
    <a class="nav-link" href="ref.php">
	<i class="fas fa-fw fa-users"></i>
	<span>Referrals</span></a>
</li>

<hr class="sidebar-divider">

<li class="nav-item active">
    <a class="nav-link" href="support.php">
	<i class="fas fa-fw fa-question"></i>
	<span>Support</span></a>
</li>

<hr class="sidebar-divider">

<li class="nav-item active">
    <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
	<i class="fas fa-fw fa-power-off"></i>
	<span>Sign Out</span></a>
</li>
<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

	<!-- Sidebar Toggle (Topbar) -->
	<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
	    <i class="fa fa-bars"></i>
	</button>


	<!-- Topbar Navbar -->
	<ul class="navbar-nav ml-auto">


	    <div class="topbar-divider d-none d-sm-block"></div>

	    <!-- Nav Item - User Information -->
	    <li class="nav-item dropdown no-arrow">
		<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
		    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['name']; ?></span>
		    <img class="img-profile rounded-circle"
			src="../universal/img/undraw_profile.svg">
		</a>
		<!-- Dropdown - User Information -->
		<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
		    aria-labelledby="userDropdown">

		    <a class="dropdown-item" href="#">
			<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
			Settings
		    </a>
		    <div class="dropdown-divider"></div>
		    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
			<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
			Logout
		    </a>
		</div>
	    </li>

	</ul>

    </nav>
    <!-- End of Topbar -->
<!-- Begin Page Content -->
<div class="container-fluid">