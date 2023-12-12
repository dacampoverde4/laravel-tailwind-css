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
                        <h3 class="inline_block font20"><b class="vertical_align"><i class="fa fa-map-marker" aria-hidden="true"></i> Trial Locations</b>
                            <a href="{{route('triallocation.create')}}" class="btn btn-info pull-right">Add Location</a>
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
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Created_at</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach($triialLocations as $location )
                                        <tr id="{{$location->id}}">
                                            <td>{{ $loop->iteration }} </td>
                                            <td>
                                              <img src="{{url('uploads/location')}}/{{$location->image}}"  height=75px width=75px/></td>
                                            <td>{{$location->name}}</td>
                                            <td>{{$location->address}}</td>
                                            <td>{{$location->created_at}}</td>
                                            <td>
                                                <a href="{{route('triallocation.edit', $location->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                                <a href="{{route('triallocation.delete',$location->id)}}" onclick="return confirm('Are you sure you want to delete this Family Role?')" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i> </a>
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
