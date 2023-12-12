@extends('admin.layout.master')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="font22 inline_block">
                             <b class="vertical_align">
                               <img src="{{ asset('backend/images/user.png') }}" alt="Species" title="Img" class="gender_img">
                               Species
                           </b>
                           <a href="{{route('admin.species.create')}}" class="btn btn-success pull-right">Add Species</a>
                        </h3><hr>
                            <div class="gender_box mtop30">
                               <div class="container-fluid">
                                   @if(session()->has('message'))
                                   <div class="alert alert-success">
                                       {{ session()->get('message') }}
                                   </div>
                                   @endif
                                   <div class="table-responsive m-t-40">
                                     @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('warning'))
                                    <div class="alert alert-warning">
                                        {{ session('warning') }}
                                    </div>
                                @endif
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <?php $i=1; ?>
                                        <th>Sr.No.</th>
                                        <th>Species Name</th>
                                        <th>Action</th>
                                    </tr>
                                    @if(count($species))
                                    @foreach($species as $row)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>
                                            <a href="{{route('admin.species.edit',$row->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                            <a href="javascript:void(0);" onclick="deleteItem({{$row->id}},'{{route('admin.species.delete',$row->id)}}')"
                                               class="btn btn-danger btn-circle">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
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
