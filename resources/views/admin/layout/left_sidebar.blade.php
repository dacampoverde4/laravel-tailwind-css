<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile">
            <!-- User profile image -->
            <div class="profile-img"> <img src="{{url('/uploads/'.Auth::user()->profile_pic)}}" alt="user" />
                <!-- this is blinking heartbit-->
                <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div>
            </div>
            <!-- User profile text-->
            <div class="profile-text">
                <h5>{{ Auth::user()->name }}</h5>
                <a href="{{ url('/profile/accountsetting') }}" class="dropdown-toggle u-dropdown" data-toggle="dropdown"
                    role="button" aria-haspopup="true" aria-expanded="true"><i class="mdi mdi-settings"></i></a>
                <a href="{{ url('/chat') }}" class="" data-toggle="tooltip" title="Email"><i
                        class="mdi mdi-gmail"></i></a>
                <a href="{{ route('logout') }}" class="" data-toggle="tooltip" title="Logout"><i
                        class="mdi mdi-power"></i></a>
                <div class="dropdown-menu animated flipInY">
                    <!-- text-->
                    <a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                    <!-- text-->
                    <a href="#" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>
                    <!-- text-->
                    <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                    <!-- text-->
                    <div class="dropdown-divider"></div>
                    <!-- text-->
                    <a href="{{ url('/profile/accountsetting') }}" class="dropdown-item"><i class="ti-settings"></i>
                        Account Setting</a>
                    <!-- text-->
                    <div class="dropdown-divider"></div>
                    <!-- text-->
                    <a href="{{ route('logout') }}" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                    <!-- text-->
                </div>
            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li>
                    <a class="waves-effect waves-dark" href="{{route('admin.dashboard')}}" aria-expanded="false"><i
                            class="mdi mdi-bullseye"></i><span class="hide-menu">Dashboard</span></a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{url('admin/announcements')}}" aria-expanded="false"><i
                            class="ti-announcement"></i><span class="hide-menu">Announcements</span></a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{url('admin/subscription-plan-usergroup')}}"
                        aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Group Plan
                            Mapping</span></a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ url('tickets-admin') }}" aria-expanded="false"><i
                            class="fa fa-ticket"></i><span class="hide-menu">Tickets</span></a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ url('admin/blogs') }}" aria-expanded="false"><i
                            class="fa fa-th-large" aria-hidden="true"></i><span class="hide-menu">Blog</span></a>
                </li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                            class="fa fa-user"></i><span class="hide-menu">User Management</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('admin.user')}}">All Users</a></li>
                        <li><a href="{{route('admin.incomplete.user')}}">Incomplete Users</a></li>
                        <li><a href="{{ route('admin.subscibed_users') }}">Subscribed Members</a></li>
                        <li><a href="{{route('profile.suspenduser')}}">Suspended Accounts</a></li>
                        <li><a href="{{route('profile.verifyusers')}}">Verify Requests</a></li>
                        <li><a href="{{route('userverification.index')}}">User Verification Que.</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                            class="fa fa-users"></i><span class="hide-menu">User Settings</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{url('admin/usergroup')}}">User Groups</a></li>
                        <li><a href="{{url('admin/usergroup/tags')}}">Tags</a></li>
                        <li><a href="{{route('admin.gender')}}">Gender Role</a>
                        </li>
                        <li><a href="{{url('admin/family-role')}}">Family
                                Role</a></li>
                        <li><a href="{{url('admin/seeking-role')}}">Seeking
                                Role</a></li>
                        <li><a href="{{url('admin/ethnicity-group')}}">Ethnicity Group
                            </a></li>
                        <li><a href="{{route('admin.species.index')}}">Species</a></li>
                        <li><a href="{{url('admin/myfun')}}">Fun tags</a></li>
                        <li><a href="{{url('admin/hud')}}">Huds</a></li>
                        <li><a href="{{url('admin/relationship')}}">Relationship Status</a></li>
                        <li><a href="{{url('admin/occupation')}}">Occupation</a></li>
                    </ul>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{url('chat')}}" aria-expanded="false"><i
                            class="fa fa-comments"></i><span class="hide-menu">Chat</span></a>
                </li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-refresh"
                            aria-hidden="true"></i> <span class="hide-menu">Trials</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a class="waves-effect waves-dark" href="{{url('admin/trial-reasons')}}"
                                aria-expanded="false"><span class="hide-menu">Trial Reasons</span></a></li>
                        <li><a class="waves-effect waves-dark" href="{{url('admin/trial-request')}}"
                                aria-expanded="false"><span class="hide-menu">Trial Requests</span></a></li>
                        <li><a class="waves-effect waves-dark" href="{{url('admin/trial-location')}}"
                                aria-expanded="false"> <span class="hide-menu">Trial Locations</span></a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-refresh"
                            aria-hidden="true"></i> <span class="hide-menu">Adoptions</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a class="waves-effect waves-dark" href="{{url('admin/adoptions-request')}}"
                                aria-expanded="false"><span class="hide-menu">Adoption Requests</span></a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                            class="fa fa-list"></i><span class="hide-menu">Subscription Plans</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{url('admin/subscriptionplans')}}">Premium Plans</a></li>
                        <li><a href="{{url('admin/feature-setting')}}">Featured profiles</a></li>
                        <li><a href="{{url('admin/tokens')}}">Tokens Bundle</a></li>
                        <li><a href="{{url('admin/trialPlans')}}">Trial Plans</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                            class="fa fa-comments"></i><span class="hide-menu">Match Quest</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{url('admin/questionnaires')}}">Create</a></li>
                        <li><a href="{{route('matchquestcategories.index')}}">Categories</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                            class="fa fa-gear"></i><span class="hide-menu">Website Setting</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{url('admin/credit-tokens')}}">Credit Tokens</a></li>
                        <li><a href="{{url('admin/settingtoken')}}">Website Token</a></li>
                        <li><a href="{{url('admin/setting-screen-name')}}">Screen Name</a></li>
                        <li><a href="{{url('admin/register-labels')}}">Register Labels</a></li>
                        <li><a href="{{route('admin.roles')}}">Roles</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                            class="mdi mdi-bullseye"></i><span class="hide-menu">Events</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{url('admin/events')}}">All Events</a></li>
                        <li><a href="{{url('admin/events/category/all')}}"> Categories</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                            class="fa fa-graduation-cap"></i><span class="hide-menu">Careers</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{url('admin/applicants')}}">Applicants</a></li>
                        <li><a href="{{url('admin/jobs')}}">Jobs</a></li>
                        <li><a href="{{url('admin/jobs/forms')}}">Jobs Forms</a></li>
                        <li><a href="{{url('admin/jobs/categories')}}">Categories</a></li>
                        <li><a href="{{url('admin/tags')}}">Tags</a></li>
                        <li><a href="{{route('users.employee')}}">EOM</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-lock"
                            aria-hidden="true"></i><span class="hide-menu">Security</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('words')}}">Words Security</a></li>
                        <li><a href="{{url('admin/reasons')}}">Reasons</a></li>
                        <li><a href="{{url('admin/blocks')}}">Blocks</a></li>
                        <li><a href="{{url('admin/reports')}}">Reports</a></li>
                    </ul>
                </li>

                <li>
                    <a class="waves-effect waves-dark" href="{{ url('admin/emails') }}" aria-expanded="false"><i
                            class="fa fa-mail-forward"></i><span class="hide-menu">Emails</span></a>
                </li>
                <li><a href="{{ url('admin/pages') }}"><img src="{{ asset('backend/images/subscription.png') }}"
                            alt="Img">Pages</a></li>

                <li><a href="{{ url('admin/users/massmessage') }}"><i class="fa fa-envelope"></i>Mass Message</a></li>

                <li><a href="{{ url('admin/coupons') }}"><img src="{{ asset('backend/images/subscription.png') }}"
                            alt="Img">Coupons</a></li>
                <li><a href="{{ url('admin/terminal') }}"><img src="{{ asset('backend/images/subscription.png') }}"
                            alt="Img">Terminal</a></li>
                <li><a href="{{ route('pushnotifications.index') }}"><i class="fa fa-bell"></i>Push Notifications</a>
                </li>

                <li>
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                            class="fa fa-life-bouy" aria-hidden="true"></i><span
                            class="hide-menu">Advertisement</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('showbanners.advertisement')}}">Banners</a></li>
                        <li><a href="{{route('showtargetaudiances.advertisement')}}">Target Audiances</a></li>
                        <li><a href="{{route('admin.advertisement')}}">All Advertisements</a></li>
                        <li><a href="{{route('admin.advertisement.active')}}">Active Advertises</a></li>
                        <li><a href="{{route('admin.advertisement.paid')}}">Paid Advertises</a></li>
                        <li><a href="{{route('admin.advertisement.ended')}}">Ended Advertises</a></li>
                        <li><a href="{{route('admin.advertisement.monthlyearned')}}">Monthly Earned Advertises</a></li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
