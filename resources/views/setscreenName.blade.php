@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}       @if (session('status'))
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
                    <code><span style="font-weight:600">Note:</span> Must be in string</code>
                    <form method="POST" action="{{ route('screenname.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="screenname" class="col-sm-4 col-form-label text-md-right">{{ __('Enter Screen Name') }}</label>

                            <div class="col-md-6">
                                <input id="screenname" type="text" class="form-control{{ $errors->has('screenname') ? ' is-invalid' : '' }}" name="screenname"  placeholder="Enter Screen Name" value="{{ old('screenname') }}" required autofocus>

                                @if ($errors->has('screenname'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('screenname') }}</strong>
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