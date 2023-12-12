@extends('v7.frontend')

@section('page_level_styles')
    <link href="{{ URL::asset('new-assets/frontend/css/account-setup-step1.css')}}" rel="stylesheet" type="text/css" />
@stop
@section('content')
<style>
.frm_account_setup_submit_msg {
  display: none;
}
</style>
    <div class="ac_setup">
        <h1>ACCOUNT SETUP</h1>
    </div>
    <div class="container">
        <div class="mid_sec">
            @if(session()->has('user_return_for_account_setup') && session()->get('user_return_for_account_setup')==1)
            <p>
                Hey {{$user->first_name}}, we missed you! It's sure nice seeing you again; hopefully this time you'll be able to complete your account setup. There are only 2 steps to join the revolution... Each step is mandatory and information provided will be used solely to match you with the right avatars effectively.
            </p>
            @else
            <p>
                Hey {{$user->first_name}}, thanks for joining Avdopt; now, lets setup your account in 2 easy steps. Each step is mandatory and information provided will be used solely to match you with the right avatars effectively.
            </p>
            @endif
            <ul>
                <li>
                    <span class="spn1">1</span>
                    <p><b>Account Info</b></p>
                </li>
                <li>
                    <span class="spn2">2 </span>
                    <p>Profile Info</p>
                </li>
                <!--<li>
                    <span>3 </span>
                    <p>Seeking</p>
                </li>-->
            </ul>
        </div>
        <form id="frm_account_setup" name="frm_account_setup" class="frm_account_setup" action="{{url('account-setup')}}" method="post">
            {!! csrf_field() !!}
        <div class="center_sec">
            <div class="row">
                <div class="col-md-5">
                    <hr class=hr_sec>
                </div>
                <div class="col-md-2 user_text">
                    <h3 class="user_text">User Group</h3>
                </div>
                <div class="col-md-5">
                    <hr class=hr_sec>
                </div>
            </div>
            <p>Please choose a User Group by activating it below. Your user group is your identity on Avdopt; <br>however, you may change your user group as many times as you like. Learn More </p>
            <div class="row user_group_row">
            @if( $user_groups )
                @foreach( $user_groups as $user_group )
                <div class="col-md-2 {{($loop->first)? ' col-md-offset-1 ':''}}">
                    <div class=" left_sec  ">
                        <div class="img_dv">
                            <img src="{{$user_group->image_full_url}}" class="width-100" alt="pic">
                        </div>
                        <div class="pra_dv">
                            <h1>{{$user_group->title}}</h1>
                            <div class="switch_sec">
                                <label class="switch">
                                    @if($user)
                                        @if($user->group==$user_group->id)
                                            <input type="radio" data-user-group-name="{{$user_group->title}}" name="user_group" class="account_setup_user_group"
                                                   id="user_group_{{$user_group->id}}" value="{{$user_group->id}}"
                                                   checked>
                                        @else
                                            <input type="radio" data-user-group-name="{{$user_group->title}}" name="user_group" class="account_setup_user_group"
                                                   id="user_group_{{$user_group->id}}" value="{{$user_group->id}}"
                                                   unchecked>
                                        @endif
                                    @else
                                        <input type="radio" data-user-group-name="{{$user_group->title}}" name="user_group" class="account_setup_user_group"
                                               id="user_group_{{$user_group->id}}" value="{{$user_group->id}}"
                                               unchecked>
                                    @endif

                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
            </div>
            <div class="row">
                <div class="col-md-12 ">
                    <div class="para_g account_setup_user_group_selected_success_msg">
                        <p>&nbsp;</p>
                    </div>
                </div>
            </div>

            <div class="account_setup_second_sec" >
            <div class="lst_sec ">
                <div class="user_sec ">
                    <div class=" row">
                        <div class="col-md-4">
                            <div class="input_group">
                                <label class="label lbl">Username: <span class="star">*</span></label>
                            </div>
                            <div>
                            

                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="input_group">
                                <input type="text" name="user_name" id="user_name" class="account_setup_user_name" value="{{$user?$user->displayname:''}}">
                                <input type="hidden" name="user_name_check_value" id="user_name_check_value" value="{{$user?($user->displayname?'2':'1'):'0'}}">
                                <div class="account_setup_user_name_loader"><img src="{{ URL::asset('new-assets/common/images/bx_loader.gif')}}"></div>
                                <div style="clear: both"></div>
                                <div id="account_setup_user_name_msg_success" class="account_setup_user_name_msg_success">
                                </div>
                                <div id="account_setup_user_name_msg_danger" class="account_setup_user_name_msg_danger">
                                  <span class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="ur_sec ">
                        Please create a unique username for your account on AvDopt. Your username will serve as your display name; however, it must not contain your Second Life legacy name, profanity, nor special characters. Here are some username examples: Lucky Baby, Early Bird, Singing Smile, Grey Sky Blue
                    </div>
                </div>
            </div>


            <div class="lst_sec ">
                <div class="user_sec ">
                    <div class=" row">
                        <div class="col-md-4">
                            <div class="input_group">
                                <label class="label lbl">Email Address: </label>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="input_group">
                                <input type="email" name="user_email" id="user_email" class="account_setup_email" value="{{$user?$user->user_email:''}}">
                            </div>
                        </div>
                    </div>
                        <div class="ur_sec ">
                            Providing an email address is optional; however, if you would like to receive notifications and our newsletters via email you may submit your email address in the space provided.
                        </div>
                    </div>
                </div>
            </div>

            <div class="lst_sec ">
                <div class="user_sec ">
                    <div class=" row">
                        <div class="col-md-4">
                            <div class="input_group">
                                <label class="label lbl">Gender: <span class="star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input_group account_setup_gender_cont">
                                <select name="gender" id="gender">
                                    @if($user)
                                        @if($user->group)
                                          @if(!empty($gender_roles))
                                            @if(count($gender_roles)>0)
                                                @foreach($gender_roles as $gender_role)
                                                    @if($gender_role['id']==$user->gender)
                                                        <option value="{{$gender_role['id']}}" selected>{{$gender_role['title']}}</option>
                                                    @else
                                                        <option value="{{$gender_role['id']}}">{{$gender_role['title']}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                         @endif
                                        </select>
                                        @else
                                        <select name="gender" id="gender" disabled>
                                           <option value=""></option>
                                       </select>
                                           @endif                                    
                                       @else
                                         <select name="gender" id="gender" disabled>
                                           <option value=""></option>
                                       </select>
                                       @endif

                               
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input_group">
                                <p><i>Please choose your Gender</i></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="user_sec ">
                    <div class=" row">
                        <div class="col-md-4">
                            <div class="input_group">
                                <label class="label lbl">Age: <span class="star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input_group account_setup_age_cont">
                                <select name="age" id="age">
                                    @if($user)
                                      @if($user->group)
                                        @if(!empty($min_max_age_arr))
                                            @if(count($min_max_age_arr)>0)
                                                @foreach($min_max_age_arr as $min_max_age)
                                                    @if($min_max_age==$user->age)
                                                        <option value="{{$min_max_age}}" selected>{{$min_max_age}}</option>
                                                    @else
                                                        <option value="{{$min_max_age}}">{{$min_max_age}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                         @endif
                                        </select>
                                     @else
                                     <select name="gender" id="gender" disabled>
                                        <option value=""></option>
                                    </select>
                                        @endif                                    
                                    @else
                                      <select name="gender" id="gender" disabled>
                                        <option value=""></option>
                                    </select>
                                    @endif
                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input_group">
                                <p><i>Choose the age that you roleplay;<br>not your Real Life age silly ;)</i></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="user_sec ">
                    <div class=" row">
                        <div class="col-md-3">
                            <div class="input_group">
                                <label class="label lbl" style="color:#5197f6">Family role:<span class="star">*</span> </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row btn_family_role_row">
                                @if($user)
                                 @if($user->group)
                                  @if(!empty($family_roles))
                                        @if(count($family_roles)>0)
                                            @foreach($family_roles as $family_role)
                                <div class="col-md-4">
                                    <div class="input_group cl_ble">
                                        @if(count($user_family_roles_id_arr)>0)
                                            @if(in_array($family_role->id,$user_family_roles_id_arr))
                                        <a href="javascript:void(0);" data-color="success" class="btn btn-success btn_family_role">
                                            <i class="fa fa-check-square-o"></i>{{$family_role->title}}
                                        </a>
                                        <input name="family_roles[]" id="family_role_{{$family_role->id}}" type="checkbox" checked class="hidden" value="{{$family_role->id}}" />
                                            @else
                                        <a href="javascript:void(0);" data-color="success" class="btn btn-primary btn_family_role">
                                            <i class="fa fa-square-o"></i>{{$family_role->title}}
                                        </a>
                                        <input name="family_roles[]" id="family_role_{{$family_role->id}}" type="checkbox" class="hidden" value="{{$family_role->id}}" />
                                            @endif
                                        @else
                                        <a href="javascript:void(0);" data-color="success" class="btn btn-primary btn_family_role">
                                            <i class="fa fa-square-o"></i>{{$family_role->title}}
                                        </a>
                                        <input name="family_roles[]" id="family_role_{{$family_role->id}}" type="checkbox" class="hidden" value="{{$family_role->id}}" />
                                        @endif
                                    </div>
                                </div>
                                            @endforeach
                                        @endif
                                        @endif
                                    @endif
                                @endif

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="ur_sec w-100">
                                <p>Please choose the <b>Family Roles</b> that represents you best. Family Roles influences <br>your relevance in searches
                                    and the entire adoption process. Although you may choose<br> multiple Family Roles, it is within your best interest to
                                choose wisely.<a href="{{route('faq')}}"> Learn More </a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="user_sec ">
                    <div class=" row">
                        <div class="col-md-4">
                            <div class="input_group">
                                <label class="label lbl">Species <span class="star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input_group">
                                <select id="species" name="species" >
                                    @if( $species )
                                        @foreach( $species as $row )
                                            @if($user)
                                                @if($row->id==$user->species_id)
                                                <option value="{{ $row->id }}" selected><?php echo $row->name ?></option>
                                                @else
                                                <option value="{{ $row->id }}"><?php echo $row->name ?></option>
                                                @endif
                                            @else
                                                <option value="{{ $row->id }}"><?php echo $row->name ?></option>
                                            @endif
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input_group">
                                <p><i>Just follow your heart...</i></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="user_sec ">
                    <div class=" row">
                        <div class="col-md-4">
                            <div class="input_group">
                                <label class="label lbl">Ethnicity <span class="star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input_group">
                                <select id="ethnicity_group_id" name="ethnicity_group_id" >
                                    @if( $ethnicityGroups )
                                        @foreach( $ethnicityGroups as $row )
                                            @if($user)
                                                @if($row->id==$user->ethnicity_group_id)
                                                <option value="{{ $row->id }}" selected><?php echo $row->title ?></option>
                                                @else
                                                <option value="{{ $row->id }}"><?php echo $row->title ?></option>
                                                @endif
                                            @else
                                                <option value="{{ $row->id }}"><?php echo $row->title ?></option>
                                            @endif
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input_group">
                                <p><i>Just follow your heart...</i></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="user_sec">
                    <div class="alert alert-danger frm_account_setup_error_msg_" style="display:none;">
                        <button type="button" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="has-error"></div>
                    </div>
                    <div class="frm_account_setup_submit_msg"></div>
                    <div class="nxt_btn_sec">
                        <button  class="btn btn-primary btn_account_setup_next" type="submit">NEXT</button>
                    </div>
                </div>
            </div>
            </div>
        </div>

        </form>
    </div>

    @endsection
@section('page_level_scripts')
    <script src="{{ URL::asset('new-assets/common/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new-assets/common/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new-assets/common/plugins/jquery-form/jquery.form.min.js')}}" type="text/javascript" ></script>
    <script>
        var user_groups_gender_family_roles_json={!!$user_groups_gender_family_roles_json!!};
        var user_name_availability_check_url='{{url('/ajaxrequest/user-availability-check')}}';
        var account_setup_submit_url='{{url('/account-setup')}}';
        var account_setup_profile_info_url='{{url('/account-setup/profile-info')}}';

    </script>
    <script src="{{ URL::asset('new-assets/common/js/common.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new-assets/frontend/js/account-setup.js')}}" type="text/javascript"></script>
@endsection
