@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3><i class="fa fa-edit" aria-hidden="true"></i> Edit Trial Reason</h3>
                        <hr>
                        <form class="form-horizontal form_common" role="form" method="POST" action="{{route('trialreasons.update', $CreateReasons->id)}}"  enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <div class="row">
                                    <label for="name" class="col-md-3 control-label text-md-right">Title</label>
                                    <div class="col-md-9">
                                        <input id="title"  type="text" class="form-control" name="title" value="{{ $CreateReasons->title }}" required autofocus>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('title'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif

                            <div class="form-group{{ $errors->has('sort') ? ' has-error' : '' }}">
                                <div class="row">
                                    <label for="name" class="col-md-3 control-label text-md-right">Sort</label>
                                    <div class="col-md-9">
                                        <input id="sort"  type="number" min='0' class="form-control" name="sort" value="{{ $CreateReasons->sort }}" required autofocus>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('sort'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('sort') }}</strong>
                            </span>
                            @endif

                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <div class="row">
                                    <label for="name" class="col-md-3 control-label text-md-right">Status</label>
                                    <div class="col-md-9">
                                        <select name="status" class="form-control">
                                            <option value="">Select</option>
                                            @php
                                                $status = array('cancel' => 'Cancel Request', 'adoption' => 'Proceed to Adoption', 'skip' => 'Skip Request');
                                            @endphp
                                            @foreach($status as $key => $value)
                                              @if($key == $CreateReasons->status)
                                                  <option value="{{$key}}" selected>{{$value}}</option>
                                              @else
                                                  <option value="{{$key}}">{{$value}}</option>
                                              @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('status'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('status') }}</strong>
                            </span>
                            @endif

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
        $('.searchdropdown').select2({
            placeholder: 'select role',
          multiple: false
        });
    });
</script>
@endsection
