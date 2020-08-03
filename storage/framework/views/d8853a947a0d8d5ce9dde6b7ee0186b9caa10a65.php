<!doctype html>
<html lang="en">

<head>
	<title>In-Time Delivery Service</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?php echo e(URL::to('/assets/vendor/bootstrap/css/bootstrap.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(URL::to('/assets/vendor/font-awesome/css/font-awesome.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(URL::to('/assets/vendor/linearicons/style.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(URL::to('/assets/vendor/chartist/css/chartist-custom.css')); ?>">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?php echo e(URL::to('assets/css/main.css')); ?>">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="<?php echo e(URL::to('assets/css/demo.css')); ?>">
	<!-- GOOGLE FONTS -->
	<!-- ICONS -->
	<!-- Latest compiled and minified CSS -->

	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">

</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="index.html" style="font-size: 20px;font-weight: bold;">In-Time</a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
			

				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span><?php echo e(Auth::user()->name); ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">

								<li><a  href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
						<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
						<!-- <li>
							<a class="update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
						</li> -->
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						
						<li><a href="<?php echo e(URL::to('parcel/create/')); ?>" class=""><i class="lnr lnr-gift"></i> <span>Product Register</span> </a></li>
						
						<li><a href="<?php echo e(URL::to('route/plan/')); ?>" class=""><i class="lnr lnr-map-marker"></i> <span>Route Entry</span> </a></li>
						<li><a href="<?php echo e(URL::to('route/list')); ?>" class=""><i class="lnr lnr-map"></i> <span>Route List</span> </a></li>
						<li><a href="<?php echo e(URL::to('multi/route/plan')); ?>" class=""><i class="lnr lnr-map"></i> <span>Multi Route List</span> </a></li>
						
						<li><a href="<?php echo e(URL::to('order/list')); ?>" class=""><span class="lnr lnr-list"></span>Order List</span> </a></li>
						<li><a href="<?php echo e(URL::to('order/create')); ?>" class=""><span class="lnr lnr-enter-down"></span>Order Create</span> </a></li>
						<li><a href="<?php echo e(URL::to('contact/issue/')); ?>" class=""><i class="lnr lnr-phone-handset"></i> <span>Contact Issue</span> </a></li>	
						<!-- <li><a href="<?php echo e(URL::to('make/order')); ?>" class=""><span class="lnr lnr-enter-down"></span>Order Create</span> </a></li> -->
						<li><a href="<?php echo e(URL::to('contact/issue/')); ?>" class=""><i class="lnr lnr-users"></i> <span>Account Head</span></a></li>	
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					
					<?php echo $__env->yieldContent('content'); ?>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="<?php echo e(URL::to('assets/vendor/jquery/jquery.min.js')); ?>"></script>
	<script src="<?php echo e(URL::to('assets/vendor/bootstrap/js/bootstrap.min.js')); ?>"></script>
	<script src="<?php echo e(URL::to('assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')); ?>"></script>
	<script src="<?php echo e(URL::to('assets/scripts/klorofil-common.js')); ?>"></script>

</body>

</html>
<?php /**PATH /home/thiri/yoonhanthar/intime-delivery/resources/views/layouts/tables.blade.php ENDPATH**/ ?>