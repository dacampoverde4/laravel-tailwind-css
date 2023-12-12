@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                         <h4 class="font22"><i class="fa fa-envelope"></i> Edit Role</h4>
                         <hr>
                         <form class="form-horizontal" role="form" method="POST" action="{{route('role.update',$role->id)}}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <div class="row">
                                    <label for="" class="col-md-3 col-form-label text-md-right">Add Role</label>
                                    <div class="col-md-9">
                                        <input id="role"  type="text" class="form-control" name="role" value="{{$role->role}}" required autofocus>
                                    </div>
                                </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success width pull-right">
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
