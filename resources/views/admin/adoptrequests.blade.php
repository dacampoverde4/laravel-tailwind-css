@extends('admin.layout.master')
@section('content')
@php
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
                        <h3 class="inline_block font20"><b class="vertical_align"><i class="fa fa-map-marker" aria-hidden="true"></i> Adoption Requests</b>
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
                                            <th>Adoption Status</th>
                                            <th>Created_at</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach($allAdoptRequests as $request )
                                        <?php
                                        $getFamilyRoleInfo = FamilyRole::find($request->trial_family_role);
                                        ?>
                                        <tr id="{{$request->id}}">
                                            <td>{{ $loop->iteration }} </td>

                                            <td>{{@$request->userid->display_name_on_pages}}</td>

                                            <td>{{@$request->matcherid->display_name_on_pages}}</td>

                                            <td>{{@$getFamilyRoleInfo->title}}</td>

                                            <td>
                                              @if($request->adoption_success == 1)
                                                <span class="label label-success text-center">Sent</span>
                                              @endif

                                              @if($request->adopt_is_decline == 2)
                                                <span class="label label-danger text-center">Declined</span>
                                              @endif

                                              @if($request->adopt_is_accepted == 1)
                                              <span class="label label-success text-center">Accepted</span>
                                              @endif

                                            </td>

                                            <td>{{date("d F Y",strtotime($request->created_at))}}</td>

                                            <td>
                                              <div class="requestActionButtons">
                                                <a class="btn btn-danger" href="{{ route('adopts.adminCancelAdoptRequest', $request->id) }}">Cancel Request</a>
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
