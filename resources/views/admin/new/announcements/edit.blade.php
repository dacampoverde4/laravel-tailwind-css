@extends('admin.New.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block"><b class="vertical_align">Edit Announcement</b>
						<a class="btn btn-info pull-right" href="{{ url('admin/announcements') }}"><i class="fa fa-arrow-left"></i> Back</a>
						</h3>
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
	                    <form class="form_inline fullwidth mtop40" method="POST" action="{{route('announcement.update',$announcement->id)}}">
					    @csrf
						<div class="form-group">
                           <div class="row">
                            <label for="content" class="col-md-2 col-form-label text-md-right">{{ __('content') }}</label>

                            <div class="col-md-10">
                                <textarea id="content" type="text" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" value="" required >{{ $announcement->content }} </textarea>
                                @if ($errors->has('warning_text'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('warning_text') }}</strong>
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