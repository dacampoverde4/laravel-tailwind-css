@extends('admin.layout.master')


@section('content')

<style type="text/css">
	.loading-indicator{
		max-width: 50px;
		position: fixed;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		display: none;
	}
</style>

<div class="row">
	<!-- Column -->
	<div class="col-lg-12 col-xlg-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-12">
						<h3 class="inline_block"><b class="vertical_align">MemberShip Plans</b>
						<a class="btn btn-info pull-right" href="{{ url('admin/subscriptionplans/create') }}"><i class="fa fa-plus"></i> Add</a>
						</h3>
						<hr>
						<div class="gender_box mtop30">
							<img src="{{ asset('images/loader.gif')}}" class="loading-indicator" />
                            <div class="container-fluid">

                                @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                @endif
                                <div class="table-responsive m-t-40">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
								        <thead>
								            <tr>
								                <th>#</th>
								                <th>Title</th>
								                <th>Price</th>
								                <th>Free Token</th>
								                <th>Billing Interval</th>
								                <th>Action</th>
								            </tr>
								        </thead>
								        <tbody>
								            @if ( $plans )
								        		@foreach ($plans as $plan)
								        			<tr>
										                <td>{{ $loop->iteration }}</td>
										                <td>{{ $plan->name }}</td>
										                <td>${{ ( $plan->price ) }}</td>
										                <td>{{ ( $plan->tokens ) }}</td>
										                @php
				        									$billings = array('day' => 'Daily', 'week' => 'Weekly', 'month' => 'Monthly', 'quarter' => 'Every 3 months', 'semiannual' => 'Every 6 months', 'year' => 'Yearly' )
				        								@endphp
										                <td>{{ isset( $billings[$plan->billing_interval] )? $billings[$plan->billing_interval] : '' }}</td>
										                <td>
										                	<a onclick="return confirm('Are you sure you want to delete this plan?')" href="{{route('plan.destroy', $plan->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
										                	<a href="{{route('plan.edit', $plan->id)}}" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
										                	@if($plan->status == 0)
															<input type="checkbox"   data-toggle="toggle" class="check" data-on="Active" data-off="Inactive" data-id="{{ $plan->id}}" >
															@else
															<input type="checkbox" checked  data-toggle="toggle" class="check" data-on="Active" data-off="Inactive" data-id="{{ $plan->id}}" >
															
															@endif
										                	<!--a  href="" ><i class="fa fa-toggle-on" id="active" aria-hidden="true"></i></a-->
														    
										                </td>
										            </tr>
								        		@endforeach
								        	@endif
								        </tbody>



							    	</table>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('page_js')
	<script type="text/javascript">
	  	$(document).ready(function() {
	      $('.table').DataTable();
			
	      	/**********active inactive plans******/
			$('.check').on('change',function(){
				$('.loading-indicator').show();
	      	$(this).attr("checked", "checked");
	      	var Id = $(this).data('id');
	      	var status = $(this).prop('checked') == true ? 1 : 0;
	      		$.ajaxSetup({
		            headers: {
		                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		                }
		        });
		      	$.ajax({
		            url: '{{route("updatePlanStatus") }}',
		            type: 'post',
		            dataType: 'json',
		            data: {'status': status ,'id':Id},
		            success: function (response) {
		            	if(response){
		            		$('.loading-indicator').hide();
		            	}
		                
		                
		            }
	        	});
	      });
	  });


		

  </script>
@endsection

