@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block"><b>Edit Token</b>
                        <a class="btn btn-primary pull-right" href="{{ url('admin/tokens') }}"><i class="fa fa-arrow-left"></i> Back</a>
                        </h3>
                        <hr>
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form class="form_inline fullwidth mtop40" enctype="multipart/form-data" method="POST" action="{{route('token.update', $token->id)}}">
                        @csrf
                        <div class="form-group">
                           <div class="row">
                            <label for="Title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-8">
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $token->title }}"  >

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
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descripiton') }}</label>

                            <div class="col-md-8">
                                
                                <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ $token->description }}</textarea>

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
                            <label for="icon" class="col-md-4 col-form-label text-md-right">{{ __('Icon') }}</label>

                            <div class="col-md-8">
                                <input id="icon" type="file" class="form-control{{ $errors->has('icon') ? ' is-invalid' : '' }}" name="icon" value="" > @if($token->icon) <img style="width: 100px;" src="{{ url('uploads/tokenicon/'.$token->icon) }}"> @endif

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
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Token') }}</label>

                            <div class="col-md-8">
                                <input id="amount" placeholder="T" type="number" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ $token->amount }}" >

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
                            <label for="Additional Text" class="col-md-4 col-form-label text-md-right">{{ __('Additional Text') }}</label>

                            <div class="col-md-8">
                                <input id="additional_text" type="text" class="form-control{{ $errors->has('additional_text') ? ' is-invalid' : '' }}" name="additional_text" value="{{ $token->additional_text }}" >

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
                            <label for="Discount" class="col-md-4 col-form-label text-md-right">{{ __('Discount') }}</label>

                            <div class="col-md-8">
                                <input id="discount" type="number" class="form-control{{ $errors->has('discount') ? ' is-invalid' : '' }}" name="discount" value="{{ $token->discount }}" >

                            </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9"><button type="submit" class="btn btn-success pull-right border_radius">Submit</button></div>
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
<script>
    CKEDITOR.replace('description');
</script>
@endsection