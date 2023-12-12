@extends('admin.New.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="font22"><b class="vertical_align"><img src="{{ asset('backend/images/report.png') }}" alt="Report" title="Img"> REPORTS</b></h3>
                        <hr>
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                        <div class="gender_box mtop30">
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
                                                <th>User ID</th>
                                                <th>Reported ID</th>
                                                <th>Reason</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($blockusers as $blockuser)
                                            @php
                                            $blockedbyinfo = App\User::find($blockuser->user_id);
                                            $blockeduserinfo = App\User::find($blockuser->block_id);
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ @$blockedbyinfo->name }}</td>
                                                <td>{{ @$blockeduserinfo->name }}</td>
                                                <td>{{ $blockuser->reason }}</td>
                                                <td>{{ $blockuser->description }}</td>
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