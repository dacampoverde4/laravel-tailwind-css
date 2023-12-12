@if (strpos(request()->path(), 'tickets') !== false && Auth::user()->role_id ==1)
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ticket.css') }}" rel="stylesheet">
    <script type="text/javascript">
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'url' => url('/'),
        ]); ?>
    </script>
</head>
<body class="fix-header fix-sidebar card-no-border">
    @include('admin.layout.app')
    <style>
.topuser .submenu {
        right: -40px;
    top: 61px;
    }
    .submenu.showsbmenu {
    z-index: 9999;
    opacity: 1;
    visibility: visible;
}
</style>
<script src="{{ asset('new_theme_assets/plugins/popper/popper.min.js') }}"></script>
<script src="{{ asset('new_theme_assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('new_theme_assets/main/js/jquery.slimscroll.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('new_theme_assets/main/js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('new_theme_assets/main/js/sidebarmenu.js') }}"></script>
<!--stickey kit -->
<script src="{{ asset('new_theme_assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('new_theme_assets/main/js/custom.min.js') }}"></script>

<script src="{{ asset('new_theme_assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!--morris JavaScript -->
<script src="{{ asset('new_theme_assets/plugins/raphael/raphael-min.js') }}"></script>
<script src="{{ asset('new_theme_assets/plugins/morrisjs/morris.min.js') }}"></script>
<!-- Chart JS -->
<script src="{{ asset('new_theme_assets/main/js/dashboard1.js') }}"></script>

<script src="{{ asset('new_theme_assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('backend/js/custom.js') }}" type="text/javascript"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
        $('#agents_list').select2();
</script>
</body>
</html>
@else
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png')}}">
    @if(!empty($title_by_page))
        <title>{{$title_by_page}}</title>
    @else <title>Dashboard</title> @endif
<!-- Bootstrap Core CSS -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('user/css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/chat.css') }}">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@yield('htmlheader')

<!-- You can change the theme colors from here -->
    <link href="{{ asset('user/css/colors/blue.css') }}" id="theme" rel="stylesheet">
    <script type="text/javascript">
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'url' => url('/'),
        ]); ?>
    </script>
    <style>
        img.heart_sec_img {
            height: 12px;
            width: 20px;

            padding: 0;
        }
        .dropdown-menu img {
            max-width: 50px;
        }
        .profile-img
        {
            width: 96px;
            height: 96px;
            margin: 0 auto 10px;
            display: block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
        }
        .user_active {
            padding: 0 10px 10px;
            min-height: 150px;
            height: auto;
            margin: 10px 0;
            text-align: center;
        }
        .bttns {

            margin-left: 59px;
        }
        .green {
            background-color: #5ede18;
            border-radius: 50%;
            height: 10px;
            left: 119px;
            position: absolute;
            top: 17px;
            width: 10px;
        }
        .btn.btn-success.bro {
            float: right !important;
        }
        .mb.font20.inline_block {
            padding: 1rem;
        }
        .card.pd_lft {
            padding: 15px;
        }
        .match_img img {
            width: 100px;
            height: 100px;
        }
        div#app {
            padding-top: 5px !important;
        }
        .topbar {
            background: #1976d2;
            position: fixed;
            width: 100%;
        }
        .mailbox .message-center a .mail-contnet {

            padding-left: 2rem;
        }
        .btn.btn-circle.crc_btn img {
            width: 40px;
            max-width: 40px!important;
        }
        a.nav-link i span {
            width: 15px;
            height: 15px;
            line-height: 16px;
            background: #eb3939;
            border-radius: 50%;
            display: block;
            font-size: 10px;
            color: #fff;
            font-weight: 700;
            text-align: center;
            position: absolute;
            top: 10px;
            right: 7px;
        }
        .editp
        {
            margin: -8px;
        }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="fix-header card-no-border logo-center">

<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    @include('layouts/partials/header');
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
@include('layouts/partials/sidebar')
<!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->




    <div class="page-wrapper">

        <div id="app">
            <!-- Your Page Content Here -->
            <main class="py-4 ticket_main">
            @yield('content')
            </main>
        </div><div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                <p class="usr_ftr_cprght">© Copyright 2017 - 2020 AvDopt, All Rights Reserved</p>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('backend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/slick.js') }}"></script>
     <script src="{{ asset('frontendnew/js/owl.carousel.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/esm/popper.js"></script> -->


    <script src="{{ asset('plugins/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->

    <!--stickey kit -->
    <script src="{{ asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <!--Custom JavaScript -->
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!-- Flot Charts JavaScript -->
    <script src="{{ asset('plugins/flot/excanvas.js')}}"></script>
    <script src="{{ asset('plugins/flot/jquery.flot.js')}}"></script>
    <script src="{{ asset('plugins/flot/jquery.flot.pie.js')}}"></script>
    <script src="{{ asset('plugins/flot/jquery.flot.time.js')}}"></script>
    <script src="{{ asset('plugins/flot/jquery.flot.stack.js')}}"></script>
    <script src="{{ asset('plugins/flot/jquery.flot.crosshair.js')}}"></script>
    <script src="{{ asset('plugins/flot.tooltip/js/jquery.flot.tooltip.min.js')}}"></script>

    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{ asset('plugins/styleswitcher/jQuery.style.switcher.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('.searchdropdown').select2({
                placeholder: 'Select Funs',
                multiple: true
            });
        });
    </script>

    <script>
        jQuery('.changeUserGroup').on('change', function() {
            var min = parseInt($(this).find(':selected').attr('data-min'));
            var max = parseInt($(this).find(':selected').attr('data-max'));
            var html = '';
            while(min <= max){
                html += '<option value="'+min+'">'+min+'</option>';
                min++;
            }
            jQuery('#user_age')
                .find('option')
                .remove()
                .end()
                .append(html);

        });
        $('#user_familyrole').select2({
            placeholder: 'Select Family Role',
            multiple: true
        });
        $('#familyRole').select2({
            placeholder: 'Select Family Role',
            multiple: false
        });
    </script>
    <!--Custom JavaScript -->
@yield('footer')
    <script src="{{ asset('backend/js/custom.js') }}" ></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
@yield('page_level_scripts')
</body>

</html>

@endif
