@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block"><b>Edit Category</b>
                        <a class="btn btn-info pull-right" href="{{ url('admin/events/category/all') }}"><i class="fa fa-arrow-left"></i> Back</a>
                        </h3>
                        <hr>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form class="form_inline fullwidth mtop40" method="POST" action="{{route('event.category.update', $category->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                           <div class="row">
                            <label for="Title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-8">
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ @$category->term_name }}" required >

                                @if ($errors->has('title'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                            </div>
                        </div>

                        <div class="form-group">
                           <div class="row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-8">
                                <textarea id="description" class="{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" style="width:100%">{{ @$category->term_description }}</textarea>

                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                           <div class="row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-8">
                                <input type="file" name="file" onchange="readURL(this);" />
                                    @if($category->term_image)
                                        <img id="blah" src="/images/events/{{ $category->term_image }}" alt="cat-image" />
                                    @else
                                        <img id="blah" src="http://placehold.it/180" alt="cat-image" />
                                    @endif
                                
                            </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9"><button type="submit" class="btn btn-success pull-right border_radius">Submit</button></div>
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
<script>
    
function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    
</script>
@endsection