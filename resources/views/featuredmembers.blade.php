@extends('v7.frontend')

@section('page_level_styles')

      <link rel="stylesheet" type="text/css" href="{{ asset('frontend/font-awesome/css/font-awesome.min.css') }}">
  <!--<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">-->
  <!--<link href="https://fonts.googleapis.com/css?family=Bubblegum+Sans|Delius" rel="stylesheet">-->
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owl.carousel.min.css') }}"> 
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}">
  <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/isotope.pkgd.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('frontend/js/custom.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/notify.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/common.js') }}" type="text/javascript"></script>
  <script type="text/javascript">
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'url' => url('/'),
        ]); ?>
    </script>
           @yield('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/custom.css') }}">
 
    
    <!-- BEGIN PAGE LEVEL STYLES -->
    @yield('page_level_styles')
    
<style>
  .browse_query_box {
    width: 100%;
    background: #fff;
  }
  .browse_main {
    display: block;
    float: right;
    width: 100%;
    background: #fff;
  }
  #upgradeAccount-btn {
    margin: 30px 0 0;
  }
</style>
    @stop
@section('content')
<div class="browse_main mb30">
    <div class="col-md-12 text-center">
    	<div class="pgttlsec">
	        <h2>Featured Memebers</h2>
	    </div>
    </div>
    
    <div class="clearfix"></div>
    <div class="browse_query_box cont_sec2 min_height">
    <div class="users_box row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            @foreach($users as $user)

            	@php
                    $issubscribed = isthisUserSubscribed($user->id);
                    $isfeatured = isthisSubscribedFeature($user->id);
                @endphp 
                 @if( $isfeatured )
                <div class="col-md-3 col-sm-3 text-center user_outer_box">
                 
                <div class="user_img featuredmem_sec">
                   
                    @if( $issubscribed )
                         <div class="p_tag">P</div>
                    @endif
                   
                        <div class="featured_tag"><span>Featured</span></div>
                    
                    <a href="{{ url('userprofile')}}/{{ base64_encode($user->id) }}">
                        <div class="imgbox"  style="background-image:url({{ ( $user->profile_pic )? url('/uploads').'/'.$user->profile_pic : url('/images/default.png')}});">
                        
                        </div>
                    </a>
                    {!! getGroupTagWithColor($user->id) !!}
            

                        <h3 class="featured_userttl">
                            <div class="inline_block tooltip_box feat_tooltip">
                                <i style="color: @if( $user->is_online ) green @else red @endif" class="fa fa-bars"  aria-hidden="true"></i>
                                <div class="tooltip2">
                                <div class="tooltip2_inner vertical_align">
                                    <div class="col-md-5 col-sm-6 col-xs-12">
                                        <a href="{{ url('userprofile')}}/{{ base64_encode($user->id) }}" class="featured_user2" style="background-image:url({{ ( $user->profile_pic )? url('/uploads').'/'.$user->profile_pic : url('/images/default.png')}});">
                                        </a>   
                                    </div>
                                    <div class="col-md-7 col-sm-6 col-xs-12 padding0">
                                        <ul>
                                            <li class="">
                                              <img src="{{ url('/') }}/frontend/images/user.png" alt="Profile Icon" title="Profile Icon" class="feat_lst_icons"><span>Name: <a href="{{ url('userprofile')}}/{{ base64_encode($user->id) }}">{{ title_case( $user->display_name_on_pages ) }}</a></span>
                                            </li>
                                            <li class=""><img src="{{ url('/') }}/frontend/images/age.png" alt="Age Img" title="Age Img" class="feat_lst_icons"><span>Age: {{ ( $user->age )? $user->age . ' Years' : '' }}</span>
                                            </li>
                                            <li class="">
                                              <img src="{{ url('/') }}/frontend/images/gender.png" alt="Gender Icon" title="Gender Icon" class="feat_lst_icons"><span>Gender: {{ @$user->usergender->title }}</span>
                                            </li>
                                            <li class=""><img src="{{ url('/') }}/frontend/images/last_login.png" alt="last Login Icon" title="Profile Icon" class="feat_lst_icons"><span>Status: 
                                                @if( $user->is_online )
                                                    <span class="fontgreen">Online</span>
                                                @else
                                                    <span class="fontred">Offline</span>
                                                @endif
                                                </span>
                                            </li>
                                        </ul> 
                                    </div>
                                </div>
                                <div class="tooltip2_inner">
                                    <div class="tooltip_intro">
                                        @if( $user->about_me )
                                            <p><span><b>Introduction:</b></span>{{ str_limit($user->about_me, 100, ' ...') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="featured_tag"><span>Featured</span></div>                                
                            </div>   
                            </div>
                            {{ @$user->displayname }}
                        </h3>
   
                    <div class="users_info mtop20"><p><span>{{ likeCount($user->id) }} </span><span>Likes</span></p><p><span>{{ \App\Match::matchCount($user->id) }} </span><span>Matches</span></p></div>
            
                </div>
            </div>
            @endif
            @endforeach
             
        </div>             
    </div>
     </div>
</div>
    <!-- -------------All Images------------- -->
</div>
</div>

@endsection
@section('scripts')

@endsection