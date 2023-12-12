@extends('admin.New.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h4 class="inline_block font22"><b class="vertical_align"><img src="{{ asset('backend/images/applicants2.png') }}" alt="Img" title="Img" class="announcement"> ALL APPLICANTS</b></h4>
                        <div class="msgtabs pt50">
                            <div class="container-fluid">
                                @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                @endif
                                <div class="table-responsive m-t-40">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>#</th>
                                            <th>Job Title</th>
                                            <th>Form id</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach($alldata as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->job_title }}</td>
                                            <td>{{ $data->id }}</td>
                                            <td>
                                                <a href="{{ route('admin.view',$data->id) }}" class="btn btn-info btn-circle"><i class="fa fa-eye"></i></a>
                                                <a onclick="return confirm('Are you sure you want to delete this application?')" href="{{ route('delete.applicant',$data->id) }}" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i></a>
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
@endsection