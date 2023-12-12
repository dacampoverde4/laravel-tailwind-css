@extends('admin.New.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="font22"><i class="fa fa-envelope"></i> Edit Role</h3>
                        <hr>
                            <form class="form-horizontal" role="form" method="POST" action="{{route('role.update',$role->id)}}">
                                {{ csrf_field() }}
                                
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <div class="row">
                                    <label for="title" class="col-md-3 control-label">Add Role</label>
                                    <div class="col-md-9">
                                        <input id="role"  type="text" class="form-control" name="role" value="{{$role->role}}" required autofocus>
                                    </div>
                                </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-md-offset-4">
                                        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-check"></i>
                                        Submit
                                        </button>
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
