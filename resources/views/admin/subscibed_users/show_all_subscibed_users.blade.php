@extends('admin.layout.master')
@section('page_css')
<style type="text/css">
    th.profilepicture{
        width: 90px !important;
    }
</style>
 
@endsection
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22">
                            <b class="vertical_align">SUBSCRIBED MEMBERS</b>
                        </h3>
                        <hr>
                    </div>
                </div>
                <form class="row" action="" method="get">
                    <div class="form-group has-feedback col-md-4">
                        <label for="Catgory">User Group:</label>
                        <select class="form-control select2" name="group" id="group">
                            <option value="">Select UserGroup</option>
                            @foreach($usergroups as $usergroup_obj)
                           
                          
                            <option value="{{$usergroup_obj->id}}" @if(isset($search['group']) && $search['group'] == $usergroup_obj->id) selected='selected' @endif>{{ @$usergroup_obj->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group has-feedback col-md-4">
                        <label for="username">User Name:</label>
                        <input name="username" class="form-control" id="username" value="{{ isset($search['username']) ? $search['username'] : '' }}" type="text">
                    </div>
                    <input type="hidden" name="searchdata" value="1">
                    <div class="col-md-12">
                        <label for=""></label>
                        <input type="submit" name="search" class="btn btn-primary" value="Search" />
                        @if(isset($search['searchdata']) && $search['searchdata'] == 1)
                        <a href="{{ route('admin.subscibed_users') }}" class="btn btn-info">Reset Filter</a>
                        @endif
                    </div>
                </form>
                <div class="row">
                    <div class="announcement_box paddingtb20 col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="profilepicture">Profile</th>
                                        <th>Name</th>
                                        <th>Group</th>
                                        <th>Subscribed Plan</th>
                                        <th>Expires at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subscribed_users as $user_obj)
                                        @if(!$user_obj->currentplan || ($user_obj->currentplan && $user_obj->currentplan->name != 'Free'))
                                        <tr>
                                            <td><img src="{{ asset($user_obj->profilepicture) }}" class="img-circle" width="80" /></td>
                                            <td>{{ $user_obj->name }}</td>
                                            <td>{{ @$user_obj->usergroup->title }}</td>
                                            <td>{{ $user_obj->currentplan ? $user_obj->currentplan->name : '' }}</td>
                                            <td>{{ $user_obj->subscribedPlan && $user_obj->subscribedPlan->ends_at ? date('M d, Y', strtotime($user_obj->subscribedPlan->ends_at)) : '' }}</td>
                                        </tr>
                                        @endif
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