@extends('layouts.master')
@section('htmlheader')
<link href="http://demo.expertphp.in/css/dropzone.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<script src="http://demo.expertphp.in/js/dropzone.js"></script>
<script src="{{ asset('backend/js/profile.js') }}" type="text/javascript"></script>
@endsection
@section('main-content')
<div class="maincontent backend">

<div class="content">
<div class="profile_edit">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
               <div class="profile-tab">

                        <!-- flight section -->

                        <div class="profile-tab-content active padding40">
                            <h3 class="font28">Account Setting</h3>
                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
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
                            <form class="form-horizontal form-material" action="{{route('updateaccount.setting',$user->id)}}" id="changeUsernameForm" method="post">
                                @csrf
                              <div class="form-group">

                                  <div class="col-md-12 col-sm-12"><label><b>Username</b></label></div>

                                  <div class="col-md-12 col-sm-12">
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

                                    <div class="pull-right updateUsername_Icon">
                                        <button type="submit" name="action_submit" value="action_submitUsername" class="btn btn-success bgred border_radius"><i class="fa fa-edit"></i></button>
                                    </div>
                                  </div>
                            </div>
                          </form>

                            <form action="{{route('updateaccount.setting', $user->id )}}" method="post">
                                @csrf
                                <div class="padding60">
                                  <div class="row">
                                    <div class="col-md-6 mb">
                                        <div class="col-md-4 col-sm-4"><label>Email Address</label></div>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="email" name="user_email" value="{{ @$user->user_email ? : ''}}" class="border_radius ">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb">
                                        <div class="col-md-4 col-sm-4"><label>Username</label></div>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="email" name="email" value="{{ $user->email }}" class="border_radius ">
                                        </div>
                                    </div>
                                  </div>
                                    <div class="row mb">
                                        <div class="col-md-4 col-sm-4"><label>Password</label></div>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="Checkbox" id="generatepassword"> New Password
                                            <div id="inputpassword"></div>
                                        </div>
                                    </div>

                                    <div class="row mb">
                                        <div class="col-md-4 col-sm-4"><label>Notifications</label></div>
                                        <div class="col-md-8 col-sm-8">
                                            <section class="slider-checkbox">
                                                <input type="checkbox" id="1" value="1" name="notification" @if($user->is_notifications_enable==1) checked @endif/>
                                                <label class="label" for="1">Checkbox 1</label>
                                             </section>
                                        </div>
                                    </div>

                                    <div class="row mb">
                                        <div class="col-md-4 col-sm-4"><label>Make Profile Private</label></div>
                                        <div class="col-md-8 col-sm-8">
                                            <section class="slider-checkbox">
                                                <input type="checkbox" value="1" id="2" name="privacy"  @if($user->is_private==1) checked @endif/>
                                                <label class="label" for="2">Checkbox 1</label>
                                             </section>
                                        </div>
                                    </div>

                                    <div class="row mb">
                                        <div class="col-md-4 col-sm-4"><label>Delete Account</label></div>
                                        <div class="col-md-8 col-sm-8">
                                            <a href="{{ route('profile.permanentdelete') }}" onClick="return confirm('Are your sure you want to delete your account');" class="bgred border_radius" style="padding:0 6px;color:#fff"> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Delete your Account Permanently</a>
                                        </div>
                                    </div>

                                    <button type="text" placeholder="" class="btnpad bgred pull-right border_radius">Update</button>
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
@section('footer')
<script type="text/javascript">

$(document).ready(function(){
    $("#generatepassword").click(function(){
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
