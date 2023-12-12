@extends('layouts.master')
@section('htmlheader')
<link href="http://demo.expertphp.in/css/dropzone.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<script src="http://demo.expertphp.in/js/dropzone.js"></script>
<script src="{{ asset('backend/js/profile.js') }}" type="text/javascript"></script>
@endsection
@section('main-content')
<div class="maincontent backend">
    <div class="content"> 
        <div class="profile_edit">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="allnotifications">
                            <div class="container-fluid">
                                <h4 class="font22"><b class="vertical_align"><img src="{{ asset('backend/images/all_notification.png') }}" alt="Img" title="Img" class="all_users">ALL NOTIFICATION</b></h4>
                                
                            </div>
                            <hr>
                            <ul class="allnotifications mtop30">
                                 @php
                                     $notifications = getAllNotification();
                                 @endphp
                                 @if( $notifications )
                                    @foreach( $notifications as $notification )
                                                @php
                                                    $userdata = \App\User::find($notification->created_by);
                                                    $profilepic = ( @$userdata->profile_pic )? 'uploads/'. $userdata->profile_pic : 'images/default.png';
                                                @endphp
                                                @if( $userdata )
                                                    <li>
                                                        <a href="{{url('userprofile')}}/{{ base64_encode($notification->created_by) }}" class="notify vertical_align mb20" notify_id="{{ $notification->id }}" class="vertical_align">
                                                            <div class="col-md-2 padding0"><img src="{{ asset($profilepic) }}" class="img-circle" alt=""></div>
                                                            <div class="col-md-10 "><h4>{{ $userdata->name }}</h4><p>{{ $notification->message }}</p> 
                                                            <h6>{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</h6>
                                                           </div>
                                                        </a>
                                                    </li>                                                  
                                                @endif                                            
                                    @endforeach
                                @endif
                            </ul>
                
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection
