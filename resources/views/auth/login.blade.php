@extends('v7.frontend')
@section('page_level_styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/font-awesome/css/font-awesome.min.css') }}">
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

    @yield('page_level_styles')

    <style>
    .card-body {
        padding: 36px 50px;
    }

    .card {
        border: 1px solid #ccc;
        display: block;
        margin: 150px auto;
        max-width: 700px;
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
    button.btnpad.btnred.border0.sb_btn {
        background: linear-gradient(135deg, #3b5998 0%, #3d5ea4 100%) !important;
    }
    </style>
    @stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="card login_sec_mob">
                <div class="card-header">{{ __('Login') }}
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                    @endif
                    </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="well">
                            Please login using your Second Life legacy name.<br>
                            This is not your display name, and both first and last names are required.<br>
                            Acceptable examples: <b class="text-success">John Resident</b><b>,</b> <b class="text-success">John.Resident</b>
                        </div>

                        <div class="form-group row mb">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Second Life legacy name') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row text-center">
                               <div class="col-md-7 pull-right">
                                   <a class="btn btn-link forget_pass_btn" href="https://maps.secondlife.com/secondlife/AvDopt/209/124/37">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                    <button type="submit" class="btnpad btnred border0 sb_btn log_sb_btn">
                                    {{ __('Login') }}
                                </button>

                               </div>


                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>
@endsection
