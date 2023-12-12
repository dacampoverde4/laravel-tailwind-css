@extends('admin.New.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h4 class="inline_block font22"><b><img src="{{ asset('backend/images/setamount.png') }}" alt="Img" title="Img" class="announcement">Feature Price</b></h4>
                        <hr>
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                        <form class="form_inline fullwidth" method="POST" action="{{ route('saveWebsiteSetting') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="token_amount" class="col-md-12 col-form-label text-md-right">Private Messages</label>
                                <div class="col-md-6">
                                    <i>Tokens Required:</i>
                                    <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_private_messages_{{ $id }}]" value="{{ @$metaData['token_private_messages_'.$id] }}" required="">
                                </div>
                                <div class="col-md-6">
                                    <i>How many notes user can send?</i>
                                    <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_private_messages_value_{{ $id }}]" value="{{ @$metaData['token_private_messages_value_'.$id] }}" required="">
                                </div>
                            </div>
                            <hr class="mtop40">
                            <div class="form-group row">
                                <label for="token_amount" class="col-md-12 col-form-label text-md-right">Live Chat</label>
                                <div class="col-md-6">
                                    <i>Tokens Required:</i>
                                    <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_monthly_connection_{{ $id }}]" value="{{ @$metaData['token_monthly_connection_'.$id] }}" required="">
                                </div>
                                <div class="col-md-6">
                                    <i>User can chat with number of users in a month?</i>
                                    <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_monthly_connection_value_{{ $id }}]" value="{{ @$metaData['token_monthly_connection_value_'.$id] }}" required="">
                                </div>
                            </div>
                            <hr class="mtop40">
                            <div class="form-group row">
                                <label for="token_amount" class="col-md-12 col-form-label text-md-right">UserName Change: </label>
                                <div class="col-md-6">
                                    <i>Tokens Required:</i>
                                    <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_username_change_{{ $id }}]" value="{{ @$metaData['token_username_change_'.$id] }}" required="">
                                </div>
                                <div class="col-md-6">
                                    <i>How many times user will change his/her user name in a month?</i>
                                    <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_username_change_value_{{ $id }}]" value="{{ @$metaData['token_username_change_value_'.$id] }}" required="">
                                </div>
                            </div>
                            <hr class="mtop40">
                            <div class="form-group row">
                                <label for="token_amount" class="col-md-12 col-form-label text-md-right">View My Likes: </label>
                                <div class="col-md-6">
                                    <i>Tokens Required:</i>
                                    <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_view_my_likes_{{ $id }}]" value="{{ @$metaData['token_view_my_likes_'.$id] }}" required="">
                                </div>
                                <div class="col-md-6">
                                    <i>How many likes visible?</i>
                                    <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_view_my_likes_value_{{ $id }}]" value="{{ @$metaData['token_view_my_likes_value_'.$id] }}" required="">
                                </div>
                            </div>
                            <hr class="mtop40">
                            <div class="form-group row">
                                <label for="token_amount" class="col-md-12 col-form-label text-md-right">View My Matches: </label>
                                <div class="col-md-6">
                                    <i>Tokens Required:</i>
                                    <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_view_my_matches_{{ $id }}]" value="{{ @$metaData['token_view_my_matches_'.$id] }}" required="">
                                </div>
                                <div class="col-md-6">
                                    <i>How many Matches visible?</i>
                                    <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_view_my_matches_value_{{ $id }}]" value="{{ @$metaData['token_view_my_matches_value_'.$id] }}" required="">
                                </div>
                            </div>
                            <hr class="mtop40">
                            <div class="form-group row">
                                <label for="token_amount" class="col-md-12 col-form-label text-md-right">My Hearts: </label>
                                <div class="col-md-12">
                                    <i>Tokens Required:</i>
                                    <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_my_hearts_{{ $id }}]" value="{{ @$metaData['token_my_hearts_'.$id] }}" required="">
                                </div>
                            </div>
                            <hr class="mtop40">
                            <div class="form-group row">
                                <label for="token_amount" class="col-md-12 col-form-label text-md-right">Advance Search: </label>
                                <div class="col-md-12">
                                    <i>Tokens Required:</i>
                                    <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_advance_search_{{ $id }}]" value="{{ @$metaData['token_advance_search_'.$id] }}" required="">
                                </div>
                            </div>
                            <hr class="mtop40">
                            <div class="form-group row">
                                <label for="token_amount" class="col-md-12 col-form-label text-md-right">Max Trial: </label>
                                <div class="col-md-6">
                                    <i>Tokens Required:</i>
                                    <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_trial_token_{{ $id }}]" value="{{ @$metaData['token_trial_token_'.$id] }}" required="">
                                </div>
                                <div class="col-md-6">
                                    <i>Monthly Max Trial</i>
                                    <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_trial_token_value_{{ $id }}]" value="{{ @$metaData['token_trial_token_value_'.$id] }}" required="">
                                </div>
                            </div>
                            <hr class="mtop40">
                            <div class="form-group row">
                                <label for="token_amount" class="col-md-12 col-form-label text-md-right">Profile Picture change: </label>
                                <div class="col-md-6">
                                    <i>Tokens Required:</i>
                                    <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_user_image_change_{{ $id }}]" value="{{ @$metaData['token_user_image_change_'.$id] }}" required="">
                                </div>
                                <div class="col-md-6">
                                    <i>How many time user will change Profile Picture?</i>
                                    <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_user_image_change_value_{{ $id }}]" value="{{ @$metaData['token_user_image_change_value_'.$id] }}" required="">
                                </div>
                            </div>
                            <hr class="mtop40">
                            <div class="form-group row">
                                <label for="token_amount" class="col-md-12 col-form-label text-md-right">free profile visits: </label>
                                <div class="col-md-6">
                                    <i>Tokens Required:</i>
                                    <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_free_profile_visit_{{ $id }}]" value="{{ @$metaData['token_free_profile_visit_'.$id] }}" required="">
                                </div>
                                <div class="col-md-6">
                                    <i>No of free profile visitor</i>
                                    <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_free_profile_visit_value_{{ $id }}]" value="{{ @$metaData['token_free_profile_visit_value_'.$id] }}" required="">
                                </div>
                            </div>
                            <hr class="mtop40">
                            <div class="form-group row">
                                <label for="token_amount" class="col-md-12 col-form-label text-md-right">Max Album Images: </label>
                                <div class="col-md-6">
                                    <i>Tokens Required:</i>
                                    <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_max_images_upload_{{ $id }}]" value="{{ @$metaData['token_max_images_upload_'.$id] }}" required="">
                                </div>
                                <div class="col-md-6">
                                    <i>Max No of images upload by user</i>
                                    <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_max_images_upload_value_{{ $id }}]" value="{{ @$metaData['token_max_images_upload_value_'.$id] }}" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12"><button type="submit" class="btn btn-success pull-right border_radius"><i class="fa fa-check"></i> Submit</button></div>
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