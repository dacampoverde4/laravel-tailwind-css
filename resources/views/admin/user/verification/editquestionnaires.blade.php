@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block"><b>Edit User Verification Questionnaires</b>
                            <a href="{{route('userverification.index')}}" class="btn btn-info pull-right">Back</a>
                        </h3>
                        <hr>
                        @if (session('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('success') }}
                        </div>
                        @elseif(session('warning'))
                        <div class="alert alert-warning">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('warning') }}
                        </div>
                        @elseif(session('error'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('error') }}
                        </div>
                        @endif
                        <form class="form_inline fullwidth mtop40" name="myForm" onsubmit="return validateForm()"
                            action="{{route('userverification.update',$questionnaires->id)}}" method="POST">
                            @csrf

                            <!-- INPUT -->
                            @php
                            $options = json_decode($questionnaires->question_data);
                            $arrays=array();
                            foreach($questionnaires->usergroups as $object)
                            {
                            $arrays[]= $object->id;
                            }
                            @endphp

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label for="usergroup">User Group</label></div>
                                    <div class="col-md-8">
                                        <select name="usergroups[]" class="form-control searchdropdown" multiple>
                                            @foreach($usergroup as $row)
                                            @php
                                            $select='';
                                            if(in_array($row->id,$arrays)){
                                            $select = 'selected';
                                            }
                                            @endphp
                                            <option {{ $select }} value="{{ $row->id }}"><?php echo $row->title ?>
                                            </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="create create1">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4"><label for="question">Question Title</label></div>
                                        <div class="col-md-8">
                                            <input type="text"
                                                class="form-control {{ $errors->has('question_title') ? 'is-invalid' : '' }}"
                                                value="{{ $questionnaires->question_title }}" id="question"
                                                name="question_title">
                                            @if ($errors->has('question_title'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('question_title') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- INPUT -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4"><label for="answertype">Answer Type</label></div>
                                        <div class="col-md-8">

                                            <select
                                                class="form-control selectanswertype {{ $errors->has('question_type') || session('question') ? 'is-invalid' : '' }}"
                                                name="question_type">
                                                <option value="1" @if($questionnaires->question_type =='1')
                                                    selected="selected" @endif>Text</option>
                                                <option value="2" @if($questionnaires->question_type =='2')
                                                    selected="selected" @endif>Select</option>
                                                <option value="5" @if($questionnaires->question_type =='5')
                                                    selected="selected" @endif>Multiple Choice</option>
                                                <option value="3" @if($questionnaires->question_type =='3')
                                                    selected="selected" @endif>Checkbox</option>
                                                <option value="4" @if($questionnaires->question_type =='4')
                                                    selected="selected" @endif>Teaxtarea</option>
                                            </select>
                                            @if ($errors->has('question_type'))
                                            <span class="invalid-feedback">
                                                <strong>Answer type field is required</strong>
                                            </span>
                                            @endif
                                            @if (session('question'))
                                            <span class="invalid-feedback">
                                                <strong>{{ session('question') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if($questionnaires->question_type =='2' || $questionnaires->question_type =='3' ||
                                $questionnaires->question_type =='5')
                                @php
                                $countoption = 0;
                                if($options){
                                $countoption = count($options->options);
                                }
                                @endphp
                                <div class="newoptions">
                                    @for ($i = 0; $i < $countoption; $i++) <div class="form-group newaddedoption">
                                        <div class="row">
                                            <div class="col-md-4">@if($i!=0)<i
                                                    class="fa fa-times removeoptions"></i>@endif<label
                                                    for="question">Options</label></div>
                                            <div class="col-md-8"><input type="text" class="form-control"
                                                    value="{{ $options->options[$i] }}" name="question[options][]">
                                            </div>
                                        </div>
                                </div>
                                @endfor
                                <button type="button" class="btn btn-primary pull-right addmoreoptions"><i
                                        class="fa fa-plus"></i></button>
                            </div>
                            @endif
                            {{-- <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label for="answertype">Math Quest Category</label></div>
                                    <div class="col-md-8">
                                        <select class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}"
                                            name="category">
                                            <option value="">Select Category</option>
                                            @foreach($match_quest_categories as $category_row)
                                            <option value="{{ $category_row->id }}" @if($category_row->id ==
                                                $questionnaires->category_id)selected="selected"
                                                @endif>{{ $category_row->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('category'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div> --}}
                    </div>
                    <div class="htmldata">
                    </div>
                    <!--button type="button" class="btn btnred pull-right addmorequestion"><i class="fa fa-plus"></i></button-->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9"><button type="submit"
                                    class="btn btn-success pull-right border_radius"><i class="fa fa-check-circle"
                                        aria-hidden="true"></i> Update</button></div>
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
$(document).ready(function() {
        $('.searchdropdown').select2({
            placeholder: 'select',
          multiple: true
        });
    });
</script>
@endsection