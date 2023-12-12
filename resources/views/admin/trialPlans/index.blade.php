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
						<h3 class="inline_block"><b class="vertical_align">Trial Plans</b>
						<a class="btn btn-info pull-right" href="{{ url('admin/trialPlans/create') }}"><i class="fa fa-plus"></i> Add</a>
						</h3>
						<hr>
						<div class="gender_box mtop30">
							<img src="{{ asset('images/loader.gif')}}" class="loading-indicator" />
                            <div class="container-fluid">

                                
                              
                                <div class="table-responsive m-t-40">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
								        <thead>
								            <tr>
								                <th>#</th>
								                <th>Title</th>
								                <th>Subscription Plan </th>
								                <th>Days</th>
								              
								                <th>Action</th>
								            </tr>
								        </thead>
								        <tbody>
								        	@foreach($trialPlan as $trial_plans)
								        		
								           <tr>
								           	<td>{{ $loop->iteration }}</td>
								           	<td>{{$trial_plans->title}}</td>
								           		@foreach($trial_plans->Allplans as $plan)

								           	<td>{{ $plan->name}}</td>
								           		@endforeach
								           	<td>{{$trial_plans->days}}</td>

								           
								           		
								           	<td>
							                	<a onclick="return confirm('Are you sure you want to delete this plan?')" href="{{route('trialPlans.destroy', $trial_plans->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>

							                	<a href="{{route('trialPlans.edit', $trial_plans->id)}}" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
							                	@if($trial_plans->status == 1)
												<input type="checkbox"  checked data-toggle="toggle" class="check" data-on="Active" data-off="Inactive" data-id="{{ $trial_plans->id}}" >
												@else
												<input type="checkbox"  data-toggle="toggle" class="check" data-on="Active" data-off="Inactive" data-id="{{ $trial_plans->id}}" >
												@endif
												  
							                </td>
								           </tr>

								           @endforeach
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
			
	      /*********update status active iactive**********/


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
		            url: '{{route("trialPlanStatus") }}',
		            type: 'post',
		            dataType: 'json',
		            data: {'status': status ,'id':Id},
		            success: function (response) {
		            	//location.reload();
		            	//console.log('response',response);
		            	if(response){
		            		$('.loading-indicator').hide();
		            	}
		                
		                
		            }
	        	});
	      });
	     	     	
	  	});

  </script>
@endsection

