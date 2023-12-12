@php
$title_by_page = "Blocked Users";
@endphp
@extends('layouts.master')
@section('htmlheader')
<link href="http://demo.expertphp.in/css/dropzone.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<script src="http://demo.expertphp.in/js/dropzone.js"></script>
<script src="{{ asset('backend/js/profile.js') }}" type="text/javascript"></script>
@endsection
@section('main-content')

 <div class="container-fluid page-titles">
    <div class="row">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-envelope"> </i> Blocked Users List</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Blocked Users List</li>
                </div>
                <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
    </div>
</div>
            
              @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
            
                         @php
                             $blockUsers = App\Reportblock::where('user_id',Auth::user()->id)->where('type','block')->get();
                         @endphp
     <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">          
             <table class="table table-bordered">
                                <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>UnBlock</th>
                                </tr>
                                
                                @foreach($blockUsers as $blockUser)
                                <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $blockUser->userdisplayname->display_name_on_pages }}</td>
                                <td>
                                    <a href="{{ route('user.unblock',$blockUser->id) }}" title="Unblock" class="btn btn-info btn-circle"><i class="fa fa-unlock-alt" aria-hidden="true"></i></a>
                                </td>
                                
                                </tr> 
                                
                                @endforeach
                                </table>
                   
                                 </div>
                        </div>
                    </div>
                </div>
             </div>        

@endsection
