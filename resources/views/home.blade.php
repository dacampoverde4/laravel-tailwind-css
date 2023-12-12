@extends('layouts.master')

@section('main-content')

<!-- Start Main Content ---->
<div class="maincontent">
    <div class="content  mb30">

        <!-- Start notification ---->
            @if($checkTrial)
                @if( Auth::user()->id == $checkTrial->matcher_id || Auth::user()->id == $checkTrial->user_id )
                    <div class="bgwhite padding20 border_radius">
                        <div class="row user_trial">
                            <div class="col-md-12">
                               <h2><code>{{ @$checkTrial->userid->display_name_on_pages }}</code> & <code>{{ @$checkTrial->matcherid->display_name_on_pages }}</code> you are both on trial with each other
                            </div>
                        </div>
                    </div>
                @endif
            @endif

      
                            @if($allAdoptionRequest)
                              @foreach($allAdoptionRequest as $accepted)
                                      

                                      <div class="alert alert-info alert-dismissible">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <div class=" d-flex flex-row">
                                              <div class="row">
                                                  <div class="col-md-7">
                                                  @php
                                                    $getFamilyRoleInfo = FamilyRole::find($accepted->trial_family_role);

                                                    if($accepted->user_id != Auth::user()->id){
                                                        $displaynameUser = $accepted->userid->display_name_on_pages;
                                                        if($accepted->userid->gender)
                                                        {
                                                            if($accepted->userid->usergender)
                                                            {
                                                                if($accepted->userid->usergender->gender=='female')
                                                                    $heShe =  'she';
                                                                else {
                                                                  $heShe = 'He';
                                                                }
                                                            }
                                                        }else{
                                                            $heShe = 'He/She';
                                                        }
                                                    }else{
                                                      $displaynameUser = $accepted->matcherid->display_name_on_pages;
                                                      if($accepted->matcherid->gender)
                                                        {
                                                            if($accepted->matcherid->usergender)
                                                            {
                                                                if($accepted->matcherid->usergender->gender=='female')
                                                                    $heShe =  'she';
                                                                else {
                                                                  $heShe = 'He';
                                                                }
                                                            }
                                                        }else{
                                                            $heShe = 'He/She';
                                                        }
                                                    }    
                                                  @endphp
                                                    <h6><b>{{ $displaynameUser }}</b> Sent
                                                        you a Trial Request. {{$heShe}} will attend the trial date as your <b>"{{$getFamilyRoleInfo->title}}"</b>.</h6>
                                                      </div>
                                                      <div class="col-md-5" id="urgentNotification-btn">
                                                            <a href="{{ route('adoptions.accept', $accepted->id) }}"
                                                               class="btn btn-success">Accept</a>
                                                            <a href="{{ route('adoptions.decline', $accepted->id) }}"
                                                               class="btn btn-danger">Decline</a>
                                                                
                                                      </div>
                                                </div>
                                            </div>
                                      </div>
                                     
                                  @endforeach
                              @endif

            @if($allaccepted)
                @foreach($allaccepted as $accepted)
                    @if( Auth::user()->id == $accepted->matcher_id )
                        <div class="bgwhite padding20 border_radius">
                            <div class="row user_request">
                                <div class="col-md-8">
                                   <h2>Hi, <code>{{ $accepted->userid->display_name_on_pages }}</code> Sent you a Trial Request.</h2>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('trials.accept', $accepted->id) }}" class="btn btn-success">Accept</a>
                                    <a href="{{ route('trials.decline', $accepted->id) }}" class="btn btn-danger">Decline</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif

            @php
                $warnings = App\Notification::where('user_id', Auth::user()->id)->where('type', 'warning')->where('is_seen', '1')->get();
            @endphp

            @if($warnings)
                @foreach($warnings as $warning)
                    <div class="alert alert-warning alert-dismissible">
                        <a href="javascript:void(0)" class="close warningmessages" data-dismiss="alert" close-id="{{ $warning->id }}" aria-label="close">&times;</a>
                      <strong>Warning: </strong>{{ $warning->message }} <?php //dump($warning); ?>
                    </div>
                @endforeach
            @endif

            @php
                $announcements = App\Announcements::where('user_ids', 'NOT LIKE', '%"'.Auth::user()->id.'"%')->get();
                //dd($announcements);
            @endphp

            @if($announcements)
                @foreach($announcements as $announcement)
                    <div class="alert alert-warning alert-dismissible">
                        <a href="javascript:void(0)" class="close announcementmessages" data-dismiss="alert" close-id="{{ $announcement->id }}" aria-label="close">&times;</a>
                      <strong>Announcement: </strong>{{ $announcement->content }}
                    </div>
                @endforeach
            @endif
        <div class="notification mtopbottom">
            <div class="row feature_info">
                <div class="col-md-8 col-sm-8">
                    <div class="bgwhite padding20 border_radius">
                        <h4 class="font20 mb">FEATURE 5 PROFILE</h4>
                        @php
                            $featuredUsers = getSubscribedFeatureUsers();
                        @endphp
                        @if($featuredUsers)
                            @foreach($featuredUsers as $featuredUser)
                                <a href="{{ url('userprofile')}}/{{ base64_encode($featuredUser->user->id) }}" style="background-image:url({{ ( $featuredUser->user->profile_pic )? url('/uploads').'/'.$featuredUser->user->profile_pic : url('/images/default.png')}});">

                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="wallet_info bgwhite border_radius">
                        <div class="wallet_balance_img">
                            <img src="backend/images/wallet_balance.png" alt="">
                        </div>
                        <div class="wallet_balance_content">
                            <h3>WALLET BALANCE</h3>

                            <h2>T @if(Auth::user()->balance){{  Auth::user()->balance }} @else 0 @endif </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="notification  mtopbottom">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="bgwhite padding20 activetab border_radius">
                        <h2 class="mb font20 inline_block"><b> <i class="fa fa-user font20" aria-hidden="true"></i>ACTIVE USER</b></h2>
                        <button type="button" class="btnpad btnred border_radius border0">Browse</button>
                        <!-- Start Match Tabs -->
                        <hr>
                        <div class="paddingtb10">
                            <div class="row">
                                <div class="fullwidth mb30">
                                    @if( $activeusers )
                                        @foreach( $activeusers as $activeuser )
                                        <a href="{{route('viewprofile', base64_encode( $activeuser->id ))}}">
                                            <div class="col-md-4 text-center">
                                                @php
                                                    $profilepic = ( $activeuser->profile_pic )? 'uploads/'.$activeuser->profile_pic : 'images/default.png';
                                                @endphp
                                                <div class="img_container" style="background-image:url({{ asset($profilepic) }});">
                                                     @if( $activeuser->is_online )
                                                    <span class="green"></span>
                                                @endif
                                                </div>

                                                <div class="mtop20">
                                                    <h4>{{ ucfirst( $activeuser->display_name_on_pages ) }}</h4>
                                                    {{-- <span>{{ @$activeuser->usergroup->title}}</span> --}}
                                                </div>
                                            </div>
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- End Match Tabs -->
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="bgwhite padding20 liketab border_radius">
                        <h2 class="mb font20 inline_block"><b> <i class="fa fa-thumbs-up" aria-hidden="true"></i>LIKES</b></h2>
                        <a href="{{ route('user.likes') }}" class="btnpad btnred border_radius border0 pull-right">View</a>
                        <!-- Start Match Tabs -->
                        <hr>
                        <div class="paddingtb10">
                            <div class="row">
                                <div class="fullwidth mb30">
                                    @if( $likes )
                                        @foreach( $likes as $like )
                                            @php
                                                $userdata = \App\User::find($like->liked_by);
                                                $profilepic = ( @$userdata->profile_pic )? 'uploads/'.$userdata->profile_pic : 'images/default.png';
                                            @endphp
                                            @if( $userdata )

                                            <a href="{{route('viewprofile', base64_encode( $userdata->id ))}}">
                                                <div class="col-md-4 mb" >
                                                <div class="img_container like_user" style="background-image:url({{ asset($profilepic) }});">
                                                     @if( $userdata->is_online )
                                                    <span class="green"></span>
                                                @endif
                                                </div>
                                                <div class="mtop20 liketab_info">
                                                    <div class="inline_block">
                                                        <h4>{{ ucfirst( $userdata->display_name_on_pages ) }}</h4>
                                                        <span>{{ @$userdata->usergroup->title}}</span>
                                                    </div>
                                                    <i class="fa fa-heart-o fontclr pull-right "></i>
                                                </div>
                                                </div>
                                            </a>


                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- End Match Tabs -->
                    </div>
                </div>
            </div>
        </div>
        <div class="notification  mtopbottom">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="bgwhite padding20 my_hearts border_radius">
                        <h2 class="mb font20 inline_block"><b><i class="fa fa-heart"></i>MY HEARTS</b></h2>
                        <button type="button" class="btnpad btnred border_radius border0">Browse</button>
                        <!-- Start Match Tabs -->
                        <hr>
                        <div class="paddingtb10">
                            <div class="row">
                                @if( $hearts )
                                    @foreach( $hearts as $heart)
                                        @php
                                            $userdata = \App\User::find($heart->user_id);
                                            $profilepic = ( @$userdata->profile_pic )? 'uploads/'. @$userdata->profile_pic : 'images/default.png';
                                        @endphp
                                        @if( $userdata )
                                        <a href="{{route('viewprofile', base64_encode( $userdata->id ))}}" class="">
                                        <div class="fullwidth mb30 vertical_align">
                                            <div class="col-md-4 text-center">
                                                 <div class="img_container myheart_img"  style="background-image:url({{ asset($profilepic) }});"></div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="inline_block">
                                                    <h4>{{ ucfirst( $userdata->display_name_on_pages ) }}</h4>
                                                    <span>{{ @$userdata->usergroup->title}}</span>
                                                </div>
                                                <i style="font-size:22px" class="fa fa-heart"></i><h3 class="inline_block">4</h3>
                                            </div>
                                        </div>
                                       </a>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <!-- End Match Tabs -->
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="bgwhite padding20 profile_visitors border_radius">
                        <h2 class="mb font20 inline_block"><b> <i class="fa fa-eye" aria-hidden="true"></i>PROFILE VISITORS</b></h2>
                        <button type="button" class="btnpad btnred border_radius border0">View</button>
                        <!-- Start Match Tabs -->
                        <hr>
                        <div class="paddingtb10">
                            <div class="row">
                                <div class="fullwidth mb30">
                                    @if( $visitors )
                                        @foreach( $visitors as $visitor )
                                            @php
                                                $userdata = \App\User::find($visitor->visitor_id);
                                                $profilepic = ( @$userdata->profile_pic )? 'uploads/'.$userdata->profile_pic : 'images/default.png';
                                            @endphp
                                            @if( $userdata )
                                           <a href="{{route('viewprofile', base64_encode( $userdata->id ))}}">
                                            <div class="col-md-4 col-sm-4 text-center">
                                            <div class="img_container "  style="background-image:url({{ asset($profilepic) }});"></div>
                                                <div class="mtop20">
                                                    <h4>{{ ucfirst( $userdata->display_name_on_pages ) }}</h4>
                                                    <span>{{ @$userdata->usergroup->title}}</span>
                                                </div>
                                            </div>
                                            </a>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- End Match Tabs -->
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="bgwhite padding20 border_radius my_match">
                        <h2 class="mb font20 inline_block"><b> <i class="fa fa-heart full_heart"></i> <i class="fa fa-heart-o empty_heart"></i>MY MATCHES</b></h2>
                        <a href="{{ route('user.likes') }}" class="btnpad btnred border_radius border0 pull-right">View</a>
                        <!-- Start Match Tabs -->
                        <hr>
                        <div class="paddingtb10">
                            <div class="row">
                                <div class="fullwidth mb30">
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
                                            <a href="{{route('viewprofile', base64_encode( $userdata->id ))}}" >
                                            <div class="col-md-4 col-sm-4 text-center">

                                                <div class="img_container "  style="background-image:url({{ asset($profilepic) }});"></div>
                                                <div class="mtop20">
                                                    <h4>{{ ucfirst( $userdata->display_name_on_pages ) }}</h4>
                                                    <span>{{ @$userdata->usergroup->title}}</span>
                                                </div>
                                            </div>
                                            </a>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- End Match Tabs -->
                    </div>
                </div>
            </div>
        </div>
        <div class="notification  mtopbottom">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="bgwhite padding20 activetab border_radius">
                        <h2 class="mb font20 inline_block"><b> <img src="{{ asset('/backend/images/usergroup.png')}}"></i>Upcoming Events</b></h2>
                        <button type="button" onclick="location.href='{{route('saved.events.index')}}'" class="btnpad btnred border_radius border0">View All</button>
                        <!-- Start Match Tabs -->
                        <hr>
                        <div class="paddingtb10">
                            <div class="row">

                                <div class="fullwidth mb30">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th width="15%">Location</th>
                                        </tr>
                                        @if( $upcoming_events )
                                            @if(count($upcoming_events)>0)
                                            @foreach( $upcoming_events as $upcoming_event)
                                            <tr>
                                                <td>{{ $upcoming_event->title }}</td>
                                                <td >{{$upcoming_event->event_date_display}}</td>
                                                <td>
                                                    @if($upcoming_event->location_url)
                                                        <a target="_blank" class="btn btn-sm btn-success" href="{{$upcoming_event->location_url }}">Visit Location</a>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="10" class="text-center text-danger">No Upcoming event</td>
                                            </tr>
                                            @endif
                                        @else
                                            <tr>
                                                <td colspan="10" class="text-center text-danger">No Upcoming event</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- End Match Tabs -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End notification ---->
    </div>
</div>
<input value="{{ csrf_token() }}" data-id="{{ Auth::user()->id }}" type="hidden" id="token">
@endsection

@section('footer')
<script type="text/javascript">

$(document).ready(function(){
    $(".warningmessages").click(function(){
        var closeid = $(this).attr("close-id");
        var token = $("#token").val();
        var user_id = $("#token").attr("data-id");
        $.ajax(
        {
           url: "profile/removewarning/delete/"+closeid,
            method: 'post',
            dataType: "JSON",
            data: {
                "closeid": closeid,
                "_token": token
            },
            success: function ()
            {
                console.log("It works");
            }
        });
    });
});
</script>
@endsection
