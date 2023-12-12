@php
$title_by_page = "Add Token";
@endphp
@extends('layouts.master')
@section('htmlheader')

    <link rel="stylesheet" href="{{ asset('css/stripe.css') }}" type="text/css" />
    <script src="https://js.stripe.com/v3/"></script>
	 <style>
.lft_sec {
    background: #1976d2;
    padding: 5px;
}
p.txt_sec {
    color: #000;
    
}
b.token_sec {
    /* font-weight: bold; */
    color: #000;
}
.form-row {
    
    padding: 0 98px !important;
}
.lft_sec h1 {
    color: #fff;
    font-size: 26px;
    padding-left: 2rem;
    text-transform: capitalize;
	margin:0;
}
.para_sec h1 {
    font-size: 18px;
    color: #1976d2;
    text-transform: capitalize;
}
.rgt_sec img {
    width: 100%;
	height:100%
}
button.btn.btnred {
    background: #1976d2;
    color: #fff;
}
.btn_bt {
    text-align: center;
}
.para_bt {
    text-align: center;
    margin-top: 1rem;
}
.card {
    height: 100%;
    min-height: 500px;
}
.subbtn{
    margin: 20px auto;
}
.btn.btnred {
    background: #1976d2;
    color: #fff;
}
</style>
@endsection
@section('main-content')
<div class="maincontent">
    <div class="content bgwhite">  
        <div class="membership" style="margin-top: 2rem;">
			<div class="container-fluid">
			<div class="row">
			<div class="col-md-8">
			<div class="card"> 
              <div class="lft_sec"> 
			  <h1>deposit tokens</h1>
			  
            </div>
			<div class="card-body"> 
			  <div class="para_sec"> 
			  <p class="txt_sec">Add Tokens to your AvDopt account and pay for transactions from your wallet balance. This includes but not limited to: Premium plans, Profile features, Username change, and Donations. By default we’ll debit your wallet balance for all transactions and if it reaches 0 Tokens, you’ll be required to add more funds.</p>
			  
            </div>
			
			  <div class="para_sec">
				<h1>What Are Tokens?</h1>			  
			  <p class="txt_sec">AvDopt Tokens are our own Crypto Currency; which are only usable on Avdopt.com to purchase premium memberships and services. AvDopt Tokens cannot be bought, sold, traded, nor withdrawn outside of AvDopt.com.</p>
			  
            </div>
			  <div class="para_sec">
				<h1>Value of Token</h1>			  
			  {{-- <p class="txt_sec">USD: 1 USD = 256 Tokens</p> --}}
                          <p class="txt_sec">LINDEN: 1L$ = 1 Token</p>
			  
            </div>
			<form action="{{ route('wallet.checkoutcredit') }}" method="POST" id="payment-form">
                    @csrf
                    <input type="hidden" name="checkout_type" value="1">
                    {{-- <div class="form-row">
    					<div class="col-md-4">
                            <input type="hidden" name="stripeToken" id="stripeToken" />
                            <label for="card-element">
                               <b class="token_sec"> Token Amount:</b>
                            </label>
						</div>
						<div class="col-md-8">
                            <input type="number" class="form-control" name="amount" value="" id="amount" required/>
						</div>
                    </div> --}}
                    <!-- <div class="form-row">
                        <label for="card-element">
                            Enter Card Details
                        </label>
                        <div id="card-element">                            
                        </div>        
                        <div id="card-errors" role="alert"></div>
                    </div> -->
				    <div class="form-row">
                        <div class="col-md-12">
                            <div class="btn_bt">
                                {{-- <button class="btn btnred subbtn">Submit with Checkout</button> --}}
                            <a href="{{ url('/parcel')}}" class="btn btnred btn subbtn" >Fund wallet</a>
        					</div>
                        </div>
                    </div>
                </form>
				<div class="para_bt">
					<p class="txt_sec">AvDopt.com is not affiliated with Linden Labs. Second Life®️ & SL™️ are registered trademarks of Linden Research, Inc.</p>
			
            </div>
            </div>
            </div>
			
            </div>
			
			<div class="col-md-4">
             <div class="rgt_sec card"> 
                 <img style="
    width: 65%;
    height: auto;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;" src=" {{ url('/images/Terminal_pic.png')}}">
            </div>
            </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection    
@section('footer')
<script type="text/javascript" src="{{ asset('js/stripe.js') }}"></script>
@endsection        