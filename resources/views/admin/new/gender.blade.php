@extends('admin.New.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22"><b class="vertical_align"><img src="{{ asset('backend/images/genderrole.png') }}" alt="Gender" title="Img" class="gender_img"> GENDER ROLE</b>
                            <a href="{{route('admin.create.gender')}}" class="btn btn-info pull-right">Add Gender</a>
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
                                                <th>Title</th>
                                                <th>Gender</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; ?>
                                            @foreach($gender as $row)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$row->title}}</td>
                                                <td>{{$row->gender}}</td>
                                                <td>
                                                    <a href="{{route('gender.edit',$row->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                                    <a href="{{route('gender.delete',$row->id)}}" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i></a>
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