@extends('admin.layout.master')
@section('content')
<div class="row">
	<!-- Column -->
	<div class="col-lg-12 col-xlg-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-12">
						<h3 class="inline_block"><b>Membership Limitations</b>
						<a class="btn btn-info btnpad pull-right" href="{{ url('admin/subscriptionplans') }}"><i class="fa fa-arrow-left"></i> Back</a>
						</h3>
						<hr>

						@if (session('success'))
	                        <div class="alert alert-success">
	                            {{ session('success') }}
	                        </div>
	                    @endif
	                    @if (session('warning'))
	                        <div class="alert alert-warning">
	                            {{ session('warning') }}
	                        </div>
	                    @endif
						<form class="form_inline fullwidth mtop40" method="post" action="{{ route('saveFeaturesSetting', $id) }}" enctype="multipart/form-data">
						    @csrf
						     <div style="margin-bottom:20px"><code><b>Note:</b> Use -1 value for Unlimited Access</code></div>

								 <div class="form-group">
		 						    <div class="row">
		     							<div class="col-md-12"><label for="name">Name:</label></div>
		     							<div class="col-md-12">
		     							     <input type="text" class="form-control" name="name" id="name" value="{{ $subscription->name }}">
		     							     @if ($errors->has('name'))
		                                         <span class="invalid-feedback">
		                                             <strong>{{ $errors->first('name') }}</strong>
		                                         </span>
		                                     @endif
		     							</div>
		 							</div>
		 						</div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-12"><label for="name">Description:</label></div>
                                                                        <div class="col-md-12">
                                                                            <textarea class="form-control" name="description">{{ $subscription->description }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-12"><label for="price">Price:</label></div>
									<div class="col-md-12">
										<input type="text" class="form-control" name="price" id="price" value="{{ $subscription->price }}">
									</div>
								</div>
							</div>
		 						<div class="form-group">
		 						    <div class="row">
		     							<div class="col-md-12"><label for="price">Free Tokens:</label></div>
		     							<div class="col-md-12">
		     							    <input type="text" class="form-control" name="tokens" id="tokens" value="{{ $subscription->tokens }}">
		     							    @if ($errors->has('tokens'))
		                                         <span class="invalid-feedback">
		                                             <strong>{{ $errors->first('tokens') }}</strong>
		                                         </span>
		                                     @endif
		     							</div>
		 							</div>
		 						</div>

		 						<div class="form-group">
		 						    <div class="row">
		     							<div class="col-md-12"><label for="billing-interval">Billing Interval:</label></div>
		     							<div class="col-md-12">
		         							<select id="interval-selector" class="form-control" name="billing_interval">
		         								@php
		         									$billings = array('day' => 'Daily', 'week' => 'Weekly', 'month' => 'Monthly', 'quarter' => 'Every 3 months', 'semiannual' => 'Every 6 months', 'year' => 'Yearly' )
		         								@endphp
		         								@foreach( $billings as $key => $billing )
		         									<option value="{{ $key }}" {{ ( $subscription->billing_interval == $key ) ? 'selected' : '' }}>{{ $billing }}</option>
		         								@endforeach
		         							</select>
		         							@if ($errors->has('billing-interval'))
		                                         <span class="invalid-feedback">
		                                             <strong>{{ $errors->first('billing-interval') }}</strong>
		                                         </span>
		                                     @endif
		 							    </div>
		 							</div>
		 						</div>

								<div class="form-group">
		 						    <div class="row">
		     							<div class="col-md-12"><label for="price">Plan header Color:</label></div>
		     							<div class="col-md-12">
		     							    <input type="text" class="form-control" name="plan_color" id="plan_color" value="{{ $subscription->plan_color }}">
		     							    @if ($errors->has('plan_color'))
		                                         <span class="invalid-feedback">
		                                             <strong>{{ $errors->first('plan_color') }}</strong>
		                                         </span>
		                                     @endif
		     							</div>
		 							</div>
		 						</div>

							<!--	<div class="form-group">
										<div class="row">
												<label for="banner" class="col-md-12 col-form-label">{{ __('Best Seller Ribbon') }}</label>
												<div class="col-md-8">
														<input type="file" name="best_seller_ribbon" class="form-control banner image_input" value="{{ $subscription->best_seller_ribbon }}" accept="image/*">
														<div class="image_preview_div" style="margin-top: 10px;">
																<img src="{{ $subscription->best_seller_ribbon ? asset(@$subscription->best_seller_ribbon) : '' }}" alt="" style="width: 300px;" />
														</div>
														<div class="remove_image_div">
																<span class='remove_image' data-id="best_seller_ribbon">Remove Image</span>
														</div>
														<input type="hidden" name="remove_existing_image" value="0">

														@if ($errors->has('best_seller_ribbon'))
														<span class="invalid-feedback">
														<strong>{{ $errors->first('best_seller_ribbon') }}</strong>
														</span>
														@endif
												</div>
										</div>
								</div> -->

								<div class="form-group">
								    <div class="row">
		    							<div class="col-md-12">
		    								<label for="sub_my_hearts">Best Seller Ribbon:</label>
		    							</div>
		    							<div class="col-md-12 membrlmtchkbox">
			    							   <input type="checkbox" @if(@$subscription->best_seller_ribbon=='1') checked @endif style="width: 16px;" class="form-control checkbox" value="1" name="best_seller_ribbon" id="best_seller_ribbon">
		    							</div>
									</div>
								</div>

								<div class="form-group">
		 						    <div class="row">
		     							<div class="col-md-12"><label for="price">Sale %:</label></div>
		     							<div class="col-md-12">
		     							    <input type="text" class="form-control" name="plan_sale" id="plan_sale" value="{{ $subscription->plan_sale }}">
		     							    @if ($errors->has('plan_sale'))
		                                         <span class="invalid-feedback">
		                                             <strong>{{ $errors->first('plan_sale') }}</strong>
		                                         </span>
		                                     @endif
		     							</div>
		 							</div>
		 						</div>

		 						<hr style="border-color:#ccc">
		 						<h3>Membership Limitations</h3><br>
		 						<div class="form-group">
		 						    <div class="row">
		     							<div class="col-md-12"><label for="trial_period_days">Trial period:</label></div>
		     							<div class="col-md-12">
		     							    <input type="number" placeholder="Days" class="form-control" value="{{ $subscription->trial_period }}" name="trial_period_days" id="trial_period_days">
		     							    @if ($errors->has('trial_period_days'))
		                                         <span class="invalid-feedback">
		                                             <strong>{{ $errors->first('trial_period_days') }}</strong>
		                                         </span>
		                                     @endif
		     							</div>
		 							</div>
		 						</div>

							<div class="form-group">
							    <div class="row">
	    							<div class="col-md-12">
	    								<label for="private_messages">Private Messages:</label>
	    								<i><br>How many notes user can send?</i>
	    							</div>
	    							<div class="col-md-12">
	    							    <input type="number" class="form-control" value="{{ @$websiteSetting['sub_private_messages_'.$id] }}" name="websiteSettings[sub_private_messages_{{ $id }}]" id="sub_private_messages">
	    							    @if ($errors->has('sub_private_messages'))
	                                        <span class="invalid-feedback">
	                                            <strong>{{ $errors->first('sub_private_messages') }}</strong>
	                                        </span>
	                                    @endif
	    							</div>
								</div>
							</div>
							<div class="form-group">
							    <div class="row">
	    							<div class="col-md-12">
	    								<label for="trial_period_days">Live Chats:</label>
	    								<i><br>User can chat with number of users in a month?</i>
	    							</div>
	    							<div class="col-md-12">
	    							    <input type="number" placeholder="Days" class="form-control" value="{{ @$websiteSetting['sub_monthly_connection_'.$id] }}" name="websiteSettings[sub_monthly_connection_{{ $id }}]" id="sub_monthly_connection">
	    							    @if ($errors->has('trial_period_days'))
	                                        <span class="invalid-feedback">
	                                            <strong>{{ $errors->first('trial_period_days') }}</strong>
	                                        </span>
	                                    @endif
	    							</div>
								</div>
							</div>
							<div class="form-group">
							    <div class="row">
	    							<div class="col-md-12">
	    								<label for="sub_username_change">UserName Change:</label>
	    								<i><br>How many times user will change his/her profile picture in a month?</i>
	    							</div>
	    							<div class="col-md-12">
	    							    <input type="number" class="form-control" value="{{ @$websiteSetting['sub_username_change_'.$id] }}" name="websiteSettings[sub_username_change_{{ $id }}]" id="sub_username_change">
	    							    @if ($errors->has('sub_username_change'))
	                                        <span class="invalid-feedback">
	                                            <strong>{{ $errors->first('sub_username_change') }}</strong>
	                                        </span>
	                                    @endif
	    							</div>
								</div>
							</div>
							<div class="form-group">
							    <div class="row">
	    							<div class="col-md-12">
	    								<label for="sub_view_my_likes">View My Likes:</label>
	    								<i><br>How many likes visible?</i>
	    							</div>
	    							<div class="col-md-12">
	    							    <input type="number" class="form-control" value="{{ @$websiteSetting['sub_view_my_likes_'.$id] }}" name="websiteSettings[sub_view_my_likes_{{ $id }}]" id="sub_view_my_likes">
	    							    @if ($errors->has('sub_view_my_likes'))
	                                        <span class="invalid-feedback">
	                                            <strong>{{ $errors->first('sub_view_my_likes') }}</strong>
	                                        </span>
	                                    @endif
	    							</div>
								</div>
							</div>
							<div class="form-group">
							    <div class="row">
	    							<div class="col-md-12">
	    								<label for="sub_view_my_matches">View My Matches:</label>
	    								<i><br>How many Matches visible</i>
	    							</div>
	    							<div class="col-md-12">
	    							    <input type="number" class="form-control" value="{{ @$websiteSetting['sub_view_my_matches_'.$id] }}" name="websiteSettings[sub_view_my_matches_{{ $id }}]" id="sub_view_my_matches">
	    							    @if ($errors->has('sub_view_my_matches'))
	                                        <span class="invalid-feedback">
	                                            <strong>{{ $errors->first('sub_view_my_matches') }}</strong>
	                                        </span>
	                                    @endif
	    							</div>
								</div>
							</div>
							<div class="form-group">
							    <div class="row">
	    							<div class="col-md-12">
	    								<label for="sub_my_hearts">My Hearts:</label>
	    								<i><br>My heart</i>
	    							</div>
	    							<div class="col-md-12 membrlmtchkbox">

	    							   <input type="checkbox" @if(@$websiteSetting['sub_my_hearts_'.$id]=='1') checked @endif style="width: 16px;" class="form-control checkbox" value="1" name="websiteSettings[sub_my_hearts_{{ $id }}]]" id="sub_my_hearts">
	    							</div>
								</div>
							</div>
							<div class="form-group">
							    <div class="row">
	    							<div class="col-md-12">
	    								<label for="sub_advance_search">Advance Search:</label>
	    								<i><br>Get even more options with our advanced search tools.</i>
	    							</div>
	    							<div class="col-md-12 membrlmtchkbox">
	    							     <input type="checkbox" @if(@$websiteSetting['sub_advance_search_'.$id]=='1') checked @endif style="width: 16px;" class="form-control checkbox" value="1" name="websiteSettings[sub_advance_search_{{ $id }}]]" id="sub_advance_search">
	    							</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
	    							<div class="col-md-12"><label for="trial_token">Monthly Max Trial:</label></div>
	    							<div class="col-md-12">
	    							    <input type="number" placeholder="Tokens" class="form-control" value="{{ @$websiteSetting['sub_trial_token_'.$id] }}" name="websiteSettings[sub_trial_token_{{ $id }}]" id="sub_trial_token">
	    							    @if ($errors->has('trial_token'))
	                                        <span class="invalid-feedback">
	                                            <strong>{{ $errors->first('trial_token') }}</strong>
	                                        </span>
	                                    @endif
	    							</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
	    							<div class="col-md-12"><label for="user_image_change">How many time user will change Profile Picture</label></div>
	    							<div class="col-md-12">
	    							    <input type="number" placeholder="In Numbers" class="form-control" value="{{ @$websiteSetting['sub_user_image_change_'.$id] }}" name="websiteSettings[sub_user_image_change_{{ $id }}]" id="sub_user_image_change">
	    							    @if ($errors->has('user_image_change'))
	                                        <span class="invalid-feedback">
	                                            <strong>{{ $errors->first('user_image_change') }}</strong>
	                                        </span>
	                                    @endif
	    							</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
	    							<div class="col-md-12"><label for="user_image_change">No of free profile visitor</label></div>
	    							<div class="col-md-12">
	    							    <input type="number" placeholder="Free Profile Visit" class="form-control" value="{{ @$websiteSetting['sub_free_profile_visit_'.$id] }}" name="websiteSettings[sub_free_profile_visit_{{ $id }}]" id="sub_free_profile_visit">
	    							    @if ($errors->has('user_image_change'))
	                                        <span class="invalid-feedback">
	                                            <strong>{{ $errors->first('user_image_change') }}</strong>
	                                        </span>
	                                    @endif
	    							</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
	    							<div class="col-md-12">
	    								<label for="user_image_change">Max No of images upload by user</label>
	    							</div>
	    							<div class="col-md-12">
	    							    <input type="number" placeholder="Max No of images" class="form-control" value="{{ @$websiteSetting['sub_max_images_upload_'.$id] }}" name="websiteSettings[sub_max_images_upload_{{ $id }}]" id="sub_max_images_upload">
	    							    @if ($errors->has('sub_max_images_upload'))
	                                        <span class="invalid-feedback">
	                                            <strong>{{ $errors->first('sub_max_images_upload') }}</strong>
	                                        </span>
	                                    @endif
	    							</div>
								</div>
							</div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="user_image_change">Enter MATCH QUESTIONS.</label>
                                    </div>
                                    <div class="col-md-12 input-match-quest">
                                        <input type="number" placeholder="Max No of Match Questions" class="form-control" value="{{ @$websiteSetting['sub_match_quest_count_'.$id] }}" name="websiteSettings[sub_match_quest_count_{{ $id }}]" id="">
                                    </div>
                                </div>
                            </div>
							<div class="form-group">
							    <div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-9"><button type="submit" class="btn btn-success pull-right border_radius">Update</button></div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('page_js')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.searchdropdown').select2({
            placeholder: 'select feature',
          multiple: true
        });
    });

function readURL(input, profile_preview_img) {
    console.log('input.files: ',input.files)
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(profile_preview_img).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$(".remove_image").click(function () {
    var form_group = $(this).closest('.form-group');
    $(form_group).find('input[type=file]').val('');
    $(form_group).find('.image_preview_div img').attr('src', '');
    $(this).hide();
    $(form_group).find('.image_preview_div img').hide();
});
$("input[type=file]").change(function(){
		var profile_preview_img = $(this).closest('.form-group').find('.image_preview_div img');
		$(profile_preview_img).show();
		readURL(this, profile_preview_img);
		$(this).closest('.form-group').find(".remove_image").show();
		$("input[name=remove_existing_image]").val(0);
});
$('select').select2();
</script>
<script>
		$(function () {
				$('#plan_color').colorpicker();
		});
</script>
@endsection
