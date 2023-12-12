@extends('admin.layout.master')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block"><b>Create Tag</b>
                        <a class="btn btn-primary pull-right" href="{{route('admin.usergroup.tag.create')}}"><i class="fa fa-arrow-left"></i> Back</a></h3>
                        <hr>
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                       @endif
                       <form class="form_inline fullwidth mtop40" method="POST" action="{{route('admin.usergroup.tag.update',$tag->id )}}">
                        @csrf
                        <div class="form-group">
                           <div class="row"> 
                            <label for="Title" class="col-md-3 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $tag->title }}" required >

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
                            <label for="Title" class="col-md-3 col-form-label text-md-right">{{ __('Color') }}</label>

                            <div class="col-md-6 col-sm-12">
                                <div class="col-sm-12">
                                    <input id="primary_color" type="color" class="form-control" name="primary_color" value="{{ $tag->primary_color }}" required >
                                </div>
                                <div class="col-sm-12">
                                    <input id="primary_color" type="color" class="form-control" name="secondary_color" value="{{ $tag->secondary_color }}" required >
                                </div>
                            </div>
                            </div>
                        </div>
                        


                        <div class="form-group">
                            <div class="row">
                            <div class="col-md-9"><button type="submit" class=" btn-success pull-right border_radius">Submit</button></div>
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