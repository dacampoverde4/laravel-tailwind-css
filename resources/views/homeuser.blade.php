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
<link rel="stylesheet" type="text/css" href="{{ asset('frontendnew/css/gallery_slider.css') }}"/>

<style>
    .row.user_request h4 {
      font-size: 14px;
      line-height: 18px;
      font-weight: 500;
    }
    #urgentNotification-btn {
        float: right;
        text-align: right;
    }
    #urgentNotification-btn a {
        font-size: 14px;
    }
    .alert-dismissible.urgentReminderPopup .close {
        top: -10px;
        right: -10px;
        z-index: 99;
      }
      .urgentReminderPopup {
        padding: 0;
        background-color: #fff;
        border-color: #fff;
      }
      .urgentReminderPopup .card {
        box-shadow: none;
      }
      .urgentReminderPopup .card.pd_lft {
        margin: 0;
      }
      .pull-right.viewAllTrial {
        text-align: right;
        font-size: 14px;
        padding: 10px 0 0 0;
      }
      .basic button span {
        color: white;
      }
    .TrialLocationSection .alert {
      padding-right: 20px;
      padding: 15px 25px;
    }
    .TrialLocationSection .close {
        padding: 0 4px 0 0px;
    }
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
.grid-item img {
    display: block;
    text-align: center;
    width: 100%;
}
a.deleteProduct {
    margin-bottom: 20px;
    position: relative;
    display: block;
    text-align: center;
    margin: 0px auto;
    z-index: 9;
    background-color: #f0f0f0;
}
a.deleteProduct i {
    font-size: 20px;
    padding: 5px 0;
}
.grid-item {
    height: 130px;
    overflow: hidden;
    padding: 0px;
    position: relative;
    border: 1px solid #cfcfcf;
    margin: 12px 0;
}
.dropzone .dz-preview.dz-error .dz-error-message {
    display: none !important;
}
</style>
@endsection
@section('main-content')


    <!-- Start Main Content ---->
    <!-- <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-envelope"> </i> Welcome to
                AvDopt {{\Illuminate\Support\Facades\Auth::user()->displayname}} ! We are the "A" in
                Adoption.</h3>
        </div>
    </div> -->

    <!-- Start notification ---->


    @php
        $warnings = App\Notification::where('user_id', Auth::user()->id)->where('type', 'warning')->where('is_seen', '1')->get();
    @endphp

    @if($warnings)
        @foreach($warnings as $warning)
            <div class="alert alert-warning alert-dismissible">
                <a href="javascript:void(0)" class="close warningmessages" data-dismiss="alert"
                   close-id="{{ $warning->id }}" aria-label="close">&times;</a>
                <strong>Warning: </strong>{{ $warning->message }} <?php //dump($warning); ?>
            </div>
        @endforeach
    @endif

    @php
        $announcements = App\Announcements::where('user_ids', 'NOT LIKE', '%"'.Auth::user()->id.'"%')->orderBy('id','DESC')->get();
        //dd($announcements);
    @endphp


    @if($deleted=='return back')
    <div class="container-fluid sccs_alrt_container">
        <div class="alert alert-success alert-dismissible" style="text-align: center">
                    <a href="javascript:void(0)" class="close announcementmessages" data-dismiss="alert"
                        aria-label="close">&times;</a>
                <strong >Welcome back !</strong>
        </div>
    </div>
    @endif

    @if($announcements)
    <div class="container-fluid anns_notfc_container">
     
          @foreach($announcements as $announcement)
              @if ($announcement->display_annoucement == 0)
                  <div class="alert alert-warning alert-dismissible">
                      @if(!$announcement->is_sticky)
                              <a href="javascript:void(0)" class="close announcementmessages" data-dismiss="alert"
                                 close-id="{{ $announcement->id }}" aria-label="close">&times;</a>
                      @endif
                          <strong>Announcement: </strong>{{ $announcement->content }}
                  </div>
              @endif
          @endforeach
     
    </div>
     @endif

    <div class="container-fluid user_dashboard_upgrd_sec">
    @if(session()->has('error'))
      <div class="alert alert-warning">
          {!! session()->get('error') !!}
      </div>
    @endif
    @if(session()->has('message'))
      <div class="alert alert-success">
          {!! session()->get('message') !!}
      </div>
    @endif
      <div class="row">
        <div class="col-md-12">
          <a href="{{ route('matchquests') }}">
          <div class="d_head_blcks">
            <div class="d_head_inner mquestsec">
              <img src="{{ url('/images/quest_icon.png')}}" class="">
              <h4>Match Quest</h4>
            </div>
          </div>
          </a>
          <div class="d_head_blcks">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#uploadphotomodal">
              <div class="d_head_inner up_photos">
                <img src="{{ url('/images/usrphotos_icon.png')}}" class="">
                <h4>Upload Photos</h4>
              </div>
            </a>

            @if( isthisSubscribed() )
                              <div class="modal fade" id="uploadphotomodal" role="dialog">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h4 class="modal-title font22">PHOTO UPLOAD</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          </div>
                                          <div class="modal-body">
                                              <p class="text-center">You may upload {{ @$newmetaInfo['sub_max_images_upload_'.$plandata->id] == -1 ? 'unlimited' : $newmetaInfo['sub_max_images_upload_'.$plandata->id] }} photos with your membership plan. Do not upload photos containing texts, nudity, nor 1st Life. Doing so will result in, account restriction or termination. For more information, please see our <a href="#" data-toggle="modal" data-target="#termsPopup">Terms</a> and <a href="#" data-toggle="modal" data-target="#policyPopup">Policy.</a></p>
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
          </div>

          <div class="d_head_blcks">
            <a href="{{ url('/trials') }}">
              <div class="d_head_inner trialsec">
                <img src="{{ url('/images/trial_icon.png')}}" class="">
                <h4>Trial Dates</h4>
              </div>
            </a>
          </div>
          <div class="d_head_blcks">
            <a href="{{ url('/tickets') }}">
              <div class="d_head_inner helpsec">
                <img src="{{ url('/images/helpcenter_icon.png')}}" class="">
                <h4>Tickets</h4>
              </div>
            </a>
          </div>
          <div class="d_head_blcks">
            <a href="{{ url('/donate') }}">
              <div class="d_head_inner donatesec">
                <img src="{{ url('/images/donatem_icon.png')}}" class="">
                <h4>Donate</h4>
              </div>
            </a>
          </div>
        </div>

      </div>
    </div>
    <div class="container-fluid usr_prof_sec">
        <div class="notify_sec">
            <div class="row">
                <div class="col-md-7 col-sm-12">

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


                                                    $adopter_family_role = FamilyRole::find($accepted->trial_family_role)->title;
                                                    $adopter_family_gender = (FamilyRole::find($accepted->trial_family_role)->gender == 'female')  ? "she" : "he" ;
                                                    $adoptee_family_role = FamilyRole::find($accepted->adoptee_family_role)->title;
                                                    $adoptee_family_gender = (FamilyRole::find($accepted->adoptee_family_role)->gender == 'female')? "she" : "he";


                                                    if(Auth::user()->id != $accepted->adopted_by &&  $accepted->user_id != $accepted->adopted_by){

                                                      $reciverUrl = url("userprofile").'/'.base64_encode($accepted->matcher_id);
                                                      $reciverName = $accepted->matcherid->display_name_on_pages;
                                                      $reciverLink = '<a href="'.$reciverUrl.'">'.$reciverName.'</a>';
                                                      $adopt_message_accept = "By signing this certificate, you promise to give ".$reciverLink." all of the love and care that ".$adoptee_family_gender."  require in return, your ".$adoptee_family_role." will give you all the love, comfort and attention you need. Failure to meet adoption requirements herein, may result in dissolution. ";
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
                                                           {{--  <a href="{{ route('adoptions.accept', $accepted->id) }}"
                                                               class="btn btn-success">Accept</a> --}}
                                                            <a class="btn btn-success" data-toggle="modal" id="btnModal{{$accepted->id}}" data-target="#acceptRequestBtn{{$accepted->id}}"> Accept</a>
                                                            <a href="{{ route('adoptions.decline', $accepted->id) }}"
                                                               class="btn btn-danger">Decline</a>

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
                                                                      <input type="hidden" name="trial" value="{{ $accepted->id }}" id="trial"/>


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
                                                              $heShe =  'she';
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
                                                          <a href="{{ route('trials.accept', $accepted->id) }}"
                                                             class="btn btn-success">Accept</a>
                                                          <a href="{{ route('trials.decline', $accepted->id) }}"
                                                             class="btn btn-danger">Decline</a>
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


                        <div class="notf_list">
                          @if($announcements)
                              @foreach($announcements as $announcement)
                                  @if ($announcement->display_annoucement == 1)
                                      <div class=" d-flex flex-row">
                                          <div class="img_cr ml-3">
                                              <img src="{{asset('backend/images/announcement.png')}}"
                                                   alt="user">
                                          </div>
                                          <div class="p-l-20 bdy_area">
                                              <h6 class="font-medium mr_btm">Announcement: {{$announcement->content}}</h6>
                                              <p>{{$announcement->created_at->diffForHumans()}}</p>
                                          </div>
                                      </div>
                                  @endif
                              @endforeach
                          @endif
                          @php
                              $notifications = getUserDashboardNotification();
                          @endphp

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
                                              <h6 class="font-medium mr_btm">{!! $notification->message !!}</h6>
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
                            <a href="{{url('/all-notifications')}}" class="btn btn-success chckallnt_btn">Check All Notifications</a>
                        </div>
                    </div>

                    <!-- <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="subs_sec new_sb ">
                                        <h1>AD SPONSORS</h1>
                                    </div>
                                    <div class="adsimgsec ads_300_250_size ptb10">
                                        <img src="{{ url('/images/300x250.jpg')}}" class="">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> -->


                </div>


                <div class="col-md-5 col-sm-12">

                    <div class="card wlt_sec">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-6 pr0" style="position:relative;">
                                    <div class="round align-self-center round-success walt_sec"><i
                                                class="ti-wallet"></i></div>
                                    <div style="margin-left: 10px;position: absolute;top: 18%;left:30%;" class="m-l-10 align-self-center walt_info">
                                        <h5 style="font-size:12px;" class="text-muted m-b-0">WALLET BALANCE</h5>
                                        <h3 class="m-b-0" style="font-size: 1.0rem;">@if(Auth::user()->balance){{  Auth::user()->balance }} @else
                                                0 @endif Tokens</h3>
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
                             <!--  @if(!empty($usersubscription)) -->
                                  <p>There's power in Premium! Access advanced search, chat features, visibility, 24/7 support, and more. </p>
                             <!--  @else
                                  <p>There's power in Featured! Access advanced search, chat features, visibility, 24/7 support, and more. </p>
                              @endif -->
                            </div>
                        </div>
                    </div>
                    {{-- here new  --}}

<div class="card">
                        <div class="card-body">

                            <div class="row feat_mem_sec">
                                <div class="col-md-6">
                                    <div class="subs_sec new_sb "><h1><i class="fa fa-user" aria-hidden="true"></i>
                                            Featured Members</h1></div>
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
                                        </div></a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- end from here --}}

                    {{-- <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row buy_tokens_sec">
                                <div class="col-xs-12 col-md-4 pdr0">

                                    <img src="{{ url('/images/tokenbundle.png')}}" alt="user"
                                         class="">
                                </div>

                                <div class="col-xs-12 col-md-8 rgt_para_sec">
                                    <h1>Buy tokens bundles & save</h1>
                                    <p>Take advantage of our Token bundle deals today and save big time!</p>
                                    <a href="{{ url('buy-tokens') }}" class="btn btn-success"> Buy tokens</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                </div>


                <div class="col-md-7 col-sm-8">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-xs-6 col-md-6 norpd_mob">
                                    <div class="subs_sec "><h1><img
                                src="{{ asset('frontend/images/heartsicon_match_black.png')}}" class="heart_blksec_img"> My Matches</h1></div>
                                </div>

                                <div class="col-xs-6 col-md-6">
                                    <div class="subs_sec nw_sb"><a href="{{ url('mymatches')}}" class="btn btn-success">
                                            My Matches</a></div>
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

                                                             <!-- <div class="modal fade" id="sendRequestBtn" role="dialog">
                                                                 <div class="modal-dialog">
                                                                     <div class="modal-content">

                                                                         <div class="modal-header">
                                                                             <button type="button" class="close" data-dismiss="modal">
                                                                                 <span aria-hidden="true">&times;</span>
                                                                                 <span class="sr-only">Close</span>
                                                                             </button>
                                                                             <h4 class="modal-title" id="myModalLabel">Adopt Request</h4>
                                                                         </div>

                                                                         <div class="modal-body">
                                                                             <p class="statusMsg"></p>
                                                                             <form class="form-horizontal form_common submitAdoptForm" id="submitAdoptForm" role="form" name="submitAdoptForm" method="POST">
                                                                              <input type="hidden" name="trial" value="{{ $checkReq->id }}" id="trial"/>
                                                                               <div class="row">
                                                                                 <div class="form-group">
                                                                                     <label for="adoptee_family_role" class="col-md-3 col-form-label text-md-right">Adoptee Family role</label>
                                                                                     <div class="col-md-6">
                                                                                         <select class="form-control searchdropdown" id="adoptee_family_role" name="adoptee_family_role">
                                                                                            @foreach($familyroles as $row)
                                                                                             <option value="{{ $row->id }}"><?php echo $row->title ?></option>
                                                                                            @endforeach
                                                                                         </select>
                                                                                    </div>
                                                                                 </div>
                                                                               </div>
                                                                               <div class="row">
                                                                                 <div class="form-group">
                                                                                     <div class="col-md-12">
                                                                                       I have read and agree to the <a href="http://laravel.avdopt.com/terms">Terms</a> and <a href="http://laravel.avdopt.com/policy">Privacy
                                                                                                               Policy.</a>
                                                                                       <input type="checkbox" class="form-control" id="agree" name="agree" value="1"/>
                                                                                     </div>
                                                                                 </div>
                                                                               </div>
                                                                             </form>
                                                                         </div>

                                                                         <div class="modal-footer">
                                                                             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                             <button type="button" class="btn btn-primary submitBtn" id="submit">SUBMIT</button>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div> -->

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
                                    <div class="subs_sec "><h1><i class="fa fa-thumbs-up" aria-hidden="true"></i>My
                                            Likes</h1></div>
                                </div>

                                <div class="col-xs-6 col-md-6">
                                    <div class="subs_sec nw_sb"><a href="{{ url('mylikes')}}" class="btn btn-success">
                                            My Likes</a></div>
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
                                            Visitors</h1>
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


                <div class="col-md-5 col-sm-4">
                    {{-- Paset here Freature menmber --}}
                    <div class="adsimgsec ads_240_400_size ptb10 home_right_img">
                                     <img src="http://laravel.avdopt.com/images/970x250.png" alt="user" >
                    </div>

                </div>

            </div>

            <div class="card actv_usr_sec">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-7 col-md-6 nopad_mob">
                            <h2 class="mb font20 inline_block actv_usr_ttl"><b>

                              <i class="fa fa-user" aria-hidden="true"></i>
                                    Active Members</b></h2>
                        </div>
                        <div class="col-xs-5 col-md-6">
                            <button type="button" onclick="location.href='{{route('browse')}}'"
                                    class="btn btn-success pull-right brw_btn">Browse
                            </button>
                        </div>
                    </div>

                    <div class="row">

                        @if(!empty($activeusers))
                            @foreach( $activeusers as $activeuser )
                                <div class="col-xs-12 col-md-2">
                                    <a href="{{route('viewprofile', base64_encode( $activeuser->id ))}}">
                                        <div class="user_active">
                                            <img class="profile-img" src="{{ $activeuser->profile_pic_url }}"
                                                 alt="">
                                            @if( $activeuser->is_online )
                                                <span class="green"></span>
                                            @endif
                                            <h3 class="lead active_usrname" align='center'>
                                                {{ ucfirst( $activeuser->display_name_on_pages ) }}
                                            </h3>
                                            <span class="active_childnm">{{ @$activeuser->usergroup->title}}</span>
                                        </div>
                                    </a>
                                </div>


                            @endforeach
                        @endif


                    </div>
                </div>
            </div>

            <div class="card upcm_evnts_sec">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-7 col-md-6 nopad_mob">
                            <h2 class="mb font20 inline_block upcm_evnts_ttl"><b> <img
                                            src="{{ asset('/backend/images/usergroup.png')}}"></i>
                                    Upcoming Events</b>
                            </h2>
                        </div>
                        <div class="col-xs-5 col-md-6">
                            <button type="button" onclick="location.href='{{route('saved.events.index')}}'"
                                    class="btn btn-success pull-right brw_btn">Browse
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="tblesec">
                                <table class="table table-bordered ">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th width="15%">Location</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if( $upcoming_events )
                                        @if(count($upcoming_events)>0)
                                            @foreach( $upcoming_events as $upcoming_event)
                                                <tr>
                                                    <td>{{ $upcoming_event->title }}</td>
                                                    <td>{{$upcoming_event->event_date_display}} (SLT)</td>
                                                    <td>
                                                        @if($upcoming_event->location_url)
                                                            <a target="_blank" class="btn btn-sm btn-success"
                                                               href="{{$upcoming_event->location_url }}">Visit
                                                                Location</a>
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3" class="text-center text-danger">No Upcoming event</td>
                                            </tr>
                                        @endif
                                    @else
                                        <tr>
                                            <td colspan="3" class="text-center text-danger">No Upcoming event</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <input value="{{ csrf_token() }}" data-id="{{ Auth::user()->id }}" type="hidden" id="token">

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
<script src="{{asset('js/bootstrap.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.js"></script>
<script src="{{ asset('backend/js/profile.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontendnew/js/gallery_slider.js') }}" type="text/javascript"></script>

<script type="text/javascript">
  $(document).ready(function () {




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
@endsection
