
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
<title>Payment Voucher</title>

<link href="{{ URL::asset ('css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ URL::asset ('css/datepicker3.css')}}" rel="stylesheet">
<link href="{{ URL:: asset('css/styles.css')}}" rel="stylesheet">
<!--<link href="{{URL::asset('jQuery-Popup-Msgbox/themes/bootstrap/img')}}" rel="stylesheet">-->
<link href="{{URL::asset('jQuery-Popup-Msgbox/themes/bootstrap/css/jquery.msgbox.css')}}" rel="stylesheet">
<!--Icons-->
<script type="text/javascript" src="{{URL:: asset('js/lumino.glyphs.js')}}"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>Payment Voucher</span>Admin</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> {{ Auth::user()->firstname }} {{Auth::user()->lastname}} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
							<li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
							<li><a href="{{ url('/logout') }}"onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" ><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a>
                                                        
                                                     <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                                        </li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
			<li class="active"><a href="/"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
                        <li class="parent ">
				<a href="#">
					Payment Voucher  <span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> 
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li>
						<a class="" href="transactions">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> View Vouchers
						</a>
					</li>
					<li>
						<a class="" href="addtransactions">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> New Voucher
						</a>
					</li>
					<li>
						<a class="" href="#">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 3
						</a>
					</li>
				</ul>
			</li>
			
			<li><a href="user"><span class="glyphicon glyphicon-user"></span>Manage Users</a></li>
			<li><a href="supplier"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg>Suppliers</a></li>
			<li><a href="account"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg>Chart of Accounts</a></li>
			<li><a href="panels.html"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Alerts &amp; Panels</a></li>
			<li><a href="icons.html"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> Reports</a></li>
			
			<li role="presentation" class="divider"></li>
			<li><a href="login"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Login Page</a></li>
		</ul>

	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="/"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Icons</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">@yield('name')</h1>
			</div>
		</div><!--/.row-->
		
		
@yield('content')
	
</body>

</html>

