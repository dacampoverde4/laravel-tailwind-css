@php
    $countNotifications = \App\Notification::notificationCount();
    $countHearts = \App\Heart::where('user_id', Auth::user()->id)->where('is_seen', 1)->limit(7)->orderBy('id', 'desc')->get();
    $countMatches = \App\Match::WhereRaw( ' is_match = 1 AND is_seen = 1 AND ( user_id = ' . Auth::user()->id .' OR  matcher_id = ' . Auth::user()->id .' )' )->get();

    $user= Auth::user();
    $mytime = Carbon\Carbon::now();
    $currentdt = $mytime->toDateTimeString();
    $time = date("g:iA", strtotime($currentdt));

@endphp
<!-- desktop view menu -->
<aside class="left-sidebar" id="menu_gt_sidebar_desk">
            <!-- Sidebar scroll-->
            <div class="container-fluid">
                <div class="scroll-sidebar row">
                    <!-- Sidebar navigation-->
                    <div class="welcome-sec col-md-3">
                            <h4> <span class="welcome-text">Welcome</span> {{ substr(Auth::user()->display_name_on_pages, 0,  15) }}!</h4>
                        </div>
                    <div class="col-md-9"> 
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                            <li class="nav-small-cap">PERSONAL</li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="{{url('home')}}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a>
                            </li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="{{ url('browse')}}" aria-expanded="false"><i class="mdi mdi-account-off"></i><span class="hide-menu">Browse</span></a></li>
                            @php
                                $recentchatcount = \App\Message::recentchatcount();
                            @endphp
                            <li> <a class="has-arrow waves-effect waves-dark" href="{{ route('chatindex') }}" aria-expanded="false"><i class="mdi mdi-message-outline">@if( $recentchatcount )<span class="chatcnt">{{ $recentchatcount }}</span>@endif</i><span class="hide-menu">Chat</span></a>
                                <!-- <ul aria-expanded="false" class="collapse">
                                    <li><a href="{{ url('chat') }}">Chat</a></li>
                                    <li><a href="{{ url('messages') }}">Message</a></li>
                                </ul> -->
                            </li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="{{ route('trials.index') }}" aria-expanded="false"><i class="mdi mdi-calendar-check"></i><span class="hide-menu">Trial Dates</span></a></li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="{{ route('adoptions.index') }}" aria-expanded="false"><i class="mdi mdi-sitemap"></i><span class="hide-menu">Adoptions</span></a></li>


                            <li> <a class="has-arrow waves-effect waves-dark" href="{{ route('events') }}" aria-expanded="false"><i class="mdi mdi-account-switch"></i><span class="hide-menu">Events
                                    </span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="{{ route('saved.events.index') }}">My Saved Events
                                    </a></li>
                                </ul>
                            </li>

                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Activity</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="{{ route('user.likes') }}">My Likes</a></li>
                                    <li><a href="{{ route('user.matches') }}">My Matches</a></li>
                                    <li><a href="{{ route('display.blocks') }}">Blocks</a></li>
                                </ul>
                            </li>
                            <li> <a style="padding-top: 23px;" class="has-arrow waves-effect waves-dark" href="{{ route('manageads')}}" aria-expanded="false"><i class="fa fa-life-bouy"></i><span class="hide-menu">Manage Ads</span></a>
                            </li>
                            <!-- <li> <a class="has-arrow waves-effect waves-dark" href="{{url('tickets')}}" aria-expanded="false"><i class="mdi mdi-paperclip"></i><span class="hide-menu">Support</span></a>
                            </li> -->
                            <!-- <li>
                                <a class="has-arrow waves-effect waves-dark" href="{{url('certificates')}}" aria-expanded="false"><i class="fa fa-file" aria-hidden="true"></i><span class="hide-menu">Certificates</span></a>
                            </li> -->
                           
                        </ul>
                        
                    </nav>
                     </div>  


                        




                    <!-- End Sidebar navigation -->
                </div>
            </div>
            <!-- End Sidebar scroll-->
</aside>

<!-- mobile view menu -->
<aside class="left-sidebar" id="menu_gt_sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">PERSONAL</li>
                        <li>
                            <a class="waves-effect waves-dark" href="{{url('home')}}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="{{ url('browse')}}" aria-expanded="false"><i class="mdi mdi-account-off"></i><span class="hide-menu">Browse</span></a>
                        </li>
                        <li class="hassubmenu">
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Connect</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('chat') }}">Chat</a></li>
                                <li><a href="{{ url('messages') }}">Message</a></li>
                            </ul>
                        </li>
                        <li class="hassubmenu">
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi-wechat"></i><span class="hide-menu">Activity</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('user.likes') }}">My Likes</a></li>
                                <li><a href="{{ route('user.matches') }}">My Matches</a></li>
                                <li><a href="{{ route('trials.index') }}">Trial Request</a></li>
                                <li><a href="{{ route('adoptions.index') }}">Adoptions Request</a></li>
                                <li><a href="{{ route('display.blocks') }}">Blocks</a></li>
                            </ul>
                        </li>
                        <li class="hassubmenu">
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-switch"></i><span class="hide-menu">Events
                                </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a class="waves-effect waves-dark" href="{{ route('events') }}" aria-expanded="false">Events
                                </span></a></li>
                                <li><a href="{{ route('saved.events.index') }}">My Saved Events
                                </a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="{{ route('manageads')}}" aria-expanded="false"><i class="fa fa-life-bouy"></i><span class="hide-menu">Manage Ads</span></a>
                        </li>
                        <!-- <li>
                            <a class="waves-effect waves-dark" href="{{url('tickets')}}" aria-expanded="false"><i class="mdi mdi-paperclip"></i><span class="hide-menu">Support</span></a>
                        </li> -->
                        <!-- <li>
                            <a class="waves-effect waves-dark" href="{{url('certificates')}}" aria-expanded="false"><i class="fa fa-file" aria-hidden="true"></i><span class="hide-menu">Certificates</span></a>
                        </li> -->
                    </ul>
                    <div class="welcome-sec">
                        <h4>Welcome {{ Auth::user()->display_name_on_pages }}! <span class="timec">{{$time}} SLT</span></h4>
                    </div>
                </nav>


                <!-- End Sidebar navigation -->
            </div>
    <!-- End Sidebar scroll-->
</aside>
