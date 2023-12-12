@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block"><b>New Category</b>
						<a class="btn btn-primary pull-right" href="{{ url('admin/jobs/categories') }}"><i class="fa fa-arrow-left"></i> Back</a>
						</h3>
						<hr>
						@if (session('success'))
	                        <div class="alert alert-success">
	                            {{ session('success') }}
	                        </div>
	                    @endif
	                    <form class="form_inline fullwidth mtop40" method="POST" action="{{route('storecategories.jobs')}}">
						    @csrf
							<div class="form-group">
	                            <div class="row">
	                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
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
    $(document).ready(function() {
        $('.searchdropdown').select2({
            placeholder: 'select tags',
          multiple: true
        });
    });
</script>
@endsection
