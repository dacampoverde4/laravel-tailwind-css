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
                        <b class="vertical_align"><img src="{{ asset('backend/images/allusers.png') }}" alt="Report" title="Img" class="all_users"> EMPLOYEE OF THE MONTH</b><a href="{{route('users.createemployee')}}" style="margin:0 10px" class="btn btn-info pull-right">Add Employee</a>        </h3> 
                        <hr>
                        <div class="gender_box mtop30">
                           <div class="container-fluid">
                               @if(session()->has('message'))
                               <div class="alert alert-success">
                                   {{ session()->get('message') }}
                               </div>
                               @endif
                               <div class="table-responsive m-t-40">
                                   <table class="table table-bordered">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                    @if(!empty($staffs))
                                    @foreach($staffs as $staff)   
                                     <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$staff->staffname}}</td>
                                         <td>{{date('d F Y', strtotime($staff->created_at))}}</td>
                                        <td>
                                            <a href="{{ route('users.editemployee', $staff->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                            <a onclick="return confirm('Are you sure you want to delete ?')" href="{{ route('users.deleteemployee', $staff->id)}}" class="btn btn-info btn-circle btn-danger" title="Suspend"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                         </td>
                                    </tr>   
                                    @endforeach
                                    @endif                          
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
                                              <p><textarea name="warningmessage" id="warningmessage" placeholder="Warning Message" class="border_radius"></textarea></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btnpad btnred pull-right border_radius border0">Submit</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>

    </form>
                                    <!-- /.modal-dialog -->
                                </div>


@endsection
@section('footer')
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