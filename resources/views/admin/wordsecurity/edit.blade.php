@extends('admin.layout.master')
@section('content')
<div class="row">
	<!-- Column -->
	<div class="col-lg-12 col-xlg-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-12">
						<h3 class="inline_block"><b>Create Word</b>
						<a class="btn btn-primary pull-right" href="{{route('edit.word',$word->id)}}"><i class="fa fa-arrow-left"></i> Back</a>
						</h3>
						<hr>
						@if (session('success'))
	                        <div class="alert alert-success">
	                            {{ session('success') }}
	                        </div>
	                    @endif
						<form class="form_inline fullwidth mtop40" method="POST" action="{{route('update.word',$word->id)}}">
						    @csrf
							<div class="form-group">
	                           <div class="row">
	                            <label for="Title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

	                            <div class="col-md-8">
	                                <input id="title" type="text" class="form-control" name="title" value="{{ @$word->title }}">

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