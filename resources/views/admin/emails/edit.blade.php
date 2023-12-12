@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                    	<h3 class="inline_block"><b>Edit Email Template</b>
                        <a class="btn btn-info pull-right" href="{{ url('admin/emails') }}"><i class="fa fa-arrow-left"></i> Back</a>
                    	</h3>
                        <hr>
						@if (session('success'))
	                        <div class="alert alert-success">
	                            {{ session('success') }}
	                        </div>
	                    @endif
						<form class="form_inline fullwidth mtop40" method="POST" action="{{route('update.email.notify', $email->id)}}">
						    @csrf
							<div class="form-group">
	                           <div class="row">
							   <label for="subject" class="col-md-3 col-form-label text-md-right">{{ __('Title or Subject') }}</label>
	                            <div class="col-md-9">
	                                <input id="subject" type="text" class="form-control" name="subject" value="{{ @$email->subject }}">

	                                @if ($errors->has('subject'))
	                                <span class="invalid-feedback">
	                                    <strong>{{ $errors->first('subject') }}</strong>
	                                </span>
	                                @endif
	                            </div>
	                            </div>
	                        </div>
							<div class="form-group">
	                            <div class="row">
									<label for="content" class="col-md-3 col-form-label text-md-right">{{ __('Email Text') }}</label>
									<div class="col-md-9">
										<textarea id="content" type="text" class="summernote" name="content" value="" style="width: 100%;">{{ $content }}</textarea>

										@if ($errors->has('content'))
										<span class="invalid-feedback">
											<strong>{{ $errors->first('content') }}</strong>
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
</div>
@endsection
@section('page_js')

<!-- add summernote -->
<link href="https://summernote.org/vendors/summernote/dist/summernote.css" rel="stylesheet">
<script src="https://summernote.org/vendors/summernote/dist/summernote.js"></script>
<script src="https://summernote.org/vendors/summernote/lang/summernote-ko-KR.js"></script>
<script>
$('.summernote').summernote({
  height: 150,   //set editable area's height
  codemirror: { // codemirror options
    theme: 'monokai'
  }
});
</script>
@endsection