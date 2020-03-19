<!doctype html>
<html lang="en">

<head>
	<title>In-Time Delivery</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{URL::to('/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{URL::to('/assets/vendor/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{URL::to('/assets/vendor/linearicons/style.css')}}">
	<link rel="stylesheet" href="{{URL::to('/assets/vendor/chartist/css/chartist-custom.css')}}">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{URL::to('assets/css/main.css')}}">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{URL::to('assets/css/demo.css')}}">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{URL::to('assets/img/apple-icon.png')}}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{URL::to('assets/img/favicon.png')}}">
	<!-- Latest compiled and minified CSS -->

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
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span>{{Auth::guard('admin')->user()->name}}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">

								<li><a  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
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
		@if(Auth::guard('admin')->user()->role==0)
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="{{URL::to('admin/dashboard')}}" class=""><i class="fa fa-tachometer" aria-hidden="true"></i>
<span>Dashboard</span> </a></li>
						<li>
						<li><a href="{{URL::to('admin/map/overview/')}}" class=""><i class="lnr lnr-location"></i> <span>Postman Location</span> </a></li>
					<!-- 	<li>
							<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-cart"></i> <span>Order</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse ">
								<ul class="nav">
									<li><a href="{{URL::to('admin/order/list')}}" class="">Order List</a></li>
									<li><a href="{{URL::to('admin/order/verified')}}" class="">Order Verfied</a></li>
									<li><a href="{{URL::to('admin/order/reject')}}" class="">Order Reject</a></li>
									
								</ul>
							</div>
						</li> -->
						<li>
							<a href="#subPages1" data-toggle="collapse" class="collapsed"><i class="lnr lnr-users"></i> <span>Postman</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages1" class="collapse ">
								<ul class="nav">
									<li><a href="{{URL::to('admin/postman/index')}}" class="">Postman List</a></li>
									<li><a href="{{URL::to('admin/postman/create')}}" class="">Postman Create</a></li>
									<li><a href="{{URL::to('admin/route/assign')}}" class="">Assign Postman</a></li>
									

									
								</ul>
							</div>
						</li>
					
							<li>
							<a href="#subPages2" data-toggle="collapse" class="collapsed"><i class="lnr lnr-store"></i> <span>Stock</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages2" class="collapse ">
								<ul class="nav">
									<li><a href="{{URL::to('admin/stock/ledger')}}" class="">Stock Ledger</a></li>
									<li><a href="{{URL::to('admin/stock/list')}}" class="">Stock Balance</a></li>
									<li><a href="{{URL::to('admin/stock/in')}}" class="">Stock In</a></li>
									<li><a href="{{URL::to('admin/stock/out')}}" class="">Stock Out</a></li>
									<li><a href="{{URL::to('admin/stock/return')}}" class="">Stock return</a></li>

									
								</ul>
							</div>
						</li>

							<li>
							<a href="#subPages3" data-toggle="collapse" class="collapsed"><i class="lnr lnr-map"></i> <span>Route</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages3" class="collapse ">
								<ul class="nav">
									<li><a href="{{URL::to('admin/route/list/request')}}" class="">Request Route List</a></li>
									<li><a href="{{URL::to('admin/route/list')}}" class="">Verify Route List</a></li>
									<!-- <li><a href="{{URL::to('admin/route/assigned')}}" class="">Route List (Assigned)</a></li> -->
								</ul>
							</div>
						</li>

			<!-- 			<li>
							<a href="#subPages4" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Account Ledger </span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages4" class="collapse ">
								<ul class="nav">
									 <li><a href="{{URL::to('admin/ledger/list')}}" class="">Ledger List</a></li>
								<li><a href="{{URL::to('admin/ledger/settlement')}}" class="">Settlment</a></li> 								
								</ul>
							</div>
						</li> -->
						<li><a href="{{URL::to('admin/parcel/drop/')}}" class=""><i class="lnr lnr-download"></i> <span>Product Drop</span> </a></li>
							<li>
							<a href="#subPages12" data-toggle="collapse" class="collapsed"><i class="lnr lnr-store"></i> <span>Warehouse</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages12" class="collapse ">
								<ul class="nav">
									
									<li><a href="{{URL::to('warehouse/stock/pay')}}" class="">Warehouse Outgoing</a></li>
									<li><a href="{{URL::to('warehouse/stock/receive')}}" class="">Warehouse Received</a></li>

									
								</ul>
							</div>
						</li>
						<li>
							<a href="#issue" data-toggle="collapse" class="collapsed"><i class="lnr lnr-phone-handset"></i> <span>Contact Issue</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="issue" class="collapse ">
								<ul class="nav">
									<li><a href="{{URL::to('admin/contact/issue')}}" class="">Issue</a></li>
									<li><a href="{{URL::to('admin/issue/create')}}" class="">Issue Create</a></li>
									<!-- <li><a href="{{URL::to('admin/route/assigned')}}" class="">Route List (Assigned)</a></li> -->
								</ul>
							</div>
						</li>
						<li>
							<a href="#high" data-toggle="collapse" class="collapsed"><i class="lnr lnr-train"></i> <span>High Way Drop</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="high" class="collapse ">
								<ul class="nav">
									<li><a href="{{URL::to('admin/high/way/drop')}}" class="">Drop List</a></li>
									<li><a href="{{URL::to('admin/high/way/list')}}" class="">Verify List</a></li>
									<!-- <li><a href="{{URL::to('admin/route/assigned')}}" class="">Route List (Assigned)</a></li> -->
								</ul>
							</div>
						</li>
						<li><a href="{{URL::to('admin/foc/list/')}}" class=""><i class="lnr lnr-bookmark"></i> <span>F.O.C List</span> </a></li>
					</ul>
					<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
					</ul>
				</nav>
			</div>
		</div>
				</nav>
			</div>
		</div>
		@else
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						

					
							<li>
							<a href="#subPages2" data-toggle="collapse" class="collapsed"><i class="lnr lnr-chart-bars"></i> <span>Account</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages2" class="collapse ">
								<ul class="nav">
									<li><a href="{{URL::to('account/income')}}" class="">Income</a></li>
									<li><a href="{{URL::to('account/expense')}}" class="">Expense</a></li>
									<li><a href="{{URL::to('account/report')}}">Account Balance</a></li>
								</ul>
							</div>
						</li>	
						
						<li>
							<a href="#subPages21" data-toggle="collapse" class="collapsed"><i class="lnr lnr-users"></i> <span>Office Staff</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages21" class="collapse ">
								<ul class="nav">
									<li><a href="{{URL::to('admin/staff/index')}}" class="">Staff List</a></li>
									<li><a href="{{URL::to('admin/staff/create')}}" class="">Staff Create</a></li>

									
								</ul>
							</div>
						</li>	
						<!-- <li><a href="{{URL::to('admin/online/shop/')}}" class=""><i class="lnr lnr-store"></i> <span>Online Shop</span> </a></li> -->
						<!-- <li>
							<a href="#subPages211" data-toggle="collapse" class="collapsed"><i class="lnr lnr-calendar-full"></i> <span>Daily Usage</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages211" class="collapse ">
								<ul class="nav">
									<li><a href="{{URL::to('admin/purchase/create/')}}" class="">Entry</a></li>
									<li><a href="{{URL::to('admin/purchase/list')}}" class="">List</a></li>

									
								</ul>
							</div>
						</li>	 -->
					</ul>
				</nav>
			</div>
		</div>
		@endif
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					
					@yield('content')
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">Created By Yoon Han Thar Private Co.Ltd,</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="{{URL::to('assets/vendor/jquery/jquery.min.js')}}"></script>
	<script src="{{URL::to('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{URL::to('assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{URL::to('assets/scripts/klorofil-common.js')}}"></script>

</body>

</html>
