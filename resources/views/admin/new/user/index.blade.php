@extends('admin.New.layout.master')
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
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                        <div class="msgtabs pt50">
                            <div class="container-fluid">
                                @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                @endif
                                <div class="table-responsive m-t-40">
                                    <table class="table table-striped table-bordered">
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
                                                    <a onclick="return confirm('Are you sure you want to suspend this user?')" href="{{route('profile.suspend', $user->id )}}" class="btn btn-info btn-circle btn-danger" title="Suspend"><i class="fa fa-ban" aria-hidden="true"></i></a>
                                                    @else
                                                    <a onclick="return confirm('Are you sure you want to active this user?')" href="{{route('profile.active', $user->id )}}" class="btn btn-info btn-circle btn-success" title="Suspend"><i class="fa fa-check-circle" aria-hidden="true"></i></a>
                                                    @endif
                                                    @endif
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
    });
    
    $(document).ready(function() {
      $('.table').DataTable();
    } );
    
</script>
@endsection