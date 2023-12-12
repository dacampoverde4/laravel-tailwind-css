@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block"><b>Edit User</b>
                        <a class="btn btn-info pull-right" href="{{ url('admin/users') }}"><i class="fa fa-arrow-left"></i> Back</a>
                        </h3>
                        <hr>
                    @if (session('success'))


                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                    @endif
                    <form class="form_inline fullwidth mtop40" method="POST" action="{{route('users.update', $user->id)}}">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name')? old('name') : $user->name }}" required >

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
                                <label for="displayname" class="col-md-4 col-form-label text-md-right">Display Name</label>
                                <div class="col-md-8">
                                    <input id="displayname" type="text" class="form-control{{ $errors->has('displayname') ? ' is-invalid' : '' }}" name="displayname" value="{{ old('displayname')? old('displayname') : $user->displayname }}" required >

                                    @if ($errors->has('displayname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('displayname') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email')? old('email') : $user->email }}" required>

                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="">

                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="user_group" class="col-md-4 col-form-label text-md-right">User Group</label>
                                <div class="col-md-8">
                                    <select class="form-control changeUserGroup" id="user_group" onchange="getGenderInfo(this.value,{{ $user->gender }})" name="user_group" required="required" >
                                        @php
                                            $sel = '';
                                            $grpId = 0;
                                            $group = old('group')? old('group') : $user->group;
                                        @endphp
                                        @if( $usergroups )
                                            @foreach( $usergroups as $row )
                                                @if ($loop->first)
                                                    @php
                                                        $grpId = $row->id;
                                                    @endphp
                                                @endif
                                                @if( $group == $row->id )
                                                    @php
                                                        $grpId = $row->id;
                                                    @endphp
                                                @endif
                                                @php
                                                    $sel = ( $group == $row->id )? "selected='selected'" : '';
                                                @endphp
                                                <option {{ $sel }} value="{{ $row->id }}"><?php echo $row->title ?></option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <script type="text/javascript">
                                        getGenderInfo({{ $grpId }},{{ $user->gender }});
                                    </script>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="row">
                                <label for="gender" class="col-md-4 col-form-label text-md-right">Gender</label>
                                <div class="col-md-8" id="genderInfodisplay">

                                    @if ($errors->has('gender'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="age" class="col-md-4 col-form-label text-md-right">Age</label>
                                <div class="col-md-8">
                                    <input id="age" type="text" class="form-control{{ $errors->has('age') ? ' is-invalid' : '' }}" name="age" value="{{ old('age')? old('age') : $user->age }}" >

                                    @if ($errors->has('age'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <div class="row">
                                <label for="user_type" class="col-md-4 col-form-label text-md-right">User Type</label>
                                <div class="col-md-8">
                                    <select class="form-control" id="user_type" name="user_type" required="required" >
                                        @if( $userroles )
                                            @foreach( $userroles as $userrole )
                                                <option value="{{ $userrole->id }}" {{$userrole->id==$user->role_id ? 'selected' : ''}}><?php echo $userrole->role; ?></option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        @if($user->role_id==3)
                        <div class="form-group" id="showcategory">
                            <div class="row">
                                <label for="tags" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
                                <div class="col-md-8">
                                    <select name="category_id"  >
                                       <option value="">Please Select</option>
                                        @foreach($categories as $category)
                                        @if($category->id == $user->category_id)
                                              <option value="{{ $category->id }}" selected> 
                                          {{  $category->category_name }}</option>
                                          @else
                                            <option value="{{ $category->id }}" {{ (collect(old('Category'))->contains($category->category_name )) ? 'selected':'' }} >{{  $category->category_name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @else
                                <div class="form-group" id="showcategory" style="display:none;">
                            <div class="row">
                                <label for="tags" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
                                <div class="col-md-8">
                                    <select name="category_id"  >
                                       <option value="">Please Select</option>
                                        @foreach($categories as $category)
                                        @if($category->id == $user->category_id)
                                              <option value="{{ $category->id }}" selected> 
                                          {{  $category->category_name }}</option>
                                          @else
                                            <option value="{{ $category->id }}" {{ (collect(old('Category'))->contains($category->category_name )) ? 'selected':'' }} >{{  $category->category_name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($user->role_id==3)
                                <div class="form-group" id="designation" >
                        <div class="row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Designation') }}</label>

                        <div class="col-md-8">
                        <input id="email" type="text" class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" name="designation" value="{{ $user->designation }}">

                        @if ($errors->has('designation'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('designation') }}</strong>
                        </span>
                        @endif
                        </div>
                        </div>
                        </div>  
                            @else
                                    <div class="form-group" id="designation" style="display:none;">
                        <div class="row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Designation') }}</label>

                        <div class="col-md-8">
                        <input id="email" type="text" class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" name="designation" value="{{$user->designation }}">

                        @if ($errors->has('designation'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('designation') }}</strong>
                        </span>
                        @endif
                        </div>
                        </div>
                        </div>  
                                @endif
                    
                        <div class="form-group">
                            <div class="row">
                                <label for="species_id" class="col-md-4 col-form-label text-md-right">Species</label>
                                <div class="col-md-8">
                                    <select class="form-control" id="species_id" name="species_id" >
                                        <option value="">Please select</option>
                                        @if( $species )
                                            @foreach( $species as $row )
                                                <option value="{{ $row->id }}" {{$row->id==$user->species_id ? 'selected' : ''}}>
                                                    <?php echo $row->name;?>
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <label for="about_me" class="col-md-4 col-form-label text-md-right">{{ __('About') }}</label>

                                <div class="col-md-8">
                                    <textarea id="about_me" class="form-control{{ $errors->has('about_me') ? ' is-invalid' : '' }}" name="about_me" required>{{ $user->about_me }}</textarea>

                                    @if ($errors->has('about_me'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('about_me') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label for="" class="col-md-4 col-form-label text-md-right">Trial Plan</label>
                                <div class="col-md-8">
                                   <select class="form-control" id="trial_plan" name="trial_plan" >
                                        <option value="">Please select</option>
                                        @if( $plans )
                                            @foreach( $plans as $plan )
                                                {{ $plan}}
                                                @php 
                                                $selected = '';
                                                if($plan->plan_id == @$subPlan->stripe_plan){
                                                    $selected= 'selected';
                                                }
                                                @endphp
                                                <option value="{{ $plan->plan_id }}" {{ $selected }}>
                                                    <?php  echo $plan->name;?>
                                                </option>
                                            @endforeach
                                            
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="row">
                                <label for="" class="col-md-4 col-form-label text-md-right">Days Left:</label>
                                <div class="col-md-8">
                                    @php  
                                    if(@$subPlan->end_at != ''){
                                        
                                        $end_date = @$subPlan->ends_at;
                                       
                                        $current_date = date('Y-m-d h:i:s');
                                        $date1 = strtotime($current_date);
                                        $date2 = strtotime($end_date);
                                        $diff = $date2 - $date1;
                                        $daysLeft = round($diff / 86400);
                                    
                                       @endphp
                                    <p>
                                      {{ @$daysLeft }} Days left  

                                    </p>
                                       @php 
                                        }
                                        @endphp
                                </div>
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9"><button type="submit" class="btn btn-success pull-right border_radius"><i class="fa fa-check"></i> Update</button></div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('#user_type').on('change', function() {
     if ( this.value == '3')
      //.....................^.......
      {
        $("#showcategory").show();
		  $("#designation").show();
      }
      else
      {
        $("#showcategory").hide();
		$("#designation").hide();
      }
    });
});
</script>
@endsection
