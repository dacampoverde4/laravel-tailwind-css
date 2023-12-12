@extends('admin.layout.master')
@section('content')
<style media="screen">
input[type=checkbox]
{
  -webkit-appearance:checkbox;
}
</style>
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block"><b class="vertical_align">Edit Announcement</b>
                        <a class="btn btn-info pull-right" href="{{ url('admin/announcements') }}"><i class="fa fa-arrow-left"></i> Back</a>
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
                        <form class="form_inline fullwidth mtop40" method="POST" action="{{route('announcement.update',$announcement->id)}}">
                        @csrf
                        <div class="form-group">
                           <div class="row">
                            <label for="content" class="col-md-2 col-form-label text-md-right">{{ __('Content') }}</label>

                            <div class="col-md-10">
                                <textarea id="content" type="text" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" value="" required >{{ $announcement->content }} </textarea>
                                @if ($errors->has('warning_text'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('warning_text') }}</strong>
                                </span>
                                @endif
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                &nbsp;
                            </div>
                            <div class="col-md-10">
                                @if ($announcement->is_sticky == 1)
                                    <div class="custom-control" style="padding-left: 0px;">
                                       <input id="is_sticky" name="is_sticky" value="1" type="checkbox" class="" style="padding-left: 0px;" checked>
                                       <label class="custom-control-label" for="is_sticky">Is Sticky</label>
                                    </div>
                                @else
                                    <div class="custom-control" style="padding-left: 0px;">
                                       <input id="is_sticky" name="is_sticky" value="1" type="checkbox" class="" style="padding-left: 0px;">
                                       <label class="custom-control-label" for="is_sticky">Is Sticky</label>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label class="text-right d-block">Display</label>
                            </div>
                            <div class="col-md-10">
                                @if ($announcement->display_annoucement == 0)
                                    <div class="custom-control custom-radio" style="padding-left: 0px; display: inline-block;">
                                        <input type="radio" class="custom-control-input" id="as_usual" name="display" value="0" checked>
                                        <label class="custom-control-label" for="as_usual">As Usual</label> |
                                    </div>
                                    <div class="custom-control custom-radio" style="padding-left: 0px; display: inline-block;">
                                        <input type="radio" class="custom-control-input" id="notification" name="display" value="1">
                                        <label class="custom-control-label" for="notification">Notification</label>
                                    </div>
                                @else
                                    <div class="custom-control custom-radio" style="padding-left: 0px; display: inline-block;">
                                        <input type="radio" class="custom-control-input" id="as_usual" name="display" value="0">
                                        <label class="custom-control-label" for="as_usual">As Usual</label> |
                                    </div>
                                    <div class="custom-control custom-radio" style="padding-left: 0px; display: inline-block;">
                                        <input type="radio" class="custom-control-input" id="notification" name="display" value="1" checked>
                                        <label class="custom-control-label" for="notification">Notification</label>
                                    </div>
                                @endif

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
