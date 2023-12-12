@extends('layouts.master')
@section('htmlheader')
    <link href="http://demo.expertphp.in/css/dropzone.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <script src="http://demo.expertphp.in/js/dropzone.js"></script>
    <script src="{{ asset('backend/js/profile.js') }}" type="text/javascript"></script>
@endsection
@section('main-content')
    <div class="container-fluid page-wrapper notifcn_pg">
        <div class="row page-titles m-b-0">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor"><i class="mdi mdi-bell"> </i> Notifications</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Notifications</li>
                </ol>
            </div>
            <div>
                <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10">
                    <i class="ti-settings text-white"></i></button>
            </div>
        </div>


        @php
            $notifications = getAllNotification();
        @endphp
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row sec1ttl">
                        <div class="col-xs-6 col-lg-6"><h4 class="card-title">Notifications</h4></div>
                        <div class="col-xs-6 col-lg-6 text-right">
                            <form action="{{route('notification.removeAll')}}" method="post">
                                @csrf
                                @if( $notifications->count()>0 ) <input type="submit" class="btn btn-danger rmv_btn"
                                                                        value="Remove All"> @endif
                            </form>
                        </div>
                    </div>
                    @if (session('message'))
                        <div class="alert alert-success alert-dismissible mt-3">
                            <a href="javascript:void(0)" class="close" data-dismiss="alert"
                               aria-label="close">&times;</a>
                            {{ session('message') }}
                        </div>
                    @endif
                    @if( $notifications->count()>0 )
                        <?php //echo '<pre>';print_r($notifications);die;?>
                            @foreach( $notifications as $notification )                                
                                    @php
                                        $userdata = \App\User::find($notification->created_by);
                                    @endphp
                                   
                                        <div class="row">
                                            <div class="col-sm-12 col-md-1">
                                                <div class="imgsec">
                                                    @if($userdata)
                                                        <img src="{{ $userdata->profile_pic_url  }}"
                                                             alt="user" class="img-circle" height="50"
                                                             width="50">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                {!! $notification->message !!}
                                                <a href="{{route('notification.delete',$notification->id)}}" title="Delete">
                                                    <i class="fa fa-trash text-danger"></i>
                                                </a>
                                            </div>
                                            
                                            <div class="col-sm-6 col-md-2 nottime_sec">
                                                <span class="text-muted">{{$notification->created_at->diffForHumans()}}</span>
                                            </div>
                                        </div>
                                        
                                        &nbsp;&nbsp;  
                                        
                                        
                                                                        
                            @endforeach
                        
                        <div class="mt-3"></div>
                        {{ $notifications->links() }}
                </div>
                @else
                    <div class="text-center">You have no notification as yet.</div>
                @endif
            </div>
        </div>
    </div>
@endsection
