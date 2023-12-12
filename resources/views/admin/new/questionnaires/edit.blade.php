@extends('admin.New.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block"><b>Questionnaires</b>
                       <a href="{{route('questionnaires.index', $questionnaires->group_id )}}" class="btn btn-info pull-right"><i class="fa fa-plus"></i>Back</a>
                       </h3>
                       <hr>
                       <form class="form_inline fullwidth mtop40" name="myForm" onsubmit="return validateForm()" action="{{route('question.update',$questionnaires->id)}}" method="POST">
                        @csrf
                       
                        <!-- INPUT -->    
                        @php 
                        $options = json_decode($questionnaires->question_data); 
                       
                        @endphp
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label for="usergroup" >User Group</label></div>
                                <div class="col-md-8">
                                    <select name="user_group" class="form-control searchdropdown">
                                        @php
                                            $groupids = explode(',', $questionnaires->group_id);
                                        @endphp
                                        @foreach($usergroup as $row)
                                            @php
                                                $sel = '';
                                                if( in_array($row->id, $groupids) ){
                                                    $sel = "selected";
                                                }
                                            @endphp
                                            <option {{ $sel }} value="{{ $row->id }}"><?php echo $row->title ?></option>
                                        @endforeach 

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="create create1">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label for="question">Question Title</label></div>
                                    <div class="col-md-8"><input type="text" class="form-control" value="{{ $questionnaires->question_title }}" id="question" name="question_title"></div>
                                </div>
                            </div>
                            <!-- INPUT --> 
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label for="answertype">Answer Type</label></div>
                                    <div class="col-md-8">
                                        
                                        <select class="form-control selectanswertype" name="question_type">
                                            <option value="1" @if($questionnaires->question_type =='1') selected="selected" @endif>Text</option>
                                            <option value="2" @if($questionnaires->question_type =='2') selected="selected" @endif>Select</option>
                                            <option value="3" @if($questionnaires->question_type =='3') selected="selected" @endif>checkbox</option>
                                            <option value="4" @if($questionnaires->question_type =='4') selected="selected" @endif>Teaxtarea</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @if($questionnaires->question_type =='2' || $questionnaires->question_type =='3')
                                @php 
                                    $countoption = count($options->options); 
                                @endphp
                                <div class="newoptions">
                                    @for ($i = 0; $i < $countoption; $i++)
                                        <div class="form-group newaddedoption">
                                            <div class="row">
                                                <div class="col-md-4">@if($i!=0)<i class="fa fa-times removeoptions"></i>@endif<label for="question">Options</label></div>
                                                <div class="col-md-8"><input type="text" class="form-control" value="{{ $options->options[$i] }}" name="question[options][]"></div>
                                            </div>
                                        </div>
                                    @endfor
                                    <button type="button" class="btn btn-primary pull-right addmoreoptions"><i class="fa fa-plus"></i></button>
                                </div>
                            @endif
                        </div>
                        <div class="htmldata">
                         </div>
                        <!--button type="button" class="btn btnred pull-right addmorequestion"><i class="fa fa-plus"></i></button-->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-9"><button type="submit" class="btn btn-success pull-right border_radius"><i class="fa fa-check"></i>Update</button></div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page_js')
<script>
function validateForm() {
    var x = document.forms["myForm"]["question"].value;
    if (x == "") {
        alert("Question Title must be filled out");
        return false;
    }
}
</script>
@endsection
