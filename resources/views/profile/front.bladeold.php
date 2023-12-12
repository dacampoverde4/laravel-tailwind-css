@extends('layouts.frontend')
@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}"/>
<link rel="stylesheet" type="text/css" href="http://kenwheeler.github.io/slick/slick/slick-theme.css"/>
<script type="text/javascript" src="{{ asset('js/slick.js') }}"></script>
 @yield('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
@endsection 
@section('content')
<div class="maincontent backend">
    <div class="content">  
<!-- Start profile Section -->
        <div class="profile_section mtopbottom80">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            @php  
                $message = '';
                $subnotrequired = 0;
                if( Auth::user() ){ 
                    if( !isthisSubscribed() ){
                        $subnotrequired = 1;
                        $message = "You have subscribe first to take this feature";
                    }
                }else{
                    $message = "You have to sign in first";
                }
            @endphp
            <div class="container">
                <div class="profile-section">
                    <div class="left-section">
                        <div class="slider-for">
                            <div style="background-image:url({{ ( $user->profile_pic )? url('/uploads').'/'.$user->profile_pic : url('/images/default.png')}});background-size:cover;background-position:50% 50%;height:450px;"></div>
                            @php
                                $images = @$user->photos;
                            @endphp
                            @if( $images )
                                @foreach($images as $row)
                                    <div style="background-image:url({{ asset('/uploads/'.$row->image)}});background-size:cover;background-position:50% 50%;height:450px;"> </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="right-section profile_info">
                        <div class="col-md-8">
                            <ul>
                                <li class="font17"><img src="{{url('/')}}/frontend/images/user.png" alt="Profile Icon" title="Profile Icon"> <span>Name: {{ ucfirst( $user->name ) }} </span></li>
                                <li class="font17"><img src="{{url('/')}}/frontend/images/membership.png" alt="Membership Icon" title="Membership Icon">  <span>Membership Type: {!! getGroupTagWithColor($user->id) !!}</span> </li>
                                <li class="font17"><img src="{{url('/')}}/frontend/images/age.png" alt="Age Img" title="Age Img">  <span>Age: {{ ( $user->age )? $user->age . ' Years' : '' }}  </span></li>
                                <li class="font17"><img src="{{url('/')}}/frontend/images/gender.png" alt="Gender Icon" title="Gender Icon"> <span> Gender: {{ @$user->usergender->title }}</span></li>
                                <li class="font17"><img src="{{url('/')}}/frontend/images/user.png" alt="Species Icon" title="Species Icon"> <span>Species: {{ $user->species?$user->species->name:'N/A' }} </span></li>
                                <li class="font17"><img src="{{url('/')}}/frontend/images/join_date.png" alt="Join Date Icon" title="Profile Icon"> <span> Join Date: {{ ( $user->created_at )? date("F j, Y, g:i A", strtotime($user->created_at) ) : '' }}</span></li>
                                <li class="font17"><img src="{{url('/')}}/frontend/images/last_login.png" alt="last Login Icon" title="Profile Icon"> <span> Last Seen: {!! $user->last_seen_ago_html !!}</span></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            @if( \App\Heart::is_in_wishlist( $user->id ) )
                                <i class="fa fa-heart colorred addtowishlist show_error_if_found" data-errormsg="{{ $message }}" data-user="{{ base64_encode($user->id) }}" style="font-size:30px;color:#c0c0c0"></i><span class="hearttext">Add Heart</span>
                            @else
                                <i class="fa fa-heart-o addtowishlist show_error_if_found" data-errormsg="{{ $message }}" data-user="{{ base64_encode($user->id) }}" style="font-size:30px;color:#c0c0c0"></i><span class="hearttext">Add Heart</span>
                            @endif
                            
                            <div class="pull-right start_chat">
                                <span class="chat_span"><i class="fa fa-commenting" aria-hidden="true"></i></span>
                                @if( isthisSubscribed() )
                                    <a class=" chat_note" href="{{ url('chat') }}">START CHAT </a>
                                @else
                                    <a class=" chat_note show_error_if_found"  data-errormsg="{{ $message }}" href="javascript:void(0)">START CHAT </a>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 mtop30">
                            <div class="col-md-8 padding0">
                                <button type="button" data-user="{{ base64_encode($user->id) }}" data-subnotrequired={{ $subnotrequired }} data-errormsg="{{ $message }}" class="like_btn show_error_if_found">
                                    <i  class="fa">&#xf087;</i>
                                    {{ $likecount }} Likes
                                </button>
                                <button type="button" class="match_btn"><i class="fa fa-check-square-o" aria-hidden="true"></i>{{ \App\Match::matchCount($user->id) }} Matches</button>
                            
                            @if( Auth::user() )
                                @if($user->id != Auth::user()->id)
                                <span class="reportblock">
                                    <a href="javascript:void(0)" class="reportorblock" data-toggle="modal" data-id="1" data-target="#myModal">Report </a>
                                    or 
                                    <a href="javascript:void(0)" class="reportorblock" data-toggle="modal" data-id="2" data-target="#myModal">Block user</a>
                                </span>
                                @endif
                            @else
                                <span class="reportblock">
                                    <a href="javascript:void(0)" data-errormsg="{{ $message }}" class="show_error_if_found reportorblock">Report </a>
                                    or 
                                    <a href="javascript:void(0)" data-errormsg="{{ $message }}" class="show_error_if_found reportorblock">Block user</a>
                                </span>
                            @endif
                            </div>
                            <div class="col-md-4 padding0 pull-right">
                                @if( Auth::user() )
                                    <button type="button" class=" leave_note" data-toggle="modal" data-id="1" data-target="#myModalNote">MESSAGE</button>
                                @else    
                                    <button type="button" class=" leave_note show_error_if_found" data-errormsg="{{ $message }}" >MESSAGE</button>
                                @endif
                                <span class="message_span"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
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
                        <!-- Profile Ad -->
                    <div class="right-section profile_ad">
                            <div class="ad_box">
                               <span> AD BANNER </span>
                           </div>
                    </div>
                     <!-- End Profile Ad -->
                    @endif
                </div>

                <div class="col-md-12 col-sm-12 mtop80 ">
                    <div class="col-md-6 padding0 about_me">
                        <h3 class="font_family">ABOUT ME</h3>
                         <p class="font17 fontclr73 mtopbottom">{{ $user->about_me}}</p>
                         <h3 class="font_family mtop40">MY FUN (Tag Along)</h3>
                        <ul class="myfun_list">
                            
                            @if($user->myfuns)
                                @php
                                    $titles = array();
                                    if( $user->myfuns ){
                                        $funIDs = json_decode($user->myfuns);
                                        if( count( $funIDs ) ){
                                            $titles = App\MyFun::whereIn('id', $funIDs)->get();
                                        }
                                    }
                                @endphp
                                @if($titles)
                                    @foreach($titles as $title)
                                        <li><a href="#" class="bgred"><span></span>{{ $title->title }}</a></li>
                                    @endforeach
                                @endif
                            @endif
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-11 pull-right">
                            <h3 class="font_family bgred">QUESTIONNAIRE</h3>
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                                @if($useranswer)
                                    @php
                                    
                                        $answerarray = json_decode($useranswer->answer_data,true);
                                    @endphp
                                    @if($answerarray)
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
                                                        <ol>
                                                            @foreach($answerarray[$model->id] as $getanswer)
                                                               <li style="width: 100%;">{{ $getanswer }}</li>
                                                            @endforeach
                                                        </ol>
                                                    @else
                                                        @php
                                                            echo current($answerarray[$model->id]);
                                                        @endphp
                                                    @endif
                                                </div>
                                            </div>
                                    </div>
                                    @endforeach
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    
                <!-- Featured Members -->
                <div class="col-md-12 col-sm-12 padding0 mtop80 Featured_members">
                    <div class="col-md-6 padding0 mtop40 text-center">
                        <div class="ad_box">
                            <span>AD BANNER</span>
                        </div>
                        <a href="#" class="font22 mtop20 inline_block">Click here to advertise with us</a>
                    </div>
                    @include('includes.features', ['featurecount'=>6])
                    </div>
                    <!-- End Featured Members  -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End profile Section -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      <form class="formreportblock" method="post" action="{{ route('profile.blockreport') }}">
           @csrf
        <!-- Modal Header -->
        <div class="modal-header">
          <h2 class="modal-title"></h2>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <input type="hidden" value="{{ ucfirst( $user->id ) }}" name="block_id" />
            <input type="hidden" value="" id="type" name="type" />
            <div class="form-group">
                
            <label class="col-form-label">Reason</label>
            <select name="reason" class="form-control" >
                @php
                    $reasons = App\Reason::all();
                @endphp
                @if($reasons)
                    @foreach($reasons as $reason)
                        <option value="{{ $reason->name }}">{{ $reason->name }}</option>
                    @endforeach
                @endif
            </select>
            <br>
            </div>
            <div class="form-group">
            <label class="col-form-label">Reason Description</label>
            <textarea type="text" class="form-control" name="description"></textarea>
            <br>
            </div>
            <div class="form-group">
                <label></label>
            <button id="subbtn" style="text-transform:capitalize" class="btnpad btnred border_radius"></button>
            </div>
        </div>
        
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="myModalNote">
      <div class="modal-dialog">
      <div class="modal-content">
      <form class="formreportblock" method="post" action="{{ route('messages.store') }}">
           @csrf
        <!-- Modal Header -->
        <div class="modal-header">
          <h2 class="modal-title">Send Note to {{ ucfirst( $user->name ) }}</h2>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <input type="hidden" value="{{ ucfirst( $user->id ) }}" name="reciever_id" />
            <div class="form-group">
            <label class="col-form-label">Note</label>
            <select name="note" id="noteselect" class="form-control">
                @php
                    $groupid = 1;
                    if( Auth::user() ){
                        $groupid = Auth::user()->group;
                    }
                    $notes = App\Note::where('user_group', $groupid)->get();
                    if($notes){
                        foreach($notes as $note){
                            echo '<option value="'.$note->note.'">'.$note->note.'</option>';
                        }
                    }
                @endphp
                @if ( isthisSubscribed() )
                    <option value="other">Other</option>
                 @endif
            </select>
            @if ( isthisSubscribed() )
                <div class="textareanote"></div>
            @else
                
            @endif
            <br>
            </div>
            <div class="form-group">
                <label></label>
            <button id="subbtn" style="text-transform:capitalize" class="btnpad btnred border_radius">Send</button>
            </div>
        </div>
        
        </form>
      </div>
    </div>
  </div>
  
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){

        $("#noteselect").change(function(){
        var selectvalue = $("#noteselect option:selected").val();
        if(selectvalue=='other'){
            $(this).remove();
            $('.textareanote').append('<textarea type="text" class="form-control" name="note"></textarea>');
        }
    });
        $('.reportorblock').click(function(){
            var id = $(this).attr('data-id');
            if(id==1){
                var type = 'report';
                var header = 'Report User <code>{{ ucfirst( $user->name ) }}</code>';
            }
            else{
                var type = 'block';
                var header = 'Block User <code>{{ ucfirst( $user->name ) }}</code>';
            }
            $('#type').val(type);
            $('#subbtn').text(type);
            $('.formreportblock .modal-title').html(header);
        });
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: false,
            centerMode: false,
            focusOnSelect: true
        });
            // masonary
        var $grid = $('.grid').isotope({
          itemSelector: '.grid-item',
          columnWidth: 160,
          gutter: 20,
          percentPosition: true,
          masonry: {
            columnWidth: '.grid-sizer'
          }
        });
    });
</script>
@endsection