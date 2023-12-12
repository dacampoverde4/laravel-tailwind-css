@extends('admin.layout.master')
@section('content')
<div class="maincontent">
<style>
img.blog_img.img-circle {
    width: 40px;
    height: 40px;
    /* padding-top: 0; */
    margin-top: 1rem;
}

</style>
	<div class="content bgwhite">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="form_common padding40">
						 <h4 class="inline_block font22"><b class="vertical_align"><img src="{{ asset('backend/images/create_user.png') }}" alt="Token" title="Token">UPDATE BLOG</b>
						<a class="btn btnred btn-info pull-right" href="{{ url('admin/blogs') }}"><i class="fa fa-arrow-left"></i> Back</a></h4>
					
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
					<form class="form_inline fullwidth mtop40" method="POST" action="{{route('blog.update' , $blog->id)}} " enctype="multipart/form-data" >
					    @csrf
						<div class="form-group">
                           <div class="row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$blog->title}}">

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
                                <textarea id="displayname" class="form-control{{$errors->has('description') ? ' is-invalid' : '' }}" name="description">{{$blog->description}}</textarea>
                                @if ($errors->has('displayname'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('displayname') }}</strong>
                                </span>
                                @endif
                            </div>
                            </div>
                        </div>
					<!-- 	<div class="form-group">
                           <div class="row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Bloggers') }}</label>

                            <div class="col-md-8">
                             
								
								<select class="form-control" id="user_type" name="blogger_id" required="required" >
									
                        			@if(!empty($staff)  )    
										<option value="" >Please Select Blogger</option>
                            			@foreach( $staff as $row )
                            			    @if ($loop->first)
                                			    <script type="text/javascript">
                                                    getGoup({{ $row->id }});
                                                </script>
                            			    @endif
											 @if($blog->bloger_id ==  $row->id )
                            			    <option value="{{ $row->id }}" selected>{{ $row->name }}</option>
										@else
											<option value="{{ $row->id }}" >{{ $row->name }}</option>
											@endif
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
                                 
									   <select name="category_id"  class="form-control" required="">
									   <option value="">Please Select Category</option>
                                        @foreach($blogbategory as $category)
										@if($category->id == $blog->category_id)
											  <option value="{{ $category->id }}" selected> 
										  {{  $category->category_name }}</option>
										  @else
                                            <option value="{{ $category->id }}" {{ (collect(old('Category'))->contains($category->category_name )) ? 'selected':'' }} >{{  $category->category_name }}</option>
										@endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            </div>
						
                        	<div class="form-group">
                            <div class="row">
                                <label for="salary" class="col-md-4 col-form-label text-md-right">{{ __('Upload images') }}</label>
                                <div class="col-md-8">
                                   <br> <input id="image" style=" position: relative; bottom: 25px;     margin-bottom: -26px;" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image[]" multiple>
            	                   @foreach(json_decode($blog->image) as $img)
            						<img  class="blog_img img-circle" src="{{ asset('/uploads/'.$img)}}" title="blog">
							        @endforeach
                                    @if ($errors->has('image'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                        </div>

                            <div class="form-group">
                            <div class="row">
                                <label for="salary" class="col-md-4 col-form-label text-md-right">{{ __('Upload Video') }}</label>
                                <div class="col-md-8">
                                   <br> <input id="image" style=" position: relative; bottom: 25px;     margin-bottom: -26px;" type="file" class="form-control{{ $errors->has('video') ? ' is-invalid' : '' }}" name="video">
                                     <video width="100" height="100" controls>
                                          <source src="{{ asset('/uploads/'.$blog->video)}}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    @if ($errors->has('video'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('video') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                           <div class="row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('URL') }}</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control{{ $errors->has('URL') ? ' is-invalid' : '' }}" name="url" value="{{$blog->URL}}">

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
						<div class="col-md-9"><button type="submit" class="btn btn-success pull-right border_radius"><i class="fa fa-check"></i> Update</button></div>
						</div>
					</form>
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
            placeholder: 'Select Groups',
          multiple: true
        });
    });
</script>

@endsection