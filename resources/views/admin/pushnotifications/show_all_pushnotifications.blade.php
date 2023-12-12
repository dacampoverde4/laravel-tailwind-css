@extends('admin.layout.master')
@section('page_css')
<style type="text/css">
    td, th{
        text-align: center;
    }
    img.baner{
        width: 150px;
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
                        <h3 class="inline_block font22">
                            <b class="vertical_align">PUSH NOTIFICATIONS</b>
                            <a href="{{route('pushnotifications.create')}}" style="margin:0 10px" class="btn btn-info pull-right">Add New Push Notification</a>
                        </h3>
                        <hr>
                        @if (session('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('success') }}
                        </div>
                        @elseif(session('warning'))
                        <div class="alert alert-warning">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('warning') }}
                        </div>
                        @elseif(session('error'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('error') }}
                        </div>
                        @endif
                        <div class="announcement_box paddingtb20">
                            <div class="container-fluid">
                                <div class="table-responsive m-t-40">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Banner</th>
                                                <th>Name</th>
                                                <th>Call to Action Button</th>
                                                <th>Showing Count</th>
                                                <th>Seconds after login</th>
                                                <th>Showing to New User</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pushnotifications as $pushnotification_obj)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset($pushnotification_obj->bannerimage) }}" alt="your image" class="baner" />
                                                </td>
                                                <td>{{ $pushnotification_obj->name }}</td>
                                                <td><a href="{{ $pushnotification_obj->url }}" target="_blank">{{ $pushnotification_obj->button_text }}</a></td>
                                                <td>{{ $pushnotification_obj->showing_count }}</td>
                                                <td>{{ $pushnotification_obj->seconds_to_show_after_login }}</td>
                                                <td>@if($pushnotification_obj->show_to_new_users) <span class="btn  btn-success btn-xs">Yes</span> @else <span class="btn  btn-danger btn-xs">No</span> @endif</td>
                                                <td>
                                                    <a href="{{ route('pushnotifications.show', $pushnotification_obj->id) }}" class="btn btn-info btn-circle"><i class="fa fa-eye"></i></a>
                                                    <a href="{{ route('pushnotifications.edit', $pushnotification_obj->id) }}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                                    <form action="{{ route('pushnotifications.destroy', $pushnotification_obj->id) }}" method="post">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button class="btn btn-danger btn-circle" type="button"><i class="fa fa-trash"></i></button>
                                                    </form>
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
$(document).ready(function() {
    $('.table').DataTable();
    $(".btn-danger").click(function (e) {
        if(confirm('Doy uo really want to delete this Push Notification ?')){
            $(this).closest('form').submit();
        }
    });
});
</script>
@endsection