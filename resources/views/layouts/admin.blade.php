<!DOCTYPE html>

<!--This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.-->

<html lang="en">

<head>
  <title>AVDOPT</title>
  <title>AVDOPT - @yield('page')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/bootstrap.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/choices.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/select2.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/font-awesome/css/font-awesome.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css">
  <script src="{{ asset('backend/js/jquery.min.js') }}"></script>
  <script src="{{ asset('backend/js/bootstrap.min.js') }}" type="text/javascript"></script>
  <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
  @yield('htmlheader')
  <script src="{{ asset('backend/js/custom.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/notify.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/common.js') }}" type="text/javascript"></script>
  <script src="{{ asset('unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/style.css') }}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

  <script src="{{ asset('js/choices.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'url' => url('/'),
        ]); ?>
    </script>
    <!-- BEGIN PAGE LEVEL STYLES-->
    @yield('page_level_styles')
    <!-- END PAGE LEVEL STYLES -->
	<style>

	</style>

</head>

<!-- Sidebar-->
<body class="skin-blue sidebar-mini">
<div class="tophead">
	<div class="container-fluid">
		<div class="topright">
			<div class="topuser">
				<ul>
					<li class="userimg" style="background-image:url({{url('/uploads/'.Auth::user()->profile_pic)}})"></li>
					<li><div class="username">{{ Auth::user()->display_name_on_pages }}<i class="fa fa-angle-down"></i></div>
						<div class="submenu">
							<ul>
								<li><a href="{{ url('profile') }}">Profile</a></li>
								<li><a class="dropdown-item" href="{{ route('logout') }}"
									onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form></li>
							</ul>
						</div>
					</li>
				</ul>
			</div>
			<div class="topmenu">
				<ul>
					<li class="notify_bell dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						@php
						    $count = \App\Notification::notificationCount();

						@endphp
						    <i class="fa fa-bell">@if( $count )<span>{{ $count }}</span>@endif</i>
						</a>
					 <!-- Notification Dropdown -->
                         <ul class="dropdown-menu">
                             @php
                                 $notifications = getLatestNotification();
                             @endphp
                             @if( $notifications )
                                @foreach( $notifications as $notification )
                                    @switch($notification->type)
                                        @case('like')
                                            @php
                                                $userdata = \App\User::find($notification->created_by);
                                                $profilepic = ( @$userdata->profile_pic )? 'uploads/'. $userdata->profile_pic : 'images/default.png';
                                            @endphp
                                            @if( $userdata )
                                                <li>
                                                    <a href="{{url('userprofile')}}/{{ base64_encode($notification->created_by) }}" class="notify" notify_id="{{ $notification->id }}" class="vertical_align">
                                                        <div class="col-md-2 padding0"><img src="{{ asset($profilepic) }}" class="img-circle" alt=""></div>
                                                        <div class="col-md-10 "><h4>{{ $userdata->display_name_on_pages }}</h4><p>{{ $notification->message }}</p>
                                                        <h6>{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</h6>
                                                       </div>
                                                    </a>
                                                </li>
                                                <li role="separator" class="divider"></li>
                                            @endif
                                        @break
                                    @endswitch
                                @endforeach
                            @endif
                            <li class="text-center"><a href="{{ url('/all-notifications') }}">See All Notifications</a></li>
                        </ul>
					 <!-- Notification Dropdown -->
					</li>

					<li><a href="{{ url('/profile/accountsetting') }}"><i class="fa fa-cog"></i></a>

					</li>
					@php
                        $chatmessages = chatNotifications();
                    @endphp
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
					aria-expanded="false"><i class="fa fa-envelope">@if( count($chatmessages) )<span>{{ count($chatmessages) }}</span>@endif</i></a>
					<!-- Messages Dropdown -->
                         <ul class="dropdown-menu">
                            @if( $chatmessages )
                                @foreach( $chatmessages as $chatmessage )
                                    @if( @$chatmessage['user'] )
                                        @php
                                            $profilepic = ( @$chatmessage['user']->profile_pic )? 'uploads/'.$chatmessage['user']->profile_pic : 'images/default.png';
                                        @endphp
                                        <li>
                                            <a href="{{ url('/chat') }}" class="vertical_align envelopemessage" envelope_id="{{ $chatmessage['message']->id }}">
                                                <div class="col-md-2 padding0"><img src="{{ asset($profilepic) }}" class="img-circle" alt=""></div>
                                                <div class="col-md-8 padding0"><h4>{{ $chatmessage['user']->display_name_on_pages }}</h4><p>sent a new message</p>
                                                    <h5 class="pull-left">{{ $chatmessage['message']->message }}</h5>
                                                    <h6 class="pull-right">{{ \Carbon\Carbon::parse($chatmessage['message']->created_at)->diffForHumans() }}</h6>
                                                </div>
                                            </a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                    @endif
                                @endforeach
                            @endif
                            <li class="text-center"><a href="{{ url('/chat') }}">See All Messages</a></li>
                        </ul>
					 <!-- Messages Dropdown -->
					</li>
					@php
				        $hearts = \App\Heart::where('user_id', Auth::user()->id)->where('is_seen', 1)->limit(7)->orderBy('id', 'desc')->get();
				    @endphp
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
					aria-expanded="false"><i class="fa fa-heart">@if( count( $hearts ) )<span>{{ count( $hearts ) }}</span>@endif</i></a>
					<!-- Heart Dropdown -->
                        <ul class="dropdown-menu">
                            @if( $hearts )
                                @foreach( $hearts as $heart )
                                    @php
                            	        $userid = $heart->wishlistedby;
                            	        $userdata = App\User::find($userid);
                                        $profilepic = ( @$userdata->profile_pic )? 'uploads/'.$userdata->profile_pic : 'images/default.png';
                                    @endphp
                                    @if( $userdata )
                                     <li>
                                    	<a href="{{ url('userprofile') }}/{{base64_encode($userid)}}" class="heartneedseen" heart_id="{{ $heart->id }}">
                                    		<div class="col-md-2 padding0"><img src="{{ asset($profilepic) }}" class="" alt=""></div>
                                    		<div class="col-md-10 ">
                                    		    <h4>{{ @$userdata->display_name_on_pages }}</h4>
                                    		    <p> Sent you a heart </p>
                                    		</div>
                                    	</a>
                                     </li>
                                    @endif
                                @endforeach
                            @endif
                            <li class="text-center"><a href="{{ url('/trials') }}">See All Hearts</a></li>
                        </ul>
					 <!-- Heart Dropdown -->
					</li>
					@php
                         $matches = \App\Match::WhereRaw( ' is_match = 1 AND is_seen = 1 AND ( user_id = ' . Auth::user()->id .' OR  matcher_id = ' . Auth::user()->id .' )' )->get();
                    @endphp
					<li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-heart full_heart"></i>
					<img src="{{ asset('frontend/images/empty_heart.png') }}" class="empty_heart">@if( count($matches) )<span class="empty_heart_span">{{ count($matches) }}</span>@endif</a>
					<!-- Heart Dropdown -->
                         <ul class="dropdown-menu">
                             @if( $matches )
                                @foreach( $matches as $match )
                                    @php
                                        $userid = $match->user_id;
                                        if( $match->user_id == Auth::user()->id ){
                                            $userid = $match->matcher_id;
                                        }
                                        $userdata = \App\User::find($userid);
                                        $profilepic = ( @$userdata->profile_pic )? 'uploads/'.$userdata->profile_pic : 'images/default.png';
                                    @endphp
                                    @if( $userdata )
                                        <li>
                                        	<a class="matchseen" href="{{ url('mymatches') }}" match_id="{{ $match->id }}">
                                        		<div class="col-md-3 padding0"><img src="{{ asset($profilepic) }}" class="" alt=""></div>
                                        		<div class="col-md-9 padding0"><h4>{{ @$userdata->display_name_on_pages }}</h4><p>Your Match</p>
                                        		</div>
                                        	</a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                    @endif
                                @endforeach
                            @endif
                            <li class="text-center"><a href="{{ url('/mymatches') }}">See All Matches</a></li>
                          </ul>
					 <!-- Heart Dropdown -->
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
    <div id="app">
        <div class="wrapper">
            <?php if (auth()->user()->role_id == 1 || auth()->user()->role_id == 3){?>
            @include('layouts/partials/admin/sidebar')
            <?php  }else{?>
            @include('layouts/partials/sidebar')
            <?php }?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
            <!-- Main content -->
                <section class="content">
                <!-- Your Page Content Here -->
                    @yield('content')
                    @yield('main-content')
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
        </div><!-- ./wrapper -->
    </div>
 
    <script src="{{ asset('backend/js/bootbox.min.js') }}" type="text/javascript"></script>
    {{-- @include('sweet::alert') --}}
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    @yield('page_level_scripts')
    <!-- END PAGE LEVEL SCRIPTS -->
   @yield('footer')

</body>
</html>
