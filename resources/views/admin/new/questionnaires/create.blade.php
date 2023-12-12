@extends('layouts.master')

@section('main-content')
<div class="maincontent">
    <div class="content bgwhite">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="form_common padding40">
                    <div class="card-header">
                        <h3 class="inline_block"><b>Questionnaires</b></h3>
                        <a href="{{route('questionnaires.index', $groupId )}}" class="btn btnred pull-right"><i class="fa fa-plus"></i>Back</a>
                    </div>
                    <hr>
                    <form class="form_inline fullwidth mtop40" name="myForm" onsubmit="return validateForm()" action="{{route('question.store')}}" method="POST">
                        @csrf
                        <!-- INPUT -->    

                        <input type="hidden" name="user_group" value="{{ $groupId }}">

                        <div class="create create1">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label for="question">Question Title</label></div>
                                    <div class="col-md-8"><input type="text" class="form-control" id="question" name="question_title"></div>
                                </div>
                            </div>
                            <!-- INPUT --> 
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label for="answertype">Answer Type</label></div>
                                    <div class="col-md-8">
                                        <select class="selectanswertype" name="question_type">
                                            <option value="1">Text</option>
                                            <option value="2">Select</option>
                                            <option value="3">checkbox</option>
                                            <option value="4">Teaxtarea</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="htmldata">
                         </div>
                        <!--button type="button" class="btn btnred pull-right addmorequestion"><i class="fa fa-plus"></i></button-->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-9"><button type="submit" class="btnpad btnred pull-right border_radius">Submit</button></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
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
