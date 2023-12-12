@extends('layouts.master')
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/match_quest_edit.css') }}">
@endsection
@section('main-content')
<div class="maincontent">
    <div class="container-fluid">
        <div class="row">
            <div class="card col-md-12 all-categories">
                @if (session('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('success') }}
                </div>
                @endif
                @foreach($math_quest_categ as $cat_row)
                @if($loop->index == 0)
                    <div class="col-md-12">
                            <div class="step-form">
                                <div class="f1-steps">
                                    <div class="f1-progress">
                                        <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66%;"></div>
                                    </div>
                                    @endif
                                    <div class="f1-step @if($loop->first)current-active @endif">
                                        <div class="f1-step-icon"><i class="fa fa-check"></i></div>
                                        <p>{{ $cat_row->name }}</p>
                                    </div>
                                    @if($loop->last)
                                </div>
                            </div>
                        </div>
                        @endif
                @endforeach
                <div class="row">
                <div class="col-md-3">
                <div class="adsimgsec ads_240_400_size ptb10">
                         <img src="http://laravel.avdopt.com/images/240x400.jpg" class="">
                </div>
            </div>
                <div class="col-md-6 family_values_sec">
                <form action="{{ route('matchquests_submit') }}" method="POST">
                    @csrf
                    @foreach($math_quest_categ as $cat_row)
                    
                    <!--Start of  category-steps-->
                    <div class="col-md-12 category-steps @if($loop->first)first @endif @if($loop->last)last @endif step_{{$loop->iteration}} @if($loop->index == 0)active @endif">
                        <div class="col-md-12 banner">
                            <img src="{{ asset($cat_row->bannerimage) }}" class="banner" alt="your image" />
                        </div>
                        <div class="col-md-12 desciption">
                            {{ $cat_row->description }}
                        </div>
                        <div class="col-md-12 questions">
                            @if($math_quest_categories->Questionnaires)
                                @foreach($math_quest_categories->Questionnaires as $question_row)

                                    @if($question_row->category_id ==  $cat_row->id)
                                    <div class="single-question">
                                    <h5>{{ $question_row->question_title }}</h5>
                                    @switch($question_row->question_type)
                                        @case(1)
                                            <input type="text" class="border_radius form-control" name="answers[{{ $question_row->id }}][]" value="{{ @$answerarray[$question_row->id][0] }}">
                                            @break
                                        @case(2)
                                        @case(5)
                                            @php
                                                $options = json_decode($question_row->question_data);
                                            @endphp
                                            <select name="answers[{{ $question_row->id }}][]" class="border_radius multi form-control" @if($question_row->question_type == 5) multiple="multiple" @endif>
                                                @if($options)
                                                    @foreach ($options->options as $option)
                                                        @if(isset($answerarray[$question_row->id]))
                                                            <option value="{{ $option }}" @if(in_array($option, $answerarray[$question_row->id])) selected @endif >{{ $option }}</option>
                                                        @else
                                                            <option value="{{ $option }}">{{ $option }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                            @break
                                        @case(3)
                                            @php
                                                $options = json_decode($question_row->question_data);
                                                $seloptions = @$answerarray[$question_row->id];
                                            @endphp
                                            @if($options)
                                                @foreach ($options->options as $option)
                                                    @php
                                                        $sel = "";
                                                    @endphp
                                                    @if($useranswer)
                                                        @if($seloptions)
                                                            @if( in_array($option, $seloptions ) )
                                                                @php
                                                                    $sel = "checked='checked'";
                                                                @endphp
                                                            @endif
                                                        @endif
                                                    @endif
                                                    <span class="optin"> {{ $option }}</span> <input type="checkbox" {{ $sel }} value="{{ $option }}" name="answers[{{ $question_row->id }}][{{$loop->iteration}}]" class="form-control">
                                                @endforeach
                                            @endif
                                            @break
                                        @default
                                            <textarea name="answers[{{ $question_row->id }}][]" class="form-control">{{ @$answerarray[$question_row->id][0] }}</textarea>
                                    @endswitch
                                    </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <!--End of  category-steps-->
                    @endforeach
                    <div class="col-md-12 nex-prev-btn">
                        <button type="button" class="btn btn-info prev-next prev-category" data-index="-1">Previous</button>
                        <button type="button" class="btn btn-success prev-next next-category" data-index="1">Next</button>
                        <button type="submit" class="btn btn-danger submit-match-quest">Submit</button>
                    </div>
                </form>
            </div>
             <div class="col-md-3">
                <div class="adsimgsec ads_240_400_size ptb10">
                         <img src="http://laravel.avdopt.com/images/240x400.jpg" class="">
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
@section('page_level_scripts')
<script type="text/javascript">
    $(".prev-next").click(function (e) {
        if($(this).data('index') == 1){
            if(!$(".category-steps.active").hasClass('last')){
                var obj = $(".category-steps.active");
                $(".category-steps.active").removeClass('active');
                $(obj).next('.category-steps').addClass('active');
                $(".prev-category").show();
                if($(".category-steps.active").hasClass('last')){
                    $(".next-category").hide();
                    $(".submit-match-quest").show();
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
    $(document).ready(function() {
    $('.multi').select2();
});
</script>
@endsection