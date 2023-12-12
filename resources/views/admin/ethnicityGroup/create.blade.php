@extends('admin.layout.master')
@section('content')
<style>
  label > span {
    font-size: 10px;
    line-height: 10px;
  }
</style>
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3><i class="fa fa-envelope"></i>Ethnicity Group</h3>
                        <hr>
                        <form class="form-horizontal form_common" role="form" method="POST" action="{{route('admin.ethnicity.group.store')}}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                              <div class="row">
                                <label for="title" class="col-md-3 col-form-label text-md-right">Title</label>
                                <div class="col-md-9">
                                    <input id="title"  type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
                                </div>
                              </div>
                            </div>
                            @if ($errors->has('title'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('title') }}</strong>
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
@endsection
