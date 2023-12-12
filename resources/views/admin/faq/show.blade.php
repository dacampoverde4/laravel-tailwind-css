@extends('layouts.master')
@section('main-content')
<div class="maincontent">
	<div class="content bgwhite">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="padding40">
					<div class="card-header">
						<h3 class="inline_block"><b>Show Faq</b></h3>
						<a class="btn btn-primary pull-right" href="{{ route('faq.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
					</div>
					<hr>
					@if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
					<form class="form_inline fullwidth mtop40" method="POST" action="{{ url('#') }}">
					    @csrf
						<div class="form-group">
                           <div class="row">
                            <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Question') }}</label>

                            <div class="col-md-8">
								<span>{{ $faq->question }}</span>
                            </div>

                            </div>
							<hr>
                            <div class="row">
                             <label for="answer" class="col-md-4 col-form-label text-md-right">{{ __('Answer') }}</label>

                             <div class="col-md-8">
								 <span>{{ $faq->answer }}</span>
                             </div>

                             </div>
                        </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
