@extends('layouts.master')

@section('main-content')
<div class="maincontent">
    <div class="content bgwhite">                       

        <!-- Start Upgrade Membership ---->
        <div class="membership">
            <div class="container-fluid">
                    <h4 class="inline_block font22"><b><img src="{{ asset('backend/images/setamount.png') }}" alt="Img" title="Img" class="announcement">Free Member Features Setting</b></h4>
                </div>
           <hr>
        </div>
        <!-- End Upgrade Membership ---->

        @php
            $id = 0;
        @endphp
        <!-- Start Message Tabs -->
        <div class="msgtabs pt50">
            <div class="container-fluid">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="token-amount">
                    <form class="form_inline fullwidth" method="POST" action="{{ route('saveWebsiteSetting') }}">
                        @csrf
    					<div class="form-group row">
                            
                            <div class="col-md-4">
                                <label for="token_amount" class="col-md-12 col-form-label text-md-right">Is User can send Private Messages?</label>
                                <div class="onoffswitch">
                                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch">
                                    <label class="onoffswitch-label" for="myonoffswitch">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                 <i>How many notes user can send?</i>
                                <input id="notes_send" type="number" class="form-control" name="websiteSettings[token_private_messages_value_{{ $id }}]" value="{{ @$metaData['token_private_messages_value_'.$id] }}" required="">
                            </div>
                        </div>
                        <hr class="mtop40">
                        <div class="form-group row">
                            
                            <div class="col-md-4">
                                <label for="token_amount" class="col-md-12 col-form-label text-md-right">Is User can do Live Chat</label>
                                <div class="onoffswitch">
                                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch1">
                                    <label class="onoffswitch-label" for="myonoffswitch1">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                 <i>User can chat with number of users in a month?</i>
                                <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_monthly_connection_value_{{ $id }}]" value="{{ @$metaData['token_monthly_connection_value_'.$id] }}" required="">
                            </div>
                        </div>
                        <hr class="mtop40">
                        <div class="form-group row">
                            <label for="token_amount" class="col-md-12 col-form-label text-md-right">UserName Change: </label>
                            <div class="col-md-6">
                                 <i>How many times user will change his/her user name in a month?</i>
                                <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_username_change_value_{{ $id }}]" value="{{ @$metaData['token_username_change_value_'.$id] }}" required="">
                            </div>
                        </div>
                        <hr class="mtop40">
                        <div class="form-group row">
                            <label for="token_amount" class="col-md-12 col-form-label text-md-right">View My Likes: </label>
                            <div class="col-md-6">
                                 <i>How many likes visible?</i>
                                <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_view_my_likes_value_{{ $id }}]" value="{{ @$metaData['token_view_my_likes_value_'.$id] }}" required="">
                            </div>
                        </div>
                        <hr class="mtop40">
                        <div class="form-group row">
                            <label for="token_amount" class="col-md-12 col-form-label text-md-right">View My Matches: </label>
                            <div class="col-md-6">
                                 <i>How many Matches visible?</i>
                                <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_view_my_matches_value_{{ $id }}]" value="{{ @$metaData['token_view_my_matches_value_'.$id] }}" required="">
                            </div>
                        </div>

                        <hr class="mtop40">
                        <div class="form-group row">
                            <label for="token_amount" class="col-md-12 col-form-label text-md-right">Profile Picture change: </label>
                            <div class="col-md-6">
                                 <i>How many time user will change Profile Picture?</i>
                                <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_user_image_change_value_{{ $id }}]" value="{{ @$metaData['token_user_image_change_value_'.$id] }}" required="">
                            </div>
                        </div>
                        <hr class="mtop40">
                        <div class="form-group row">
                            <label for="token_amount" class="col-md-12 col-form-label text-md-right">Max Album Images: </label>
                            <div class="col-md-6">
                                 <i>Max No of images upload by user</i>
                                <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_max_images_upload_value_{{ $id }}]" value="{{ @$metaData['token_max_images_upload_value_'.$id] }}" required="">
                            </div>
                            <div class="col-md-6">
                                 <i>Max No of images upload by user</i>
                                <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_max_images_upload_value_{{ $id }}]" value="{{ @$metaData['token_max_images_upload_value_'.$id] }}" required="">
                            </div>
                        </div>
                        
                        
                        <div class="col-md-10">
                            <button type="submit" class="btnpad btnred pull-right border_radius">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div> 

@endsection
