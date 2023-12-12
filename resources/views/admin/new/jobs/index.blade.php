@extends('admin.New.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22"><b class="vertical_align"><img src="{{ asset('backend/images/job2.png') }}" alt="Img" title="Img" class="announcement"> JOBS</b>
                            <a href="{{route('create.jobs')}}" class="btn btn-info pull-right">Add job</a>
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
                                    <table class="table table-bordered">
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Company Name</th>
                                        <th>Location</th>
                                        <th>Job Type</th>
                                        <th>Category</th>
                                        <th>Salary</th>
                                        <th>tags</th>
                                        <th>Action</th>
                                        @foreach($jobs as $job)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$job->title}}</td>
                                            <td>{{$job->company_name}}</td>
                                            <td><a target="_blank" href="{{ $job->location }}"> {{$job->location}}</a></td>
                                            <td>{{$job->job_type}}</td>
                                            <td>{{$job->category}}</td>
                                            <td>{{$job->salary}}</td>
                                            <td>
                                                @php
                                                $getjobs = ( $job->tag_title )? json_decode( $job->tag_title ) : array();
                                                echo implode(', ', $getjobs);
                                                @endphp    
                                            </td>
                                            <td>
                                                <a href="{{ route('edit.jobs', $job->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                                <a onclick="return confirm('Are you sure you want to delete job?')" href="{{ route('delete.jobs', $job->id)}}" class="btn btn-info btn-circle btn-danger" title="Suspend"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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