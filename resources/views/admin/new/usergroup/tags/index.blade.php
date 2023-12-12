@extends('admin.New.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22"><b class="vertical_align"><img src="{{ asset('backend/images/taguser.png') }}" alt="Img" title="Img" class="announcement"> TAGS</b>                    
                            <a href="{{route('admin.usergroup.tag.create')}}" class="btn btn-info pull-right">Add Tag</a>Main Dashboard
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
                                        <th>Color</th>
                                        <th>Action</th>
                                        @foreach($tags as $tag)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$tag->title}}</td>
                                            <td>
                                                <div style="float: left;margin: 0 10px;height:30px;width:30px;background:{{$tag->primary_color}}"></div>
                                                <div style="float: left;margin: 0 10px;height:30px;width:30px;background:{{$tag->secondary_color}}"></div>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.usergroup.tag.edit', $tag->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                                <a onclick="return confirm('Are you sure you want to delete tag?')" href="{{ route('admin.usergroup.tag.delete', $tag->id)}}" class="btn btn-info btn-circle btn-danger" title="Suspend"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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