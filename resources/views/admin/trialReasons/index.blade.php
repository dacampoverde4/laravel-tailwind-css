@extends('admin.layout.master')
@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font20"><b class="vertical_align"><i class="fa fa-edit" aria-hidden="true"></i> Trial End Reasons</b>
                            <a href="{{route('trialreasons.create')}}" class="btn btn-info pull-right">Add Trial End Reason</a>
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
                                    <table id="sortable" class="table table-bordered mtop20">
                                        <tr>
                                            <th>Sr.No.</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Created_at</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach($trialReasons as $reason )
                                        <tr id="{{$reason->id}}">
                                            <td>{{ $loop->iteration }} </td>
                                            <td>{{$reason->title}}</td>
                                            <td>{{$reason->status}}</td>
                                            <td>{{$reason->created_at}}</td>
                                            <td>
                                                <a href="{{route('trialreasons.edit', $reason->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                                <a href="{{route('trialreasons.delete',$reason->id)}}" onclick="return confirm('Are you sure you want to delete this Reason?')" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i> </a>
                                            </td>
                                        </tr>
                                        @endforeach
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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection
