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
                          <h4 class="inline_block font20"><b class="vertical_align"><i class="fa fa-envelope"></i>FAMILY ROLES</b>

                            <a href="{{route('familyrole.create')}}" class="btn btn-success pull-right">Add Role</a></h3>
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
                                            <th>Gender</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sortable">
                                       @foreach($familyRoles as $role )
                                         <tr id="{{$role->id}}">
                                            <td>{{ $loop->iteration }} </td>
                                            <td>{{$role->title}}</td>
                                            <td>{{$role->gender}}</td>
                                            <td>
                                                <a href="{{route('familyrole.edit', $role->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                                <a href="{{route('familyrole.delete',$role->id)}}" onclick="return confirm('Are you sure you want to delete this Family Role?')" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i> </a>

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
          url: "{{url('admin/family-role/sort-items')}}",
          data: {
            data: data,
            action: 'action_sort_familyroles',
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
