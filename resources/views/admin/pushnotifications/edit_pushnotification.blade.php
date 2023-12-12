@extends('admin.layout.master')
@section('page_css')
<link href="{{ asset('new_theme_assets/main/css/select2.min.css') }}" rel="stylesheet" />
<style type="text/css">
    label.required:after { content:" *"; color: red; }
</style>
@endsection
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22"><b>UPDATE PUSH NOTIFICATION</b>
                            <a class="btn btn-info btnpad pull-right" href="{{ route('pushnotifications.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
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
                        <form class="form_inline fullwidth mtop40" method="POST" action="{{route('pushnotifications.update', $pushnotification->id)}}" enctype="multipart/form-data">
                            @csrf
                            <input name="_method" type="hidden" value="PATCH">
                            <div class="form-group">
                                <div class="row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right required">{{ __('Name') }}</label>
                                    <div class="col-md-8">
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ? old('name'): $pushnotification->name }}">
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
                                    <label for="button_text" class="col-md-4 col-form-label text-md-right">{{ __('Call to action button text') }}</label>
                                    <div class="col-md-8">
                                        <input id="button_text" type="text" class="form-control{{ $errors->has('button_text') ? ' is-invalid' : '' }}" name="button_text" value="{{ old('button_text') ? old('button_text'): $pushnotification->button_text }}">
                                        @if ($errors->has('button_text'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('button_text') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="url" class="col-md-4 col-form-label text-md-right">{{ __('Call to action URL') }}</label>
                                    <div class="col-md-8">
                                        <input id="url" type="text" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" name="url" value="{{ old('url') ? old('url'): $pushnotification->url }}">
                                        @if ($errors->has('url'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('url') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="showing_count" class="col-md-4 col-form-label text-md-right">{{ __('How many times you going to show after login ?') }}</label>
                                    <div class="col-md-8">
                                        <input id="showing_count" type="text" class="form-control{{ $errors->has('showing_count') ? ' is-invalid' : '' }}" name="showing_count" value="{{ old('showing_count') ? old('showing_count'): $pushnotification->showing_count }}">
                                        @if ($errors->has('showing_count'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('showing_count') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="seconds_to_show_after_login" class="col-md-4 col-form-label text-md-right">{{ __('Please enter seconds') }}</label>
                                    <div class="col-md-8">
                                        <input id="seconds_to_show_after_login" type="text" class="form-control{{ $errors->has('seconds_to_show_after_login') ? ' is-invalid' : '' }}" name="seconds_to_show_after_login" value="{{ old('seconds_to_show_after_login') ? old('seconds_to_show_after_login'): $pushnotification->seconds_to_show_after_login }}">
                                        @if ($errors->has('seconds_to_show_after_login'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('seconds_to_show_after_login') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="url" class="col-md-4 col-form-label text-md-right"></label>
                                    <div class="col-md-8 demo-checkbox">
                                        <input type="checkbox" id="show_to_new_users" class="filled-in chk-col-red" @if($pushnotification->show_to_new_users)checked="checked" @endif name="show_to_new_users" value="1">
                                        <label for="show_to_new_users">{{ __('Do you want to show to new users ?') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="user_groups" class="col-md-4 col-form-label text-md-right">{{ __('User Groups') }}</label>
                                    <div class="col-md-8 select">
                                        <select class="form-control" name="user_groups[]" id="user_groups" multiple="multiple">
                                            @foreach($user_groups as $user_group)
                                                <option value="{{ $user_group->id }}" @if(in_array($user_group->id, $selected_usergroups) ) selected="selected" @endif>{{ $user_group->title }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('user_groups'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('user_groups') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="plans" class="col-md-4 col-form-label text-md-right">{{ __('Membership Plans') }}</label>
                                    <div class="col-md-8 select">
                                        <select class="form-control" name="plans[]" id="plans" multiple="multiple">
                                            @foreach($plans as $plan)
                                                <option value="{{ $plan->id }}" @if(in_array($plan->id, $selected_plans) ) selected="selected" @endif>{{ $plan->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('plans'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('plans') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                                    <div class="col-md-8">
                                        <textarea id="content" type="text" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content">{{ old('content') ? old('content'): $pushnotification->content }}</textarea>
                                        @if ($errors->has('content'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('content') }}</strong>
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
                                            <img src="{{ asset($pushnotification->bannerimage) }}" alt="your image" style="width: 300px;" />
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
<script src="{{ asset('new_theme_assets/main/js/select2.min.js') }}"></script>
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
$('select').select2();
</script>
@endsection