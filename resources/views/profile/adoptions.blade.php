@extends('layouts.master')
@section('htmlheader')
@php
use App\FamilyRole;
@endphp
<link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}"/><link rel="stylesheet" type="text/css" href="http://kenwheeler.github.io/slick/slick/slick-theme.css"/>
<link rel="stylesheet" href="{{asset('user/css/bowseModal.css')}}">
<script type="text/javascript" src="{{ asset('js/slick.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
   .modal .form-group p{
    padding: 10px;
}
.adptreq .modal-header button.close span{
    margin: 0;
    font-size: 24px;
}
.adptreq input[type="checkbox"] {
    height: 20px;
    width: 20px;
}
.adptreq .terms p{
    padding: 5px 0 0;
}
.adptreq .modal-body{
    padding-bottom: 24px;
}
.success{
    color:green;
}
.failure{
    color: red;
}
.disInline{
  display: inherit;
}
.fltlft{
  float: left;
}
#modal_upload_profile_image .close {
    float: right;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    opacity: .5;
}
#modal_upload_profile_image .close {
    padding: 0;
    margin: 0;
}
.requestActionButtons {
    float: right;
}
form.advopterForm input[type="radio"] {
    left: 0;
    opacity: 1;
    position: relative;
}
#agree {
	margin: 6px 10px 0 0px;
}
.trialSuccessPopup .modal-dialog {
	/* width: 800px; */
	max-width: 600px;
}
.requestActionButtons a {
	font-size: 14px;
}
.trial_req_sec .page-titles {
	padding: 20px !important;
}
.leftSidebar ul li {
	width: 100%;
}
.tabIcons {
	height: 40px;
	margin-right: 8px;
}
.nav.nav-tabs.customtab li a span {
	font-size: 16px;
	font-weight: 600;
	text-align: left;
}
.nav.nav-tabs.customtab li {
	background: #eee;
	margin-bottom: 2px;
}
.card-no-border .card {
	padding: 15px;
}
.customtab li a.nav-link{
	padding: 8px 10px;
}
.customtab.nav-tabs {
	border-bottom: none;
}
.mainContent .tab-content {
	padding-top: 0;
}
.trialDefaultText {
	font-size: 15px;
	color: #000;
	line-height: 22px;
	text-align: left;
}
.request-header img {
    height: 80px;
    width: 80px;
    border-radius: 50%;
}
.request-content {
	border: 1px solid #eee;
	border-radius: 4px;
	box-shadow: 0 0px 3px rgba(0,0,0,.5);
  margin-bottom: 15px;
}
.request-header,.request-body {
	border-bottom: 1px solid #eee;
	padding: 10px;
}
.request-footer{
  padding: 10px;
  text-align: center;
}

/****new*****/
.bnrp0 {
    padding: 0;
}
.bnrp0 h4 {
    background-color: #2b2b2b;
    color: #fff;
    text-align: center;
    padding: 16px 0px;
    font-size: 35px;
    font-weight: 400;
}
.middlecontent .requestActionButtons {
    float: inherit;
    display: flex;
    margin: 0px 0px;
}
.middlecontent .requestActionButtons a {
    margin: 0px 4px;
}
.usenamwe h4 {
    color: #1976d2;
    font-size: 15px;
    text-align: center;
    margin: 10px 0px;
    font-weight: 700;
}
.midleinfouser:after {
    content: '';
    position: absolute;
    width: 90%;
    height: 2px;
    background-color: #dadada;
    display: inline-block;
    top: 34%;
    left: 50%;
    transform: translate(-50%,-50%);
}
.midleinfouser {
    position: relative;
    width: 100%;
}
.midltxtlft span:after {
    content: '';
    height: 20px;
    width: 20px;
    background-color: #67d6f2;
    position: absolute;
    border-radius: 50%;
      top: -17px;;
    left: 50%;
    transform: translateX(-50%);
    z-index: 999;
  }
.midltxtrgt span:before {
  content: '';
      height: 20px;
      width: 20px;
      background-color: #67d6f2;
      position: absolute;
      border-radius: 50%;
          top: -17px;
      right: 42%;
      transform: translateX(-50%);
      z-index: 999;
}
.midleinfouser {
    position: relative;
    width: 70%;
    display: flex;
    justify-content: space-around;
    align-items: center;
}

.midltxtlft, .midltxtrgt {
    width: 50%;
    display: inline-block;
    text-align: center;
    position: relative;
}
.midleinfouser span {
    text-transform: capitalize;
    color: #333;
    font-weight: 800;
    font-size: 16px;
}
.arw:after {
    content: '';
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 4px 13px 4px 0;
    border-color: transparent #dadada transparent transparent;
    position: absolute;
    top: 34%;
    transform: translateY(-50%);
    left: 23px;
}
.arw:before {
    content: '';
    width: 0;
  height: 0;
  border-style: solid;
  border-width: 4px 0 4px 13px;
  border-color: transparent transparent transparent #dadada;
    position: absolute;
    top: 34%;
    transform: translateY(-50%);
    right: 23px;
}
.middlecontent .requestActionButtons a {
    margin: 0px 4px;
    text-transform: uppercase;
    padding: 7px 15px;
    line-height: 16px;
}
.col-md-2.leftSidebar li a {
    padding: 20px 38px !important;
    background-position: -3px 10px;
    background-size: 43px;
}
.bnrp0 h4 img {
    filter: invert(1);
}

.borderline {
    padding: 0px 20px;
}
.request-body p {
    margin-bottom: 0px;
}

/* TAGS CSS  STARTS HERE */

.tags {
  list-style: none;
  margin: 0;
  overflow: hidden; 
  padding: 0;
}

.tags li {
  float: left; 
}

.tag {
  background: #fff4f4;
  border-radius: 3px 0 0 3px;
  color: #3a3a3a;
  display: inline-block;
  height: 26px;
  line-height: 26px;
  padding: 0 27px 0 27px;
  position: relative;
  margin: 0 10px 10px 0;
  text-decoration: none;
  -webkit-transition: color 0.2s;
}

.tag::before {
  background: #989898;
  border-radius: 10px;
  box-shadow: inset 0 1px rgba(0, 0, 0, 0.25);
  content: '';
  height: 6px;
  left: 10px;
  position: absolute;
  width: 6px;
  top: 10px;
}

.tag::after {
  background: #fff;
  border-bottom: 13px solid transparent;
  border-left: 10px solid #eee;
  border-top: 13px solid transparent;
  content: '';
  position: absolute;
  right: 0;
  top: 0;
}

.tag:hover {
  background-color: crimson;
  color: white;
}

.tag:hover::after {
   border-left-color: crimson; 
}

/* TAGS CSS ENDS HERE */

 @media screen and (max-width:1199px){
   .col-md-2.leftSidebar li a {
       padding: 54px 4px 4px !important;
       background-position: center;
       background-size: 37px;
       text-align: center;
   }

 }

 @media screen and (max-width:567px){
   .table tr {
    border-top: 1px solid #dee2e6;
}
.table td {
    display: block;
    border: 0;
    padding: 6px 11px;
}
.hidden-xs-down {
    display: block !important;
    text-align: center !important;
}
span.hidden-sm-up {
    display: none;
}
 }


  @media screen and (max-width:480px){
    .middlecontent table.table {
        width: 100%;
        overflow-x: scroll;
        display: block;
    }
    .middlecontent .requestActionButtons a {
    margin: 0px 3px;
    text-transform: uppercase;
    padding: 7px 8px;
    line-height: 16px;
    font-size: 12px;
}

  }

  .trialSPagnation {
  	float: left;
  	width: 100%;
  	margin: 50px 0 0;
  }
  .rightBanner-images img {
  	width: 100%;
  	margin: 5px 0;
  }
  .featuredmembers {
  	margin: 15px 0;
  	width: 100%;
  	float: left;
  }
  .featuredmembers p {
  	font-size: 14px;
  	font-weight: 600;
  }
  .subs_sec.shrt_sb span {
  	font-size: 12px;
  	line-height: 16px;
  	text-align: center;
  	float: left;
  	width: 100%;
  	margin: 5px 0 10px 0;
  }
  .trialFeature-members {
  	padding: 0;
  	list-style: none;
  	float: left;
  	width: 100%;
  }
  .trialFeature-members li {
  	float: left;
  	width: auto !important;
  	margin: 3px;
  	display: inline-block;
  }
  .trialFeature-members .img-circle {
  	width: 45px;
  	height: 45px;
  }
  .trialFeature-members .match_img {
  	margin: 0;
  }
  .addBanners-sidebar {
  	height: 470px;
  	background: #000;
  	color: #fff;
  	font-size: 20px;
  	text-align: center;
  	display: flex;
  	align-items: center;
  	justify-content: space-around;
  	margin: 15px 0;
  	float: left;
  	width: 280px;
  }
  .maintbrow .label {
      padding: 7px 15px;
      line-height: 16px;
      color: #ffffff;
      font-weight: 400;
      border-radius: 4px;
      font-size: 14px;
      margin: 0px 4px;
      text-transform: uppercase;
  }
</style>
@endsection
@section('main-content')

            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->

            <div class="container-fluid page-titles">
              <div class="row">
              @if(session()->has('message') || @$message)
                  <div class="col-md-12 alert alert-success">
                      {!!  @$message ? : session()->get('message') !!}
                  </div>
              @endif
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Adoptions Requests</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item">Adoptions Requests</li>

                    </ol>
                </div>
              </div>
            </div>

            <div class="container-fluid trial_req_sec">
                <div class="card">
              <div class="row">
                <div class="col-md-3 leftSidebar">
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs customtab" role="tablist">
                      <li class="nav-item" style="width: 100%;"> <a style="background-image:url({{ asset('images/all-requests.png') }}); background-repeat: no-repeat; padding: 20px 60px;" class="nav-link active" href="{{route('adoptions.index')}}" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">All Requests</span></a> </li>
                      <li class="nav-item" style="width: 100%;"> <a style="background-image:url({{ asset('images/adoptions.png') }}); background-repeat: no-repeat; padding: 20px 60px;" class="nav-link" href="{{route('adoptions.my-adoptions')}}" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">My Adoptions</span></a> </li>
                      <li class="nav-item" style="width: 100%;"> <a style="background-image:url({{ asset('images/certificates.png') }}); background-repeat: no-repeat; padding: 20px 60px;" class="nav-link" href="{{route('adoptions.certificates')}}" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Certificates</span></a> </li>
                  </ul>
                  <!-- Tab panes -->
                  <div class="featuredmembers">
                    <div class="subs_sec new_sb ">
                        <p><b><i class="fa fa-user" aria-hidden="true"></i>
                            Featured Members</b></p>
                     </div>
                    @php
                        $featuredUsers = getSubscribedFeatureUsers();
                    @endphp
                    @if($featuredUsers)
                    <ul class="trialFeature-members">
                        @foreach($featuredUsers as $featuredUser)
                            @php
                            if($featuredUser->user->profile_pic){
                              $profilepic = ( $featuredUser->user->profile_pic )? 'uploads/'.$featuredUser->user->profile_pic : 'images/default.png';
                            }
                                 
                            @endphp
                            <li>
                            <a href="{{ url('userprofile')}}/{{ base64_encode($featuredUser->user->id) }}">
                                <div class="match_img">
                                    <img src="{{ asset($profilepic) }}" alt="user" class="img-circle" />
                                </div>
                            </a>
                          </li>
                        @endforeach
                      </ul>
                      @endif
                      <div class="subs_sec shrt_sb"><span>Want to stand out from the crowd?</span></div>
                      <a data-toggle="modal" data-target="#feeaturePlanModal" class="btn btn-success" id="featurePlan-btn"> Get Featured
                      </a>
                    </div>
                    <div class="addBanners-sidebar">
                        <p>AD BANNER</p>
                    </div>
                  </div>
                <div class="col-md-7 mainContent middlecontent">
                  <div class="card-body p-b-0 bnrp0">
                      <h4 class="card-title"><span>ADD BANNER</span></h4>
                  </div>
                        <!-- Tab panes -->
                      <div class="tab-content">
                          <div class="tab-pane active" id="{{route('adoptions.index')}}" role="tabpanel">
                            @if($allrequests)
                            <div class="row maintbrow">

                                @foreach($allrequests as $request)

                                @php
                                        // print_r($request->toArray());exit;
                                      @endphp
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                  <div class="request-content">
                                    <div class="request-header">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <div class=" borderline  d-flex justify-content-between">
                                            @php
                                            $getFamilyRoleUserInfo = FamilyRole::find($request->trial_family_role);
                                            $getFamilyRoleMatcherInfo = FamilyRole::find($request->adoptee_family_role);
                                            @endphp
                                          <div class="userA">
                                            @if($request->matcher_id)
                                              <img src="{{ url('uploads')}}/{{$request->matcherid->profile_pic}}" class="img-responsive"/>
                                            @endif
                                          <div class="usenamwe">
                                            <h4>
                                              @if($request->matcher_id)
                                              <a href="{{ url('userprofile')}}/{{base64_encode($request->matcher_id)}}">{{$request->matcherid->display_name_on_pages}}</a>
                                              @endif
                                            </h4>
                                          </div>
                                        </div>
                                        <div class="midleinfouser">
                                          <div class="arw"></div>
                                          <div class="midltxtlft">

                                            @if($request->matcher_id)
                                              <span>{{$getFamilyRoleMatcherInfo->title}}</span>
                                            @endif

                                             </div>
                                             <div class="midltxtrgt">
                                               @if($request->user_id)
                                                 <span>{{$getFamilyRoleUserInfo->title}}</span>
                                               @endif

                                             </div>
                                        </div>
                                        <div class="userB">
                                          @if($request->user_id)
                                            <img src="{{ url('uploads')}}/{{$request->userid->profile_pic}}" class="img-responsive"/>
                                          @endif

                                        <div class="usenamwe">
                                          <h4>
                                            @if($request->user_id)
                                            <a href="{{ url('userprofile')}}/{{base64_encode($request->user_id)}}">{{$request->userid->display_name_on_pages}}</a>
                                            @endif

                                          </h4>
                                        </div>
                                      </div>
                                        </div>
                                      </div>

                                      </div>
                                    </div>

                                  <div class="request-body">



                                      @if($request->adopt_is_accepted == 1 && $request->adopted_by == Auth::user()->id)
                                          <p class="remaining_time"><b>{{ ($request->user_id == Auth::user()->id)  ?  $request->matcherid->display_name_on_pages :  $request->userid->display_name_on_pages}}</b> accepted <b>Your</b> adoption request.</p>
                                      @endif


                                      @if($request->adopt_is_decline == 2 && $request->adopted_by == Auth::user()->id)
                                          <p class="remaining_time"><b>{{ ($request->user_id == Auth::user()->id)  ?  $request->matcherid->display_name_on_pages :  $request->userid->display_name_on_pages}}</b> declined <b>Your</b> adoption request.</p>
                                      @endif

                                      @if($request->adopt_is_decline == 2 && $request->adopted_by != Auth::user()->id)
                                           <p class="remaining_time"><b>You've</b> declined <b>{{ ($request->user_id == Auth::user()->id)  ?  $request->matcherid->display_name_on_pages :  $request->userid->display_name_on_pages}}'s</b> adoption request.</p>
                                      @endif
                                       

                                      @if($request->adoption_success == 1  &&  $request->adopt_is_decline != 2 && $request->adopt_is_accepted != 1 && $request->adopted_by == Auth::user()->id)

                                        @if($request->matcher_id != Auth::user()->id)
                                            <p class="remaining_time"><b>You've</b> sent an adoption request to <b>{{$request->matcherid->display_name_on_pages}}</b>.</p>
                                        @else
                                             <p class="remaining_time"><b>You've</b> sent an adoption request to <b>{{$request->userid->display_name_on_pages}}</b>.</p>
                                        @endif
                                      
                                    @endif
                                    @if($request->adopt_is_accepted == 1 && $request->adopted_by != Auth::user()->id )
                                      <p class="remaining_time"><b>You've</b> accepted <b>{{ ($request->user_id == Auth::user()->id)  ?  $request->matcherid->display_name_on_pages :  $request->userid->display_name_on_pages}}'s</b> adoption request.</p>
                                      @endif


                                      @if($request->adoption_success == 1 && $request->adopt_is_decline != 2 && $request->adopt_is_accepted != 1 && $request->adopted_by != Auth::user()->id)
                                        @if($request->user_id != Auth::user()->id)
                                          <p class="remaining_time"><b>You've</b> recived an adoption request from <b>{{$request->userid->display_name_on_pages}}</b></p>
                                        @else
                                            <p class="remaining_time"><b>You've</b> recived an adoption request from <b>{{$request->matcherid->display_name_on_pages}}</b></p>
                                        @endif
                                    @endif
                                  </div>
                                  <div class="request-footer">
                                    <div class="requestActionButtons">

                                      @if($request->adoption_success == 1 && $request->adopted_by == Auth::user()->id)
                                         <span class="tag">Sent</span>
                                      @endif

                                      @if($request->adoption_success == 1 && $request->adopted_by != Auth::user()->id)
                                         <span class="tag">Recieved</span>
                                      @endif

                                      @if($request->adopt_is_decline == 2)
                                        <span class="tag">Declined</span>
                                      @endif

                                      @if($request->adopt_is_accepted == 1)
                                        <span class="tag">Adopted</span>
                                      @endif

                                      @php
                                        $adopter_family_role = FamilyRole::find($request->trial_family_role)->title;
                                        $adopter_family_gender = (FamilyRole::find($request->trial_family_role)->gender == 'female')  ? "she" : "he" ;
                                        $adoptee_family_role = FamilyRole::find($request->adoptee_family_role)->title;
                                        $adoptee_family_gender = (FamilyRole::find($request->adoptee_family_role)->gender == 'female')? "she" : "he";


                                        if(Auth::user()->id != $request->adopted_by &&  $request->user_id != $request->adopted_by){

                                          $reciverUrl = url("userprofile").'/'.base64_encode($request->matcher_id);
                                          $reciverName = $request->matcherid->display_name_on_pages;
                                          $reciverLink = '<a href="'.$reciverUrl.'">'.$reciverName.'</a>';
                                          $adopt_message_accept = "By signing this certificate, you promise to give ".$reciverLink." all of the love and care that ".$adoptee_family_gender."  require in return, your ".$adoptee_family_role." will give you all the love, comfort and attention you need. Failure to meet adoption requirements herein, may result in dissolution. ";
                                      }else{

                                          $reciverUrl = url("userprofile").'/'.base64_encode($request->user_id);
                                          $reciverName = $request->userid->display_name_on_pages;
                                          $reciverLink = '<a href="'.$reciverUrl.'">'.$reciverName.'</a>';
                                          $adopt_message_accept = "By signing this certificate, you promise to give ".$reciverLink." all of the love and care that ".$adopter_family_gender." require in return, your ".$adopter_family_role." will give you all the love, comfort and attention you need. Failure to meet adoption requirements herein, may result in dissolution. ";
                                      }

                                      @endphp

                                      @if($request->adoption_success == 1 && $request->adopt_is_accepted == 0  && $request->adopt_is_decline != 2 && $request->adopted_by != Auth::user()->id)
                                      {{-- <a class="btn btn-success" href="{{ route('adoptions.accept', $request->id) }}">Accept</a> --}}
                                      <a class="btn btn-success" data-toggle="modal" id="btnModal{{$request->id}}" data-target="#acceptRequestBtn{{$request->id}}"> Accept</a>


                                          {{-- START MODAL CODE HERE  --}}
                                          <div class="modal fade" id="acceptRequestBtn{{$request->id}}" role="dialog">
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
                                                          <input type="hidden" name="trial" value="{{ $request->id }}" id="trial"/>


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
                                           </div>
                                            {{-- END MODAL CODE HERE  --}}

                                     
                                      <a class="btn btn-danger" href="{{ route('adoptions.decline', $request->id) }}">Decline</a>
                                      {{-- <a class="btn btn-info" href="{{ route('adoptions.reschedule', base64_encode($request->matcher_id)) }}">Reschedule</a> --}}
                                      @endif
                                       <a class="btn btn-success" href="{{ route('adoptions.decline', $request->id) }}">Chat</a>

                                      @if($request->adopt_is_decline == 2 && $request->user_id == Auth::user()->id)
                                        <a class="btn btn-danger" href="{{ route('adoptions.cancelrequest', $request->id) }}">Cancel Request</a>
                                      @endif
                                      @if($request->adoption_success == 1 && $request->adopt_is_accepted == 1)
                                        <a href="{{ url('certificate')}}/{{base64_encode($request->id)}}" class="btn btn-success" >See Certificate</a>
                                      @endif

                                    </div>

                                  </div>
                                  </div>
                                  </div>

                                @endforeach
                            @endif
                          </div>
                            <div class="trialSPagnation">
                              {{ $allrequests->links() }}
                            </div>
                          </div>

                  </div>
                </div>
                  <div class="col-md-2 rightSidebar">
                    <div class="rightBanner-images">
                        <img src="{{ url('images')}}/img2.jpg" class="img-respomsive" />
                        <img src="{{ url('images')}}/img2.jpg" class="img-respomsive" />
                        <img src="{{ url('images')}}/img2.jpg" class="img-respomsive" />
                        <img src="{{ url('images')}}/img2.jpg" class="img-respomsive" />
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
                                        <img class="img-responsive" alt="Profile Img"
                                             src="{{asset('frontend/images/flame.png')}}">GET FEATURED</h5>
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
                                                            <div class="feat_infop"><p class=" mtop20">{{ $featuredPlan->info }}</p></div>
                                                            @if( $subscription )
                                                                @php
                                                                    $user = App\User::find(Auth::user()->id);
                                                                @endphp
                                                                @if( $subscription->stripe_plan == $featuredPlan->plan_id && $user->subscribed('feature') && ( !$user->subscription('feature')->onGracePeriod() ) )
                                                                    <form class="form-horizontal " role="form" method="POST"
                                                                          action="{{ url('/')}}/subscription/featurecancel">
                                                                        @csrf
                                                                        <input type="hidden" name="chargeId"
                                                                               value="{{ $featuredPlan->plan_id }}">
                                                                        <button type="submit"
                                                                                onclick="return confirm('Are you sure you want to cancel this plan?')"
                                                                                class="mtop10 mb popbtn"><span>Cancel</span>
                                                                        </button>
                                                                    </form>
                                                                @else
                                                                    <form class="form-horizontal " role="form" method="POST"
                                                                          action="{{ url('/')}}/subscription/checkout">
                                                                        @csrf
                                                                        <input type="hidden" name="chargeId"
                                                                               value="{{ $featuredPlan->plan_id }}">
                                                                        <button type="submit"
                                                                                onclick="return confirm('Are you sure you want to upgrade this plan?')"
                                                                                class="mtop10 mb popbtn"><span>Buy Now</span>
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            @else
                                                                <form class="form-horizontal " role="form" method="POST"
                                                                      action="{{ url('/')}}/subscription/checkout">
                                                                    @csrf
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
<script type="text/javascript">
    $(document).ready(function(){
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

        $('#accepted .btn').click(function(){
            var href = $(this).attr('link');
            var id = $(this).attr('data-id');
            $('#forsucccess').attr('action',href);
            $('#hiddenval').val(id);
        });
    });
</script>
@endsection
