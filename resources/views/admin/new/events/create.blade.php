@extends('admin.New.layout.master')
@section('page_css')
<link rel="stylesheet" href="{{ asset('backend') }}/css/jquery-ui-timepicker-addon.min.css">
@stop
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block"><b>Create Events</b>
                            <a class="btn btn-info pull-right" href="{{ url('admin/events') }}"><i class="fa fa-arrow-left"></i> Back</a>
                        </h3>
                        <hr>
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <form class="form_inline fullwidth mtop40" method="POST" action="{{route('event.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <label for="Title" class="col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>
                                    <div class="col-md-10">
                                        <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
                                            value="{{ old('title') }}" required >
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
                                    <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Description') }}</label>
                                    <div class="col-md-10">
                                        <textarea id="description" class="{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="" style="width:100%">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="image" class="col-md-2 col-form-label text-md-right">{{ __('Image') }}</label>
                                    <div class="col-md-10">
                                        <input type="file" name="file" onchange="readURL(this);" />
                                        <img id="blah" src="http://placehold.it/180" alt="your image" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="category" class="col-md-2 col-form-label text-md-right">{{ __('Category') }}</label>
                                    <div class="col-md-10">
                                        <select class="searchdropdown form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" name="category[]" multiple>
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->term_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="date" class="col-md-2 col-form-label text-md-right">{{ __('Date') }}</label>
                                    <div class="col-md-10">
                                        <input id="datepicker" type="text" autocomplete="off" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date"
                                            value="{{ old('date') }}">
                                    </div>
                                </div>
                            </div>
                            {{--
                            <div class="form-group">
                                <div class="row">
                                    <label for="location" class="col-md-2 col-form-label text-md-right">{{ __('Location') }}</label>
                                    <div class="col-md-10">
                                        <input id="location" type="text" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" name="location" value="">
                                    </div>
                                </div>
                            </div>
                            --}}
                            <div class="form-group">
                                <div class="row">
                                    <label for="location_url" class="col-md-2 col-form-label text-md-right">{{ __('Location url') }}</label>
                                    <div class="col-md-10">
                                        <input id="location_url" type="text" class="form-control{{ $errors->has('location_url') ? ' is-invalid' : '' }}" name="location_url" value="{{ old('location_url') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="Price" class="col-md-2 col-form-label text-md-right">{{ __('Price') }}</label>
                                    <div class="col-md-10">
                                        <input id="price" type="text" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="FreeTokens" class="col-md-2 col-form-label text-md-right">{{ __('Free Tokens') }}</label>
                                    <div class="col-md-10">
                                        <input id="freetokens" type="text" class="form-control{{ $errors->has('freetokens') ? ' is-invalid' : '' }}" name="freetokens" value="">
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="{{ asset('backend') }}/js/jquery-ui-timepicker-addon.min.js"></script>
<script src="{{ asset('backend') }}/js/jquery-ui-timepicker-addon-i18n.min.js"></script>
<script src="{{ asset('backend') }}/js/jquery-ui-sliderAccess.js"></script>
<script>
    $(function() {
      //$( "#datepicker" ).datepicker( { dateFormat: 'mm-dd-yy' }  );
        $('#datepicker').datetimepicker({
            dateFormat: 'mm-dd-yy',
            timeFormat: 'hh:mm TT'
        });
    });
</script>
<script>
    function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
    
                    reader.onload = function (e) {
                        $('#blah')
                            .attr('src', e.target.result);
                    };
    
                    reader.readAsDataURL(input.files[0]);
                }
            }
        
</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.searchdropdown').select2({
            placeholder: 'select category',
          multiple: true
        });
    });
</script>
@endsection