@extends('layouts.master')
@section('htmlheader')
@php
use App\FamilyRole;
@endphp
<!-- <link href="http://demo.expertphp.in/css/dropzone.css" rel="stylesheet"> -->
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
    integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" rel="stylesheet">
<link href="{{ URL::asset('new-assets/common/plugins/croppie/croppie.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('new-assets/common/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet"
    type="text/css" />
<!-- <link href="{{ URL::asset('new-assets/common/plugins/select2/css/select2.min.css')}}" rel="stylesheet" /> -->
<link href="{{ URL::asset('new-assets/frontend/css/upload_crop_image.css')}}" rel="stylesheet" type="text/css" />
<style>
    .fade:not(.show) {
    opacity: 1;
    }
    .profile-tab li a.nav-link.active,
    .customtab li a.nav-link.active {
    text-decoration: none;
    background-color: #3b5998;
    color: #fff;
    text-align: center;
    border: none;
    }
    a.nav-link.active {
    color: #fff !important;
    border: none !important;
    }
    .customtab li a.nav-link,
    .profile-tab li a.nav-link {
    border: 0px;
    padding: 15px 0 !important;
    color: #67757c;
    }
    .nav-tabs .nav-item {
    margin-bottom: -1px;
    width: 33%;
    text-align: center;
    margin-right: 1px;
    margin-left: 1px;
    }
    ul.nav.nav-tabs.profile-tab a {
    color: #000;
    }
    .nav-tabs .nav-link {
    border: 1px solid transparent !important;
    border-top-left-radius: .25rem !important;
    border-top-right-radius: .25rem !important;
    }
    ul.nav.nav-tabs.profile-tab li a:hover {
    color: #fff;
    background: #3b5998;
    }
    .like_btn {
    color: #ee3c3c;
    }
    .like_btn,
    .match_btn {
    float: left;
    margin-left: 0rem;
    }
    .like_btn i,
    .match_btn i {
    display: inline-block;
    font-size: 25px;
    padding-right: 8px;
    }
    .match_btn {
    color: #30a6cc;
    margin-left: 15px;
    cursor: default;
    }
    .like_btn,
    .match_btn {
    background: transparent none repeat scroll 0 0;
    border: 1px solid #eaeaea;
    border-radius: 4px;
    font-size: 21px;
    padding: 5px 20px;
    display: inline-flex;
    }
    .rounded-circle {
    border-radius: 50% !important;
    width: 257px;
    }
    input[type="file"] {
    cursor: pointer;
    display: block;
    margin: 20px auto;
    text-align: center !important;
    left: 0;
    right: 0;
    width: 50%;
    }
    .btnred {
    background: #0c3b69 !important;
    color: #fff !important;
    border: none !important;
    }
    .uploadicon i {
    color: #fff;
    background: #0c3b69;
    font-size: 24px;
    padding: 20px;
    border-radius: 50%;
    }
    .profile-header-img img {
    border-radius: 0;
    box-shadow: 0 9px 24px #ccc;
    }
    .modal-header {
    display: inline-block;
    }
    .modal-header .close {
    padding: 0;
    margin: 0;
    }
    .modal-title {
    color: #0c3b69;
    /* font-family: open sans; */
    font-weight: bold;
    line-height: 1.42857;
    margin: 0;
    margin-bottom: 0px;
    text-transform: uppercase;
    text-align: center;
    left: 0;
    right: 0;
    margin: auto;
    }
    .fa,
    .far,
    .fas {
    font-family: FontAwesome;
    }
    .btnpad {
    padding: 8px 30px;
    }
    i.fa.fa-camera.fa-2x.upload_modal {
    color: #fff;
    }
    .profileicon {
    position: relative;
    overflow: hidden;
    border-radius: 50%;
    }
    .profileicon img.profileimg {
    border: 4px solid #3b5998;
    width: 100%;
    }
    .camerbg {
    background-color: rgba(0, 0, 0, 0.5);
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 0px;
    line-height: 42px;
    overflow: hidden;
    transition: all ease 0.5s;
    }
    .profileicon:hover .camerbg {
    height: 50%;
    transition: all ease 0.5s;
    padding: 10px;
    }
    .camerbg i {
    font-size: 18px;
    }
    .camerbg p {
    font-size: 13px;
    color: #fff;
    line-height: 0;
    font-weight: 600;
    margin: 0;
    }
    /*** Username change Modal **/
    .usernameChange_modal-body>p {
    font-size: 30px;
    font-weight: 500;
    color: #000;
    }
    .usernameChange_modal-body>button {
    display: table;
    margin: 0 auto;
    }
    #changeUsernameForm button {
    display: table;
    margin: 0 auto;
    }
    .btn-upload-profile {
    background-color: transparent !important;
    border: 1px solid #f2f2f2;
    color: white !important;
    margin: 5px 0;
    top: 0px;
    position: initial;
    z-index: 99;
    left: 20px;
    padding: 8px 10px;
    display: table;
    margin: 0 auto;
    text-align: center;
    }
    @media only screen and (max-width: 767px) {
    .profileicon {
    width: 65%;
    }
    }
    @media only screen and (min-width: 768px) and (max-width: 991px) {
    .profileicon {
    width: 75%;
    }
    }
    @media only screen and (min-width: 320px) and (max-width: 330px) {
    .profileicon {
    width: 80%;
    }
    }
    #counter {
    font-size: small;
    width: 30px;
    }
    .adoptfsec {
    max-height: 305px;
    overflow-x: hidden;
    height: 305px;
    overflow-y: scroll;
    }
    #agree {
    margin: 6px 10px 0 0px;
    }
    .trialSuccessPopup .modal-dialog {
    /* width: 800px; */
    max-width: 600px;
    }
    .requestActionButtons a {
    font-size: 14px;
    }
    .trial_req_sec .page-titles {
    padding: 20px !important;
    }
    .leftSidebar ul li {
    width: 100%;
    }
    .tabIcons {
    height: 40px;
    margin-right: 8px;
    }
    .nav.nav-tabs.customtab li a span {
    font-size: 16px;
    font-weight: 600;
    text-align: left;
    }
    .nav.nav-tabs.customtab li {
    background: #eee;
    margin-bottom: 2px;
    }
    .card-no-border .card {
    padding: 15px;
    }
    .customtab li a.nav-link {
    padding: 8px 10px;
    }
    .customtab.nav-tabs {
    border-bottom: none;
    }
    .mainContent .tab-content {
    padding-top: 0;
    }
    .trialDefaultText {
    font-size: 15px;
    color: #000;
    line-height: 22px;
    text-align: left;
    }
    .request-header img {
    height: 80px;
    width: 80px;
    border-radius: 50%;
    }
    .request-content {
    border: 1px solid #eee;
    border-radius: 4px;
    box-shadow: 0 0px 3px rgba(0, 0, 0, .5);
    margin-bottom: 15px;
    }
    .request-header,
    .request-body {
    border-bottom: 1px solid #eee;
    padding: 10px;
    }
    .request-footer {
    padding: 10px;
    text-align: center;
    }
    /****new*****/
    .bnrp0 {
    padding: 0;
    }
    .bnrp0 h4 {
    background-color: #2b2b2b;
    color: #fff;
    text-align: center;
    padding: 16px 0px;
    font-size: 35px;
    font-weight: 400;
    }
    .middlecontent .requestActionButtons {
    float: inherit;
    display: flex;
    margin: 0px 0px;
    }
    .middlecontent .requestActionButtons a {
    margin: 0px 4px;
    }
    .usenamwe h4 {
    color: #1976d2;
    font-size: 15px;
    text-align: center;
    margin: 10px 0px;
    font-weight: 700;
    }
    .midleinfouser:after {
    content: '';
    position: absolute;
    width: 90%;
    height: 2px;
    background-color: #dadada;
    display: inline-block;
    top: 34%;
    left: 50%;
    transform: translate(-50%, -50%);
    }
    .midleinfouser {
    position: relative;
    width: 100%;
    }
    .midltxtlft span:after {
    content: '';
    height: 20px;
    width: 20px;
    background-color: #67d6f2;
    position: absolute;
    border-radius: 50%;
    top: -17px;
    ;
    left: 50%;
    transform: translateX(-50%);
    z-index: 999;
    }
    .midltxtrgt span:before {
    content: '';
    height: 20px;
    width: 20px;
    background-color: #67d6f2;
    position: absolute;
    border-radius: 50%;
    top: -17px;
    right: 42%;
    transform: translateX(-50%);
    z-index: 999;
    }
    .midleinfouser {
    position: relative;
    width: 70%;
    display: flex;
    justify-content: space-around;
    align-items: center;
    }
    .midltxtlft,
    .midltxtrgt {
    width: 50%;
    display: inline-block;
    text-align: center;
    position: relative;
    }
    .midleinfouser span {
    text-transform: capitalize;
    color: #333;
    font-weight: 800;
    font-size: 16px;
    }
    .arw:after {
    content: '';
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 4px 13px 4px 0;
    border-color: transparent #dadada transparent transparent;
    position: absolute;
    top: 34%;
    transform: translateY(-50%);
    left: 23px;
    }
    .arw:before {
    content: '';
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 4px 0 4px 13px;
    border-color: transparent transparent transparent #dadada;
    position: absolute;
    top: 34%;
    transform: translateY(-50%);
    right: 23px;
    }
    .middlecontent .requestActionButtons a {
    margin: 0px 4px;
    text-transform: uppercase;
    padding: 7px 15px;
    line-height: 16px;
    }
    .col-md-2.leftSidebar li a {
    padding: 20px 38px !important;
    background-position: -3px 10px;
    background-size: 43px;
    }
    .bnrp0 h4 img {
    filter: invert(1);
    }
    .borderline {
    padding: 0px 20px;
    }
    .request-body p {
    margin-bottom: 0px;
    }
    @media screen and (max-width:1199px) {
    .col-md-2.leftSidebar li a {
    padding: 54px 4px 4px !important;
    background-position: center;
    background-size: 37px;
    text-align: center;
    }
    }
    @media screen and (max-width:567px) {
    .table tr {
    border-top: 1px solid #dee2e6;
    }
    .table td {
    display: block;
    border: 0;
    padding: 6px 11px;
    }
    .hidden-xs-down {
    display: block !important;
    text-align: center !important;
    }
    span.hidden-sm-up {
    display: none;
    }
    }
    @media screen and (max-width:480px) {
    .middlecontent table.table {
    width: 100%;
    overflow-x: scroll;
    display: block;
    }
    .middlecontent .requestActionButtons a {
    margin: 0px 3px;
    text-transform: uppercase;
    padding: 7px 8px;
    line-height: 16px;
    font-size: 12px;
    }
    }
    .trialSPagnation {
    float: left;
    width: 100%;
    margin: 50px 0 0;
    }
    .rightBanner-images img {
    width: 100%;
    margin: 5px 0;
    }
    .featuredmembers {
    margin: 15px 0;
    width: 100%;
    float: left;
    }
    .featuredmembers p {
    font-size: 14px;
    font-weight: 600;
    }
    .subs_sec.shrt_sb span {
    font-size: 12px;
    line-height: 16px;
    text-align: center;
    float: left;
    width: 100%;
    margin: 5px 0 10px 0;
    }
    .trialFeature-members {
    padding: 0;
    list-style: none;
    float: left;
    width: 100%;
    }
    .trialFeature-members li {
    float: left;
    width: auto !important;
    margin: 3px;
    display: inline-block;
    }
    .trialFeature-members .img-circle {
    width: 45px;
    height: 45px;
    }
    .trialFeature-members .match_img {
    margin: 0;
    }
    .vartifybtns a.btn {
    color: #fff;
    }
</style>
@endsection
@section('main-content')
<div class="maincontent backend">
    <div class="container">
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
        @if(session()->has('danger'))
        <div class="alert alert-danger">
            {{ session()->get('danger') }}
        </div>
        @endif
        @if(session()->has('warning'))
        <div class="alert alert-warning">
            {{ session()->get('warning') }}
        </div>
        @endif
        <!--====================================================-->
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Column -->
                        <div class="col-lg-4 col-xlg-3 col-md-5">
                            <div class="card">
                                <div class="card-body">
                                    <center class="m-t-30">
                                        <div class="profileicon">
                                            <img
                                                src="{{ ( $user->profile_pic )? url('/uploads/'.$user->profile_pic) : url('images/default.png') }}"
                                                class="img-circle profileimg" width="150" />
                                            <div class="camerbg">
                                                <!-- <a href="" data-toggle="modal" data-target="#myModales"><i class="fa fa-camera fa-2x upload_modal"></i> <p>Update </p></a> -->
                                                <button type="button" class="btn btn-upload-profile" id="btn_open_modal_upload_profile_image">
                                                <i class="fa fa-camera fa-2x"></i> </button>
                                                <div class="modal fade" id="modal_upload_profile_image" tabindex="-1" role="basic"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <h4 class="modal-title">Upload Profile</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row " style="padding-top:10px;padding-bottom:10px;">
                                                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                                                        <div class="alert alert-info">
                                                                            <strong>Info!</strong> Please upload image format as jpeg, png, jpg and gif only.
                                                                        </div>
                                                                        <div class="frm_account_setup_profile_image_submit_msg"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="row " style="padding-bottom:20px;">
                                                                    <div class="col-md-5 col-sm-12 col-lg-5 col-xs-12 text-center">
                                                                        <div id="profile_image_crop_container" style=""></div>
                                                                    </div>
                                                                    <div class="col-md-2 col-sm-12 col-lg-2 col-xs-6">
                                                                        <div class="fileinput fileinput-new btn-block" data-provides="fileinput">
                                                                            <span class="btn btn-primary btn-file btn-block">
                                                                            <span class="fileinput-new  btn-block"
                                                                                onclick="document.getElementById('file_profile_image').click()">Browse</span>
                                                                            <span class="fileinput-exists btn-block"
                                                                                onclick="document.getElementById('file_profile_image').click()">Browse</span>
                                                                            <input type="file" name="..." id="file_profile_image" accept="image/*">
                                                                            </span>
                                                                        </div>
                                                                        <button class="btn btn-info btn_profile_image_preview btn-block">Preview</button>
                                                                        <button class="btn btn-success btn_profile_image_upload btn-block">Submit</button>
                                                                        <button class="btn btn-danger btn_profile_image_cancel btn-block"
                                                                            style="">Cancel</button>
                                                                    </div>
                                                                    <div class="col-md-5 col-sm-12 col-lg-5 col-xs-12">
                                                                        <div id="profile_image_preview_container"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb">
                                            <div class="col-md-12">
                                                <!-- <p style="font-weight:bold"> Username</p> -->
                                                <p class="text-center">{{$user->displayname}}</p>
                                            </div>
                                            <div class="vartifybtns text-center w-100">
                                                @if($user->verify_request == 1 && $user->verify==0)
                                                <a class="btn btn-success">Verification Pending</a>
                                                @elseif($user->verify_request == 0 && $user->verify == 0)
                                                <a href="javascript:void(0)" class="verifyRequest btn btn-success" data-id="{{$user->id}}"
                                                    data-token="{{ csrf_token() }}">Request Verification</a>
                                                @elseif($user->verify_request == 0 && $user->verify == 0)
                                                <a href="javascript:void(0)" class="verifyRequest btn btn-success disabled"
                                                    data-id="{{$user->id}}" data-token="{{ csrf_token() }}">Verification Declined</a>
                                                @elseif($user->verify_request == 1 && $user->verify == 1 && !empty($user->verifydate))
                                                <a class="btn btn-success">Verification Accepted</a>
                                                @endif
                                                <br>
                                                <p id="errormsg" style="display:none;"></span>
                                                    <a href="{{url('matchquests')}}" id="matchQuestHere" style="display:none;">Match Quest Here</a>
                                            </div>
                                        </div>
                                        <!-- create username change form -->
                                        <!-- <form class="form-horizontal form-material" action="{{route('profile.update',$user->id)}}" id="changeUsernameForm" method="post">
                                            @csrf
                                              @if( !isthisUserSubscribed(Auth::user()->id) )
                                                <div class="row mb">
                                                    <div class="col-md-12"><label><b>Username</b></label></div>
                                            
                                            
                                                    <div class="col-md-12">
                                                        @if( !isthisSubscribed() )
                                                            @php
                                                            $disable = "readonly";
                                                            @endphp
                                                            @endif
                                                        <input type="text" name="name" {{ @$disable }} value="{{$user->displayname}}" class=" form-control form-control-line border_radius {{ $errors->has('name') ? ' has-error' : '' }}" required>
                                                        @if ( $errors->has('name') )
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                            @endif
                                                    </div>
                                                </div>
                                                @else
                                            
                                                <div class="row  mb">
                                                    <div class="col-md-12"><label><b>Username</b></label></div>
                                                      <div class="col-md-12">
                                                           @if( !isthisSubscribed() )
                                                                @php
                                                                    $disable = "readonly";
                                                                @endphp
                                                          @endif
                                                          <input type="text" name="name" {{ @$disable }} value="{{$user->displayname}}" class=" form-control form-control-line border_radius {{ $errors->has('name') ? ' has-error' : '' }}" required>
                                                          @if ( $errors->has('name') )
                                                                <span class="invalid-feedback">
                                                                    <strong>{{ $errors->first('name') }}</strong>
                                                                </span>
                                                          @endif
                                                      </div>
                                                  </div>
                                            
                                                @endif
                                                <div class="row mtopbottom">
                                                        <button type="submit" name="action_submit" value="action_submitUsername" class="btn btn-success bgred border_radius">Name Change</button>
                                                </div>
                                            </form> -->
                                        @if($usernameChangeCount <= 0) 
                                        <div class="alert alert-warning">
                                            <p>You must <a href="#" data-toggle="modal" data-target="#usernameChange_modal">Buy a Username</a>
                                                change or <a href="{{url('pricing')}}">Upgrade</a> your membership
                                            </p>
                                        </div>
                                        @endif
                                        <div class="row text-center justify-content-md-center">
                                            <!--   <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">254</font></a></div>
                                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium">54</font></a></div>
                                                
                                                <button type="button" class="like_btn "><i style="font-size:30px" class="fa">&#xf087;</i> Likes</button>
                                                <button type="button" class="match_btn"><i style="font-size:30px" class="fa fa-check-square-o" aria-hidden="true"></i> Matches</button>-->
                                        </div>
                                    </center>
                                    <!-- <div class="usr_img">
                                        <div data-toggle="modal" data-target="#myModalAlbum" style="background-image:url({{ ( $user->profile_pic )? url('/uploads').'/'.$user->profile_pic : url('/images/default.png')}});background-size:cover;background-position:50% 50%;height:100px; width:100px; float: right;"></div>
                                        @php
                                            $images = @$user->photos;
                                        @endphp
                                        @if( $images )
                                            @foreach($images as $row)
                                                <div data-toggle="modal" data-target="#myModalAlbum" style="background-image:url({{ asset('/uploads/'.$row->image)}});background-size:cover;background-position:50% 50%;height:100px; width:100px; float: right;"> </div>
                                            @endforeach
                                        @endif
                                        </div> -->
                                    <div class="modal fade" id="myModalAlbum" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title font22">Photo Album</h4>
                                                </div>
                                                <div class="modal-body">
                                                    @if( isthisSubscribed() )
                                                    <h5 class="mtop20 font16">Upload multiple images for Photos Album</h5>
                                                    {!! Form::open([ 'route' => [ 'dropzone.uploadfile' ], 'files' => true, 'class' =>
                                                    'dropzone','id'=>"image-upload"]) !!}
                                                    {!! Form::close() !!}
                                                    <div class="padding60  text-center">
                                                        <h4 class="modal-title font22">Photos</h4>
                                                        <div class="grid">
                                                            <div class="grid-sizer"></div>
                                                            @php
                                                            $images = @$user->photos;
                                                            @endphp
                                                            @if( $images )
                                                            @foreach($images as $row)
                                                            <div
                                                                style="background-image:url({{ asset('/uploads/'.$row->image)}});background-size:cover;background-position:50% 50%;height:150px; width:150px; float: right;">
                                                                <a href="javascript:void(0)" class="deleteProduct" data-id="{{ $row->id }}"
                                                                    data-token="{{ csrf_token() }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                            </div>
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="row upgrade">
                                                        <div class="col-md-8">
                                                            <div class="upgdinfo bggray font300">
                                                                <p>Hey {{ ucfirst( Auth::user()->name ) }}!. Upgrade your membership today to experience
                                                                    unlimited upload photo.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <a style="padding: 18px 0px;" href="{{ url('pricing') }}"
                                                                class="btn btnred width100">Upgrade Membership</a>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                </div>
                                <!-- <div class="card-body"> <small class="text-muted">Email address </small>
                                    <h6>{{ $user->email }}</h6>
                                    </div> -->
                            </div>
                        </div>
                        <!-- Column -->
                        <!-- Column -->
                        <div class="col-lg-8 col-xlg-9 col-md-7">
                            <div class="card">
                                <div class="btn-pref btn-group-justified btn-group-lg" role="group" aria-label="...">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                      <li class="nav-item">
                                        <a class="nav-link btn btn-primary active" id="home-tab" data-toggle="tab" href="#profile_first" role="tab" aria-controls="home"
                                          aria-selected="true">PROFILE EDIT</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link btn btn-primary" id="profile-tab" data-toggle="tab" href="#profile_blog" role="tab" aria-controls="profile" aria-selected="false">BLOG</a>
                                      </li>
                                    </ul>
                                  
                                    {{-- @if($questionnary)
                                    <div class="btn-group" role="group">
                                        <button type="button" id="questionnary" class="btn btn-default" href="#profile_third" data-toggle="tab">
                                            <div class="hidden-xs">MATCH QUEST</div>
                                        </button>
                                    </div>
                                    @endif --}}
                                    <!-- <div class="btn-group" role="group">
                                        <button type="button" id="seeking" class="btn btn-default" href="#profile_second" data-toggle="tab">
                                            <div class="hidden-xs">HISTORY</div>
                                        </button>
                                        </div> -->
                                </div>
                                <!-- Nav tabs -->
                                <!--  <ul class="nav nav-tabs profile-tab" role="tablist">
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">PROFILE EDIT</a> </li>
                                    <!--     @if(count($questionnary)>0) -->
                                <!-- <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile_third" role="tab"  style="display:none;">QUESTIONNAIRES SETTINGS</a> </li>
                                    <!--  @endif -->
                                <!--    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">SEEKING</a> </li>
                                    </ul>
                                    <!-- Tab panes -->
                                <div class="well">
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="profile_first">
                                            <div class="card-body">
                                                <form class="form-horizontal form-material" action="{{route('profile.update',$user->id)}}"
                                                    method="post">
                                                    @csrf
                                                    @if( !isthisUserSubscribed(Auth::user()->id) )
                                                    <div class="form-group">
                                                        <label><b>About</b></label>
                                                        <textarea name="about" class="form-control {{ $errors->has('about') ? ' has-error' : ''}} "
                                                            rows="5">{{$user->about_me}}</textarea>
                                                        @if ($errors->has('about'))
                                                        <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('about') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    @else
                                                    <div class="form-group">
                                                        <label><b>About</b></label>
                                                        <textarea name="about" onkeyup="textCounter(this,'counter',400);fnCheckForRestrictedWords()" id="message"
                                                            class="form-control {{ $errors->has('about') ? ' has-error' : ''}} "
                                                            rows="5">{{$user->about_me}}</textarea>
                                                        <input disabled maxlength="400" size="400" value="400" id="counter">
                                                        @if ($errors->has('about'))
                                                        <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('about') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <div class="row mb">
                                                        <label for="species_id" class="col-md-4 col-sm-4 col-form-label"><b>Species</b></label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <select class="form-control" id="species_id" name="species_id">
                                                                <option value="">Please select</option>
                                                                @if( $species )
                                                                @foreach( $species as $row )
                                                                <option value="{{ $row->id }}" {{$row->id==$user->species_id ? 'selected' : ''}}>
                                                                <?php echo $row->name;?>
                                                                </option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                            @if ($errors->has('species_id'))
                                                            <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('species_id') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row mb">
                                                        <div class="col-md-4 col-sm-4"><label for="user_ethnicity_group"><b>Ethnicity
                                                            Group</b></label>
                                                        </div>
                                                        <div class="col-md-8 col-sm-8">
                                                            <select class="form-control" id="user_ethnicity_group" name="ethnicity_group"
                                                                required="required">
                                                                <option value="">Select Ethnicity Group</option>
                                                                @if( $ethnicityGroups )
                                                                @foreach($ethnicityGroups as $group)
                                                                <option value="{{ $group->id }}"
                                                                {{$group->id==$user->ethnicity_group_id ? 'selected' : ''}}>
                                                                <?php echo $group->title;?>
                                                                </option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if( !isthisUserSubscribed(Auth::user()->id) )
                                                    <div class="row mb">
                                                        <div class="col-md-4 col-sm-4"><label for="user_group"><b>User Groups</b></label></div>
                                                        <div class="col-md-4 col-sm-4">
                                                            <select class="form-control changeUserGroup" id="user_group"
                                                                onchange="getGenderInfo(this.value,{{ $user->gender }})" name="user_group"
                                                                required="required" disabled>
                                                            @if( $grouprole )
                                                            @foreach( $grouprole as $row )
                                                            <option value="{{ $row->id }}" data-min="{{ $row->minage }}" data-max="{{ $row->maxage }}"
                                                            {{ $row->id == $user->group ? 'selected="selected"' : '' }}><?php echo $row->title ?>
                                                            </option>
                                                            @endforeach
                                                            @endif
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4">
                                                            <a href="" class="btn btn-sm btn-success" data-toggle="modal"
                                                                data-target="#user_grpup_modal">Change</a>
                                                        </div>
                                                    </div>
                                                    <div class="row mb">
                                                        <label for="gender" class="col-md-4 col-sm-4 col-form-label"><b>Gender</b></label>
                                                        <div class="col-md-8 col-sm-8" id="genderInfodisplay">
                                                            {{-- <label for="" id="userGender"></label> --}}
                                                            @foreach($getUserGender as $genderRole)
                                                            @if($genderRole['id']== $user->gender)
                                                            <input type="radio" name="gender" value="{{$genderRole['id']}}"
                                                                checked>{{$genderRole['title']}}
                                                            @else
                                                            <input type="radio" name="gender" value="{{$genderRole['id']}}">{{$genderRole['title']}}
                                                            @endif
                                                            @endforeach
                                                            @if ($errors->has('gender'))
                                                            <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('gender') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row mb">
                                                        <div class="col-md-4 col-sm-4"><label for="user_age"><b>Age</b></label></div>
                                                        <div class="col-md-8 col-sm-8">
                                                            <select class="form-control" id="user_age" name="age" required="required">
                                                            @for( $i = $groupInfo->minage; $i<=$groupInfo->maxage; $i++)
                                                            <option value="{{ $i }}" {{ $i == $user->age ? 'selected="selected"' : '' }}>
                                                            <?php echo $i ?></option>
                                                            @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @php
                                                    $familrole=json_decode($groupInfo->family_roles);
                                                    @endphp
                                                    <div class="row mb">
                                                        <div class="col-md-4 col-sm-4"><label for="user_familyrole"><b>Family Role</b></label></div>
                                                        <div class="col-md-8 col-sm-8">

                                                            <select class="form-control" id="user_familyrole" name="family_role[]" required="required"
                                                                multiple>
                                                                <option value="">Select Family Role</option>
                                                                @forelse($familyRoles as $role)
                                                                @if(in_array($role->id,$familrole))
                                                                <option name="role" value="{{$role->id}}"
                                                                {{in_array($role->id,$UsersFamilyRole) ?  'selected' : '' }}>{{$role->title}}</option>
                                                                @endif
                                                                @empty
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="row mb">
                                                        <div class="col-md-4 col-sm-4"><label for="user_group"><b>User Groups</b></label></div>
                                                        <div class="col-md-4 col-sm-4">
                                                            <select class="form-control changeUserGroup" id="user_group"
                                                                onchange="getGenderInfo(this.value,{{ $user->gender }})" name="user_group"
                                                                required="required" disabled>
                                                            @if( $grouprole )
                                                            @foreach( $grouprole as $row )
                                                            <option value="{{ $row->id }}" data-min="{{ $row->minage }}" data-max="{{ $row->maxage }}"
                                                            {{ $row->id == $user->group ? 'selected="selected"' : '' }}><?php echo $row->title ?>
                                                            </option>
                                                            @endforeach
                                                            @endif
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4">
                                                            <a href="" class="btn btn-sm btn-success" data-toggle="modal"
                                                                data-target="#user_grpup_modal">Change</a>
                                                        </div>
                                                    </div>
                                                    <div class="row mb">
                                                        <label for="gender" class="col-md-4 col-sm-4 col-form-label"><b>Gender</b></label>
                                                        <div class="col-md-8 col-sm-8" id="genderInfodisplay">
                                                            {{-- <label for="" id="userGender"></label> --}}
                                                            @php
                                                            $user_Selected_geneder = "male";
                                                            @endphp
                                                            @foreach($getUserGender as $genderRole)
                                                            @if($genderRole['id']== $user->gender)
                                                            <input type="radio" name="gender" title="{{$genderRole['title']}}" value="{{$genderRole['id']}}"
                                                                checked>{{$genderRole['title']}}
                                                                @php
                                                                $user_Selected_geneder = $GenderRoles[$genderRole['title']];
                                                                @endphp
                                                            @else
                                                            <input type="radio" name="gender" title="{{$genderRole['title']}}" value="{{$genderRole['id']}}">{{$genderRole['title']}}
                                                            @endif
                                                            @endforeach
                                                            @if ($errors->has('gender'))
                                                            <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('gender') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row mb">
                                                        <div class="col-md-4 col-sm-4"><label for="user_age"><b>Age</b></label></div>
                                                        <div class="col-md-8 col-sm-8">
                                                            <select class="form-control" id="user_age" name="age" required="required">
                                                            @for( $i = $groupInfo->minage; $i<=$groupInfo->maxage; $i++)
                                                            <option value="{{ $i }}" {{ $i == $user->age ? 'selected="selected"' : '' }}>
                                                            <?php echo $i ?></option>
                                                            @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mb">
                                                        <div class="col-md-4 col-sm-4"><label for="user_familyrole"><b>Family Role</b></label></div>
                                                        <div class="col-md-8 col-sm-8">
                                                            <select class="form-control" id="user_familyrole" name="family_role[]" required="required"
                                                                multiple>
                                                                <option value="">Select Family Role</option>
                                                                @forelse($familyRoles as $role)
                                                                @if($role->gender == $user_Selected_geneder )
                                                                <option name="role" value="{{$role->id}}"
                                                                {{in_array($role->id,$UsersFamilyRole) ?  'selected' : '' }}>{{$role->title}}</option>
                                                                @endif
                                                                @empty
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                    </div>
                                              <!--       <div class="row mb">
                                                        <label for="gender" class="col-md-4 col-sm-4 col-form-label "><b>Gender</b></label>
                                                        <div class="col-md-8 col-sm-8" id="genderInfodisplay">
                                                            @foreach($getUserGender as $genderRole)
                                                            @if($genderRole['id']== $user->gender)
                                                            <input type="radio" name="gender" value="{{$genderRole['id']}}"
                                                                checked>{{$genderRole['title']}}
                                                            @else
                                                            <input type="radio" name="gender" value="{{$genderRole['id']}}">{{$genderRole['title']}}
                                                            @endif
                                                            @endforeach
                                                            @if ($errors->has('gender'))
                                                            <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('gender') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div> -->
                                                    <!-- User Groups start -->
                                               <!--      <div class="row mb">
                                                        <label for="species_id" class="col-md-4 col-sm-4 col-form-label "><b>Species</b></label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <select class="form-control" id="species_id" name="species_id">
                                                                <option value="">Please select</option>
                                                                @if( $species )
                                                                @foreach( $species as $row )
                                                                <option value="{{ $row->id }}" {{$row->id==$user->species_id ? 'selected' : ''}}>
                                                                <?php //echo $row->name;?>
                                                                </option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                            @if ($errors->has('species_id'))
                                                            <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('species_id') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div> -->
                                                    @endif
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label><b>Pride Friendly</b></label>
                                                            </div>
                                                            <div class="col-md-8 col-sm-8">
                                                                <select class="form-control" name="pride_friendly" id="pride_friendly">
                                                                    @if($user)
                                                                    @if($user->pride_friendly !='')
                                                                    <option value="1" <?php if($user->pride_friendly == 1) {?> selected <?php } ?>>Yes
                                                                    </option>
                                                                    <option value="0" <?php if($user->pride_friendly == 0) {?> selected <?php } ?>>No
                                                                    </option>
                                                                    @else
                                                                    <option value="" selected>Select Option</option>
                                                                    <option value="1">Yes</option>
                                                                    <option value="0">No</option>
                                                                    @endif
                                                                    @else
                                                                    <option value=""></option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if($groupInfo->visible_relationship == 1 && isset($selRelationships))
                                                        <div class="row mb">
                                                            <div class="col-md-4 col-sm-4"><label><b>Relationship Status</b></label></div>
                                                            <div class="col-md-8 col-sm-8">
                                                                <select name="relationships" class="form-control">
                                                                @foreach($selRelationships as $rows)
                                                                @php
                                                                $selected = '';
                                                                if( $rows->id == $user->relationship ){
                                                                $selected = "selected='selected'";
                                                                }
                                                                @endphp
                                                                <option {{ $selected }} value="{{ $rows->id }}" style="text-transform: capitalize !important;"><?php echo $rows->title ?></option>
                                                                @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if($groupInfo->visible_occupation == 1 && isset($selOccupations))
                                                        <div class="row mb">
                                                            <div class="col-md-4 col-sm-4"><label><b>Occupation</b></label></div>
                                                            <div class="col-md-8 col-sm-8">
                                                                <select name="occupations" class="form-control">
                                                                @foreach($selOccupations as $rows)
                                                                @php
                                                                $selected = '';
                                                                if( $rows->id == $user->occupation ){
                                                                $selected = "selected='selected'";
                                                                }
                                                                @endphp
                                                                <option {{ $selected }} value="{{ $rows->id }}" style="text-transform: capitalize !important;"><?php echo $rows->title ?></option>
                                                                @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if( !isthisUserSubscribed(Auth::user()->id) )
                                                    <div class="row mb">
                                                        <div class="col-md-4 col-sm-4"><label><b>My Funs</b></label></div>
                                                        <div class="col-md-8 col-sm-8">
                                                            <select name="myfuns[]" class="searchdropdown" multiple>
                                                            @foreach($myfuns as $rows)
                                                            @php
                                                            $selected = '';
                                                            $funs = ( $user->myfuns )? json_decode( $user->myfuns ) : array();
                                                            if($funs){
                                                            if( in_array($rows->id, $funs ) ){
                                                            $selected = "selected='selected'";
                                                            }
                                                            }
                                                            @endphp
                                                            <option {{ $selected }} value="{{ $rows->id }}"><?php echo $rows->title ?></option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="row mb">
                                                        <div class="col-md-4 col-sm-4"><label><b>My Funs</b></label></div>
                                                        <div class="col-md-8 col-sm-8">
                                                            <select name="myfuns[]" class="searchdropdown" multiple>
                                                            @foreach($myfuns as $rows)
                                                            @php
                                                            $selected = '';
                                                            $funs = ( $user->myfuns )? json_decode( $user->myfuns ) : array();
                                                            if($funs){
                                                            if( in_array($rows->id, $funs ) ){
                                                            $selected = "selected='selected'";
                                                            }
                                                            }
                                                            @endphp
                                                            <option {{ $selected }} value="{{ $rows->id }}"><?php echo $rows->title ?></option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label><b>HUDs</b></label>
                                                            </div>
                                                            <div class="col-md-8 col-sm-8">
                                                                <select class="form-control huds" name="huds[]" id="huds" multiple>
                                                                    @if($user)
                                                                    @if(count($huds)>0)
                                                                    <option value="">Select HUDs</option>
                                                                    @foreach($huds as $row)
                                                                    @php
                                                                    $sel = '';
                                                                    $user_huds = ($user->huds)? json_decode( $user->huds ) : array();
                                                                    if(is_array($user_huds) && count($user_huds)>0){
                                                                    if( in_array($row->id, $user_huds) ){
                                                                    $sel = "selected='selected'";
                                                                    }
                                                                    }else{
                                                                    $sel='';
                                                                    }
                                                                    @endphp
                                                                    <option {{ $sel }} value="{{ $row->id }}" ><?php echo $row->title ?></option>
                                                                    @endforeach
                                                                    @if ($errors->has('huds'))
                                                                    <span class="invalid-feedback">
                                                                    <strong>{{ $errors->first('huds') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                    @endif
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="currentgroup" value="{{$user->group}}">
                                                    <input type="hidden" name="changedvalue" id="changedvalue" value="">
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <button type="submit" name="action_submit" value="action_saveUserSetting"
                                                                class="btn btn-success pull-right">Save Settings</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                <div class="tab-pane fade" id="profile_blog">

                                    <form  action="{{ route('blogSettings') }}" method="post" enctype="multipart/form-data">
                                       @csrf
                                       <input type="hidden" name="blogId" value="{{$user->id}}">
                                       <div class="form-group"><br>
                                          <label><b style="margin-left: 20px;"> Add Blog Settings</b></label>
                                        </div>
                                          <div class="form-group">
                                            <div class="row">
                                                <label for="salary" class="col-md-4 col-form-label text-md-right">Upload Cover Photo</label>
                                                <div class="col-md-8">
                                                    <input id="cover" style="margin: 0;width: 100%;" type="file" class="form-control" name="cover" />
                                                    <img  src="{{ asset('/uploads/'.$user->cover_photo)}}" class="blog_img" width="100" title="blog">
                                                </div>
                                            </div>
                                        </div>

                                   <div class="form-group">
                                        <div class="row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">Facebook URL</label>
                                            <div class="col-md-8">
                                                <input id="name" type="text" class="form-control" name="facebook" value="{{$user->facebook_url}}">
                                              </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <label for="displayname" class="col-md-4 col-form-label text-md-right">Instagram URL</label>
                                            <div class="col-md-8">
                                                <input id="name" type="text" class="form-control" name="instagram" value="{{$user->instagram}}">
                                             </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <label for="displayname" class="col-md-4 col-form-label text-md-right">Twitter URL</label>
                                            <div class="col-md-8">
                                                <input id="name" type="text" class="form-control" name="twitter" value="{{$user->twitter}}">
                                            </div>
                                        </div>
                                    </div>

                                       <div class="form-group">
                                        <div class="row">
                                            <label for="displayname" class="col-md-4 col-form-label text-md-right">Flickr URL</label>
                                            <div class="col-md-8">
                                                <input id="name" type="text" class="form-control" name="flicker" value="{{$user->flicker}}">
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
                                        <!-- statred -->
                                        <div class="tab-pane fade in" id="profile_second">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card-body p-b-0">
                                                        <h5 class="card-title"><span>Adoptions History</span></h5>
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" role="tabpanel">
                                                                @if(count($myadoptions) > 0)
                                                                <div class="row maintbrow adoptfsec">
                                                                    @foreach($myadoptions as $myadoption)
                                                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                                                        <div class="request-content">
                                                                            <div class="request-header">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class=" borderline  d-flex justify-content-between">
                                                                                            @php
                                                                                            $getFamilyRoleUserInfo = FamilyRole::find($myadoption->trial_family_role);
                                                                                            $getFamilyRoleMatcherInfo =
                                                                                            FamilyRole::find($myadoption->adoptee_family_role);
                                                                                            @endphp
                                                                                            <div class="userA">
                                                                                                @if($myadoption->profile_pic)
                                                                                                <img src="{{ url('uploads')}}/{{$myadoption->matcherid->profile_pic}}"
                                                                                                    class="img-responsive" />
                                                                                                @endif
                                                                                                <div class="usenamwe">
                                                                                                    <h4>
                                                                                                        @if($myadoption->profile_pic)
                                                                                                        <a
                                                                                                            href="{{ url('userprofile')}}/{{base64_encode($myadoption->matcher_id)}}">{{$myadoption->matcherid->display_name_on_pages}}</a>
                                                                                                        @endif
                                                                                                    </h4>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="midleinfouser">
                                                                                                <div class="arw"></div>
                                                                                                <div class="midltxtlft">
                                                                                                    @if($myadoption->matcher_id)
                                                                                                    <span>{{$getFamilyRoleMatcherInfo->title}}</span>
                                                                                                    @endif
                                                                                                </div>
                                                                                                <div class="midltxtrgt">
                                                                                                    @if($myadoption->user_id)
                                                                                                    <span>{{$getFamilyRoleUserInfo->title}}</span>
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="userB">
                                                                                                @if($myadoption->profile_pic)
                                                                                                <img src="{{ url('uploads')}}/{{$myadoption->userid->profile_pic}}"
                                                                                                    class="img-responsive" />
                                                                                                @endif
                                                                                                <div class="usenamwe">
                                                                                                    <h4>
                                                                                                        @if($myadoption->profile_pic)
                                                                                                        <a
                                                                                                            href="{{ url('userprofile')}}/{{base64_encode($myadoption->user_id)}}">{{$myadoption->userid->display_name_on_pages}}</a>
                                                                                                        @endif
                                                                                                    </h4>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="request-body">
                                                                                @if($myadoption->display_name_on_pages == 1 && $myadoption->matcher_id ==
                                                                                Auth::user()->id)
                                                                                <p class="remaining_time"><b>{{$myadoption->userid->display_name_on_pages}}</b>
                                                                                    successfully adopted a {{$getFamilyRoleMatcherInfo->title}} name
                                                                                    <b>{{$myadoption->matcherid->display_name_on_pages}}</b>. <a
                                                                                        href="{{ url('certificate')}}/{{base64_encode($myadoption->id)}}"
                                                                                        class="btn btn-success">See Certificate</a>
                                                                                </p>
                                                                                @endif
                                                                                @if($myadoption->display_name_on_pages == 1 && $myadoption->user_id ==
                                                                                Auth::user()->id)
                                                                                <p class="remaining_time"><b>{{$myadoption->matcherid->display_name_on_pages}}</b>
                                                                                    was successfully adopted by a {{$getFamilyRoleUserInfo->title}} name
                                                                                    <b>{{$myadoption->userid->display_name_on_pages}}</b>. <a
                                                                                        href="{{ url('certificate')}}/{{base64_encode($myadoption->id)}}"
                                                                                        class="btn btn-success">See Certificate</a>
                                                                                </p>
                                                                                @endif
                                                                            </div>
                                                                            <div class="request-footer">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                                @else
                                                                <h6 class="text-center">You have no Adoptions.</h6>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card-body p-b-0">
                                                        <h5 class="card-title"><span>Dissolved History</span></h5>
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" role="tabpanel">
                                                                @if(count($mydissolvedadoptions) > 0)
                                                                <div class="row maintbrow adoptfsec">
                                                                    @foreach($mydissolvedadoptions as $dissolvedadoption)
                                                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                                                        <div class="request-content">
                                                                            <div class="request-header">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class=" borderline  d-flex justify-content-between">
                                                                                            @php
                                                                                            $getFamilyRoleUserInfo =
                                                                                            FamilyRole::find($dissolvedadoption->trial_family_role);
                                                                                            $getFamilyRoleMatcherInfo =
                                                                                            FamilyRole::find($dissolvedadoption->adoptee_family_role);
                                                                                            @endphp
                                                                                            <div class="userA">
                                                                                                @if($dissolvedadoption->profile_pic)
                                                                                                <img
                                                                                                    src="{{ url('uploads')}}/{{$dissolvedadoption->matcherid->profile_pic}}"
                                                                                                    class="img-responsive" />
                                                                                                @endif
                                                                                                <div class="usenamwe">
                                                                                                    <h4>
                                                                                                        @if($dissolvedadoption->profile_pic)
                                                                                                        <a
                                                                                                            href="{{ url('userprofile')}}/{{base64_encode($dissolvedadoption->matcher_id)}}">{{$dissolvedadoption->matcherid->display_name_on_pages}}</a>
                                                                                                        @endif
                                                                                                    </h4>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="midleinfouser">
                                                                                                <div class="arw"></div>
                                                                                                <div class="midltxtlft">
                                                                                                    @if($dissolvedadoption->matcher_id)
                                                                                                    <span>{{$getFamilyRoleMatcherInfo->title}}</span>
                                                                                                    @endif
                                                                                                </div>
                                                                                                <div class="midltxtrgt">
                                                                                                    @if($dissolvedadoption->user_id)
                                                                                                    <span>{{$getFamilyRoleUserInfo->title}}</span>
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="userB">
                                                                                                @if($dissolvedadoption->user_id)
                                                                                                <img src="{{ url('uploads')}}/{{$dissolvedadoption->userid->profile_pic}}"
                                                                                                    class="img-responsive" />
                                                                                                @endif
                                                                                                <div class="usenamwe">
                                                                                                    <h4>
                                                                                                        @if($dissolvedadoption->user_id)
                                                                                                        <a
                                                                                                            href="{{ url('userprofile')}}/{{base64_encode($dissolvedadoption->user_id)}}">{{$dissolvedadoption->userid->display_name_on_pages}}</a>
                                                                                                        @endif
                                                                                                    </h4>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- <gender code having error> -->
                                                                            <div class="request-body">
                                                                                @if($dissolvedadoption->adopt_is_dissolve == 1 && $dissolvedadoption->matcher_id
                                                                                == $dissolvedadoption->adopt_dissolve_by)
                                                                                <p class="remaining_time">
                                                                                    <b>{{@$dissolvedadoption->matcherid->display_name_on_pages}}</b> dissolved
                                                                                    {{@$adopteeAttrGen}} adoption with
                                                                                    <b>{{@$dissolvedadoption->userid->display_name_on_pages}}</b>. {{@$adopteeAttr}}
                                                                                    is no longer <b>{{@$dissolvedadoption->userid->display_name_on_pages}}'s</b>
                                                                                    {{$getFamilyRoleMatcherInfo->title}}.
                                                                                </p>
                                                                                @endif
                                                                                @if($dissolvedadoption->adopt_is_dissolve == 1 && $dissolvedadoption->user_id ==
                                                                                $dissolvedadoption->adopt_dissolve_by)
                                                                                <p class="remaining_time">
                                                                                    <b>{{@$dissolvedadoption->userid->display_name_on_pages}}</b> dissolved
                                                                                    {{@$adopterAttrGen}} adoption with
                                                                                    <b>{{@$dissolvedadoption->macherid->display_name_on_pages}}</b>.
                                                                                    {{@$adopterAtt}} is no longer
                                                                                    <b>{{@$dissolvedadoption->matcherid->display_name_on_pages}}'s</b>
                                                                                    {{$getFamilyRoleUserInfo->title}}.
                                                                                </p>
                                                                                @endif
                                                                            </div>
                                                                            <div class="request-footer">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                                @else
                                                                <h6 class="text-center">You have no Dissolve adoptions.</h6>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  end-->
                                        <div class="tab-pane fade in" id="profile_third">
                                            @if(count($questionnary)>0)
                                            <h3 class="font28">Match Quest Settings</h3>
                                            <div class="padding60">
                                                <form action="{{route('update.answer',$user->id)}}" method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{ $user->id }}" name="user_id">
                                                    <input type="hidden" value="{{ $groupid }}" name="group_id">
                                                    @if($useranswer)
                                                    @php
                                                    $answerarray = json_decode($useranswer->answer_data,true);
                                                    @endphp
                                                    @endif
                                                    @foreach ($questionnary as $question)
                                                    <div class="row mb">
                                                        <div class="col-md-4 col-sm-4">
                                                            <label>
                                                                <p>{{ $question->question_title }} </p>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8 col-sm-8">
                                                            @switch($question->question_type)
                                                            @case(1)
                                                            <input type="text" class="border_radius" name="answers[{{ $question->id }}][]"
                                                                value="{{ @$answerarray[$question->id][0] }}">
                                                            @break
                                                            @case(2)
                                                            @php
                                                            $options = json_decode($question->question_data);
                                                            @endphp
                                                            <select name="answers[{{ $question->id }}][]" class="border_radius">
                                                                @if($options)
                                                                @foreach ($options->options as $option)
                                                                @if($useranswer)
                                                                <option value="{{ $option }}" @if(@$answerarray[$question->id][0]==$option ) selected
                                                                @endif >{{ $option }}</option>
                                                                @else
                                                                <option value="{{ $option }}">{{ $option }}</option>
                                                                @endif
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                            @break
                                                            @case(3)
                                                            @php
                                                            $options = json_decode($question->question_data);
                                                            $seloptions = @$answerarray[$question->id];
                                                            @endphp
                                                            @if(@$options)
                                                            @foreach ($options->options as $option)
                                                            @php
                                                            $sel = "";
                                                            @endphp
                                                            @if($useranswer)
                                                            @if($seloptions)
                                                            @if( in_array($option, $seloptions ) )
                                                            @php
                                                            $sel = "checked='checked'";
                                                            @endphp
                                                            @endif
                                                            @endif
                                                            @endif
                                                            <input type="checkbox" {{ $sel }} value="{{ $option }}"
                                                            name="answers[{{ $question->id }}][{{$loop->iteration}}]">{{ $option }}
                                                            @endforeach
                                                            @endif
                                                            @break
                                                            @default
                                                            <textarea
                                                                name="answers[{{ $question->id }}][]">{{ @$answerarray[$question->id][0] }}</textarea>
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    <div class="row mtopbottom">
                                                        <div class="col-md-4">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <button type="text" placeholder=""
                                                                class="btnpad bgred pull-right border_radius">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div>
                                        <!--<h3 class="font28">Photo Album</h3>
                                            @if( isthisSubscribed() )
                                            <button type="button" class="btnpad btnred mtop70" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></button>
                                            <div class="modal fade" id="myModal" role="dialog">
                                               <div class="modal-dialog">
                                                   <div class="modal-content">
                                                       <div class="modal-header">
                                                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                           <h4 class="modal-title font22">PHOTO UPLOAD</h4>
                                                       </div>
                                                       <div class="modal-body">
                                                           <p class="text-center">You may upload 3 photos with your membership plan. Do not upload photos containing texts, nudity, nor 1st Life. Doing so will result in delayed registration, account restriction or termination. For more information, please see our <a href="#" data-toggle="modal" data-target="#termsPopup">Terms</a> and <a href="#" data-toggle="modal" data-target="#policyPopup">Policy.</a></p>
                                                           <div class="error_sec"></div>
                                                           <h5 class="mtop20 font16">Upload multiple images for Photos Album</h5>
                                                           {!! Form::open([ 'route' => [ 'dropzone.uploadfile' ], 'files' => true, 'class' => 'dropzone','id'=>"image-upload"]) !!}
                                                           {!! Form::close() !!}
                                                       </div>
                                                   </div>
                                               </div>
                                            </div>
                                            
                                            <div class="padding60  text-center">
                                               <h4 class="mb30">Upload multiple images for Photo Album</h4>
                                               <div class="grid">
                                                   <div class="grid-sizer"></div>
                                                   @php
                                                   $images = $user->photos;
                                                   @endphp
                                                   @if( $images )
                                                   @foreach($images as $row)
                                                   <div class="grid-item">
                                                       <a href="javascript:void(0)" class="deleteProduct" data-id="{{ $row->id }}" data-token="{{ csrf_token() }}" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            
                                                       <img src="{{ asset('/uploads/'.$row->image)}}" />
                                                   </div>
                                                   @endforeach
                                                   @endif
                                               </div>
                                            </div>
                                            @else
                                            <div class="row upgrade">
                                               <div class="col-md-8">
                                                   <div class="upgdinfo bggray font300">
                                                       <p>Hey {{ ucfirst( Auth::user()->name ) }}!.  Upgrade your membership today to experience unlimited upload photo.</p>
                                                   </div>
                                               </div>
                                               <div class="col-md-4">
                                                   <a style="padding: 18px 0px;" href="{{ url('pricing') }}" class="btn btnred width100">Upgrade Membership</a>
                                               </div>
                                            </div>
                                            @endif -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                    </div>
                    <!-- Row -->
                    <!-- ==================================================================================================================================================== -->
                    <!-- End PAge Content -->
                </div>
            </div>
        </div>
    </div>
    <!--- profile pic Modal -->
    <div class="modal fade" id="myModales" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content text-center">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title font22">Upload Pic</h4>
                </div>
                <form action="{{ route('profile.picture') }}" method="post" enctype="multipart/form-data"
                    class=".profile-header-img">
                    <div class="modal-body">
                        <div class="profile-header-img">
                            <img class="rounded-circle" id="profile-img-tag"
                                src="{{ ( $user->profile_pic )? url('/uploads/'.$user->profile_pic) : url('images/default.png') }}"
                                alt="Image" />
                            <!-- badge -->
                        </div>
                        @csrf
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp"
                                required>
                            <div class="uploadicon">
                                <i class="fa fa-upload" aria-hidden="true"></i>
                                <h2>Upload</h2>
                            </div>
                            <!--small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btnpad btnred border0 border_radius">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="usernameChange_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Buy Username</h4>
                </div>
                <div class="modal-body usernameChange_modal-body">
                    <p class="text-center">${{$usernameChangeAmount}}</p>
                    <button class="btn btn-success text-center" id="buyUsername_btn">Buy Now</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- model for change user group --}}
    <div class="modal fade" id="user_grpup_modal" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">User Group Change</h4>
                </div>
                <form class="form-horizontal form-material" action="javascript:void(0)" method="post" id="changegroup">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <input type="hidden" name="existgroup" value="{{$user->group}}">
                    <div class="modal-body">
                        <h5><strong>Hey {{ Auth::user()->name }}! Chaning your Group comes with a few required changes</strong></h5>
                        <br>
                        <div class="row mb">
                            <div class="col-md-4 col-sm-4"><label for="user_group"><b>User Groups<span
                                class="text-danger">*</span></b></label></div>
                            <div class="col-md-8 col-sm-4">
                                {{-- <select class="form-control changeUserGroup" id="user_group_new" name="user_group" required="required"> --}}
                                <select class="form-control changeUserGroup" id="user_group_new"
                                    onchange="getGenderInfo(this.value,{{ $user->gender }})" name="user_group" required="required">
                                @if( $grouprole )
                                @foreach( $grouprole as $row )
                                <option class="user_group_value_{{ $row->id }}" value="{{ $row->id }}" data-min="{{ $row->minage }}"
                                data-max="{{ $row->maxage }}" {{ $row->id == $user->group ? 'selected="selected"' : '' }}>
                                <?php echo $row->title ?></option>
                                @endforeach
                                @endif
                                </select>
                            </div>
                        </div>
                        <div class="row mb">
                            <div class="col-md-4 col-sm-4"><label for="user_age"><b>Age <span class="text-danger">*</span></b></label>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <select class="form-control" id="user_age_new" name="age" required="required">
                                </select>
                            </div>
                        </div>
                        {{-- 
                        <div class="row mb">
                            <div class="col-md-4 col-sm-4"><label for="user_age"><b>Age <span class="text-danger">*</span></b></label>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <select class="form-control" id="user_age" name="age" required="required">
                                @for( $i = $groupInfo->minage; $i<=$groupInfo->maxage; $i++)
                                <option value="{{ $i }}" {{ $i == $user->age ? 'selected="selected"' : '' }}>{{ $i }}</option>
                                @endfor
                                </select>
                            </div>
                        </div>
                        --}}
                        {{-- 
                        <div class="row mb">
                            <div class="col-md-4 col-sm-4"><label for="user_age"><b>Age <span class="text-danger">*</span></b></label></div>
                            <div class="col-md-8 col-sm-8">
                                <select class="form-control" id="user_age"  name="age" required="required" >
                                @for( $i = $groupInfo->minage; $i<=$groupInfo->maxage; $i++)
                                <option value="{{ $i }}" {{ $i == $user->age ? 'selected="selected"' : '' }}>{{ $i }}</option>
                                @endfor
                                </select>
                            </div>
                        </div>
                        --}}
                        @php
                        $familrole=json_decode($groupInfo->family_roles);
                    //    echo '<pre>'; print_r($familyRoles);die;
                        @endphp
                        <div class="row mb">
                            <div class="col-md-4 col-sm-4"><label for="user_familyroleopoup"><b>Family Role <span
                                class="text-danger">*</span></b></label></div>
                            <div class="col-md-8 col-sm-8">
                                <select class="form-control" id="user_familyroleopoup" name="family_role[]" required="required" multiple>
                                    <option value="">Select Family Role<span class="text-danger">*</span></option>
                                    @forelse($familyRoles as $role)
                                    @if(!empty($user_Selected_geneder))
                                        @if($role->gender == $user_Selected_geneder)
                                        <option name="role" value="{{$role->id}}" >
                                            {{$role->title}}
                                        </option>
                                        @endif

                                    @endif
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="changeusergroup" value="changegroup">
                        <input type="submit" id="changeusergroup" class="btn btn-success pull-right" value="Change">
                        <br><br>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
@section('footer')
<script src="{{ URL::asset('new-assets/common/js/common.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.js"></script>
<script src="{{ asset('backend/js/profile.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontendnew/js/gallery_slider.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('new-assets/common/plugins/croppie/croppie.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new-assets/common/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}"
    type="text/javascript"></script>
<script src="{{ URL::asset('new-assets/common/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{ URL::asset('new-assets/frontend/js/upload_crop_image.js')}}" type="text/javascript"></script>
<script>
    var account_setup_profile_image_by_string_submit_url=  "{{ route('profile.uploadprofile') }}";
      var account_setup_step_2_submit_url='{{url('/account-setup/profile-info')}}';
      var csrf_token ='{{ csrf_token() }}';
      var image_folder_url='{{ asset('/uploads') }}';
      var home_url='{{url('/home')}}';
</script>
<script type="text/javascript">
    function getAge(){
        var id = $('#user_group_new').val();
        var min = $('#user_group_new').find('.user_group_value_'+id).attr('data-min');
        var max = $('#user_group_new').find('.user_group_value_'+id).attr('data-max');
        $('#user_age_new').find('option').remove();
        do {
            $('#user_age_new').append('<option value='+min+'>'+min+'</option>');
            min++
        } while (min <= max);
        if(max <= 12){
           $('#child').show();
           $('#adult').hide();
        }else{
           $('#child').hide();
           $('#adult').show();
        }
    }
    $(document).ready(function(){
      getAge();
      $('#user_group_new').on('change',function(){
        getAge();
        $('#user_group').val($('#user_group_new').val());
      })
      $('#user_age_new').on('change',function(){
        $('#user_age').val($('#user_age_new').val());
      })
      $('.child_gender').on('click',function(){
        $('#user_gender').val($(this).val());
        $('#userGender').val($(this).val());
      })
      $('.adult_gender').on('click',function(){
        $('#user_gender').val($(this).val());
        $('#userGender').val($(this).val());
      })
    
    $(".deleteProduct").click(function(){
      var nowclass = $(this).parents('.grid-item');
          var id = $(this).attr("data-id");
          var token = $(this).attr("data-token");
          $.ajax(
          {
              url: "album/delete/"+id,
              method: 'post',
              dataType: "JSON",
              data: {
                  "id": id,
                  "_token": token
              },
              success: function ()
              {
                  console.log("It works");
                  nowclass.remove();
              }
          });
    
      });

    
      $(".verifyRequest").click(function(){
              var nowclass = $(this).parents('.grid-item');
              var id = $(this).attr("data-id");
              var token = $(this).attr("data-token");
              $.ajax(
              {
                  url: "verifyRequest/"+id,
                  method: 'post',
                  dataType: "JSON",
                  data: {
                      "id": id,
                      "_token": token
                  },
                  success: function (data)
                  {
                    if(data.status === true){
                      console.log("It sent");
                      $('.verifyRequest').html('Request Sent');
                      nowclass.remove();
                    }else{
                      $('#errormsg').html(data.msg);
                      $('#errormsg').show();
                      $('#errormsg').css({'color':'red','font-size':'14px','padding':'5px'});
                      $('#matchQuestHere').show();
                    }
                  }
              });
    
          });
    
      function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
    
              reader.onload = function (e) {
                  $('#profile-img-tag').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
          }
      }
      $("#avatarFile").change(function(){
          readURL(this);
      });
    });
    
    $('#changeusergroup').click(function(e){
     e.preventDefault();
     /*Ajax Request Header setup*/
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
     /* Submit form data using ajax*/
     $.ajax({
        url: "{{route('profile.update',$user->id)}}",
        method: 'post',
        data: $('#changegroup').serialize(),
        success: function(data){
            if(data.massege == 'checkout'){
              setTimeout(function(){ alert("You need add more token ")}, 100);
              window.location = '/wallet';
            }
    
          else{
            $('#changedvalue').val(data.existgroup);
          $('#user_grpup_modal').modal('hide');
          setTimeout(function(){ alert("You have changed User Group so you need to answer new questionnaire")}, 500);
          }
          
          // location.reload();
           //------------------------
              /*$('#send_form').html('Submit');
              $('#res_message').show();
              $('#res_message').html(response.msg);
              $('#msg_div').removeClass('d-none');
    
              document.getElementById("contact_us").reset();
              setTimeout(function(){
              $('#res_message').hide();
              $('#msg_div').hide();
              },10000);*/
           //--------------------------
        }});
    
     });
    
    var $grid = $('.grid').isotope({
    itemSelector: '.grid-item',
    columnWidth: 160,
    gutter: 20,
    percentPosition: true,
    masonry: {
      columnWidth: '.grid-sizer'
    }
    });
</script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> -->
<script>

     function fnCheckForRestrictedWords() {  

            var restrictedWords =  [<?php echo '"'.strtolower(implode('","', $getWords)).'"' ?>] ;
            console.log(restrictedWords);

            var txtInput = document.getElementById("message").value;  
            var error = 0;  
            for (var i = 0; i < restrictedWords.length; i++) {  
                var val = restrictedWords[i];  
                if ((txtInput.toLowerCase()).indexOf(val.toString()) > -1) {  
                    error = error + 1;      
                }  
            }  
  
            if (error > 0) {  
             var rgx = new RegExp("("+restrictedWords.join("|")+")", "gi");
             console.log(rgx);
            message.value = message.value.replace(rgx, "****");
                    }  
            else {  
                // Your logic here  
            }  
        } 
    $(document).ready(function() {
    
        var field = document.getElementById('message');
        var countfield = document.getElementById('counter');
        countfield.value = 400 - field.value.length;
    
        $(".btn-pref .btn").click(function () {
            $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
            // $(".tab").addClass("active"); // instead of this do the below
            $(this).removeClass("btn-default").addClass("btn-primary");
        });
      });
    
      function textCounter(field,field2,maxlimit)
      {
       var countfield = document.getElementById(field2);
       if ( field.value.length > maxlimit ) {
        field.value = field.value.substring( 0, maxlimit );
        return false;
       } else {
        countfield.value = maxlimit - field.value.length;
       }
      }
      $('#user_familyroleopoup').select2({
          dropdownParent: $('#user_grpup_modal')
      });
    
      $('.huds').select2({
          placeholder: 'Select HUDs',
          multiple: true
      });
    
      $(".huds").on("select2:close", function (e) {
          $(this).valid();
      });
      var familyRolesMale = [];
      var familyRolesFemale = [];
      var group_familiy_roles = [];

      @foreach($familyRoles as $family_role)
          @if($family_role->gender == "male")
            var male_role = {
                "id": "{{ $family_role->id }}",
                "title": "{{ $family_role->title }}",
            };
            familyRolesMale.push(male_role);
          @else
            var male_role = {
                "id": "{{ $family_role->id }}",
                "title": "{{ $family_role->title }}",
            };
            familyRolesFemale.push(male_role);
          @endif
      @endforeach
      @php
        $group_familiy_roles = json_decode($groupInfo->family_roles);
      @endphp
      @if(count($group_familiy_roles) > 0)
      @foreach($group_familiy_roles as $row)
        group_familiy_roles.push("{{ $row }}");
      @endforeach
      @endif
      var GenderRoles_sorted = {};
      @if(count($GenderRoles) > 0)
      @foreach($GenderRoles as $key_value => $role_value)
        GenderRoles_sorted["{{ $key_value }}"] = "{{ $role_value }}";
      @endforeach
      @endif

      $("#genderInfodisplay input[type=radio][name=gender]").change(function (){
        $("#user_familyrole, #user_familyroleopoup").select2('destroy').html("");
        if(GenderRoles_sorted[$(this).attr("title")] == "male" || GenderRoles_sorted[$(this).attr("title")] == "Male"){
            for(let i = 0; i < familyRolesMale.length; i++){
                var newOptions = '<option value="'+familyRolesMale[i].id+'">'+familyRolesMale[i].title+'</option>';
                $("#user_familyrole").append(newOptions);
            }
            for(let i = 0; i < familyRolesMale.length; i++){
                if(group_familiy_roles.includes(familyRolesMale[i].id)){
                    var newOptions = '<option value="'+familyRolesMale[i].id+'">'+familyRolesMale[i].title+'</option>';
                    $("#user_familyroleopoup").append(newOptions);
                }
            }
            $('#user_familyrole, #user_familyroleopoup').select2({
                placeholder: 'Select Family Role',
                multiple: true
            });
        }else{
            for(let i = 0; i < familyRolesFemale.length; i++){
                var newOptions = '<option value="'+familyRolesFemale[i].id+'">'+familyRolesFemale[i].title+'</option>';
                $("#user_familyrole").append(newOptions);
            }
            for(let i = 0; i < familyRolesFemale.length; i++){
                if(group_familiy_roles.includes(familyRolesFemale[i].id)){
                    var newOptions = '<option value="'+familyRolesFemale[i].id+'">'+familyRolesFemale[i].title+'</option>';
                    $("#user_familyroleopoup").append(newOptions);
                }
            }
            $('#user_familyrole, #user_familyroleopoup').select2({
                placeholder: 'Select Family Role',
                multiple: true
            });
        }
      });
</script>
@endsection