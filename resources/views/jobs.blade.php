@extends('v7.frontend')

@section('page_level_styles')

	<script type="text/javascript">
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'url' => url('/'),
        ]); ?>
    </script>
	
           @yield('head') 
   
    
    <!-- BEGIN PAGE LEVEL STYLES -->
    @yield('page_level_styles')
<style>
p.instruction_sec {
   
    font-size: 12px;
}
img.staff_sec {
    height: 147px;
}
label {
    
    float: left;
    width: 100%;
    padding: 5px;
}
img.img_sec {
    width: 200px !important;
    height: 145px !important;
}
.page-wrapper {
    background: #eef5f9;
    padding-bottom: 60px;
    padding-top: 65px;
}
.crd_img img {
    height: auto;
    width: 100%;
    max-width: 457px;
}
html body .text-themecolor {
    color: #1976d2;
}
html body .m-b-20 {
    margin-bottom: 20px;
}

.btn-success, .btn-success.disabled {
    background: #26dad2;
    border: 1px solid #26dad2;
    -webkit-box-shadow: 0 2px 2px 0 rgba(40, 190, 189, 0.14), 0 3px 1px -2px rgba(40, 190, 189, 0.2), 0 1px 5px 0 rgba(40, 190, 189, 0.12);
    box-shadow: 0 2px 2px 0 rgba(40, 190, 189, 0.14), 0 3px 1px -2px rgba(40, 190, 189, 0.2), 0 1px 5px 0 rgba(40, 190, 189, 0.12);
    -webkit-transition: 0.2s ease-in;
    -o-transition: 0.2s ease-in;
    transition: 0.2s ease-in;
}
.btn {
    padding: 7px 12px;
    cursor: pointer;
}
.btn-success {
    color: #fff;
    background-color: #28a745;
    border-color: #28a745;
}

.card-no-border .card {
    border: 0px;
    border-radius: 4px;
    -webkit-box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05);
    box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05);
}

.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: .25rem;
}
.card {
    margin-bottom: 30px;
}

.card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem;
}

.flex-row {
    -ms-flex-direction: row!important;
    flex-direction: row!important;
}

.d-flex {
    display: -ms-flexbox!important;
    display: flex!important;
}

html body .m-b-5 {
    margin-bottom: 5px;
}

html body .m-t-10 {
    margin-top: 10px;
}
.img-circle {
    border-radius: 100%;
}


body {
    background: #fff;
    font-family: "Poppins", sans-serif;
    margin: 0;
    overflow-x: hidden;
    color: #67757c;
    font-weight: 300;
}

.top_img {
    text-align: center;
}

.Text_center {
    text-align: center;
    margin-bottom: 2rem;
}
.ul_left ul {
    margin: 0;
    padding: 0;
}
.ul_left ul li {
    list-style-type: none;
    padding: 10px 0;
}
.cntr_sec {
    padding: 2rem 0;
    background: #eef5f9;
    margin: 0rem 0;
}
.page-wrapper.wrp_clr_chng {
    background: #fff;
}

.ul_left ul h1 {
    font-size: 29px;
    font-weight: 600;
}
.crd_heading h5 {
    font-weight: 600;
    font-size: 20px;
}

.Text_center {
    border-bottom: 1px solid #ece9e9;
}
.crd_img {
    border: 1px solid #ece9e9;
    padding: 5px;
}
.crd_btn {
    float: right;
}
.crd_btn a {
    padding: 3px 37px;
    font-weight: 600;
    color: #000;
}


.Text_centers {
    text-align: center;
    margin-top: 2rem;
}
.Text_centers a {
    color: #000;
}
.ul_left ul li:before {
    content: "\e649";
    font-family: themify;
    font-size: 11px;
    font-weight: 600;
    color: #000;
	padding-right: .5rem;
}
.d-flex.crd_lft {
    float: left;
}
.sec_img img {
    max-width: 40px;
}
.sec_img {
    margin-right: 10px;
}
.Text_center span {
    color: #26dad2;
}
.Text_center h3 {
    font-weight: 600;
}
.comment-text {
    padding-left: 20px;
    width: 100%;
}
input.radio_sec {
    position: absolute;
    left: 0px;
}
button#form_send {
    margin-top: 5rem;
}
</style>

@section('content')
 <div id="main-wrapper ">
<div class="page-wrapper wrp_clr_chng">
           @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
            <div class="container-fluid">
            <div class=" page-title ">
                <div class="Text_center">
                    <h3 >MEET THE <span class="text-themecolor">"A"</span> TEAM</h3>
                </div>
				
				<div class="row">
				@if($staff )
					@foreach($staff as $_staff)
			
				 <div class="col-lg-2 col-xlg-3 col-md-2">
				 <div class="top_img">
				 @if(!empty( $_staff->profile_pic))
				  <img class="staff_sec" src="  {{ ( $_staff->profile_pic )? url('/uploads').'/'.$_staff->profile_pic : url('/images/default.png')}}" width="150">
						   @else
                              <img src="{{ asset('frontend/images/5.jpg') }}" width="150">
				 
         @endif
                </div>
                </div>
                	@endforeach
					@endif
				
				
                </div>
				<div class="Text_centers">
                    <p>Our employees represent the dynamics of what our company stands for. AvDopt is an Equal Opportunity <br> Workforce, and we are committed to compensating our employees for the hard work they do. </p>
                </div>
				<div class="Text_centers">
                   <a href="{{url('/team')}}" class="btn btn-success m-b-20 ">View Team</a>
                </div>
                </div>
               
            </div>
          
            <div class="cntr_sec">
            <div class="container">
                
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-xlg-3 col-md-3">
                        <div class="card">
                            <div class="card-body">
                            <div class="ul_left">
							<ul>
							<h1>Positions </h1>
							@if(!empty($Category))
								@foreach($Category as $cate)
							<li><a href="{{ route('jobPages', $cate->id)}}">{{$cate->category_name}} ({{$cate->count}})</a></li>
							
							@endforeach
							@endif
							
							</ul>
                           
                            </div>
                            </div>
                           
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
					  <div class="col-lg-9 col-xlg-9 col-md-9">
					@if(!empty($jobs ))
					 @foreach($jobs as $job)
					
                        <div class="card">
                             <div class="card-body">
                           <div class="d-flex flex-row comment-row">
                                    <div class="crd_img">
									@if(!empty($job->image))
										<img  src="{{ ( $job->image )? url('/uploads').'/'.$job->image : url('/images/default.png')}}"  class="img_sec"  >
									@else	
										<img src="	{{ asset('/images/staff.jpg')}}"  class="img_sec" > 
									@endif
									 
									</div>
									
									
                                    <div class="comment-text w-100">
                  
                                    	
									<div class="crd_btn">
                                        <a href="#" class="btn btn-success m-b-20"  data-toggle="modal" data-target="#info_{{$job->id}}">Info</a>
										<a href="#" class="btn btn-success m-b-20 "  data-toggle="modal" data-target="#view_{{$job->id}}" >Apply</a>
										</div>
									
										<div class="crd_heading">
											<h5>{{ $job->title }}</h5>
											<p>{{ $job->location }}</p>
											  <p class="m-b-5 m-t-10">	
										 {{substr($job->description,0 ,300)}}	</p>
										</div>
									
                                    </div>
                                </div>
                      
								</div>    
                        </div>
							
							
							 
					  <!-- Modal -->
						<div class="modal fade" id="view_{{$job->id}}" role="dialog">
							<div class="modal-dialog">

							<!-- Modal content-->
								<div class="modal-content">

								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Apply</h4>
								</div>
								<div class="modal-body">
								<p></p>
        <form  action="{{ route('userapply.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
		
				@foreach($form   as $input)
				
				   @if($input->category_id == $job->category)
						@php 
						$form_option = DB::table('form_options')->where('field_id', '=',$input->id)->get();
						@endphp
					  <label for="{{$input->label}}"> {{$input->label}}</label>
				
				  
				  
					 @if($input->type =='select')
					<div class="form-row">
						<div class="form-group col-md-12">
						<select name="{{$input->name}}"  class="form-control select">						
						@foreach($form_option as $option)

						<option value="{{$option->label}}">{{$option->label}}</option>
						@endforeach
						</select>
							<p class="instruction_sec"><i>{{$input->instruction}}</i></p>
						</div>
					</div>
					 @elseif($input->type =='checkbox')
					 @foreach($form_option as $option)
						<div class="form-row">
						<div class="form-group col-md-3">
						{{$option->label}}<input type="{{$input->type}}" name="{{$input->name}}" class="radio_sec"  value="{{$option->label}}" placeholder="{{$input->label}}">
						
						</div>
						</div>
					 @endforeach
					 <p class="instruction_sec"><i>{{$input->instruction}}</i></p>
					@elseif($input->type =='radio')
					@foreach($form_option as $option)

						<div class="form-row">
						<div class="form-group col-md-3">
							{{$option->label}}<input type="{{$input->type}}" name="{{$input->name}}" class="radio_sec" value="{{$option->label}}" placeholder="{{$option->label}}"><br>
								
						</div>
						</div>
					@endforeach
				<p class="instruction_sec"><i>{{$input->instruction}}</i></p>
					@else
						<input type="{{$input->type}}" name="{{$input->name}}" class="form-control"  placeholder="{{$input->label}}">
					<p class="instruction_sec"><i>{{$input->instruction}}</i></p>
					@endif
					@endif
						
				@endforeach				
                  
                   
					  <input type="hidden"  name="job_id" value="{{$job->id}}">
					    <input type="hidden"  name="job_title" value="{{$job->title}}">
                </div>
             
                 @if($input->category_id == $job->category)
                <div class="form-row">
                    <div class="form-group col-md-12">
                      <button name="submit" class="btn btn-primary btnpad border0 border_radius mtop20 btn_btn" style="margin-bottom:30px" id="form_send">Send</button>
                    </div>
    
                </div>
				@else
							<h5 style="text-align:center;">Form Not Found!!</h5>
				@endif
            </form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
								</div>

							</div>
						</div>
						
						 <!-- InfoModal -->
						<div class="modal fade modelclose" id="info_{{$job->id}}"  role="dialog">
							<div class="modal-dialog">

							<!-- Modal content-->
								<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Job Information</h4>
								</div>
								<div class="modal-body">
									 <p>{{ $job->description }}</p>
									<table class="table">
									<tr><th>Location <i class="fa fa-map-marker" aria-hidden="true"></i> : </th><td><a target="_blank" class="btn btn-sm btn-primary" href="{{ $job->location }}"> Visit Location </a></td></tr>
									<tr><th>Company Name <i class="fa fa-building" aria-hidden="true"></i> : </th><td>{{ $job->company_name }}</td></tr>
									<tr><th>Job Type <i class="fa fa-briefcase" aria-hidden="true"></i> : </th><td>{{ $job->job_type }}</td></tr>
									<tr><th>Salary <i class="fa fa-money" aria-hidden="true"></i> : </th><td>{{ $job->salary }}</td></tr>
									<tr><th>Salary Type <i class="fa fa-money" aria-hidden="true"></i> : </th><td>{{ ucfirst($job->salary_type) }}</td></tr>
									@php
									if($job->tag_title){
									echo '<tr><th>Tags <i class="fa fa-tag" aria-hidden="true"></i> </th><td>'; 
									echo '<ul class="tags">';
									$tags = json_decode($job->tag_title);
									foreach($tags as $tag){
									echo '<li>'.$tag.'</li>';
									}
									echo '</ul></td></tr>';
									}
									@endphp
									</table>
									<a href="#" class="btn btn-success m-b-20 "  id="btnClosePopup"  data-toggle="modal" data-target="#view_{{$job->id}}" >Apply</a>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
								</div>

							</div>
						</div>
						<script type="text/javascript">
    $(function () {
        $("#info_{{$job->id}}").click(function () {
            $(".modelclose").modal("hide");
        });
    });
</script>
						@endforeach
						
									@endif
					                       	{{ $jobs->links() }}
					
					
						   </div>
					
                              
							  </div>
								</div>
                        </div>
                    </div>
				
					
					
					</div>

@endsection