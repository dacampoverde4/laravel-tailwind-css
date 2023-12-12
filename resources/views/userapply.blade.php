@extends('layouts.frontend')
@section('content')
<h2 class="mtopbottom60 text-center">Apply fo Job</h2>
<div class="userapply_main">
    <div class="container">
        <div class="row">
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown </p>
            @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            <form action="{{ route('userapply.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="Name">Name</label>
                      <input type="name" name="name" class="form-control" placeholder="Name">
                       @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                      <label for="Email">Email</label>
                      <input type="email" class="form-control" name="email" placeholder="Email">
                      @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="Phone No">Phone No.</label>
                      <input type="number" class="form-control" name="contact_no" placeholder="Phone No.">
                      @if ($errors->has('contact_no'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('contact_no') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                      <label for="Area Of Excertise">Area Of Excertise</label>
                      <select class="form-control" name="area">
                          @foreach($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                      </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                      <label for="Phone No">Upload Resume</label>
                      <input type="file" class="form-control" name="file" placeholder="Upload Resume">
                      @if ($errors->has('file'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('file') }}</strong>
                        </span>
                        @endif
                    </div>
    
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-12">
                      <button name="submit" class="btnred btnpad border0 border_radius mtop20" style="margin-bottom:30px" id="form_send">Send</button>
                    </div>
    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection