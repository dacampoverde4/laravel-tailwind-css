@extends('admin.layout.master')
@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
<style type="text/css">
    .multiple_usr_checkboxes_sec [type=checkbox]:checked, [type=checkbox]:not(:checked) {
        left: 15px !important;
        opacity: 1 !important;
        margin-top: 5px;
    }
    .multiple_usr_checkboxes_sec .btn-group label {
        color: #000000!important;
    }
    .multiple_usr_checkboxes_sec button.multiselect.dropdown-toggle.btn.btn-default {
        border: 1px solid #dfdfdf;
    }
    .multiple_usr_checkboxes_sec .checkbox_usr_div .dropdown-menu {
        min-width: 14rem !important;
    }
    .checkbox_usr_div {
        display: inline-block;
    }
    .multiple_usr_checkboxes_sec ul {
        max-height: 240px !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
    }
    .form_lbl {
        display: inline;
    }
    .alert-error {
        border: 1px solid #fecdcd !important;
        background-color: #fff8f8;
    }
    .alert-success {
        border: 1px solid #155724 !important;
        background-color: #ebffeb;
    }    
</style>
@yield('head')
@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font20"><b class="vertical_align"><i class="fa fa-life-bouy" aria-hidden="true"></i> Edit Target Audience</b>
                        </h3>
                        <hr>
                        <div class="msgtabs pt50">
                            <div class="container-fluid">
                                @if(session()->has('success'))
                                <div class="">
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                </div>
                                @endif

                                @if(session()->has('error'))
                                <div class="">
                                    <div class="alert alert-error">
                                        {{ session()->get('error') }}
                                    </div>
                                </div>
                                @endif
                                
                                <form class="form_inline fullwidth mtop40" method="POST" action="{{route('updatetargetaudiance.advertisement', $targetaudience->id)}}" >
                                    @csrf
                                        <div class="row"> 
                                            <div class="col-md-3">
                                                <div class="form_lbl">
                                                    <strong>Select Usergroups:</strong>
                                                </div>
                                            </div>                                  
                                            <div class="col-md-9 form-group multiple_usr_checkboxes_sec">
                                                <div class="checkbox_usr_div">
                                                    <select id="multiple_usr_checkboxes" name="multiple_usr_groups[]" multiple="multiple" class="{{ $errors->has('multiple_usr_groups') ? ' is-invalid' : '' }}">
                                                        @foreach($usergroups as $user)
                                                            @php
                                                                $selectedgroupids = $targetaudience->usergroup_ids;
                                                                $selectedgids_array = explode(',', $selectedgroupids);
                                                                if (in_array($user->id, $selectedgids_array)){
                                                                    $selected = "selected";
                                                                }else{
                                                                    $selected = "";
                                                                }
                                                            @endphp
                                                            <option value="{{ $user->id }}" {{$selected}}>{{ $user->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row"> 
                                            <div class="col-md-3">
                                                <div class="form_lbl">
                                                    <strong>Price:</strong>
                                                </div>
                                            </div>                                  
                                            <div class="col-md-9 form-group">
                                                <input type="number" name="usergroup_price" id="usergroup_price" class="form-control {{ $errors->has('usergroup_price') ? ' is-invalid' : '' }}" value="{{ $targetaudience->price }}" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9">
                                                <button type="submit" class="btn btn-success border_radius">Submit</button>
                                            </div>
                                        </div>                          
                                    </div>                                   
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#multiple_usr_checkboxes').multiselect({
            includeSelectAllOption : true,
            nonSelectedText: 'Select an Usergroups'
        });
    });
</script>
@endsection