@extends('layouts.master')

@section('main-content')
<div class="maincontent">
        <div class="content bgwhite">                       
            
            <!-- Start Upgrade Membership ---->
            <div class="membership">
                <div class="container-fluid">
                    <h3><i class="fa fa-envelope"></i>User Group</h3>
                   
                        <div class="col-md-10"> </div>
                 </div>
            </div>
            <!-- End Upgrade Membership ---->


            <!-- Start Message Tabs -->
            <div class="msgtabs pt50">
                <div class="container-fluid">
                  <div class="tab-content">
                        <div id="inbox" class="tab-pane fade in active">
                            
                            <form class="form-horizontal" role="form" method="POST" action="{{route('usergroup.update',$genderrole->id)}}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title"  type="title" class="form-control" name="title" value="{{ $genderrole->title }}" required autofocus>
                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="agegroup" class="col-md-4 control-label">Age(Min.)</label>

                            <div class="col-md-6">
                                <input id="agegroup"  type="agegroup" class="form-control" name="agegroup" value="{{ $genderrole->minage }}" required autofocus>
                        </div>
                        </div>

                         <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="agegroup" class="col-md-4 control-label">Age(Max.)</label>

                            <div class="col-md-6">
                                <input id="agegroup"  type="agegroup" class="form-control" name="maxage" value="{{ $genderrole->maxage }}" required autofocus>
                        </div>
                        </div>

                         <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="role" class="col-md-4 control-label">Gender role</label>

                            <div class="col-md-6">
                                <select class="form-control" id="role" name="gender[]" required="required" multiple>
                        <option value="" selected disabled>select role</option>

                            @foreach($role as $row)

                           <option value="{{ $row->id }}"><?php echo $row->title ?></option>
                            @endforeach
                           </select>
                        </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btnred width">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                              
                         </div>
                            
                            
                          
                          

                            

                        
                        
                                                  
                    </div>
                        
                </div>
            </div>
        </div>
            <!-- End Message Tabs -->

        </div>      
    </div>
@endsection
