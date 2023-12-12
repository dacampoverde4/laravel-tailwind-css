@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22"><b>UPDATE MATCH QUEST CATEGORY</b>
                            <a class="btn btn-info btnpad pull-right" href="{{ route('matchquestcategories.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
                        </h3>
                        <hr>
                        @if (session('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('success') }}
                        </div>
                        @elseif(session('warning'))
                        <div class="alert alert-warning">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('warning') }}
                        </div>
                        @elseif(session('error'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('error') }}
                        </div>
                        @endif
                        <form class="form_inline fullwidth mtop40" method="POST" action="{{route('matchquestcategories.update', $matchquestcategory->id)}}" enctype="multipart/form-data">
                            @csrf
                            <input name="_method" type="hidden" value="PATCH">
                            <div class="form-group">
                                <div class="row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                    <div class="col-md-8">
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $matchquestcategory->name }}">
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                                    <div class="col-md-8">
                                        <textarea id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ $matchquestcategory->description }}</textarea>
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
                                    <label for="banner" class="col-md-4 col-form-label text-md-right">{{ __('Banner') }}</label>
                                    <div class="col-md-8">
                                        <input type="file" name="banner" class="form-control banner image_input" value="{{ old('banner') }}" accept="image/*">
                                        <div class="image_preview_div" style="margin-top: 10px;">
                                            <img src="{{ asset($matchquestcategory->bannerimage) }}" alt="your image" style="width: 300px;" />
                                        </div>
                                        <div class="remove_image_div">
                                            <span class='remove_image' data-id="banner">Remove Image</span>
                                        </div>
                                        <input type="hidden" name="remove_existing_image" value="0">
                                        @if ($errors->has('banner'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('banner') }}</strong>
                                        </span>
                                        @endif
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
<script type="text/javascript">
function readURL(input, profile_preview_img) {
    console.log('input.files: ',input.files)
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(profile_preview_img).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$(".remove_image").click(function () {
    var form_group = $(this).closest('.form-group');
    $(form_group).find('input[type=file]').val('');
    $(form_group).find('.image_preview_div img').attr('src', '');
    $(this).hide();
    $(form_group).find('.image_preview_div img').hide();
    $("input[name=remove_existing_image]").val(1);
});
$("input[type=file]").change(function(){
    var profile_preview_img = $(this).closest('.form-group').find('.image_preview_div img');
    $(profile_preview_img).show();
    readURL(this, profile_preview_img);
    $(this).closest('.form-group').find(".remove_image").show();
    $("input[name=remove_existing_image]").val(0);
});
</script>
@endsection