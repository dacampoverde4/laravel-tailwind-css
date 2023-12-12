@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22"><b class="vertical_align">Pages</b>
                        <a class="btn btn-primary pull-right" href="{{ route('pages.create') }}"><i class="fa fa-plus"></i> Add Page</a>
                        </h3>
                        <hr>
                        <div class="gender_box mtop30">
                            <div class="container-fluid">
                                @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                @endif
                                <div class="table-responsive m-t-40">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Page Title</th>
                                            <th>Content</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($pages)
                                            @foreach($pages as $page)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $page->page_title }}</td>
                                                    <td>{!! \Illuminate\Support\Str::limit($page->content,50,'...') !!}</td>
                                                    <td>
                                                        <a href="{{route('pages.edit',$page->id)}}" class="btn btn-info btn-circle">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>

                                                       @if ($page->id !== 1 AND $page->id !== 2)
                                                            <a onclick="return confirm('Are you sure you want to delete this page?')" href="{{route('pages.destroy',$page->id)}}" class="btn btn-danger btn-circle">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4">No pages available.</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                        {{ $pages->links() }}
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
