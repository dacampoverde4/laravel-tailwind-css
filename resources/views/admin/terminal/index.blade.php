@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22"><b class="vertical_align">Terminal</b>
                        <a class="btn btn-primary pull-right" href="{{ route('terminal.create') }}"><i class="fa fa-plus"></i> Add terminal</a>
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
                                            <th>Terminal ID</th>
                                            <th>Parcel Name</th>
                                            <th>Region Name</th>
                                            <th>Rank</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($terminals)
                                            @foreach($terminals as $terminal)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $terminal->terminal_id }}</td>
                                                    <td>{{ $terminal->parcel_name }}</td>
                                                    <td>{{ $terminal->region_name }}</td>
                                                    <td>{{ $terminal->rank }}</td>
                                                    <td>@if ($terminal->status==1)
                                                        Activated
                                                        @else
                                                        Deactivated
                                                    @endif</td>
                                                    
                                                    {{-- <td>{{ date('M d, Y', strtotime($terminal->expiry_date)) }}</td> --}}
                                                    <td>
                                                        <a href="{{route('terminal.edit',$terminal->id)}}" class="btn btn-info btn-circle">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <form action="{{ route('terminal.destroy', $terminal->id) }}" onsubmit="return confirm('Are you sure?');" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-circle" type="submit" ><i class="fa fa-trash"></i></button>
                                                        </form>
                                                           
                                                                
                                                            </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4">No terminal available.</td>
                                            </tr>
                                        @endif
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
