@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block"><b class="vertical_align"><img src="{{ asset('backend/images/announcement2.png') }}" alt="Img" title="Img" class="announcement"> Ended Advertises</b>
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
                                                <th>Title</th>
                                                <th>User</th>
                                                <th>Status</th>
                                                <th>Paid</th>
                                                <th>Approve</th>
                                                <th>Start Date</th>
                                                <th>Ended Date</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($endedads as $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                 <td>{{ $value->title }}</td>
                                                 <td>{{ $value->name }}</td>
                                                 <td>{{$value->status}}</td>
                                                 <td>{{ $value->paid == 1 ? 'Yes' : 'No' }}</td>
                                                 <td>{{ $value->start_at}}</td>
                                                 <td>{{ $value->ended_at}}</td>
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