@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block"><b class="vertical_align"><img src="{{ asset('backend/images/announcement2.png') }}" alt="Img" title="Img" class="announcement"> Advertisements</b>
                            <a href="{{route('advertisement.create')}}" class="btn btn-info pull-right">Add Advertisements</a>
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
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Banners</th>
                                                <th>User Groups</th>
                                                <th>Banner Plan</th>
                                                <th>Amount</th>
                                                <th>Plan Period</th>    
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($advertisement as $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                 <td>{{ $value->title }}</td>
                                                 <td>{{ $value->description }}</td>
                                                 @php
                                                  $bannerid = explode(',',$value->banner_ids);
                                                  $taudienceid = explode(',',$value->target_audience_ids);
                                                 @endphp
                                                 <td>
                                                    @if($bannerid)
                                                    @foreach($bannerid as $banner)
                                                    @php $bannerlist = \App\Banner::where('id',$banner)->first();
                                                    @endphp

                                                    {{$bannerlist->banner_width}}_{{$bannerlist->banner_height}}_{{$bannerlist->page_location}}<br> 
                                                    @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($taudienceid)
                                                    @foreach($taudienceid as $tid)
                                                    @php $usergrouplist = \App\TargetAudience::where('id',$tid)->first();
                                                    @endphp
                                                    {{$usergrouplist->usergroup_names}}<br> 
                                                    @endforeach
                                                    @endif
                                                </td>
                                                 <td>{{ $value->banner_plan }}</td>
                                                 <td>{{ $value->total_amt }}</td>
                                                 <td>{{ $value->plan_period }}</td>
                                                 <td>{{date('M d, Y', strtotime($value->created_at))}}</td>
                                                 <td><a href="{{ route('advertisement.show', $value->id)}}" class="btn btn-info btn-circle"><i class="fa fa-eye"></i></a>
                                                 <a href="{{route('advertisement.edit',$value->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                                 <a href="#" class="btn btn-danger btn-circle delete_acc" data-deleteid="{{$value->id}}" data-toggle="modal" data-target="#myModalDelete" title="Delete Account"><i class="fa fa-trash"></i></a>
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
</div> 
<div id="myModalDelete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="deleteform" method="post" action="{{route('advertisement.delete')}}">
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
    $(".delete_acc").click(function(){
            var deleteid = $(this).attr("data-deleteid");
            $(".my_delete_field").val(deleteid);
    });
});
</script>
@endsection