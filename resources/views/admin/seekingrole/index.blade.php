@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font20"><b class="vertical_align"><i class="fa fa-envelope"></i> SEEKING ROLES</b>
                            <a href="{{route('seekingrole.create')}}" class="btn btn-info pull-right">Add Role</a>
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
                                    <table class="table table-striped table-bordered table-bordered mtop20">
                                        <thead>
                                        <tr>
                                            <th>Sr.No.</th>
                                            <th>Title</th>
                                            <th>Seekinig Role</th>
                                            <th>Family Role</th>
                                            <th>User Group</th>
                                            <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody id="sortable">
                                        @if(count($seekingroles))
                                        @foreach($seekingroles as $role )
                                        <tr id="{{$role->id}}">
                                            <td>{{ $loop->iteration }} </td>
                                            <td>{{$role->title}}</td>
                                            <td>
                                              @php
                                                  $userRoles = array();
                                                  $getRoles = ( $role->seeking_roles )? json_decode( $role->seeking_roles ) : array();
                                                  if( $getRoles ){
                                                      foreach( $getRoles as $roles ){
                                                          $roledata = App\FamilyRole::find($roles);
                                                          if( $roledata ){
                                                              $userRoles[] = $roledata->title;
                                                              }
                                                          }
                                                          echo implode(', ', $userRoles);
                                                      }
                                               @endphp
                                            </td>
                                            <td>
                                                @php
                                                    $userRoles = array();
                                                    $getRoles = ( $role->family_roles )? json_decode( $role->family_roles ) : array();
                                                    if( $getRoles ){
                                                        foreach( $getRoles as $roles ){
                                                            $roledata = App\FamilyRole::find($roles);
                                                            if( $roledata ){
                                                                $userRoles[] = $roledata->title;
                                                            }
                                                        }
                                                        echo implode(', ', $userRoles);
                                                    }
                                                @endphp
                                            </td>
                                            <td>
                                                @php
                                                    $userRoles = array();
                                                    $getRoles = ( $role->usergroups )? json_decode( $role->usergroups ) : array();
                                                    if( $getRoles ){
                                                        foreach( $getRoles as $roles ){
                                                            $roledata = App\Usergroup::find($roles);
                                                            if( $roledata ){
                                                                $userRoles[] = $roledata->title;
                                                            }
                                                        }
                                                        echo implode(', ', $userRoles);
                                                    }
                                                @endphp
                                            </td>
                                            <td>
                                                <a href="{{route('seekingrole.edit', $role->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                                <a href="{{route('seekingrole.delete',$role->id)}}" onclick="return confirm('Are you sure you want to delete this Seeking Role?')" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i> </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                        @else
                                            <tr>
                                                <td colspan="10" class="text-center text-danger">No record found</td>
                                            </tr>
                                        @endif
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
    $(document).ready(function(){

     $( "#sortable" ).sortable({
     update: function(event, ui) {
       var data=[];
       $("#sortable tr").each(function(){
         data.push($(this).attr("id"));
       });
       $.ajax({
           method: "POST",
           url: "{{url('admin/seeking-role/sort-items')}}",
           data: {
             data: data,
             action: 'action_sort_seekingroles',
             _token: "{{csrf_token()}}"
           }
       })
       .done(function( msg ) {
         location.reload();
       });
     }
    });
    $( "#sortable" ).disableSelection();
    });
</script>
@endsection
