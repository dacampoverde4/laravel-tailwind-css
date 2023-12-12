@extends('admin.New.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="font22 inline_block"><b class="vertical_align"><img src="{{ asset('backend/images/roles.png') }}" alt="Gender" title="Img" class="gender_img"> ROLE</b>                 
                        <a href="{{route('admin.create.role')}}" class="btn btn-info pull-right">Add Role</a>
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
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sr.No.</th>
                                        <th>Roles</th>
                                        <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; ?>
                                            @foreach($role as $row)
                                     <tr>

                                        <td>{{$i++}}</td>
                                        <td>{{$row->role}}</td>
                                        <td><a href="{{route('edit.role',$row->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
            <a href="{{route('role.delete',$row->id)}}" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i></button></td>
                                     



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
