@extends('layouts.master')
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/match_quest_edit.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/css-circular-prog-bar.css') }}">

@endsection
@section('main-content')
<div class="maincontent">
    <div class="container-fluid">
        <div class="row">
            @php
                    if($tol_qqest_group1){
                        $percentage = sizeof($answerarray) / $tol_qqest_group1 *100;
                    }else{
                        $percentage = sizeof($answerarray) / $tol_qqest_group1 *100;
                    }
                    $currentPlan=getCurrentUserPlan()->plan_id;
                    $cplanId=getCurrentUserPlan()->id;
                    $row=   \App\WebsiteSetting::where('id',$cplanId)->first();
                    if($row){
                        preg_match("/([0-9]+)/", $row->meta_key, $matches);
                        $matchsaq= $matches[1];
                    }else{
                        $matchsaq=0;
                    }
                   
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
           $at_least_one_answer_found=0;
           if($useranswer)
           {
           $answerarray = json_decode($useranswer->answer_data,true);
           $asw=sizeof($answerarray);
        //    if($answerarray){
        //    $ctn = 1;
        //    foreach($answerarray as $key=>$answer){
        //    $model = App\Questionnaires::find($key);
        //    if($answerarray[$model->id] > 0 ){
        //    foreach($answerarray[$model->id] as $getanswer){
        //    if($getanswer)
        //    {
        //    $at_least_one_answer_found=1;
        //    }
        //    }
        //    }
        //    if($ctn > 5){
        //    unset($answerarray[$key]);
        //    }
        //    $ctn++;
        //    }
        //    }
           }
           if ($match_quest_unlimited == 1) {
               $questions_per_category= INF;
           }
           @endphp
            <div class="card col-md-3 all-categories">
                <center>
                <div class="progress-circle p<?php echo round($percentage); ?>">
                    <span> <img src="{{ ( $other_userdata->profile_pic )? url('/uploads/'.$other_userdata->profile_pic) : url('images/default.png') }}" alt="Avatar" class="avatar" /></span>
                    <div class="left-half-clipper">
                       <div class="first50-bar"></div>
                       <div class="value-bar"></div>
                    </div>
                 </div>
                </center>   
            <center>
            <h5>Match Quest {{ round($percentage)}}% complete</h5>
            <h5>{{$other_userdata->displayname}}</h5>
            <div class=" col-md-10 memberplane">
                <button type="button" data-liked-user="{{$liked_the_user}}" data-user="{{ base64_encode($other_userdata->id) }}" data-subnotrequired="{{ $subnotrequired }}" data-errormsg="{{ $message }}" class="like_btn show_error_if_found btn pull-left btn-sm btn-outline-primary"><i  class="fa">&#xf087;</i>{{ $likecount }} Likes </button>
                <button type="button" class="match_btn btn-sm pull-right btn btn-outline-primary"><i class="fa fa-check-square-o" aria-hidden="true"></i>{{ \App\Match::matchCount($other_userdata->id) }} Matches</button>
            </div>
            <hr>
                @if ($currentPlan=='plan_DGPRyjNYWH0Y1h' OR $currentPlan=='plan_DGPRyjNYWH0Y1h')
                <p>Upgrade to <a href="#" data-toggle="modal" data-target="#usernameChange_modal"> <a href="{{url('pricing')}}">Premium membership</p></a>
                @else
                <div class=" col-md-10 memberplane">
                    <i class="fa fa-shield fa-2x pull-left" aria-hidden="true"></i>  <a class="pull-right btn btn-success btn-sm" href="{{url('pricing')}}">Upgrade</a>      
                </div>
                <div class=" col-md-10 memberplane">
                    <p class="primtext">    
                        
                    {{$other_userdata->displayname}} answared {{$asw}} a total of {{$tol_qqest_group1}} questions.
                    due to you being a {{$currentPlan=getCurrentUserPlan()->name}} member you are able to see  <strong> @if($match_quest_unlimited == 1)unlimited @else only {{$match_quest_count}} @endif</strong> Match Quest.
                    Upgrade your membership plan today and view more Match Quest! </p>
                    </div>
                @endif
        </div>
        <div class="col-space col-md-1 "></div>
            <div class="card col-md-8 all-categories">
                @if (session('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('success') }}
                </div>
                @endif
                @foreach($math_quest_categories as $cat_row)
                @if($loop->index == 0)
                    <div class="col-md-12">
                            <div class="step-form">
                                <div class="f1-steps">
                                    <div class="f1-progress">
                                        <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66%;"></div>
                                    </div>
                                    @endif
                                    <div class="f1-step @if($loop->index == 0)current-active @endif">
                                        <div class="f1-step-icon"><i class="fa fa-check"></i></div>
                                        <p>{{ $cat_row->name }}</p>
                                    </div>
                                    @if($loop->last)
                                </div>
                            </div>
                        </div>
                        @endif
                @endforeach
                @if ($currentPlan=='plan_DGPRyjNYWH0Y1h' OR $currentPlan=='plan_DGPRyjNYWH0Y1h')

                <p>Upgrade to <a href="#" data-toggle="modal" data-target="#usernameChange_modal"> <a href="{{url('pricing')}}">Premium membership</p></a>
                @else
                @foreach($math_quest_categories as $cat_row)
                <!--Start of  category-steps-->
                <div class="col-md-12 category-steps @if($loop->first)first @endif @if($loop->last)last @endif step_{{$loop->iteration}} @if($loop->index == 0)active @endif">
                    <div class="col-md-12 banner">
                        <img src="{{ asset($cat_row->bannerimage) }}" class="banner" alt="your image" />
                    </div>
                    <div class="col-md-12 desciption">
                        {{ $cat_row->description }}
                    </div>
                    <div class="col-md-12 questions">
                        @php $ctn = 0; @endphp
                            @foreach($tol_qqest_group->Questionnaires as $question_row)
                            @if($question_row->category_id == $cat_row->id && $ctn < $questions_per_category) 
                                @php $ctn++  @endphp
                                @if(isset($answerarray[$question_row->id]))                                       
                                        <div class="single-question">
                                        <h5>{{ $question_row->question_title }}</h5>

                                        @switch($question_row->question_type)
                                            @case(1)
                                                <p class="answer">{{ @$answerarray[$question_row->id][0] }}</p>
                                                @break
                                            @case(2)
                                            @case(5)
                                                @php
                                                    $options = json_decode($question_row->question_data);
                                                @endphp
                                                @if($options)
                                                    <p class="answer">
                                                    <ul class="answer-options">
                                                    @foreach ($options->options as $option)
                                                        @if(in_array($option, $answerarray[$question_row->id]))
                                                            <li>{{ $option }}</li>
                                                        @endif
                                                    @endforeach
                                                    </ul>
                                                    </p>
                                                @endif
                                                @break
                                            @case(3)
                                                @php
                                                    $options = json_decode($question_row->question_data);
                                                    $seloptions = @$answerarray[$question_row->id];
                                                @endphp
                                                @if($options)
                                                    <p class="answer">
                                                    <ul class="answer-options">
                                                    @foreach ($seloptions as $option_row)
                                                        <li>{{ $option_row }}</li>
                                                    @endforeach
                                                    </ul>
                                                    </p>
                                                @endif
                                                @break
                                            @default
                                                <p class="answer">{{ @$answerarray[$question_row->id][0] }}</p>
                                        @endswitch
                                        </div>
                                @endif
                                @endif
                            @endforeach
                    </div>
                </div>
                <!--End of  category-steps-->
                @endforeach
                @endif
                <div class="col-md-12 nex-prev-btn">
                    <button type="button" class="btn btn-info prev-next prev-category" data-index="-1">Previous</button>
                    <button type="button" class="btn btn-success prev-next next-category" data-index="1">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_user_match" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
          <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
             <span aria-hidden="true">&times;</span>
             </button>
             <h4 class="modal-title">Matches</h4>
          </div>
          <div class="modal-body">
             <img class="modal_user_match_loading" src="{{ asset('/new-assets/common/images/loading-transperent-160x160.gif')}}">
             <div class="modal_user_match_submit_msg"></div>
             <div class="modal_user_match_container">
             </div>
          </div>
       </div>
    </div>
 </div>
{{-- @if(Auth::check())
@include('profile.upgrade_match_quest_package')
@endif --}}
@endsection
@section('page_level_scripts')
<script src="{{ URL::asset('new-assets/common/js/common.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('js/common.js')}}" type="text/javascript"></script>
<script type="text/javascript">
 var url_auth_check='{{url("ajaxrequest/auth_check")}}';
    $(".prev-next").click(function (e) {
        if($(this).data('index') == 1){
            if(!$(".category-steps.active").hasClass('last')){
                var obj = $(".category-steps.active");
                $(".category-steps.active").removeClass('active');
                $(obj).next('.category-steps').addClass('active');
                $(".prev-category").show();
                if($(".category-steps.active").hasClass('last')){
                    $(".next-category").hide();
                }
                if(!$('.f1-step').hasClass('active')){
                    $('.f1-step:first').addClass('active');
                }else{
                    $(".f1-steps .active:last").next('.f1-step').addClass('active');
                }
                $(".f1-steps .current-active:last").removeClass('current-active');
                $(".f1-steps .active:last").next('.f1-step').addClass('current-active');
            }
        }else{
            if(!$(".category-steps.active").hasClass('first')){
                var obj = $(".category-steps.active");
                $(".category-steps.active").removeClass('active');
                $(obj).prev('.category-steps').addClass('active');
                $(".next-category").show();
                if($(".category-steps.active").hasClass('first')){
                    $(".prev-category").hide();
                }
                $(".submit-match-quest").hide();
                $(".f1-steps .active:last").removeClass('active');
                $(".f1-steps .current-active:last").prev().addClass('current-active');
                $(".f1-steps .current-active:last").removeClass('current-active');
            }
        }
    });
</script>
@endsection