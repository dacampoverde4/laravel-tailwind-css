@extends('admin.layout.master')
@section('page_css')
<style>
    table .btn-circle {
        border-radius: 8px;
        width: auto;
        height: auto;
    }
</style>
@endsection
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h4 class="font22"><b class="vertical_align"><img src="{{ asset('backend/images/report.png') }}" alt="Report" title="Img"> REPORTS</b></h4>
                        <hr>
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
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
                                        <th>User ID</th>
                                        <th>Reported ID</th>
                                        <th>Reason</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        @foreach ($blockusers as $blockuser)
                                            @php
                                                $blockedbyinfo = App\User::find($blockuser->user_id);
                                                $blockeduserinfo = App\User::find($blockuser->block_id);
                                            @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ @$blockedbyinfo->name }}</td>
                                            <td>{{ @$blockeduserinfo->name }}</td>
                                            <td>{{ $blockuser->reason }}</td>
                                            <td>{{ $blockuser->description }}</td>
                                            <td>{{ $blockuser->report_status_display }}</td>
                                            <td>
                                                @if($blockuser->status)
                                                <a href="javascript:void(0);" onclick="changeReportStatus({{$blockuser->id}},{{ $blockuser->status }},
                                                        '{{route('admin.reports.change-status',$blockuser->id)}}')"
                                                   class="btn btn-warning btn-circle">
                                                    In complete
                                                </a>
                                                @else
                                                <a href="javascript:void(0);" onclick="changeReportStatus({{$blockuser->id}},{{ $blockuser->status }},
                                                        '{{route('admin.reports.change-status',$blockuser->id)}}')"
                                                   class="btn btn-info btn-circle">
                                                   &nbsp; Complete &nbsp;
                                                </a>
                                                @endif
                                                <a href="{{route('admin.blocks.delete',$blockuser->id)}}"  class="btn btn-danger btn-circle">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </td>
                                        </tr>       
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                         <form id="frmChangeStatus" name="frmChangeStatus" method="post">
                            {!! csrf_field() !!}
                            <input type="hidden" name="report_id" id="report_id" value="0">
                            <input type="hidden" name="report_status" id="report_status" value="0">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_js')
    <script language="javascript" type="text/javascript">
        function changeReportStatus(report_id,status,url)
        {
            jQuery('#frmChangeStatus').attr('action',url);
            jQuery('#report_id',jQuery('#frmChangeStatus')).val(report_id);
            jQuery('#report_status',jQuery('#frmChangeStatus')).val(status);
            jQuery('#frmChangeStatus').submit();
        }
    </script>
@stop
