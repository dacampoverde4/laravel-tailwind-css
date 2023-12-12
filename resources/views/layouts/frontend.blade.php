<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <title>AVDOPT</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/font-awesome/css/font-awesome.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bubblegum+Sans|Delius" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/isotope.pkgd.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('frontend/js/custom.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/notify.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/common.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'url' => url('/'),
        ]); ?>
    </script>
    @yield('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
    <!-- BEGIN PAGE LEVEL STYLES -->
@yield('page_level_styles')
<!-- END PAGE LEVEL STYLES -->
</head>
<body>
<!-- Start Top Header -->
<header class="bgred">
    <div class="tophead main_container">
        <div class="col-md-12 col-sm-12">
            <div class="col-md-6 col-sm-4 col-xs-4">
                <img src="{{ asset('frontend/images/mail.png') }}" alt="mail" title="mail">
                <span>info@avdopt.com</span>
            </div>
            <div class="col-md-6 col-sm-8 col-xs-8">

                <ul>
                    @if (Auth::check())
                        <li><a href="{{route('admin.dashboard')}}"><img src="{{ asset('frontend/images/login.png') }}"
                                                                        alt="account" title="account">My Account</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li><a href="{{route('register')}}"><img src="{{ asset('frontend/images/register.png') }}"
                                                                 alt="register" title="register">Register</a></li>
                        <li><a href="{{route('login')}}"><img src="{{ asset('frontend/images/login.png') }}" alt="login"
                                                              title="login">Login</a></li>
                    @endif
                </ul>
                <ul>
                    <li><a href="#"><img src="{{ asset('frontend/images/facebook.png') }}" alt="facebook"
                                         title="facebook"></a></li>
                    <li><a href="#"><img src="{{ asset('frontend/images/twitter.png') }}" alt="facebook"
                                         title="facebook"></a></li>
                    <li><a href="#"><img src="{{ asset('frontend/images/instagram.png') }}" alt="facebook"
                                         title="facebook"></a></li>
                    <li><a href="#"><img src="{{ asset('frontend/images/in.png') }}" alt="facebook"
                                         title="facebook"></a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
<!-- End Top Header -->

<!-- Start menu header -->
<div class="menu_header bgblack">
    <div class="main_container row">
        <div class="col-md-12 col-sm-12">
            <div class="col-md-4 col-sm-3 col-xs-8">
                <a href="{{url('/')}}"><img src="{{ asset('frontend/images/logo.png') }}" alt="mail" title="mail"></a>
            </div>
            <div class="col-md-8 col-sm-9 col-xs-4">
                <nav class="navbar navbar-default">
                    <div class="container-fluid padding0">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse padding0" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="active"><a href="{{url('/')}}">HOME <span class="sr-only"></span></a></li>
                                <li><a href="{{url('/browse')}}">BROWSE</a></li>
                                <li><a href="{{url('/jobs')}}">JOBS</a></li>
                                <li><a href="#">HOW IT WORKS</a>
                                </li>
                                <li><a href="#">CONTACT US</a></li>
                                <li><a href="{{ url('/events') }}">EVENTS</a></li>
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    </div>
                    <!-- /.container-fluid -->
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- End menu header -->

@yield('content')

<!-- Start Icons Section -->
<div class="subscribe_section fullwidth">
    <div class="main_container row">
        <div class="col-md-12 col-sm-12">
            <div class="col-md-9 col-sm-9 col-xs-12">
                <form method="post" id="newsletterform" action="{{ route('newsletter') }}">
                    @csrf
                    <h3>Want to Hear More Story, Subscribe For Our Newsletter</h3>
                    <input type="text" name="email" placeholder="Enter Your Mail" class="subcribe_input">
                    <a href="javascript:void(0)" id="newsletter_button" type="submit"><img
                                src="{{ asset('frontend/images/double_arrow.png') }}" alt="Arrow"></a>
                </form>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="child_portion">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Icons Section -->

<!-- Start Icons Section -->
<div class="footer bgred fullwidth">
    <div class="main_container row">
        <div class="col-md-12 col-sm-12">
            <div class="col-md-6 col-sm-6 col-xs-7">
                <h6>Copyright © 2018 adoption All rights reserved. </h6>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-5">
                <ul>
                    <li><a href="#"><img src="{{ asset('frontend/images/facebook.png') }}" alt="facebook"
                                         title="facebook"></a></li>
                    <li><a href="#"><img src="{{ asset('frontend/images/twitter.png') }}" alt="facebook"
                                         title="facebook"></a></li>
                    <li><a href="#"><img src="{{ asset('frontend/images/instagram.png') }}" alt="facebook"
                                         title="facebook"></a></li>
                    <li><a href="#"><img src="{{ asset('frontend/images/in.png') }}" alt="facebook"
                                         title="facebook"></a></li>

                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Icons Section -->

@yield('scripts')
<!-- BEGIN PAGE LEVEL SCRIPTS -->
@yield('page_level_scripts')
<!-- END PAGE LEVEL SCRIPTS -->
</body>
</html>
