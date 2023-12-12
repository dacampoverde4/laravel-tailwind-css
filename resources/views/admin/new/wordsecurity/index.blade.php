@extends('admin.New.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22"><b class="vertical_align"><img src="{{ asset('backend/images/taguser.png') }}" alt="Img" title="Img" class="announcement"> Words</b>
                            <a href="{{route('create.word')}}" class="btn btn-info pull-right">Add Word</a>
                        </h3>
                        <hr>
                        <div class="msgtabs mtop30">
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($words as $word)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$word->title}}</td>
                                                <td>
                                                    <a href="{{ route('edit.word', $word->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                                    <a onclick="return confirm('Are you sure you want to delete word?')" href="{{ route('delete.word', $word->id)}}" class="btn btn-info btn-circle btn-danger" title="Suspend"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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