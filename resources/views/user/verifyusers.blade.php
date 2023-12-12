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
                            <b class="vertical_align"><img src="{{ asset('backend/images/allusers.png') }}" alt="Report"
                                    title="Img" class="all_users"> Verify USERS</b>
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
                                            @foreach($verifyusers as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><img src="{{ ( $user->profile_pic )? url('/uploads/'.$user->profile_pic) : url('images/default.png') }}"
                                                        class="img-circle" width="150" /></td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->displayname}}</td>
                                                <td>{{ @$user->role->role }}</td>
                                                <td>{{ @$user->usergender->title}}</td>
                                                <td>{{ $user->species?$user->species->name:'N/A' }}</td>
                                                <td>{{ @$user->usergroup->title }}</td>
                                                <td>{{$user->age}}</td>
                                                <td>
                                                    @if($user->verify_request == 1)
                                                    <a href="#" class="btn btn-info btn-circle btn-danger decline_acc"
                                                        data-userid="{{$user->id}}" data-toggle="modal"
                                                        data-target="#myModalDecline" title="Decline"><i
                                                            class="fa fa-ban" aria-hidden="true"></i></a>
                                                    @else
                                                    Declined
                                                    @endif
                                                    @if($user->verify != 1)
                                                    <a onclick="return confirm('Are you sure you want to Verify this user?')"
                                                        href="{{route('profile.accept', $user->id )}}"
                                                        class="btn btn-info btn-circle btn-success" title="Accept"><i
                                                            class="fa fa-check-circle" aria-hidden="true"></i></a>
                                                    @else
                                                    Accepted
                                                    @endif
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
<div id="myModalDecline" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <form id="declinedform" method="post" action="{{route('profile.decline')}}">
        @csrf
        <input type="hidden" name="userid" class="my_hidden_field" value="">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Do you want to Decline verification for this user?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-success pull-right border_radius border0"
                        id="decline_user"><i class="fa fa-check"></i>Decline</button>
                    <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
</div>

@endsection
@section('page_js')
<script type="text/javascript">
    $(document).ready(function(){
    $(".decline_acc").click(function(){
            var userid = $(this).attr("data-userid");
            $(".my_hidden_field").val(userid);
    });
});

$(document).ready(function() {
  $('.table').DataTable();
} );

</script>

@endsection
