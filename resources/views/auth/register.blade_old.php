@extends('layouts.frontend')

@section('content')

<div class="container">
    <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    <p style="text-align: center;margin: 0 0 20px">{{ @$metaData['token_reg_text_form_heading'] }}</p>
                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!--div class="form-group row mb">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Display Name') }}</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required >
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div-->

                        <div class="form-group row mb">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}
                                <small style="width: 100%;float: left;">
                                    {{ @$metaData['token_reg_text_first_name'] }}
                                </small>
                            </label>

                            <div class="col-md-8">
                                <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="fullname" value="{{ old('name') }}" required >

                                @if ($errors->has('firstname'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('firstname') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}
                                <small style="width: 100%;float: left;">
                                    {{ @$metaData['token_reg_text_last_name'] }}
                                </small>
                            </label>

                            <div class="col-md-8">
                                <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('name') }}" required >

                                @if ($errors->has('lastname'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}
                                <small style="width: 100%;float: left;">
                                    {{ @$metaData['token_reg_text_email'] }}
                                </small>
                            </label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                       <div class="form-group row mb">
                        	<label for="user_group" class="col-md-4 col-form-label text-md-right">User Group
                                <small style="width: 100%;float: left;">
                                    {{ @$metaData['token_reg_text_usergroup'] }}
                                </small>
                            </label>
                        	<div class="col-md-8">
                        		<select class="form-control changeUserGroup" id="user_group" onchange="getGoup(this.value)" name="user_group" required="required" >
                        			@if( $usergroups )    
                            			@foreach( $usergroups as $row )
                            			    @if ($loop->first)
                            			        <script type="text/javascript">
                                                    getGoup(<?php echo $row->id ?>)
                                                </script>
                            			    @endif
                            			    <option value="{{ $row->id }}"><?php echo $row->title ?></option>
                            			@endforeach
                        			@endif
                        		</select>
                        	</div>
                        </div>

                        <div class="form-group row mb">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">Gender
                                <small style="width: 100%;float: left;">
                                    {{ @$metaData['token_reg_text_gender'] }}
                                </small>
                            </label>
                            
                            <div class="col-md-8" id="genderInfodisplay">
                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb">
                            <label for="species_id" class="col-md-4 col-form-label text-md-right">Species
                                <small style="width: 100%;float: left;">
                                    {{ @$metaData['token_reg_text_species'] }}
                                </small>
                            </label>
                            <div class="col-md-8">
                                <select class="form-control" id="species_id" name="species_id" >
                                    <option value="">Please select</option>
                                    @if( $species )
                                        @foreach( $species as $row )
                                            <option value="{{ $row->id }}"><?php echo $row->name ?></option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}
                                <small style="width: 100%;float: left;">
                                    {{ @$metaData['token_reg_text_password'] }}
                                </small>
                            </label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}
                                <small style="width: 100%;float: left;">
                                    {{ @$metaData['token_reg_text_confirm_password'] }}
                                </small>
                            </label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-3 col-md-offset-9 pull-right">
                                <button type="submit" class="btnpad  border0">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>
<style>
div#genderInfodisplay input
{
    width: 14px;
    margin-left: 20px;
    position: relative;
}
div#genderInfodisplay input:first-child {
    margin-left: 0;
}
div#genderInfodisplay input:checked::before {
    content: "";
    height: 5px;
    width: 5px;
    background: #ffffff;
    position: absolute;
    left: 4px;
    z-index: 9999;
    top: 3px;
    border-radius: 10px;
}
div#genderInfodisplay input:checked::after {
    content: "";
    height: 11px;
    width: 11px;
    background: #0095ff;
    position: absolute;
    border-radius: 50%;
    right: 2px;
    top: 0px;
}
</style>
@endsection

