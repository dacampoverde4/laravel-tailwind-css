@php
    $featurecount = isset($featurecount)? $featurecount: 5;

    $featuredUsers = getSubscribedFeatureUsers($featurecount);
    $featuredPlans = getFeaturedPlans();
@endphp

<div class="col-md-6 col-sm-6 col-xs-12 featuredclass_{{ $featurecount }}">
    <div class="col-md-12">
        <h3 class="font_family" style="padding:12px 46px">
            <img class="img-responsive" alt="Profile Img" src="{{url('' )}}/frontend/images/flame.png">FEATURED MEMBERS
        </h3>
    </div>
    <div class="featuredmembers_img">
        <div class="col-md-12">
        @if( $featuredUsers )
            @foreach($featuredUsers as $featuredUser)
                <div class="col-md-3 col-sm-3 col-xs-3">
                    @if($featuredUser->user)
                    <a href="{{ url('userprofile')}}/{{ base64_encode($featuredUser->user->id) }}" class="featured_user" style="background-image:url({{ ( $featuredUser->user->profile_pic )? url('/uploads').'/'.$featuredUser->user->profile_pic : url('/images/default.png')}});">

                    </a>
                    @endif
                </div>
            @endforeach
        @endif
        </div>
        <div class="col-md-12 vertical_align">
        <div class="col-md-6 col-xs-6 mtop20 plmoob">
            <a class="" href="#">WANT TO STAND OUT FROM CROWD?</a>
        </div>
        <div class="col-md-5 col-xs-4 mtop20 plmoob">
            <a class="pull-right" style="color:#fff" href="#">FEATURE YOUR PROFILE HERE</a>
        </div>



        <div class="col-md-1 col-xs-2 mtop20 padding0">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary go_btn" data-toggle="modal" data-target="#exampleModal">
                GO
            </button>
        </div>
        </div>
        <!-- --------------Featured Members popup----------------- -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <div class="feat_infop"><p class=" mtop20">{{ $featuredPlan->info }}</p></div>
                                        @if( $subscription )
                            			    @php
                            			        $user = App\User::find(Auth::user()->id);
                            			    @endphp
                            			    @if( $subscription->stripe_plan == $featuredPlan->plan_id && $user->subscribed('feature') && ( !$user->subscription('feature')->onGracePeriod() ) )
                            			        <form class="form-horizontal " role="form" method="POST" action="{{ url('/')}}/subscription/featurecancel">
                	                                @csrf
                	                                <input type="hidden" name="chargeId" value="{{ $featuredPlan->plan_id }}" >
                                			        <button type="submit" onclick="return confirm('Are you sure you want to cancel this plan?')" class="mtop10 mb cncl_btn"><span>Cancel</span><</button>
                                			    </form>
                            			    @else
                            			        <form class="form-horizontal " role="form" method="POST" action="{{ url('/')}}/subscription/checkout">
                	                                @csrf
                	                                <input type="hidden" name="chargeId" value="{{ $featuredPlan->plan_id }}" >
                                			        <button type="submit" onclick="return confirm('Are you sure you want to upgrade this plan?')" class="mtop10 mb upgrd_btn"><span>Buy Now</span><</button>
                                			    </form>
                            			    @endif
                	                    @else
                                            <form class="form-horizontal " role="form" method="POST" action="{{ url('/')}}/subscription/checkout">
                                                @csrf
                                                <button type="submit" class="mtop10 mb"><span>Buy</span></button>
                                                <input type="hidden" name="chargeId" value="{{ $featuredPlan->plan_id }}" >
                                                <div class="hidescript">
                                                    <!--<script
                                                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
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
        <!-- --------------End Featured Members popup----------------- -->
    </div>
</div>
