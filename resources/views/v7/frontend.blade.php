<!DOCTYPE html>
<!--
   This is a starter template page. Use this page to start your new project from
   scratch. This page gets rid of all links and provides the needed markup only.
   -->
<html lang="en">
   <head>
      <title>Avdopt</title>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="{{ asset('frontend/font-awesome/css/font-awesome.min.css') }}">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Bubblegum+Sans|Delius" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}">
      <link href="{{ asset('frontendnew/css/bootstrap.css') }}" rel="stylesheet">
      <!-- Loading Template CSS -->
      <link href="{{ asset('frontendnew/css/style.css')}}" rel="stylesheet">
      <link href="{{ asset('frontendnew/css/animate.css')}}" rel="stylesheet">
      <link href="{{ asset('frontendnew/css/style-magnific-popup.css')}}" rel="stylesheet">
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
      <!-- Awsome Fonts -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="{{ asset('frontendnew/css/pe-icon-7-stroke.css')}}">
      <!-- Optional - Adds useful class to manipulate icon font display -->
      <link rel="stylesheet" href="{{ asset('frontendnew/css/helper.css')}}">
      <link rel="stylesheet" href="{{ asset('frontendnew/css/owl.carousel.min.css')}}">
      <link rel="stylesheet" href="{{ asset('frontendnew/css/owl.theme.default.min.css')}}">
      <!-- Font Favicon -->
      <link rel="shortcut icon" href="{{ asset('frontendnew/images/favicon.ico')}}">
      <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
      <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <![endif]-->

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
     
      <script src="{{ asset('frontendnew/js/jquery-1.11.3.min.js')}}"></script>
      <script src="{{ asset('frontendnew/js/bootstrap.js')}}"></script>
      <script src="{{ asset('frontendnew/js/owl.carousel.min.js')}}"></script>
      <script src="{{ asset('frontendnew/js/jquery.scrollTo-min.js')}}"></script>
      <script src="{{ asset('frontendnew/js/jquery.magnific-popup.min.js')}}"></script>
      <script src="{{ asset('frontendnew/js/jquery.nav.js')}}"></script>
      <script src="{{ asset('frontendnew/js/wow.js')}}"></script>
      <script src="{{ asset('frontendnew/js/jquery.vegas.js')}}"></script>
      <script src="{{ asset('frontendnew/js/plugins.js')}}"></script>
      <script src="{{ asset('frontendnew/js/custom.js')}}"></script>
      <script src="{{ asset('js/common.js') }}" type="text/javascript"></script>
      <script>
         window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'url' => url('/'),
            ]); ?>

          $(window).on('scroll', function() {
              if($(".navbar-fixed-top").hasClass("opaque")){
                // $("#headerlogo").attr("src", "https://localhost/avdopt/public/frontend/images/logo_black.png");
                $("#headerlogo").attr("src", "{{ asset('frontend/images/logo_black.png') }}");
              }else{
                // $("#headerlogo").attr("src", "https://localhost/avdopt/public/frontend/images/logo_white.png")
                $("#headerlogo").attr("src", "{{ asset('frontend/images/logo_white.png') }}");
              }
          });

          $(document).ready(function(){
            $("#togglenav").click(function(){
              $(".collapse").slideToggle();
            });

            if(($(window).width() < 991) && ($(window).width() >= 768)){
              if( $('#bs-example-navbar-collapse-1').hasClass("collapse")){
                $('#bs-example-navbar-collapse-1').removeClass("collapse");
              }
              $("#togglenav").click(function(){
                $("#bs-example-navbar-collapse-1").slideToggle();

              });
            }
          })

      </script>
      @yield('head')
      <link rel="stylesheet" type="text/css" href="{{ asset('frontendnew/css/style.css') }}">
      <!--<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">-->
      <!-- BEGIN PAGE LEVEL STYLES -->
      @yield('page_level_styles')
      <!-- END PAGE LEVEL STYLES -->
      <style>
        html, body {
          max-width: 100%;
          overflow-x: hidden;
        }
        .footer_sec::after{
          display: none !important;
        }
        .copyrighttxt{
          border-bottom: 2px solid #fff;
        }
        .form_sec input[type="text"], .form_sec input[type="password"] {
          width: 100%!important;
          display: inline-block !important;
          height: 24px !important;
          padding: 4px 7px;
        }
        .nopadr{
          padding-right: 0px;
        }

        .navbar-toggle {
          margin-top: 4px;
        }
        .form_sec input {
          width: auto!important;
          display: inline-block !important;
          height: 24px !important;
          padding: 4px 7px;
        }

        .top_header {
          min-height: 80px;
        }
        .top_header.log_sec {
          height: 75px;
          padding-top: 20px;
        }
        .top_header.log_sec .form_sec {
          text-align: right;
          width: 100%;
          margin-top: 6px;
        }
        .top_header {
          background: #3b5998;
          padding-top: 20px!important;
          padding-right: 0 !important;
        }
        .section-gradient {
          background: #3aa595 !important;
          background: -webkit-linear-gradient(135deg, #46c6b3 0%, #3aa595 100%);
          background: -o-linear-gradient(bottom right, #6B02FF, #985BEF);
          background: -moz-linear-gradient(bottom right, #008aff, #1ad2fd);
          background: linear-gradient(to 135deg, #46c6b3 0%, #3aa595 100%);
          padding: 30px 0;
        }
        a.btn.reg_btn {
          background: transparent;
          border: 1px solid #fff;
          border-radius: 5px 5px;
          padding: 0px 9px!important;
          margin-left: 10px;
          margin-right: 15px;
          font-family: 'Roboto', sans-serif;
          color: #fff;
        }
        .form_sec form {
          margin: 0;
        }
         a.btn.btn-link {
         color: #fff;
         font-size: 11px;
         }
         .rem_sec {
         color: #fff;
         font-size: 11px;
         }
         .navbar {
         padding: 0!important;
         margin: 0!important;
         }
         div#bs-example-navbar-collapse-1 {
         margin-top: 0;
         }
         ul.myfun_list {
         padding: 14px;
         }
         .form_sec input {
         width: auto!important;
         display: inline-block !important;
         }
         .header {
         padding: 0 !important;
         height: auto !important;
         }
         .footer_sec ul {
         border-left: 2px solid #ffe5e5;
         }
         .footer_sec ul li a {
         color: #fff;
         font-weight: 400;
         padding-left: 1rem;
         }
         .footer_sec {
         background: #272727;
         padding: 15px 0;
         }
         .foot_dv img {
         width: 100%;
         max-width: 100px;
         }
         .footer_sec::after {
         border-top: 2px solid #fff;
         display: block;
         height: 1px;
         content: " ";
         width: 86%;
         position: absolute;
         left: 91px;
         }
         .foot_dv p {
         color: #fff;
         text-align: left;
         margin-top: 10px;
         padding-left: 0;
         }
         .footer_sec ul {
         border-left: 1px solid #ffe5e5;
         height: 124px;
         }
         .footer_sec ul li a {
         color: #fff;
         font-weight: 400;
         padding-left: 1rem;
         font-size: 16px;
         }
         /*---- Header ----*/
         .form_sec input {
         width: 20%;
         display: inline-block;
         }
         a.discover-btn {
         padding: 1px 20px!important;
         }
         .form_sec input {
         width: 10%;
         display: inline-block;
         }
        .form_sec {
          text-align: right;
        }
        button.btnpad.btnred.border0.sb_btn {
           background: linear-gradient(135deg, #6B02FF 0%, #985BEF 100%);
           border-radius: 5px 5px;
           padding: 2px 11px;
           margin-left: 3px;
           margin-right: 3px;
           font-family: 'Roboto', sans-serif;
           color: #fff;
           outline: none;
           border: none;
         }
         div#bs-example-navbar-collapse-1 {
            float: left;
         }
         .gl_btn{
           color: #fff;
           font-size: 14px !important;
           text-transform: uppercase;
           font-family: 'Roboto', sans-serif;
           font-weight: 600;
           margin:5px;
         }
         .gl_btn:hover{color:#fff;}
         nav.navbar.navbar-default.navbar-fixed-top.opaque {
          margin-top: 0;
         }
         a.gl_btn img {
          padding-right: 00px;
         }
         nav.navbar.navbar-default.navbar-fixed-top.opaque {
          margin-top: 0;
         }
         a.gl_btn {
           position: relative;
           bottom: 0;
         }
         a.btn.btn-link {
          color: #fff;
         }
         .navbar-header a img {
           width: 100%;
           max-width: 127px;
           position: relative;
           bottom: 16px;
           height: 60px;
         }
        a.btn.reg_btn:hover {color: #4285f4!important;
          background: #ffffff;
        }
        .navbar-fixed-top .navbar-nav > li > a {
           color: #ffffff !important;
           font-size: 14px !important;
           line-height: 30px !important;
           text-transform: uppercase;
           padding: 1px 18px !important;
           font-family: 'Roboto', sans-serif;
           font-weight: 600;
        }
        .rem_sec span {
          position: relative;
          bottom: 9px;
        }
        nav.navbar.navbar-default.navbar-fixed-top.opaque {
          margin-top: 0;
          display: block;
        }

        @media only screen and (max-width:1199px) and (min-width:992px)
        {
          .form-control {
            font-size: 11px;
          }
          a.btn.reg_btn {
            margin-right: -12px;
          }
        }
        @media(max-width:344px) and (min-width:320px){
         .btn-white {
            margin: 10px 8px !important;
          }
        }


      </style>
   </head>
   <body>
      <!-- Start Top Header -->
      <header class="header">
         @if (Auth::check())
         <div class="top_header log_sec">
            @else
            <div class="top_header">
               @endif
               <div class="container">
                  <div class="col-md-6">
                     <nav class="navbar navbar-default navbar-fixed-top">
                        <!--begin container -->
                        <!--begin navbar -->
                        <div class="navbar-header">
                           <button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button" id="togglenav">
                           <span class="sr-only">Toggle navigation</span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           </button>
                           <!--logo -->
                           <a href="{{url('/')}}"><img id="headerlogo" src="{{ asset('frontend/images/logo_white.png') }}" alt="mail" title="mail"></a>
                        </div>
                        <!--<div class="collapse navbar-collapse padding0" id="bs-example-navbar-collapse-1">        -->
                        <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse padding0">
                           <ul class="nav navbar-nav ">
                              <li><a href="{{url('/')}}">Home</a></li>
                              <li><a href="{{ url('/browse') }}">Browse</a></li>
                              <li><a href="{{ url('/events') }}">Events</a></li>
                              <li><a href="{{ url('/about') }}">About</a></li>
                               @php
                                  $pages = App\Page::get();
                              @endphp
                                @if (!empty($pages))
                                    @foreach ($pages as $page)
                                        @if ($page->section == 'HEADER')
                                            <li><a href="{{ url('cms/', $page->slug) }}">{{ $page->page_title }}</a></li>
                                        @endif
                                    @endforeach
                                @endif
                              <!--<li><a href="#services">Services</a></li>-->
                              <!--<li><a href="#features">Features</a></li>-->
                              <!--<li><a href="#pricing">Pricing</a></li>-->
                              <!--<li><a href="#blog">Blog</a></li>-->
                              <!--<li><a href="#contact" class="discover-btn">Get Started</a></li>-->
                           </ul>
                           <!--<ul class="nav navbar-nav navbar-right">-->
                           <!--            <li class="active"><a href="{{url('/')}}">HOME <span class="sr-only"></span></a></li>-->
                           <!--            <li><a href="{{url('/browse')}}">BROWSE</a></li>-->
                           <!--            <li><a href="{{url('/jobs')}}">JOBS</a></li>-->
                           <!--            <li><a href="#">HOW IT WORKS</a>-->
                           <!--            </li>-->
                           <!--            <li><a href="#">CONTACT US</a></li>-->
                           <!--            <li><a href="{{ url('/events') }}">EVENTS</a></li>-->
                           <!--        </ul>
                           <div class="mob_view_menu">
                           @if (Auth::check())
                           <a class="gl_btn " href="{{route('admin.dashboard')}}"><img src="{{ asset('frontend/images/login.png') }}" alt="account" title="account">My Account</a>
                           <a class="gl_btn " href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                           {{ __('Logout') }}
                           </a>
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                           </form>
                           @else
                           <form method="POST" action="{{ route('login') }}">
                              @csrf
                              <div class="login login_mob">
                                 <div class="col-md-4 nopadr">
                                    <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Second Life Name" required autofocus>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                    <div class="rem_sec">
                                      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> <span>{{ __('Remember Me') }}</span>
                                    </div>
                                 </div>
                                 <div class="col-md-4 nopadr">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password"  required>
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif

                                 </div>
                                 <div class="col-md-4 nopadr">
                                    <button type="submit" class="btnpad btnred border0 sb_btn">
                                    {{ __('Login') }}
                                    </button>
                                    <a class="btn reg_btn" href="{{url('')}}/register">Register</a>
                                 </div>
                              </div>
                           </form>
                           @endif
                          </div>-->
                        </div>
                        <!--end navbar -->
                        <!--end container -->
                     </nav>
                  </div>
                  <div class="col-md-6 form_sec nopadr">
                    <div class="desc_view_menu">
                     @if (Auth::check())
                     <a class="gl_btn " href="{{route('admin.dashboard')}}"><img src="{{ asset('frontend/images/login.png') }}" alt="account" title="account">My Account</a>
                     <a class="gl_btn " href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}
                     </a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                     </form>
                     @else
                     <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="login login_desc">
                           <div class="col-md-4 nopadr">
                              <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Second Life Name" required autofocus>
                              {{--
                              @if ($errors->has('email'))
                              <span class="invalid-feedback">
                              <strong>{{ $errors->first('email') }}</strong>
                              </span>
                              @endif
                              --}}
                              <div class="rem_sec">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> <span>{{ __('Remember Me') }}</span>
                              </div>
                           </div>
                           <div class="col-md-4 nopadr">
                              <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password"  required>
                              @if ($errors->has('password'))
                              <span class="invalid-feedback">
                              <strong>{{ $errors->first('password') }}</strong>
                              </span>
                                                @endif

                                                <a class="btn btn-link" href="https://maps.secondlife.com/secondlife/AvDopt/209/124/37">
                                                    {{ __('Forgot Password?') }}
                                                </a>
                                            </div>
                                            <div class="col-md-4 nopadr">
                                                <button type="submit" class="btnpad btnred border0 sb_btn">
                                                    {{ __('Login') }}
                                                </button>
                                                <a class="btn reg_btn" href="{{url('')}}/register">Register</a>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                    </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- End Top Header -->
      @yield('content')
      <div class="footer_sec">
         <div class="container">
            <div class="row">
               <div class="col-md-3">
                  <div class="foot_dv">
                     <a href="{{url('/')}}"><img src="{{ asset('frontend/images/logo_footer.png') }}" alt="mail" title="mail"></a>
                     <p>On Avdopt, you're more than just a photo on a prim. You have stories to tell, and things to talk about that are more interesting than lag.</p>
                  </div>
               </div>
               <div class="col-md-3">
                  <ul>
                     <li><a href="{{ url('/about') }}">About Us</a></li>
                     <li><a href="{{route('register')}}">Register</a></li>
                     <li><a href="{{url('/jobs/')}}">Careers</a></li>
                     
                     @foreach ($pages as $page)
                         @if ($page->section == 'FOOTER' && $page->column == 1)
                             <li><a href="{{ url('cms/'.$page->slug) }}">{{ $page->page_title }}</a></li>
                         @endif
                     @endforeach
                  </ul>
               </div>
               <div class="col-md-3">
                  <ul>
                     <li><a href="{{ route('terms') }}">Terms</a> </li>
                     <li><a href="{{ route('policy') }}">Policy</a></li>
                     <li><a href="{{ route('faq') }}">FAQs</a></li>
                     @foreach ($pages as $page)
                         @if ($page->section == 'FOOTER' && $page->column == 2)
                             <li><a href="{{ url('cms/'.$page->slug) }}">{{ $page->page_title }}</a></li>
                         @endif
                     @endforeach
                  </ul>
               </div>
               <div class="col-md-3">
                  <ul>
                     <li><a href="{{route('browse')}}">Browse</a></li>
                     <li><a href="{{route('events')}}">Events</a></li>
                     @foreach ($pages as $page)
                         @if ($page->section == 'FOOTER' && $page->column == 3)
                             <li><a href="{{ url('cms/'.$page->slug) }}">{{ $page->page_title }}</a></li>
                         @endif
                     @endforeach
                  </ul>
               </div>
            </div>
         </div>
         <div class="container">
            <div class="row">
               <!--begin col-md-12 -->
               <div class="col-md-12 text-center">
                  <div class="copyrighttxt">
                    <p>© Copyright 2017 - 2020 AvDopt, All Rights Reserved </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
       {{-- @include('sweet::alert') --}}
      @yield('scripts')
      <!-- BEGIN PAGE LEVEL SCRIPTS -->
      @yield('page_level_scripts')
      <!-- END PAGE LEVEL SCRIPTS -->
   </body>
</html>
