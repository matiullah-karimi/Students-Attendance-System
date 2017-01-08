<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Students Attendance Management System</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <script src="{{asset('bootstrap/js/jquery.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('/bootstrap/css/bootstrap.min.css')}}">

    <script type="text/javascript" src="{{asset('bootstrap/js/bootstrap-multiselect.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/datepicker.js')}}"></script>
    <link rel="stylesheet" href=" {{asset('bootstrap/css/bootstrap-multiselect.css')}}" type="text/css"/>

    @if(App::getLocale() == 'en')
        <link rel="stylesheet" href="{{asset('/css/custom.css')}}">
            @else
        <link rel="stylesheet" href="{{asset('/css/custom-rtl.css')}}">
    @endif

    <!-- jQuery 2.2.3 -->
    {{--<script src="{{asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>--}}
    <!-- Bootstrap 3.3.6 -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <!-- Theme style -->
    <link rel="stylesheet" href= "{{asset('dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href= {{asset('dist/css/skins/_all-skins.min.css')}}>
    <link rel="stylesheet" href= {{asset('css/datepicker.css')}}>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{asset('js/html5shiv.min.js')}}"></script>
    <script src="{{asset('respond.min.js')}}"></script>
    <![endif]-->
</head>
<!-- ADD THE CLASS sidedar-collapse TO HIDE THE SIDEBAR PRIOR TO LOADING THE SITE -->
<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{asset('images/'.Auth::user()->image)}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>S</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Attendance </b>System</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">

            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li id="language-li">
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle" id="lang-a" data-toggle="dropdown">@lang('language.language')
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{url('language/en')}}">Enlish</a></li>
                                <li><a href="{{url('language/pr')}}">دری</a></li>
                                <li><a href="{{url('language/pa')}}">پشتو</a></li>
                            </ul>
                        </div>
                    </li>


                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset('images/'.Auth::user()->image)}}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{Auth::user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->

                            <li class="user-header">
                                <img src="{{asset('images/'.Auth::user()->image)}}" class="img-circle" alt="User Image">
                                <p>
                                    {{Auth::user()->name}}
                                    <small>{{Auth::user()->email}}</small>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{url('users/profile/'.Auth::user()->id)}}" class="btn btn-default btn-flat fa fa-user"> @lang('language.profile')</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{url('/logout')}}" class="btn btn-default btn-flat fa fa-sign-out"> @lang('language.sign-out')</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar" id="gears"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('images/'.Auth::user()->image)}}" class="user-image" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{Auth::user()->name}}</p>

                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>

                <li class="treeview">
                    <a href="{{url('/home')}}">
                        <i class="fa fa-dashboard"></i> <span>{{trans('language.dashboard')}}</span>
                    </a>

                </li>

                @if(Auth::user()->role==1)

                <li>
                    <a href="{{url('/classes')}}">
                        <i class="fa fa-th"></i> <span>{{trans('language.classes')}}</span>
            <span class="pull-right-container">

            </span>
                    </a>
                </li>

                <li>
                    <a href="{{url('/users')}}">
                        <i class="fa fa-user"></i> <span>{{trans('language.teachers')}}</span>
            <span class="pull-right-container">

            </span>
                    </a>
                </li>


                <li>
                    <a href="{{url('/subjects')}}">
                        <i class="fa fa-book"></i> <span>{{trans('language.subjects')}}</span>
            <span class="pull-right-container">

            </span>
                    </a>
                </li>

                <li>
                    <a href="{{url('/students')}}">
                        <i class="fa fa-users"></i> <span>{{trans('language.students')}}</span>
            <span class="pull-right-container">

            </span>
                    </a>
                </li>
                @endif

                <li>
                    <a href="{{url('student/attendance')}}">
                        <i class="fa fa-eye"></i> <span>{{trans('language.attendance')}}</span>
            <span class="pull-right-container">

            </span>
                    </a>
                </li>

                <li>
                    <a href="{{url('/analytics')}}">
                        <i class="fa fa-eye"></i> <span>{{trans('language.analytics')}}</span>
            <span class="pull-right-container">

            </span>
                    </a>
                </li>
                </ul>

        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            @yield('header')

        </section>

        <!-- Main content -->
        <section class="content">

            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer hidden-print">
        <div id="footer-text"><strong>Copyright &copy; 2016 <a href="#">Matiullah Karimi</a>.</strong> All rights
            reserved.</div>

    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <!-- /.control-sidebar-menu -->
            </div>
            <!-- /.tab-pane -->
        </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- SlimScroll -->
<script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/app.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-89668545-1', 'auto');
    ga('send', 'pageview');

</script>
@yield('page_specific_scripts')
</body>
</html>