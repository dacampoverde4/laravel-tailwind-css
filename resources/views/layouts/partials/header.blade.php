<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<script src="{{ asset('frontendnew/js/jquery-1.11.3.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#menu_gt_toggle").click(function(){
            $("#menu_gt_sidebar").slideToggle();
        })

        $("#menu_gt_sidebar .sidebar-nav ul li a.has-arrow").click(function(){
            if($(this).closest("li").children("ul").length) {
               $(this).closest("li").children("ul").slideToggle();
            }
        })
    });    
</script>
<header class="topbar">

    <nav class="  navbar top-navbar  navbar-fixed-top navbar-expand-md navbar-light" id="topbar_gt">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="{{url('/')}}">
                <!-- Logo icon --><b>
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="{{ asset('assets/images/logo-icon.png')}}" alt="homepage" class="dark-logo"/>
                    <!-- Light Logo icon -->
                    <img src="{{ asset('frontend/images/logo_white.png')}}" alt="homepage" class="light-logo"/>
                </b>
                <!--End Logo icon -->
                <!-- Logo text --> </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse" id="usr_dash_nav">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto mt-md-0" style="margin: 0 auto;display: block;
    text-align: center;">
                <div class="col-md-12 banner dash_header_img">
                            <img src="http://laravel.avdopt.com/assets/images/match_quest_categoies/PAQJ0m1k2g_1573238630_.jpg" class="banner" alt="your image">
                </div>
                <li class="nav-item"><a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark"
                                        href="javascript:void(0)" id="menu_gt_toggle"><i class="mdi mdi-menu"></i></a></li>

            </ul>

            <ul class="navbar-nav my-lg-0">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="{{ url('all-notifications') }}">
                        @php
                            $count = \App\Notification::notificationCount();

                        @endphp
                        <i class="mdi mdi-bell">@if( $count )<span>{{ $count }}</span>@endif</i>


                    </a>
                    <div class="dropdown-menu mailbox animated slideInUp">
                        <ul>
                            <li>
                                <div class="drop-title">Notifications</div>
                            </li>
                            <li>
                                <div class="message-center">
                                @php
                                    $notifications = getLatestNotification();
                                @endphp
                                @if( $notifications->count()>0 )
                                    @foreach( $notifications as $notification )
                                        @switch($notification->type)
                                            @case('like')
                                            @php
                                                $userdata = \App\User::find($notification->created_by);
                                                $profilepic = ( @$userdata->profile_pic )? 'uploads/'. $userdata->profile_pic : 'images/default.png';
                                            @endphp
                                            @if( $userdata )
                                                <!-- Message -->
                                                    <a href="{{url('userprofile')}}/{{ base64_encode($notification->created_by) }}"
                                                       notify_id="{{ $notification->id }}">
                                                        <div class="btn btn-danger btn-circle"></div>
                                                        <div class="mail-contnet">
                                                            <h5>{{ $userdata->display_name_on_pages }}</h5> <span
                                                                    class="mail-desc">{{ $notification->message }}</span>
                                                            <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
                                                        </div>
                                                    </a>
                                                @endif
                                                @break
                                            @endswitch
                                        @endforeach
                                    @else
                                        <div class="text-center">You have no new notifications as yet.</div>
                                    @endif


                                </div>
                            </li>
                            <li>
                                <a class="nav-link text-center" href="{{ url('/all-notifications') }}"> <strong>Check
                                        all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @php 

                    $chatmessages = chatNotifications(); 
                    $recentnotecount = \App\UserMessage::recentnotecount();
                @endphp
                    <li class="nav-item dropdown mega-dropdown">
                    <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="{{route('messages')}}"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-email">@if($recentnotecount)<span>{{ $recentnotecount }}</span>@endif</i>
                    </a></li>
                <!-- <li class="nav-item dropdown mega-dropdown"><a
                            class="nav-link dropdown-toggle text-muted waves-effect waves-dark"
                            href="{{ url('/profile/accountsetting') }}" aria-haspopup="true" aria-expanded="false"><i
                                class="mdi  mdi-settings"></i></a>
                </li> -->


                <li class="nav-item dropdown mega-dropdown"><a
                            class="nav-link dropdown-toggle text-muted waves-effect waves-dark"
                            href="{{ url('myhearts') }}" aria-haspopup="true" aria-expanded="false"><i
                                class="mdi mdi-heart"></i></a></li>
                <li class="nav-item dropdown mega-dropdown"><a
                            class="nav-link dropdown-toggle text-muted waves-effect waves-dark"
                            href="{{ url('mymatches') }}" aria-haspopup="true" aria-expanded="false"><img
                                src="{{ asset('frontend/images/heartsicon_match.png')}}" class="heart_sec_img"></i></a></li>
                <li class="nav-item dropdown">
                    @php
                    $user= Auth::user();
                    @endphp
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href=""
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ ( $user->profile_pic )? url('/uploads/'.$user->profile_pic) : url('images/default.png') }}" class="profile-pic"/></a>
                    <div class="dropdown-menu dropdown-menu-right scale-up">
                        <ul class="dropdown-user">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img"><img src="{{Auth::user()->profile_pic_url}}" alt="user"></div>
                                    <div class="u-text">
                                        <h4>{{ Auth::user()->display_name_on_pages }}</h4>
                                        <!-- <p class="text-muted">varun@gmail.com</p> -->
                                        <a href="{{ url('userprofile') }}/{{base64_encode(Auth::user()->id)}}"
                                                                                    class="btn btn-rounded btn-danger btn-sm">View
                                            Profile</a></div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ url('profile/edit') }}"><i class="ti-user"></i>&nbsp; Edit Profile</a></li>
                            <li><a href="{{ url('wallet') }}"><i class="ti-wallet"></i>&nbsp; My Wallet</a></li>
                            <li><a href="{{url('pricing')}}"><i class="ti-email"></i>&nbsp; Subscription</a></li>
                            <li><a href="{{ route('matchquests') }}"><i class="ti-comments"></i>&nbsp; Match Quest</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ url('/profile/accountsetting') }}"><i class="ti-settings"></i>&nbsp; Account
                                    Setting</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a class="logout-form-class" href="{{ route('logout') }}" 
                                   onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i>&nbsp; {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
    