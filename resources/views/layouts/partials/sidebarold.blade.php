@php
    $countNotifications = \App\Notification::notificationCount();
    $countHearts = \App\Heart::where('user_id', Auth::user()->id)->where('is_seen', 1)->limit(7)->orderBy('id', 'desc')->get();
    $countMatches = \App\Match::WhereRaw( ' is_match = 1 AND is_seen = 1 AND ( user_id = ' . Auth::user()->id .' OR  matcher_id = ' . Auth::user()->id .' )' )->get();
@endphp
 <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">PERSONAL</li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="{{url('home')}}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a>
                            
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="{{ url('browse')}}" aria-expanded="false"><i class="mdi mdi-account-off"></i><span class="hide-menu">Browse</span></a>
                           
                        </li>
                        <li > <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Connect</span></a>
                          <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('chat') }}">Chat</a></li>
                                <li><a href="{{ url('messages') }}">Message</a></li>
                                </ul>
                            
                        </li>
                        
                           
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi-wechat"></i><span class="hide-menu">Activity</span></a>
                         <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('user.likes') }}">My Likes
                                <li><a href="{{ url('user.matches') }}">My Matches</a></li>
                                <li><a href="{{ url('trials.index') }}">Trial Request</a></li>
                                <li><a href="{{ url('display.blocks') }}">Blocks</a></li>
                                </ul>
                            
                        </li>
                       
                         <li class=""> <a class="has-arrow waves-effect waves-dark" href="{{ route('events') }}" aria-expanded="false"><i class="mdi mdi-account-switch"></i><span class="hide-menu">Events
</span></a>
<ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('saved.events.index') }}">My Saved Events
                                
                                </ul>
                            
                        </li>
                            
                        </li>

                        <li class=""> <a class="has-arrow waves-effect waves-dark" href="{{url('tickets')}}" aria-expanded="false"><i class="mdi mdi-paperclip"></i><span class="hide-menu">Support</span></a>
                            
                        </li>
                        
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>