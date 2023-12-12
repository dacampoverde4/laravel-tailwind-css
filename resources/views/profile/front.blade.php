@extends('v7.frontend')
@php
$featurecount = isset($featurecount)? $featurecount: 5;
$featuredUsers = getSubscribedFeatureUsers($featurecount);
$featuredPlans = getFeaturedPlans();
@endphp
@section('page_level_styles')
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/profile_front.css') }}"/> -->
@endsection
@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}"/>
<link rel="stylesheet" type="text/css" href="http://kenwheeler.github.io/slick/slick/slick-theme.css"/>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
<script src="{{ asset('js/notify.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('js/slick.js') }}"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('frontendnew/css/gallery_slider.css') }}"/>
<link href="{{ URL::asset('new-assets/common/plugins/croppie/croppie.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('new-assets/common/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('new-assets/common/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
<link href="{{ URL::asset('new-assets/frontend/css/upload_crop_image.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('user/css/userprofile_style.css')}}" rel="stylesheet" type="text/css" />
<style>
	@media (min-width: 1450px) {
		.cus-container {
			width: 1400px;
		}
	}

	
   #myModalNote .modal-header{
      background: #d5dce2;
      padding: 30px;
   }
   .verifiedimgNew{
      margin-bottom: 50px;
   }
   .verifiedimg{
      width: 20px;
      height: 20px;
      position: absolute;
      right: 30px;
      z-index: 99999;
       top: 70px;
       opacity: 1;
	 }
	 .heart-mark{
		height: 20px;
    position: absolute;
    right: 20px;
    z-index: 99999;
    top: 10px;
		opacity: 1;
		font-size: 35px;
		color: red;
	 }
   .verifiedimgNew img{
      width: 25px;
      height: 25px;
   }
   .verifiedimgNew p{
      color: #000;
   }
   #myModalNote .modal-dialog{
      width: 550px;
   }
   #myModalNote .modal-header .close {
    opacity: 1;
    font-size: 50px;
    color: #fff;
    margin-top: -20px;
   }
   .selected{
      font-size: 20px;
      font-weight: 500;
      border-bottom: 1px solid #d5dce2;
      color: #000;
      padding-bottom: 15px;
      padding-top: 15px;
   }
   .banner-img{
      width: 730px;height: 90px;
   }
   .hkb_widget_exit__btn{
      border: transparent;
      width: 125px;
      font-size: 16px !important;
      display: block !important;
      margin: 0 auto;
      margin-top: 0 !important;
   }
   .modal-open #myModal1 {
      display: flex !important;
      justify-content: center;
      align-items: center;
      padding-right: 0 !important;
   }
   #myModal1 .modal-dialog {
      width: auto;
   }
   #myModal1 .carousel {
      position: initial;
   }
   #myModal1 .modal-dialog {
     
	 }
	 .nav-user li{
		padding-bottom:31px;
	 }
	 .nav-user li span{
		padding:2px 10px;
	 }
	 .nav-user li img{
		width: 30px;
		height:30px;
	 }
	 .nav-user li.active  span{
		border-bottom: 2px solid #70B9DA;
	 }
	 





   
</style>
@yield('head')
<!--<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}"-->
@endsection
@section('content')
<div class="maincontent backend">
<div class="content">
   <!-- Start profile Section -->
   <!-- <div class="container">
      <div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
							@if(in_array($loginusergroup, $taraud_728_90))
								@php
										$cnt728_90 = 0;
								@endphp
								<div id="myCarousel728" class="carousel slide" data-ride="carousel">
										<ol class="carousel-indicators">
											@foreach($userbanner_728_90 as $key=>$value)
														@php
														if($key == $cnt728_90)
														{
																$active = 'active';
														}else{
																$active = '';
														}
													@endphp
													<li data-target="#myCarousel728" data-slide-to="{{$key}}" class="{{$active}}"></li>
											@endforeach
										</ol>

										<div class="carousel-inner">
										@foreach($userbanner_728_90 as $key=>$value)
											@php
													if($key == $cnt728_90)
													{
														$active = 'active';
													}else{
														$active = '';
													}
											@endphp
											<div class="item {{$active}} adsimgsec ads_728_90_size ptb10">
													<a target="_blank" href="//{{$value['url']}}">
														<img src="{{ asset('/assets/images/bannerimages/'.$value['image']) }}"  alt="banner" >
													</a>
											</div>
										@endforeach
										</div>
								</div>
							@else
								<div class="adsimgsec ads_728_90_size ptb10">
										<img src="{{ url('/images/728x90.png')}}" class="banner-img">
								</div>
							@endif
					</div>
      </div>
   </div> -->
   <div class="profile_section mtopbottom80 userprofle_sec">
      @if(session()->has('message'))
      <div class="alert alert-success">
         {!! session()->get('message') !!}
      </div>
      @endif
      @if(session()->has('error'))
      <div class="alert alert-warning">
         {!! session()->get('error') !!}
      </div>
      @endif
      @php
      $message = '';
      $subnotrequired = 0;
      if( Auth::user() ){
      if( !isthisSubscribed() ){
      $subnotrequired = 1;
      $message = "You have subscribe first to take this feature";
      }
      }else{
      $message = "You have to sign in first";
      }
      $at_least_one_answer_found=0;
      if($useranswer)
      {
      $answerarray = json_decode($useranswer->answer_data,true);
      if($answerarray){
      $ctn = 1;
      foreach($answerarray as $key=>$answer){
      $model = App\Questionnaires::find($key);
      //if(count($answerarray[$model->id]) > 0 ){
      //foreach($answerarray[$model->id] as $getanswer){
      if(!empty($model->id))
      {
      $at_least_one_answer_found=1;
      }
     // }
      //}
      if($ctn > 5){
      unset($answerarray[$key]);
      }
      $ctn++;
      }
      }
      }
      @endphp
      @php
      $imgPath = public_path().'/uploads/'.$user->profile_pic;
      if (file_exists($imgPath)) {
      $image = url('uploads').'/'.$user->profile_pic;
      }else {
      $image = url('uploads').'/default.jpg';
      }
      @endphp
      <div class="container cus-container alert-trail-bar">
         <!-- Add trial Request section -->
         @if($sentReqTrial == 1)
         @php
         //get current user information
         $currentUser = Auth::user();
         if($user->gender)
         {
         if($user->usergender)
         {
         if($user->usergender->gender=='female')
         $himher =  'her';
         else {
         $himher = 'him';
         }
         }else{
         $himher = 'him/her';
         }
         }else{
         $himher = 'him/her';
         }
         @endphp
         <div class="alert alert-danger alert-dismissible" id="trialRequest_alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <div class="row">
               <div class="col-md-8">
                  <div class="row">
                     <div class="col-md-3">
                        <img src="{{$image}}" class="reqUserImg img-responsive"/>
                     </div>
                     <div class="col-md-9">
                        <div class="reqInfomsg">
                            @if($user->display_name_on_pages)
                           <h4>{{$user->display_name_on_pages}} and you are a Match!</h4>
                           <p>Ask {{$himher}} on a Trial Date.</p>
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <a href="{{url('schedule')}}/{{base64_encode($user->id)}}" class="btn btn-info" id="sendRequestBtn">Request Trial</a>
                  {{-- <a class=" chat_note" href="{{ url('chat?id='.$user->id) }}">START CHAT </a> --}}
                  <a href="{{ url('chat?id='.$user->id) }}" class="btn btn-success" id="chatFreeBtn">Chat Now</a>
               </div>
            </div>
         </div>
         @endif
         @if( $sentReqAdopt == 1  && $adoption_success != 1)
         @php
         //get current user information
         $currentUser = Auth::user();
         @endphp
         <div class="alert alert-danger alert-dismissible" id="trialRequest_alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <div class="row">
               <div class="col-md-8">
                  <div class="row">
                     <div class="col-md-3">
                        <img src="{{$image}}" class="reqUserImg img-responsive"/>
                     </div>
                     <div class="col-md-9">
                        <div class="reqInfomsg">
                           <h4>Adopt
                              @if($user->display_name_on_pages)
                              {{$user->display_name_on_pages}}
                              @endif
                           </h4>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <a class="btn btn-success btn-lg" data-toggle="modal" data-target="#sendRequestBtn">Adopt Now</a>
                  <a href="{{url('chat')}}" class="btn btn-success" id="chatFreeBtn">Chat Now</a>
               </div>
            </div>
         </div>
         <!-- Modal -->
         <div class="modal fade" id="sendRequestBtn" role="dialog">
            <div class="modal-dialog adptnow">
               <div class="modal-content">
                  <!-- Modal Header -->
                  <div class="modal-header">
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
                        <input type="hidden" name="trial" value="{{ $trial_id }}" id="trial"/>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-1">
                                 <input type="checkbox" class="form-control checkbox" id="agree" name="agree">
                              </div>
                              <div class="col-md-11 terms">
                                 <p>{!! $adopt_message !!}</p>
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
         <div class="profile-section">
            <input type="hidden" id="hdn_profile_id" value="{{ base64_encode($user->id) }}">
            <input type="hidden" id="own_profile" value="{{ $own_profile }}">
            <div class="row">
               <div class="col-xs-12 col-md-2 left_1" style="background-color:#F0F1F5;">
							 <div class="my_fun_sec1">
										<div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
															<ul class="nav-user">
																	<li class="active">
																		<a id="about" data-toggle="tab" href="#profile_first" data-toggle="tab">
																		<img src="http://localhost:8000/frontend/images/aboutme.png" alt="Profile Icon" title="Profile Icon">
																		<span class="usr_tbs">ABOUT ME</span>
																		</a>
																	</li>
																	<li>
																		<a id="questionairs" data-toggle="tab" href="#profile_second" data-toggle="tab">
																		<img src="http://localhost:8000/frontend/images/matchquest.png" alt="Profile Icon" title="Profile Icon">
																		<span class="usr_tbs">MATCH QUEST</span>
																		</a>
																	</li>
																	<li>
																		<a id="photos" href="#profile_photos">
																		<img src="http://localhost:8000/frontend/images/photos.png" alt="Profile Icon" title="Profile Icon">
																		<span class="usr_tbs">PHOTOS</span>
																		</a>
																	</li>
																	<li>
																		<a id="seeking" data-toggle="tab" href="#profile_third" data-toggle="tab">
																		<img src="http://localhost:8000/frontend/images/history.png" alt="Profile Icon" title="Profile Icon">
																		<span class="usr_tbs">HISTORY</span>
																		</a>
																	</li>
																	<li>
																		<a id="reviews"  href="#profile_review">
																		<img src="http://localhost:8000/frontend/images/reviews.png" alt="Profile Icon" title="Profile Icon">
																		<span class="usr_tbs">REVIEWS</span>
																		</a>
																	</li>
															</ul>
											</div>
							 </div>
                  
                  @if(null != $getFamilyRoleInfo)
                  <div class="my_fun_sec">
                     <div class="col-xs-12 col-sm-12 col-md-12 familyRoles-list">
                        <div class="row" style="margin: -15px -13px 0px -13px; padding: 0px 13px;background-color: #F8F8F8;">
                           <div class="col-sm-12">
                               @if($verifyusers->verify_request == 1)
                                 <div class="verifiedimgNew">
                                    <h5><img src="{{ asset('/uploads/verification-icon-71.png')}}"  /> Verified
                                    </h5>
                                    <p><span style="color:#078ba4;">{{$verifyusers->displayname}}</span> was reviewed and officially verified by AvDopt on {{\Carbon\Carbon::parse($verifyusers->verifydate)->format('m/d/Y')}}.
                                    </p>
                                 </div>
                                 @endif

                           </div>
                           <div class="col-xs-8 col-sm-8 col-md-8 pdl0">

                              <h3 class="font_family mtop40"><span style="text-transform: capitalize;"><b>Family Roles</b></span></h3>
                           </div>
                           <div class="col-xs-4 col-sm-4 col-md-4 pdr0">
                              @if( Auth::user() )
                              @if($user->id == Auth::user()->id)
                              <a href="{{ route('edit.profile') }}" class="editicon"><i class="fa fa-edit"></i></a>
                              @endif
                              @endif
                           </div>
                        </div>
                        <hr class="hr" style="margin-top:5px; margin-bottom:4px;">
                        <div class="row">
                           <div class="col-xs-12 col-sm-12 col-md-12 pdlr0">
                              @foreach($getFamilyRoleInfo as $frole)
                              <div class="input_group cl_ble">
                                 <span data-color="success" data-color="success" class="btn_family_role">
                                 <i class="fa fa-check-square-o"></i>{{$frole->title}}
                                 </span>
                              </div>
                              @endforeach
                           </div>
                        </div>
                     </div>
                  </div>
                  @endif
                  <div class="my_fun_sec">
                     <div class="col-xs-12 col-sm-12 col-md-12 familyRoles-list">
                        <div class="row" style="margin: -15px -13px 0px -13px; padding: 0px 13px;background-color: #F8F8F8;">
                           <div class="col-xs-8 col-sm-8 col-md-8 pdl0">

                              <h3 class="font_family mtop40"><span><b>HUDs</b></span></h3>
                           </div>
                        </div>
                        <hr class="hr" style="margin-top:5px; margin-bottom:4px;">
                        <div class="row">
                           <div class="col-xs-12 col-sm-12 col-md-12 pdlr0">
                              @if(getHuds(@$user->id) != '<div class="Usergradientbg"></div>')
                              <span style="display:flex; flex-wrap:wrap;margin-top: -3px;"> {!! getHuds(@$user->id) !!}</span>&nbsp;
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="my_fun_sec ">
                     <div class="col-xs-12 col-sm-12 col-md-12 about_me">
                        <div class="row" style="margin: -15px -13px 0px -13px;background-color: #F8F8F8;">
                           <div class="col-xs-10 col-sm-10 col-md-10">
                              <h3 class="font_family mtop40"><span style="text-transform: capitalize;"><b>My Fun (Tag Along)</b></span></h3>
                           </div>
                           <div class="col-xs-2 col-sm-2 col-md-2">
                              @if( Auth::user() )
                              @if($user->id == Auth::user()->id)
                              <a href="{{ route('edit.profile') }}" class="editicon"><i class="fa fa-edit"></i></a>
                              @endif
                              @endif
                           </div>
                        </div>
                        <hr class="hr" style="margin-top:2px; margin-bottom:4px;">
                        <div class="row" style="margin-top: 10px;">
                           <div class="col-xs-12 col-sm-12 col-md-12">
                              <ul class="myfun_list">
                                 @if($user->myfuns)
                                 @php
                                 $titles = array();
                                 if( $user->myfuns ){
                                 $funIDs = json_decode($user->myfuns);
                                 if( $funIDs ){
                                 $titles = App\MyFun::whereIn('id', $funIDs)->get();
                                 }
                                 }
                                 @endphp
                                 @if($titles)
                                 @foreach($titles as $title)
                                 <li><a class=" red"><span></span>{{ $title->title }}</a></li>
                                 @endforeach
                                 @endif
                                 @endif
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="my_fun_sec ">
                     <div class="col-xs-12 col-sm-12 col-md-12 about_me">
                        <div class="row">
                           <div class="col-xs-12 col-sm-12 col-md-12">
                              <h3 class="font_family mtop40"><span style="text-transform: capitalize;"><b>Advertisement</b></span></h3>
                           </div>
                        </div>
                        <hr class="hr" style="margin-top:-3px; margin-bottom:4px;">
                        <div class="row">
                           <div class="adsimgsec ads_240_400_size ptb10">
                                    <img src="{{ asset('/images/240x400.jpg')}}" class="">
                           </div>
                           <div class="col-xs-12 col-sm-12 col-md-12">
                              @if(in_array($loginusergroup, $taraud_300_600))
                                 @php
                                    $cnt = 0;
                                 @endphp
                                 <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                       @foreach($userbanner_300_600 as $key=>$value)
                                          @php
                                             if($key == $cnt)
                                             {
                                                $active = 'active';
                                             }else{
                                                $active = '';
                                             }
                                          @endphp
                                          <li data-target="#myCarousel" data-slide-to="{{$key}}" class="{{$active}}"></li>
                                       @endforeach
                                    </ol>

                                    <div class="carousel-inner">
                                    @foreach($userbanner_300_600 as $key=>$value)
                                       @php
                                          if($key == $cnt)
                                          {
                                             $active = 'active';
                                          }else{
                                             $active = '';
                                          }
                                       @endphp
                                       <div class="item {{$active}}">
                                          <a target="_blank" href="//{{$value['url']}}">
                                             <img src="{{ asset('/assets/images/bannerimages/'.$value['image']) }}"  alt="banner" class="">
                                          </a>
                                       </div>
                                    @endforeach
                                    </div>
                                 </div>
                              @else
                                 <div class="adsimgsec ads_300_600 mb15">
                                    <img src="{{ url('/images/300x600.jpg')}}" alt="user" class="">
                                 </div>
                              @endif
                           </div>

                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xs-12 col-md-10 right_1">
                  <div class="row">
                    <div class="col-xs-12 col-md-9 detail-left" style="padding-right:0px;">
                     
											
											<div class="tab-content">
												<div class="tab-pane fade in active" id="profile_first">
														<div class="right-section profile_info" style="min-height:500px; padding-right:0px;">
															<div class="col-xs-12 col-md-12" style="height: 50px;margin-bottom:20px;">
																<div class="user_sec" style="display:flex;align-items:center; justify-content: start;">
																		<div>
																			<h4 class="usr_prf_ttl">{{ ucfirst( $user->display_name_on_pages ) }}</h4>
																		</div>
																		@if($verifyusers->verify_request == 1)
																			<div style="padding: 10px;margin-bottom: 10px;">
																					<img src="{{ asset('/uploads/verification-icon-71.png')}}" style="width:20px;height:20px;" />
																			</div>
																		@endif
																		@if($user->pride_friendly == 1)
																			<div style="margin-left: 20px;margin-bottom: 20px;">
																				<img alt="Pride Friendly" height="50" width="50" src="{{ asset('images/rainbow.png') }}" class="prdfry" />
																			</div>
																		@endif
																		<div class="review_reporter" style="padding-bottom: 43px;">
																			
																			<div class="avg__reviews">
																				<ul style="width:100%;display:flex; align-items:baseline; margin-bottom:0;">
																						@for($i= 0; $i < $reviewsAvg; $i++)
																						<li><i class="fa fa-star" aria-hidden="true"></i></li>
																						@endfor
																						@if($reviewsAvg < 5)
																						@for($i= 0; $i < 5 - $reviewsAvg ; $i++)
																						<li class="gry-bg"><i class="fa fa-star-o" aria-hidden="true"></i></li>
																						@endfor
																						@endif
																						<li class="gry-bg">({{$reviewsCount}})</li>
																				</ul>
																			</div>
																			<div>
																				@if( Auth::user() )
																					@if($user->id != Auth::user()->id && !@$blocked)
																					<span class="reportblock" style="font-size:14px;padding-top:5px; text-align:center;">
																					<a href="javascript:void(0)" class="reportorblock" data-toggle="modal" data-id="1" data-target="#myModal"><b>Report</b> </a>
																					or
																					<a href="javascript:void(0)" class="reportorblock" data-toggle="modal" data-id="2" data-target="#myModal"><b>Block user</b></a>
																					</span>
																					@endif
																					@else
																					<span class="reportblock" style="font-size:11px; padding-left:10px;">
																					<a href="javascript:void(0)" data-errormsg="{{ $message }}" class="show_error_if_found reportorblock"><b>Report</b> </a>
																					or
																					<a href="javascript:void(0)" data-errormsg="{{ $message }}" class="show_error_if_found reportorblock"><b>Block user</b></a>
																					</span>
																				@endif
																			</div>
																		</div>
																</div>
																
															</div>
															<div class="col-md-12 about_sec" style="margin-right:0;height:40px; padding-top:8px;">
																	<button type="button" data-liked-user="{{$liked_the_user}}" data-user="{{ base64_encode($user->id) }}" data-subnotrequired="{{ $subnotrequired }}" data-errormsg="{{ $message }}" class="like_btn show_error_if_found"><i  class="fa">&#xf087;</i>{{ $likecount }} Likes </button>
																	<button type="button" class="match_btn"><i class="fa fa-check-square-o" aria-hidden="true"></i>{{ \App\Match::matchCount($user->id) }} Matches</button>
																	
															</div>
															<div class="col-md-12 col-sm-12">
																	<div class="row">
																		<div class="col-sm-12 col-md-6">
																				<ul class="user_info_li">
																					<li class="font17"><img src="{{url('/')}}/frontend/images/user.png" alt="Profile Icon" title="Profile Icon"> <span><b>Name:</b> {{ ucfirst( $user->display_name_on_pages ) }} </span></li>
																					<li class="font17"><img src="{{url('/')}}/frontend/images/membership.png" alt="Membership Icon" title="Membership Icon">  <span><b>User Group:</b> {!! getGroupTagWithColor($user->id) !!}</span> </li>
																					<li class="font17"><img src="{{url('/')}}/frontend/images/age.png" alt="Age Img" title="Age Img">  <span><b>Age:</b> {{ ( $user->age )? $user->age . ' Years' : '' }}  </span></li>
																					@if($selUserGroup->visible_relationship == 1)
																					<li class="font17" style="margin-left: -5px;"><img src="{{asset('backend/images/taguser.png')}}" alt="Gender Icon" title="Gender Icon"> <span><b>Relationship: </b> {!! getRelationshipTagWithColor($orgin_user->relationship) !!}</span></li>
																					@endif
																					<li class="font17"><img src="{{url('/')}}/frontend/images/join_date.png" alt="Join Date Icon" title="Profile Icon"> <span> <b>Join Date:</b> {{ ( $user->created_at )? date("F j, Y", strtotime($user->created_at) ) : '' }}</span></li>
																				</ul>
																		</div>
																		<div class="col-md-6">
																				<ul class="user_info_li">
																					<li class="font17"><img src="{{url('/')}}/frontend/images/user.png" alt="Species Icon" title="Species Icon"> <span><b>Species:</b> {{ $user->species?$user->species->name:'N/A' }} </span></li>
																					<li class="font17"><img src="{{url('/')}}/frontend/images/user.png" alt="Ethnicity Icon" title="Ethnicity Icon"> <span><b>Ethnicity:</b> {{ isset($getEthnicityGroupInfo[0]) ? $getEthnicityGroupInfo[0]: '' }} </span></li>
																					<li class="font17"><img src="{{url('/')}}/frontend/images/gender.png" alt="Gender Icon" title="Gender Icon"> <span><b>Gender: </b> {{ @$user->usergender->title }}</span></li>
																					@if($selUserGroup->visible_occupation == 1)
																					<li class="font17" style="margin-left: -5px;"><img src="{{asset('backend/images/applicants2.png')}}" alt="last Login Icon" title="Profile Icon"> <span class="lt_seen"> <b>Occupation:</b> {!! getOccupationTagWithColor($orgin_user->occupation) !!}</span></li>
																					@endif
																					<li class="font17"><img src="{{url('/')}}/frontend/images/last_login.png" alt="last Login Icon" title="Profile Icon"> <span class="lt_seen"> <b>Last Seen:</b> {!! $user->last_seen_ago_html !!}</span></li>
																				</ul>
																		</div>
																		<div class=" col-xs-12 col-md-12">
																			<p class="abtme" style="overflow-wrap: break-word;">{{ $user->about_me}}</p>
																		</div>
																		@if( Auth::user() )
																		@if($user->id == Auth::user()->id)
																		<div class="col-md-12">
																				<div class="pull-right">
																					<a href="{{ route('edit.profile') }}" class="btn btn-info editProfile-btn">Edit Profile</a>
																				</div>
																		</div>
																		@endif
																		@endif
																	</div>
															</div>
														</div>
												</div>
												@php $address= '';
												$name = ''; @endphp
												<div class="tab-pane fade in" id="profile_third">
														<div class="card-body hstrytabscoll">
															<div class="col-md-12 pull-right-his">
																	<div class="row">
																		<div class="col-md-12">
																				<div class="card-body p-b-0">
																					<h5 class="card-title"><span></span></h5>

																					<div class="tab-content">
																							<div class="tab-pane active" role="tabpanel">
																						
																								<!--- End Trials -->
																								@if(count($myEndTrials) > 0)
																								<div class="row maintbrow adoptfsec">
																										@foreach($myEndTrials as $myadoption)
																										<div class="col-md-12 col-sm-12 col-lg-12">
																											<p class="datesec">
																													<small>-<?php  date_default_timezone_set('Europe/London'); ?>
																															{{
																														date("M d, Y , h:ia",strtotime($myadoption->trail_end_at ))}}</small>
																													Trial between
																													<a href="{{ url('userprofile')}}/{{base64_encode($myadoption->user_id)}}"><b>
																														@if(!empty($myadoption->userid->display_name_on_pages))
																														{{$myadoption->userid->display_name_on_pages}}
																														@endif
																													</b></a> & <a href="{{ url('userprofile')}}/{{base64_encode($myadoption->matcher_id)}}"><b>
																														@if(!empty($myadoption->matcherid->display_name_on_pages))
																														{{$myadoption->matcherid->display_name_on_pages}}

																													@endif
																													</b></a> has ended.
																													<br/><small><b>Trial details:</b> {{date("d F Y",strtotime($myadoption->trial_date))}}, {{date("h:ia", strtotime($myadoption->trial_time))}} <a href="{{$address}}" class="label label-info" target="_blank">{{@$name}}</a></small>
																											<div class="divider div-transparent"></div>
																											</p>
																										</div>
																										@endforeach
																								</div>
																								@endif
																								@if($user->verify == '1')
																								<div class="row maintbrow adoptfsec">
																										<div class="col-md-12 col-sm-12 col-lg-12">
																											<p class="datesec">
																													<small>-<?php  date_default_timezone_set('Europe/London'); ?>
																															{{
																														date("M d, Y , h:ia",strtotime($user->verifydate ))}}</small>
																													<a href="{{ url('userprofile')}}/{{base64_encode($user->id)}}"><b>
																														@if(!empty($user->display_name_on_pages))
																														{{$user->display_name_on_pages}}
																														@endif
																													</b> account has officially been verified.
																													<br/><small><b>Verified on:</b> {{date("d F Y",strtotime($user->verifydate))}}, {{date("h:ia", strtotime($user->verifydate))}}</small>
																											<div class="divider div-transparent"></div>
																											</p>
																										</div>
																								</div>
																								@endif
																								@if(count($myEndTrials) == 0 && count($myCurrentTrials) == 0)

																								@endif
							
																							</div>
																					</div>
																					
																				</div>
																		</div>
																	</div>
																	<!--- Close Trial History -->
																	@php $address= '';
																					$name = ''; @endphp
																	<div class="row">
																		<div class="col-md-12">
																				<div class="card-body p-b-0">
																					{{--
																					<h5 class="card-title"><span>Adoptions History</span></h5>
																					--}}

																					<div class="tab-content">
																							<div class="tab-pane active" role="tabpanel">
																								@if(count($myadoptions) > 0)
																								<div class="row maintbrow adoptfsec">
																										@foreach($myadoptions as $myadoption)
																										<div class="col-md-12 col-sm-12 col-lg-12">
																											@php
																											$getLocation = App\TrialLocation::find($myadoption->trial_location_id);
																											$address = ($getLocation != '') ? $getLocation->address : "";
																											$name = ($getLocation != '') ? $getLocation->name : "";

																											$getFamilyRoleUserInfo = App\FamilyRole::find($myadoption->trial_family_role);
																											$getFamilyRoleMatcherInfo = App\FamilyRole::find($myadoption->adoptee_family_role);
																											@endphp
																											@if($myadoption->adopt_is_accepted == 1 && $myadoption->matcher_id == Auth::id())
																											<p class="remaining_time datesec">
																													<small>- {{date("M d, Y , h:ia",strtotime($myadoption->adoption_accept_decline_at))}}</small>
																													<b>
																													<a href="{{ url('userprofile')}}/{{base64_encode($myadoption->user_id)}}">{{$myadoption->userid->display_name_on_pages}}</a></b> successfully adopted a
																													{{$getFamilyRoleMatcherInfo->title}} name <b><a href="{{ url('userprofile')}}/{{base64_encode($myadoption->matcher_id)}}">{{$myadoption->matcherid->display_name_on_pages}}</a></b>.
																													<br/><small><b>Trial details:</b> {{date("d F Y",strtotime($myadoption->trial_date))}}, {{date("h:ia", strtotime($myadoption->trial_time))}} <a href="{{@$address}}" class="label label-info" target="_blank">{{@$name}}</a></small>
																											<div class="divider div-transparent"></div>
																											</p>
																											@endif
																											@if($myadoption->adopt_is_accepted == 1 && $myadoption->user_id == Auth::id())
																											<p class="remaining_time datesec">
																													<small>- {{date("M d, Y , h:ia",strtotime($myadoption->adoption_accept_decline_at))}}</small>
																													<b>
																													<a href="{{ url('userprofile')}}/{{base64_encode($myadoption->matcher_id)}}">{{$myadoption->matcherid->display_name_on_pages}}</a></b> was successfully adopted by a {{$getFamilyRoleUserInfo->title}} name <b> <a href="{{ url('userprofile')}}/{{base64_encode($myadoption->matcher_id)}}">{{$myadoption->userid->display_name_on_pages}}</a></b>.
																													<br/><small><b>Trial details:</b> {{date("d F Y",strtotime($myadoption->trial_date))}}, {{date("h:ia", strtotime($myadoption->trial_time))}} <a href="{{$address}}" class="label label-info" target="_blank">{{@$name}}</a></small>
																											<div class="divider div-transparent"></div>
																											</p>
																											@endif
																										</div>
																										@endforeach
																								</div>
																								@else

																								@endif
																							</div>
																					</div>
																				</div>
																		</div>
																	</div>
																	@php $address= '';
																					$name = ''; @endphp
																	<div class="row">
																		<div class="col-md-12">
																				<div class="card-body p-b-0">
																					{{--
																					<h5 class="card-title"><span>Dissolved History</span></h5>
																					--}}

																					<div class="tab-content">
																							<div class="tab-pane active" role="tabpanel">
																								@if(count($mydissolvedadoptions) > 0)
																								<div class="row maintbrow adoptfsec">
																										@foreach($mydissolvedadoptions as $dissolvedadoption)
																										<div class="col-md-12 col-sm-12 col-lg-12">
																											@php
																											$getLocation = App\TrialLocation::find($dissolvedadoption->trial_location_id);
																											$address = ($getLocation != '') ? $getLocation->address : "";
																											$name = ($getLocation != '') ? $getLocation->name : "";

																											$getFamilyRoleUserInfo = App\FamilyRole::find($dissolvedadoption->trial_family_role);
																											$getFamilyRoleMatcherInfo = App\FamilyRole::find($dissolvedadoption->adoptee_family_role);
																											@endphp
																											@php
																											// get Adopter he/she attributes
																											if($dissolvedadoption->userid->gender)
																											{
																											if($dissolvedadoption->userid->usergender)
																											{
																											if($dissolvedadoption->userid->usergender->gender=='female'){
																											$adopterAttr =  'She';
																											$adopterAttrGen =  'her';
																											}
																											else {
																											$adopterAttr = 'He';
																											$adopterAttrGen =  'his';
																											}
																											}
																											}else{
																											$adopterAttr = 'He/She';
																											$adopterAttrGen =  'his/her';
																											}
																											// get Adoptee he/she attributes
																											if(!empty($dissolvedadoption->matcherid->gender))
																											{
																											if($dissolvedadoption->matcherid->usergender)
																											{
																											if($dissolvedadoption->matcherid->usergender->gender=='female'){
																											$adopteeAttr =  'She';
																											$adopteeAttrGen =  'her';
																											}
																											else {
																											$adopteeAttr = 'He';
																											$adopteeAttrGen =  'his';
																											}
																											}
																											}else{
																											$adopteeAttr = 'He/She';
																											$adopteeAttrGen = 'his/her';
																											}
																											@endphp
																											@if($dissolvedadoption->adopt_is_dissolve == 1 && $dissolvedadoption->matcher_id == $dissolvedadoption->adopt_dissolve_by)
																											<p class="remaining_time datesec">
																													<small>- {{date("d F Y , h:ia",strtotime($myadoption->updated_at))}}</small>
																													<b><a href="{{ url('userprofile')}}/{{base64_encode($dissolvedadoption->matcher_id)}}">
																														@if(!empty($dissolvedadoption->matcherid->display_name_on_pages))
																														{{$dissolvedadoption->matcherid->display_name_on_pages}}</a>
																														@endif
																													</b>
																													dissolved {{$adopteeAttrGen}} adoption with <b><a href="{{ url('userprofile')}}/{{base64_encode($dissolvedadoption->user_id)}}">{{$dissolvedadoption->userid->display_name_on_pages}}</a></b>. {{$adopteeAttr}} is no longer <b><a href="{{ url('userprofile')}}/{{base64_encode($dissolvedadoption->user_id)}}">{{$dissolvedadoption->userid->display_name_on_pages}}'s</a></b> {{$getFamilyRoleMatcherInfo->title}}.
																													<br/><small><b>Trial details:</b> {{date("d F Y",strtotime($dissolvedadoption->trial_date))}}, {{date("h:ia", strtotime($dissolvedadoption->trial_time))}}  <a href="{{@$address}}" class="label label-info" target="_blank">{{@$name}}</a></small>
																											<div class="divider div-transparent"></div>
																											</p>
																											@endif
																											@if($dissolvedadoption->adopt_is_dissolve == 1 && $dissolvedadoption->user_id == $dissolvedadoption->adopt_dissolve_by)
																											<p class="remaining_time"><b>{{$dissolvedadoption->userid->display_name_on_pages}}</b> dissolved {{$adopterAttrGen}} adoption with <b>{{$dissolvedadoption->matcherid->display_name_on_pages}}</b>. {{$adopterAttr}} is no longer <b>{{$dissolvedadoption->matcherid->display_name_on_pages}}'s</b> {{$getFamilyRoleUserInfo->title}}.
																													<br/><small><b>Trial details:</b> {{date("d F Y",strtotime($dissolvedadoption->trial_date))}}, {{date("h:ia", strtotime($dissolvedadoption->trial_time))}}  <a href="{{@$address}}" class="label label-info" target="_blank">{{@$name}}</a></small>
																											<div class="divider div-transparent"></div>
																											</p>
																											@endif
																										</div>
																										@endforeach
																								</div>
																								@else
																								{{--
																								<h6 class="text-center">You have no Dissolve adoptions.</h6>
																								--}}
																								@endif
																							</div>
																					</div>
																				</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-12">
																				<div class="card-body p-b-0">
																					<div class="tab-content">
																							<div class="tab-pane active" role="tabpanel">
																								<div class="col-md-12 col-sm-12 col-lg-12">
																										<p class="remaining_time datesec">
																											<b>{{$user->displayname}}</b> joined AvDopt on {{date("d M Y, h:ia", strtotime($user->created_at))}}
																										</p>
																								</div>
																							</div>
																					</div>
																				</div>
																		</div>
																	</div>
															</div>
														</div>
												</div>
												<div class="tab-pane fade in" id="profile_second">
														@if($at_least_one_answer_found)
														<div class=" qeat_sec">
															<h3 class="font_family bgblue">MATCH QUEST</h3>
															<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
																	@if($answerarray)
																	@foreach($answerarray as $key=>$answer)
																	@php
																	$model = App\Questionnaires::find($key);
																	@endphp
																	@php
																	$expanded='false';
																	$collapse='panel-collapse collapse';
																	@endphp
																	@if ($loop->first)
																	@php
																	$expanded='true';
																	$collapse='panel-collapse collapse in';
																	@endphp
																	@endif
																	@php
																	$answer_found=0;
																	if(count( $answerarray[$model->id] ) > 0 ){
																	foreach($answerarray[$model->id] as $getanswer){
																	if($getanswer)
																	{
																	$answer_found=1;
																	}
																	}
																	}
																	@endphp
																	@if($answer_found)
																	<div class="panel panel-warning">
																		<div class="panel-heading" role="tab" id="heading{{ $loop->iteration }}">
																				<h4 class="panel-title font17">
																					<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $loop->iteration }}" aria-expanded="{{ $expanded }}" aria-controls="collapseOne">
																					{{ $model->question_title }}
																					<i class="fa fa-plus pull-right"></i>
																					</a>
																				</h4>
																		</div>
																		<div id="collapse{{ $loop->iteration }}" class="{{ $collapse }}" role="tabpanel" aria-labelledby="heading{{ $loop->iteration }}">
																				<div class="panel-body fontclr73">
																					@if(count( $answerarray[$model->id] ) > 1 )
																					<ol>
																							@foreach($answerarray[$model->id] as $getanswer)
																							<li style="width: 100%;">{{ $getanswer }}</li>
																							@endforeach
																					</ol>
																					@else
																					@php
																					echo current($answerarray[$model->id]);
																					@endphp
																					@endif
																				</div>
																		</div>
																	</div>
																	@endif
																	@endforeach
																	@endif
																	<div class="unlock-more-match-quest">
																		@if($has_unlock_match_quest_feature)
																		<a class="btn btn-success" href="{{ route('viewmatchquests', $encrypted_other_user_id) }}">View More Match Quests</a>
																		@else
																		<button type="button" class="btn btn-danger unlock-more-match-quest-btn" data-toggle="modal" data-target="#unlockMoreQuest">Unlock More Match Quest</button>
																		@endif
																	</div>
															</div>
														</div>
														@else
														<div class=" qeat_sec">
															<h5 class="q_sec">
																	@php
																	$hisher = 'his/her';
																	if($user->gender)
																	{
																	if($user->usergender)
																	{
																	if($user->usergender->gender=='female')
																	$hisher = 'her';
																	else
																	$hisher = 'his';
																	}
																	}
																	@endphp
																	@if(Auth::user())
																	@if($user->id === Auth::user()->id)
																	Increase your adoption potential by completing your <a href="{{ url('matchquests')}}">Match Quest</a>.
																	@else
																	{{$user->displayname}} haven't completed {{$hisher}} Match Quest as yet.
																	@endif
																	@else
																	{{$user->displayname}} haven't completed {{$hisher}} Match Quest as yet.
																	@endif
															</h5>
														</div>
														@endif
												</div>
											</div>
                                          
                    </div>

                    <div class="col-xs-12 col-md-3 picture-right">
											<div class="left-section lfts">
												<div class="row">
														<div class="col-md-12">
															@if($auth_user_profile)
															<button type="button" class="btn btn-upload-profile" id="btn_open_modal_upload_profile_image"> <i class="fa fa-camera fa-2x"></i> </button>
															<div class="modal fade" id="modal_upload_profile_image" tabindex="-1" role="basic" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																				<div class="modal-header">
																					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
																					<span aria-hidden="true">&times;</span>
																					</button>
																					<h4 class="modal-title">Upload Profile</h4>
																				</div>
																				<div class="modal-body">
																					<div class="row " style="padding-top:10px;padding-bottom:10px;">
																							<div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
																								<div class="alert alert-info">
																										<strong>Info!</strong> Please upload image format as jpeg, png, jpg and gif only.
																								</div>
																								<div class="frm_account_setup_profile_image_submit_msg"></div>
																							</div>
																					</div>
																					<div class="row">
																							<div class="col-md-12 text-left">
																								<button class="btn btn-info btn_select_photos" id="btn_select_photos">Select photo from album</button>
																								<button class="btn btn-info btn_upload_new" id="btn_upload_new">Upload new photo</button>
																							</div>
																							<div class="col-md-12 photoselectsec">
																								@if( $photo_ulbum )
																								@foreach($photo_ulbum as $key=>$row)
																								<div class="col-md-2">
																										<div class="usrimgs">
																											<img id="img-{{ $row->id.$key }}" data-img-id="{{ $row->id }}" data-token="{{ csrf_token() }}" src="{{ asset('/uploads/'.$row->image)}}" alt="Image" />
																											<a href="javascript:void(0)" data-selprofileimg="{{$row->image}}"class="setprofilelink">Set as profile</a>
																										</div>
																								</div>
																								@endforeach
																								@endif
																							</div>
																					</div>
																					<div class="row photouploadsec" style="padding-bottom:20px;">
																							<div class="col-md-5 col-sm-5 col-lg-5 col-xs-12 text-center">
																								<div id="profile_image_crop_container" style=""></div>
																							</div>
																							<div class="col-md-2 col-sm-2 col-lg-2 col-xs-6">
																								<div class="fileinput fileinput-new btn-block" data-provides="fileinput">
																										<span class="btn btn-primary btn-file btn-block">
																										<span class="fileinput-new btn-block">Browse</span>
																										<span class="fileinput-exists btn-block">Browse</span>
																										<input type="file" name="..." id="file_profile_image" accept="image/*">
																										</span>
																								</div>
																								<button class="btn btn-info btn_profile_image_preview btn-block" >Preview</button>
																								<button class="btn btn-success btn_profile_image_upload btn-block" >Submit</button>
																								<button class="btn btn-danger btn_profile_image_cancel btn-block" style="">Cancel</button>
																							</div>
																							<div class="col-md-5 col-sm-5 col-lg-5 col-xs-12">
																								<div id="profile_image_preview_container"></div>
																							</div>
																					</div>
																				</div>
																		</div>
																	</div>
															</div>
															<div class="modal fade" id="modal_upload_profile_image_setprofile" tabindex="-1" role="basic" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																				<div class="modal-header">
																					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
																					<span aria-hidden="true">&times;</span>
																					</button>
																					<h4 class="modal-title">Crop Image</h4>
																				</div>
																				<div class="modal-body">
																					<div class="row" style="padding-bottom:20px;">
																							<div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
																								<div class="profile_imgcrop_msg"></div>
																							</div>
																							<div class="col-md-5 col-sm-5 col-lg-5 col-xs-12 text-center mb30">
																								<div id="crop_img_profile" class="croppie-containerr" style="width: 100%;height: 100%;"></div>
																							</div>
																							<div class="col-md-2 col-sm-2 col-lg-2 col-xs-12 text-center mb30">
																								<button type="button" id="button_crop_prev" class="btn btn-primary">Preview</button>
																								<button type="button" id="button_crop_submmit" class="btn btn-primary">Submit</button>
																							</div>
																							<div class="col-md-5 col-sm-5 col-lg-5 col-xs-12 text-center mb30">
																								<div id="crop_img_profile_prev" class="croppie-containerr" style="width: 100%;height: 100%;"></div>
																							</div>

																					</div>
																				</div>
																		</div>
																	</div>
															</div>
															@endif
														</div>
												</div>
													
												<div>
														<!-- <img src="{{ asset('/uploads/verification-icon-71.png')}}" class="verifiedimg" /> -->
														<i class="fa fa-heart heart-mark" data-errormsg="" data-user="Nzk4"></i>
												</div>
												
												<div class="slider-for usr_img">

														<div style="background-image:url({{$image}});background-size:cover;background-position:50% 50%;height:450px; width:100%;"></div>

														@php
														$images = @$user->photos;
														@endphp
														@if( $images )
														@foreach($images as $row)
														<div style="background-image:url({{ asset('/uploads/'.$row->image)}});background-size:cover;background-position:50% 50%;height:450px; width:106px;"> </div>
														@endforeach
														@endif
												</div>
											</div>
											@php
											$images = $user->photos;
											@endphp
											@if( $images )
												<div class="left-section  the_left mtopbottom20 ">
														<div class="fl_sec">
															<div class="row">
																	<div class="col-md-6 padding0">
																		<div class="t start_chat">
																				<span class="chat_span"><i class="fa fa-commenting" aria-hidden="true"></i></span>
																				@if( isthisSubscribed() )
																				<a class=" chat_note" href="{{ url('chat?id='.$user->id) }}">START CHAT </a>
																				@else
																				<a class=" chat_note show_error_if_found"  data-errormsg="{{ $message }}" href="javascript:void(0)">START CHAT </a>
																				@endif
																		</div>
																	</div>

																	<div class="col-md-6 padding0">
																		<div class="padding0 msg_chat">
																				@if( Auth::user() )
																				<button type="button" class=" leave_note" data-toggle="modal" data-id="1" data-target="#myModalNote">MESSAGE</button>
																				@else
																				<button type="button" class="leave_note show_error_if_found" data-errormsg="{{ $message }}" >MESSAGE</button>
																				@endif
																				<span class="message_span"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
																		</div>
																	</div>

															</div>

														</div>
												</div>
											@endif                 
                    </div>
                  </div>

									<a name="profile_photos"></a>
                  <div class="right-section profile_ad left_2 photos sec" style="margin-top:10px;">
                     <div class="modal fade" id="myModalNote">
                        <div class="modal-dialog">
                           <div class="modal-content">
                              <form class="formreportblock" method="post" action="{{ route('messages.store') }}">
                                 @csrf
                                 <!-- Modal Header -->
                                 <div class="modal-header">
                                    <h3 class="modal-title">Send Note to {{ ucfirst( $user->display_name_on_pages ) }}</h3>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 </div>
                                 <!-- Modal body -->
                                 <div class="modal-body">
                                    <input type="hidden" value="{{ ucfirst( $user->id ) }}" name="reciever_id" />
                                    <div class="form-group">
                                      <!--  <label class="col-form-label">Note</label> -->
                                      <!--  <div class='selected'>Sample data added</div> -->
                                       <?php
                                        $groupid = 1;
                                          if( Auth::user() ){
                                          $groupid = Auth::user()->group;
                                          }
                                       $notes = App\Note::where('user_group', $groupid)->get();
                                       if($notes){
                                          foreach($notes as $note){
                                              echo "<div class='selected'>".$note->note."</div>";
                                          }
                                          }
                                          ?>
                                          <input type="hidden" id="noteselect" name="note">
                                       {{-- <select name="note" id="noteselect" class="form-control">
                                          @php
                                          $groupid = 1;
                                          if( Auth::user() ){
                                          $groupid = Auth::user()->group;
                                          }
                                          $notes = App\Note::where('user_group', $groupid)->get();
                                          if($notes){
                                          foreach($notes as $note){
                                          echo '
                                          <option value="'.$note->note.'">'.$note->note.'</option>
                                          ';
                                          }
                                          }
                                          @endphp
                                          @if ( isthisSubscribed() )
                                          <option value="other">Other</option>
                                          @endif
                                       </select>
                                       @if ( isthisSubscribed() )
                                       <div class="textareanote"></div>
                                       @else
                                       @endif --}}
                                       <br>
                                    </div>
                                    <div class="form-group">
                                       <label></label>
                                       <button id="subbtn" style="text-transform:capitalize" class="btnpad btnred border_radius hkb_widget_exit__btn">Send</button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="row" style="margin: -23px -20px -24px -30px; background-color:#F8F8F8;">
                        <div class="col-xs-4 col-sm-6 col-md-6" style="padding: 6px 0px 6px 0px;">
                           <h3 class="font_family" style="width: 130px;padding-left: 30px; border-bottom: 2px #7FADBF solid;padding-bottom: 10px;">
                              <span style="font-size:17px;"><b>Photos</b></span>
                           </h3>
                        </div>
                        <div class="col-xs-8 col-sm-6 col-md-6 text-right">
                           @if($auth_user_profile)
                           <button type="button" class="btnpad plus" id="upload_modal_btn" data-toggle="modal" data-target="#uploadphotomodal"><i class="fa fa-plus"></i></button>
                           @endif
                           <button class="feature_button"  id="view_photos_btn" style="background-color:#c466c7;">View Photos</button>
                        </div>
                     </div>
                     <hr class="hr">
									
                     <div class="row">
                        @if( isthisSubscribed() )
                        <div class="modal fade" id="uploadphotomodal" role="dialog">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title font22">PHOTO UPLOAD</h4>
                                 </div>
                                 <div class="modal-body">
                                    @if(!empty($plandata))
                                    <p class="text-center">You may upload {{ @$newmetaInfo['sub_max_images_upload_'.$plandata->id] == -1 ? 'unlimited' : $newmetaInfo['sub_max_images_upload_'.$plandata->id] }} photos with your membership plan. Do not upload photos containing texts, nudity, nor 1st Life. Doing so will result in, account restriction or termination. For more information, please see our <a href="#" data-toggle="modal" data-target="#termsPopup">Terms</a> and <a href="#" data-toggle="modal" data-target="#policyPopup">Policy.</a></p>
                                    @endif

                                    <div class="error_sec"></div>
                                    {!! Form::open([ 'route' => [ 'dropzone.uploadfile' ], 'files' => true, 'class' => 'dropzone','id'=>"image-upload"]) !!}
                                    {!! Form::close() !!}
                                    <div class="row">
                                       @if( count($photo_ulbum) > 0 )
                                          <h5 class="text-center">Photos</h5>
                                          @foreach($photo_ulbum as $key=>$row)
                                          <div class="col-md-4">
                                             <div class="grid-item">
                                                <a href="javascript:void(0)" class="deleteProduct" data-id="{{ $row->id }}" data-token="{{ csrf_token() }}" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                <a href="javascript:void(0)" data-selprofileimg="{{$row->image}}" data-selprofileimgid="{{$row->id}}" data-selprofileimgsrcpath="{{ asset('/uploads/'.$row->image)}}" class="setprofilecrop"><i class="fa fa-user" aria-hidden="true"></i></a>
                                                <img id="srcimg_{{$row->id}}" src="{{ asset('/uploads/'.$row->image)}}" />
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
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Terms</h4>
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
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Privacy Policy</h4>
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
                        <div id="view_photos" class="modal fade" role="dialog">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="text-center">{{ $dispname }} Photos</h4>
                                 </div>
                                 <div class="modal-body">
                                    @if( $photo_ulbum )
                                    <div id="slideshow" class="fullscreen">
                                       @foreach($photo_ulbum as $key=>$row)
                                       @php
                                       $active = "";
                                       if($key == 0)
                                       {
                                       $active = "active";
                                       }
                                       @endphp
                                       <img id="img-{{ $row->id.$key }}" data-img-id="{{ $row->id }}" class="img-wrapper {{$active}}" data-token="{{ csrf_token() }}" src="{{ asset('/uploads/'.$row->image)}}" alt="Image" />
                                       @endforeach
                                       <div class="thumbs-container bottom">
                                          <div id="prev-btn" class="prev">
                                             <i class="fa fa-chevron-left fa-3x"></i>
                                          </div>
                                          <ul class="thumbs">
                                             @foreach($photo_ulbum as $key=>$row)
                                             @php
                                             $active_thumb = "";
                                             if($key == 0)
                                             {
                                             $active_thumb = "active";
                                             }
                                             @endphp
                                             <li data-thumb-id="{{ $row->id }}" class="thumb {{$active_thumb}}" style="background-image: url('{{ asset('/uploads/'.$row->image)}}')"></li>
                                             @endforeach
                                          </ul>
                                          <div id="next-btn" class="next">
                                             <i class="fa fa-chevron-right fa-3x"></i>
                                          </div>
                                       </div>
                                    </div>
                                    @endif
                                 </div>
                              </div>
                           </div>
                        </div>
                        @else
                        <div class="row upgrade">
                           <div class="col-md-8">
                              <div class="upgdinfo bggray font300">
                                 @if(Auth::check())
                                 <p>Hey {{ ucfirst( Auth::user()->name ) }}!.  Upgrade your membership today to experience unlimited upload photo.</p>
                                 @endif
                              </div>
                           </div>
                           <div class="col-md-4">
                              @if(Auth::check())
                              <a style="padding: 18px 0px;" href="{{ url('pricing') }}" class="btn btnred width100">Upgrade Membership</a>
                              @endif
                           </div>
                        </div>
                        @endif
                     </div>
                     <div class="row">
                        @php
                        $images = $user->photos;
                        @endphp
                        @if( $images )
                        <div class="slider-thumb">
                           <div class="slider-nav">
                              <div>
                                 <img  src="{{ ( $user->profile_pic )? url('/uploads').'/'.$user->profile_pic : url('/images/default.png')}}" class="profile_image" alt="Profile Img" title="Profile Img">
                              </div>
                              @foreach($images as $key=>$row)
                              <div data-toggle="modal" data-target="#myModal1"><a href="#myGallery" class="dddd" data-id ="{{$key}}" data-slide-to="1"><img   class="img-thumbnail" src="{{ asset('/uploads/'.$row->image)}}" alt="Profile Img" title="Profile Img"></a> </div>
                              @endforeach
                           </div>
                        </div>
                        @endif
                     </div>
                  </div>
									<div class="row">
															<div class="user-ads">
																	<div class="col-xs-12 col-sm-12 col-md-12">
																			@if(in_array($loginusergroup, $taraud_728_90))
																				@php
																						$cnt728_90 = 0;
																				@endphp
																				<div id="myCarousel728" class="carousel slide" data-ride="carousel">
																						<ol class="carousel-indicators">
																							@foreach($userbanner_728_90 as $key=>$value)
																										@php
																										if($key == $cnt728_90)
																										{
																												$active = 'active';
																										}else{
																												$active = '';
																										}
																									@endphp
																									<li data-target="#myCarousel728" data-slide-to="{{$key}}" class="{{$active}}"></li>
																							@endforeach
																						</ol>

																						<div class="carousel-inner">
																						@foreach($userbanner_728_90 as $key=>$value)
																							@php
																									if($key == $cnt728_90)
																									{
																										$active = 'active';
																									}else{
																										$active = '';
																									}
																							@endphp
																							<div class="item {{$active}} adsimgsec ads_728_90_size ptb10">
																									<a target="_blank" href="//{{$value['url']}}">
																										<img src="{{ asset('/assets/images/bannerimages/'.$value['image']) }}"  alt="banner" >
																									</a>
																							</div>
																						@endforeach
																						</div>
																				</div>
																			@else
																				<div class="adsimgsec  ptb10">
																						<img src="{{ url('/images/728x90.png')}}" style="width: 100%;height:auto;">
																				</div>
																			@endif
																	</div>
															</div>
										 </div>
                  
                  <div class="right-section profile_ad left_2" style="margin-top: 5px">
                     <div class="row" style="margin: -23px -20px -24px -30px; background-color:#F8F8F8;">
                        <div class="col-md-4" style="padding: 6px 0px 6px 0px;">
                           <h3 class="font_family" style="width: 210px;padding-left: 30px; border-bottom: 2px #7FADBF solid;padding-bottom: 10px;">
                              <span style="font-size:17px;"><b>Featured Members</b></span>
                           </h3>
                        </div>
                        <div class="col-md-5 sec_crowd">
                           
                        </div>
                        <div class="col-md-3" style="text-align: right;">
                           <button class="feature_button" data-toggle="modal" data-target="#exampleModal_fp"><b>GET FEATURED</b></button>
                        </div>
                        <!-- --------------Featured Members popup----------------- -->
                        <div class="modal fade userpf_popup" id="exampleModal_fp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content featured_popup">
                                 <div class="modal-header padding0">
                                    <h5 class="modal-title" id="exampleModalLabel"><img class="img-responsive" alt="Profile Img" src="/frontend/images/flame.png">GET FEATURED</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <p>The first part of standing out is getting noticed. Even before visitors see your profile and activity, they see you. Studies show that featured profiles are nine times more likely to be viewed.</p>
                                    <div class="row">
                                       <div class="col-md-12">
                                          <a href="{{ url('featured-members')}}" class="btn btn-success btn-md featmembtn">View Featured Members</a>
                                       </div>
                                    </div>
                                    <div class="scheme_box">
                                       @php
                                       $tokenamount = getWebsiteSettingsByKey('token_amount');
                                       if(Auth::check())
                                       $subscription = App\Subscription::where('user_id', Auth::user()->id)->where('name', 'feature')->first();
                                       @endphp
                                       @if(null != $featuredPlans)
                                       @foreach($featuredPlans as $featuredPlan)
                                       <div class="col-md-6 ">
                                          <div class="basic">
                                             <div class="left">
                                                <h3 class="fontclr">{{ @$featuredPlan->name }}</h3>
                                             </div>
                                             <div class="right">
                                                <h5>{{ @$featuredPlan->tokens }} Tokens</h5>
                                             </div>
                                             <div class="feat_infop">
                                                <p class=" mtop20">{{ $featuredPlan->info }}</p>
                                             </div>
                                             @if( $subscription )
                                             @php
                                             $userSub = App\User::find(Auth::user()->id);
                                             @endphp
                                             @if( $subscription->stripe_plan == $featuredPlan->plan_id && $userSub->subscribed('feature') && ( !$userSub->subscription('feature')->onGracePeriod() ) )
                                             <form class="form-horizontal " role="form" method="POST" action="{{ url('/')}}/subscription/featurecancel">
                                                @csrf
                                                <input type="hidden" name="chargeId" value="{{ $featuredPlan->plan_id }}" >
                                                <button type="submit" onclick="return confirm('Are you sure you want to cancel this plan?')" class="mtop10 mb cncl_btn"><span>Cancel</span></button>
                                             </form>
                                             @else
                                             <form class="form-horizontal " role="form" method="POST" action="{{ url('/')}}/subscription/checkout">
                                                @csrf
                                                <input type="hidden" name="chargeId" value="{{ $featuredPlan->plan_id }}" >
                                                <button type="submit" onclick="return confirm('Are you sure you want to upgrade this plan?')" class="mtop10 mb upgrd_btn"><span>Buy Now</span></button>
                                             </form>
                                             @endif
                                             @else
                                             <form class="form-horizontal " role="form" method="POST" action="{{ url('/')}}/subscription/checkout">
                                                @csrf
                                                <button type="submit" class="mtop10 mb"><span>Buy</span></button>
                                                <input type="hidden" name="chargeId" value="{{ $featuredPlan->plan_id }}" >
                                                <div class="hidescript">
                                                   <!-- <script
                                                      src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                                      data-key="{{ env('STRIPE_KEY') }}"
                                                      data-amount="{{ ( $tokenamount )? $featuredPlan->tokens * ( $tokenamount * 100 ): $featuredPlan->tokens * 100 }}"
                                                      data-name="{{ $featuredPlan->name }}"
                                                      data-description="Feature Profile charge"
                                                      data-image="{{url('/')}}/backend/images/logo.jpg"
                                                      data-locale="auto">
                                                      </script> -->
                                                </div>
                                             </form>
                                             @endif
                                          </div>
                                       </div>
                                       @endforeach
                                       @else
                                       <div class="col-md-12">
                                          <h4 class="alert alert-info"> Please Contact with admin to get featured plans </h4>
                                       </div>
                                       @endif
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- End Featured Members popup -->
                     </div>
                     <hr class="hr">
                     <div class="row usr_imgs">
                        @foreach($users as $userSingle)
                        @php
                        $isfeatured = isthisSubscribedFeature($userSingle->id);
                        @endphp
                        @if( $isfeatured )
                        <div class="col-sm-2 col-md-2">
                           <a href="{{ route('viewprofile', base64_encode($userSingle->id)) }}">
                           <img class="feature_img" style="padding-bottom: 0px; border-radius: 100%;" alt=" Img" src="{{ ( $userSingle->profile_pic )? url('/uploads').'/'.$userSingle->profile_pic : url('/images/default.png')}}">
                           </a>
                        </div>
                        @endif
                        @endforeach
                     </div>
									</div>
									{{-- REVIEW SECTION STARTS HERE --}}
									<a name="profile_review" ></a>
                  <div class="right-section profile_ad ad_sec review_sec" style="margin-top:30px;">
                     {{-- REVIEW HEADER START--}}
                     <div class="row" style="margin: -23px -20px -24px -30px; background-color:#F8F8F8;">
                        <div class="col-md-9" style="padding: 6px 0px 6px 0px;">
                           <h3 class="font_family" style="width: 130px;padding-left: 30px; border-bottom: 2px #7FADBF solid;padding-bottom: 10px;">
                              <span style="font-size:17px;"><b>Reviews</b></span>
                           </h3>
                        </div>
                        <div class="col-md-3">

                           @if(@$trailReq && (@$canSendAdoptionReview || @$canSendDissolveReview || @$canSendTrialReview))
                           @php
                           if(@$trailReq->getReviewsTrail && !@$trailReq->getReviewsAdoption){
                           $reviewType = 'adoption';
                           }elseif($canSendDissolveReview == 1){
                           $reviewType = 'dissolve';
                           }else{
                           $reviewType = 'trial';
                           }

                           @endphp

                           {{-- <script type="text/javascript">alert({{$canSendDissolveReview}})</script> --}}
                           <button class="feature_button" data-toggle="modal"  id="addReviweBtn" data-reviewtype= "{{@$reviewType}}" data-id="{{@$trailReq->id}}" data-target="#addReviewModal"><b>ADD REVIEW</b></button>
                           {{-- ADD REVIEW MODAL STARTS HERE --}}
                           <div class="modal" id="addReviewModal">
                              <div class="modal-dialog">
                                 <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header crsbtn">
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="rivefrm">
                                       <div class="aplyrate">
                                          <h4 class="modal-heading">Add review</h4>
                                          <div class="success-message"></div>
                                          <div class="bodyform">
                                             <div class='rating-stars'>
                                                <ul id='stars'>
                                                   <li class='star' title='Poor' data-value='1'>
                                                      <i class='fa fa-star fa-fw'></i>
                                                   </li>
                                                   <li class='star' title='Fair' data-value='2'>
                                                      <i class='fa fa-star fa-fw'></i>
                                                   </li>
                                                   <li class='star' title='Good' data-value='3'>
                                                      <i class='fa fa-star fa-fw'></i>
                                                   </li>
                                                   <li class='star' title='Excellent' data-value='4'>
                                                      <i class='fa fa-star fa-fw'></i>
                                                   </li>
                                                   <li class='star' title='WOW!!!' data-value='5'>
                                                      <i class='fa fa-star fa-fw'></i>
                                                   </li>
                                                </ul>
                                             </div>
                                             <form class="aplrvi">
                                                <input type="text" name="subject" id="subject" placeholder="Subject" value="">
                                                <input type="hidden" id = "stars_value" name="stars" value="">
                                                <input type="hidden" id = "tid" name="tid" value="{{@$trailReq->id}}">
                                                {{-- <input type="hidden" id = "reviewtype" name="type" value=""> --}}
                                                {{-- <label for="type">Select Review Type</label> --}}
                                                <select class="form-control" name="type" id="reviewtype">
                                                   <option value="" disabled="">-- Select Review Type --</option>
                                                   @if(@$canSendTrialReview)
                                                   <option value="trial">Trial</option>
                                                   @endif
                                                   @if(@$canSendAdoptionReview)
                                                   <option value="adoption">Adoption</option>
                                                   @endif
                                                   @if(@$canSendDissolveReview)
                                                   <option value="dissolve">Dissolve</option>
                                                   @endif
                                                </select>
                                                <br>
                                                <input type="hidden" id = "other_user_id" name="other_user_id" value="{{$user->id}}">
                                                <textarea placeholder="Message" id = "message" name="message"></textarea>
                                                <div class="errors-addReviewModal"></div>
                                                <button id="review-submit">Submit</button>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           {{-- ADD REVIEW MODAL ENDS HERE --}}
                           @endif
                        </div>
                     </div>
                     {{-- REVIEW HEADER ENDS--}}
                     <hr class="hr">
                     {{-- REVIEW BODY STARTS --}}
                     <div class="review-body">

                        @if(sizeof($reviews)==0 && !empty($user->display_name_on_pages))
                        <center>
                       {{ ucfirst( $user->display_name_on_pages ) }} has no reviews as yet!
                        </center>
                       @endif
                        @forelse(@$reviews as $review)
                        <div class="revsec mt40px">
                           <div class="clntrive">
                              <div class="clntrate">
                                 <ul>
                                    @for($i= 0; $i < @$review->stars; $i++)
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    @endfor
                                    @if(@$review->stars < 5)
                                    @for($i= 0; $i < 5 - @$review->stars ; $i++)
                                    <li class="gry-bg"><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                    @endfor
                                    @endif

                                 </ul>
                                 <p><strong>{{@$review->subject}}</strong></p>
                                 <div class="dtecmt">
                                    <p> By <span>{{@$review->user->displayname}}</span> on {{date("M d, Y , h:ia",strtotime(@$review->created_at))}}<span class="{{(@$review->type == 'trial') ? 'bggreentag' : 'bgredtag' }}">{{@$review->type}}</span></p>
                                 </div>
                              </div>
                              <div class="clntrive">
                                 <p>{{@$review->message}}</p>
                                 <div class="cmt d-flex">
                                    @if(!@$review->reviewComment)
                                    <span class="clrblue">Comment</span><span>Was this reviews helpful to you?</span>
                                    <button onclick="comment({{@$review->id}},1)">Yes</button>
                                    <button onclick="comment({{@$review->id}},0)"> No</button>
                                    @endif
                                    @if(!@$review->ReviewAbuse)
                                    <button onclick="report({{@$review->id}})" class="repbtn"> Reports abuse</button>
                                    @endif
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="divider div-transparent mt-15"></div>
                        @empty
                        @endforelse

                        @if(@$reviewsCount > 6)
                        <div class="all-reviews-box">
                           @php
                           $userID = base64_encode($user->id);
                           @endphp
                           <a href="{{route('reviews.all', $userID)}}" class="">See all reviews</a>
                        </div>
                        @endif
                     </div>
                     {{-- REVIEW BODY ENDS --}}
                  </div>
                  {{-- REVIEW SECTION ENDS HERE --}}
                  <div class="right-section profile_ad ad_sec" style="margin-top:0px;">
                     <div class="row" style="margin: -23px -20px -24px -30px; background-color:#F8F8F8;">
                        <div class="col-md-4" style="padding: 6px 0px 6px 0px;">
                           <h3 class="font_family" style="width: 188px;padding-left: 30px; border-bottom: 2px #7FADBF solid;padding-bottom: 10px;">
                              <span style="font-size:17px;"><b>Advertisement</b></span>
                           </h3>
                        </div>
                        <div class="col-md-5">
                        </div>
                        <div class="col-md-3" style="text-align: right;">
                           <button class="feature_button"><b>Advertise</b></button>
                        </div>
                     </div>
                     <hr class="hr">

                     <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                           @if(in_array($loginusergroup, $taraud_970_250))
                              @php
                                 $cnt97_25 = 0;
                              @endphp
                              <div id="myCarousel970" class="carousel slide" data-ride="carousel">
                                 <ol class="carousel-indicators">
                                    @foreach($userbanner_970_250 as $key=>$value)
                                        @php
                                          if($key == $cnt97_25)
                                          {
                                             $active = 'active';
                                          }else{
                                             $active = '';
                                          }
                                       @endphp
                                       <li data-target="#myCarousel970" data-slide-to="{{$key}}" class="{{$active}}"></li>
                                    @endforeach
                                 </ol>

                                 <div class="carousel-inner">
                                 @foreach($userbanner_970_250 as $key=>$value)
                                    @php
                                       if($key == $cnt97_25)
                                       {
                                          $active = 'active';
                                       }else{
                                          $active = '';
                                       }
                                    @endphp
                                    <div class="item {{$active}}">
                                       <a target="_blank" href="//{{$value['url']}}">
                                          <img src="{{ asset('/assets/images/bannerimages/'.$value['image']) }}"  alt="banner" class="">
                                       </a>
                                    </div>
                                 @endforeach
                                 </div>
                              </div>
                           @else
                              <div class="adsimgsec ads_970_250">
                                 <img src="{{ url('/images/970x250.png')}}" alt="user" class="">
                              </div>
                           @endif
                        </div>
                     </div>

                  </div>



               </div>
            </div>
            <!-- End Profile Ad -->
            
         </div>
         <div class="col-md-12 col-sm-12 mtop80 padding0 ">
            <!-- Featured Members -->
            <!--<div class="col-md-12 col-sm-12 padding0 mtop80 Featured_members">-->
            <!--    <div class="col-md-6 padding0 mtop40 text-center">-->
            <!--        <div class="ad_box down">-->
            <!--            <span>AD BANNER</span>-->
            <!--        </div>-->
            <!--        <a href="#" class="font22 mtop20 inline_block">Click here to advertise with us</a>-->
            <!--    </div>-->
            <!--    </div>-->
            <!-- End Featured Members  -->
         </div>
      </div>
   </div>
</div>
<!-- End profile Section -->
<div class="modal fade" id="myModal">
   <div class="modal-dialog">
      <div class="modal-content">
         <form class="formreportblock" method="post" action="{{ route('profile.blockreport') }}">
            @csrf
            <!-- Modal Header -->
            <div class="modal-header">
               <h2 class="modal-title"></h2>
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
               <input type="hidden" value="{{ ucfirst( $user->id ) }}" name="block_id" />
               <input type="hidden" value="" id="type" name="type" />
               <div class="form-group">
                  <label class="col-form-label">Reason</label>
                  <select name="reason" class="form-control" >
                     @php
                     $reasons = App\Reason::all();
                     @endphp
                     @if($reasons)
                     @foreach($reasons as $reason)
                     <option value="{{ $reason->name }}">{{ $reason->name }}</option>
                     @endforeach
                     @endif
                  </select>
                  <br>
               </div>
               <div class="form-group">
                  <label class="col-form-label">Reason Description</label>
                  <textarea type="text" class="form-control" name="description"></textarea>
                  <br>
               </div>
               <div class="form-group">
                  <label></label>
                  <button id="subbtn_report_block" style="text-transform:capitalize" class="btnpad btnred border_radius"></button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal fade" id="modal_user_list_who_liked" tabindex="-1" role="basic" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Users who liked the user profile</h4>
         </div>
         <div class="modal-body">
            <img class="modal_user_list_who_liked_loading" src="{{ asset('/new-assets/common/images/loading-transperent-160x160.gif')}}">
            <div class="modal_user_list_who_liked_submit_msg"></div>
            <div class="row">
               <div class="col-md-12 text-right">
                  <a href="javascript:void(0);" class="anc_unlike_user btn btn-danger">Unlike</a>
               </div>
            </div>
            <div class="modal_user_list_who_liked_container">
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="modal_user_match" tabindex="-1" role="basic" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Matches</h4>
         </div>
         <div class="modal-body">
            <img class="modal_user_match_loading" src="{{ asset('/new-assets/common/images/loading-transperent-160x160.gif')}}">
            <div class="modal_user_match_submit_msg"></div>
            <div class="modal_user_match_container">
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="myModal1" style="background-color:#4b4f51; opacity:0.9;">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header" style="padding:0;border:0px;">
         </div>
         <div class="modal-body" style="padding: 0px;">

<!--CAROUSEL CODE GOES HERE-->
<!--begin carousel-->
            <div id="myGallery" class="carousel slide" data-interval="false">
               <div class="carousel-inner">
                  <div class="item default_item active"> <img  style="width:100%;" src="{{ ( $user->profile_pic )? url('/uploads').'/'.$user->profile_pic : url('/images/default.png')}}"  title="Profile Img" alt="item0">
                  </div>
                  @php
                     $images = $user->photos;
                  @endphp
                  @if( $images )
                     @foreach($images as $key=>$row)
                     <div class="item" id="sel_img{{$key}}"> <img  src="{{ asset('/uploads/'.$row->image)}}" alt="item{{$key+1}}">
                     </div>
                     @endforeach
                  @endif

               </div>
            </div>
         </div>
      </div>
   </div>
   <button type="button" style="position: absolute; left: 10px; top: 10px; font-size: 40px;color: #fff;" class="close photo_close" data-dismiss="modal" title="Close"> <i class="fa fa-times-circle"></i></button>
   <a class="left carousel-control" style="left: 10px;top:50%;font-size: 40px;width:0;" href="#myGallery" role="button" data-slide="prev"> 
      <i class="fa fa-chevron-circle-left"></i>
   </a> 
   <a class="right carousel-control" style="right: 40px;top:50%;font-size: 40px;width:0;" href="#myGallery" role="button" data-slide="next"> 
      <i class="fa fa-chevron-circle-right"></i>
   </a>
</div>

@if(Auth::check())
@include('profile.upgrade_match_quest_package')
@endif
@endsection
@section('scripts')
<script src="{{ URL::asset('new-assets/common/js/common.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.js"></script>
<script src="{{ asset('backend/js/profile.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontendnew/js/gallery_slider.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('new-assets/common/plugins/croppie/croppie.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new-assets/common/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new-assets/common/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{ URL::asset('new-assets/frontend/js/upload_crop_image.js')}}" type="text/javascript"></script>
<script>
   var account_setup_profile_image_by_string_submit_url= "{{ route('profile.uploadprofile') }}";
   var account_setup_step_2_submit_url='{{url('/account-setup/profile-info')}}';
   var csrf_token ='{{ csrf_token() }}';
   var image_folder_url='{{ asset('/uploads') }}';
   var home_url='{{url('/home')}}';
</script>
<script>
   $(document).on("click", ".dddd", function(){
      $("#myModal1").attr('style','display:flex !important');
      $("#myModal1").css('opacity','0.9');
      $("#myModal1").css('background-color','#4b4f51');
      var dataId = $(this).data('id');
      $('.item').removeClass("active");
      $('#sel_img'+dataId).addClass("active");
      
   })
   $(document).on("click", function(e){
      // $("#myModal1").attr('style','display:flex !important');
      // $("#myModal1").css('opacity','0.9');
      // $("#myModal1").css('background-color','#4b4f51');
      if($(e.target).is('#upload_modal_btn')){
         console.log('dfdfdfdfdfd')
         $("#myModal1").attr('style','display:none !important');
         // $("#uploadphotomodal").modal('show');
      }
      if($(e.target).is('#myModal1')){
         $("#myModal1").attr('style','display:none !important');
         $('.item').removeClass("active");
         
      }
      if($(e.target).is('.profile_image')){
         $("#myModal1").attr('style','display:flex !important');
         $("#myModal1").css('opacity','0.9');
         $("#myModal1").css('background-color','#4b4f51');
         $('.item').removeClass("active");
         $('.default_item').addClass("active");
         $('#myModal1').modal('show');
      }
      if($(e.target).is('#view_photos_btn')){
         $("#myModal1").attr('style','display:flex !important');
         $("#myModal1").css('opacity','0.9');
         $("#myModal1").css('background-color','#4b4f51');
         $('.item').removeClass("active");
         $('.default_item').addClass("active");
         $('#myModal1').modal('show');
         
      }

      
   })
   $('.photo_close').click(function(){
      $('.item').removeClass("active");
   })
</script>
<script type="text/javascript">
   function comment(id,status){
    // var token = $(this).attr("data-token");
       $.ajax({
           url: "{{route('review.comment')}}",
           method: 'POST',
           dataType: "JSON",
           data: {
               "id": id,
               "status": status,
                 "_token": '{{ csrf_token() }}'
           },
           success: function (result)
           {
               console.log("It works");
               // nowclass.remove();
               if(result.status == 200)
               {
                   location.reload();
               }
           }
       });
   }

   function report(id){
       $.ajax({
           url: "{{route('review.abuse')}}",
           method: 'POST',
           dataType: "JSON",
           data: {
               "id": id,
               "_token": '{{ csrf_token() }}'
           },
           success: function (result)
           {
               console.log("It works");
               // nowclass.remove();
               if(result.status == 200)
               {
                   location.reload();
               }
           }
       });
   }




   $(document).ready(function(){
   $(".deleteProduct").click(function(){
       var nowclass = $(this).parents('.grid-item');
           var id = $(this).attr("data-id");
           $.ajax(
           {
               url: "{{url('userprofile/album/delete')}}/"+id,
               method: 'post',
               dataType: "JSON",
               data: {
                   "id": id,
                   "_token": '{{ csrf_token() }}'
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
   $('#addReviweBtn').click(function(){
    $('#tid').val($(this).data("id"));
    $('#reviewtype').val($(this).data("reviewtype"));
   });

      var url_auth_check='{{url("ajaxrequest/auth_check")}}';

         $(document).ready(function(){

      /* 1. Visualizing things on Hover - See next part for action on click */
      $('#stars li').on('mouseover', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

        // Now highlight all the stars that's not after the current hovered star
        $(this).parent().children('li.star').each(function(e){
          if (e < onStar) {
            $(this).addClass('hover');
          }
          else {
            $(this).removeClass('hover');
          }
        });

      }).on('mouseout', function(){
        $(this).parent().children('li.star').each(function(e){
          $(this).removeClass('hover');
        });
      });


      /* 2. Action to perform on click */
      $('#stars li').on('click', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var stars = $(this).parent().children('li.star');

        for (i = 0; i < stars.length; i++) {
          $(stars[i]).removeClass('selected');
        }

        for (i = 0; i < onStar; i++) {
          $(stars[i]).addClass('selected');
        }

        // JUST RESPONSE (Not needed)
        var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);


        if (ratingValue >= 1) {
          $('#stars_value').val(ratingValue);
        }
        responseMessage(msg);

      });


      // SUBMIT REVIEW BUTTON

      $("button#review-submit").click(function(e){
            e.preventDefault();

               $.ajax({
                   method: "POST",
                   url: "{{route('reviews.store')}}",
                   data: {
                       other_user_id  : $("#other_user_id").val(),
                       stars: $("#stars_value").val(),
                        subject: $("#subject").val(),
                        message: $("#message").val(),
                        type: $("#reviewtype").val(),
                        tid: $("#tid").val(),
                       _token: "{{csrf_token()}}"
                   },
               })
            .done(function( data ) {

                    // console.log(data);
                    if(data.status == 200){
                      $("#addReviewModal .errors-addReviewModal ").empty();
                      $("#addReviewModal .bodyform ").empty();
                        $("#addReviewModal .success-message").html("<h5 class='success'><i class='fa fa-check'> </i> "+data.message+"</h5>");
                        setInterval(function(){$('#addReviewModal').modal('toggle'); $('#addReviewModal').remove();  location.reload();  }, 3000);

                        //
                    }else if(data.status == 400){

                        $("#addReviewModal  .failure").remove();
                         $("#addReviewModal ..errors-addReviewModal ").append("<p class='failure'> "+data.message+"</p>");
                        $("#addReviewModal .modal-footer").empty();
                    }else{
                        $("#addReviewModal ..errors-addReviewModal").html("<h5 class='failure'><i class='fa fa-check'> </i> "+data.message+"</h5>");
                        $("#addReviewModal .modal-footer").empty();
                    }

            }).fail( function(xhr, textStatus, errorThrown){

                if(xhr.responseJSON.errors){
                  var errors  = xhr.responseJSON.errors;
                  $("#addReviewModal .errors-addReviewModal ").empty();
                  for(var key in errors){

                $("#addReviewModal .errors-addReviewModal ").append("<p class='failure'> "+errors[key]+"</p>")
              }
                }
            });

        });



    });


    function responseMessage(msg) {
      $('.success-box').fadeIn(200);
      $('.success-box div.text-message').html("<span>" + msg + "</span>");
    }



      $(document).ready(function(){

        $("button#submit").click(function(e){
          e.preventDefault();

          var agree = 0;
          if ($('#agree').is(":checked"))
          {
            agree = 1;
          }

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
                      $("#sendRequestBtn .modal-body").html("<h5 class='success'><i class='fa fa-check'> </i> "+data.message+"</h5>");
                      $("#sendRequestBtn .modal-footer").empty();
                      $('#sendRequestBtn').modal('toggle');
                      setInterval(function(){ $("#trialRequest_alert").remove(); }, 1000);

                      //
                  }else if(data.status == 400){

                      $("#sendRequestBtn .modal-body .terms .failure").remove();
                       $("#sendRequestBtn .modal-body .terms").append("<p class='failure'> "+data.message+"</p>");
                      $("#sendRequestBtn .modal-footer").empty();
                  }else{
                      $("#sendRequestBtn .modal-body").html("<h5 class='failure'><i class='fa fa-check'> </i> "+data.message+"</h5>");
                      $("#sendRequestBtn .modal-footer").empty();
                  }
                //location.reload();
              });

            });

          $("#noteselect").change(function(){
          var selectvalue = $("#noteselect option:selected").val();
          if(selectvalue=='other'){
              $(this).remove();
              $('.textareanote').append('<textarea type="text" class="form-control" name="note"></textarea>');
          }
      });
          $('.reportorblock').click(function(){
              var id = $(this).attr('data-id');
              if(id==1){
                  var type = 'report';
                  var btntxt = 'report';
                  var header = 'Report User <code>{{ ucfirst( $dispname ) }}</code>';
              }
              else{
                  var type = 'block';
                  var btntxt = 'block';
                  var header = 'Block User <code>{{ ucfirst( $dispname ) }}</code>';
              }
              $('#type').val(type);
              $('#subbtn_report_block').text(btntxt);
              $('.formreportblock .modal-title').html(header);
          });
          $('.slider-for').slick({
              slidesToShow: 1,
              slidesToScroll: 1,
              arrows: false,
              fade: true,
              asNavFor: '.slider-nav'
          });
          $('.slider-nav').slick({
              slidesToShow: 5,
              slidesToScroll: 1,
              asNavFor: '.slider-for',
              dots: false,
              centerMode: false,
              focusOnSelect: true
          });
              // masonary
          var $grid = $('.grid').isotope({
            itemSelector: '.grid-item',
            columnWidth: 160,
            gutter: 20,
            percentPosition: true,
            masonry: {
              columnWidth: '.grid-sizer'
            }
          });
      });

   $(document).ready(function(){
    $(".nav-tabs a").click(function(){
      $(this).tab('show');
    });

   });
</script>
<script type="text/javascript">
   var _gaq = _gaq || [];
   _gaq.push(['_setAccount', 'UA-36251023-1']);
   _gaq.push(['_setDomainName', 'jqueryscript.net']);
   _gaq.push(['_trackPageview']);

   (function() {
     var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
     ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
     var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
   })();
</script>
<script type="text/javascript">
  $(".selected").click(function(){
     $(".selected").removeClass('colors');
     $(this).addClass('colors');
     $("#noteselect").val($(this).text());
  });
   $("#btn_select_photos").click(function(){
       $(".photouploadsec").hide();
       $(".photoselectsec").show();
   })

   $("#btn_upload_new").click(function(){
       $(".photoselectsec").hide();
       $(".photouploadsec").show();
   })

   $(".setprofilelink").click(function(){
       var imgnm = $(this).data("selprofileimg");
       $.ajax({
         url: window.Laravel.url + '/profile/uploadselectedprofile',
          type: 'POST',
          data: {'_token': window.Laravel.csrfToken, 'profileimage':imgnm },
          dataType: 'JSON',
          success: function (response) {
               var html='';
               if(response.success)
               {
                   html+=''+
                   '<div class="alert alert-success alert-dismissable">'+' <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>'+
                   response.message +
                   '</div>';

                   jQuery('.frm_account_setup_profile_image_submit_msg').html(html);
                   $('img',$('.profile_image_display_container')).prop('src',image_folder_url+'/'+response.image_path);

                   modal_upload_profile_image.animate({ scrollTop: 0 }, 'slow');
                   jQuery('#hdn_image_uploaded').val(1);

                   setTimeout(function(){
                       modal_upload_profile_image.modal('hide');
                   },3000);
                   location.reload(true);
               }else
               {
                   html=getAlertBoxHtmlContainingErrorsReturnedFromServer(response);
                   modal_upload_profile_image.animate({ scrollTop: 0 }, 'slow');
               }
          }
       });
   })

   $(".setprofilecrop").click(function(){
       $("#uploadphotomodal").modal('hide');
       $('#modal_upload_profile_image_setprofile').modal('show');
           var imgnm = $(this).data("selprofileimg");
           var imgid = $(this).data("selprofileimgid");
           var imgpath = $(this).data("selprofileimgsrcpath");

           var basic = $('#crop_img_profile').croppie({
               viewport: {
                   width: 200,
                   height: 200,
                   type: 'square'
               },
               boundary: { width: 240, height: 240 },
               type: 'canvas',
               size: 'viewport'
           });

       $('#crop_img_profile').croppie('get');
       $('#crop_img_profile').croppie('bind',{
           url:imgpath,
           points: [77,469,280,739],
           slider:{min:0.5000, max:1.5000}
       });
       $('#crop_img_profile').find('.cr-slider-wrap .cr-slider').attr({'min':0.5000, 'max':1.5000});
       $("#button_crop_submmit").hide();
       $("#button_crop_prev").on('click', function(){
           $('#crop_img_profile').croppie('result','canvas').then(function (img) {
               html = '<img src="' + img + '" />';
               $("#crop_img_profile_prev").html(html);
               $("#button_crop_submmit").show();
           });

       });
       $('#button_crop_submmit').on('click', function (ev){
           $("#crop_img_profile_prev").html("");
           $('#crop_img_profile').croppie('result','canvas').then(function (img) {
             html = '<img src="' + img + '" />';
             var selected_file_name="";
             selected_file_name=imgnm;
             $.ajax({
                   url: account_setup_profile_image_by_string_submit_url,
                   type: "POST",
                   data: {"selected_file_name":selected_file_name,"image": img},
                   headers: { 'X-CSRF-TOKEN' : csrf_token },
                   success: function (response)
                   {
                       var html='';
                       if(response.success)
                       {
                           html+=''+
                               '<div class="alert alert-success alert-dismissable">'+
                               '   <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>'+
                               response.message +
                               '</div>';

                           jQuery('.profile_imgcrop_msg').html(html);
                           $("#modal_upload_profile_image_setprofile").animate({ scrollTop: 0 }, 'slow');
                           jQuery('#hdn_image_uploaded').val(1);

                           if(response.isfeatured == 0){
                               setTimeout(function(){
                                   $("#modal_upload_profile_image_setprofile").modal('hide');
                                   location.reload();
                               },5000);

                           }else{
                               setTimeout(function(){
                                   $("#modal_upload_profile_image_setprofile").modal('hide');
                               },3000);
                               location.reload();
                           }
                       }
                       else
                       {
                           html=getAlertBoxHtmlContainingErrorsReturnedFromServer(response);
                           jQuery('.profile_imgcrop_msg').html(html);
                           $("#modal_upload_profile_image_setprofile").animate({ scrollTop: 0 }, 'slow');
                       }
                   }
               });
           });
       });
   });

   $("#modal_upload_profile_image_setprofile .close, .uploadphotomodal .close").click(function(){
       location.reload();
   });
</script>
@endsection
