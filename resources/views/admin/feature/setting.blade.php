@extends('layouts.master')
@section('main-content')
<div class="maincontent">
	<div class="content bgwhite">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="padding40">
					<div class="card-header">
						<h3 class="inline_block"><b>{{ $feature->title }}</b></h3>
						<a class="btn btn-primary pull-right" href="{{ route('index.feature') }}"><i class="fa fa-arrow-left"></i> Back</a>
					</div>
					<hr>
					@if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
					<form class="form_inline fullwidth mtop40" method="POST" action="{{ route('saveFeaturesSetting', $feature->id) }}">
					    @csrf
					    @if( $feature->id== '1' )
					        <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">Monthly Max Connections</label>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" name="websiteSettings[monthlymaxconnections]" value="{{ $metaData['monthlymaxconnections'] or '' }}" required="">
                                    </div>
                            </div>
    					    
                        @endif
                        @if( $feature->id== '3' )
                            <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">How many time user will change</label>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" name="websiteSettings[message_userchangedisplay]" value="" required="">
                                    </div>
                            </div>
                        @endif
                        @if( $feature->id== '4' )
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">No. of free profile visit</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="websiteSettings[message_freeprofilevisit]" value="" required="">
                                </div>
                            </div>
                        @endif
                        @if( $feature->id== '5' )
                            <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">How many time user change his picture</label>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" name="websiteSettings[message_changeprofilepicno]" value="" required="">
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">Time duration to change his picture</label>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" name="websiteSettings[message_changeprofiletime]" value="" required="">
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">No. of free profile visit</label>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" name="websiteSettings[message_freeprofilevisit]" value="" required="">
                                    </div>
                            </div>
                        @endif
                        @if( $feature->id== '6' )
                            <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">Number of Photos</label>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" name="websiteSettings[message_photosno]" value="" required="">
                                    </div>
                            </div>
                        @endif
  
                            <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">Required tokens</label>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" name="websiteSettings[tokens_{{$feature->id}}]" value="{{ $metaData['tokens_'.$feature->id] or '' }}" required="">
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