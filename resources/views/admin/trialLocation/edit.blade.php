@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3><i class="fa fa-envelope"></i>Edit Trial Location</h3>
                        <hr>
                        @if (\Session::has('message'))
                             <div class="alert alert-success">
                                 {!! \Session::get('message') !!}
                             </div>

                         @endif
                        <form class="form-horizontal" role="form" method="POST" action="{{route('triallocation.update',$triallocation->id)}}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="row">
                                    <label for="name" class="col-md-3 control-label text-md-right">Name</label>
                                    <div class="col-md-9">
                                        <input id="name"  type="text" class="form-control" name="name" value="{{$triallocation->name}}" required autofocus>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('name'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <div class="row">
                                    <label for="address" class="col-md-3 control-label text-md-right">Address</label>
                                    <div class="col-md-9">
                                        <input id="address"  type="text" class="form-control" name="address" value="{{ $triallocation->address }}" required autofocus>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('address'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('address') }}</strong>
                            </span>
                            @endif

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <div class="row">
                                    <label for="description" class="col-md-3 control-label text-md-right">Description</label>
                                    <div class="col-md-9">
                                        <textarea id="description" class="form-control" name="description" autofocus>{{ $triallocation->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('description'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif

                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                <div class="row">
                                    <label for="image" class="col-md-3 control-label text-md-right">Picture</label>
                                    <div class="col-md-1">
                                        <img src="{{url('uploads/location')}}/{{$triallocation->image}}" height=50px width=50px alt=""/>
                                    </div>
                                    <div class="col-md-8">
                                      <input type="file" id="image" name="image" class="form-control" autofocus required/>
                                    </div>

                                </div>
                            </div>
                            @if ($errors->has('image'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('image') }}</strong>
                            </span>
                            @endif

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9"><button type="submit" class="btn btn-success pull-right border_radius"><i class="fa fa-check"></i> Update</button></div>
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
        $('.searchdropdown').select2({
            placeholder: 'select role',
          multiple: false
        });
    });
</script>
@endsection
