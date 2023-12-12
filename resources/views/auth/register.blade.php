@extends('v7.frontend')
@section('page_level_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/font-awesome/css/font-awesome.min.css') }}">
    <!--<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">-->
    <!--<link href="https://fonts.googleapis.com/css?family=Bubblegum+Sans|Delius" rel="stylesheet">-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/isotope.pkgd.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('frontend/js/custom.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/notify.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/common.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'url' => url('/'),
        ]); ?>
    </script>

    <!-- BEGIN PAGE LEVEL STYLES -->
    @yield('page_level_styles')

    <style>
    .card-body {
        padding: 36px 50px 0;
    }
    .card-header {
        background: linear-gradient(135deg, #3b5998 0%, #3d5ea4 100%);
        color: #fff;
        font-size: 22px;
        font-weight: bold;
        padding: 18px 22px;
        text-align: center;
        text-transform: uppercase;
    }
    .card {
        border: 1px solid #ccc;
        display: block;
        margin: 100px auto;
        max-width: 85%;
    }
    .reg_form_pg button.btnpad.btnred.border0.sb_btn {
       background: linear-gradient(135deg, #3b5998 0%, #3d5ea4 100%) !important;
    }
    .reg_btn_sb {
        float: none;
    }
    ul.registerlist li {
        list-style-type: disc;
        line-height: 35px;
    }
    ul.registerlist {
        margin-left: 16px;
        color: black;
    }
    a.reg_btn_sb {
        background: linear-gradient(135deg, #3b5998 0%, #3d5ea4 100%) !important;
        color: white;
        margin-top: 5px;
    }
    a.reg_btn_sb:hover, a.reg_btn_sb:focus {
        color: white;
    }
    .rightsec{
        visibility: visible;
        animation-delay: 0.04s;
        animation-name: fadeInRight;
        padding-left: 30px;
    }
    .leftsec{
        visibility: visible;
        animation-delay: 0.04s;
        animation-name: fadeInLeft;
    }
    @media only screen and (max-width: 991px)
    {
        .rightsec{
            padding-left: 0px;
        }
        ul.registerlist li {
            line-height: 28px;
        }
        .rightsec h3 {
            font-size: 18px;
        }
        .reg_sec_mob .card-body {
            padding: 20px 20px;
        }
    }
</style>
@stop
@section('content')
<div class="container reg_form_pg">
    <div class="row justify-content-center">
            <div class="card reg_sec_mob">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    <!-- <p style="text-align: center;margin: 0 0 20px">{{ @$metaData['token_reg_text_form_heading'] }}</p>
                    <form method="POST" action="{{ route('register') }}">
                    @csrf
                        <div class="form-group row mb">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}
                                <small style="width: 100%;float: left;">
                                    {{ @$metaData['token_reg_text_first_name'] }}
                                </small>
                            </label>

                            <div class="col-md-8">
                                <input id="firstname" type="text"
                                       class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}"
                                       name="fullname" value="{{ old('name') }}" required>

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
                                <input id="lastname" type="text"
                                       class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}"
                                       name="lastname" value="{{ old('name') }}" required>

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
                                <input id="email" type="email"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                       value="{{ old('email') }}" required>

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
                                <select class="form-control changeUserGroup" id="user_group"
                                        onchange="getGoup(this.value)" name="user_group" required="required">
                                    @if( $usergroups )
                                        @foreach( $usergroups as $row )
                                            @if ($loop->first)
                                                <script type="text/javascript">
                                                    getGoup(<?php //echo $row->id ?>)
                                                </script>
                                            @endif
                                            <option value="{{ $row->id }}"><?php //echo $row->title ?></option>
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
                                <select class="form-control" id="species_id" name="species_id">
                                    <option value="">Please select</option>
                                    @if( $species )
                                        @foreach( $species as $row )
                                            <option value="{{ $row->id }}"><?php //echo $row->name ?></option>
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
                                <input id="password" type="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb">
                            <label for="password-confirm"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}
                                <small style="width: 100%;float: left;">
                                    {{ @$metaData['token_reg_text_confirm_password'] }}
                                </small>
                            </label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required>
                            </div>
                        </div>

                        {{--policy and terms checkbox--}}
                        <div class="form-group row mb">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <input type="checkbox" required name="terms_and_policy" value="1">
                                I have read and agree to the <a href="{{route('terms')}}">Terms of Use</a> and <a
                                        href="{{route('policy')}}">Privacy
                                    Policy</a>.
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-3 col-md-offset-9 pull-right">
                                <button type="submit" class="btnpad btnred border0 sb_btn reg_btn_sb">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form> -->
                    <div class="row">
                    <div class="col-md-4">
                        <div class="leftsec wow fadeInLeft" data-wow-delay="0.04s">
                            <img src="http://laravel.avdopt.com/frontend/images/usergroup/about1.png" alt="img" class="width-100 wow fadeInUp" >
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="rightsec wow fadeInRight">
                            <h3><b>Discover a world of possibilities with AvDopt</b></h3>
                            <ul class="registerlist">
                                <li>Join an adoption community with high standards— It's FREE to join!</li>
                                <li>Expand your family by making all the right connections.</li>
                                <li>Gain access to incentive adoption tools like Match Quest, Trial Dates, Messages, Reviews, Certificates, and More.</li>
                                <li>Continue the conversation via Live Chat.</li>
                                <li>Receive professional support from our diverse staff.</li>
                            </ul>
                            <a href="https://maps.secondlife.com/secondlife/AvDopt/184/123/37" class="btn btnpad btnred border0 sb_btn reg_btn_sb">Register</a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        div#genderInfodisplay input {
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
