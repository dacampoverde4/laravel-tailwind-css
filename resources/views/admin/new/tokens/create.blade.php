@extends('admin.New.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block"><b>Create Token</b>
                        <a class="btn btn-primary pull-right" href="{{ url('admin/tokens') }}"><i class="fa fa-arrow-left"></i> Back</a>
                        </h3>
                        <hr>
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        <form class="form_inline fullwidth mtop40" enctype="multipart/form-data" method="POST" action="{{route('token.store')}}">
                        @csrf
                        <div class="form-group">
                           <div class="row">
                            <label for="Title" class="col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-10">
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value=""  >

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
                            <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Descripiton') }}</label>

                            <div class="col-md-10">
                                <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="" >

                                @if ($errors->has('description'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                           <div class="row">
                            <label for="icon" class="col-md-2 col-form-label text-md-right">{{ __('Icon') }}</label>

                            <div class="col-md-10">
                                <input id="icon" type="file" class="form-control{{ $errors->has('icon') ? ' is-invalid' : '' }}" name="icon" value="" >

                                @if ($errors->has('icon'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('icon') }}</strong>
                                </span>
                                @endif
                            </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                           <div class="row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Token') }}</label>

                            <div class="col-md-10">
                                <input id="amount" placeholder="T" type="number" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="" >

                                @if ($errors->has('amount'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
                                @endif
                            </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                           <div class="row">
                            <label for="Additional Text" class="col-md-2 col-form-label text-md-right">{{ __('Additional Text') }}</label>

                            <div class="col-md-10">
                                <input id="additional_text" type="text" class="form-control{{ $errors->has('additional_text') ? ' is-invalid' : '' }}" name="additional_text" value="" >

                                @if ($errors->has('additional_text'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('additional_text') }}</strong>
                                </span>
                                @endif
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                           <div class="row">
                            <label for="Discount" class="col-md-2 col-form-label text-md-right">{{ __('Discount') }}</label>

                            <div class="col-md-10">
                                <input id="discount" type="number" class="form-control" name="discount" value="" >

                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9"><button type="submit" class="btn btn-info pull-right border_radius"><i class="fa fa-check"></i> Submit</button></div>
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