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
                        <h3><i class="fa fa-envelope"></i> HUD</h3>
                        <hr>
                        @if (\Session::has('success'))
             <div class="alert alert-success">
                 {!! \Session::get('success') !!}
             </div>

         @endif
                        <form class="form-horizontal" role="form" method="POST" action="{{route('admin.hud.update',$hud->id)}}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                             <div class="row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                                <div class="col-md-6">
                                    <input id="title"  type="title" class="form-control" name="title" value="{{ $hud->title }}" required autofocus>
                                    @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
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
@endsection
