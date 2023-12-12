@extends('admin.layout.master')
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
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <div class="report_box mtop30">
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
                                        @foreach($reportusers as $reportuser)
                                            @php
                                                $reportedbyinfo = App\User::find($reportuser->user_id);
                                                $reportuserinfo = App\User::find($reportuser->block_id);
                                            @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ @$reportedbyinfo->name }}</td>
                                            <td>{{ @$reportuserinfo->name }}</td>
                                            <td>{{ $reportuser->reason }}</td>
                                            <td>{{ $reportuser->description }}</td>
                                            <td>{{ $reportuser->report_status_display }}</td>
                                            <td>
                                                @if($reportuser->status)
                                                <a href="javascript:void(0);" onclick="changeReportStatus({{$reportuser->id}},{{ $reportuser->status }},
                                                        '{{route('admin.reports.change-status',$reportuser->id)}}')"
                                                   class="btn btn-warning btn-circle">
                                                    In complete
                                                </a>
                                                @else
                                                <a href="javascript:void(0);" onclick="changeReportStatus({{$reportuser->id}},{{ $reportuser->status }},
                                                        '{{route('admin.reports.change-status',$reportuser->id)}}')"
                                                   class="btn btn-info btn-circle">
                                                   &nbsp; Complete &nbsp;
                                                </a>
                                                @endif
                                                <a href="javascript:void(0);" onclick="deleteItem({{$reportuser->id}},'{{route('admin.reports.delete',$reportuser->id)}}')"
                                                   class="btn btn-danger btn-circle">
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
