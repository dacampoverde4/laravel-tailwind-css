@extends('v7.frontend')

@section('page_level_styles')
    <link href="{{ URL::asset('new-assets/common/plugins/croppie/croppie.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('new-assets/common/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('new-assets/common/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{ URL::asset('new-assets/frontend/css/account-setup-step2.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('new-assets/frontend/css/account-setup-profile-image.css')}}" rel="stylesheet" type="text/css" />
    <style>
    #terms_and_policy {
    	display: table;
    	margin: 7px auto 0;
    }
    #termsPopup .modal-body,#policyPopup .modal-body {
    	max-height: 400px;
    	overflow-y: scroll;
    }
    #termsPopup .modal-body p,#policyPopup .modal-body p {
    	text-align: left;
    	padding: 0;
    }
    #counter {
        font-size: small;
        width: 30px;
    }
    #pride_friendly ,#relationships, #occupations{
      margin-top: 65px;
    }
    </style>
@stop
@section('content')
    <div class="ac_setup">
        <h1>ACCOUNT SETUP</h1>
    </div>
    <div class="container">
        <div class="mid_sec">
            <p>We're happy that you've made it to step 2 with no lag! Finally, we'll get to know you better... </p>
            <ul>
                <li>
                    <span class="">1</span>
                    <p> Account Info</p>
                </li>
                <li>
                    <span class="spn2 spn1">2 </span>
                    <p>Profile Info</p>
                </li>
                <!--<li>
                    <span>3 </span>
                    <p>Seeking</p>
                </li>-->
            </ul>
        </div>
        <form id="frm_account_setup_step2" name="frm_account_setup_step2" class="frm_account_setup_step2" action="{{url('account-setup/profile-info')}}" method="post">
            {!! csrf_field() !!}
            <input type="hidden" name="hdn_image_uploaded" id="hdn_image_uploaded" value="{{$user?($user->profile_pic?'1':'0'):'0'}}">
            <div class="center_sec">
                <h1>Profile Photo Upload<span class="star">*</span></h1>
                <p>Upload your profile picture directly from your device. <br>You may upload even more photos after you complete your account setup.</p>
                <div class="contct_sec ">
                    <div class="row ">
                        <div class="col-md-4">
                            <div class=" left_sec  ">
                                <div class="img_dv profile_image_display_container">
                                    <img src="{{$user?($user->profile_pic?asset('/uploads').'/'.$user->profile_pic:asset('/images/default.png')):asset('/images/default.png')}}" class="width-100" alt="pic">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class=" left_sec sme_sec">
                                <div class="upload_dv ">
                                    <button type="button" class="btn  btn-primary" id="btn_open_modal_upload_profile_image"> Upload Image </button>
                                    <br><span><font color="red">No Text | No Nudity | No 1st Life</font></span>
                                    <p style=" text-align: center;
                                    max-width: 575px;
                                    margin: 0 auto;
                                    font-size: 17px;">
                                        <i>
                                            Do not upload photos containing texts, nudity, nor 1st Life. Doing so will result in delayed registration, account
                                            restriction or termination. For more information, please see our Terms and Policy
                                        </i>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="nw_about_sec">
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="lvl_sec">
                                <h1>About <span class="star">*</span></h1>
                                <p>
                                    <i>
                                        This is all about you! Besides, only you can tell your story the way it should be told; so make this one count ;)
                                    </i>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="rvl_sec">
                                <textarea name="about" onkeyup="textCounter(this,'counter',400);" id="txtarea_about" rows="4" cols="50">{{$user?($user->about_me?$user->about_me:''):''}}</textarea>
                                <input disabled maxlength="400" size="400" value="400" id="counter">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nw_about_sec">
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="lvl_sec">
                                <h1>Pride Friendly <span class="star">*</span></h1>
                                <p>
                                    <i>
                                        Pride-friendly means being open and welcoming of the LGBTQ community.
                                    </i>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input_group account_setup_pride_friendly_cont">
                              <select name="pride_friendly" id="pride_friendly">
                                  @if($user)
                                      @if($user->pride_friendly !='')
                                            <option value="1" <?php if($user->pride_friendly == 1) {?> selected <?php } ?> >Yes</option>
                                            <option value="0" <?php if($user->pride_friendly == 0) {?> selected <?php } ?>>No</option>
                                      @else
                                          <option value="">Select Option</option>
                                          <option value="1">Yes</option>
                                          <option value="0">No</option>
                                      @endif
                                  @else
                                      <option value=""></option>
                                  @endif
                              </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                          <img alt="Pride Friendly" height="100" width="100" src="{{ asset('images/rainbow.png') }}" class="" />
                        </div>
                    </div>
                </div>
                @if($selUserGroup->visible_relationship == 1 && isset($selRelationships))
                <div class="nw_about_sec">
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="lvl_sec">
                                <h1>Relationship Status <span class="star">*</span></h1>
                                <p>
                                    <i>
                                      Select the RELATIONSHIP STATUS that you actively use in your Second Life roleplay.
                                    </i>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-8 input_group account_setup_pride_friendly_cont">
                            <select name="relationships" id="relationships">
                            <option  value="" style="text-transform: capitalize;">Select Relationship</option>
                            
                                @foreach($selRelationships as $rows)
                                    @php
                                        $sel = '';
                                        
                                        if( $rows->id == $user->relationship ) {
                                            $sel = "selected='selected'";
                                        }
                    
                                    @endphp
                                    <option {{ $sel }} value="{{ $rows->id }}" style="text-transform: capitalize;"><?php echo $rows->title ?></option>
                                @endforeach
                            
                            </select>
                        </div>
                    </div>
                </div>
                @endif
                @if($selUserGroup->visible_occupation == 1 && isset($selOccupations))
                <div class="nw_about_sec">
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="lvl_sec">
                                <h1>Occupation <span class="star">*</span></h1>
                                <p>
                                    <i>
                                      Select the OCCUPATION that you actively use in your Second Life roleplay.
                                    </i>
                                </p>
                            </div>
                        </div>
                       
                        <div class="col-md-8 input_group account_setup_pride_friendly_cont">
                            <select name="occupations" id="occupations" >
                            <option  value="" style="text-transform: capitalize;">Select Occupation</option>
                                @foreach($selOccupations as $rows)
                                    @php
                                        $sel = '';
                                        
                                        if( $rows->id == $user->occupation ) {
                                            $sel = "selected='selected'";
                                        }
                    
                                    @endphp
                                    <option {{ $sel }} value="{{ $rows->id }}" style="text-transform: capitalize;"><?php echo $rows->title ?></option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                @endif
                <div class="nw_about_sec">
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="lvl_sec">
                                <h1>HUDs <span class="star">*</span></h1>
                                <p>
                                    <i>
                                      Select the Huds that you actively use in your Second Life roleplay.
                                    </i>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="input_group account_setup_huds">
                              <select name="huds[]" id="huds" multiple class="huds">
                                @if($user)
                                 @if($user->Huds)
                                  @if(!empty($huds))
                                        @if(count($huds)>0)
                                          @foreach($huds as $row)
                                           @php
                                             $sel = '';
                                             $get_huds =( $user->huds )? json_decode( $user->huds ) : array();
                                                if( $get_huds ){
                                                  if( in_array($row->id, $get_huds ) ){
                                                      $sel = "selected='selected'";
                                                    }
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
                                      @else
                                      @if(count($huds)>0)
                                      <option value="">Select HUDs</option>
                                        @foreach($huds as $row)
                                         @php
                                           $sel = '';
                                           $get_huds =( $user->huds )? json_decode( $user->huds ) : array();
                                              if( $get_huds ){
                                                if( in_array($row->id, $get_huds ) ){
                                                    $sel = "selected='selected'";
                                                  }
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
                                  @endif
                              </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nw_about_sec">
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="lvl_sec">
                                <h1>My Fun ( Tag Along ) <span class="star">*</span></h1>
                                <p><i>Add relevant tags of things that you find exciting and indulge in regularly.</i></p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <!--<div class="enter_sec">
                                 <ul>
                                    <li>gaming</li>
                                    <li>reading</li>
                                    <li>shoping</li>
                                    <li>watching tv</li>
                                    <li>eating</li>
                                    <li>gaming</li>
                                </ul>
                            </div>-->
                            <select name="my_funs[]" class="my_funs" multiple>
                                @foreach($my_funs as $rows)
                                    @php
                                    $selected = '';
                                    if($user)
                                    {
                                        $funs = ( $user->myfuns )? json_decode( $user->myfuns ) : array();
                                        if($funs){
                                            if( in_array($rows->id, $funs ) ){
                                                $selected = "selected='selected'";
                                            }
                                        }
                                    }
                                    @endphp
                                    <option {{ $selected }} value="{{ $rows->id }}" ><?php echo $rows->title ?></option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Terms & Conditions -->
                <div class="nw_about_sec">
                    <div class="row ">

                        <div class="col-md-12 lvl_sec">
                          <div class="col-md-1">
                            @if($user->agree == 1)
                              <input type="checkbox" id="agree"  name="agree"  checked>
                              @else
                              <input type="checkbox" id="agree"  name="agree">
                              @endif
                          </div>
                          <div class="col-md-11">
                                    <p>I have read and agree to the <a href="#" data-toggle="modal" data-target="#termsPopup">Terms</a> and <a href="#" data-toggle="modal" data-target="#policyPopup">Privacy
                                        Policy.</a></p>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="alert alert-danger frm_account_setup_step2_error_msg" style="display:none;">
                    <button type="button" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="has-error"></div>
                </div>
                <div class="frm_account_setup_step2_submit_msg"></div>
                <div align="right">
                    <align>
                        <span class="pre_btn_sec">
                            <a href="{{route('account-setup')}}" class="btn btn-primary">PREVIOUS</a>
                        </span>
                        <span class="nxt_btn_sec">
                            <button  class="btn btn-primary btn_account_setup_next">SUBMIT</button>
                        </span>
                    </align>
                </div>
            </div>
        </form>
        <div class="modal fade" id="modal_upload_profile_image" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Upload Image</h4>
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
                            <div class="col-md-5 col-sm-5 col-lg-5 col-xs-12 text-center">
                                <div id="profile_image_crop_container" style=""></div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-lg-2 col-xs-6">
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
                            <div class="col-md-5 col-sm-5 col-lg-5 col-xs-12">
                                <div id="profile_image_preview_container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--- terms & Polocy popup -->
<!-- term Modal -->
<div id="termsPopup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Terms</h4>
      </div>
      <div class="modal-body">

          {!!$termContent?$termContent->content:'Content Here'  !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Policy Modal -->
<div id="policyPopup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Privacy Policy</h4>
      </div>
      <div class="modal-body">

          {!!$policyContent?$policyContent->content:'Content Here'  !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@endsection
@section('page_level_scripts')
    <script src="{{ URL::asset('new-assets/common/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new-assets/common/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new-assets/common/plugins/jquery-form/jquery.form.min.js')}}" type="text/javascript" ></script>
    <script src="{{ URL::asset('new-assets/common/plugins/croppie/croppie.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new-assets/common/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new-assets/common/plugins/select2/js/select2.min.js')}}"></script>
    <script>
        var account_setup_profile_image_by_string_submit_url='{{url('account-setup/profile-image-by-string')}}';
        var account_setup_step_2_submit_url='{{url('/account-setup/profile-info')}}';
        var csrf_token ='{{ csrf_token() }}';
        var image_folder_url='{{ asset('/uploads') }}';
        var home_url='{{url('/home')}}';

    </script>
    <script src="{{ URL::asset('new-assets/common/js/common.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new-assets/frontend/js/account-setup-profile-image.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new-assets/frontend/js/account-setup-step2.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {

            var field = document.getElementById('txtarea_about');
            var countfield = document.getElementById('counter');
            countfield.value = 400 - field.value.length;

            $('.my_funs').select2({
                placeholder: 'Select Funs',
                multiple: true
            });

            $(".my_funs").on("select2:close", function (e) {
                $(this).valid();
            });

            $('.huds').select2({
                placeholder: 'Select HUDs',
                multiple: true
            });

            $(".huds").on("select2:close", function (e) {
                $(this).valid();
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

    </script>
@endsection
