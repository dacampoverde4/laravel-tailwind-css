@extends('layouts.master')
@section('main-content')
<style>
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

.user {
    padding:0 10px 10px;
    min-height:150px;
    height:auto;
    margin: 10px 0;
}
</style>





<style>
    .btn.btn-success.bro {
	float: right !important;
}
.mb.font20.inline_block {
	padding: 1rem;
}



.card.pd_lft {
    padding: 15px;
}

</style>

<!-- Start Main Content ---->
    <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-envelope"> </i> Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard
                </div>
                <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>

        <!-- Start notification ---->
            @if($checkTrial)
                @if( Auth::user()->id == $checkTrial->matcher_id || Auth::user()->id == $checkTrial->user_id )
                    <div class="bgwhite padding20 border_radius">
                        <div class="row user_trial">
                            <div class="col-md-12">
                               <h2><code>{{ @$checkTrial->userid->name }}</code> & <code>{{ @$checkTrial->matcherid->name }}</code> you are both on trial with each other
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            
            @if($allaccepted)
                @foreach($allaccepted as $accepted)
                    @if( Auth::user()->id == $accepted->matcher_id )
                        <div class="bgwhite padding20 border_radius">
                            <div class="row user_request">
                                <div class="col-md-8">
                                   <h2>Hi, <code>{{ $accepted->userid->name }}</code> Sent you a Trial Request.</h2>
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
       
       

       
        <div class="row">
           
                <div class="col-md-8 col-sm-8">
                    <div class="card-body">
                                        <div class="profiletimeline">
                        <h4 class="font20 mb">FEATURE 5 PROFILE</h4>
                        
                        @php
                            $featuredUsers = getSubscribedFeatureUsers();
                        @endphp
                        @if($featuredUsers)
                        <div class="row">
                             <div class="col-lg-3 col-md-6 m-b-20"><img src="{{ asset('assets/images/big/img1.jpg')}}" class="img-responsive radius" /></div>
                              <div class="col-lg-3 col-md-6 m-b-20"><img src="{{ asset('assets/images/big/img1.jpg')}}" class="img-responsive radius" /></div>
                               <div class="col-lg-3 col-md-6 m-b-20"><img src="{{ asset('assets/images/big/img1.jpg')}}" class="img-responsive radius" /></div>
                                <div class="col-lg-3 col-md-6 m-b-20"><img src="{{ asset('assets/images/big/img1.jpg')}}" class="img-responsive radius" /></div>
                                 <div class="col-lg-3 col-md-6 m-b-20"><img src="{{ asset('assets/images/big/img1.jpg')}}" class="img-responsive radius" /></div>
                          <!--  @foreach($featuredUsers as $featuredUser)
                             @php
                                                    $profilepic = ( $featuredUser->profile_pic )? 'uploads/'.$featuredUser->profile_pic : 'images/default.png';
                                                @endphp
                                <a href="{{ url('userprofile')}}/{{ base64_encode($featuredUser->user->id) }}" >
                                   <div class="col-lg-3 col-md-6 m-b-20"><img src="{{ asset('assets/images/big/img1.jpg')}}" class="img-responsive radius" /></div>
                                                          <!--  <div class="col-lg-3 col-md-6 m-b-20"><img src="{{ asset($profilepic) }}" class="img-responsive radius" /></div>
                                                            
                                                       
                                </a>
                            @endforeach -->
                            </div>
                        @endif
                         
                    </div> </div> </div>
                
                
               
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h2 class="mb font20 inline_block"><b> <i class="fa fa-user" aria-hidden="true"></i>Active Users</b>  <a href="{{ url('browse')}}" class="btn btn-success bro "> Browse</a> </h2> 
             @if( $activeusers )
                                        @foreach( $activeusers as $activeuser )
                                         @php
                                                    $profilepic = ( $activeuser->profile_pic )? 'uploads/'.$activeuser->profile_pic : 'images/default.png';
                                                @endphp
                                                <a href="{{route('viewprofile', base64_encode( $activeuser->id ))}}" >
          <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div class=""><img src="{{ asset($profilepic) }}" alt="user" class="img-circle" width="100" /></div>
                                <div class="p-l-20">
                                    <h3 class="font-medium">{{ ucfirst( $activeuser->name ) }}</h3>
                                    <h6>{{ @$activeuser->usergroup->title}}</h6>
                                   
                                </div>
                            </div>
                        
                        </div>
                        </div>
                        </a>
                                  @endforeach
                                    @endif
                    </div>   
                    
                        <!-- Start Match Tabs -->    
                        <div class="col-md-6 col-sm-6">
                             <h2 class="mb font20 inline_block"><b> <i class="fa fa-thumbs-up" aria-hidden="true"></i><a href="{{ url('mylikes')}}" class="btn btn-success bro "> LIKES</a></b></h2>
                                 @if( $likes )
                                        @foreach( $likes as $like )
                                            @php
                                                $userdata = \App\User::find($like->liked_by);
                                                $profilepic = ( @$userdata->profile_pic )? 'uploads/'.$userdata->profile_pic : 'images/default.png';
                                            @endphp
                                            @if( $userdata )
                                             @if( $userdata->is_online )
                                                    <span class="green"></span>
                                                @endif
                                                <a href="{{route('viewprofile', base64_encode( $userdata->id ))}}" >
          <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div class=""><img src="{{ asset($profilepic) }}" alt="user" class="img-circle" width="100" /></div>
                                <div class="p-l-20">
                                    <h3 class="font-medium">{{ ucfirst( $userdata->name ) }}</h3>
                                    <h6></h6>{{ @$userdata->usergroup->title}}</h6>
                                     <i class="fa fa-heart-o fontclr pull-right "></i>
                                </div>
                            </div>
                        
                        </div>
                        </div>
                        </a>
                        @endif
                                  @endforeach
                                    @endif
                    </div> 

                   </div> 
       
               <!---------Profile Visitor And my matches------------>
               
               
                <div class="row">
            <div class="col-md-6 col-sm-6">
                 <h2 class="mb font20 inline_block"><b><i class="fa fa-heart"></i>MY HEARTS</b><a href="{{ url('mylikes')}}" class="btn btn-success bro "> View</a></h2>
                        
             @if( $hearts )
                                    @foreach( $hearts as $heart)
                                        @php
                                            $userdata = \App\User::find($heart->user_id);
                                            $profilepic = ( @$userdata->profile_pic )? 'uploads/'. @$userdata->profile_pic : 'images/default.png';
                                        @endphp
                                        @if( $userdata )
                                        <a href="{{route('viewprofile', base64_encode( $userdata->id ))}}" class="">  
          <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div class=""><img src="{{ asset($profilepic) }}" alt="user" class="img-circle" width="100" /></div>
                                <div class="p-l-20">
                                    <h3 class="font-medium">{{ ucfirst( $userdata->name ) }}</h3>
                                    <h6>{{ @$userdata->usergroup->title}}</h6>
                                   
                                </div>
                            </div>
                        
                        </div>
                        </div>
                        </a>
                        
                         @endif
                        
                                  @endforeach
                                    @endif
                    </div>   
                    
                        <!-- Start Match Tabs -->    
                        <div class="col-md-6 col-sm-6">
                             <h2 class="mb font20 inline_block"><b> <i class="fa fa-thumbs-up" aria-hidden="true"></i>PROFILE VISITORS</b><a href="{{ url('mylikes')}}" class="btn btn-success bro "> View</a></h2>
                             
                                @if( $visitors )
                                        @foreach( $visitors as $visitor )
                                            @php
                                                $userdata = \App\User::find($visitor->visitor_id);
                                                $profilepic = ( @$userdata->profile_pic )? 'uploads/'.$userdata->profile_pic : 'images/default.png';
                                            @endphp
                                            @if( $userdata )
                                           <a href="{{route('viewprofile', base64_encode( $userdata->id ))}}">
                                                
          <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div class=""><img src="{{ asset($profilepic) }}" alt="user" class="img-circle" width="100" /></div>
                                <div class="p-l-20">
                                    <h3 class="font-medium">{{ ucfirst( $userdata->name ) }}</h3>
                                    <h6></h6>{{ @$userdata->usergroup->title}}</h6>
                                     <i class="fa fa-heart-o fontclr pull-right "></i>
                                </div>
                            </div>
                        
                        </div>
                        </div>
                        </a>
                        @endif
                                  @endforeach
                                    @endif
                    </div> 
  
                    
                   </div> 
               

               <!-------End Profile Visitor and my matches------->
         
        
         <!---------Maches And my matches------------>
               
             
                <div class="row">
            <div class="col-md-6 col-sm-6">
                 <h2 class="mb font20 inline_block"><b><i class="fa fa-heart"></i>MY HEARTS</b> <a href="{{ route('user.likes') }}" class="btn btn-success bro">View</a></h2>
                        
                        
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
          <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                
                                <!--<div class=""><img src="{{ asset($profilepic) }}" alt="user" class="img-circle" width="100" /></div>-->
                                <div class="p-l-20">
                                    <h3 class="font-medium">{{ ucfirst( $userdata->name ) }}</h3>
                                    <h6>{{ @$userdata->usergroup->title}}</h6>
                                    
                                </div>
                            </div>
                        
                        </div>
                        </div>
                        </a>
                        
                         @endif
                        
                                  @endforeach
                                    @endif
                    </div>   
                    
                        <!-- Start Match Tabs -->    
                        <div class="col-md-6 col-sm-6">
                            <h2 class="mb font20 inline_block"><b> <img src="{{ asset('/backend/images/usergroup.png')}}"></i>Upcoming Events</b><button type="button" onclick="location.href='{{route('saved.events.index')}}'" class="btn btn-success bro">View All</button></h2>
                        
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
                    

               <!-------End Maches Visitor and my matches------->
 <div class="container-fluid">
            <div class="notify_sec">
            <div class="row">
                 <div class="col-md-8 col-sm-8">
                  <div class="card pd_lft">
                      <div class=" notify_head ">
                     <h1 class="text-themecolor"><i class="mdi mdi-bell"></i>Notifications</h1> 
                  </div> 
                  
                  <div class=" d-flex flex-row  ">
                 <div class="img_cr"><img src="http://laravel.avdopt.com/uploads/default.png" alt="user" class="img-circle" width="100"></div>
                 <div class="p-l-20 bdy_area">
                           
                                    <h6 class="font-medium mr_btm" >User 1 liked your profile</h6>
                                     <p>4 minuets ago</p>
                                </div>
                </div> 
                
                
                <div class=" d-flex flex-row ">
                 <div class="img_cr"><img src="http://laravel.avdopt.com/uploads/default.png" alt="user" class="img-circle" width="100"></div>
                 <div class="p-l-20 bdy_area">
                                  
                                    <h6 class="font-medium mr_btm">User 1 liked your profile</h6>
                                     <p>4 minuets ago</p>
                                </div>
                </div> 
                
                
                <div class=" d-flex flex-row ">
                 <div class="img_cr"><img src="http://laravel.avdopt.com/uploads/default.png" alt="user" class="img-circle" width="100"></div>
                 <div class="p-l-20 bdy_area">
                                  
                                    <h6 class="font-medium mr_btm">Announcement: This is an announcement for everyone</h6>
                                     <p>4 minuets ago</p>
                                </div>
                </div> 
                
                
                
                </div> 
                </div> 
                
                
                <div class="col-md-4 col-sm-4">
                    
                     <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success"><i class="ti-wallet"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">T @if(Auth::user()->balance){{  Auth::user()->balance }} @else 0 @endif </h3>
                                        <h5 class="text-muted m-b-0">WALLET BALANCE</h5></div>
                                        <div class="bttns">
                                         <a href="http://laravel.avdopt.com/mylikes" class="btn btn-success bro1">Deposit</a>   
                                          <a href="http://laravel.avdopt.com/mylikes" class="btn btn-success bro">My wallet</a>   
                                            
                                        </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="subs_sec"><h1>subscription</h1></div>
                                    <div class="subs_sec"><span>free</span></div>
                                    <div class="subs_sec"><a class="btn" href="">free</a></div>
                                    </div>
                                    <div class="m-l-10 align-self-center">
                                        
                                        <div class="bttns">
                                         <a href="http://laravel.avdopt.com/mylikes" class="btn btn-success bro1">Deposit</a>   
                                          <a href="http://laravel.avdopt.com/mylikes" class="btn btn-success bro">My wallet</a>   
                                            
                                        </div>
                                </div>
                            
                        </div>
                 
                         </div>
               
           
           
       </div>
       </div>
 <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
	     <h2 class="mb font20 inline_block "><b> <img src="{{ asset('/backend/images/usergroup.png')}}"></i>Recent Members</b><button type="button" onclick="location.href='{{route('saved.events.index')}}'" class="btn btn-success pull-right ">View All</button></h2>
	     </div>
	<div class="row">
	     
		<div class="col-xs-2">
    		<div class="user">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                alt="">
				<h3 class="lead" align='center'>
					User name
				</h3>
			</div>
		</div>
        
        <div class="col-xs-2">
        	<div class="user">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                alt="">
				<h3 class="lead" align='center'>
					User name
				</h3>
			</div>
		</div>
        
        <div class="col-xs-2">
        	<div class="user">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                alt="">
				<h3 class="lead" align='center'>
					User name
				</h3>
			</div>
		</div>
        
        <div class="col-xs-2">
        	<div class="user">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                alt="">
				<h3 class="lead" align='center'>
					User name
				</h3>
			</div>
		</div>
        
        <div class="col-xs-2">
        	<div class="user">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                alt="">
				<h3 class="lead" align='center'>
					User name
				</h3>
			</div>
		</div>
        
       <div class="col-xs-2">
        	<div class="user">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                alt="">
				<h3 class="lead" align='center'>
					User name
				</h3>
			</div>
		</div>
        
        <div class="col-xs-2">
            <div class="user">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                alt="">
				<h3 class="lead" align='center'>
					User name
				</h3>
			</div>
		</div>
        
        <div class="col-xs-2">
            <div class="user">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                alt="">
				<h3 class="lead" align='center'>
					User name
				</h3>
			</div>
		</div>
        
               </div>
                        </div>
                    </div>
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