@extends('admin.New.layout.master')
@section('content')
<div class="row">
   <!-- Column -->
   <div class="col-lg-12 col-xlg-12">
      <div class="card">
         <div class="card-body">
            <div class="row">
               <div class="col-12">
                  <h3 class="inline_block font22"><b class="vertical_align"><img src="{{ asset('backend/images/taguser.png') }}" alt="Img" title="Img" class="announcement"> TOKENS</b>                    
                     <a href="{{route('token.create')}}" class="btn btn-info pull-right">Add Token</a>
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
                           <table id="myTable" class="table table-bordered table-striped">
                              <thead>
                                 <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Icon</th>
                                    <th>Token</th>
                                    <th>Discount</th>
                                    <th>Additional Text</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach($tokens as $token)
                                 <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $token->title }}</td>
                                    <td>{{ $token->description }}</td>
                                    <td> @if($token->icon) <img style="width: 100px;" src="{{ url('uploads/tokenicon/'.$token->icon) }}"> @endif</td>
                                    <td>{{ $token->amount }}</td>
                                    <td>{{ $token->discount }}</td>
                                    <td>{{ $token->additional_text }}</td>
                                    <td>
                                       <a href="{{ route('token.edit', $token->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                       <a onclick="return confirm('Are you sure you want to delete token?')" href="{{ route('token.delete', $token->id)}}" class="btn btn-info btn-circle btn-danger" title="Suspend"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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