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
                         <h3 class="font22 inline_block"><b class="vertical_align"><img src="{{ asset('backend/images/myfun.png') }}" alt="Gender" title="Img" class="gender_img">MY FUNS</b>
                          <a href="{{route('create.myfun')}}" class="btn btn-success pull-right">Add Fun</a>
                            </h3><hr>
                            <div class="gender_box mtop30">
                               <div class="container-fluid">
                                   @if(session()->has('message'))
                                   <div class="alert alert-success">
                                       {{ session()->get('message') }}
                                   </div>
                                   @endif
                                   <div class="table-responsive m-t-40">
                                  <table class="table table-bordered">
                                <th>#</th>
                                <th>Title</th>
                                <th>Action</th>
                                @foreach($myfuns as $myfun)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$myfun->title}}</td>
                                    <td>
                                        <a href="{{ route('edit.myfun', $myfun->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                        <a onclick="return confirm('Are you sure you want to delete tag?')" href="{{ route('delete.myfun', $myfun->id)}}" class="btn btn-info btn-circle btn-danger" title="Suspend"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

@endsection
