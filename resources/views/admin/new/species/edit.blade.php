@extends('admin.New.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="font22 inline_block">
                            <b class="vertical_align">
                            <img src="{{ asset('backend/images/user.png') }}" alt="Species" title="Img" class="gender_img">
                            Edit Species
                            </b>
                            <a href="{{route('admin.species.index')}}" class="btn btn-info pull-right">Back</a>
                        </h3>
                        <hr>
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if (session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                        @endif
                        <form class="form-horizontal" role="form" method="POST" action="{{route('admin.species.update',$species->id)}}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('species_name') ? ' has-error' : '' }}">
                                <div class="row">
                                <label for="species_name" class="col-md-3 control-label">
                                Species Name
                                </label>
                                <div class="col-md-9">
                                    <input id="species_name"  type="text" class="form-control" name="species_name" value="{{$species->name}}" autofocus>
                                    @if ($errors->has('species_name'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('species_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12"><button type="submit" class="btn btn-success pull-right border_radius"><i class="fa fa-check"></i> Update</button></div>
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