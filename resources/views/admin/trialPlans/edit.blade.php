@extends('admin.layout.master')
@section('content')
<div class="row">
	<!-- Column -->
	<div class="col-lg-12 col-xlg-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-12">
						<h3 class="inline_block"><b>Tria Plan</b>
						<a class="btn btn-info btnpad pull-right" href="{{ url('admin/trialPlans/') }}"><i class="fa fa-arrow-left"></i> Back</a>
						</h3>
						<hr>
						
						
						<form class="form_inline fullwidth mtop40" method="post" action="{{ route('trialPlans.update',$trial_plan->id)}}" enctype="multipart/form-data">
							@method('POST')
						    @csrf
						     

						 	<div class="form-group">
 						    	<div class="row">
     								<div class="col-md-12"><label for="">Title:</label></div>
     								<div class="col-md-12">
     							     	<input type="text" class="form-control" name="title" id="title" value="{{ $trial_plan->title}}">
     								</div>
 								</div>
 							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-12"><label for="">Subscriotion Plans:</label></div>
									<div class="col-md-12">
										 <select id="" name="subscription_id" class="form-control ">
                                        	<option>Select Plan</option>
                                       			@foreach($plan as $plan_data)
                                       				
                                       				@php
                                       				$selected = "";
                                       				if($trial_plan->subscription_id == $plan_data->id){
														$selected = "selected";
                                       				}

                                       				@endphp
                                       				<option value="{{ $plan_data->id}}"  {{$selected}}>{{ $plan_data->name }}</option>
                                       				
                                        		@endforeach
                                    		</select>
                                    
									</div>
								</div>
							</div>
		 					<div class="form-group">
	 						    <div class="row">
	     							<div class="col-md-12"><label for="">No. of Days:</label></div>
	     							<div class="col-md-12">
	     							    <input type="number" class="form-control" name="days" id="days" value="{{ $trial_plan->days }}">
	     							    
	     							</div>
	 							</div>
	 						</div>
							<div class="form-group">
                            <div class="row">
                                <div class="col-md-12"><label for="name">User group:</label></div>
                                <div class="col-md-12">
                                     <select  name="user_group_id[]" class="form-control searchdropdown" multiple="multiple">
                                        <option>Select</option>
                                       	@foreach($user_group as $group)
                                       		@php 
                                       			$array = array();
                                       			foreach($trial_plan->trailGroups as $planuser) {

                                       				$array[] = $planuser->user_group_id;

                                       			}

                                       		$selected='';
                                       		if(in_array($group->id,$array)){
                                       			$selected = 'selected';
                                       		}
                                       		@endphp
                                            <option value="{{$group->id}}" {{ $selected}}>{{ $group->title}}</option>
                                       @endforeach
                                    </select>
                                  
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
<script>
    $(document).ready(function() {
        $('.searchdropdown').select2({
            placeholder: 'select',
          multiple: true
        });
    });
</script>
@endsection
