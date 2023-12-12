@extends('layouts.frontend')

@section('content')

<div class="container">
    <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ __('Registration Successful') }}</div>
                <div class="card-body">
                    Congratulations! Registration is successful, now you can <a href="{{route('login')}}">login </a> and enjoy our services.
                </div>
            </div>
    </div>
</div>

@endsection

