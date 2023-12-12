@extends('layouts.frontend')

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
                   
                        @csrf
                       

                           
                        @foreach($pin as $row)
                            <?php $email = preg_replace('/(?:^|.@).\K|.\.[^@]*$(*SKIP)(*F)|.(?=.*?\.)/', '*', $row->email); ?>
                            <div class="col-md-6">
                                <p><em>Your email address is {{$email}} .Send email for password recovery. </em></p>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <a href="{{ route('password.recovery',$row->email) }}" class="btn btn-primary">
                                        {{ __('Send recovery email') }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection