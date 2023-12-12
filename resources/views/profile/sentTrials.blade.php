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
                      <h3 class="text-themecolor">Sent Requests</h3>
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
                                  <a class="nav-link" href="{{ route('trials.activeTrialsIndex')}}" >
                                    <span class="hidden-sm-up"><i class="ti-user"></i></span>
                                    <span class="hidden-xs-down"><img src="{{ url('images')}}/Timer.png" class="tabIcons"/> Active Trial Dates</span></a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link active" href="{{ route('trials.sentTrialsIndex')}}">
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
                            <div class="addBanners-sidebar">
                                <p>AD BANNER</p>
                            </div>
                          </div>
                          <div class="col-md-7 mainContent">
                            <div class="tab-content">
                                <div class="tab-pane active p-20" id="messages2" role="tabpanel">

                                  @if(count($sent) > 0)
                                  <div class="row">
                                      @foreach($sent as $request)
                                      <?php
                                      $getLocation = TrialLocation::find($request->trial_location_id);
                                      $getFamilyRoleInfo = FamilyRole::find($request->trial_family_role);
                                       ?>
                                      @if($request->user_id == Auth::user()->id)
                                       <div class="col-md-6 col-sm-6 col-lg-6">
                                         <div class="request-content">
                                          <div class="request-header">
                                              <div class="row">
                                                <div class="col-md-4">
                                                    <img src="{{ url('uploads')}}/{{$request->matcherid->profile_pic}}" class="img-responsive"/>
                                                </div>
                                                <div class="col-md-8">
                                                  <p>You invited to <b>{{ $request->matcherid->display_name_on_pages }}</b> on a Trial Date.</p>
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
                                                @if($request->is_accepted == 1 && $request->is_success == 0 && $request->is_ended == 0)
                                                  <a href="{{ route('trials.trialEnded', $request->id) }}" class="btn btn-danger">END</a>
                                                @endif
                                                @if($request->is_maybe == 1)
                                                  <a class="btn btn-info" data-href="{{ route('schedule', base64_encode($request->matcher_id)) }}" onclick="secondRequest($(this), '{{$request->matcherid->display_name_on_pages}}', '{{ Auth::user()->id}}', '{{$request->matcher_id}}')">RESCHEDULE</a>
                                                @endif
                                                @if($request->is_maybe == 1 || $request->is_decline == 1)
                                                <a class="btn btn-danger" href="{{ route('trials.cancelrequest', $request->id) }}">CANCEL</a>
                                                @endif
                                            <a href="{{ url('chat')}}" class="btn btn-info">CHAT</a>
                                          </div>
                                          </div>
                                        </div>
                                       </div>
                                       @endif
                                      @endforeach
                                    </div>

                                    <div class="trialSPagnation">
                                      {{ $sent->links() }}
                                    </div>
                                  @else
                                  <h6 class="text-center">You've not sent any Trial Date requests as yet. After matching with users, you may ask them on Trial Dates.</h6>
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
@endsection
