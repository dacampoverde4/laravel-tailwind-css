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

                @if(session()->has('warning'))
                    <div class="col-md-12 alert alert-warning">
                        {!! session()->get('warning') !!}
                    </div>
                @endif

                <div class="col-xs-12 col-md-12 sucessmessage"></div>
                  <div class="col-md-5 align-self-center padding0">
                      <h3 class="text-themecolor">Expired Trial Dates</h3>
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
                                  <a class="nav-link" href="{{ route('trials.activeTrialsIndex')}}">
                                    <span class="hidden-sm-up"><i class="ti-user"></i></span>
                                    <span class="hidden-xs-down"><img src="{{ url('images')}}/Timer.png" class="tabIcons"/> Active Trial Dates</span></a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="{{ route('trials.sentTrialsIndex')}}" >
                                    <span class="hidden-sm-up"><i class="ti-email"></i></span>
                                    <span class="hidden-xs-down"><img src="{{ url('images')}}/TaskList.png" class="tabIcons"/> Sent Requests</span></a>
                                </li>
                                <!-- <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#decline" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Declined</span></a> </li> -->
                                <li class="nav-item">
                                  <a class="nav-link active" href="{{ route('trials.expiredTrialsIndex')}}">
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
                            <div class="adsimgsec ads_240_400_size ptb10 expired_left_ban_img">
                                    <img src="http://laravel.avdopt.com/images/240x400.jpg" class="">
                            </div>
                          </div>
                          <div class="col-md-7 mainContent">
                            <div class="tab-content">
                              <div class="col-md-12 banner expired_ban_img">
                            <img src="http://laravel.avdopt.com/assets/images/match_quest_categoies/PAQJ0m1k2g_1573238630_.jpg" class="banner" alt="your image">
                           </div>
                        <div class="tab-pane active p-20" id="expired" role="tabpanel">
                            @php
                            $flag =0;
                            @endphp
                            @if(count($expired) > 0)

                            <div class="row">
                            @foreach($expired as $trial)
                            <?php
                            $getLocation = TrialLocation::find($trial->trial_location_id);
                            $getFamilyRoleInfo = FamilyRole::find($trial->trial_family_role);
                             ?>

                             @php

                             $adopter_family_role = FamilyRole::find($trial->trial_family_role)->title;
                             $adopter_family_gender = (FamilyRole::find($trial->trial_family_role)->gender == 'female')  ? "she" : "he" ;
                             $adoptee_family_role = FamilyRole::find($trial->adoptee_family_role)->title;
                             $adoptee_family_gender = (FamilyRole::find($trial->adoptee_family_role)->gender == 'female')? "she" : "he";

                             @endphp
                             @if($trial->is_decline == 0)
                              @if($trial->is_accepted == 1 && $trial->is_ended == 1)
                              @php
                              $flag =1;
                              @endphp
                              <div class="col-md-6 col-sm-6 col-lg-6">
                                <div class="request-content">
                                 <div class="request-header">
                                     <div class="row">
                                       <div class="col-md-4">
                                         @if($trial->user_id == Auth::user()->id)
                                             @php
                                               $userId = $trial->user_id;
                                             @endphp
                                           <img src="{{ url('uploads')}}/{{$trial->matcherid->profile_pic}}" class="img-responsive"/>
                                        @endif
                                        @if($trial->matcher_id == Auth::user()->id)
                                            @php
                                              $userId = $trial->matcher_id;
                                            @endphp
                                           <img src="{{ url('uploads')}}/{{$trial->userid->profile_pic}}" class="img-responsive"/>
                                        @endif
                                       </div>
                                       <div class="col-md-8">

                                         @if($trial->user_id == Auth::user()->id)
                                               @php
                                                 $userId = $trial->user_id;
                                               @endphp
                                               <b>{{$trial->userid->display_name_on_pages}}</b> & <b>{{$trial->matcherid->display_name_on_pages}}</b> your Trial Date has ended.
                                         @endif

                                         @if($trial->matcher_id == Auth::user()->id)
                                             @php
                                               $userId = $trial->matcher_id;
                                             @endphp
                                             <b>{{$trial->matcherid->display_name_on_pages}}</b> & <b>{{$trial->userid->display_name_on_pages}}</b> your Trial Date has ended.
                                         @endif

                                       </div>
                                     </div>
                                 </div>
                                 <div class="request-body">

                                    @if($trial->user_id == Auth::user()->id)
                                     <p>You may leave a review on <b>{{$trial->matcherid->display_name_on_pages}}</b> profile when ready. Reviews are permanent and it will add to <b>{{$trial->matcherid->display_name_on_pages}}</b> adoption history.</p>

                                   @else
                                    <p>You may leave a review on <b>{{$trial->userid->display_name_on_pages}}</b> profile when ready. Reviews are permanent and it will add to <b>{{$trial->userid->display_name_on_pages}}</b> adoption history.</p>

                                   @endif
                                 </div>

                                 <div class="request-footer">
                                   <!-- <h3>How was Trial Date?</h3> -->
                                   <div class="requestActionButtons">
                                   @if($trial->user_id == Auth::user()->id)
                                     <a class="btn btn-success" data-toggle="modal" data-target="#TrialSuccess-{{$trial->id}}" data-id="{{$trial->id}}" link="{{ route('trials.success', $trial->id) }}">SUCCESS</a>


                                     <div class="modal fade trialSuccessPopup" id="TrialSuccess-{{$trial->id}}">
                                         <div class="modal-dialog">
                                           <div class="modal-content">
                                             <!-- Modal Header -->
                                             <div class="modal-header">
                                               <h4 class="modal-title">Adopt Request</h4>
                                               <button type="button" class="close" data-dismiss="modal">&times;</button>
                                             </div>
                                             <!-- Modal body -->
                                             <div class="modal-body">
                                               <form class="form-horizontal form_common submitAdoptForm" id="submitAdoptForm" role="form" name="submitAdoptForm" method="POST">

                                                <input type="hidden" name="trial" value="{{ $trial->id }}" id="trial"/>
                                                    <div class="row">
                                                      <div class="row">
                                                        <div class="form-group d-flex">
                                                           <div class="col-md-1">
                                                               <input type="checkbox" class="form-control checkbox" id="agree" name="agree">
                                                           </div>
                                                           <div class="col-md-11 terms">
                                                             @php

                                                                 $reciverUrl = url("userprofile").'/'.base64_encode($trial->matcher_id);

                                                                 $reciverName = $trial->matcherid->display_name_on_pages;

                                                                 $reciverLink = '<a href="'.$reciverUrl.'">'.$reciverName.'</a>';

                                                                 $adopt_message = "By signing this certificate, you promise to give ".$reciverLink." all of the love and care that ".$adoptee_family_gender." require in return, your ".$adoptee_family_role." will give you all the love, comfort and attention you need. Failure to meet adoption requirements herein, may result in dissolution. ";

                                                             @endphp
                                                                  <p>
                                                                    {!! $adopt_message !!}
                                                                  </p>
                                                             </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                      <button type="button" class="btn btn-primary submitBtn" id="submit">Yes, Please</button>

                                              </form>

                                             </div>
                                             <!-- Modal footer -->
                                             <div class="modal-footer">
                                             </div>
                                           </div>
                                         </div>
                                     </div>

                                     <a class="btn btn-danger " href="{{ route('trials.cancelrequest', $trial->id) }}">CANCEL</a>

                                     <a data-href="{{url('schedule')}}/{{base64_encode($trial->matcher_id)}}" class="btn btn-warning" onclick="secondRequest($(this) , '{{$trial->matcherid->display_name_on_pages}}', '{{ Auth::user()->id}}', '{{$trial->matcher_id}}')">RESCHEDULE</a>

                                     <a class="btn btn-primary" HREF="#">REVIEW</a>
                                   @endif

                                   @if($trial->matcher_id == Auth::user()->id)
                                     <a class="btn btn-success" data-toggle="modal" data-target="#TrialSuccess-{{$trial->id}}" data-id="{{$trial->id}}" link="{{ route('trials.success', $trial->id) }}">SUCCESS</a>

                                     <div class="modal fade trialSuccessPopup" id="TrialSuccess-{{$trial->id}}">
                                         <div class="modal-dialog">
                                           <div class="modal-content">
                                             <!-- Modal Header -->
                                             <div class="modal-header">
                                               <h4 class="modal-title">Adopt Request</h4>
                                               <button type="button" class="close" data-dismiss="modal">&times;</button>
                                             </div>
                                             <!-- Modal body -->
                                             <div class="modal-body">
                                               <form class="form-horizontal form_common submitAdoptForm" id="submitAdoptForm" role="form" name="submitAdoptForm" method="POST">
                                                 <input type="hidden" name="trial" value="{{ $trial->id }}" id="trial"/>

                                                     <div class="row">
                                                       <div class="form-group d-flex">
                                                          <div class="col-md-1">
                                                              <input type="checkbox" class="form-control checkbox" id="agree" name="agree">
                                                          </div>
                                                          <div class="col-md-11 terms">
                                                            @php
                                                            $reciverUrl = url("userprofile").'/'.base64_encode($trial->user_id);
                                                            $reciverName = $trial->userid->display_name_on_pages;
                                                            $reciverLink = '<a href="'.$reciverUrl.'">'.$reciverName.'</a>';
                                                            $adopt_message = "By signing this certificate, you promise to give ".$reciverLink." all of the love and care that ".$adopter_family_gender."  require in return, your ".$adopter_family_role." will give you all the love, comfort and attention you need. Failure to meet adoption requirements herein, may result in dissolution. ";


                                                            @endphp
                                                                 <p>{!! @$adopt_message !!}</p>
                                                            </div>
                                                           </div>

                                                     </div>
                                                     <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                    <button type="button" class="btn btn-primary submitBtn" id="submit">Yes, Please</button>

                                               </form>
                                             </div>
                                             <!-- Modal footer -->
                                             <div class="modal-footer">
                                             </div>
                                           </div>
                                         </div>
                                     </div>

                                     <a class="btn btn-danger " href="{{ route('trials.cancelrequest', $trial->id) }}">CANCEL</a>

                                     <a data-href="{{url('schedule')}}/{{base64_encode($trial->user_id)}}" class="btn btn-warning" onclick="secondRequest($(this) , '{{$trial->userid->display_name_on_pages}}', '{{ Auth::user()->id}}', '{{$trial->user_id}}')">RESCHEDULE</a>

                                     <a class="btn btn-primary" HREF="#">REVIEW</a>
                                   @endif
                                   <a href="{{ url('chat')}}" class="btn btn-info">CHAT</a>
                                 </div>
                                 </div>
                               </div>
                              </div>
                              @else
                                @if($trial->is_ended == 1)
                                  @php
                                  $flag = 1;
                                  @endphp
                                  <div class="col-md-6 col-sm-6 col-lg-6">
                                    <div class="request-content">
                                     <div class="request-header">
                                         <div class="row">
                                           <div class="col-md-4">
                                               <img src="{{ url('uploads')}}/{{$trial->userid->profile_pic}}" class="img-responsive"/>
                                           </div>
                                           <div class="col-md-8">
                                             <p>A Trial request sent by @if($trial->matcher_id == Auth::user()->id) <b>"{{$trial->userid->display_name_on_pages}}"</b> @else You to <b>"{{$trial->matcherid->display_name_on_pages}}"</b> @endif has Expired.</b></p>
                                           </div>
                                         </div>
                                     </div>
                                     <div class="request-body">
                                         <p><b>Your Trial details:</b> {{date("d F Y",strtotime($trial->trial_date))}}, {{date("h:ia", strtotime($trial->trial_time))}} (SLT), <a href="{{$getLocation->address}}" class="label label-info" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i> Location</a></p>

                                     </div>
                                     <div class="request-footer">
                                       <div class="requestActionButtons">
                                       @if($trial->user_id == Auth::user()->id)
                                         <a data-href="{{url('schedule')}}/{{base64_encode($trial->matcher_id)}}" class="btn btn-info" onclick="secondRequest($(this),'{{$trial->matcherid->display_name_on_pages}}', '{{ Auth::user()->id}}', '{{$trial->matcher_id}}')">RESCHEDULE</a>
                                       @endif
                                       @if($trial->matcher_id == Auth::user()->id)
                                         <a data-href="{{url('schedule')}}/{{base64_encode($trial->user_id)}}" class="btn btn-info" onclick="secondRequest($(this), '{{$trial->userid->display_name_on_pages}}', '{{ Auth::user()->id}}', '{{$trial->user_id}}')">RESCHEDULE</a>

                                       @endif
                                       <a class="btn btn-danger" href="{{ route('trials.cancelrequest', $trial->id) }}">CANCEL</a>
                                       </div>
                                     </div>
                                   </div>
                                  </div>
                                  @endif
                              @endif
                              @endif
                              <!-- DISPLAY DECLINED -->
                              @if($trial->is_decline == 1)

                              @php
                              $flag =1;
                              @endphp
                                      <div class="col-md-6 col-sm-6 col-lg-6">
                                        <div class="request-content">
                                         <div class="request-header">
                                             <div class="row">
                                               <div class="col-md-4">
                                                 @if($trial->matcher_id == Auth::user()->id)
                                                  <img src="{{ url('uploads')}}/{{$trial->userid->profile_pic}}" class="img-responsive"/>
                                                  @else
                                                     <img src="{{ url('uploads')}}/{{$trial->matcherid->profile_pic}}" class="img-responsive"/>
                                                  @endif
                                               </div>
                                               <div class="col-md-8">
                                                 @if($trial->matcher_id == Auth::user()->id)
                                                   <p>You have declined the Trial Request sent by <b>{{ $trial->userid->display_name_on_pages }}</b></p>
                                                 @else
                                                  <p>Your Trial Date has declined by <b>{{ $trial->matcherid->display_name_on_pages }}</b></p>
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
                                                    <p class="text-left"><b>Date: </b>{{date("d F Y",strtotime($trial->trial_date))}}</p>
                                                    <p class="text-left"><b>Time:</b> {{date("h:ia", strtotime($trial->trial_time))}} (SLT)</p>
                                                    <p class="text-left"><a href="{{$getLocation->address}}" class="label label-info" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i> Location</a></p>
                                                </div>
                                             </div>
                                           </div>
                                         </div>
                                         <div class="request-footer">
                                               <a class="btn btn-danger" href="{{ route('trials.cancelrequest', $trial->id) }}">CANCEL</a>
                                         </div>
                                       </div>
                                      </div>

                                  @endif
                            @endforeach
                              </div>
                            <div class="trialSPagnation">
                              {{ $expired->links() }}
                            </div>
                        @endif

                        @if($flag == 0)
                          <h6 class="text-center">You have no expired Trial Date as yet.</h6>
                        @endif

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
@endsection

@section('footer')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" integrity="sha256-zuyRv+YsWwh1XR5tsrZ7VCfGqUmmPmqBjIvJgQWoSDo=" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js" integrity="sha256-JirYRqbf+qzfqVtEE4GETyHlAbiCpC005yBTa4rj6xg=" crossorigin="anonymous"></script>
<script type="text/javascript">

    function secondRequest(item, username, liked_by, user_id){
      var link = item.attr("data-href");
      swal({
          title: "Are you sure?",
          text: "Every match deserves a second chance! Would you like to go on another Trial Date with '"+username+"'?",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, Reschedule it",
          cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm) {
          if (isConfirm) {
            window.location.href=link;
          } else {
            jQuery.ajax({
                url: window.Laravel.url + '/ajaxrequest/like',
                type: 'POST',
                data: {'_token': window.Laravel.csrfToken, 'user':user_id ,'action':'trialDislike'},
                dataType: 'JSON',
                success: function (data) {
                    if( data.status ){
                      swal.close();
                      location.reload();
                    }
                }
            });

          }
        });

    }

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
            $('#TrialSuccess-'+id).modal('toggle');
            setInterval(function(){
                  location.reload();
            }, 1000);
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

</script>
@endsection
