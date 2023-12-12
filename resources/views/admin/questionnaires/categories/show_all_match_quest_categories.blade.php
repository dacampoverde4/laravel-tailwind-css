@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22">
                            <b class="vertical_align">MATCH QUEST CATEGORIES</b>
                            <a href="{{route('matchquestcategories.create')}}" style="margin:0 10px" class="btn btn-info pull-right">Add New Category</a>
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
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Banner</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($match_quest_categories as $category_obj)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $category_obj->name }}</td>
                                                <td>
                                                    <img src="{{ asset($category_obj->bannerimage) }}" alt="your image" style="width: 300px;" />
                                                </td>
                                                <td>
                                                    <a href="{{route('matchquestcategories.edit',$category_obj->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
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
});
</script>
@endsection