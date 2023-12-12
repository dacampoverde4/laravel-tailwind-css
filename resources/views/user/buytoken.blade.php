@extends('layouts.master')

@section('page_level_styles')
   <link rel="stylesheet" type="text/css" href="{{ asset('frontendnew/css/buytokens_style.css') }}">
@yield('page_level_styles')

@section('main-content')
<div class="maincontent buytoken_pg">
    <div class="content bgwhite">
        <div class="buy_tokens">
            <div class="container-fluid">
                <div class="buytokens_sec">
                    <div class="container">
                        <div class="row mtop10 tknttl">
                            <div class="col-xs-6 col-md-8 pr0">
                                <h4 style="float:left" class="font22"><b class="vertical_align"> <img src="{{ asset('backend/images/token_bundle.png') }}" alt="bundle Img" title="Img"> TOKEN BUNDLES</b></h4>
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <a href="{{ route('wallet.credit') }}" class="btn btnred pull-right">Add Manually</a>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <div class="mtop10 text-center">
                                    <span>Buy Token bundles and save. If you already have Tokens, add more to your wallet at discount prices.</span>
                                    <h2 class="mtopbottom20"><b>Top Up Tokens</b></h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row tkenssec">
                            <div class="col-xs-12 col-md-4">
                                <div class="defimg_secr">
                                   <img src="{{ url('/images/dfltimg.png') }}" alt="image" title="" class="def_tokenimg">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-8">
                                @if($tokens)
                                @php
                                    $tokenamount = getWebsiteSettingsByKey('token_amount');
                                @endphp
                                @foreach($tokens as $token)
                                    <div class="col-md-12 col-xs-12 mb40">
                                        <div class="bordertoken">
                                            <!-- Heading -->
                                            <div class="row tokenttlesec">
                                                <div class="col-xs-6 col-md-10 pr0">
                                                    <h2 class="btknttl"><b>{{ title_case( $token->title ) }}</b></h2>
                                                </div>
                                                <div class="col-xs-6 col-md-2 text-right">
                                                    <form class="form-horizontal " role="form" method="POST" action="{{ route('token.checkouttoken')}}">
                                                            @csrf
                                                            @php
                                                                $discount = $newamount = 0;
                                                                $amount = ( $tokenamount )? $token->amount * ( $tokenamount ): $token->amount;
                                                                if( $token->discount ){
                                                                    $discount = ( $amount * $token->discount )/100;
                                                                    if( $discount ){
                                                                        $amount = $amount - $discount;
                                                                    }
                                                                }
                                                                $newamount = $amount * 100;
                                                            @endphp
                                                            <button type="submit" class="btn buybtn"><span>Buy</span></button>
                                                            <input type="hidden" name="chargeId" value="{{ $token->id }}" >
                                                            <div class="hidescript">
                                                                <!--<script
                                                                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                                                    data-key="{{ env('STRIPE_KEY') }}"
                                                                    data-amount="{{ $newamount }}"
                                                                    data-name="{{ $token->title }}"
                                                                    data-description="{{ $token->description }}"
                                                                    data-image="{{url('/')}}/backend/images/logo.jpg"
                                                                    data-locale="auto">
                                                                </script>-->
                                                            </div>
                                                        </form>
                                                </div>
                                            </div>

                                            <!-- Content -->
                                            <div class="tokens row tokens_contnt">
                                                <div class="col-md-3 col-sm-3 col-xs-12">
                                                    <div class="buytkn_bundleimg">
                                                        <img alt="bundleimg" title="Img" src="{{ url('uploads/tokenicon/'.$token->icon) }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <p>{{ $token->description }}</p>
                                                    <!-- Button -->
                                                    <div class="btnplr-sec">
                                                        @if($token->additional_text)
                                                            <button type="sumit" class="mostpopular">{{ $token->additional_text }}</button>
                                                        @endif
                                                    </div>
                                                </div>


                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
