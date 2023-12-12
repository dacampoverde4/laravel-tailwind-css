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
                            <b class="vertical_align"><img src="{{ asset('backend/images/allusers.png') }}" alt="Report" title="Img" class="all_users"> EMPLOYEE OF THE MONTH</b>                  
                            <a href="{{route('users.createemployee')}}" style="margin:0 10px" class="btn btn-info pull-right">Add Employee</a>
                        </h3>
                        <hr>
                        <div class="msgtabs pt50">
                            <div class="container-fluid">
                                @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                @endif
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($staffs))
                                            @foreach($staffs as $staff)   
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$staff->staffname}}</td>
                                                <td>
                                                    <a href="{{ route('users.editemployee', $staff->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                                    <a onclick="return confirm('Are you sure you want to delete ?')" href="{{ route('users.deleteemployee', $staff->id)}}" class="btn btn-info btn-circle btn-danger" title="Suspend"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif  
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
<div class="modal fade" id="myModalWarning" role="dialog">
    <form id="warningform" method="post" action="">
        @csrf
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Warning Notification to <code id="warninguser"></code> Profile</h4>
                </div>
                <div class="modal-body">
                    <p><textarea name="warningmessage" id="warningmessage" placeholder="Warning Message" class="border_radius"></textarea></p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btnpad btnred pull-right border_radius border0">Submit</button>
                </div>
            </div>
        </div>
    </form>
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
    
    
</script>
@endsection