<div id="unlockMoreQuest" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="font22 header_sec"><b><img src="{{ asset('backend/images/packages.png') }}" alt="Img" title="Img" class="all_users"> Membership Packages</b></h3>
            </div>
            <div class="modal-body">
                <div class="pricetabs pt30">
                    <div class="">
                        <div class="row">
                            <div class="text-center text_cntr top_intro">
                                <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do </span>
                                <span> eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
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
                            <div class="col-md-4 pricetab  text-center">
                                @php
                                $class = 'pricetab_black';
                                $user = App\User::find(Auth::user()->id);
                                if( $logged_user_subscription ){
                                if( $logged_user_subscription->stripe_plan == $plan->plan_id && $user->subscribed('main') && ( !$user->subscription('main')->onGracePeriod() ) ){
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
                                @if( $logged_user_subscription )
                                @if( $logged_user_subscription->stripe_plan == $plan->plan_id && $user->subscribed('main') && ( !$user->subscription('main')->onGracePeriod() ) )
                                <form class="form-horizontal " role="form" method="POST" action="{{ url('/')}}/subscription/cancel">
                                    @csrf
                                    <input type="hidden" name="chargeId" value="{{ $plan->plan_id }}" >
                                    <button type="submit" onclick="return confirm('Are you sure you want to cancel this plan?')" class="mtop10 pricetab_black btnred">Cancel</button>
                                </form>
                                @else
                                <form class="form-horizontal " role="form" method="POST" action="{{ route('checkout') }}">
                                    @csrf
                                    <input type="hidden" name="chargeId" value="{{ $plan->plan_id }}" >
                                    <input type="hidden" name="newplanbuy" value="0" >
                                    <button type="submit" onclick="return confirm('Are you sure you want to upgrade this plan?')" class="mtop10 pricetab_green">Upgrade</button>
                                </form>
                                @endif
                                @else
                                <form class="form-horizontal " role="form" method="POST" action="{{ route('checkout') }}">
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
                                <div class="method">
                                    <div class="cell">
                                        <div class="type">
                                            @php
                                                $monthlyconnect = getWebsiteSettingsByKey( 'sub_match_quest_count_'.$plan->id );
                                            @endphp
                                            @if( $monthlyconnect )
                                                <img src="{{ asset('backend/images/limited.png') }}" class="img-responsive">
                                                @if( $monthlyconnect == -1 )
                                                    <button type="submit">Unlimited</button>
                                                @else
                                                    <button type="submit">Limited</button>
                                                @endif
                                            @else
                                                <img src="{{ asset('backend/images/wrong.png') }}" class="img-responsive">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!--<button type="submit" class="mtop10 pricetab_black">Upgrade</button>-->
                            </div>
                            @endif
                            @endforeach
                            @endif
                        </div>
                        <!--End  3 Tabs -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>