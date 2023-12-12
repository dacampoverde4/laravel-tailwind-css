@extends('admin.layout.master')
@section('content')
<div class="maincontent">
	<div class="content bgwhite">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="form_common padding40">
				
						 <h4 class="inline_block font22"><b>Update Category</b>
						<a class="btn btn-info pull-right" href="{{ url('admin/blogs/categories') }}"><i class="fa fa-arrow-left"></i> Back</a></h4>
				
					<hr>
					@if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form class="form_inline fullwidth mtop40" method="POST" action="{{route('categoriesupdate.blogs', $cate->id)}}">
					    @csrf 
						<div class="form-group">
                            <div class="row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                                <div class="col-md-8">
                                    <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="name" value="{{ $cate->category_name }}" required>

                                    @if ($errors->has('category_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('category_name') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                        </div>
                       
                       
						<div class="form-group">
						    <div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-9"><button type="submit" class="btn btn-success pull-right border_radius"><i class="fa fa-check"></i> Update</button></div>
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