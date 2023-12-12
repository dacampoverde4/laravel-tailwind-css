@extends('admin.layout.master')
@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
<style type="text/css">
	.multiple_usr_checkboxes_sec [type=checkbox]:checked, [type=checkbox]:not(:checked) {
	    left: 15px !important;
	    opacity: 1 !important;
	    margin-top: 5px;
	}
	.multiple_usr_checkboxes_sec .btn-group label {
	    color: #000000!important;
	}
	.multiple_usr_checkboxes_sec button.multiselect.dropdown-toggle.btn.btn-default {
	    border: 1px solid #dfdfdf;
	}
	.multiple_usr_checkboxes_sec .checkbox_usr_div .dropdown-menu {
	    min-width: 14rem !important;
	}
	.checkbox_usr_div {
	    display: inline-block;
	}
	.multiple_usr_checkboxes_sec ul {
		max-height: 240px !important;
	    overflow-y: auto !important;
	    overflow-x: hidden !important;
	}
	.form_lbl {
	    display: inline;
	}
	.alert-error {
		border: 1px solid #fecdcd !important;
		background-color: #fff8f8;
	}
	.alert-success {
		border: 1px solid #155724 !important;
		background-color: #ebffeb;
	}
</style>
@yield('head')

@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22">
                        <b class="vertical_align"><i class="fa fa-envelope"></i> Send Message</b>                          
                        </h3>
                        <hr>
                        <div class="announcement_box paddingtb20">
                            @if(session()->has('success'))
                            <div class="">
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            </div>
                            @endif

                            @if(session()->has('error'))
                            <div class="">
                                <div class="alert alert-error">
                                    {{ session()->get('error') }}
                                </div>
                            </div>
                            @endif
                            

                            <div class="container-fluid">
                            	<form class="form_inline fullwidth mtop40" method="POST" action="{{route('users.storemsgusers')}}" >
                       				@csrf

                       				<div class="row"> 
                       					<div class="col-md-4">
                       						<div class="form_lbl">
			                            		<strong>Select User Group:</strong>
			                            	</div>
                       					</div>                           		
		                            	<div class="col-md-8 form-group multiple_usr_checkboxes_sec">
											<div class="">
												<select class="form-control changeUserGroup selectUser" id="group"  name="groups">
													<option>Select groups</option>
													<option value="1">Incomplete Members</option>
													 <option value="2">New Members</option> 
													 <option value="3">Subscribe Members</option>     
												</select>

											</div>
										</div>
									</div>



                       					<div class="row"> 
                       						<div class="col-md-4">
                       							<div class="form_lbl">
			                            			<strong>Select User to send message:</strong>
			                            		</div>
                       						</div>                           		
		                            		<div class="col-md-8 form-group multiple_usr_checkboxes_sec">
												<div class="checkbox_usr_div">
													<select id="multiple_usr_checkboxes" name="multiple_usr_checkboxes[]" multiple="multiple" class="userSelect">
													  @foreach($users as $user)
													    	@if($user->displayname)
													        	<option value="{{ $user->id }}">{{ $user->displayname }}</option>
													        @else

													        	<option value=""></option>

													        @endif
													    @endforeach
													</select>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-4">
												<div class="form_lbl">
													<strong>Enter Message:</strong>
												</div>
											</div> 
											<div class="col-md-8 form-group">
												<textarea id="description"
                                                  class="form-control {{ $errors->has('user_message') ? ' is-invalid' : '' }}"
                                                  name="user_message" value="">{{ old('user_message') }}</textarea>
											</div>
										</div> 

										<div class="row">
											<div class="col-md-4"></div>
											<div class="col-md-8">
												<button type="submit" class="btn btn-success border_radius"><i class="fa fa-check"></i> Submit</button>
											</div>
										</div>                       	
									</div>
			                       
								</form>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

<script type="text/javascript">
	CKEDITOR.replace('description');
    $(document).ready(function() {
        $('#multiple_usr_checkboxes').multiselect({
        	includeSelectAllOption : true,
			nonSelectedText: 'Select an User'
        });

       $('.selectUser').on('change',function(){
       		var IncompleteUser = $(this).val();

       		$.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });


       		$.ajax({
       			url: "{{ route('getUsers') }}",
               	type: 'post',

                data: {
                    'incomplete': IncompleteUser,
                    
                  },
                  success: function(result){

                  	$('#multiple_usr_checkboxes').empty();
                  	var data = JSON.parse(result);

                  	$.each(data, function(index, value) {
					  	
					  $('#multiple_usr_checkboxes').append('<option value="' + value + '">' + index + '</option>');
					   $('#multiple_usr_checkboxes').multiselect('rebuild');
					  
					});
                  		
                   
                 }
       		});
       });
        

    });
       
</script>

@endsection
