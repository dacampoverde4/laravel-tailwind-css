@extends('layouts.master')

@section('page_level_styles')
   <link rel="stylesheet" type="text/css" href="{{ asset('frontendnew/css/checkout_style.css') }}">
@yield('page_level_styles')


@section('main-content')
<!-- Start Main Content ---->
<div class="maincontent checkout_pg">
	<div class="content bgwhite">
		<div class="membership">
			<div class="container-fluid">
				@if($downgradeplan == 1 && $plandata && $lastplandata)
				<div class="checkoutbox newplanbuy-false">
					<div class="row">
						<div class="col-md-12 text-left">
							<h4 class="itemsinfo">Current Plan Details</h4>
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
										<td>{{$lastplandata->name}}</td>
                    <td>1</td>
										<td>{{$lastplandata->price}}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
          <div class="row">
						<div class="col-md-12 text-left">
							<h4 class="itemsinfo">Next Plan Details</h4>
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
              <h6> Your current plan <strong>{{$lastplandata->name}}</strong> will continue for next <strong>{{$diff_in_days}} day(s)</strong> until is over and then you will downgrade for the plan <strong>{{$plandata->name}}</strong>.</h6>
						<div class="col-md-12 text-right checkfrm-sec">
							<form class="form-horizontal " role="form" method="POST" action="{{ url('/')}}/subscription/downgradeconfirm">
            	   @csrf
            	   <input type="hidden" name="plan_id" value="{{ $plandata->plan_id }}">
            	   <input type="hidden" name="amount" value="{{ $new_price }}">
            	   <input type="hidden" name="plan_on_sale" value="{{ $plan_on_sale }}">
                 <input type="hidden" name="planname" value="{{ $plandata->name }}">
            	   <input type="hidden" name="uuid" value="{{ $user->uuid }}">
            	   <input type="hidden" name="newplanbuy" value="0">
                 <input type="hidden" name="lastplanname" value="{{ $lastplandata->name }}">
                 <input type="hidden" name="diff_in_days" value="{{$diff_in_days}}">
            	   <input type="hidden" name="appliedcouponcode" class="appliedcouponcode">
            	   <input type="hidden" name="appliedcouponcode_flag" class="appliedcouponcode_flag" value="0">
                 <button type="submit" class="btn paybtn" {{ $wallet_amount >= $plandata->price ? null : "disabled"}}>Confirm</button>
              </form>
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
