<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <author name="Eric Korku Gbekor" referencing="Lumino Admin Template"></author>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Payment Voucher</title>
        <link rel="shortcut icon" type="image/x-icon" href="{{URL::asset('images.ico')}}">
        <link href="{{ URL::asset ('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{ URL:: asset('css/styles.css')}}" rel="stylesheet">
        
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
                    <a class="navbar-brand" href="{{url('/home')}}"><span>Pay</span>Flow</a>
                    <ul class="user-menu">
                        <li class="dropdown pull-right">

                    
                        </li>
                    </ul>
                </div>

            </div><!-- /.container-fluid -->
        </nav>

       

             <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('name')</h1>
                </div>
            </div><!--/.row--> 


            @yield('content')

    </body>

</html>

