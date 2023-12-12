@extends('admin.layout.master')
@section('page_css')
<link href="{{ asset('new_theme_assets/main/css/select2.min.css') }}" rel="stylesheet" />
<style type="text/css">
    label.required:after { content:" *"; color: red; }
    .select{
        cursor: pointer;
    }
</style>
@endsection
@section('content')
<!-- Row -->
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block"><b class="vertical_align">Edit Advertisement</b>
                            <a class="btn btn-info pull-right" href="{{ url('admin/dvertisement') }}"><i class="fa fa-arrow-left"></i> Back</a>
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
                        <form class="form_inline fullwidth mtop40" method="POST" action="{{route('advertisement.update',$advertisement->id)}}">
                            @csrf
                            <div class="row"> 
                                <label for="content" class="col-md-2 col-form-label text-md-right">Title</label>                         
                                <div class="col-md-10 form-group">
                                <input type="text" name="title" id="title" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{$advertisement->title}}">
                                </div>
                            </div>
                            <div class="row"> 
                                <label for="content" class="col-md-2 col-form-label text-md-right">Description</label>                                  
                                <div class="col-md-10 form-group">
                                    <textarea id="description" class="form-control" name="description">{{$advertisement->description}}</textarea>
                                </div>
                            </div>
                            @php 
                            $tid= array_values(array_unique(explode(',',$advertisement->target_audience_ids)));
                            $bannerid=array_values(array_unique(explode(',',$advertisement->banner_ids)));
                            @endphp
                            <div class="form-group">
                                <div class="row">
                                    <label for="content" class="col-md-2 col-form-label text-md-right">Select Banner</label>
                                    <div class="col-md-10 selectbanner">
                                        <select class="form-control" name="banner[]" multiple="multiple" id="banner">
                                            @foreach($banner as $banner)
                                                    <option value="{{$banner->id}}"  {{ in_array($banner->id,$bannerid) ? "selected" :"" }} >{{$banner->banner_width}}X{{$banner->  banner_height}} : {{$banner->page_location}} page</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <output id="list"></output>                           
                            <div class="form-group">
                                <div class="row">
                                    <label for="content" class="col-md-2 col-form-label text-md-right">Select Target Audience</label>
                                    <div class="col-md-10 selecttarget">
                                        <select class="form-control" name="targetaudience[]" multiple="multiple" id="targetaudience">

                                            @foreach($targetaudience as $targetaudience)
                                                    <option value="{{$targetaudience->id}}" {{ in_array($targetaudience->id,$tid) ? "selected" :"" }}>{{$targetaudience->  usergroup_names }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="text-right d-block">Banner Plan</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="custom-control custom-radio" style="padding-left: 0px; float: left;">
                                        <input type="radio" class="custom-control-input" id="weekly" name="banner_plan" value="weekly" {{ ($advertisement->banner_plan=="weekly")? "checked" : "" }} >
                                        <label class="custom-control-label" for="weekly">Weekly</label>
                                     </div>
                                     <div class="custom-control custom-radio" style="padding-left: 0px; float: left;">
                                         <input type="radio" class="custom-control-input" id="monthly" name="banner_plan" value="monthly" {{ ($advertisement->banner_plan=="monthly")? "checked" : "" }}>
                                         <label class="custom-control-label" for="monthly">Monthly</label>
                                     </div>
                                </div>
                            </div>
                            <div class="row">                               
                                <div class="col-md-2">
                                    <label class="text-right d-block">Plan Period</label>
                                </div> 
                                <div class="col-md-10 form-group">
                                    <input type="number" name="plan_period" id="plan_period" class="form-control" value="{{$advertisement->plan_period}}">
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
<!-- Row -->
@endsection
@section('page_js')
<script src="{{ asset('new_theme_assets/main/js/select2.min.js') }}"></script>
<script type="text/javascript">
$('#banner').select2();
$('#targetaudience').select2(); 
</script>
@endsection
