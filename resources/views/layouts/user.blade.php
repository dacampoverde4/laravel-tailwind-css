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

    @yield('og')

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png')}}">
    @if(!empty($title_by_page))
        <title>{{$title_by_page}}</title>
    @else <title>Dashboard</title> @endif
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('user/css/style.css') }}" rel="stylesheet">

    <link href="{{asset('user/css/soho.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/chat.css') }}">

    <!--- Date picker css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('backend/css/jquery-ui-timepicker-addon.min.css')}}" type="text/css" media="screen" />

     <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@yield('htmlheader')

<!-- You can change the theme colors from here -->
    <link href="{{ asset('user/css/colors/blue.css') }}" id="theme" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

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
            margin: 18px 0;
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
        	width: 18px;
        	height: 18px;
        	line-height: 16px;
        	background: #eb3939;
        	border-radius: 50%;
        	display: block;
        	font-size: 10px;
        	color: #fff;
        	font-weight: 700;
        	text-align: center;
        	position: absolute;
        	top: -7px;
        	right: 3px;
        	font-style: initial;
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

    @yield('page_css')
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
            <div class="container-fluid">
                @if(Auth::user()->photo_status == 1)
                <div class="alert alert-danger alert-dismissible">Your account is temporarily on hold until you change photo to meet our <a href="{{ route('terms') }}">terms</a> & <a href="{{ route('policy') }}">policies</a><a href="{{ route('edit.profile') }}" class="btn btn-success pull-right editp">Edit Profile</a>
                </div>
                @endif
            </div>
            <!-- Your Page Content Here -->
            @yield('main-content')
        </div>
        <div>
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
	  <script type="text/javascript" src="{{ asset('js/slick.js') }}"></script>
	  <script src="{{ asset('frontendnew/js/owl.carousel.min.js')}}"></script>



    <!-- Bootstrap tether Core JavaScript->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/esm/popper.js"></script> -->


    @if (in_array(Route::currentRouteName(), ['chatindex']))
    <script src="{{ asset('js/app.js') }}" ></script>
    @endif
    <script src="{{ asset('plugins/bootstrap/js/popper.min.js')}}"></script>
    <!-- <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script> -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>


    <!-- slimscrollbar scrollbar JavaScript -->

    <!--stickey kit -->
    <script src="{{ asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


    <!--Custom JavaScript -->
    <script src="js/soho.min.js"></script>

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
        $('.searchdropdown').select2({

                placeholder: 'Select Funs',
                multiple: true
            });

    </script>
    <!--Custom JavaScript -->
    <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
<script type="text/javascript">
// function display_c(){
// var refresh=1000; // Refresh rate in milli seconds
// mytime=setTimeout('display_ct()',refresh)
// }
//
// function display_ct() {
// var options = { hour: 'numeric', minute: 'numeric', second: 'numeric', timeZone: "America/Los_Angeles" };
// var x = new Date().toLocaleString("en-US", options);
// document.getElementById('ct').innerHTML = x+' (SLT)';
// display_c();
// }
var clockID;
var yourTimeZoneFrom = -8.00; //time zone value where you are at

var d = new Date();
//get the timezone offset from local time in minutes
var tzDifference = yourTimeZoneFrom * 60 + d.getTimezoneOffset();
//convert the offset to milliseconds, add to targetTime, and make a new Date
var offset = tzDifference * 60 * 1000;

function UpdateClock() {
    var tDate = new Date(new Date().getTime()+offset);
    var in_hours = tDate.getHours()
    var in_minutes=tDate.getMinutes();
    var in_seconds= tDate.getSeconds();

    // Check whether AM or PM
    var newformat = in_hours >= 12 ? 'PM' : 'AM';

    // Find current hour in AM-PM Format
    in_hours = in_hours % 12;

    // To display "0" as "12"
    in_hours = in_hours ? in_hours : 12;

    if(in_minutes < 10)
        in_minutes = '0'+in_minutes;
    if(in_seconds<10)
        in_seconds = '0'+in_seconds;
    if(in_hours<10)
        in_hours = '0'+in_hours;
    let ct_id = document.getElementById('ct');
    if(ct_id){
        ct_id.innerHTML = ""
        + in_hours + ":"
        + in_minutes + ":"
        + in_seconds + ' <span class="timeFormat">'+newformat + ' (SLT)</span>';
    }

}
function StartClock() {
   clockID = setInterval(UpdateClock, 500);
}

function KillClock() {
  clearTimeout(clockID);
}
window.onload=function() {
  StartClock();
}
</script>

@yield('footer')
    <script src="{{ asset('backend/js/custom.js') }}" ></script>

    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->

    <!-- time picker -->
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="{{ asset('backend/js/jquery-ui-timepicker-addon.min.js')}}"></script>
    <script src="{{ asset('backend/js/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>
{{-- @include('sweet::alert') --}}
@yield('page_level_scripts')
@php
$usergroups = array();
$plans = array();
$groupset = 0;
$planset = 0;

$checknotication = App\Models\PushNotification::with('usergroups','plans')->first();

if(!empty($checknotication->usergroups))
{
    foreach ($checknotication->usergroups as $value) {
         $usergroups[] = $value->id;
    }
    $auth_usergroup = Auth::user()->group;

    if(in_array($auth_usergroup, $usergroups))
    {
      $groupset = 1;
    }else
    {
      $groupset = 0;
    }
}

if(!empty($checknotication->plans))
{
    foreach($checknotication->plans as $value1) {
         $plans[] = $value1->id;
    }
    $auth_plan = getCurrentUserPlan()->id;

    if(in_array($auth_plan, $plans))
    {
      $planset = 1;
    }
    else
    {
      $planset = 0;
    }
}

$intervaltime=  @$checknotication->seconds_to_show_after_login;
@endphp
<div class="modal fade" id="notification_popup" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <button type="button" class="close" id="#popup-close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
         <img src="{{@$checknotication->image}}" class="img-responsive">
        </div>


        <!-- Modal footer -->
        <div class="modal-footer">
          <a href='{{@$checknotication->url}}' target="_blank"><button type="button" class="btn btn-primary">Click Me!</button></a>
        </div>

      </div>
    </div>
  </div>
<script>
$(document).ready(function(){
  var intervaltime= "<?php echo $intervaltime; ?>";
  var groupset= "<?php echo $groupset; ?>";
  var planset= "<?php echo $planset; ?>";

    if(intervaltime >0 && groupset>0 || intervaltime>0 && planset>0){
      if (!sessionStorage.getItem('shown-modal')){
        setTimeout(function() {
           $('#notification_popup').modal('show');
        }, intervaltime*1000);
        sessionStorage.setItem('shown-modal', 'true');
      }
    }

  $(".logout-form-class").click(function(){
    sessionStorage.clear();
  });
});
</script>
</body>

</html>
