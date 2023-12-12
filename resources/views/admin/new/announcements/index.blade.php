@extends('admin.New.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block"><b class="vertical_align"><img src="{{ asset('backend/images/announcement2.png') }}" alt="Img" title="Img" class="announcement"> ANNOUNCEMENTS</b>
                            <a href="{{route('announcement.create')}}" class="btn btn-info pull-right">Add Announcement</a>
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
                                                <th>Content</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($announcements as $announcement)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $announcement->content }}</td>
                                                <td>
                                                    <a href="{{route('announcement.edit',$announcement->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                                    <a onclick="return confirm('Are you sure you want to delete this announcement?')" href="{{route('announcement.delete',$announcement->id)}}" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i></a>
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
@endsection