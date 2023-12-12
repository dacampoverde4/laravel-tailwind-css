@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                         <form action="{{route('agestore')}}" class="form-horizontal" method="POST">
                          {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Age Group</label>

                            <div class="col-md-6">
                                <input   type="text" class="form-control" name="age" value="{{ old('heading') }}" required autofocus>
                        </div>
                        </div>


                          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">User</label>

                            <div class="col-md-6">
                                <input   type="text" class="form-control" name="usergroup" value="{{ old('heading') }}" required autofocus>
                        </div>
                        </div>

                             <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>

                                
                            </div>
                        </div>
                    </form>
        </div>
    </div>
</div>
@endsection
