@extends('layouts.master')
@section('page_level_styles')
@yield('page_level_styles')
@stop
@php
use App\FamilyRole;
@endphp
@section('htmlheader')
<link rel="stylesheet" href="{{asset('user/css/bowseModal.css')}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/slick_theme.css') }}"/>
<script type="text/javascript"
            src="//code.jquery.com/jquery-1.9.1.js"> 
  </script> 
    <link rel="stylesheet" 
          type="text/css" 
          href="/css/result-light.css"> 
    
 <script type="text/javascript" 
            src= 
"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"> 
  </script> 
    <link rel="stylesheet" 
          type="text/css" 
          href= 
"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"> 
    <link rel="stylesheet"
          type="text/css" 
          href= 
"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> 

<style type="text/css">
    .top_header{
      padding-top: 20px !important;
      min-height: 80px !important;
    }
    body {
        font-family: "Poppins", sans-serif;
    }
    .navbar-default{
        background-color: transparent !important;
        background-image: none;
        border: 0;
        box-shadow: unset;
    }
    .topbar{
        padding-top: 68px !important;
    }
    .usr_pln_sec h5{
    font-size: 14px;
    padding: 8px 7px;
    }
    #new-section .container-fluid{
    width: 90%;
    max-width: 90%;
    margin-top: 50px;
    }
    #new-section .second-section{
    width: 40%;
    max-width: 40%;
    }
    #new-section .first-section,#new-section .third-section{
    flex: 0 0 30%;
    max-width: 30%;
    }
    .img-blog{
    width: 100%;
    object-fit: cover;
    height: 110px;
    padding: 10px;
    }
    .active-headline h1{
    font-weight: 600;
    padding-left: 10px;
    padding-top: 10px;
    color: #000;
    font-size: 18px;
    margin-top: 0px !important;
    }
    .nw_sb{
    float: right;
    padding: 0px;
    }
    .active-headline a{
    float: right;
    padding: 10px;
    }
    .blog-section b{
    font-weight: bold;
    color: #000;
    }
    .blog-section p{
    font-weight: normal;
    color: #000;
    padding-left: 10px;
    margin: 0px !important;
    }
    .img-event{
    width: 100%;
    object-fit: cover;
    height: 110px;
    padding: 10px;
    }
    .username-section a{
        padding: 3px;
        margin-top: 0px;
        font-size: 12px;
        color: #1976d2;
        font-weight: 500;
    }
    .username-section b{
      color: #000;
    }
    .pull-right ul li,.pull-left ul li{
        list-style: none;
        padding: 10px;
        color: #1976db;
        font-weight: 500;
        font-size: 14px;
    }
     .pull-right ul li span,.pull-left ul li span{
        padding-left: 10px;
     }
      .pull-right ul,.pull-left ul{
         padding-inline-start: 0;
     }
     .carousel-indicators li {
       margin-right: 5px;
       margin-left: 5px;
       background: #a3a3a3;

     }.carousel-indicators {
        bottom: -15px!important;
     }
     .carousel-indicators .active {
        background-color: #000;
        background: #707070;
     }
     .carousel-inner{
        height: 255px;
        overflow: hidden;
     }
     .carousel{
        width: 100%;
     }
     .carousel-control.left,.carousel-control.right{
       background-image: none;
     }
     
     .carousel-section img{
           width: 100%;
           height: 110px;
     }
     .carousel-section{
        padding: 10px;
        min-height: 230px;
        text-align: center;
     }
     .carousel-section .display-name {
        margin-top: 5px;
        color: #333 !important;
     }

     .carousel-section .user-group {
        color: #333 !important;
     }

     .subs_sec h1,.active-headline h1{
       margin-top: 0px;
     }
     #myCarousel .glyphicon {
        color:#000;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        border: 1px solid #000;
        padding: 7px;
     }
     .blog-section{
        margin-bottom: 20px;
     }
     .dash_header_img{
        padding-top: 11px;
     }
     .third-section .bttns a {
        padding: 6px 6px;
        font-size: 14px!important;
    }
    .likes-btn{
        margin: 0 auto;
        text-align: center;
        display: block;
        color: #26dad2;
        box-shadow: 0px 0px 2px #26dad2;
        width: 100px;
        padding: 4px;
        cursor: pointer;
    }
    .card-body {
        padding: 14px;
    }
    #urgentNotification-btn .btn {
        padding: 6px 5px;
        font-size: 12px;

    }

    .slick-dots li button:before {
        font-size: 40px !important;
    }
</style>
@endsection
@section('main-content')
<div id="new-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-12 first-section">
                <div class="card">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 norpd_mob" style="margin-bottom: 14px;">
                            <div class="active-headline ">
                                <div class="col-md-6">
                                    <img src="{{asset('uploads/'.$auth_user->profile_pic)}}" alt="user"
                                            class="img-circle" width="50">
                                    <span class="username-section">
                                      <b>{{$auth_user->displayname}}</b>
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <span>
                                        <p style="margin: 0 0 4px;">
                                            <a href="{{ url('profile/edit') }}" style="margin-right: -15px;">Edit Profile</a>

                                            <a href="{{ url('userprofile') }}/{{base64_encode(Auth::user()->id)}}">View Profile</a>
                                        </p>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-left">
                                <ul>
                                    <li> <a href="{{url('matchquests')}}"> <img src="{{asset('uploads/rocket.png')}}" alt="user" width="30">
                                        <span><b>Match Quest</b></span></a></li>
                                    <li><a href="{{url('chat')}}"><img src="{{asset('uploads/chat.png')}}" alt="user" width="30"> <span><b>Chat</b></span></a></li>
                                    <li><a href="{{url('adoptions')}}"><img src="{{asset('uploads/social.png')}}" alt="user" width="30"><span><b>Adoptions</b></span></a></li>
                                    <li><a href="#"><img src="{{asset('uploads/adaptive.png')}}" alt="user" width="30"><span><b>Tutorials</b></span></a></li>
                                    <li><a href="#"><img src="{{asset('uploads/social.png')}}" alt="user" width="30"><span><b>Support Center</b></span></a></li>
                                </ul>
                            </div>

                            <div class="pull-right">
                                 <ul>
                                    <li><a href="#" href="javascript:void(0)" data-toggle="modal" data-target="#uploadphotomodal"><img src="{{asset('uploads/images.png')}}" alt="user" width="30"><span><b>Upload Photos</b></span></a></li>
                                    <li><a href="{{url('trials')}}"><img src="{{asset('uploads/calendar.png')}}" alt="user" width="30"><span><b>Trail Dates</b></span></a></li>
                                    <li><a href="{{url('adoptions/certificates')}}"><img src="{{asset('uploads/page_quality.png')}}" alt="user" width="30"><span><b>Certificates</b></span></a></li>
                                    <li><a href="{{ route('edit.profile') }}"><img src="{{asset('uploads/verification-icon-71.png')}}" alt="user" width="30"><span><b>Get Verified</b></span></a></li>
                                    <li><a href="{{url('donate')}}"><img src="{{asset('uploads/donatem_icon.png')}}" alt="user" width="30"><span><b>Donate</b></span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                @if( isthisSubscribed() )
                <div class="modal fade" id="uploadphotomodal" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title font22">PHOTO UPLOAD</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center">You may upload 3 photos with your membership plan. Do not upload photos containing texts, nudity, nor 1st Life. Doing so will result in, account restriction or termination. For more information, please see our <a href="#" data-toggle="modal" data-target="#termsPopup">Terms</a> and <a href="#" data-toggle="modal" data-target="#policyPopup">Policy.</a></p>
                                <div class="error_sec"></div>
                                {!! Form::open([ 'route' => [ 'dropzone.uploadfile' ], 'files' => true, 'class' => 'dropzone','id'=>"image-upload"]) !!}
                                {!! Form::close() !!}

                                 <div class="row">  
                                      @if( count($photo_ulbum) > 0 )
                                      <div class="col-md-12 text-center mt20">
                                        <h5 class="text-center">Photos</h5>
                                      </div>
                                          @foreach($photo_ulbum as $key=>$row)
                                          <div class="col-md-4">
                                              <div class="grid-item">
                                                    <a href="javascript:void(0)" class="deleteProduct" data-id="{{ $row->id }}" data-token="{{ csrf_token() }}" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    <img src="{{ asset('/uploads/'.$row->image)}}" />
                                              </div>
                                          </div>
                                          @endforeach
                                      @endif
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>

                  <!-- term Modal -->
                  <div id="termsPopup" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Terms</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            {!!$termContent?$termContent->content:'Content Here'  !!}
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>

                    </div>
                  </div>

                  <!-- Policy Modal -->
                  <div id="policyPopup" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Privacy Policy</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            {!!$policyContent?$policyContent->content:'Content Here'  !!}
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif

                <div class="card">
                    <div class="row">
                        <div class="col-xs-6 col-md-6 norpd_mob">
                            <div class="active-headline ">
                                <h1> Popular Blogs</h1>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <div class="active-headline nw_sb"><a href="{{url('blog')}}"><b>View More</b></a></div>
                        </div>
                    </div>
                    @if (count($blog) > 0)
                    <div class="row">
                        @foreach($blog as $_blog)
                        <div class="col-sm-6 blog-section">
                            <!--   <img src="{{asset('uploads/default.png')}}" alt="blog" class="img-responsive img-blog"> -->
                            @foreach(json_decode($_blog->image) as $img)@endforeach
                            <a href="{{route('blogview', $_blog->id )}}">  <img  src="{{ asset('/uploads/'.$img)}}" class="blog_img img-blog" title="blog">
                            <p><b>{{ substr($_blog->title ,0,38)}}</b></p></a>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="row">
                        <p>No blog posts yet!</p>
                    </div>
                    @endif
                    @if($auth_user->role->role=='Blogger')
                    <div class="row">
                        <a href="{{ url('bloggerAdd') }}" style="margin:0 auto;" class="btn bren_btn">CREATE POST</a>
                    </div>
                    @endif
                </div>
                <div class="adsimgsec ads_240_400_size ptb10 home_right_img">
                    <img src="/images/970x250.png" alt="user" >
                </div>
                <div class="card">
                    <div class="row">
                        <div class="col-xs-6 col-md-6 norpd_mob">
                            <div class="active-headline ">
                                <h1> Upcoming Events</h1>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <div class="active-headline nw_sb"><a href="{{url('events')}}"><b>View More</b></a></div>
                        </div>
                    </div>
                    @if(count($events) > 0)
                    <div class="row">
                        @foreach($events as $event)
                        @php
                        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->date);
                        $day = date('D', strtotime($to));
                        $dayNumceric = date('d', strtotime($to));
                        $month = date('M', strtotime($to));
                        $time = date('h:i A', strtotime($event->date));
                        $mytime = \Carbon\Carbon::now(); // today
                        //echo $event->date;
                        @endphp
                        <div class="col-sm-6 blog-section">
                            @foreach(json_decode($_blog->image) as $img)@endforeach
                            @if(!empty($event->image))
                            <a class="save_event" href="{{url('event/'.$event->id)}}">  <img class="img_sec img-event" 
                                src="{{ asset('/images/events/'.$event->image)}}">
                            @else
                            <img class="img_sec img-blog" 
                                src="{{ asset('frontendevents/assets/demo-data/a1.jpg')}}">
                            @endif
                            <p><b> {{ $event->title}}</b></p></a>
                            <p>{{ $day }}, {{ $month }} {{ $dayNumceric }} , {{$time}}</p>
                        
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="row">
                        <p>No Events added yet!</p>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6 second-section">
               <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-6 col-md-6 norpd_mob">
                                <div class="subs_sec ">
                                   <p>People You May Like</p>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-6">
                                <div class="subs_sec nw_sb"><a href="{{ url('browse')}}" class="btn btn-success">
                                    Browse</a>
                                </div>
                            </div>
                          </div>
                                 <div class="row">
                            <!-- bootstrap card with row name myCarousel as row 1-->
                            <div class="carousel slide" id="myCarousel" style="display: none;">
                                  <?php 
                                  $output = '';
                                  $class = 'item';
                                  ?>
                                    @foreach($newusers as $k => $activeusersnew)
                                    <?php 
                                    $active = ($k == 0) ? " active" : ""; 
                                    ?>

                                        <div class="carousel-section">
                                            <a href="{{route('viewprofile', base64_encode($activeusersnew->id ))}}">
                                                <img  src="{{ asset('/uploads/'.$activeusersnew->profile_pic)}}" title="blog"> 
                                                <p class="display-name"><b>{{$activeusersnew->displayname}}</b></p>
                                            </a>
                                            <div class="text">
                                                <p class="user-group">
                                                    @if($activeusersnew->group)
                                                        {{ @$activeusersnew->usergender->title }},  {{$activeusersnew->usergroup->title}}
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="likes-btn" data-user="{{ base64_encode($activeusersnew->id) }}"><i aria-hidden="true" class="fa fa-thumbs-o-up"></i> <span>LIKE</span></div>
                                            <input type="hidden" id="auth_id" value="{{base64_encode(Auth::user()->id)}}">
                                        </div>
                                    @endforeach
                            </div>  
                          </div>
                        </div>
                  </div>
                     <div class="card pd_lft usr_dashboard_notfn_sec">
                         <div class=" notify_head ">
                             <h1 class="text-themecolor"><i class="mdi mdi-bell"></i>Notifications</h1>
                         </div>


                         @if(@$allAdoptionRequest)
                         @foreach(@$allAdoptionRequest as $accepted)

                         <div class="alert alert-info alert-dismissible">
                             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                             <div class=" d-flex flex-row">
                                 <div class="col-md-12 disInline">-

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
                                         $heShe = 'she';
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
                                         $heShe = 'she';
                                         else {
                                         $heShe = 'He';
                                         }
                                         }
                                         }else{
                                         $heShe = 'He/She';
                                         }
                                         }


                                         $adopter_family_role = FamilyRole::find($accepted->trial_family_role)->title;
                                         $adopter_family_gender = (FamilyRole::find($accepted->trial_family_role)->gender == 'female') ? "she" : "he" ;
                                         $adoptee_family_role = FamilyRole::find($accepted->adoptee_family_role)->title;
                                         $adoptee_family_gender = (FamilyRole::find($accepted->adoptee_family_role)->gender == 'female')? "she" : "he";


                                         if(Auth::user()->id != $accepted->adopted_by && $accepted->user_id != $accepted->adopted_by){

                                         $reciverUrl = url("userprofile").'/'.base64_encode($accepted->matcher_id);
                                         $reciverName = $accepted->matcherid->display_name_on_pages;
                                         $reciverLink = '<a href="'.$reciverUrl.'">'.$reciverName.'</a>';
                                         $adopt_message_accept = "By signing this certificate, you promise to give ".$reciverLink." all of the love and care that ".$adoptee_family_gender." require in return, your ".$adoptee_family_role." will give you all the love, comfort and attention you need. Failure to meet adoption requirements herein, may result in dissolution. ";
                                         }else{

                                         $reciverUrl = url("userprofile").'/'.base64_encode($accepted->user_id);
                                         $reciverName = $accepted->userid->display_name_on_pages;
                                         $reciverLink = '<a href="'.$reciverUrl.'">'.$reciverName.'</a>';
                                         $adopt_message_accept = "By signing this certificate, you promise to give ".$reciverLink." all of the love and care that ".$adopter_family_gender." require in return, your ".$adopter_family_role." will give you all the love, comfort and attention you need. Failure to meet adoption requirements herein, may result in dissolution. ";
                                         }



                                         @endphp
                                         <h6><b>{{ $displaynameUser }}</b> Sent
                                             you an Adoption Request.</h6>
                                     </div>
                                     <div class="col-md-5 fltlft" id="urgentNotification-btn" style="float: left">
                                         {{-- <a href="{{ route('adoptions.accept', $accepted->id) }}"
                                         class="btn btn-success">Accept</a> --}}
                                         <a class="btn btn-success" data-toggle="modal" id="btnModal{{$accepted->id}}" data-target="#acceptRequestBtn{{$accepted->id}}"> Accept</a>
                                         <a href="{{ route('adoptions.decline', $accepted->id) }}" class="btn btn-danger">Decline</a>

                                     </div>

                                     {{-- START MODAL CODE HERE  --}}
                                     <div class="modal fade" id="acceptRequestBtn{{$accepted->id}}" role="dialog">
                                         <div class="modal-dialog adptreq">
                                             <div class="modal-content">
                                                 <!-- Modal Header -->
                                                 <div class="modal-header align-items-center">
                                                     <h4 class="modal-title" id="myModalLabel">Adopt Accept Request</h4>
                                                     <button type="button" class="close" data-dismiss="modal">
                                                         <span aria-hidden="true">&times;</span>
                                                         <span class="sr-only">Close</span>
                                                     </button>
                                                 </div>

                                                 <!-- Modal Body -->
                                                 <div class="modal-body">
                                                     <p class="statusMsg"></p>
                                                     <form class="form-horizontal form_common submitAdoptForm" id="submitAdoptForm" role="form" name="submitAdoptForm" method="POST">
                                                         <input type="hidden" name="trial" value="{{ $accepted->id }}" id="trial" />


                                                         <div class="row">
                                                             <div class="form-group d-flex">
                                                                 <div class="col-md-1">
                                                                     <input type="checkbox" class="form-control checkbox" id="agree" name="agree">
                                                                 </div>
                                                                 <div class="col-md-11 terms">
                                                                     <p>{!! @$adopt_message_accept !!}</p>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                         <p class="checkmsg"></p>
                                                         <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                         <button type="button" class="btn btn-primary acceptBtn" id="acceptBtn">Yes, Please</button>
                                                     </form>
                                                 </div>
                                             </div>

                                         </div>
                                         {{-- END MODAL CODE HERE  --}}
                                     </div>
                                 </div>
                             </div>
                         </div>

                         @endforeach
                         @endif




                         @if($checkTrial != null || count($allaccepted) > 0)
                         <div class="TrialLocationSection">
                             @if($checkTrial)
                             @if( Auth::user()->id == $checkTrial->matcher_id || Auth::user()->id == $checkTrial->user_id )

                             <div class="alert alert-info alert-dismissible">
                                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                 <div class=" d-flex flex-row">
                                     <div class="bdy_area">
                                         <h6><b>{{ @$checkTrial->userid->display_name_on_pages }}</b> &
                                             <b>{{ @$checkTrial->matcherid->display_name_on_pages }}</b>, you
                                             are both on trial with
                                             each other</h6>
                                     </div>
                                 </div>
                             </div>
                             @endif
                             @endif






                             @if($allaccepted)
                             @foreach($allaccepted as $accepted)
                             @if( Auth::user()->id == $accepted->matcher_id )

                             <div class="alert alert-info alert-dismissible">
                                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                 <div class=" d-flex flex-row">
                                     <div class="row">
                                         <div class="col-md-7">
                                             @php
                                             $getFamilyRoleInfo = FamilyRole::find($accepted->trial_family_role);
                                             if($accepted->userid->gender)
                                             {
                                             if($accepted->userid->usergender)
                                             {
                                             if($accepted->userid->usergender->gender=='female')
                                             $heShe = 'she';
                                             else {
                                             $heShe = 'He';
                                             }
                                             }
                                             }else{
                                             $heShe = 'He/She';
                                             }
                                             @endphp
                                             <h6><b>{{ $accepted->userid->display_name_on_pages }}</b> Sent
                                                 you a Trial Request. {{$heShe}} will attend the trial date as your <b>"{{$getFamilyRoleInfo->title}}"</b>.</h6>
                                         </div>
                                         <div class="col-md-5" id="urgentNotification-btn">
                                             <a href="{{ route('trials.accept', $accepted->id) }}" class="btn btn-success">Accept</a>
                                             <a href="{{ route('trials.decline', $accepted->id) }}" class="btn btn-danger">Decline</a>
                                             <a href="{{ route('trials.maybe', $accepted->id) }}" class="btn btn-info">May be</a>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             @endif
                             @endforeach
                             @endif
                         </div>
                         @endif

                
                    @php
                    $notifications = getUserDashboardNotification();
                    @endphp
                
                    <div class="notf_list">
                       <div class="notfsec1">
                          @if( $notifications )
                              @foreach( $notifications as $notification )
                                  @php
                                      $userdata = \App\User::find($notification->created_by);
                                  @endphp
                                  <div class=" d-flex flex-row">
                                      <div class="img_cr">
                                          @if($userdata)
                                              <a href="{{route('viewprofile', base64_encode( $userdata->id ))}}">
                                                  <img src="{{$userdata->profile_pic_url}}"
                                                       alt="user"
                                                       class="img-circle" width="100">
                                              </a>
                                          @else
                                              <img src="http://laravel.avdopt.com/uploads/default.png"
                                                   alt="user"
                                                   class="img-circle" width="100">
                                          @endif
                                      </div>
                                      <div class="p-l-20 bdy_area">
                                          @if($userdata)
                                              <h6 class="font-medium mr_btm">
                                                {!! $notification->message !!}
                                              </h6>
                                          @else
                                              <h6 class="font-medium mr_btm"> {!! $notification->message !!}</h6>
                                          @endif
                                          <p>{{$notification->created_at->diffForHumans()}}</p>
                                      </div>
                                  </div>
                              @endforeach
                          @else
                          @endif
                          </div>
                    </div>
                    <div class="chckallnotsec">
                        <a href="{{url('all-notifications')}}" class="btn btn-success chckallnt_btn">Check All Notifications</a>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-6 col-md-6 norpd_mob">
                                <div class="subs_sec ">
                                    <h1><img
                                        src="{{ asset('frontend/images/heartsicon_match_black.png')}}" class="heart_blksec_img"> My Matches</h1>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-6">
                                <div class="subs_sec nw_sb"><a href="{{ url('mymatches')}}" class="btn btn-success">
                                    My Matches</a>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12 sucessmessage"></div>
                            @if( $matches->count() >0 )
                            @foreach( $matches as $match )
                            @php
                            $userid = $match->user_id;
                            if( $match->user_id == Auth::user()->id ){
                            $userid = $match->matcher_id;
                            }
                            $getFamilyRoleInfo = \App\UsersFamilyRole::where('user_id', $userid)->pluck('family_role_id')->toArray();
                            if (count($getFamilyRoleInfo) > 0) {
                            $familyroles = \App\FamilyRole::whereIn('id', $getFamilyRoleInfo)->get();
                            } else {
                            $familyroles = \App\FamilyRole::all();
                            }
                            // check Request sent or not
                            $checkReq = \App\Trials::WhereRaw('( (user_id = ' . Auth::user()->id . ' && matcher_id = ' . $userid . ' ) OR (user_id = ' . $userid . ' && matcher_id = ' . Auth::user()->id . ' ))')->get()->first();
                            if($checkReq){
                            $adopter_family_role = FamilyRole::find($checkReq->trial_family_role)->title;
                            $adopter_family_gender = (FamilyRole::find($checkReq->trial_family_role)->gender == 'female')  ? "she" : "he" ;
                            $adoptee_family_role = FamilyRole::find($checkReq->adoptee_family_role)->title;
                            $adoptee_family_gender = (FamilyRole::find($checkReq->adoptee_family_role)->gender == 'female')? "she" : "he";
                            if(Auth::user()->id != $checkReq->user_id){
                            $reciverUrl = url("userprofile").'/'.base64_encode($checkReq->user_id);
                            $reciverName = $checkReq->userid->display_name_on_pages;
                            $reciverLink = '<a href="'.$reciverUrl.'">'.$reciverName.'</a>';
                            $adopt_message = "By signing this certificate, you promise to give ".$reciverLink." all of the love and care that ".$adoptee_family_gender."  require in return, your ".$adoptee_family_role." will give you all the love, comfort and attention you need. Failure to meet adoption requirements herein, may result in dissolution. ";
                            }else{
                            $reciverUrl = url("userprofile").'/'.base64_encode($checkReq->matcher_id);
                            $reciverName = $checkReq->matcherid->display_name_on_pages;
                            $reciverLink = '<a href="'.$reciverUrl.'">'.$reciverName.'</a>';
                            $adopt_message = "By signing this certificate, you promise to give ".$reciverLink." all of the love and care that ".$adopter_family_gender." require in return, your ".$adopter_family_role." will give you all the love, comfort and attention you need. Failure to meet adoption requirements herein, may result in dissolution. ";
                            }
                            }
                            $userdata = \App\User::find($userid);
                            @endphp
                            @if( $userdata )
                            <div class="col-xs-12 col-md-3">
                                <div class="match_img">
                                    <a href="{{route('viewprofile', base64_encode( $userdata->id ))}}"
                                        style="color: #445a65">
                                    <img src="{{ $userdata->profile_pic_url }}" alt="user"
                                        class="img-circle" width="100">
                                    @if( $userdata->is_online)
                                    <span class="green"></span>
                                    @endif
                                    <span class="active_childnm">{{ ucfirst( $userdata->display_name_on_pages ) }}</span>
                                    @if ($checkReq)
                                    @if ($checkReq->is_success == 1  && $checkReq->adoption_success != 1 )
                                    <a class="btn btn-success btn-lg" data-toggle="modal" id="btnModal{{$checkReq->id}}" data-target="#sendRequestBtn{{$checkReq->id}}"> Adopt </a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="sendRequestBtn{{$checkReq->id}}" role="dialog">
                                        <div class="modal-dialog adptreq">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header align-items-center">
                                                    <h4 class="modal-title" id="myModalLabel">Adopt Request</h4>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                    <span aria-hidden="true">&times;</span>
                                                    <span class="sr-only">Close</span>
                                                    </button>
                                                </div>
                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <p class="statusMsg"></p>
                                                    <form class="form-horizontal form_common submitAdoptForm" id="submitAdoptForm" role="form" name="submitAdoptForm" method="POST">
                                                        <input type="hidden" name="trial" value="{{ $checkReq->id }}" id="trial"/>
                                                        <div class="row">
                                                            <div class="form-group d-flex">
                                                                <div class="col-md-1">
                                                                    <input type="checkbox" class="form-control checkbox" id="agree" name="agree">
                                                                </div>
                                                                <div class="col-md-11 terms">
                                                                    <p>{!! @$adopt_message !!}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                        <button type="button" class="btn btn-primary submitBtn" id="submit">Yes, Please</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    @endif
                                    @else
                                    <a class="btn btn-success" href="{{url('schedule')}}/{{base64_encode($userid)}}"> Trial Date</a>
                                    @endif
                                    </a>
                                </div>
                            </div>
                            @else
                            <div class="col-xs-12 col-md-3">
                                <div class="match_img">
                                    <img src="{{asset('uploads/default.png')}}" alt="user"
                                        class="img-circle" width="100">
                                    <span>unknown</span>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            @else
                            <div class="col-md-12 text-center">
                                You have no matches as yet.
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                    
                <div class="col-md-12 banner home_dash_ban">
                    <img src="http://laravel.avdopt.com/images/728x90.png" class="">
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-6 col-md-6 norpd_mob">
                                <div class="subs_sec ">
                                    <h1><i class="fa fa-thumbs-up" aria-hidden="true"></i>My
                                        Likes
                                    </h1>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-6">
                                <div class="subs_sec nw_sb"><a href="{{ url('mylikes')}}" class="btn btn-success">
                                    My Likes</a>
                                </div>
                            </div>
                            @if( $likes->count() >0 )
                            @foreach( $likes as $like )
                            @php
                            $userdata = \App\User::find($like->liked_by);
                            @endphp
                            @if( $userdata )
                            <div class="col-xs-12 col-md-3">
                                <div class="match_img">
                                    <a href="{{route('viewprofile', base64_encode( $userdata->id ))}}"
                                        style="color: #445a65">
                                    <img src="{{ $userdata->profile_pic_url }}" alt="user"
                                        class="img-circle" width="100">
                                    @if( $userdata->is_online)
                                    <span class="green"></span>
                                    @endif
                                    <span>{{ ucfirst( $userdata->display_name_on_pages ) }}</span>
                                    </a>
                                </div>
                            </div>
                            @else
                            <div class="col-xs-12 col-md-3">
                                <div class="match_img">
                                    <img src="{{asset('uploads/default.png')}}" alt="user"
                                        class="img-circle" width="100">
                                    <span>unknown</span>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            @else
                            <div class="col-md-12 text-center">
                                You have no likes as yet.
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-6 col-md-6 norpd_mob">
                                <div class="subs_sec ">
                                    <h1><i class="fa fa-user" aria-hidden="true"></i> Profile
                                        Visitors
                                    </h1>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-6">
                                <div class="subs_sec nw_sb"><a href="{{url('visitors')}}" class="btn btn-success">View</a></div>
                            </div>
                            @if( $visitors->count() >0 )
                            @foreach( $visitors as $visitor )
                            @php
                            $userdata = \App\User::find($visitor->visitor_id);
                            @endphp
                            @if( $userdata )
                            <div class="col-xs-12 col-md-3">
                                <div class="match_img">
                                    <a href="{{route('viewprofile', base64_encode( $userdata->id ))}}"
                                        style="color: #445a65">
                                    <img src="{{ $userdata->profile_pic_url  }}" alt="user"
                                        class="img-circle" width="100">
                                    @if( $userdata->is_online)
                                    <span class="green"></span>
                                    @endif
                                    <span>{{ ucfirst( $userdata->display_name_on_pages ) }}</span>
                                    </a>
                                </div>
                            </div>
                            @else
                            <div class="col-xs-12 col-md-3">
                                <div class="match_img">
                                    <img src="{{asset('uploads/default.png')}}" alt="user"
                                        class="img-circle" width="100">
                                    <span>unknown</span>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            @else
                            <div class="col-md-12 text-center">
                                You have no profile visitors as yet.
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 third-section">
                <div class="card wlt_sec">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 pr0" style="position:relative;">
                                <div class="round align-self-center round-success walt_sec"><i
                                    class="ti-wallet"></i></div>
                                
                                <div style="margin-left: 10px;position: absolute;top: 18%;left:30%;" class="m-l-10 align-self-center walt_info">
                                    <h5 style="font-size:12px; margin-top: 0px; margin-bottom: 5px;" class="text-muted m-b-0">WALLET BALANCE</h5>
                                    <h5 class="m-b-0" style="font-size: 1.4rem; margin: 0px;">@if(Auth::user()->balance)<b>{{  Auth::user()->balance }}</b> @else
                                        0 @endif Tokens
                                    </h5>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="bttns mt_mob">
                                    <a href="{{url('wallet/credit')}}" class="btn btn-success bro1">Deposit</a>
                                    <a href="{{url('wallet')}}" class="btn btn-success bro">My wallet</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                $currentPlan=getCurrentUserPlan();
                @endphp
                <div class="card cplan_sec">
                    <div class="card-body">
                        <div class="d-flex flex-row align-items-center usr_pln_sec">
                            <div class="col-xs-4 col-md-3 nopd_mob">
                                <h5 class="text-muted m-b-0 myplansec"><span>MY PLAN</span></h5>
                            </div>
                            <div class="col-xs-8 col-md-6 nopd_mob plnttl pdr0 text-center">
                                <h5 class="text-muted m-b-0">{{!empty($currentPlan)?$currentPlan->name:'Upgrade '}}</h5>
                            </div>
                            <div class="col-xs-12 col-md-3 text-right nopd_mob pdr0">
                                <div class="bttns">
                                    <a class="btn btn-success"
                                        href="{{url('pricing')}}">{{!empty($currentPlan) && $currentPlan->name=='Free'?'Upgrade':'Manage'}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="align-self-center mt-3">
                            <p>There's power in premium! Access advanced search, chat features, visibility, 24/7 support, and more. </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row feat_mem_sec">
                            <div class="col-md-6">
                                <div class="subs_sec new_sb ">
                                    <h5><i class="fa fa-user" aria-hidden="true"></i>
                                        Featured Members
                                    </h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="subs_sec shrt_sb"><span>Want to stand out from the crowd?</span></div>
                            </div>
                            <div class="col-md-12">
                                <div class="pra_sec">
                                    <P>There's absolutely nothing wrong with being different! Discover what makes our members all unique...</P>
                                    <a data-toggle="modal" data-target="#feeaturePlanModal"
                                        class="btn bren_btn"> Get Featured
                                    </a>
                                </div>
                            </div>
                            @php
                            $featuredUsers = getSubscribedFeatureUsers();
                            @endphp
                            @if($featuredUsers)
                            @foreach($featuredUsers as $featuredUser)
                            @php
                            $profilepic = ( $featuredUser->user->profile_pic )? 'uploads/'.$featuredUser->user->profile_pic : 'images/default.png';
                            @endphp
                            <a href="{{ url('userprofile')}}/{{ base64_encode($featuredUser->user->id) }}"></a>
                            <div class="col-md-4">
                                <div class="match_img">
                                    <a href="{{ url('userprofile')}}/{{ base64_encode($featuredUser->user->id)}}">
                                    <img src="{{ asset($profilepic) }}" alt="user" class="img-circle"
                                        width="100">
                                    @if($featuredUser->user->is_online )
                                    <span class="green"></span>
                                    @endif
                                    </a>
                                </div>
                            </div>
                            </a>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="adsimgsec ads_240_400_size ptb10 home_right_img">
                    <img src="/images/970x250.png" alt="user" >
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-6 col-md-6 norpd_mob">
                                <div class="subs_sec ">
                                    <h1><i class="fa fa-user" aria-hidden="true"></i> Active Members</h1>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-6">
                                <div class="subs_sec nw_sb"><a href="{{route('browse')}}" class="btn btn-success"><b>Browse Members</b></a></div>
                            </div>
                        </div>
                        <div class="row">
                            <?php //echo '<pre>';print_r($activeusers);die;?>
                            @if(count($activeusers)>=1)
                            @foreach( $activeusers as $activeuser )
                            <div class="col-xs-12 col-md-3">
                                <a href="{{route('viewprofile', base64_encode( $activeuser->id ))}}">
                                    <div class="user_active">
                                        <img class="profile-img" src="{{ $activeuser->profile_pic_url }}"
                                            alt="">
                                        @if( $activeuser->is_online)
                                            <span class="green" style="left: 90px;"></span>
                                        @endif
                                    </div>
                                </a>
                            </div>
                            @endforeach
                            @else
                            <div class="col-md-12 text-center">
                                You have no active members.
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="adsimgsec ads_240_400_size ptb10 home_right_img">
                    <img src="/images/970x250.png" alt="user" >
                </div>
            </div>
            </div>

        </div>
    </div>
</div>
</div>

        <!-- --------------Featured Members popup----------------- -->
        <!-- Modal -->
        <div class="featuredmembers_img">
            <div class="modal fade" id="feeaturePlanModal" tabindex="-1" role="dialog"
                 aria-labelledby="feeaturePlanModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" style="max-width: inherit" role="document">
                    <div class="modal-content featured_popup">
                        <div class="modal-header padding0">
                            <h5 class="modal-title" id="feeaturePlanModalLabel">
                                <img class="img-responsive" alt=""
                                     src="{{asset('frontend/images/flame.png')}}"><span class="mdlttl">GET FEATURED</span></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>The first part of standing out is getting noticed. Even before visitors see your profile
                                and activity, they see you. Studies show that featured profiles are nine times
                                more likely to be viewed.</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ url('featured-members')}}" class="btn btn-md featmembtn">View Featured Members</a>
                                </div>
                            </div>
                            <div class="scheme_box">
                                @php
                                    $tokenamount = getWebsiteSettingsByKey('token_amount');
                                    $featuredPlans = getFeaturedPlans();
                                    if(Auth::check())
                                        $subscription = App\Subscription::where('user_id', Auth::user()->id)->where('name', 'feature')->first();
                                @endphp
                                @if(!empty($featuredPlans))
                                    <div class="">
                                        @foreach($featuredPlans as $featuredPlan)
                                            <div class="col-sm-12 col-md-6 ">
                                                <div class="basic">
                                                    <div class="left">
                                                        <h3 class="fontclr">{{ @$featuredPlan->name }}</h3>
                                                    </div>
                                                    <div class="right">
                                                        <h5>{{ @$featuredPlan->tokens }} Tokens</h5>
                                                    </div>
                                                    <div class="feat_infop"><p class=" mtop20">{!! $featuredPlan->info !!}</p></div>
                                                    @if( $subscription )
                                                        @php
                                                            $user = App\User::find(Auth::user()->id);
                                                        @endphp
                                                        @if( $subscription->stripe_plan == $featuredPlan->plan_id && $user->subscribed('feature') && ( !$user->subscription('feature')->onGracePeriod() ) )
                                                            <form class="form-horizontal get-featured-member-form" role="form" method="POST"
                                                                  action="{{ url('/')}}/subscription/featurecancel">
                                                                @csrf
                                                                <input type="hidden" name="chargeId"
                                                                       value="{{ $featuredPlan->plan_id }}">
                                                                <input type="hidden" class="featuredPlan-tokens" value="{{ @$featuredPlan->tokens }}">
                                                                <button type="submit"
                                                                        onclick="return confirm('Are you sure you want to cancel this plan?')"
                                                                        class="mtop10 mb popbtn"><span>Cancel</span>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form class="form-horizontal get-featured-member-formget-featured-member-form" role="form" method="POST"
                                                                  action="{{ url('/')}}/subscription/checkout">
                                                                @csrf
                                                                <input type="hidden" name="chargeId"
                                                                       value="{{ $featuredPlan->plan_id }}">
                                                                <input type="hidden" class="featuredPlan-tokens" value="{{ @$featuredPlan->tokens }}">
                                                                <button type="submit"
                                                                        onclick="return confirm('Are you sure you want to upgrade this plan?')"
                                                                        class="mtop10 mb popbtn"><span>Buy Now</span>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @else
                                                        <form class="form-horizontal get-featured-member-form" role="form" method="POST"
                                                              action="{{ url('/')}}/subscription/checkout">
                                                            @csrf
                                                            <input type="hidden" class="featuredPlan-tokens" value="{{ @$featuredPlan->tokens }}">
                                                            <button type="submit" class="mtop10 mb"><span>Buy</span>
                                                            </button>
                                                            <input type="hidden" name="chargeId"
                                                                   value="{{ $featuredPlan->plan_id }}">
                                                            <div class="hidescript">
                                                            <!--<script
                                                                        src="https://checkout.stripe.com/checkout.js"
                                                                        class="stripe-button"
                                                                        data-key="{{ env('STRIPE_KEY') }}"
                                                                        data-amount="{{ ( $tokenamount )? $featuredPlan->tokens * ( $tokenamount * 100 ): $featuredPlan->tokens * 100 }}"
                                                                        data-name="{{ $featuredPlan->name }}"
                                                                        data-description="Feature Profile charge"
                                                                        data-image="{{url('/')}}/backend/images/logo.jpg"
                                                                        data-locale="auto">
                                                                </script>-->
                                                            </div>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="col-md-12">
                                        <h4 class="alert alert-info"> Please Contact with admin to get featured
                                            plans </h4>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- --------------End Featured Members popup----------------- -->
@endsection
@section('footer')
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.js"></script>
<script src="{{ asset('backend/js/profile.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/slick.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/notify.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
      var user_wallet_balance = "{{ Auth::user()->balance }}";
      user_wallet_balance = parseInt(user_wallet_balance);
      var parcel_page = "{{ route('parcel.index') }}";
      $(".get-featured-member-form").submit(function (e){
        if(user_wallet_balance < $(this).find(".featuredPlan-tokens").val()){
          e.preventDefault();
          window.location.href = parcel_page;
        }
      });
        /*ACCEPT MODAL SUBMIT HANDLER STARTS HERE*/
          $("button#acceptBtn").click(function(e){
    
            var id = $(this).parentsUntil('.modal-body').find('#trial').val();
    
            e.preventDefault();
              var agree = 0;
              if ($('#agree').is(":checked"))
              {
                agree = 1;
              }
              // var id =$("#trial").val();
    
              if(agree == 1){
    
                    $.ajax({
                        method: "POST",
                        url: "{{url('ajaxrequest/adopt-request-accept')}}",
                        data: {
                            // adoptee_family_role: $("#adoptee_family_role").val(),
                            agree: agree,
                            trial: id,
                            _token: "{{csrf_token()}}"
                        },
                    })
                    .done(function( data ) {
                    console.log(data);
                    if(data.status == 200){
    
                        // $("#btnModal"+id).remove();
                        $(".sucessmessage").empty();
                        $("#acceptRequestBtn"+id+" .modal-body form").empty();
                        $("#acceptRequestBtn"+id+" .modal-body .statusMsg .failure").remove();
                        $("#acceptRequestBtn"+id+" .modal-body .statusMsg").append("<h5 class='success'><i class='fa fa-check'> </i> "+data.message+"</h5>");
                        // $(".sucessmessage").html("<h5 class='success'><i class='fa fa-check'> </i> "+data.message+"</h5>");
                        // $("#sendRequestBtn .modal-footer").empty();
    
                        setInterval(function(){ $('#acceptRequestBtn'+id).modal('toggle');  location.reload();}, 2000);
                        //
                    }else if(data.status == 400){
                        $("#acceptRequestBtn"+id+" .modal-body .statusMsg .failure").remove();
                        $("#acceptRequestBtn"+id+" .modal-body .statusMsg").append("<p class='failure'> "+data.message+"</p>");
                        $("#acceptRequestBtn"+id+" .modal-footer").empty();
                    }else{
                        $("#acceptRequestBtn"+id+" .modal-body").html("<h5 class='failure'><i class='fa fa-check'> </i> "+data.message+"</h5>");
                        $("#acceptRequestBtn"+id+" .modal-footer").empty();
                    }
    
                });
            }else{
                $("#acceptRequestBtn"+id+" .modal-body .checkmsg .failure").remove();
                $("#acceptRequestBtn"+id+" .modal-body .checkmsg").append("<p class='failure'> Please check Terms & confitions</p>");
                $("#acceptRequestBtn"+id+" .modal-footer").empty();
            }
        });
        /*ACCEPT MODAL SUBMIT HANDLER ENDS HERE*/
    
      $("button#submit").click(function(e){
        e.preventDefault();
          var agree = 0;
          if ($('#agree').is(":checked"))
          {
            agree = 1;
          }
          var id =$("#trial").val();
          $.ajax({
              method: "POST",
              url: "{{url('ajaxrequest/adopt-request')}}",
              data: {
                  // adoptee_family_role: $("#adoptee_family_role").val(),
                  agree: agree,
                  trial: $("#trial").val(),
                  _token: "{{csrf_token()}}"
              },
          })
          .done(function( data ) {
          console.log(data);
          if(data.status == 200){
              $("#btnModal"+id).remove();
              $(".sucessmessage").empty();
              $(".sucessmessage").html("<h5 class='success'><i class='fa fa-check'> </i> "+data.message+"</h5>");
              // $("#sendRequestBtn .modal-footer").empty();
                $('#sendRequestBtn'+id).modal('toggle');
              setInterval(function(){  $("#sendRequestBtn"+id).remove(); }, 1000);
              //
          }else if(data.status == 400){
              $("#sendRequestBtn"+id+" .modal-body .terms .failure").remove();
              $("#sendRequestBtn"+id+" .modal-body .terms").append("<p class='failure'> "+data.message+"</p>");
              $("#sendRequestBtn"+id+" .modal-footer").empty();
          }else{
              $("#sendRequestBtn"+id+" .modal-body").html("<h5 class='failure'><i class='fa fa-check'> </i> "+data.message+"</h5>");
              $("#sendRequestBtn"+id+" .modal-footer").empty();
          }
        //location.reload();
      });
    });
    
    $(".warningmessages").click(function () {
        var closeid = $(this).attr("close-id");
        var token = $("#token").val();
        var user_id = $("#token").attr("data-id");
        $.ajax(
        {
          url: "profile/removewarning/delete/" + closeid,
          method: 'post',
          dataType: "JSON",
          data: {
            "closeid": closeid,
            "_token": token
          },
          success: function () {
            console.log("It works");
          }
        });
      });
    });
</script>
<script type="text/javascript">
        $(document).ready(function() {
          $('#myCarousel').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            dots: true,
            arrows: false,
          });
          
          $('#myCarousel').show();
        });
      </script>
<script type="text/javascript">
    $(document).ready(function(){
    $(".deleteProduct").click(function(){
        var nowclass = $(this).parents('.grid-item');
            var id = $(this).attr("data-id");
            var token = $(this).attr("data-token");
            $.ajax(
            {
                url: "{{url('userprofile/album/delete')}}/"+id,
                method: 'post',
                dataType: "JSON",
                data: {
                    "id": id,
                    "_token": token
                },
                success: function (result)
                {
                    console.log("It works");
                    nowclass.remove();
                    if(result.status == true)
                    {
                        location.reload();
                    }
                }
            });
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#profile-img-tag').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#avatarFile").change(function(){
            readURL(this);
        });
    });
    var $grid = $('.grid').isotope({
      itemSelector: '.grid-item',
      columnWidth: 160,
      gutter: 20,
      percentPosition: true,
      masonry: {
        columnWidth: '.grid-sizer'
      }
    });
</script>
<script type="text/javascript"> 
        $(window).load(function() { 
            $(".likes-btn").click(function() {
                var user_id = $(this).data('user');
                var auth_id = $('#auth_id').val();
                if (auth_id != user_id) {
                    $.ajax(
                    {
                        url: window.Laravel.url + '/ajaxrequest/like',
                        type: 'POST',
                        data: {'_token': window.Laravel.csrfToken, 'user': user_id},
                        dataType: 'JSON',
                        success: function (data) {
                            if (data.status) {
                                console.log(data.status);
                                if (data.like) {
                                    $.notify("Liked successfully", "success");
                                    $(this).closest('.carousel-section').hide();
                                }
                            }
                        },
                    });
                };
            });
        }); 
    </script> 
@endsection