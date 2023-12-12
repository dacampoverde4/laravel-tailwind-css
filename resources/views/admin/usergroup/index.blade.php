@extends('admin.layout.master')
@section('page_css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@stop
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font20"><b class="vertical_align"><i class="fa fa-envelope"></i>USERGROUP</b>
                                                
                        <a href="{{route('usergroup.create')}}" class="btn btn-info pull-right">Add Group</a>
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
                                     <table class="table table-bordered">
                                <thead>
                                        <tr>
                                           <th>Sr.No.</th>
                                            <th>Title</th>
                                            <th>Age(Min.)</th>
                                            <th>Age(Max.)</th>
                                            <th>Gender Role</th>
                                            <th>Tag</th>
                                            <th>Membership</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sortable">
                                       @foreach($usergroups as $usergroup )
                                         <tr id="{{$usergroup->id}}">
                                            <td>{{ $loop->iteration }} </td>
                                            <td>{{$usergroup->title}}</td>
                                            <td>{{$usergroup->minage}}</td>
                                            <td>{{$usergroup->maxage}}</td>
                                            <td>
                                                @php
                                                    $userRoles = array();
                                                    $getRoles = ( $usergroup->genderrole )? json_decode( $usergroup->genderrole ) : array();
                                                    if( $getRoles ){
                                                        foreach( $getRoles as $roles ){
                                                            $roledata = App\GenderRole::find($roles);
                                                            if( $roledata ){
                                                                $userRoles[] = $roledata->title;
                                                            }
                                                        }
                                                        echo implode(', ', $userRoles);
                                                    }
                                                @endphp
                                            </td>
                                            <td>
                                                @if( @$usergroup->tagdata->title  )
                                                    <div class="Usergradientbg" style="background: linear-gradient(-45deg, {{ @$usergroup->tagdata->primary_color }} 50%, {{ @$usergroup->tagdata->secondary_color }} 50%);">
                                                        <span>{{ @$usergroup->tagdata->title }}</span>
                                                    </div> 
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $userMembership = array();
                                                    $getPlans = ( $usergroup->membership_plans )? json_decode( $usergroup->membership_plans ) : array();
                                                    if( $getPlans ){
                                                        foreach( $getPlans as $plans ){
                                                            $plandata = App\Plan::find($plans);
                                                            if( $plandata ){
                                                                $userMembership[] = $plandata->name;
                                                            }
                                                        }
                                                        echo implode(', ', $userMembership);
                                                    }
                                                @endphp
                                            </td>
                                            <td>
                                                <a href="{{route('usergroup.edit',$usergroup->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                                <!--a class="btn btn-info btn-circle" href="{{route('usergroup.membership',$usergroup->id)}}" title="Feature"> <i class="fa fa-plus-square" aria-hidden="true"></i></a-->
                                                <a href="{{ route('questionnaires.init') }}" class="btn btn-primary btn-circle"><i class="fa fa-question" aria-hidden="true"></i></a>
                                                <a href="{{route('usergroup.notes',$usergroup->id)}}" class="btn btn-warning btn-circle"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                                                <a href="{{route('usergroup.delete',$usergroup->id)}}" onclick="return confirm('Are you sure you want to delete this group? It will delete notes, questionnaries under this group')" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i> </a>
                                                <a title="Pricing" class="btn btn-info btn-circle" href="{{route('feature.pricing',$usergroup->id)}}"><i class="fa fa-usd" aria-hidden="true"></i></a>
                                                <a title="Search Setting" class="btn btn-info btn-circle" href="{{route('usergroup.browse',$usergroup->id)}}"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
          url: "{{url('ajaxrequest/sort-items')}}",
          data: {
            data: data, 
            action: 'action_sort_usergroups',
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
