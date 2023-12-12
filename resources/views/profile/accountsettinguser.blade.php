@extends('layouts.master')
@section('htmlheader')

@php 
// exit;
@endphp
<link href="http://demo.expertphp.in/css/dropzone.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

<link href="{{ URL::asset('new-assets/common/plugins/croppie/croppie.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('new-assets/common/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('new-assets/common/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
<link href="{{ URL::asset('new-assets/frontend/css/upload_crop_image.css')}}" rel="stylesheet" type="text/css" />

<script src="http://demo.expertphp.in/js/dropzone.js"></script>
<style>
.editUsername-field{
  float: left;
}
section.slider-checkbox input {
    display: none;
}
.dlt_btn
{
    margin: 1% 10% 1% 0%;
}

.profile_edit {
    margin-top: 2rem;
}
.instru
{
    font-size: 13px;
}
.check_class
{
    display: none;
}
.profileicon {
    position: relative;
    overflow: hidden;
    border-radius: 50%;
}
.profileicon img.profileimg {
    width: 100%;
}
.camerbg {
    background-color: rgba(0,0,0,0.5);
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 0px;
    line-height:42px;
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
.profileimgsec {
    width: 55%;
    margin: 0 auto;
}
.modal-header .close {
    padding: 0;
    margin: 0;
}
button.close {
    font-size: 1.5rem !important;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    opacity: .5;
    background-color: unset !important;
    padding: 20px;
    margin: 0;
}
@media only screen and (max-width: 991px)
{
  .profileimgsec {
    width: 70%;
  }
}
@media only screen and (max-width: 767px)
{
  .col-xs-2 {
    width: 20%;
  }
  .col-xs-10 {
    width: 80%;
  }
}
</style>
@endsection
@section('main-content')
<div class="maincontent backend">

<div class="content">
<div class="profile_edit acc_setting_pg">
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
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="container-fluid">
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> 
                                  <div class="profileimgsec">
                                    <div class="profileicon">
                                      <img src="{{Auth::user()->profile_pic_url}}" class="img-circle profileimg" width="150" />
                                      
                                      <div class="camerbg">
                                        <button type="button" class="btn btn-upload-profile" id="btn_open_modal_upload_profile_image"> <i class="fa fa-camera fa-2x"></i> </button>

                                        <div class="modal fade" id="modal_upload_profile_image" tabindex="-1" role="basic" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Upload Profile</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    
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
                                                                <span class="fileinput-new btn-block">Browse</span>
                                                                <span class="fileinput-exists btn-block">Browse</span>
                                                                    <input type="file" name="..." id="file_profile_image" accept="image/*">
                                                                </span>
                                                            </div>
                                                            <button class="btn btn-info btn_profile_image_preview btn-block" >Preview</button>
                                                            <button class="btn btn-success btn_profile_image_upload btn-block" >Submit</button>
                                                            <button class="btn btn-danger btn_profile_image_cancel btn-block" style="">Cancel</button>
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
                                  </div>
                                    <h4 class="card-title m-t-10">{{ Auth::user()->display_name_on_pages }}</h4>
                                   <!-- <h6 class="card-subtitle">Accoubts Manager Amix corp</h6>-->
                                    <div class="row text-center justify-content-md-center">
                                        <!--<div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">254</font></a></div>
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium">54</font></a></div>-->
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">

                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Account Settings</a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">

                                <!--second tab-->

                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card-body">
                                        @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                    @endif

                                    <form class="form-horizontal form-material" action="{{route('updateaccount.setting',$user->id)}}" id="changeUsernameForm" method="post">
                                        @csrf
                                      <div class="form-group">
                                          <div class="row">
                                            <div class="col-md-12 col-sm-12"><label><b>Username</b></label></div>

                                            <div class="col-xs-10 col-md-10 col-sm-10">
                                            @if( !isthisUserSubscribed(Auth::user()->id) )
                                                    @if( !isthisSubscribed() )
                                                        @php
                                                        $disable = "readonly";
                                                        @endphp
                                                        @endif
                                                    <input type="text" name="name" {{ @$disable }} value="{{$user->displayname}}" class=" form-control form-control-line editUsername-field border_radius {{ $errors->has('name') ? ' has-error' : '' }}" required>
                                                    @if ( $errors->has('name') )
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                        @endif

                                              @else

                                                  @if( !isthisSubscribed() )
                                                       @php
                                                           $disable = "readonly";
                                                       @endphp
                                                 @endif
                                                 <input type="text" name="name" {{ @$disable }} value="{{$user->displayname}}" class=" form-control form-control-line editUsername-field border_radius {{ $errors->has('name') ? ' has-error' : '' }}" required>
                                                 @if ( $errors->has('name') )
                                                       <span class="invalid-feedback">
                                                           <strong>{{ $errors->first('name') }}</strong>
                                                       </span>
                                                 @endif
                                              @endif
                                            </div>

                                            <div class="col-xs-2 col-md-2 col-sm-2">
                                              <div class="pull-right updateUsername_Icon">
                                                  <button type="submit" name="action_submit" value="action_submitUsername" class="btn btn-success bgred border_radius"><i class="fa fa-edit"></i></button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </form>

                                    <form class="form-horizontal form-material" action="{{route('updateaccount.setting', $user->id )}}" method="post">
                                        @csrf
                                          <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-12"><b>Email Address</b></label>
                                                <div class="col-md-12">
                                                    <input type="email" name="user_email" value="{{@$user->user_email ? : ''}}" class="form-control form-control-line">
                                                </div>
                                            </div>
                                          </div>

                                            <div class="form-group">
                                              <div class="row">
                                                <label for="example-email" class="col-md-12"><b>New Password</b></label>
                                                <div class="col-md-12">

												<input placeholder="Enter Your New Password" type="text" name="password" value="" class="form-control form-control-line">
												 <!--section class="slider-checkbox">
                                                    <input type="checkbox" id="generatepassword" class="form-control form-control-line" > New Password
                                                    <div id="inputpassword"></div>
													  </section-->
                                                </div>
                                              </div>
                                            </div>

                                            <div class="form-group">
                                              <div class="row">
                                                <label class="col-md-12"><b>Notifications</b></label>
                                                <div class="col-md-12">

                                                  <input type="checkbox" id="1" value="1" name="notification" class="check_class" @if($user->is_notifications_enable==1) checked @endif/>
                                                  <label class="label" for="1">Checkbox 1</label>
                                                </div>
                                              </div>
                                            </div>

                                            <div class="form-group">
                                              <div class="row">
                                                <label class="col-md-12"><b>Make Profile Private</b></label>
                                                <div class="col-md-12">
                                                    <!--<input type="text" placeholder="123 456 7890" class="form-control form-control-line">-->
                                                        <input type="checkbox" value="1" id="2" class="check_class" name="privacy"  @if($user->is_private==1) checked @endif/>
                                                        <label class="label" for="2">Checkbox 1</label>
                                                </div>
                                              </div>
                                            </div>

                                            <div class="form-group">
                                              <div class="row">
                                                <div class="col-sm-12">
                                                    <button type="text" placeholder=""  class="btn btn-success pull-right sv_btn">Save Settings</button>
                                                </div>
                                              </div>
                                            </div>
                                        </form>

                                        <hr>
                                        <div class="row">
                                              <label class="col-md-12">
                                                        <a href="{{ route('profile.blocked.users') }}" class="bgred border_radius btn btn-danger dlt_btn" > <i class="fa fa-ban" aria-hidden="true"></i> Blocked Users</a>
                                                    <p class="instru"><i>You may unblock the users and block them again if needed.</i></p>
                                                    </label>

                                                <label class="col-md-12">
                                                        <a href="{{ route('profile.delete') }}" onClick="return confirm('Are your sure you want to delete your account');" class="bgred border_radius btn btn-warning dlt_btn" > <i class="fa fa-trash" aria-hidden="true"></i> Deactivate Account</a>
                                                    <p class="instru"><i>You may deactivate your account and reactivate it in the future. All your data will remain on our servers.</i></p>
                                                    </label>
                                                    <label class="col-md-12"><a href="{{ route('profile.permanentdelete') }}" onClick="return confirm('Are your sure you want to delete your account');" class="bgred border_radius btn btn-danger dlt_btn" > <i class="fa fa-trash" aria-hidden="true"></i> Delete your Account Permanently</a>
                                                    <p class="instru"><i>This option will permanently remove all your account's data from our platform. You may  register again in the future, if you so choose.</i></p></label>                                            
                                              </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection
@section('footer')

<script src="{{ URL::asset('new-assets/common/plugins/croppie/croppie.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new-assets/common/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
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
$(document).ready(function(){
    $("#generatepassword").click(function(){
			alert('dfgg');
        if($(this).is(':checked'))

            $('#inputpassword').append('<input placeholder="Enter Your New Password" type="password" name="password" value="" class="border_radius">');
        else
           $('#inputpassword').empty();
    });
});
</script>
<style type="text/css">

.slider-checkbox {
  position: relative;
      width: 170px;
          right: 30px;
}
.slider-checkbox input {
    margin: 0px;
    margin-top: 1px;
    cursor: pointer;
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -moz-opacity: 0;
    -khtml-opacity: 0;
    opacity: 0;
    position: absolute;
    z-index: 1;
    top: 0px;
    left: 0px;
    background: red;
    width: 40px;
    height: 20px;
}
.slider-checkbox input:checked + .label:before {
        background-color: red;
        content: "\f00c";
        padding-left: 6px;
}
.slider-checkbox input:checked + .label:after {
        left: 31px;
}
.slider-checkbox .label {
    position: relative;
    padding-left: 46px;
    text-align:left;
}
.slider-checkbox .label:before, .slider-checkbox .label:after {
      position: absolute;
      -webkit-border-radius: 10px;
      -moz-border-radius: 10px;
      border-radius: 10px;
      transition: background-color 0.3s, left 0.3s;
    }
.slider-checkbox .label:before {
      content: "\f00d";
      color: #fff;
      box-sizing: border-box;
      font-family: 'FontAwesome', sans-serif;
      padding-left: 23px;
      font-size: 12px;
      line-height: 20px;
      background-color: grey;
      left: 0px;
      top: 0px;
      height: 20px;
      width: 50px;
      -webkit-border-radius: 10px;
      -moz-border-radius: 10px;
      border-radius: 10px;
    }
.slider-checkbox .label:after {
      content: "";
      letter-spacing: 20px;
      background: #fff;
      left: 1px;
      top: 1px;
      height: 18px;
      width: 18px;
    }

</style>
@endsection
