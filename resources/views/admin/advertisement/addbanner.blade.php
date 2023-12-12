@extends('admin.layout.master')
@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font20"><b class="vertical_align"><i class="fa fa-life-bouy" aria-hidden="true"></i> Add Banner</b>
                        </h3>
                        <hr>
                        <div class="msgtabs pt50">
                            <div class="container-fluid">
                                @if(session()->has('success'))
                                <div class="">
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                </div>
                                @endif

                                @if(session()->has('error'))
                                <div class="">
                                    <div class="alert alert-error">
                                        {{ session()->get('error') }}
                                    </div>
                                </div>
                                @endif
                                
                                <form class="form_inline fullwidth mtop40" method="POST" action="{{route('savebanner.advertisement')}}" >
                                    @csrf                                       

                                        <div class="row"> 
                                            <div class="col-md-3">
                                                <div class="form_lbl">
                                                    <strong>Banner Width:</strong>
                                                </div>
                                            </div>                                  
                                            <div class="col-md-9 form-group">
                                                <input type="text" name="bannerwidth" id="banner_width" class="form-control {{ $errors->has('bannerwidth') ? ' is-invalid' : '' }}" value="{{ old('bannerwidth') }}">
                                            </div>
                                        </div>

                                        <div class="row"> 
                                            <div class="col-md-3">
                                                <div class="form_lbl">
                                                    <strong>Banner Height:</strong>
                                                </div>
                                            </div>                                  
                                            <div class="col-md-9 form-group">
                                                <input type="text" name="bannerheight" id="bannerheight" class="form-control {{ $errors->has('bannerheight') ? ' is-invalid' : '' }}" value="{{ old('bannerheight') }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form_lbl">
                                                    <strong>Banner page Location:</strong>
                                                </div>
                                            </div> 
                                            <div class="col-md-9 form-group">
                                                <input type="text" name="bannerlocation" id="bannerlocation" class="form-control {{ $errors->has('bannerlocation') ? ' is-invalid' : '' }}" value="{{ old('bannerlocation') }}">
                                            </div>
                                        </div> 

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form_lbl">
                                                    <strong>Weekly Price:</strong>
                                                </div>
                                            </div> 
                                            <div class="col-md-9 form-group">
                                                <input type="number" name="weeklyprice" id="weeklyprice" class="form-control {{ $errors->has('weeklyprice') ? ' is-invalid' : '' }}" value="{{ old('weeklyprice') }}">
                                            </div>
                                        </div>                                         

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form_lbl">
                                                    <strong>Monthly Price:</strong>
                                                </div>
                                            </div> 
                                            <div class="col-md-9 form-group">
                                                <input type="number" name="monthlyprice" id="monthlyprice" class="form-control {{ $errors->has('monthlyprice') ? ' is-invalid' : '' }}" value="{{ old('monthlyprice') }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9">
                                                <button type="submit" class="btn btn-success border_radius">Submit</button>
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
    </div>
</div>
@endsection
@section('page_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('description');
</script>
@endsection