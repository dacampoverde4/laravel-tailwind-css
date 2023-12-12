@extends('layouts.master')
@section('htmlheader')
@php
use App\TrialLocation;
use App\FamilyRole;
@endphp
<link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}"/><link rel="stylesheet" type="text/css" href="http://kenwheeler.github.io/slick/slick/slick-theme.css"/>
<link rel="stylesheet" href="{{asset('user/css/bowseModal.css')}}">
<script type="text/javascript" src="{{ asset('js/slick.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection
@section('main-content')

            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->



            <div class="container-fluid trial_req_sec">
              <div class="row page-titles">
                @if(session()->has('message'))
                    <div class="col-md-12 alert alert-success">
                        {!! session()->get('message') !!}
                    </div>
                @endif
                  <div class="col-md-5 align-self-center padding0">
                      <h3 class="text-themecolor">Active Trial Dates</h3>
                  </div>
                  <div class="col-md-7 align-self-center">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                          <li class="breadcrumb-item">Trials Requests</li>

                      </ol>
                  </div>
              </div>
                    <div class="col-md-12 pd_all0">
                        <div class="card">
                            <!-- <div class="card-body p-b-0">
                                <h4 class="card-title"><b class="vertical_align"><img src="{{ asset('backend/images/trial.png') }}" alt="" class="all_users"><span>TRIAL REQUESTS</span></b></h4>
                            </div> -->
                            <div class="row">
                            <div class="col-md-3 leftSidebar">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs customtab" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link" href="{{ route('trials.index')}}">
                                    <span class="hidden-sm-up"><i class="ti-home"></i></span>
                                    <span class="hidden-xs-down"><img src="{{ url('images')}}/Connected_Users.png" class="tabIcons"/> All Requests</span></a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link active" href="{{ route('trials.activeTrialsIndex')}}" >
                                    <span class="hidden-sm-up"><i class="ti-user"></i></span>
                                    <span class="hidden-xs-down"><img src="{{ url('images')}}/Timer.png" class="tabIcons"/> Active Trial Dates</span></a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="{{ route('trials.sentTrialsIndex')}}">
                                    <span class="hidden-sm-up"><i class="ti-email"></i></span>
                                    <span class="hidden-xs-down"><img src="{{ url('images')}}/TaskList.png" class="tabIcons"/> Sent Requests</span></a>
                                </li>
                                <!-- <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#decline" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Declined</span></a> </li> -->
                                <li class="nav-item">
                                  <a class="nav-link" href="{{ route('trials.expiredTrialsIndex')}}">
                                    <span class="hidden-sm-up"><i class="ti-email"></i></span>
                                    <span class="hidden-xs-down"><img src="{{ url('images')}}/Scheduled_Event.png" class="tabIcons"/>Expired Trial Dates</span></a>
                                </li>
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
                                           $profilepic = ( $featuredUser->user->profile_pic )? 'uploads/'.$featuredUser->user->profile_pic : 'images/default.png';
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
                            <!--
                            <div class="addBanners-sidebar">
                                <p>AD BANNER</p>
                            </div>
                          -->
                          <div class="adsimgsec ads_240_400_size ptb10 active_trials_left-img">
                                    <img src="http://laravel.avdopt.com/images/240x400.jpg" class="">
                          </div>
                          </div>
                          <div class="col-md-7 mainContent">
                            <div class="tab-content">
                              <div class="col-md-12 banner active_trials_ban_img">
                                <img src="http://laravel.avdopt.com/assets/images/match_quest_categoies/PAQJ0m1k2g_1573238630_.jpg" class="banner" alt="your image">
                             </div>

                                <div class="tab-pane  active p-20" id="profile2" role="tabpanel">
                                  @php
                                    $flag=0;
                                  @endphp
                                      @if(count($accepted) > 0)
                                      <div class="row">
                                          @foreach($accepted as $request)
                                          @if($request->is_accepted == 1 && $request->is_maybe == 0)
                                          @php
                                            $flag=1;
                                          @endphp
                                          <?php
                                          $getLocation = TrialLocation::find($request->trial_location_id);
                                          $getFamilyRoleInfo = FamilyRole::find($request->trial_family_role);
                                           ?>
                                           <div class="col-md-6 col-sm-6 col-lg-6">
                                             <div class="request-content">
                                              <div class="request-header">
                                                  <div class="row">
                                                    <div class="col-md-4">
                                                      @if($request->user_id == Auth::user()->id)
                                                        <img src="{{ url('uploads')}}/{{$request->matcherid->profile_pic}}" class="img-responsive"/>
                                                      @endif
                                                      @if($request->matcher_id == Auth::user()->id)
                                                        <img src="{{ url('uploads')}}/{{$request->userid->profile_pic}}" class="img-responsive"/>
                                                      @endif
                                                    </div>
                                                    <div class="col-md-8">
                                                      @if($request->matcher_id == Auth::user()->id)
                                                      <p>You and <a href="{{ url('userprofile')}}/{{base64_encode($request->user_id)}}">{{$request->userid->display_name_on_pages}}</a> are currently on a Trial Date :)</p>
                                                      @endif
                                                      @if($request->user_id == Auth::user()->id)
                                                      <p>You and <a href="{{ url('userprofile')}}/{{base64_encode($request->matcher_id)}}">{{$request->matcherid->display_name_on_pages}}</a> are currently on a Trial Date :)</p>
                                                      @endif
                                                    </div>
                                                  </div>
                                              </div>
                                              <div class="request-body">
                                                <?php


                                                $planInfo = getUserPlan($request->user_id);
                                                $planInfo = json_decode($planInfo);

                                                $planTrialDays = $planInfo->trial_period;


                                                $currentDateTime = new DateTime(date("Y-m-d H:i:s"));


                                                $trialDateTime = $request->trial_date.' '.$request->trial_time;


                                                if($planTrialDays != null){
                                                  $newTrialDate = date("Y-m-d H:i:s", strtotime('+'.$planTrialDays.' days', strtotime($trialDateTime)));
                                                }else{
                                                   $newTrialDate = date("Y-m-d H:i:s", strtotime('+2 days', strtotime($trialDateTime)));
                                                }

                                                //$newTrialDate = date("Y-m-d H:i:s", strtotime('-2 days', strtotime($trialDateTime)));
                                                 //echo $newTrialDate;
                                                $newTrialDate1 =  new DateTime($newTrialDate);

                                                $trialDateTime1 = new DateTime($trialDateTime);


                                                if($currentDateTime < $trialDateTime1){

                                                   $interval = $currentDateTime->diff($trialDateTime1);
                                                   echo '<p>This Trial Date will be begins in:</p>';
                                                   $days     =  $interval->format('%d');
                                                   if($days > 0)
                                                       echo '<p class="remaining_time">'.$interval->format('%a days %h hours %i minutes').'</p>';
                                                   else
                                                       echo '<p class="remaining_time">'.$interval->format('%h hours %i minutes').'</p>';

                                                }


                                                if($currentDateTime >= $trialDateTime1 && $currentDateTime <= $newTrialDate1){

                                                  $interval = $currentDateTime->diff($newTrialDate1);
                                                  //print_r($interval);
                                                 // $days     =  $interval->format('%d');
                                                  //$hours    = ($days*24) + $interval->format('%h');
                                                 // $minutes  = round(($hours/60)) + $interval->format('%i');

                                                   echo '<p>This Trial Date will end in:</p>';
                                                   //echo '<p class="remaining_time">'.$hours. ' Hours  '. $minutes.' Minutes </p>';
                                                   $days     =  $interval->format('%d');
                                                   if($days > 0)
                                                       echo '<p class="remaining_time">'.$interval->format('%a days %H hours %i minutes').'</p>';
                                                   else
                                                       echo '<p class="remaining_time">'.$interval->format('%h hours %i minutes').'</p>';
                                                }

                                                ?>

                                              </div>
                                              <div class="request-footer">
                                                <div class="requestActionButtons">
                                                  <a href="{{$getLocation->address}}" class="btn btn-primary" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i> Location</a>
                                                @if($request->is_accepted == 1 && $request->is_success == 0 && $request->is_ended == 0)
                                                   <a href="#" data-toggle="modal" data-id="{{$request->id}}" data-target="#endTrial-modal" class="btn btn-danger trialEnd-btn">END</a>
                                                @endif
                                                <a href="{{ url('chat')}}" class="btn btn-info">CHAT</a>
                                              </div>
                                              </div>
                                            </div>
                                           </div>
                                            @endif
                                          @endforeach

                                          @foreach($accepted as $request)
                                          @if($request->is_accepted == 0 && $request->is_maybe == 1)
                                          @php
                                            $flag=1;
                                          @endphp
                                          <?php
                                          $getLocation = TrialLocation::find($request->trial_location_id);
                                          $adopterFamilyRole = FamilyRole::find($request->trial_family_role);
                                          $adopteeFamilyRole = FamilyRole::find($request->adoptee_family_role);
                                           ?>
                                           <div class="col-md-6 col-sm-6 col-lg-6">
                                             <div class="request-content">
                                              <div class="request-header">
                                                  <div class="row">
                                                    <div class="col-md-4">
                                                      @if($request->user_id == Auth::user()->id)
                                                        <img src="{{ url('uploads')}}/{{$request->matcherid->profile_pic}}" class="img-responsive"/>
                                                      @endif
                                                      @if($request->matcher_id == Auth::user()->id)
                                                        <img src="{{ url('uploads')}}/{{$request->userid->profile_pic}}" class="img-responsive"/>
                                                      @endif
                                                    </div>
                                                    <div class="col-md-8">
                                                      @if($request->matcher_id == Auth::user()->id)
                                                      <p><a href="{{ url('userprofile')}}/{{base64_encode($request->user_id)}}">{{$request->userid->display_name_on_pages}}</a> invited you on a Trial Date. Would you like to go as his/her {{$adopteeFamilyRole->title}}?</p>
                                                      @endif

                                                      @if($request->user_id == Auth::user()->id)
                                                      <p>You invited <a href="{{ url('userprofile')}}/{{base64_encode($request->matcher_id)}}">{{$request->matcherid->display_name_on_pages}}</a> on a Trial Date.</p>
                                                      @endif

                                                    </div>
                                                  </div>
                                              </div>
                                              <div class="request-body">
                                                <div class="row">
                                                  <div class="col-md-4">
                                                      <a href="{{$getLocation->address}}" target="_blank"><img src="{{ url('uploads/location')}}/{{$getLocation->image}}" class="img-responsive locationImg"/></a>
                                                  </div>
                                                  <div class="col-md-8">
                                                     <div class="locInfo">
                                                         <p class="location_name">{{$getLocation->name}}</p>
                                                         <p class="text-left"><b>Date: </b>{{date("d F Y",strtotime($request->trial_date))}}</p>
                                                         <p class="text-left"><b>Time:</b> {{date("h:ia", strtotime($request->trial_time))}} (SLT)</p>
                                                         <p class="text-left"><a href="{{$getLocation->address}}" class="label label-info" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i> Location</a></p>
                                                     </div>
                                                  </div>
                                                </div>

                                              </div>
                                              <div class="request-footer">
                                                <div class="requestActionButtons">

                                                 @if($request->matcher_id == Auth::user()->id)
                                                   <a class="btn btn-success" href="{{ route('trials.accept', $request->id) }}">ACCEPT</a>
                                                   <a class="btn btn-danger" href="{{ route('trials.decline', $request->id) }}">DECLINE</a>
                                                 @endif
                                                     <a data-href="{{url('schedule')}}/{{base64_encode($request->user_id)}}" class="btn btn-warning" onclick="secondRequest($(this) , '{{$request->userid->display_name_on_pages}}', '{{ Auth::user()->id}}', '{{$request->matcher_id}}')">RESCHEDULE</a>
                                                     <a class="btn btn-danger" href="{{ route('trials.cancelrequest', $request->id) }}">CANCEL</a>

                                                     <a href="{{ url('chat')}}" class="btn btn-info">CHAT</a>
                                                 </div>
                                            </div>
                                           </div>
                                         </div>
                                            @endif
                                          @endforeach
                                        </div>
                                      @endif

                                      @if($flag == 0)
                                            <h6 class="text-center">You currently have no active Trial Dates After matching with users, you may ask them on Trial Dates.</h6>
                                      @endif


                                      <div class="trialSPagnation">
                                        {{ $accepted->links() }}
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
                    </div><!-- end row -->
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

                <!----- End Trial Popup -->

                <!-- Modal -->
                <div id="endTrial-modal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <form method="post" action="{{ route('trials.trialEnded') }}">
                        @csrf
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Please select a reason to End this Trial Date</h4>
                    </div>
                    <div class="modal-body">
                          <input type="hidden" name="trial_id" value="" id="endTrialId" />

                          @if($endReasons)
                              @foreach($endReasons as $reason)
                                  <div class="form-group">
                                    @if($loop->first)
                                      <input type="radio" name="trial_end_reason" data-id="{{$reason->id}}" value="{{$reason->id}}" id="reason_{{$reason->id}}" checked required/>
                                    @else

                                      <input type="radio" name="trial_end_reason" data-id="{{$reason->id}}" value="{{$reason->id}}" id="reason_{{$reason->id}}" required/>
                                    @endif
                                    <label for="reason_{{$reason->id}}">{{$reason->title}}</label>
                                  </div>

                              @endforeach
                            @endif
                    </div>
                    <div class="modal-footer">
                      <center>
                        @if($endReasons)
                          <button type="submit" name="submitEndReason" value="End Trial" class="btn btn-success">End Trial</button>
                        @endif
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </center>
                    </div>
                  </div>
                  </form>
                </div>
                </div>


                <!----------------------->

@endsection

@section('footer')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" integrity="sha256-zuyRv+YsWwh1XR5tsrZ7VCfGqUmmPmqBjIvJgQWoSDo=" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js" integrity="sha256-JirYRqbf+qzfqVtEE4GETyHlAbiCpC005yBTa4rj6xg=" crossorigin="anonymous"></script>

<script>
$(document).ready(function(){
  $(".trialEnd-btn").click(function(){
    var trial_id = $(this).attr('data-id');

    $("#endTrialId").val(trial_id);
  });

});
</script>
@endsection
