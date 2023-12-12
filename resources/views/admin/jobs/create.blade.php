@extends('admin.layout.master')
@section('content')

<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block"><b>New Job</b>
                        <a class="btn btn-info pull-right" href="{{ url('admin/jobs') }}"><i class="fa fa-arrow-left"></i> Back</a>
                        </h3>
                        <hr>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form class="form_inline fullwidth mtop40" method="POST"  enctype="multipart/form-data" action="{{route('store.jobs')}}">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                                <div class="col-md-8">
                                    <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" >

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
                                    <textarea id="description" name="description" style="width: 100%;">{{ old('description') }}</textarea>

                                    @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="tags" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
                                <div class="col-md-8">
                                    <select name="category" class="form-control" required="">
                                       <option value="">Please Select</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ (collect(old('Category'))->contains($category->category_name )) ? 'selected':'' }} >{{  $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                          <div class="form-group">
                            <div class="row">
                                <label for="tags" class="col-md-4 col-form-label text-md-right">{{ __('Tags') }}</label>
                                <div class="col-md-8">
                                    <select name="tags[]" class="form-control searchdropdown" multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->title }}" {{ (collect(old('tags'))->contains($tag->title)) ? 'selected':'' }} >{{ $tag->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="company_name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>
                                <div class="col-md-8">
                                    <input id="company_name" type="text" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="{{ old('company_name') }}" >

                                    @if ($errors->has('company_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>
                                <div class="col-md-8">
                                    <input id="location" type="text" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" name="location" value="{{ old('location') }}" >

                                    @if ($errors->has('location'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="job_type" class="col-md-4 col-form-label text-md-right">{{ __('Position') }}</label>
                                <div class="col-md-8">
                                    <input id="job_type" type="text" class="form-control{{ $errors->has('job_type') ? ' is-invalid' : '' }}" name="job_type" value="{{ old('job_type') }}" >

                                    @if ($errors->has('job_type'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('job_type') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="salary" class="col-md-4 col-form-label text-md-right">{{ __('Salary') }}</label>
                                <div class="col-md-8">
                                    <input id="salary" type="text" class="form-control{{ $errors->has('salary') ? ' is-invalid' : '' }}" name="salary" value="{{ old('salary') }}" >

                                    @if ($errors->has('salary'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('salary') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="salary" class="col-md-4 col-form-label text-md-right">{{ __('Upload image') }}</label>
                                <div class="col-md-8">
                                    <input id="image" style=" position: relative; bottom: 25px;     margin-bottom: -26px;" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" value="" >

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
                                <label for="salary_type" class="col-md-4 col-form-label text-md-right">{{ __('Pay Period') }}</label>
                                <div class="col-md-8">
                                    <select class="form-control" id="salary_type" name="salary_type" required="">
                                        <option value="">Please Select</option>
                                        <option value="daily"       {{ old('salary_type')=='daily'?'selected="selected"':'' }}>Daily</option>
                                        <option value="weekly"      {{ old('salary_type')=='weekly'?'selected="selected"':'' }}>Weekly</option>
                                        <option value="monthly"     {{ old('salary_type')=='monthly'?'selected="selected"':'' }}>Monthly</option>
                                        <option value="commission"  {{ old('salary_type')=='commission'?'selected="selected"':'' }}>Commission</option>
                                    </select>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    CKEDITOR.replace('description');
</script>
<script>
    $(document).ready(function() {
        $('.searchdropdown').select2({
            placeholder: 'select tags',
          multiple: true
        });
    });
</script>
@endsection