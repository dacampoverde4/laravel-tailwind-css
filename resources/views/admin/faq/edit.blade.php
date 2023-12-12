@extends('layouts.master')
@section('main-content')
<div class="maincontent">
	<div class="content bgwhite">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="padding40">
					<div class="card-header">
						<h3 class="inline_block"><b>Update FAQ</b></h3>
						<a class="btn btn-primary pull-right" href="{{ route('faq.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
					</div>
					<hr>
					@if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
					<form class="form_inline fullwidth mtop40" method="POST" action="{{route('faq.update', $faq->id)}}">
						@csrf
					
						<div class="form-group">
							<div class="row">
							 <label for="add_categories" class="col-md-4 col-form-label text-md-right">{{ __('Add Categories') }}</label>
 
							 <div class="col-md-8">
						<select name="category"  class="form-control" id="add_categories">
						<option value="My Account" <?php if ($faq->category == 'My Account') echo ' selected="selected"'; ?>>My Account</option>
						<option value="Getting Started" <?php if ($faq->category == 'Getting Started') echo ' selected="selected"'; ?>> Getting Started</option>
						<option value="Billing & Payments" <?php if ($faq->category == 'Billing & Payments') echo ' selected="selected"'; ?>> Billing & Payments</option>
						<option value="In-World" <?php if ($faq->category == 'In-World') echo ' selected="selected"'; ?>>In-World</option>
						<option value="Copyright & Legal" <?php if ($faq->category == 'Copyright & Legal') echo ' selected="selected"'; ?>>Copyright & Legal</option>
						<option value="Advertising" <?php if ($faq->category == 'Advertising') echo ' selected="selected"'; ?>>Advertising</option>
							 
						</select>
						   @if ($errors->has('add_categories'))
						   <span class="invalid-feedback">
							   <strong>{{ $errors->first('add_categories') }}</strong>
						   </span>
						   @endif
					   </div>




						<div class="form-group">
                           <div class="row">
                            <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Question') }}</label>

                            <div class="col-md-8">
								<textarea class="form-control" name="question" rows="3" cols="80" id="question">{{ $faq->question }}</textarea>
								@if ($errors->has('question'))
								<span class="invalid-feedback">
									<strong>{{ $errors->first('question') }}</strong>
								</span>
								@endif
                            </div>
                            </div>
							<hr>
							<div class="row">
                             <label for="answer" class="col-md-4 col-form-label text-md-right">{{ __('Answer') }}</label>

                             <div class="col-md-8">
                                 <textarea class="form-control" name="answer" rows="8" cols="80" id="answer">{{ $faq->answer }}</textarea>
                                 @if ($errors->has('answer'))
                                 <span class="invalid-feedback">
                                     <strong>{{ $errors->first('answer') }}</strong>
                                 </span>
                                 @endif
                             </div>
                             </div>
                        </div>

						<div class="form-group">
						    <div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-9"><button type="submit" class="btnpad btnred pull-right border_radius">Submit</button></div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
