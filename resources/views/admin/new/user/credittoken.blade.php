@extends('admin.New.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="font22 mb30"><b class="vertical_align"><img src="{{ asset('backend/images/token.png') }}" alt="Token" title="Token">CREDIT TOKEN</b></h3>
                        <hr>
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <form action="{{ route('getcredit.tokens') }}" method="post">
                    @csrf
                    <div class="form-group{{ $errors->has('users') ? ' has-error' : '' }}">
                        <label for="role" class="control-label">Select Users</label>
                        <select class="form-control credittoken" multiple name="users[]">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} </option>
                            @endforeach
                        </select>
                        @if ($errors->has('users'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('users') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    <div class="form-group{{ $errors->has('credittoken') ? ' has-error' : '' }}">
                        <label for="role" class="control-label">Token Credit</label>
                        <input class="form-control" type="number" name="credittoken">
                        @if ($errors->has('credittoken'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('credittoken') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                        <label for="role" class=" control-label">Message</label>
                        <input class="form-control" type="text" name="message">
                        @if ($errors->has('message'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('message') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-9"><button type="submit" class="btn btn-success pull-right border_radius"><i class="fa fa-check"></i> Submit</button></div>
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
    $(document).ready(function() {
        $('.credittoken').select2({
            placeholder: 'select users',
          multiple: true
        });
    });
</script>
@endsection