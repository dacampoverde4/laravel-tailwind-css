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
                       <h3 class="inline_block font22"><b class="vertical_align"><img src="{{ asset('backend/images/taguser.png') }}" alt="Img" title="Img" class="announcement">RELATIONSHIP STATUS</b>                  
                           <a href="{{route('admin.relationship.create')}}" class="btn btn-success pull-right">Add Relationship</a>
                       </h3>  
                       <hr>
                        @php
                            use App\UsergroupTag;
                            
                        @endphp
                    <div class="gender_box mtop30">
                         @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                           <div class="container-fluid">
                               @if(session()->has('message'))
                               <div class="alert alert-success">
                                   {{ session()->get('message') }}
                               </div>
                               @endif
                               <div class="table-responsive m-t-40">
                                <table class="table table-bordered">
                                    <th>#</th>
                                    <th>Relationship</th>
                                    <th>UserGroups</th>
                                    <th>Action</th>
                                   
                                    @foreach($relationships as $key=>$relationship)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$relationship->title}}</td>
                                        
                                        <td>
                                        <div style="display:flex">
                                            @if( $usergroups_in_relationship[$key]  )
                                                @foreach($usergroups_in_relationship[$key] as $eachRecord)
                                                    <div class="Usergradientbg" style="width: 100px; margin-right: 5px;text-align:center; background: linear-gradient(-45deg, {{ UsergroupTag::find($eachRecord->tags)->primary_color }} 50%, {{ UsergroupTag::find($eachRecord->tags)->secondary_color }} 50%);">
                                                        <span>{{ $eachRecord->title }}</span>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.relationship.edit', $relationship->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                            <a onclick="return confirm('Are you sure you want to delete relationship?')" href="{{ route('admin.relationship.delete', $relationship->id)}}" class="btn btn-info btn-circle btn-danger" title="Suspend"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
