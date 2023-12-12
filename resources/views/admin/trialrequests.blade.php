@extends('admin.layout.master')
@section('content')
@php
use App\TrialLocation;
use App\FamilyRole;
@endphp
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font20"><b class="vertical_align"><i class="fa fa-map-marker" aria-hidden="true"></i> Trial Requests</b>
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
                                            <th>Sent From</th>
                                            <th>Sent To</th>
                                            <th>Family Role</th>
                                            <th>Trial Details</th>
                                            <th>Trial Status</th>
                                            <th>Created_at</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach($allTrialRequests as $request )
                                        <?php
                                       // echo $request->matcherid->displayname;
                                        
                                    // echo $request->matcherid->display_name_on_pages;
                                        //echo 'dsd<pre>';print_r($request->userid->display_name_on_pages);die;
                                      
                                        $getLocation = TrialLocation::find($request->trial_location_id);
                                        $getFamilyRoleInfo = FamilyRole::find($request->trial_family_role);
                                        ?>
                                        <tr id="{{$request->id}}">
                                            <td>{{ $loop->iteration }} </td>

                                            <td>{{@$request->userid->display_name_on_pages}}</td>

                                            <td>
                                            {{@$request->matcherid->display_name_on_pages}}
                                            </td>

                                            <td>{{$getFamilyRoleInfo->title}}</td>

                                            <td><p><b>Trial details:</b> {{date("d F Y",strtotime($request->trial_date))}}, {{date("h:ia", strtotime($request->trial_time))}}, <a href="{{$getLocation->address}}">{{$getLocation->address}}</a></p></td>

                                            <td>
                                              @if($request->is_sent == 1)
                                                <span class="label label-success text-center">Sent</span>
                                              @endif

                                              @if($request->is_maybe == 1)
                                                <span class="label label-info text-center">May be</span>
                                              @endif

                                              @if($request->is_decline == 1)
                                                <span class="label label-danger text-center">Declined</span>
                                              @endif

                                              @if($request->is_accepted == 1)
                                              <span class="label label-success text-center">Accepted</span>
                                              @endif

                                              @if($request->is_ended == 1)
                                                <span class="label label-warning text-center">Expired</span>
                                              @endif

                                              @if($request->is_success == 1)
                                              <span class="label label-success text-center">Success</span>
                                              @endif
                                            </td>

                                            <td>{{date("d F Y",strtotime($request->created_at))}}</td>

                                            <td>
                                              <div class="requestActionButtons">
                                                <a class="btn btn-danger" href="{{ route('trials.adminCancelRequest', $request->id) }}">Cancel Request</a>
                                              </div>
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
