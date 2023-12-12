@extends('admin.layout.master')
@section('content')
<div class="maincontent">
	<div class="content bgwhite">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="form_common padding40">
						 <h4 class="inline_block font22"><b class="vertical_align"><img src="{{ asset('backend/images/create_user.png') }}" alt="Token" title="Token">CREATE BLOG</b>
						<a class="btn btn-info btnpad pull-right" href="{{ url('admin/blogs') }}"><i class="fa fa-arrow-left"></i> Back</a></h4>
					
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
					<form class="form_inline fullwidth mtop40" method="POST" action="{{route('blog.store')}} " enctype="multipart/form-data" >
					    @csrf
						<div class="form-group">
                           <div class="row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="">

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
                            <label for="displayname" class="col-md-4 col-form-label text-md-right">Description</label>

                            <div class="col-md-8">
                                <textarea id="description" class="form-control{{ $errors->has('displayname') ? ' is-invalid' : '' }}" name="description"></textarea>

                                @if ($errors->has('displayname'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('displayname') }}</strong>
                                </span>
                                @endif
                            </div>
                            </div>
                        </div>
						<!-- <div class="form-group">
                           <div class="row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Bloggers') }}</label>

                            <div class="col-md-8">
                                <select class="form-control" id="user_type" name="blogger_id" required="required" >
									
                        			@if(!empty($staff))    
										<option value="" >Please Select Blogger</option>
                            			@foreach( $staff as $row )
                            			    @if ($loop->first)
                                			    <script type="text/javascript">
                                                    getGoup({{ $row->id }});
                                                </script>
                            			    @endif
											 
                            			    <option value="{{ $row->id }}">{{ $row->name }}</option>
                            			@endforeach
                        			@else
											<option value="" >Empty here !!</option>
									@endif
									
                        		</select>
                            </div>
                            </div>
                        </div> -->
						<div class="form-group">
						 <div class="row">
                                <label for="tags" class="col-md-4 col-form-label text-md-right">{{ __('Blog Category') }}</label>
                                <div class="col-md-8">
                                    <select name="category_id"   class="form-control" required="">
								
									   <option value="">Please Select Category</option>
									   @if(!empty($blogbategory))
                                        @foreach($blogbategory as $category)
                                            <option value="{{ $category->id }}" {{ (collect(old('Category'))->contains($category->category_name )) ? 'selected':'' }} >{{  $category->category_name }}</option>
                                        @endforeach
										@endif
                                    </select>
                                </div>
                            </div>
                            </div>
                                  <div class="form-group">
                            <div class="row">
                                <label for="salary" class="col-md-4 col-form-label text-md-right">{{ __('Upload images') }}</label>
                                <div class="col-md-8">
                                    <br>
                                    <input id="image" style=" position: relative; bottom: 25px;     margin-bottom: -26px;" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image[]" multiple>

                                    @if ($errors->has('image'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                        </div>

                     <!--    	<div class="form-group">
                            <div class="row">
                                <label for="salary" class="col-md-4 col-form-label text-md-right">{{ __('Upload Video') }}</label>
                                <div class="col-md-8">
                                    <br>
                                    <input id="image" style=" position: relative; bottom: 25px;     margin-bottom: -26px;" type="file" class="form-control{{ $errors->has('video') ? ' is-invalid' : '' }}" name="video" >

                                    @if ($errors->has('video'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('video') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <div class="row">
                            <label for="displayname" class="col-md-4 col-form-label text-md-right">Video URL</label>

                            <div class="col-md-8">
                                <input id="url" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="url" value="">

                                @if ($errors->has('url'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('url') }}</strong>
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
<script src="{{ asset('unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('description');
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