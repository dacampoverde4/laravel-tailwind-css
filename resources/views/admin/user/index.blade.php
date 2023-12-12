@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22">
                        <b class="vertical_align"><img src="{{ asset('backend/images/allusers.png') }}" alt="Report" title="Img" class="all_users"> USERS</b>
                          <a href="{{url('admin/reports')}}" style="margin:0 10px" class="btn btn-info pull-right">Reports</a>
                          <a href="{{url('admin/blocks')}}" style="margin:0 10px" class="btn btn-info pull-right">Blocks</a>
                          <a href="{{route('users.create')}}" style="margin:0 10px" class="btn btn-info pull-right">Add User</a>
                        </h3>
                        <hr>
                        <div class="announcement_box paddingtb20">
                            <div class="container-fluid">
                                @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                @endif
                                <div class="table-responsive m-t-40">
                                    <table class="table table-striped table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Pic</th>
                              <th>Name</th>
                              <th>Display Name</th>
                              <th>Roles</th>
                              <th>Gender</th>
                              <th>Species</th>
                              <th>Group</th>
                              <th>Age</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                           
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ ( $user->profile_pic )? url('/uploads/'.$user->profile_pic) : url('images/default.png') }}" class="img-circle" width="150" /></td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->displayname}}</td>
                                <td>{{ @$user->role->role }}</td>
                                <td>{{ @$user->usergender->title}}</td>
                                <td>{{ $user->species?$user->species->name:'N/A' }}</td>
                                <td>{{ @$user->usergroup->title }}</td>
                                <td>{{$user->age}}</td>
                                <td>
                                    <a href="{{route('viewprofile', base64_encode( $user->id ))}}" class="btn btn-info btn-circle"><i class="fa fa-eye"></i></a>
                                    <a href="{{route('users.edit',$user->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                    @if(@$user->id!=1)
                                    <!--a onclick="return confirm('Are you sure you want to delete this user?')" href="{{route('users.delete',$user->id)}}" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i></a-->
                                    <a href="#" class="btn btn-info btn-circle btn-warning warningtouser" data-user="{{$user->name}}" data-id="{{$user->id}}" data-toggle="modal" data-target="#myModalWarning" title="Warning"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
                                    @if(@$user->suspend==0)
                                        <a href="#" class="btn btn-info btn-circle btn-danger suspend_acc" data-userid="{{$user->id}}" data-toggle="modal" data-target="#myModalSuspend" title="Suspend Account"><i class="fa fa-ban" aria-hidden="true"></i></a>
                                    @else
                                        <a onclick="return confirm('Are you sure you want to active this user?')" href="{{route('profile.active', $user->id )}}" class="btn btn-info btn-circle btn-success" title="Suspend"><i class="fa fa-check-circle" aria-hidden="true"></i></a>
                                    @endif
                                    @endif
                                    <a onclick="return confirm('Are you sure you want to remove user profile?')" href="{{route('removeprofile',$user->id )}}" class="btn btn-info btn-circle" title="Remove User Profile"><i class="fa fa-picture-o" aria-hidden="true"></i></a>
                                    @if($user->is_deleted=="true")
                                    <span style="color:red">
                                          Deactivated </span>
                                       @else
                                    @if(@$user->id!=1)
                                      <a href="#" data-toggle="modal" data-target="#exampleModal{{$user->id}}" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></a>
                                      @endif
                                     @endif
                                      <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                          
                                                          <a href="{{route('users.delete',$user->id)}}" class="btn btn-warning" style=" margin-left: 5%;"><i class="fa fa-trash"> Deactivate Account</i></a>
                                                        
                                                          <a href="{{route('users.permanantdelete',$user->id)}}" class="btn btn-danger" style=" margin-left: 13%;"><i class="fa fa-trash"> Permanant Delete</i></a>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                  
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                    </td>
                                </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModalSuspend" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="suspendform" method="post" action="{{route('profile.suspend')}}">
        @csrf
        <input type="hidden" name="userid" class="my_hidden_field" value="">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Do you want to Suspend this user?</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                            <div class="form-group">
                                                <div class="row">
                                                <label for="catagory" class="col-md-4 col-form-label text-md-right">Select days</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" id="select_days" name="select_days" required="required" >
                                                        <option value="1" >1 Day</option>
                                                        <option value="3" >3 Days</option>
                                                        <option value="7" >7 Days</option>
                                                        <option value="14" >14 Days</option>
                                                        <option value="30" >30 Days</option>
                                                        <option value="permanent" >Permanent Ban</option>  
                                                    </select>
                                                </div>
                                                </div>
                                            </div>     
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="description" class="col-md-4 col-form-label text-md-right">Reason for the Suspension</label>
                                                    <div class="col-md-8">
                                                        <textarea id="reason" class="form-control" placeholder="Reason for the Suspension" name="reason" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success btn-success pull-right border_radius border0" id="suspend_user"><i class="fa fa-check"></i> Submit</button>
                                                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </form>
                                </div>
<div id="myModalWarning" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form id="warningform" method="post" action="">
        @csrf
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Add Warning Notification to <code id="warninguser"></code> Profile</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                              <p><textarea name="warningmessage" id="warningmessage" placeholder="Warning Message" class="border_radius" style="width:100%"></textarea></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success btnred pull-right border_radius border0"><i class="fa fa-check"></i> Submit</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>

    </form>
                                    <!-- /.modal-dialog -->
                                </div>

@endsection
@section('page_js')
<script type="text/javascript">

$(document).ready(function(){
    $(".warningtouser").click(function(){
        var username = $(this).attr('data-user');
        var userid = $(this).attr('data-id');
        var urlaction = 'http://avdopt-saurabhrishu.c9users.io/profile/warning/'+userid;
        $('#warninguser').text(username);
        $('#warningform').attr('action',urlaction);

    });
    $(".suspend_acc").click(function(){
            var userid = $(this).attr("data-userid");
            $(".my_hidden_field").val(userid);
    });
});

$(document).ready(function() {
  $('.table').DataTable();
} );

</script>

@endsection
