@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22"><b class="vertical_align"><img src="{{ asset('backend/images/job2.png') }}" alt="Img" title="Img" class="announcement">JOBS CATEGORIES</b>
                        <a href="{{route('createcategories.jobs')}}" class="btn btn-info pull-right">Add categories</a>
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
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                    @if(!empty($jobs))
                                    @foreach($jobs as $job)   
                                     <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$job->category_name}}</td>
                                        <td>
                                            <a href="{{ route('categoriesedit.jobs', $job->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                            <a onclick="return confirm('Are you sure you want to delete?')" href="{{ route('destroycategories.jobs', $job->id)}}" class="btn btn-info btn-circle btn-danger" title="Suspend"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                         </td>
                                    </tr>   
                                    @endforeach     
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
