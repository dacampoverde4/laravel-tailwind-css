@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22"><b><img src="{{ asset('backend/images/setamount.png') }}" alt="Img" title="Img" class="announcement">Registeration form Alert Texts</b></h3>
                        <hr>
                        <form class="form_inline fullwidth" method="POST" action="{{ route('saveWebsiteSetting') }}">
                        @csrf
                        
                        <hr class="">
                        <div class="form-group row">
                            <div class="col-md-4">
                                 <label for="token_amount" class="col-md-12 col-form-label text-md-right">For Form heading: </label>
                            </div>
                            <div class="col-md-8">
                                <input id="form-heading" type="text" class="form-control" name="websiteSettings[token_reg_text_form_heading]" value="{{ @$metaData['token_reg_text_form_heading'] }}" >
                            </div>
                        </div>
                        <hr class="">
                        <div class="form-group row">
                            <div class="col-md-4">
                                 <label for="first-name" class="col-md-12 col-form-label text-md-right">For First name: </label>
                            </div>
                            <div class="col-md-8">
                                <input id="first-name" type="text" class="form-control" name="websiteSettings[token_reg_text_first_name]" value="{{ @$metaData['token_reg_text_first_name'] }}" >
                            </div>
                        </div>
                        <hr class="">
                        <div class="form-group row">
                            <div class="col-md-4">
                                 <label for="last-name" class="col-md-12 col-form-label text-md-right">For Last name: </label>
                            </div>
                            <div class="col-md-8">
                                <input id="last-name" type="text" class="form-control" name="websiteSettings[token_reg_text_last_name]" value="{{ @$metaData['token_reg_text_last_name'] }}">
                            </div>
                        </div>
                        <hr class="">
                        <div class="form-group row">
                            <div class="col-md-4">
                                 <label for="email" class="col-md-12 col-form-label text-md-right">For Email Address: </label>
                            </div>
                            <div class="col-md-8">
                                <input id="email" type="text" class="form-control" name="websiteSettings[token_reg_text_email]" value="{{ @$metaData['token_reg_text_email'] }}" >
                            </div>
                        </div>
                        <hr class="">
                        <div class="form-group row">
                            <div class="col-md-4">
                                 <label for="group" class="col-md-12 col-form-label text-md-right">For User Group: </label>
                            </div>
                            <div class="col-md-8">
                                <input id="user_group" type="text" class="form-control" name="websiteSettings[token_reg_text_usergroup]" value="{{ @$metaData['token_reg_text_usergroup'] }}" >
                            </div>
                        </div>
                        <hr class="">
                        <div class="form-group row">
                            <div class="col-md-4">
                                 <label for="Gender" class="col-md-12 col-form-label text-md-right">For Gender: </label>
                            </div>
                            <div class="col-md-8">
                                <input id="gender" type="text" class="form-control" name="websiteSettings[token_reg_text_gender]" value="{{ @$metaData['token_reg_text_gender'] }}" >
                            </div>
                        </div>
                        <hr class="">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="species" class="col-md-12 col-form-label text-md-right">For Species: </label>
                            </div>
                            <div class="col-md-8">
                                <input id="species" type="text" class="form-control" name="websiteSettings[token_reg_text_species]" value="{{ @$metaData['token_reg_text_species'] }}" >
                            </div>
                        </div>
                        <hr class="">
                        <div class="form-group row">
                            <div class="col-md-4">
                                 <label for="Password" class="col-md-12 col-form-label text-md-right">For Password: </label>
                            </div>
                            <div class="col-md-8">
                                <input id="Password" type="text" class="form-control" name="websiteSettings[token_reg_text_password]" value="{{ @$metaData['token_reg_text_password'] }}" >
                            </div>
                        </div>
                        <hr class="">
                        <div class="form-group row">
                            <div class="col-md-4">
                                 <label for="Password" class="col-md-12 col-form-label text-md-right">For Confirm Password: </label>
                            </div>
                            <div class="col-md-8">
                                <input id="Password" type="text" class="form-control" name="websiteSettings[token_reg_text_confirm_password]" value="{{ @$metaData['token_reg_text_confirm_password'] }}" >
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success pull-right border_radius">Submit</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
