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
    
    background: linear-gradient(135deg, #6B02FF 0%, #985BEF 100%);
    
    color: #fff;
    font-size: 22px;
    font-weight: bold;
    padding: 18px 22px;
    text-align: center;
    text-transform: uppercase;
    }
    </style>
    @stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Security Pin') }}       @if (session('status'))
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
                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf
                        
                        <div class="form-group row">

                            <label for="pin" class="col-sm-4 col-form-label text-md-right">{{ __('Enter Security Pin') }}</label>

                            <div class="col-md-6">
                                <input id="pin" type="text" class="form-control{{ $errors->has('pin') ? ' is-invalid' : '' }}" name="pin"  placeholder="Enter 4-digit Pin For security" value="{{ old('pin') }}" required autofocus>

                                @if ($errors->has('pin'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('pin') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection