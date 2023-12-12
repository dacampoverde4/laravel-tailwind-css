@extends('layouts.master')
@section('htmlheader')

<style>
.method button.nocountbg {
    background: transparent;
    font-size: 14px;
    color: #05aaac;
    padding: 3px 0;
}
</style>
@endsection
@section('main-content')
<!-- Start Main Content ---->
<div class="maincontent">
    <div class="content bgwhite">

        <!-- Start Membership Package Tabs -->

        <div class="pricetabs pt30">
            <div class="container-fluid">
                <h3 class="font22"><b><img src="{{ asset('backend/images/packages.png') }}" alt="Img" title="Img" class="all_users">Membership Packages</b></h3>
                <hr>
            </div>
            <div class="container">
                <div class="row">
                    <div class="text-center text_cntr top_intro">
                        <span> As you've noticed, AvDopt is the most convenient way to adopt Avatars in Second Life. Although it's free to use AvDopt, upgrading to a premium plan will get you access to advanced search, chat features, visibility, 24/7 support, and more. There's power in premium!</span>
                    </div>
                </div>
                <div class="row">
                    <div class="text-center text_cntr mtop20 content_heading">
                        <h3 class="font28"><b>Pricing Packages</b></h3>
                    </div>
                </div>
                <!-- 3 Tabs -->
                <div class="row mtop40">
                	@if( $plans )
                		@php
            	    		$tokenamount = getWebsiteSettingsByKey('token_amount');
            	    	@endphp
            	        @foreach($plans as $plan)
            	        @if( $plan->plan_id != 'plan_DGPRyjNYWH0Y1h' )
            	        	<div class="width80">
            	        	      <div class="col-md-4 pricetab  text-center">
                    			    @php
                    			        $class = 'pricetab_black';
                    			        $user = App\User::find(Auth::user()->id);
                    			        if( $subscription ){
                        			        if( $subscription->stripe_plan == $plan->plan_id && $user->subscribed('main') && ( !$user->subscription('main')->onGracePeriod() ) ){
                        			           $class = 'pricetab_red';
                        			        }else{
                        			            $class = 'pricetab_green';
                        			        }
                        			   }
                    			    @endphp
		                            <h4 class="{{ $class }}">
		                                <span class="font28 block">{{ $plan->name }}</span>
		                                <i>T{{ ( $plan->price ) }} / {{ $plan->billing_interval }}</i>
		                            </h4>
		                            <p>{{$plan->description}}</p>
		                            @if( $subscription )
                        			    @if( $subscription->stripe_plan == $plan->plan_id && $user->subscribed('main') && ( !$user->subscription('main')->onGracePeriod() ) )
                        			        <form class="form-horizontal " role="form" method="POST" action="{{ url('/')}}/subscription/cancel">
            	                                @csrf
            	                                <input type="hidden" name="chargeId" value="{{ $plan->plan_id }}" >
                            			        <button type="submit" onclick="return confirm('Are you sure you want to cancel this plan?')" class="mtop10 pricetab_black btnred">Cancel</button>
                            			    </form>
                        			    @else
                        			        <form class="form-horizontal " role="form" method="POST" action="{{ url('/')}}/subscription/checkout">
            	                                @csrf
            	                                <input type="hidden" name="chargeId" value="{{ $plan->plan_id }}" >
                                                <input type="hidden" name="newplanbuy" value="0" >
                            			        <button type="submit" onclick="return confirm('Are you sure you want to upgrade this plan?')" class="mtop10 pricetab_green">Upgrade</button>
                            			    </form>
                        			    @endif
            	                    @else

                                			<form class="form-horizontal " role="form" method="POST" action="{{ url('/')}}/subscription/checkout">
            	                                @csrf

            	                                <input type="hidden" name="chargeId" value="{{ $plan->plan_id }}" >
                                                <input type="hidden" name="newplanbuy" value="1" >
                                                <button type="submit" class="mtop10 pricetab_black">Buy</button>
            	                                <div class="hidescript">
            	                                    <!--<script
            	                                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            	                                        data-key="{{ env('STRIPE_KEY') }}"
            	                                        data-amount="{{ ( $tokenamount )? $plan->price * ( $tokenamount * 100 ): $plan->price * 100 }}"
            	                                        data-name="{{ $plan->name }}"
            	                                        data-description="Membership Charge"
            	                                        data-image="{{url('/')}}/backend/images/logo.jpg"
            	                                        data-locale="auto">
            	                                    </script>-->
            	                                </div>
            	                            </form>

    	                            @endif
		                            <!--<button type="submit" class="mtop10 pricetab_black">Upgrade</button>-->
		                        </div>
		                    </div>
		                    @endif
            	        @endforeach
                	@endif
                </div>
                <!--End  3 Tabs -->

                <!-- 3 Table -->
                <div class="row mtop50">
                    <div class="text-center content_heading">
                        <h3 class="font28"><b>Feature Comparison</b></h3>
                    </div>
                </div>
                <div class="row mtop30">
                    <div class="method text-center">
                        <div class="col-md-12 margin-0 list-header hidden-sm hidden-xs">
                            <div class="col-md-3 padding0">
                                <div class="header">Feature</div>
                                <div class="cell">
                                    <div class="propertyname">
                                        <strong style="font-weight:600;">Free Tokens</strong>
                                    </div>
                                </div>
                                <div class="cell">
                                    <div class="propertyname">
                                        <strong style="font-weight:600;">Private Chat</strong>
                                    </div>
                                </div>
                                <div class="cell">
                                    <div class="propertyname">
                                        <strong style="font-weight:600;">Live Chat</strong>
                                    </div>
                                </div>
                                <div class="cell">
                                    <div class="propertyname">
                                        <strong style="font-weight:600;">Username Change</strong>
                                    </div>
                                </div>
                                <div class="cell">
                                    <div class="propertyname">
                                        <strong style="font-weight:600;">Change Profile Pic</strong>
                                    </div>
                                </div>
                                <div class="cell">
                                    <div class="propertyname">
                                        <strong style="font-weight:600;">Additional Photos</strong>
                                    </div>
                                </div>
                                <div class="cell">
                                    <div class="propertyname">
                                        <strong style="font-weight:600;">View My Likes</strong>
                                    </div>
                                </div>
                                <div class="cell">
                                    <div class="propertyname">
                                        <strong style="font-weight:600;">View My Matches</strong>
                                    </div>
                                </div>
                                <div class="cell">
                                    <div class="propertyname">
                                        <strong style="font-weight:600;">Match Quest</strong>
                                    </div>
                                </div>
                                 <div class="cell">
                                    <div class="propertyname">
                                        <strong style="font-weight:600;">My Hearts</strong>
                                    </div>
                                </div>
                                 <div class="cell">
                                    <div class="propertyname">
                                        <strong style="font-weight:600;">Advance Search</strong>
                                    </div>
                                </div>
                            </div>

                            @if( $plans )
            	        		@foreach($plans as $plan)
                          <div class="col-md-2 padding0  col_offset">
                                      <div class="header">{{ $plan->name }}</div>
                                      <div class="cell">
                                          <div class="type">
                                              {{ $plan->tokens }}
                                          </div>
                                      </div>
                                      <div class="cell">
                                          <div class="type">
                                              @php
                                                  $sub_private_messages = getWebsiteSettingsByKey( 'sub_private_messages_'.$plan->id );
                                              @endphp
                                              @if( $sub_private_messages )
                                                  <img src="{{url('/')}}/backend/images/limited.png" class="img-responsive">
                                                  @if( $sub_private_messages == -1 )
                                                      <button type="submit">Unlimited</button>
                                                  @else
                                                      <button type="submit" class="nocountbg"> {{$sub_private_messages}} Conversations</button>
                                                  @endif
                                              @else
                                                  <img src="{{url('/')}}/backend/images/wrong.png" class="img-responsive">
                                              @endif
                                          </div>
                                      </div>
                                      <div class="cell">
                                          <div class="type">
                                              @php
                                                  $sub_monthly_connection = getWebsiteSettingsByKey( 'sub_monthly_connection_'.$plan->id );
                                              @endphp
                                              @if( $sub_monthly_connection )
                                                  <img src="{{url('/')}}/backend/images/limited.png" class="img-responsive">
                                                  @if( $sub_monthly_connection == -1 )
                                                      <button type="submit">Unlimited</button>
                                                  @else
                                                      <button type="submit" class="nocountbg"> {{$sub_monthly_connection}} Conversations</button>
                                                  @endif
                                              @else
                                                  <img src="{{url('/')}}/backend/images/wrong.png" class="img-responsive">
                                              @endif
                                          </div>
                                      </div>
                                      <div class="cell">
                                          <div class="type">
                                              @php
                                                  $sub_username_change = getWebsiteSettingsByKey( 'sub_username_change_'.$plan->id );
                                              @endphp
                                              @if( $sub_username_change )
                                                  <img src="{{url('/')}}/backend/images/limited.png" class="img-responsive">
                                                  @if( $sub_username_change == -1 )
                                                      <button type="submit">Unlimited</button>
                                                  @else
                                                      <button type="submit" class="nocountbg"> {{$sub_username_change}} Name Changes</button>
                                                  @endif
                                              @else
                                                  <img src="{{url('/')}}/backend/images/wrong.png" class="img-responsive">
                                              @endif
                                          </div>
                                      </div>
                                      <div class="cell">
                                          <div class="type">
                                              @php
                                                  $sub_user_image_change = getWebsiteSettingsByKey( 'sub_user_image_change_'.$plan->id );
                                              @endphp
                                              @if( $sub_user_image_change )
                                                  <img src="{{url('/')}}/backend/images/limited.png" class="img-responsive">
                                                  @if( $sub_user_image_change == -1 )
                                                      <button type="submit">Unlimited</button>
                                                  @else
                                                      <button type="submit" class="nocountbg"> {{$sub_user_image_change}} Pic Changes</button>
                                                  @endif
                                              @else
                                                  <img src="{{url('/')}}/backend/images/wrong.png" class="img-responsive">
                                              @endif
                                          </div>
                                      </div>
                                      <div class="cell">
                                          <div class="type">
                                              @php
                                                  $sub_max_images_upload = getWebsiteSettingsByKey( 'sub_max_images_upload_'.$plan->id );
                                              @endphp
                                              @if( $sub_max_images_upload )
                                                  <img src="{{url('/')}}/backend/images/limited.png" class="img-responsive">
                                                  @if( $sub_max_images_upload == -1 )
                                                      <button type="submit">Unlimited</button>
                                                  @else
                                                      <button type="submit" class="nocountbg"> {{$sub_max_images_upload}} Photos</button>
                                                  @endif
                                              @else
                                                  <img src="{{url('/')}}/backend/images/wrong.png" class="img-responsive">
                                              @endif
                                          </div>
                                      </div>
                                      <div class="cell">
                                          @php
                                              $sub_view_my_likes = getWebsiteSettingsByKey( 'sub_view_my_likes_'.$plan->id );
                                          @endphp
                                          @if( $sub_view_my_likes )
                                              <img src="{{url('/')}}/backend/images/limited.png" class="img-responsive">
                                              @if( $sub_view_my_likes == -1 )
                                                  <button type="submit">Unlimited</button>
                                              @else
                                                  <button type="submit" class="nocountbg"> {{$sub_view_my_likes}} My Likes</button>
                                              @endif
                                          @else
                                              <img src="{{url('/')}}/backend/images/wrong.png" class="img-responsive">
                                          @endif
                                      </div>
                                      <div class="cell">
                                          <div class="type">
                                              @php
                                                  $sub_view_my_matches = getWebsiteSettingsByKey( 'sub_view_my_matches_'.$plan->id );
                                              @endphp
                                              @if( $sub_view_my_matches )
                                                  <img src="{{url('/')}}/backend/images/limited.png" class="img-responsive">
                                                  @if( $sub_view_my_matches == -1 )
                                                      <button type="submit">Unlimited</button>
                                                  @else
                                                      <button type="submit" class="nocountbg"> {{$sub_view_my_matches}} My Matches</button>
                                                  @endif
                                              @else
                                                  <img src="{{url('/')}}/backend/images/wrong.png" class="img-responsive">
                                              @endif
                                          </div>
                                       </div>
                                       <div class="cell">
                                          <div class="type">
                                              @php
                                                  $sub_match_quest_count = getWebsiteSettingsByKey( 'sub_match_quest_count_'.$plan->id );
                                              @endphp
                                              @if( $sub_match_quest_count )
                                                  <img src="{{ asset('backend/images/limited.png') }}" class="img-responsive">
                                                  @if( $sub_match_quest_count == -1 )
                                                      <button type="submit">Unlimited</button>
                                                  @else
                                                      <button type="submit" class="nocountbg"> {{$sub_match_quest_count}} Match Quest</button>
                                                  @endif
                                              @else
                                                  <img src="{{ asset('backend/images/wrong.png') }}" class="img-responsive">
                                              @endif
                                          </div>
                                       </div>
                                       <div class="cell">
                                          <div class="type">
                                              @php
                                                  $sub_my_hearts = getWebsiteSettingsByKey( 'sub_my_hearts_'.$plan->id );
                                              @endphp
                                              @if( $sub_my_hearts )
                                                  <img src="{{url('/')}}/backend/images/limited.png" class="img-responsive">
                                              @else
                                                  <img src="{{url('/')}}/backend/images/wrong.png" class="img-responsive">
                                              @endif
                                          </div>
                                       </div>
                                       <div class="cell">
                                          @php
                                              $sub_advance_search = getWebsiteSettingsByKey( 'sub_advance_search_'.$plan->id );
                                          @endphp
                                          @if( $sub_advance_search )
                                              <img src="{{url('/')}}/backend/images/limited.png" class="img-responsive">
                                          @else
                                              <img src="{{url('/')}}/backend/images/wrong.png" class="img-responsive">
                                          @endif
                                      </div>
                                  </div>
		                        @endforeach
		                    @endif
                        </div>
                    </div>
                </div>
                <!--End  3 Table -->

            </div>
        </div>

        <!-- End Match Tabs -->

    </div>
</div>
<!-- End Main Content ---->
@endsection
