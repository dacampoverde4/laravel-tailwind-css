@extends('layouts.master')
@section('htmlheader')
<link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}"/><link rel="stylesheet" type="text/css" href="http://kenwheeler.github.io/slick/slick/slick-theme.css"/>
<script type="text/javascript" src="{{ asset('js/slick.js') }}"></script>
@endsection
@section('main-content')
<div class="maincontent backend">
    <div class="content">
<!-- Start profile Section -->
        <div class="profile_section mtopbottom20">
            <div class="container">
                @if ( !isthisSubscribed() )
        	        <div class="row upgrade">
            			<div class="col-md-10">
            				<div class="upgdinfo bggray font300">
            					<p>Hey {{ ucfirst( Auth::user()->display_name_on_pages ) }}! Upgrade your membership today to experience unlimited features.</p>
            				</div>
            			</div>
            			<div class="col-md-2">
                			<a style="padding: 18px 0px;" href="{{ url('pricing') }}" class="btn btnred width100">Upgrade Membership</a>
            			</div>
            		</div>
        	    @endif
                <div class="profile-section">
                    <div class="left-section">
                        <div class="slider-for">
                            <div><img  src="{{ ( $user->profile_pic )? url('/uploads').'/'.$user->profile_pic : url('/images/default.png')}}" alt="Profile Img" title="Profile Img"> </div>
                            @php
                                $images = $user->photos;
                            @endphp
                            @if( $images )
                                @foreach($images as $row)
                                    <div><img  src="{{ asset('/uploads/'.$row->image)}}" alt="Profile Img" title="Profile Img"> </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="right-section profile_info">
                        <div class="col-md-8">
                            <ul>
                                <li class="font17"><img src="{{url('/')}}/frontend/images/user.png" alt="Profile Icon" title="Profile Icon"> <span>Name: {{ ucfirst( $user->display_name_on_pages ) }} </span></li>
                                <li class="font17 customtitle"><div class="leftdiv"><img src="{{url('/')}}/frontend/images/membership.png" alt="Membership Icon" title="Membership Icon">  <span>Membership Type:</span></div> {!! getGroupTagWithColor($user->id) !!}</li>
                                <li class="font17"><img src="{{url('/')}}/frontend/images/age.png" alt="Age Img" title="Age Img">  <span>Age: {{ ( $user->age )? $user->age . ' Years' : '' }} </span></li>
                                <li class="font17"><img src="{{url('/')}}/frontend/images/gender.png" alt="Gender Icon" title="Gender Icon"> <span> Gender: {{ @$user->usergender->title }}</span></li>
                                <li class="font17"><img src="{{url('/')}}/frontend/images/user.png" alt="Species Icon" title="Species Icon"> <span> Species: {{ $user->species?$user->species->name:'N/A' }}</span></li>
                                <li class="font17"><img src="{{url('/')}}/frontend/images/join_date.png" alt="Join Date Icon" title="Profile Icon"> <span> Join Date: {{ ( $user->created_at )? date("F j, Y, g:i A", strtotime($user->created_at) ) : '' }}</span></li>
                                <li class="font17"><img src="{{url('/')}}/frontend/images/last_login.png" alt="last Login Icon" title="Profile Icon"> <span> Last Seen: {!! $user->last_seen_ago_html !!} </span></li>
                            </ul>
                        </div>
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-12 col-sm-12 mtop30">
                            <div class="col-md-8 padding0">
                                <button type="button" class="like_btn "><i style="font-size:30px" class="fa">&#xf087;</i>{{ $likecount }} Likes</button>
                                <button type="button" class="match_btn"><i style="font-size:30px" class="fa fa-check-square-o" aria-hidden="true"></i>{{ \App\Match::matchCount() }} Matches</button>
                            </div>
                            <div class="col-md-4 padding0 pull-right">
                                <a href="{{ route('edit.profile') }}" class="bgred leave_note">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                    @php
                        $images = $user->photos;
                    @endphp
                    @if( $images )
                        <div class="left-section mtopbottom20">
                            <div class="slider-thumb">
                                <div class="slider-nav">
                                    <div><img  src="{{ ( $user->profile_pic )? url('/uploads').'/'.$user->profile_pic : url('/images/default.png')}}" alt="Profile Img" title="Profile Img"> </div>
                                    @foreach($images as $row)
                                        <div><img  src="{{ asset('/uploads/'.$row->image)}}" alt="Profile Img" title="Profile Img"> </div>
                                    @endforeach
                                 </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-md-12 col-sm-12 mtop80 ">
                    <div class="col-md-6 padding0 about_me">
                        <h3 class="font_family">ABOUT ME</h3>
                        <p class="font17 fontclr73 mtopbottom">{{ $user->about_me}}</p>
                    </div>
                    @if($useranswer)
                        @php
                        $answerarray = json_decode($useranswer->answer_data,true);
                        $at_least_one_answer_found=0;
                        if($answerarray){
                            foreach($answerarray as $key=>$answer){
                                $model = App\Questionnaires::find($key);
                                if(count( $answerarray[$model->id] ) > 0 ){
                                    foreach($answerarray[$model->id] as $getanswer)
                                    {
                                        if($getanswer)
                                        {
                                            $at_least_one_answer_found=1;
                                        }
                                    }
                                }
                            }
                        }
                        @endphp
                        @if($at_least_one_answer_found)
                    <div class="col-md-6">
                        <div class="col-md-12 pull-right">
                            <h3 class="font_family">QUESTIONNAIRE</h3>
                            <div class="panel-group mtopbottom" id="accordion" role="tablist" aria-multiselectable="true">

                                @foreach($answerarray as $key=>$answer)
                                   @php
                                       $model = App\Questionnaires::find($key);
                                   @endphp
                                   @php
                                       $expanded='false';
                                       $collapse='panel-collapse collapse';
                                   @endphp
                                   @if ($loop->first)
                                       @php
                                           $expanded='true';
                                           $collapse='panel-collapse collapse in';
                                       @endphp
                                   @endif
                                    @php
                                    $answer_found=0;
                                    if(count( $answerarray[$model->id] ) > 0 ){
                                        foreach($answerarray[$model->id] as $getanswer){
                                            if($getanswer)
                                            {
                                                $answer_found=1;
                                            }
                                        }
                                    }
                                    @endphp
                                    @if($answer_found)
                                       <div class="panel panel-warning">
                                            <div class="panel-heading" role="tab" id="heading{{ $loop->iteration }}">
                                                <h4 class="panel-title font17">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $loop->iteration }}" aria-expanded="{{ $expanded }}" aria-controls="collapseOne">
                                                        {{ $model->question_title }}
                                                        <i class="fa fa-plus pull-right"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse{{ $loop->iteration }}" class="{{ $collapse }}" role="tabpanel" aria-labelledby="heading{{ $loop->iteration }}">
                                                <div class="panel-body fontclr73">
                                                    @if(count( $answerarray[$model->id] ) > 1 )
                                                        <ul>
                                                            @foreach($answerarray[$model->id] as $getanswer)
                                                               <li>{{ $getanswer }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        @php
                                                            echo current($answerarray[$model->id]);
                                                        @endphp
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @endforeach
                            </div>
                        </div>
                    </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End profile Section -->

@endsection

@section('footer')
<script type="text/javascript">
    $(document).ready(function(){
       $('.slider-for').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          fade: true,
          asNavFor: '.slider-nav',
        	 autoplay: true
        });
        $('.slider-nav').slick({
          slidesToShow: 3,
          slidesToScroll: 1,
          asNavFor: '.slider-for',
          dots: false,
          centerMode: true,
          focusOnSelect: true

        });
    });
</script>
@endsection
