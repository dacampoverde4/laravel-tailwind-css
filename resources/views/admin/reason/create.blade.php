@extends('admin.layout.master')
@section('content')
<div class="row">
	<!-- Column -->
	<div class="col-lg-12 col-xlg-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-12">
						<h3 class="inline_block"><b>Create Reason</b>
						<a class="btn btn-primary pull-right" href="{{ url('admin/reasons') }}"><i class="fa fa-arrow-left"></i> Back</a>
						</h3>
						<hr>
					@if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
					<form class="form_inline fullwidth mtop40" method="POST" action="{{route('store.reason')}}">
					    @csrf
						<div class="form-group">
                           <div class="row">
                            <label for="Title" class="col-md-4 col-form-label text-md-right">{{ __('Reason') }}</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="" >

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