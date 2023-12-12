@extends('admin.layout.master')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@section('content')
<style type="text/css">
    [type=radio]:checked, [type=radio]:not(:checked) {
        position: relative;
        left: 0;
        opacity: 1;
   }
</style>
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22">
                        <b class="vertical_align">
                            <img src="{{ asset('backend/images/genderrole.png') }}" alt="Gender" title="Img" class="gender_img">GENDER ROLE
                        </b>
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
                         <form class="form-horizontal" role="form" method="POST" action="{{route('gender.update',$gender->id)}}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                  <div class="row">
                                    <label for="title" class="col-md-3 col-form-label text-md-right">Title</label>
                                    <div class="col-md-6">
                                        <input id="title"  type="text" class="form-control" name="title" value="{{$gender->title}}" required autofocus>
                                    </div>
                                   </div>
                                </div>
                                <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <div class="row">
                                    <label for="rd_male" class="col-md-3 col-form-label text-md-right">Gender</label>
                                    <div class="col-md-6">
                                        <label class="radio-inline">
                                            <input style="width:auto;" type="radio" name="gender" id="rd_male" value="male" {{$gender->gender=='female'?'':'checked'}}>Male
                                        </label>
                                        <label class="radio-inline">
                                            <input style="width:auto;" type="radio" name="gender" id="rd_female" value="female" {{$gender->gender=='female'?'checked':''}}>Female
                                        </label>
                                    </div>
                                  </div>
                              </div>
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-success width">
                                                Update
                                            </button>
                                            <a href="{{route('admin.gender')}}" class="btn btn-info">Cancel</a>
                                      </div>
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
