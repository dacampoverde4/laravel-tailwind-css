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
                        <b class="vertical_align"><img src="{{ asset('backend/images/allusers.png') }}" alt="Report" title="Img" class="all_users">  Group Plan Mapping</b>

                          <a href="{{route('subscription-plan-usergroup.create')}}" style="margin:0 10px" class="btn btn-info pull-right">Add Group</a>
                        </h3>
                        <hr>
                        <div class="row">
                            <div class="text-center text_cntr top_intro">
                                <span> Group Plan Mapping is used to set what premium membership plan a user upgrades from and to when he changes his User Group from one to another. For example: Child subscribed to Kool Kid membership plan and changes his User Group from Child to Teen. He is automatically upgraded to "Pre-Teen" plan, set by admin in Group Plan Mapping.</span>
                            </div>
                        </div>
                        <div class="announcement_box paddingtb20">
                            <div class="container-fluid">
                                @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                @endif
                                @if(session()->has('Error'))
                                <div class="alert alert-danger">
                                    {{ session()->get('Error') }}
                                </div>
                                @endif
                            </div>
                                <div class="table-responsive m-t-40">
                                    <table class="table table-striped table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Point 1</th>
                              <th>Point 1 Plan</th>
                              <th>Point 2</th>
                              <th>point 2 plan</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                           @foreach($groups as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$item->group_point_first->title}}</td>
                                <td>@if(!empty($item->group_point1_plan->name))
                               {{$item->group_point1_plan->name}} @endif</td>
                                <td>{{$item->group_point_second->title}}</td>
                                <td>@if(!empty($item->group_point2_plan->name))
                                    {{$item->group_point2_plan->name}}
                                @endif </td>
                                {{-- <td>
                                    <i href="{{route('subscription-plan-usergroup.show',$item->id)}}" class="btn btn-info btn-circle"><i class="fa fa-eye"></i></i>
                                        <td> --}}
                                    <td>
                                        {{-- <i href="{{route('subscription-plan-usergroup.edit',$item->id)}}" class="btn btn-info btn-circle pull-left"><i class="fa fa-pencil"></i></i> --}}
                                            <form action="{{ route('subscription-plan-usergroup.destroy', $item->id) }}" method="post">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button class="btn btn-danger" type="submit"><i class="fa fa-trash" Onclick="return ConfirmDelete()"></i></button>
                                            </form>
                                        </td>
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
<script>
function ConfirmDelete() {
    return confirm("Are you sure you want to delete?");
  }
  $(document).ready(function() {
    $('.table').DataTable();
});
</script>
@endsection
