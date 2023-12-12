@extends('layouts.master')

@section('page_level_styles')
   <link rel="stylesheet" type="text/css" href="{{ asset('frontendnew/css/checkout_style.css') }}">
@yield('page_level_styles')


@section('main-content')
<!-- Start Main Content ---->
<?php

if(!empty($plandata_price)){
  $plandata->price = $plandata_price;
}
else{
	if($plandata){
		$plandata->price;
	}
}
?>
<div class="maincontent checkout_pg">
	<div class="content bgwhite">
		<div class="membership">
			<div class="container-fluid">
				@if($newplanbuy == 0 && $plandata)

				<div class="checkoutbox newplanbuy-false">
					<div class="row">
						<div class="col-md-12 text-left">
							<h4 class="itemsinfo">Item Details</h4>
						</div>
						<div class="col-md-12">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Item Name</th>
                    <th>Quantity</th>
										<th>Item Price</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>{{$plandata->name}}</td>
                    <td>1</td>
										<td>{{$plandata->price}}</td>
									</tr>
                  <tr>
                    <td colspan="2">Discount</td>
                    <td>{{ $plan_on_sale = $plandata->plan_sale !='' ? $plandata->plan_sale.'%' : 'NA' }}</td>
                  </tr>
                  <tr>
                    <td colspan="2">Total Amount</td>
                    <td>{{ $new_price =  $plandata->plan_sale ? ($plandata->price - ($plandata->price * $plandata->plan_sale / 100)) : $plandata->price }}</td>
                  </tr>

								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 couponcode-section">
							<div class="form-group">
								<label>Do you have coupon code ?</label>
								<input type="text" class="form-control couponcode" name="couponcode">
								<div class="status-msg"></div>
							</div>
							<div class="form-group">
								<button class="btn btn-success apply-coupon" type="button">Apply</button>
								<button class="btn btn-info reset-coupon" type="button">Reset</button>
							</div>
						</div>
					</div>
					<div class="row">

						<div class="col-md-12 text-right checkfrm-sec">
							<form class="form-horizontal " role="form" method="POST" action="{{ url('/')}}/subscription/paywithwallet">
            	                    @csrf

            	                <input type="hidden" name="plan_id" value="{{ $plandata->plan_id }}">
                              <input type="hidden" name="amount" value="{{ $new_price }}">
                         	    <input type="hidden" name="plan_on_sale" value="{{ $plan_on_sale }}">
            	                <input type="hidden" name="planname" value="{{ $plandata->name }}">
            	                <input type="hidden" name="uuid" value="{{ $user->uuid }}">
            	                <input type="hidden" name="newplanbuy" value="0">
            	                <input type="hidden" name="appliedcouponcode" class="appliedcouponcode">
            	                <input type="hidden" name="appliedcouponcode_flag" class="appliedcouponcode_flag" value="0">
                            	<button type="submit" class="btn paybtn" >Pay using Wallet Balance</button>
                            </form>
							

                            {{-- <form class="form-horizontal" id="inworldform" role="form" method="POST">
            	                    @csrf
            	                <input type="hidden" name="plan_id" value="{{ $plandata->plan_id }}">
                              <input type="hidden" name="amount" value="{{ $new_price }}">
                         	    <input type="hidden" name="plan_on_sale" value="{{ $plan_on_sale }}">
            	                <input type="hidden" name="planname" value="{{ $plandata->name }}">
            	                <input type="hidden" name="uuid" value="{{ $user->uuid }}">
            	                <input type="hidden" name="newplanbuy" value="0">
            	                <input type="hidden" name="appliedcouponcode" class="appliedcouponcode">
            	                <input type="hidden" name="appliedcouponcode_flag" class="appliedcouponcode_flag" value="0">
                            	<button type="submit" id="inworldbtn" class="btn paybtn" {{ $wallet_amount >= $plandata->price ? "disabled" : null}}>Pay using In-World Terminal</button>
                            </form> --}}

						</div>
					</div>
				</div>
				@elseif($newplanbuy == 1 && $plandata)

				<div class="checkoutbox newplanbuy-true">
					<div class="row">
						<div class="col-md-12 text-left">
							<h4 class="itemsinfo">Item Details 1</h4>
						</div>
						<div class="col-md-12">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Item Name</th>
                    <th>Quantity</th>
										<th>Item Price</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>{{$plandata->name}}</td>
                    <td>1</td>
										<td>{{$plandata->price}}</td>
									</tr>
                  <tr>
                    <td colspan="2">Discount</td>
                    <td>{{ $plan_on_sale = $plandata->plan_sale !='' ? $plandata->plan_sale.'%' : 'NA' }}</td>
                  </tr>
                  <tr>
                    <td colspan="2">Total Amount</td>
                    <td>{{ $new_price =  $plandata->plan_sale ? ($plandata->price - ($plandata->price * $plandata->plan_sale / 100)) : $plandata->price }}</td>
                  </tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 couponcode-section">
							<div class="form-group">
								<label>Do you have coupon code ?</label>
								<input type="text" class="form-control couponcode" name="couponcode">
								<div class="status-msg"></div>
							</div>
							<div class="form-group">
								<button class="btn btn-success apply-coupon" type="button">Apply</button>
								<button class="btn btn-info reset-coupon" type="button">Reset</button>
							</div>
						</div>
					</div>
					<div class="row">

						<div class="col-md-12 text-right checkfrm-sec">
							<form class="form-horizontal " role="form" method="POST" action="{{ url('/')}}/subscription/paywithwallet">
            	                    @csrf
            	                <input type="hidden" name="plan_id" value="{{ $plandata->plan_id }}">
                              <input type="hidden" name="amount" value="{{ $new_price }}">
                         	    <input type="hidden" name="plan_on_sale" value="{{ $plan_on_sale }}">
            	                <input type="hidden" name="planname" value="{{ $plandata->name }}">
            	                <input type="hidden" name="uuid" value="{{ $user->uuid }}">
            	                <input type="hidden" name="newplanbuy" value="1">
            	                <input type="hidden" name="appliedcouponcode" class="appliedcouponcode">
            	                <input type="hidden" name="appliedcouponcode_flag" class="appliedcouponcode_flag" value="0">
                            	<button type="submit" class="btn paybtn" >Pay using Wallet Balance</button>
                            </form>

								
                            {{-- <form class="form-horizontal" id="inworldform" role="form" method="POST">
            	                    @csrf
            	                <input type="hidden" name="plan_id" value="{{ $plandata->plan_id }}">
                              <input type="hidden" name="amount" value="{{ $new_price }}">
                         	    <input type="hidden" name="plan_on_sale" value="{{ $plan_on_sale }}">
            	                <input type="hidden" name="planname" value="{{ $plandata->name }}">
            	                <input type="hidden" name="uuid" value="{{ $user->uuid }}">
            	                <input type="hidden" name="newplanbuy" value="1">
            	                <input type="hidden" name="appliedcouponcode" class="appliedcouponcode">
            	                <input type="hidden" name="appliedcouponcode_flag" class="appliedcouponcode_flag" value="0">
                            	<button type="submit" id="inworldbtn" class="btn paybtn" {{ $wallet_amount >= $plandata->price ? "disabled" : null}}>Pay using In-World Terminal</button>
                            </form> --}}

						</div>
					</div>
				</div>
				@endif

				@if($token)
				<div class="checkoutbox token">
					<div class="row">
						<div class="col-md-12 text-left">
							<h4 class="itemsinfo">Item Details</h4>
						</div>
						<div class="col-md-12">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Item Name</th>
										<th>Quantity</th>
										<th>Item Price</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>{{$token->title}}</td>
										<td>1</td>
										<td>{{$token->amount}}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 couponcode-section">
							<div class="form-group">
								<label>Do you have coupon code ?</label>
								<input type="text" class="form-control couponcode" name="couponcode">
								<div class="status-msg"></div>
							</div>
							<div class="form-group">
								<button class="btn btn-success apply-coupon" type="button">Apply</button>
								<button class="btn btn-info reset-coupon" type="button">Reset</button>
							</div>
						</div>
					</div>
					<div class="row">

						<div class="col-md-12 text-right checkfrm-sec">
							<form class="form-horizontal " role="form" method="POST" action="{{route('token.paytokenwithwallet')}}">
            	                @csrf
            	                <input type="hidden" name="chargeId" value="{{ $token->id }}">
            	                <input type="hidden" name="amount" value="{{ $token->amount }}">
            	                <input type="hidden" name="planname" value="{{ $token->title }}">
            	                <input type="hidden" name="uuid" value="{{ $user->uuid }}">
                            	<button type="submit" class="btn paybtn">Pay using Wallet Balance</button>
                            </form> 

                            {{-- <form class="form-horizontal" id="inworldformtoken" role="form" method="POST">
            	                @csrf
            	                <input type="hidden" name="plan_id" value="{{ $token->id }}">
            	                <input type="hidden" name="amount" value="{{ $token->amount }}">
            	                <input type="hidden" name="planname" value="{{ $token->title }}">
            	                <input type="hidden" name="uuid" value="{{ $user->uuid }}">
            	                <input type="hidden" name="appliedcouponcode" class="appliedcouponcode">
            	                <input type="hidden" name="appliedcouponcode_flag" class="appliedcouponcode_flag" value="0">
                            	<button type="submit" id="inworldbtntoken" class="btn paybtn">Pay using In-World Terminal</button>
                            </form> --}}

						</div>
					</div>
				</div>
				@endif

				@if($featuredata)
				<div class="checkoutbox featuredata">
					<div class="row">
						<div class="col-md-12 text-left">
							<h4 class="itemsinfo">Item Details</h4>
						</div>
						<div class="col-md-12">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Item Name</th>
										<th>Quantity</th>
										<th>Item Price</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>{{$featuredata->name}}</td>
                    <td>1</td>
										<td>{{$featuredata->tokens}}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 couponcode-section">
							<div class="form-group">
								<label>Do you have coupon code ?</label>
								<input type="text" class="form-control couponcode" name="couponcode">
								<div class="status-msg"></div>
							</div>
							<div class="form-group">
								<button class="btn btn-success apply-coupon" type="button">Apply</button>
								<button class="btn btn-info reset-coupon" type="button">Reset</button>
							</div>
						</div>
					</div>
					<div class="row">

						<div class="col-md-12 text-right checkfrm-sec">
							<form class="form-horizontal " role="form" method="POST" action="{{ url('/subscription/paywithwalletfeature') }}">
            	                    @csrf
            	                <input type="hidden" name="plan_id" value="{{ $featuredata->plan_id }}">
            	                <input type="hidden" name="amount" value="{{ $featuredata->tokens }}">
            	                <input type="hidden" name="planname" value="{{ $featuredata->name }}">
            	                <input type="hidden" name="uuid" value="{{ $user->uuid }}">
            	                <input type="hidden" name="appliedcouponcode" class="appliedcouponcode">
            	                <input type="hidden" name="appliedcouponcode_flag" class="appliedcouponcode_flag" value="0">
                            	<button type="submit" class="btn paybtn" >Pay using Wallet Balance</button>
                            </form>


                            {{-- <form class="form-horizontal" id="inworldformfeature" role="form" method="POST">
            	                    @csrf
            	                <input type="hidden" name="plan_id" value="{{ $featuredata->plan_id }}">
            	                <input type="hidden" name="amount" value="{{ $featuredata->tokens }}">
            	                <input type="hidden" name="planname" value="{{ $featuredata->name }}">
            	                <input type="hidden" name="uuid" value="{{ $user->uuid }}">
            	                <input type="hidden" name="appliedcouponcode" class="appliedcouponcode">
            	                <input type="hidden" name="appliedcouponcode_flag" class="appliedcouponcode_flag" value="0">
                            	<button type="submit" id="inworldbtnfeature" class="btn paybtn" {{ $wallet_amount >= $featuredata->tokens ? "disabled" : null}} >Pay using In-World Terminal</button>
                            </form> --}}

						</div>
					</div>
				</div>
				@endif

				@if($creditamount)
					<div class="checkoutbox creditamount">
						<div class="row">
							<div class="col-md-12 text-left">
								<h4 class="itemsinfo">Item Details</h4>
							</div>
							<div class="col-md-12">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Item Name</th>
											<th>Quantity</th>
											<th>Item Price</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Token</td>
											<td>1</td>
											<td>{{$creditamount}}</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 couponcode-section">
								<div class="form-group">
									<label>Do you have coupon code ?</label>
									<input type="text" class="form-control couponcode" name="couponcode">
									<div class="status-msg"></div>
								</div>
								<div class="form-group">
									<button class="btn btn-success apply-coupon" type="button">Apply</button>
									<button class="btn btn-info reset-coupon" type="button">Reset</button>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-right checkfrm-sec">
								<form class="form-horizontal" id="inworldformcredit" role="form" method="POST">
	            	                @csrf
	            	                <input type="hidden" name="amount" value="{{ $creditamount }}">
	            	                <input type="hidden" name="uuid" value="{{ $user->uuid }}">
	            	                <input type="hidden" name="appliedcouponcode" class="appliedcouponcode">
            	                	<input type="hidden" name="appliedcouponcode_flag" class="appliedcouponcode_flag" value="0">
	                            	<button type="submit" id="inworldbtncredit" class="btn paybtn">Pay using In-World Terminal</button>
	                            </form>
							</div>
						</div>
					</div>
				@endif

				@if($donation)
					<div class="checkoutbox donation">
						<div class="row">
							<div class="col-md-12 text-left">
								<h4 class="itemsinfo">Item Details</h4>
							</div>
							<div class="col-md-12">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Item Name</th>
											<th>Quantity</th>
											<th>Item Price</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Donation</td>
											<td>1</td>
											<td>{{$donation->amount}}</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 couponcode-section">
								<div class="form-group">
									<label>Do you have coupon code ?</label>
									<input type="text" class="form-control couponcode" name="couponcode">
									<div class="status-msg"></div>
								</div>
								<div class="form-group">
									<button class="btn btn-success apply-coupon" type="button">Apply</button>
									<button class="btn btn-info reset-coupon" type="button">Reset</button>
								</div>
							</div>
						</div>
						<div class="row">

							<div class="col-md-12 text-right checkfrm-sec">
								<form class="form-horizontal " role="form" method="POST" action="{{ route('wallet.paywithwalletdonation') }}">
	            	                    @csrf
	            	                <input type="hidden" name="amount" value="{{ $donation->amount }}">
	            	                <input type="hidden" name="show_supporter" value="{{ $donation->show_supporter }}">
	            	                <input type="hidden" name="show_amount" value="{{ $donation->show_amount }}">
	            	                <input type="hidden" name="uuid" value="{{ $user->uuid }}">
	            	                <input type="hidden" name="appliedcouponcode" class="appliedcouponcode">
            	                	<input type="hidden" name="appliedcouponcode_flag" class="appliedcouponcode_flag" value="0">
	                            	<button type="submit" class="btn paybtn" >Pay using Wallet Balance</button>
	                            </form>


	                            {{-- <form class="form-horizontal" id="inworldformdonation" role="form" method="POST">
	            	                    @csrf
	            	                <input type="hidden" name="amount" value="{{ $donation->amount }}">
	            	                <input type="hidden" name="show_supporter" value="{{ $donation->show_supporter }}">
	            	                <input type="hidden" name="show_amount" value="{{ $donation->show_amount }}">
	            	                <input type="hidden" name="uuid" value="{{ $user->uuid }}">
	            	                <input type="hidden" name="appliedcouponcode" class="appliedcouponcode">
            	                	<input type="hidden" name="appliedcouponcode_flag" class="appliedcouponcode_flag" value="0">
	                            	<button type="submit" id="inworldbtndonation" class="btn paybtn" {{ $wallet_amount >= $donation->amount ? "disabled" : null}} >Pay using In-World Terminal</button>
	                            </form> --}}
							</div>
						</div>
					</div>
				@endif

				@if($advertisement)
					<div class="checkoutbox donation">
						<div class="row">
							<div class="col-md-12 text-left">
								<h4 class="itemsinfo">Item Details</h4>
							</div>
							<div class="col-md-12">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Item Name</th>
											<th>Quantity</th>
											<th>Item Price</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>T{{ $advertisement->total_amt }}/ {{ $advertisement->banner_plan }}</td>
											<td>1</td>
											<td>{{$advertisement->total_amt}}</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 couponcode-section">
								<div class="form-group">
									<label>Do you have coupon code ?</label>
									<input type="text" class="form-control couponcode" name="couponcode">
									<div class="status-msg"></div>
								</div>
								<div class="form-group">
									<button class="btn btn-success apply-coupon" type="button">Apply</button>
									<button class="btn btn-info reset-coupon" type="button">Reset</button>
								</div>
							</div>
						</div>
						<div class="row">

							<div class="col-md-12 text-right checkfrm-sec">
								<form class="form-horizontal " role="form" method="POST" action="{{ route('paywithwalletads.manageads')}}">
	            	                    @csrf
	            	                <input type="hidden" name="amount" value="{{ $advertisement->total_amt }}">
	            	                <input type="hidden" name="uuid" value="{{ $user->uuid }}">
	            	                <input type="hidden" name="ads_id" value="{{ $advertisement->id }}">
	            	                <input type="hidden" name="appliedcouponcode" class="appliedcouponcode">
            	                	<input type="hidden" name="appliedcouponcode_flag" class="appliedcouponcode_flag" value="0">
            	                	<button type="submit" class="btn paybtn" >Pay using Wallet Balance</button>
	                            </form>


	                            {{-- <form class="form-horizontal" id="inworldformads" role="form" method="POST">
	            	                    @csrf
	            	                <input type="hidden" name="amount" value="{{ $advertisement->total_amt }}">
	            	                <input type="hidden" name="uuid" value="{{ $user->uuid }}">
	            	                <input type="hidden" name="ads_id" value="{{ $advertisement->id }}">
	            	                <input type="hidden" name="appliedcouponcode" class="appliedcouponcode">
            	                	<input type="hidden" name="appliedcouponcode_flag" class="appliedcouponcode_flag" value="0">
	                            	<button type="submit" id="inworldbtnads" class="btn paybtn" {{ $wallet_amount >= $advertisement->total_amt ? "disabled" : null}}>Pay using In-World Terminal</button>
	                            </form> --}}
							</div>
						</div>
					</div>
				@endif

			</div>
		</div>
	</div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$("button.apply-coupon").click(function() {
	    var couponcode = $("input[name=couponcode]").val();
	    var btn_obj = $(this);
	    $(".couponcode-section .status-msg").html('');
	    $(".couponcode-section .status-msg").removeClass('error');
	    $(".couponcode-section .status-msg").removeClass('success');
	    //$(btn_obj).prop('disabled', true);
	    $(btn_obj).text('Processing...');
	    if (couponcode) {
	        $.ajax({
	            url: "{{ route('applycoupon') }}",
	            type: "POST",
	            data: {
	                '_token': '{{ csrf_token() }}',
	                'couponcode': couponcode,
	                'plan_id': $("input[name=plan_id]").val()
	            },
	            success: function(result) {
	                var result = JSON.parse(result);
	                if (result.status) {
	                    $(".couponcode-section .status-msg").addClass('success');
	                    $(".reset-coupon").show();
	                    $(".appliedcouponcode").val(couponcode);
	                    $(".appliedcouponcode_flag").val(1);
	                } else {
	                    $(".couponcode-section .status-msg").addClass('error');
	                    $(".appliedcouponcode").val('');
	                    $(".appliedcouponcode_flag").val(0);
	                }
	                $(".couponcode-section .status-msg").html(result.message);
	                $(btn_obj).prop('disabled', false);
	                $(btn_obj).text('Apply');
	            }
	        });
	    } else {
	        $(".couponcode-section .status-msg").html('Please enter coupon code');
	        $(".couponcode-section .status-msg").addClass('error');
	        $(btn_obj).prop('disabled', false);
	        $(btn_obj).text('Apply');
	        $(".appliedcouponcode").val('');
	        $(".appliedcouponcode_flag").val(0);
	    }
	});
	$(".reset-coupon").click(function() {
	    $(".appliedcouponcode").val('');
	    $(".appliedcouponcode_flag").val(0);
	    $("input[name=couponcode]").val('');
	    $(".couponcode-section .status-msg").html('');
	    $(this).hide();
	});

	$("#inworldbtn").click(function(e){
		window.location.href = "{{ url('/parcel')}}";
		e.preventDefault();
		$.ajax({
          method: "POST",
          url: "{{ url('api/sl/prepurchase-plan')}}",
          data: $("#inworldform").serialize(),
          success: function(result)
          {
          	if(result.success == true){
            	window.location.href = "{{ url('/parcel')}}";
            }

            if(result.success == false){
            	window.location.href = "{{ url('/subscription/failed')}}";
            }
          }
       })
	});

	$("#inworldbtnfeature").click(function(e){
		e.preventDefault();
		$.ajax({
          method: "POST",
          url: "{{ url('api/sl/purchase-plan-feature')}}",
          data: $("#inworldformfeature").serialize(),
          success: function(result)
          {
            if(result.success == true){
            	window.location.href = "{{ url('/parcel')}}";
            }

            if(result.success == false){
            	window.location.href = "{{ url('/subscription/failed')}}";
            }
          }
       })
	});

	//token
	$("#inworldbtntoken").click(function(e){
		e.preventDefault();
		$.ajax({
          method: "POST",
          url: "{{ url('api/sl/purchase-token')}}",
          data: $("#inworldformtoken").serialize(),
          success: function(result)
          {

          	if(result.success == true){
            	window.location.href = "{{ url('/parcel')}}";
            }

            if(result.success == false){
            	window.location.href = "{{ url('/subscription/failed')}}";
            }
          }
       })
	});

	//credit deposite
	$("#inworldbtncredit").click(function(e){
		
		e.preventDefault();
		$.ajax({
          method: "POST",
          url: "{{ url('api/sl/add-balance-to-user') }}",
          data: $("#inworldformcredit").serialize(),
          success: function(result)
          {
          	if(result.success == true){
            	window.location.href = "{{ url('/parcel') }}";
            }

            if(result.success == false){
            	window.location.href = "{{ url('/wallet/failed')}}";
            }
          }
       })
	});

	//credit donation
	$("#inworldbtndonation").click(function(e){
		e.preventDefault();
		$.ajax({
          method: "POST",
          url: "{{ url('api/sl/add-donation') }}",
          data: $("#inworldformdonation").serialize(),
          success: function(result)
          {
          	if(result.success == true){
            	window.location.href = "{{ url('/parcel')}}";
            }

            if(result.success == false){
            	window.location.href = "{{ url('/subscription/failed')}}";
            }
          }
        })
	});

	//advertisement inwordterminal
	$("#inworldbtnads").click(function(e){
		e.preventDefault();
		$.ajax({
          method: "POST",
          url: "{{ url('api/sl/add-advertisement') }}",
          data: $("#inworldformads").serialize(),
          success: function(result)
          {
          	if(result.success == true){
            	window.location.href = "{{ url('/parcel')}}";
            }

            if(result.success == false){
            	window.location.href = "{{ url('/subscription/failed')}}";
            }
          }
        })
	})

});
</script>
