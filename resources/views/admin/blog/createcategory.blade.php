@extends('admin.layout.master')
@section('content')
<div class="maincontent">
	<div class="content bgwhite">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="form_common padding40">
						 <h4 class="inline_block font22"><b class="vertical_align"><img src="{{ asset('backend/images/create_user.png') }}" alt="Token" title="Token">CREATE CATEGORY</b>
						<a class="btn btn-info btnpad pull-right" href="{{ url('admin/blogs/categories') }}"><i class="fa fa-arrow-left"></i> Back</a></h4>
					
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
					<form class="form_inline fullwidth mtop40" method="POST" action="{{route('blogs.store')}}">
					    @csrf
						<div class="form-group">
                           <div class="row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required>

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
							<div class="col-md-3"></div>
							<div class="col-md-9"><button type="submit" class="btn btn-success pull-right border_radius"><i class="fa fa-check"></i> Submit</button></div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.searchdropdown').select2({
            placeholder: 'Select Categories',
          multiple: true
        });
    });
</script>
<script>
$(document).ready(function(){
    $('#user_type').on('change', function() {
      if ( this.value == '3')
      //.....................^.......
      {
        $("#showcategory").show();
      $("#designation").show();
      }
      else
      {
        $("#showcategory").hide();
    $("#designation").hide();
      }
    
    });
});
</script>
@endsection
@section('page_js')

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.searchdropdown').select2({
            placeholder: 'Select Groups',
          multiple: true
        });
    });
</script>

@endsection