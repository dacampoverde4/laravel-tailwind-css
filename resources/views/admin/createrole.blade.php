@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="font22"><b class="vertical_align"><img src="{{ asset('backend/images/roles.png') }}" alt="Gender" title="Img" class="gender_img"> Role</b></h3>
                        <hr>
                        <form class="form-horizontal" role="form" method="POST" action="{{route('role.store')}}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="row">
                            <label for="" class="col-md-3 col-form-label text-md-right">Add Role</label>
                            <div class="col-md-9">
                                <input id="role"  type="text" class="form-control" name="role" value="{{ old('heading') }}" required autofocus>
                            </div>
                        </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success pull-right border_radius">
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
