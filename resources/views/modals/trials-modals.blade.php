<div id="myModal" class="modal fade profile_modal" role="dialog">
	<div class="modal-dialog">
		@php
		$user = App\User::find(Auth::user()->id);
		//dd($user);
		
		@endphp
		<!-- Modal content-->
		 <form id="mytrial" class="form-horizontal" role="form" method="POST" action="{{route('trials.store')}}">
		 	@csrf
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><img src="{{asset('backend/images/red_cross.png')}}" alt=""></button>
			</div>
			<div class="modal-body">
				<p>Congrats, {{$user->name}} You've matched with <span class = "matcher_name">Amy Johnson</span></p>
				<p class = "response_message"></p>
				<div class="row mtop40 vertical_align">
					<div class="col-md-4 col-sm-4">
						<img src="{{asset('backend/images/member2.png')}}" class = "macher_image"  alt="">
					</div>
					<div class="col-md-2 col-sm-2">
						<h3>MATCH</h3>
					</div>
					@php
                   	 $profilepic = ($user->profile_pic )? 'uploads/'.$user->profile_pic : 'images/default.png';
                    @endphp
					<div class="col-md-4 col-sm-4">
						<img src="{{ $profilepic }}" alt="">
					</div>
					<div class="col-md-2 col-sm-2">
						<input type = "hidden" name = "user_id" value = "{{$user->id}}" id = "user_id">
						<input type = "hidden" name = "macher_id" value = "" id = "macher_id">
					</div>
				</div>
				<div class="row mtop40">
					<div class="col-md-12">
						<input type="hidden" name="trialid" id="trialid" value="">
						<label><i class="fa fa-calendar" aria-hidden="true"></i>Your Suitable Trial Date:</label>
						<input type="text" name = "date" placeholder="" class="border_radius mtopbottom10 date" id='datetimepicker1' >
					</div>
					<div class="col-md-12">
						<label><i class="fa fa-clock-o" aria-hidden="true"></i>Your Suitable Trial Time:</label>
						<input type="text" name = "time" placeholder="" id="datetimepicker3" class="border_radius mtopbottom10 time" data-provide="timepicker">
					</div>
					<div class="col-md-12 ">
						<button type="button" class="fontclr btnpad border_radius mtopbottom20 storetrial">SUBMIT</button>
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
	$('#datetimepicker1').datetimepicker({
		format: 'MM/DD/YYYY',
		minDate:new Date(),
	});
	$(function () {
        $('#datetimepicker3').datetimepicker({
            format: 'LT'
        });
    });
</script>
