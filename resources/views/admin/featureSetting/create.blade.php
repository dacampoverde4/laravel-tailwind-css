@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block"><b>Featur Profile Setting</b>
                        <a class="btn btn-info pull-right" href="{{ route('admin.feature.setting') }}"><i class="fa fa-arrow-left"></i> Back</a>
                        </h3>
                        <hr>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                        <form class="form_inline fullwidth mtop40" method="POST" action="{{route('admin.feature.setting.store')}}">
                            @csrf
                            <div class="form-group">
                               <div class="row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="" required >

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
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Tokens') }}</label>

                                <div class="col-md-8">
                                    <input id="tokens" type="number" class="form-control{{ $errors->has('tokens') ? ' is-invalid' : '' }}" name="tokens" value="" required >

                                    @if ($errors->has('tokens'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('tokens') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                               <div class="row">
                                <label for="Billing Interval" class="col-md-4 col-form-label text-md-right">{{ __('Billing Interval') }}</label>

                                <div class="col-md-8">
                                    <select id="interval-selector" name="billing_interval" class="form-control">
                                            @php
                                                $billings = array('day' => 'Daily', 'week' => 'Weekly', 'month' => 'Monthly', 'quarter' => 'Every 3 months', 'semiannual' => 'Every 6 months', 'year' => 'Yearly' )
                                            @endphp
                                            @foreach( $billings as $key => $billing )
                                                <option value="{{ $key }}">{{ $billing }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('billing-interval'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('billing-interval') }}</strong>
                                            </span>
                                        @endif

                                    @if ($errors->has('billing_interval'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('billing_interval') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                               <div class="row">
                                <label for="Billing Interval" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                                <div class="col-md-8">
                                    <input id="amount" type="number" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="" required >

                                    @if ($errors->has('amount'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                </div>
                            </div>
                            
                            <div class="form-group" class="form-control">
                               <div class="row">
                                <label for="Billing Interval" class="col-md-4 col-form-label text-md-right">{{ __('User group') }}</label>

                                <div class="col-md-8">
                                    <select name="user_group" class="form-control">
                                        @foreach($usergroups as $usergroup)
                                            <option value="{{ $usergroup->id }}">{{ $usergroup->title }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('user_group'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('user_group') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                </div>
                            </div>
                            <div class="form-group" class="form-control">
                               <div class="row">
                                <label for="Billing Interval" class="col-md-4 col-form-label text-md-right">{{ __('User Group Visibility') }}</label>

                                <div class="col-md-8">
                                    <select name="visibility[]" class="form-control searchdropdown" multiple>
                                        @foreach($usergroups as $usergroup)
                                            <option value="{{ $usergroup->id }}">{{ $usergroup->title }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('visibility'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('visibility') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                </div>
                            </div>
                            
                            <div class="form-group" class="form-control">
                               <div class="row">
                                <label for="Billing Interval" class="col-md-4 col-form-label text-md-right">{{ __('Info') }}</label>

                                <div class="col-md-8">
                                    <textarea id="description" name="info" class="form-control"></textarea>
                                    @if ($errors->has('info'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('info') }}</strong>
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
    CKEDITOR.replace('description');
</script>
<script>
    $(document).ready(function() {
        $('.searchdropdown').select2({
            placeholder: 'Select Visibility',
          multiple: true
        });
    });
</script>
@endsection