@extends('layouts.master')
@section('htmlheader')

<style>
.pricetab h4 {
    color: #fff;
    padding: 18px 0;
    margin-bottom: 0;
}
.pricetab > p {
    background-color: #ffffff;
    border-bottom-left-radius: 12px;
    border-bottom-right-radius: 12px;
    color: #000;
    font-size: 17px;
    font-style: italic;
    padding: 28px 40px 40px;
}
.pricetab button {
    border: 0 none;
    border-radius: 8px;
    color: #fff;
    display: inline-block;
    max-width: 150px;
    padding: 4px 30px;
    text-transform: uppercase;
}
.content_heading h3 {
    color: #000;
}
.font28 {
    font-size: 28px;
}
.method .col-md-3:nth-of-type(1) {
    border-left: 2px solid #eee;
}
.list-header .col-md-3, .list-header .col-md-2 {
    border-top: 2px solid #eee;
}
.method .col-md-3, .method .col-md-2 {
    border-bottom: 2px solid #eee;
    border-right: 2px solid #eee;
}
.padding0 {
    padding: 0;
}

element {

}
.header {

    color: #000;
    font-size: 20px;
    font-weight: 900;
    padding: 8px 0;
    text-transform: uppercase;

}
.method .cell:nth-of-type(2) {
    border-top: 2px solid #eee;
}
.method .cell {
    padding: 8px 0px;
    border-bottom: 2px solid #eee;
}
.propertyname, .cell {
    font-size: 14px;
}
.width80 {
    width: 80%;
    margin: 0 auto;
    display: block;
}
.mtop40 {
    margin-top: 40px;
}

h4.pricetab_green, h4.pricetab_red {
    background: #1976d2!important;

}
.pricetab h4 span {
    font-weight: bold;
    margin-bottom: 7px;
}
.block {
    display: block;
}
.pricetab h4 i {
    font-size: 20px;
}
i {
    cursor: pointer;
    position: relative;
}
 .pricetab button {
    border: 0 none;
    border-radius: 8px;
    color: #fff;
    display: inline-block;
    max-width: 150px;
    padding: 4px 30px;
    text-transform: uppercase;
}
.pricetab button {
     background: #1976d2!important;
}
.buy_tokens span, .top_intro span {
    display: block;
    font-size: 18px;
    font-style: italic;
    color: #111;
}
.content_heading h3 {
    color: #000;
}
.text_cntr {

    margin: auto;
}
.text-center.content_heading {
    margin: auto;
}
.method .cell {
    padding: 8px 0px;
    border-bottom: 2px solid #eee;
}
.propertyname, .cell {
    font-size: 14px;
}
.method .img-responsive {
    display: inline-block;
    margin: 0 11px;
    max-width: 19px;
    vertical-align: middle;
}
.method {
    width: 100%;
}
.cell {
    display: block;
    vertical-align: middle;
}
.content_heading h3 {
    color: #000;
    margin: 1rem 0 2rem 0;
}
.method {
    width: 100%;
    margin-bottom: 20px;
}
.method button {
    background-color: #05aaac;
    border: 0 none;
    color: #fff;
    font-size: 12px;
    line-height: 15px;
    padding: 3px 12px;
}
.method button.nocountbg {
    background: transparent;
    font-size: 14px;
    color: #05aaac;
    padding: 3px 0;
}
.col_offset {
    flex: 0 0 18.666667%;
    max-width: 18.666667%;
}
h3.font22.header_sec {
    margin-top: 15px;
}
.pricetab h4 {
    background-color: #1976d2;
}
.container-fluid.featureMembers-Section {
    background: #fff;
    padding: 10px;
    margin: 50px 0;
    border-radius: 15px;
}
.pricetblrow .col-md-4 {
    position: relative;
    padding-top: 50px;
}
.bextvalribbn {
    position: absolute;
    top: 0;
    width: calc(100% - 30px);
    left: 0;
    right: 0;
    margin: auto;
}
.bextvalribbn p::after {
    position: absolute;
    content: "";
    border-style: solid;
    border-width: 13px;
    border-color: #ffe000 transparent transparent;
    left: 0;
    right: 0;
    width: 0;
    margin: auto;
    bottom: -25px;
}
.bextvalribbn p {
    background: #ffe000;
    margin: 0;
    padding: 13px 10px;
    color: #000;
    font-weight: 500;
    position: relative;
    height: 50px;
}
p.saleprcnt {
    margin: 6px 0 0;
    font-size: 14px !important;
}
.saleprcnt span {
    background: #ffe000;
    color: #333;
    display: inline-block;
    padding: 4px 5px;
}
p.planpriceval {
    font-size: 24px;
    margin: 12px 0 5px !important;
    display: block;
}
.planpriceval span.monthprice {
    font-size: 16px;
    font-weight: 400;
}
.top_intro {
    background: #fff;
    padding: 30px 40px;
    margin: 20px 0;
    box-shadow: 0px 5px 10px rgba(0,0,0,0.02);
}

@media only screen and (max-width: 767px)
{
    .price_pg {
        padding: 20px;
    }
    .price_pg .pricetab button {
        background: #1976d2!important;
        margin: 10px auto 20px;
    }
}
</style>
@endsection
@section('main-content')

<!-- Start Main Content ---->
<div class="maincontent price_pg">
    <div class="content bgwhite">
        <!-- Start Membership Package Tabs -->
        <div class="pricetabs pt30">
            <div class="container-fluid ">
                <h3 class="font22 header_sec"><b><img src="{{ asset('backend/images/packages.png') }}" alt="Img" title="Img" class="all_users"> Premium Plans</b></h3>
                <div class="row">
                    <div class="text-center text_cntr top_intro">
                        <span> As you've noticed, AvDopt is the most convenient way to adopt Avatars in Second Life. Although it's free to use AvDopt, upgrading to a premium plan will get you access to advanced search, chat features, visibility, 24/7 support, and more. There's power in premium!</span>
                    </div>
                </div>
                <hr>
            </div>
            <div class="container">
                <!-- 3 Tabs -->
                <div class="row pricetblrow">
                    @if( $plans )
                        @php
                            $tokenamount = getWebsiteSettingsByKey('token_amount');
                        @endphp
                        @foreach($plans as $plan)

                        @if( $plan->plan_id != 'plan_DGPRyjNYWH0Y1h' )
                                  <div class="col-md-4 pricetab  text-center">
                                    @php
                                        $class = 'pricetab_black';
                                  $header_color = 'background:'. $plan->plan_color.' !important;';
                                        $user = App\User::find(Auth::user()->id);
                                        if( $subscription ){
                                            if( $subscription->stripe_plan == $plan->plan_id && $user->subscribed('main') && ( !$user->subscription('main')->onGracePeriod() ) ){
                                               $class = 'pricetab_red';
                                            }else{
                                                $class = 'pricetab_green';
                                            }
                                       }
                                   $subscribed=$user->subscribedPlan;
                                   $currentPlan=App\Plan::where('plan_id',$subscribed->stripe_plan)->first();
                                   $cPlan = "";
                                   if($currentPlan){
                                        $cPlan=App\Plan::where('name',$currentPlan->name)->first();
                                    }

                                   if($subscribed->ends_at){
                                    $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $subscribed->ends_at);
                                   }else{
                                    $to = Carbon\Carbon::now();
                                   }

                                   if($subscribed->updated_at){
                                    $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $subscribed->updated_at);
                                   }else{
                                    $from = Carbon\Carbon::now();
                                   }

                                   $now = Carbon\Carbon::now();
                                    $diff_in_days = '';
                                   if($subscribed->ends_at > $now){
                                    $diff_in_days = $to->diffInDays($now);
                                   }
                                  
                                    //$from = $mytime = Carbon\Carbon::now();

                                      // Output: 1
                                    @endphp
                                        @if ($currentPlan->name == $plan->name )


                                        @if(!empty($plan->best_seller_ribbon) && isset($plan->best_seller_ribbon) && $plan->best_seller_ribbon == '1')
                                        <div class="bextvalribbn">
                                          <p>Best Value</p>
                                        </div>
                                        @endif
                                            <h4 class="{{ $class }}" style="background:green!important;">
                                                <span class="font28 block">{{ $plan->name }}</span>
                                                @if(!empty($plan->plan_sale) && isset($plan->plan_sale))
                                                <p class="planpriceval">T{{ ( $plan->price ) }}<span class="monthprice">/{{ $plan->billing_interval }} </span></p>
                                                <span class="saleprcnt" style="font-size:11px;"> On Sale {{$plan->plan_sale}} % Off</span>
                                                @else
                                                <p class="planpriceval">T{{ ( $plan->price ) }}<span class="monthprice">/{{ $plan->billing_interval }} </span></p>
                                                @endif
                                            </h4>
                                            <p>{{$plan->description}}</p>

                                            <?php if( !empty(@$diff_in_days)){ ?>
                                            <h6>{{$diff_in_days}} Days remaining to expire</h6>
                                          <?php }elseif(!isset($messageprc) && empty($messageprc)){ ?>
                                            <h6 class="warning">Plan is Expired</h6>
                                          <?php }else{?>

                                          <?php }?>



                                        @else
                                        @if(!empty($plan->best_seller_ribbon) && isset($plan->best_seller_ribbon) && $plan->best_seller_ribbon == '1')
                                        <div class="bextvalribbn">
                                          <p>Best Value</p>
                                        </div>
                                        @endif
                                        <h4 class="{{ $class }}" style="{{ $header_color }}">
                                            <span class="font28 block">{{ $plan->name }}</span>
                                            @if(!empty($plan->plan_sale) && isset($plan->plan_sale))
                                            <p class="planpriceval">T{{ ( $plan->price ) }}<span class="monthprice">/{{ $plan->billing_interval }} </span></p>
                                            <p class="saleprcnt" style="font-size:11px;"> On Sale <span>{{$plan->plan_sale}} % Off</span></p>
                                            @else
                                            <p class="planpriceval">T{{ ( $plan->price ) }}<span class="monthprice">/{{ $plan->billing_interval }} </span></p>
                                            @endif
                                        </h4>
                                        <p>{{$plan->description}}</p>
                                        @endif
                                              <!-- && ( !$user->subscription('main')->onGracePeriod() ) -->

                                    @if($subscription)
                                      
                                        @if( $subscription->stripe_plan == $plan->plan_id && $user->subscribed('main')  && !empty($diff_in_days) && $cancelbtn != '1')


                                            <form class="form-horizontal " role="form" method="POST" action="{{ url('/')}}/subscription/cancel">
                                                @csrf
                                                <input type="hidden" name="chargeId" value="{{ $plan->plan_id }}" >
                                                <button type="submit" onclick="return confirm('Are you sure you want to cancel this plan?')" class="mtop10 pricetab_black btnred">Cancel</button>
                                            </form>
                                        @else
                                        @if ($currentPlan == $plan->name && empty($diff_in_days))
                                            <form class="form-horizontal " role="form" method="POST" action="{{ url('/')}}/subscription/checkout">
                                                @csrf
                                                <input type="hidden" name="chargeId" value="{{ $plan->plan_id }}" >
                                                <input type="hidden" name="newplanbuy" value="0" >
                                                <button type="submit" onclick="return confirm('Are you sure you want to renew this plan?')" class="mtop10 pricetab_green">Renew</button>
                                            </form>

                                            @else
                                            @if ($cPlan && $cPlan->price == $plan->price && empty($diff_in_days))
                                            <form class="form-horizontal " role="form" method="POST" action="{{ url('/')}}/subscription/checkout">
                                                @csrf
                                                <input type="hidden" name="chargeId" value="{{ $plan->plan_id }}" >
                                                <input type="hidden" name="newplanbuy" value="0" >
                                                <button type="submit" onclick="return confirm('Are you sure you want to renew this plan?')" class="mtop10 pricetab_green">Renew</button>
                                            </form>
                                            @elseif($cPlan && $cPlan->price < $plan->price && $upbtn != '1')
                                                 @if($plan->status == '0')
                                                    <form class="form-horizontal " role="form" method="POST" action="{{ url('/')}}/subscription/checkout">
                                                    @csrf
                                                    <input type="hidden" name="chargeId" value="{{ $plan->plan_id }}" >
                                                    <button type="submit" class="mtop10 pricetab_green" disabled="disabled">Unavailable</button>
                                                    </form>
                                                @else 

                                                <form class="form-horizontal " role="form" method="POST" action="{{ url('/')}}/subscription/checkout">
                                                @csrf
                                                <input type="hidden" name="chargeId" value="{{ $plan->plan_id }}" >
                                                <input type="hidden" name="newplanbuy" value="0" >
                                                <button type="submit" onclick="return confirm('Are you sure you want to upgrade this plan?')" class="mtop10 pricetab_green">Upgrade</button>
                                                </form>
                                                @endif
                                            
                                                @elseif($cPlan && $cPlan->price > $plan->price && $downbtn != '1')
                                                <form class="form-horizontal " role="form" method="POST" action="{{ url('/')}}/subscription/downgrade">
                                                    @csrf
                                                    <input type="hidden" name="chargeId" value="{{ $plan->plan_id }}" >
                                                    <input type="hidden" name="newplanbuy" value="0" >
                                                    <input type="hidden" name="downgradeplan" value="1" >
                                                    <button type="submit" onclick="return confirm('Are you sure you want to downgrade to this plan?')" class="mtop10 pricetab_green">Downgrade</button>
                                                </form>
                                              
                                            @endif

                                            @endif
                                        @endif

                                         @else

                                            <form class="form-horizontal " role="form" method="POST" action="{{ url('/')}}/subscription/checkout">
                                                @csrf
                                                <button type="submit" class="mtop10 pricetab_black">Buy</button>
                                                <input type="hidden" name="chargeId" value="{{ $plan->plan_id }}" >
                                                <input type="hidden" name="newplanbuy" value="1" >
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

                            @endif
                        @endforeach
                    @endif
                </div>
                <!--End  3 Tabs -->

                <!-- 3 Table -->
                <div class="container-fluid featureMembers-Section">
                <div class="col-md-12">
                    <div class="text-center content_heading">
                        <h3 class="font28"><b>Feature Comparison</b></h3>
                    </div>
                </div>
                <div class="col-md-12 mtop30" id="featureMember-table">
                    <div class="method text-center">
                        <div class="row margin-0 list-header hidden-sm hidden-xs">
                            <div class="col-md-3 padding0 ">
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
                            <?php
                            //echo "<pre>";
                            //print_r($plans);
                            //echo "</pre>";
                            ?>
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

              </div>
                <!--End  3 Table -->
            </div>
        </div>
        <!-- End Match Tabs -->
    </div>
</div>
<!-- End Main Content ---->
@endsection
