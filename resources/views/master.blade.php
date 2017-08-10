<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <author name="Eric Korku Gbekor" referencing="Lumino Admin Template"></author>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>PayFlow</title>
        <link rel="shortcut icon" type="image/x-icon" href="{{URL::asset('favicon.ico')}}">
        <link href="{{ URL::asset ('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{ URL:: asset('css/styles.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{ URL:: asset('css/bootstrap-select.min.css')}}" rel="stylesheet">
        
        <script type="text/javascript" src="{{URL:: asset('js/lumino.glyphs.js')}}"></script>

        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
        <style>
            
            .reveal-if-active {
                     opacity: 0;
                     max-height: 0;
                     overflow: hidden;
                    }

            input[id="other"]:checked ~ .reveal-if-active,
            input[type="checkbox"]:checked ~ .reveal-if-active {
            opacity: 1;
            max-height: 100px; 
            overflow: visible;
                }

                .reveal-if-active {
                            opacity: 0;
                            max-height: 0;
                            overflow: hidden;
                            transform: scale(0.8);
                            transition: 0.5s;
                        input[id="other"]:checked ~ &,
                        input[type="checkbox"]:checked ~ & {
                            opacity: 1;
                            max-height: 100px;
                            overflow: visible;
                            padding: 10px 20px;
                            transform: scale(1);
                         }
                    }
        </style>
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
                    <a class="navbar-brand" href="{{url('/home')}}"><span>Pay</span>Flow</a>
                    <ul class="user-menu">
                        <li class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> {{ Auth::user()->firstname }} {{Auth::user()->lastname}} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{url('/password/change')}}"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Change Password</a></li>
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
                    <!-- <input type="text" class="form-control" placeholder="Search"> -->
                </div>
            </form>
		
          
            @if (Auth::user()->is_creator=='yes')
            <ul class="nav menu">
                <li class=""><a href="{{url('/home')}}"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
                <li class="parent {{$nav_trans or '' }} ">
                    <a href="{{url('/transactions')}}">
                        <span class="glyphicon glyphicon-file"></span>Payment Voucher  <span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> 
                    </a>
                    <ul class="children collapse" id="sub-item-1">
                        <li>
                            <a class="" href="{{url('/addtransactions')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> New Voucher
                            </a>
                        </li>

                        <!--  <li>
                            <a class="" href="{{url('/incompletetrans')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Incomplete Vouchers
                            </a>
                        </li> -->

                        <li>
                            <a class="" href="{{url('/viewtransactions')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> View Vouchers
                            </a>
                        </li>

                        <li>
                            <a class="" href="{{url('/makePayment')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Processed Vouchers
                            </a>
                        </li>
                    </ul>
                </li>

                 <li class="parent  {{$nav_supplier or ''}}">
                <a href="{{url('/supplier')}}">
                        <svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg>Suppliers <span data-toggle="collapse" href="#sub-item-3"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> 
                    </a>
                    <ul class="children collapse" id="sub-item-3">
                        <li>
                            <a class="" href="{{url('/newsupplier')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> New Supplier
                            </a>
                        </li>
                    </ul>
                </li>
                <li class = "parent {{$nav_account or ''}}">
                    <a href="{{url('/account')}}">
                       <svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg>Chart of Accounts <span data-toggle="collapse" href="#sub-item-4"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> 
                    </a>
                    <ul class="children collapse" id="sub-item-4">
                        <li>
                            <a class="" href="{{url('/newaccount')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> New Account
                            </a>
                        </li>
                    </ul>
                </li>  

                <li class = "parent {{$nav_department or ''}}">

                    <a href="{{url('/department')}}">
                       <svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg>Departments <span data-toggle="collapse" href="#sub-item-5"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> 
                    </a>
                    <ul class="children collapse" id="sub-item-5">
                        <li>
                            <a class="" href="{{url('/newdepartment')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> New Department
                            </a>
                        </li>
                    </ul>
                </li>
                <li role="presentation" class="divider"></li>
                
            </ul>

            @elseif (Auth::user()->is_reviewer=='yes')
            <ul class="nav menu">
                <li class=""><a href="{{url('/home')}}"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
                <li cclass="parent {{$nav_trans or '' }} ">
                    <a href="{{url('/transactions')}}">
                        <span class="glyphicon glyphicon-file"></span>Payment Voucher  <span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> 
                    </a>
                    <ul class="children collapse" id="sub-item-1">

                        <li>
                            <a class="" href="{{url('/reviewTrans')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Review Vouchers
                            </a>
                        </li>

                        <li>
                            <a class="" href="{{url('/makePayment')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Processed Vouchers
                            </a>
                        </li>
                    </ul>
                </li>

                 <li class="parent  {{$nav_supplier or ''}}">
                <a href="{{url('/supplier')}}">
                        <svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg>Suppliers <span data-toggle="collapse" href="#sub-item-3"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> 
                    </a>
                    <ul class="children collapse" id="sub-item-3">
                        <li>
                            <a class="" href="{{url('/newsupplier')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> New Supplier
                            </a>
                        </li>
                    </ul>
                </li>
                <li class = "parent {{$nav_account or ''}}">
                    <a href="{{url('/account')}}">
                       <svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg>Chart of Accounts <span data-toggle="collapse" href="#sub-item-4"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> 
                    </a>
                    <ul class="children collapse" id="sub-item-4">
                        <li>
                            <a class="" href="{{url('/newaccount')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> New Account
                            </a>
                        </li>
                    </ul>
                </li>  

                <li class = "parent {{$nav_department or ''}}">

                    <a href="{{url('/department')}}">
                       <svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg>Departments <span data-toggle="collapse" href="#sub-item-5"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> 
                    </a>
                    <ul class="children collapse" id="sub-item-5">
                        <li>
                            <a class="" href="{{url('/newdepartment')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> New Department
                            </a>
                        </li>
                    </ul>
                </li>
                <li role="presentation" class="divider"></li>
                
            </ul>

            @elseif (Auth::user()->is_approver=='yes')
            <ul class="nav menu">
                <li class=""><a href="{{url('/home')}}"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
                <li class="parent {{$nav_trans or '' }} ">
                    <a href="{{url('/transactions')}}">
                        <span class="glyphicon glyphicon-file"></span>Payment Voucher  <span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> 
                    </a>
                    <ul class="children collapse" id="sub-item-1">
                        
                        <li>
                            <a class="" href="{{url('/approveTrans')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Approve Vouchers
                            </a>
                        </li>
                        <li>
                            <a class="" href="{{url('/makePayment')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Processed Vouchers
                            </a>
                        </li>
                    </ul>
                </li>

                 <li class="parent  {{$nav_supplier or ''}}">
                <a href="{{url('/supplier')}}">
                        <svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg>Suppliers <span data-toggle="collapse" href="#sub-item-3"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> 
                    </a>
                    <ul class="children collapse" id="sub-item-3">
                        <li>
                            <a class="" href="{{url('/newsupplier')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> New Supplier
                            </a>
                        </li>
                    </ul>
                </li>
                <li class = "parent {{$nav_account or ''}}">
                    <a href="{{url('/account')}}">
                       <svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg>Chart of Accounts <span data-toggle="collapse" href="#sub-item-4"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> 
                    </a>
                    <ul class="children collapse" id="sub-item-4">
                        <li>
                            <a class="" href="{{url('/newaccount')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> New Account
                            </a>
                        </li>
                    </ul>
                </li>  

                <li class = "parent {{$nav_department or ''}}">

                    <a href="{{url('/department')}}">
                       <svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg>Departments <span data-toggle="collapse" href="#sub-item-5"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> 
                    </a>
                    <ul class="children collapse" id="sub-item-5">
                        <li>
                            <a class="" href="{{url('/newdepartment')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> New Department
                            </a>
                        </li>
                    </ul>
                </li>
                <li role="presentation" class="divider"></li>
              
            </ul>

            @else
            <ul class="nav menu">
                <li class=""><a href="{{url('/home')}}"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
                <li class="parent {{$nav_trans or '' }} ">
                    <a href="{{url('/transactions')}}">
                        <span class="glyphicon glyphicon-file"></span>Payment Voucher  <span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> 
                    </a>
                    <ul class="children collapse" id="sub-item-1">
                        <li>
                            <a class="" href="{{url('/addtransactions')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> New Voucher
                            </a>
                        </li>

                         <!-- <li>
                            <a class="" href="{{url('/incompletetrans')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Incomplete Vouchers
                            </a>
                        </li> -->

                        <li>
                            <a class="" href="{{url('/viewtransactions')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> View Vouchers
                            </a>
                        </li>

                        <li>
                            <a class="" href="{{url('/reviewTrans')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Review Vouchers
                            </a>
                        </li>

                        <li>
                            <a class="" href="{{url('/approveTrans')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Approve Vouchers
                            </a>
                        </li>
                        <li>
                            <a class="" href="{{url('/makePayment')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Processed Vouchers
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="parent {{$nav_user or ''}}">
                <a href="{{url('/user')}}">
                        <span class="glyphicon glyphicon-user"></span>Users <span data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> 
                    </a>
                    <ul class="children collapse" id="sub-item-2">
                        <li>
                            <a class="" href="{{url('/newuser')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> New User
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="parent  {{$nav_supplier or ''}}">
                <a href="{{url('/supplier')}}">
                        <svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg>Suppliers <span data-toggle="collapse" href="#sub-item-3"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> 
                    </a>
                    <ul class="children collapse" id="sub-item-3">
                        <li>
                            <a class="" href="{{url('/newsupplier')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> New Supplier
                            </a>
                        </li>
                    </ul>
                </li>
                <li class = "parent {{$nav_account or ''}}">
                    <a href="{{url('/account')}}">
                       <svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg>Chart of Accounts <span data-toggle="collapse" href="#sub-item-4"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> 
                    </a>
                    <ul class="children collapse" id="sub-item-4">
                        <li>
                            <a class="" href="{{url('/newaccount')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> New Account
                            </a>
                        </li>
                    </ul>
                </li>  

                <li class = "parent {{$nav_department or ''}}">

                    <a href="{{url('/department')}}">
                       <svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg>Departments <span data-toggle="collapse" href="#sub-item-5"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> 
                    </a>
                    <ul class="children collapse" id="sub-item-5">
                        <li>
                            <a class="" href="{{url('/newdepartment')}}">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> New Department
                            </a>
                        </li>
                    </ul>
                </li>
                <li role="presentation" class="divider"></li>
            </ul>
            @endif

        </div><!--/.sidebar-->

        <!--/.header icons-->    
        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">           
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                    @yield('icon')
                </ol>
            </div><!--/.row-->

           <!--  <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('name')</h1>
                </div>
            </div>--><!--/.row--> 


            @yield('content')

    </body>

</html>

