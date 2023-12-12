@extends('admin.New.layout.master')
@section('content')
<div class="row">
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22">
                            <b class="vertical_align">
                            <img src="{{ asset('backend/images/genderrole.png') }}" alt="Gender" title="Img" class="gender_img"> GENDER ROLE
                            </b>
                            <a href="{{route('admin.gender')}}" class="btn btn-info pull-right">Back</a>
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
                        <form class="form-horizontal" role="form" method="POST" action="{{route('gender.store')}}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="row">
                                    <label for="title" class="col-md-2 control-label">Title</label>
                                    <div class="col-md-10">
                                        <input id="title"  type="title" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <div class="row">
                                    <label for="rd_male" class="col-md-2 control-label">Gender</label>
                                    <div class="col-md-10">
                                        <label class="radio-inline">
                                        <input style="width:auto;" type="radio" name="gender" id="rd_male" value="male" {{old('gender')=='female'?'':'checked'}}>Male
                                        </label>
                                        <label class="radio-inline">
                                        <input style="width:auto;" type="radio" name="gender" id="rd_female" value="female" {{old('gender')=='female'?'checked':''}}>Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-success width"><i class="fa fa-check"></i>
                                    Submit
                                    </button>
                                    <a href="{{route('admin.gender')}}" class="btn btn-inverse">Cancel</a>
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