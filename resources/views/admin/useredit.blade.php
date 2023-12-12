@extends('layouts.master')

@section('main-content')
<div class="maincontent">
        <div class="content bgwhite">                       
            
            <!-- Start Upgrade Membership ---->
            <div class="membership">
                <div class="container-fluid">
                    <h3><i class="fa fa-envelope"></i>Edit Role</h3>
                   
                        <div class="col-md-10">
                            
                        </div>
                 </div>
            </div>
            <!-- End Upgrade Membership ---->


            <!-- Start Message Tabs -->
            <div class="msgtabs pt50">
                <div class="container-fluid">
                  <div class="tab-content">
                        <div id="inbox" class="tab-pane fade in active">
                           @foreach($roledata as $data)
                            <form class="form-horizontal" role="form" method="POST" action="{{route('users.update',$data->id)}}">
                                @endforeach
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="role" class="col-md-4 control-label">Add role</label>

                            <div class="col-md-6">
                                <select class="form-control" id="role" name="role" required="required">
                        <option value="" selected disabled>select role</option>

                            @foreach($role as $row)

                           <option value="{{ $row->id }}"><?php echo $row->role ?></option>
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
