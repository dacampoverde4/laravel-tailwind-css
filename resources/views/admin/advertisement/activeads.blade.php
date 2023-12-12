@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block"><b class="vertical_align"><img src="{{ asset('backend/images/announcement2.png') }}" alt="Img" title="Img" class="announcement">Active Advertises</b>
                        </h3>
                        <hr>
                        <h4 class="inline_block">Active Advertises: {{$countads}}
                        </h4>
                        <div class="announcement_box paddingtb20">
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
                                                <th>Title</th>
                                                <th>User</th>
                                                <th>Status</th>
                                                <th>Paid</th>
                                                <th>Approve</th>
                                                <th>Start Date</th>
                                                <th>Ended Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($subscriptions as $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $value->title }}</td>
                                                 <td>{{ $value->name }}</td>
                                                 <td>{{$value->status}}</td>
                                                 <td>{{ $value->paid == 1 ? 'Yes' : 'No' }}</td>
                                                  @php
                                                  $bannercount = \App\UsersBanner::where('ads_id',$value->ads_id)->count();
                                                  @endphp
                                                  <td>
                                                    @if($value->approve == 1 && $bannercount >0)
                                                        <button href="{{ route('advertisement.approveads', $value->id)}}" class="btn btn-success btn-sm" title="Approved Account" disabled>Approved</button>
                                                    @elseif($value->paid == 1 &&  $value->status == 'Inactive')
                                                        <a href="{{ route('advertisement.approveads', $value->id)}}" class="btn btn-info btn-sm" title="Approve Account">Approve</a>
                                                    @elseif($value->paid == 0 || $value->status != 'Active')
                                                        <button href="{{ route('advertisement.approveads', $value->id)}}" class="btn btn-info btn-sm disabledbtn"  disabled="disabled">Approve</button>
                                                    @elseif($bannercount==0)
                                                        <button href="{{ route('advertisement.approveads', $value->id)}}" class="btn btn-info btn-sm disabledbtn"  disabled="disabled">Approve</button>
                                                    @endif
                                                </td>
                                                 <td>{{ $value->start_at}}</td>
                                                 <td>{{ $value->ended_at}}</td>
                                                 <td><td>
                                                    <a href="#" class="btn btn-info btn-circle btn-danger suspend_acc" data-advtid="{{$value->id}}" data-toggle="modal" data-target="#myModalSuspend" title="Suspend Account"><i class="fa fa-ban" aria-hidden="true"></i></a>

                                                    <a href="#" class="btn btn-danger btn-circle delete_acc" data-deleteid="{{$value->id}}" data-toggle="modal" data-target="#myModalDelete" title="Delete Account"><i class="fa fa-trash"></i></a>
                                                </td></td>
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
</div> 
<div id="myModalSuspend" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="suspendform" method="post" action="{{route('advertisement.suspend')}}">
        @csrf
        <input type="hidden" name="advtid" class="my_hidden_field" value="">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Suspend Advertisement</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">    
                                                <p> Do you want Suspend Advertisement?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success btn-success pull-right border_radius border0" id="suspend_advt">Suspend</button>
                                                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </form>
                                </div>
<div id="myModalDelete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="deleteform" method="post" action="{{route('advertisement.paid.delete')}}">
        @csrf
        <input type="hidden" name="deleteid" class="my_delete_field" value="">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Delete Advertisement</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">    
                                                <p> Do you want Delete Advertisement?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success btn-success pull-right border_radius border0" id="delete_advt">Delete</button>
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
    $(".suspend_acc").click(function(){
            var advtid = $(this).attr("data-advtid");
            $(".my_hidden_field").val(advtid);
    });
    $(".delete_acc").click(function(){
            var deleteid = $(this).attr("data-deleteid");
            $(".my_delete_field").val(deleteid);
    });
});
</script>
@endsection