<header>

    <div class="logo text-center">

        <a href="{{route('welcome')}}"><img src="{{ asset('backend/images/logo.jpg') }}" alt="Adoption"
                                            title="Adoption"></a>

    </div>

    <div class="mainmenu">


        <ul>
          
            <li><a href="{{url('home')}}"><img src="{{ asset('backend/images/dashboard.png') }}" alt="">Dashboard</a>
            </li>

            <li><a href="{{url('admin/announcements')}}"><img src="{{ asset('backend/images/announcement.png') }}"
                                                              alt="Img">Announcements</a></li>

            <li class="dropdown">

                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><img
                            src="{{ asset('backend/images/user.png') }}" alt="">Users <span class="caret"></span></a>

                <ul class="dropdown-menu">

                    <li><a href="{{route('admin.user')}}"><img src="{{ asset('backend/images/allusers2.png') }}"
                                                               alt="Img"> All Users</a></li>

                    <li><a href="{{route('users.create')}}"><img src="{{ asset('backend/images/adduser2.png') }}"
                                                                 alt="Img"> Add User</a></li>

                    <li><a href="{{route('admin.roles')}}"><img src="{{ asset('backend/images/role.png') }}" alt="">Roles</a>
                    </li>

                    <li><a href="{{route('admin.species.index')}}"><img src="{{ asset('backend/images/user.png') }}"
                                                                        alt="Species">Species</a></li>

                    <li><a href="{{url('admin/reports')}}"><img src="{{ asset('backend/images/reportmenu.png') }}"
                                                                alt="Img"> Reports</a></li>

                    <li><a href="{{route('users.employee')}}"><img src="{{ asset('backend/images/allusers2.png') }}"
                                                                   alt="Img">EOM</a></li>

                    <li><a href="{{url('admin/blocks')}}"><img src="{{ asset('backend/images/block.png') }}" alt="Img">
                            Blocks</a></li>

                    <li><a href="{{url('admin/reasons')}}"><img src="{{ asset('backend/images/block.png') }}" alt="Img">
                            Reasons</a></li>

                    <li><a href="{{url('admin/myfun')}}"><img src="{{ asset('backend/images/fun.png') }}" alt="Img"> Fun
                            tags</a></li>

                    <li><a href="{{url('admin/questionnaires')}}"><img
                                    src="{{ asset('backend/images/questionnaries.png') }}" alt="Questionnaires">Questionnaires</a>
                    </li>


                </ul>

            </li>
			<li><a href="{{route('blogs')}}"><img src="{{ asset('backend/images/subscription.png') }}" alt="Img">Blogs</a></li>

            <li><a href="{{route('words')}}"><img src="{{ asset('backend/images/block.png') }}" alt="Img">Words Security</a>
            </li>

            <li><a href="{{route('admin.gender')}}"><img src="{{ asset('backend/images/gender.png') }}" alt="Img">Gender
                    Role</a></li>

            <li><a href="{{url('chat')}}"><img src="{{ asset('backend/images/chat.png') }}" alt="Img"></span>Chathfghfgh</a>
            </li>

            <li class="dropdown">

                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><img
                            src="{{ asset('backend/images/usergroup.png') }}" alt="Img">User Groups<span
                            class="caret"></span></a>

                <ul class="dropdown-menu">

                    <li><a href="{{url('admin/usergroup')}}"><img src="{{ asset('backend/images/groups.png') }}"
                                                                  alt="Img">All Groups</a></li>

                    <li><a href="{{url('admin/usergroup/tags')}}"><img src="{{ asset('backend/images/tags.png') }}"
                                                                       alt="Img">Tags</a></li>

                </ul>

            </li>

            <li><a href="{{url('admin/family-role')}}"><img src="{{ asset('backend/images/gender.png') }}" alt="Img">Family
                    Role</a></li>

            <li class="dropdown">

                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><img
                            src="{{ asset('backend/images/subscription.png') }}" alt="Img">Subscription Plans<span
                            class="caret"></span></a>

                <ul class="dropdown-menu">

                    <li><a href="{{url('admin/subscriptionplans')}}"><img
                                    src="{{ asset('backend/images/manageplans.png') }}" alt="Img">Manage Plans</a></li>

                    <li><a href="{{url('admin/feature-setting')}}"><img
                                    src="{{ asset('backend/images/featureprofile.png') }}" alt="Img">Featured
                            profiles</a></li>

                </ul>

            </li>
        

        <!--<li><a href="{{url('admin/questionnaires')}}"><img src="{{ asset('backend/images/questionnaries.png') }}" alt="Img">Questionnaires</a></li>-->

        <!--<li><a href="{{url('admin/notes')}}"><img src="{{ asset('backend/images/notes.png') }}" alt="Img">Notes</a></li>-->

        <!--li><a href="{{url('admin/features')}}"><img src="{{ asset('backend/images/questionnaries.png') }}" alt="">Features</a></li-->

            <li class="dropdown">

                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><img
                            src="{{ asset('backend/images/career.png') }}" alt="Img">Careers<span class="caret"></span></a>

                <ul class="dropdown-menu">

                    <li><a href="{{url('admin/applicants')}}"><img src="{{ asset('backend/images/applicants.png') }}"
                                                                   alt="Img"> Applicants</a></li>

                    <li><a href="{{url('admin/tags')}}"><img src="{{ asset('backend/images/tag.png') }}" alt="Img"> Tags</a>
                    </li>

                    <li><a href="{{url('admin/jobs')}}"><img src="{{ asset('backend/images/job.png') }}" alt="Img"> Jobs</a>
                    </li>
                    <li><a href="{{url('admin/jobs/categories')}}"><img src="{{ asset('backend/images/job.png') }}"
                                                                        alt="Img">Categories</a></li>
                    <li><a href="{{url('admin/jobs/forms')}}"><img src="{{ asset('backend/images/career.png') }}"
                                                                   alt="Img"> Jobs Forms</a></li>
                </ul>

            </li>


            <li class="dropdown">

                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><img
                            src="{{ asset('backend/images/websetting.png') }}" alt="">Website Setting<span
                            class="caret"></span></a>

                <ul class="dropdown-menu">

                    <li><a href="{{url('admin/settingtoken')}}"><img
                                    src="{{ asset('backend/images/websitetoken.png') }}" alt="">Website Token</a></li>

                    <li><a href="{{url('admin/setting-screen-name')}}"><img
                                    src="{{ asset('backend/images/websitetoken.png') }}" alt="">Screen Name</a></li>
                    <li><a href="{{url('admin/register-labels')}}"><img
                                    src="{{ asset('backend/images/websitetoken.png') }}" alt="">Register Labels</a></li>

                </ul>

            </li>

            <li><a href="{{url('admin/credit-tokens')}}"><img src="{{ asset('backend/images/credit_tokens.png') }}"
                                                              alt="">Credit Tokens</a></li>

            <li><a href="{{url('admin/tokens')}}"><img src="{{ asset('backend/images/token_bundle2.png') }}" alt="">Tokens
                    Bundle</a></li>

            <li><a href="{{ url('tickets-admin') }}"><img src="{{ asset('backend/images/token2.png') }}" alt="">Tickets</a>
            </li>

            <li><a href="{{ url('admin/emails') }}"><img src="{{ asset('backend/images/subscription.png') }}" alt="Img">Emails</a>
            </li>

            <li class="dropdown">

                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><img
                            src="{{ asset('backend/images/usergroup.png') }}" alt="Img">Events<span
                            class="caret"></span></a>

                <ul class="dropdown-menu">

                    <li><a href="{{url('admin/events')}}"><img src="{{ asset('backend/images/groups.png') }}" alt="Img">All
                            Events</a></li>

                    <li><a href="{{url('admin/events/category/all')}}"><img src="{{ asset('backend/images/tags.png') }}"
                                                                            alt="Img">All Categories</a></li>

                </ul>

            </li>

            <li><a href="{{ url('admin/pages') }}"><img src="{{ asset('backend/images/subscription.png') }}" alt="Img">Pages</a></li>

            <li><a href="{{ url('admin/faq') }}"><img src="{{ asset('backend/images/subscription.png') }}" alt="Img">FAQ</a></li>

        </ul>

    </div>

</header>
