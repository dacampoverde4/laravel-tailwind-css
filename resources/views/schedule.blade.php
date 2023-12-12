@extends('layouts.master')
@section('htmlheader')
<link rel="stylesheet" href="{{ asset('slider/flexslider.css')}}" type="text/css" media="screen" />


@yield('head')
<style>
   .title_sec {
   margin-bottom: 34px;
   margin-left: 9px;
   font-size: 26px;
   color: #000;
   margin-left: 11px;
   }
   p.txt_secs {
   /* text-align: -webkit-match-parent; */
   text-transform: capitalize;
   padding: 12px;
   font-size: 13px;
   position: relative;
   bottom: 39px;
   font-weight: 500;
   color: #000;
   }
   #carousel .flex-active-slide img {
   opacity: 1;
   cursor: default;
   }
   #carousel img:hover {
   opacity: 1;
   }
   #carousel img {
   display: block;
   cursor: pointer;
   }
   div#main {
   margin: 26px !important;
   background-color: #fff;
   }
   .flex-direction-nav .flex-prev {
   display: none !important;
   }
   .flex-direction-nav .flex-next {
   display: none !important;
   }
   .flexslider:hover .flex-direction-nav .flex-next {
   display: none !important;
   }
   .lft_sec {
   background: #1976d2;
   padding: 5px;
   }
   .lft_sec h1 {
   color: #fff;
   font-size: 26px;
   padding-left: 1rem;
   text-transform: capitalize;
   margin: 0;
   }
   .para_sec h1 {
   font-size: 18px;
   color: #1976d2;
   text-transform: capitalize;
   }
   .rgt_sec img {
   width: 100%;
   height:100%
   }
   button.btn.btnred {
   background: #1976d2;
   color: #fff;
   }
   .btn_bt {
   text-align: center;
   }
   .para_bt {
   text-align: center;
   margin-top: 1rem;
   }

   .card-body.when_sec {
   background-color: #eaeaea;
   }
   p.txt_sec {
    	color: #000;
    	font-weight: 500;
    	font-size: 16px;
    	margin: 10px 0 !important;
    }
    .card-no-border .card {
    	min-height: 225px;
    }
    select.form-control {
    	border-radius: 4px !important;
    }
   .middle_sec {
   text-align: center;
   text-transform: capitalize;
   padding-top: 2rem;
   }
   .middle_sec h1{
   color: #1976d2;
   }
   .para_sec {
   background: #fff;
   }
   .para_sec input {
   border: none;
   }
   .para_sec input:focus{border: none;}
   .img__description {
   position: absolute;
   top: 0;
   bottom: 0;
   left: 0;
   right: 0;
   background: rgba(29, 106, 154, 0.72);
   color: #fff;
   visibility: hidden;
   opacity: 0;
   transition: opacity .2s, visibility .2s;
   height: 100%;
   text-align: center;
   }
   .slides li {
   position: relative;
   }
   .slides li:hover .img__description {
   visibility: visible;
   opacity: 1;
   }
   .img__description span {
   position: relative;
   top: 43%;
   width: 100%;
   margin: auto;
   border: 1px solid #fff;
   padding: 5px;
   }
   .flex-active-slide p {
   opacity: 1 !important;
   visibility: visible !important;
   }
   .slides {
   width: 100% !important;
   transform: unset !important;
   }
   .slde_ntt {
   position: relative;
   width: 32% !important;
   margin-bottom: 10px!important;
   }
   .date_sec {
   color: #000;
   font-size: 21px;
   margin-bottom: 2px;
   }
   .btn_sec {
   text-align: center;
   margin: auto;
   margin-bottom: 1rem;
   }
   .txt_input {
    font-size: 18px;
    font-weight: 500;
    color: #000;
   }
   .input-group-addon {
    	position: absolute;
    	right: 0;
    	top: 5px;
    	right: 12px;
    	font-size: 20px;
    }
    .schedulePicker {
    	position: relative;
    	width: 100%;
    }
    #date {
    	padding-right: 35px;
    }
    .input-group-addon {
    	padding: 6px 12px;
    	font-size: 14px;
    	font-weight: 400;
    	line-height: 1;
    	color: #555;
    	text-align: center;
    	background-color: #eee;
    	border: 1px solid #ccc;
    	border-radius: 4px;
    }
    .glyphicon {
    	position: relative;
    	top: 1px;
    	display: inline-block;
    	font-family: 'Glyphicons Halflings';
    	font-style: normal;
    	font-weight: 400;
    	line-height: 1;
    	-webkit-font-smoothing: antialiased;
    	-moz-osx-font-smoothing: grayscale;
    }
    .glyphicon-time::before {
    	content: "\e023";
    }
    .glyphicon {
    	font-family: 'Glyphicons Halflings';
    	font-style: normal;
    	font-weight: 400;
    	line-height: 1;
    }

    /* #datePicker .glyphicon-chevron-left::before,
    #datePicker .glyphicon-chevron-right::before,
    #timePicker .glyphicon-chevron-up::before,
    #timePicker .glyphicon-chevron-down::before{
      font-family: "Material Design Icons";
      font-size: 14px;
    }
    #datePicker .glyphicon-chevron-left::before
    {
       content: "\F141";
    }
    #datePicker .glyphicon-chevron-right::before
    {
       content: "\F142";
    }
    #timePicker .glyphicon-chevron-up::before{
      content: "\F143";
    }
    #timePicker .glyphicon-chevron-down::before{
      content: "\F140";
    } */
    .lft_sec h1 small {
    	text-transform: none;
    	font-size: 16px;
    	display: inline-block;
    }
    .para_intruction {
    	width: 80%;
    	text-align: center;
    	margin: 15px auto;
    }
    .location-Items {
    	height: 150px;
    	background-size: cover;
    	background-repeat: no-repeat;
    	width: 100%;
    	position: relative;
    }
    #carousel li {
    	width: 33.3% !important;
    	margin: 0 auto !important;
    	padding: 2px;
    }
    #slider {
    	margin-bottom: 15px;
    }
    .selected-location {
    	height: 400px;
    	background-size: cover;
    	background-repeat: no-repeat;
    	width: 100%;
    }
    .selectedLocation-info {
    	margin: 15px 0 0;
    }
    .row.form-group {
        margin-bottom: 1rem;
        margin-top: 1rem;
    }
    .card-body.when_sec .row {
        margin-bottom: 5px;
    }
    .ui-datepicker-inline,.hasDatepicker {
        width: 100%;
    }
    .ui-datepicker-buttonpane{
      display: none;
    }
</style>
@endsection
@section('main-content')
<form method="post" action="" name="scheduleTrial" >
  {{ csrf_field() }}
  <input type="hidden" name="matcher_id" value="{{$user_id}}" />
<div class="maincontent">

   <div class="content bgwhite">
      <div class="membership" style="margin-top: 2rem;">
         <div class="container-fluid">

           <div id="ajaxResponse"></div>
           @if(session()->has('message'))
               <div class="alert alert-success">
                   {{ session()->get('message') }}
               </div>
           @endif

           @if(session()->has('warning'))
               <div class="alert alert-danger">
                   {{ session()->get('warning') }}
               </div>
           @endif

           @if(count($AdopterFamilyRoles) <=0)
           <div class="alert alert-danger">
               Please select family roles from your profile to setup a Trial Date.
           </div>

           @endif

           @if(count($AdopteeFamilyRoles) <=0)
               <div class="alert alert-danger">
                   {{$user->display_name_on_pages}}'s has no family role to Setup Trial Date.
               </div>
           @endif
            <div class="row">
               <div class="col-md-7">
                  <div class="card">
                     <div class="lft_sec">
                        <h1>Family Role Selection</h1>
                     </div>
                     <div class="card-body">
                        <div class="para_sec">
                           Family Role selection is very important as it will determine the roles of adopter and adoptee throughout the adoption process. If your Family Role selection is not compatible with an available Family Role of another user, then you may not attend a Trial Date with said user.</p>
                        </div>
                        <div class="row form-group">
                           <div class="col-md-5">
                              <label class="col-form-label txt_input">Your Family Role</label>
                           </div>
                           <div class="col-md-7">
                              <div class="input-group" data-provide="">
                                <select name="adopter_familyRole" class="form-control" id="adopterfamilyRole" required>
                                    <option value="">Select</option>
                                    @if(count($AdopterFamilyRoles) > 0)
                                      @foreach($AdopterFamilyRoles as $role)
                                        <option value="{{$role->id}}">{{$role->title}}</option>
                                      @endforeach
                                    @endif
                                </select>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                          <p class="col-md-12 txt_sec">Select the family role that you will be going on trial with "{{$user->display_name_on_pages}}" as. This is also the Family Role that you will use throughout the adoption process.</p>
                        </div>

                     </div>
                  </div>

                  <div class="card">
                     <div class="card-body">
                        <div class="para_sec">
                          <div class="row form-group">
                             <div class="col-md-5">
                                <label class="col-form-label txt_input">{{$user->display_name_on_pages}}'s Family Role</label>
                              </div>
                             <div class="col-md-7">
                                <div class="input-group" data-provide="">
                                  <input type="hidden" id="matcher_id" value="{{$user->id}}" />
                                  <select name="adoptee_familyRole" class="form-control" id="adopteefamilyRole" required>
                                      <option value="">Select</option>
                                       <!-- @if(count($AdopteeFamilyRoles) > 0)
                                        @foreach($AdopteeFamilyRoles as $role)
                                          <option value="{{$role->id}}">{{$role->title}}</option>
                                        @endforeach
                                      @endif -->
                                  </select>
                                </div>
                             </div>
                          </div>
                          <div class="col-md-12 row">
                            <p class="txt_sec">Select the family role that "{{$user->display_name_on_pages}}" is available to go on trial as. This is also the Family Role that "{{$user->display_name_on_pages}}" will use throughout the adoption process.</p>
                          </div>
                        </div>
                      </div>
                    </div>
               </div>
               <div class="col-md-5">
                  <div class="card">
                     <div class="lft_sec">
                        <h1>When? <small>( Set date & time for a Trial Date)</small></h1>
                     </div>
                     <div class="card-body when_sec">
                        <div class="row">
                           <div class="col-md-4">
                              <label class="col-form-label txt_input">Date</label>
                           </div>
                           <div class="col-md-8">
                              <div class="input-group date schedulePicker">
                                 <input type="text" name="trial_date" id="datePicker" min="<?php echo date('Y-m-d');?>" class="form-control" required />
                                 <span class="input-group-addon">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                 </span>
                                 <div id="datePickerDiv"></div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                              <label class="col-form-label txt_input">Time (SLT)</label>
                           </div>
                         
                           <div class="col-md-8">
                              <div class='input-group date clockpicker schedulePicker' >
                                  <input type='text' class="form-control" name="trial_time" value="<?php echo date('h:i A');?>" id='timePicker' required/>
                                  <span class="input-group-addon">
                                      <i class="fa fa-clock-o" aria-hidden="true"></i>
                                  </span>
                                  <div id="timePickerDiv"></div>
                                  
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div id="main" role="main">
      <div class="middle_sec">
         <h1>Choose a fabulous location</h1>
         <p class="para_intruction">
           This is the initial location where you'll attend a Trial Date with {{$user->display_name_on_pages}}. You may decide on where to go for the remainder <br> of your Trial Date. However, we recommend that you only conduct meetings in public locations throughout your Trial Date period.
         </p>
      </div>
      <div class="card-body">
      </div>
      <div class="slider">
         <div class="row ">
            <div class="col-md-6">
               <div id="slider" class="flexslider">
                  <ul class="slides">
                    @if(null != $locations)
                      @foreach($locations as $location)
                     <li>
                       <div class="selected-location" style="background-image:url('{{ url('uploads/location')}}/{{$location->image}}')"></div>
                        <div class="col-md-12 selectedLocation-info">
                           <h3><a href="{{$location->address}}" target="_blank">{{$location->name}}</a></h3>
                           <p>{{$location->description}}</p>
                        </div>
                     </li>
                     @endforeach
                     @endif
                  </ul>
               </div>

            </div>
            <div class="col-md-6">
               <div id="carousel" class="flexslider">
                  <div class="slides">
                    @if(null != $locations)
                      @foreach($locations as $location)
                      <li class="slde_ntt trialLocation-items" data-id="{{$location->id}}">
                        <div class="location-Items" style="background-image:url('{{ url('uploads/location')}}/{{$location->image}}')"> <p class="img__description"><span>Selected</span></p></div>


                      </li>
                      @endforeach
                    @endif

                    <!-- Set input locaton value -->
                    @if(null != $locations)
                      @foreach($locations as $location)
                      @if($loop->first)
                        <input type="hidden" name="trial_location_id" value="{{$location->id}}" id="trialLocationId" />
                      @endif
                      @endforeach
                    @endif


                  </div>
               </div>
            </div>
            <div class="btn_sec">
               <button type="submit" class="btn-primary btn" name="action" value="sendTrial_Request">Schedule</button>
            </div>
         </div>
      </div>
   </div>
</div>
</form>


@endsection

@section("footer")
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
@endsection
@section('page_level_scripts')

<!-- FlexSlider -->
<script defer src="{{ asset('slider/jquery.flexslider.js')}}"></script>
<!-- Syntax Highlighter -->
<!-- <script type="text/javascript" src="{{ asset('slider/js/shCore.js')}}"></script>
<script type="text/javascript" src="{{ asset('slider/js/shBrushXml.js')}}"></script>
<script type="text/javascript" src="{{ asset('slider/js/shBrushJScript.js')}}"></script> -->
<!-- Optional FlexSlider Additions -->
<!-- <script src="{{ asset('slider/js/jquery.easing.js')}}"></script>
<script src="{{ asset('slider/js/jquery.mousewheel.js')}}"></script>
<script defer src="{{ asset('slider/js/demo.js')}}"></script> -->
<script type="text/javascript">
   // $(function(){
   //   SyntaxHighlighter.all();
   // });
   $(window).load(function(){
     $('#carousel').flexslider({
       animation: "slide",
       controlNav: false,
       fade: true,
       animationLoop: false,
       slideshow: false,
       itemWidth: 210,
       itemMargin: 5,
       asNavFor: '#slider'
     });

     $('#slider').flexslider({
       controlNav: false,
       animationLoop: false,
       fade: true,
       slideshow: false,
       sync: "#carousel",
       start: function(slider){
         $('body').removeClass('loading');
       }
     });
   });
</script>

<script type="text/javascript">
$(document).ready(function(){
    $(".trialLocation-items").click(function(){
        var loc_id = $(this).attr("data-id");
        $("#trialLocationId").val(loc_id);
    });
});
</script>
@php

  $date = date('H:i');

@endphp

<script type="text/javascript">

           $(function () {

               $('#timePickerDiv').timepicker({
               	timeFormat: "hh:mm TT",
                inline:true,
                altField: '#timePicker',
                useLocalTimezone: false,
                timezone: '-0700'
               });

               $('#timePickerDiv').datepicker('setDate', new Date());

                 $('#datePickerDiv').datepicker({
                    dateFormat: 'yy-mm-dd',
                    inline:true,
                    altField: '#datePicker',
                    minDate: 'd'
                 });
           });


       </script>
@if(count($AdopterFamilyRoles) > 0 && count($AdopteeFamilyRoles) > 0)
<script>
$(document).ready(function(){
    //$('[data-toggle="tooltip"]').tooltip();
    $("#adopterfamilyRole").change(function(){
      jQuery('#adopteefamilyRole').find('option').remove();

      var adopter_familyRole = $(this).val();
      var matcher_id = $("#matcher_id").val();

      $.ajax({
          url: "{{ url ('ajaxrequest/trial-family-roles-check')}}" ,
          type: 'POST',
          data: {'_token': $('input[name=_token]').val(), 'adopter_familyRole': adopter_familyRole, 'matcher_id': matcher_id},
          dataType: 'JSON',
          success: function (data) {
            console.log(data);
              var htmldata = '';
              if(data.status == 'success'){
                  for (var i = 0; i < data.familyRoles.length; i++) {
                          htmldata += '<option value="'+data.familyRoles[i].id+'">'+data.familyRoles[i].title+'</option>';
                  }
                  jQuery("#ajaxResponse").html('<div class="alert alert-success">Congrats! You found a match family role.</div>');
                  jQuery('#adopteefamilyRole').append(htmldata);
              }else{
                  jQuery('#adopteefamilyRole').append('<option value="">No matching family role</option>');

                  var node = '<div class="alert alert-danger">'+data.message+'</div>';
                  jQuery("#ajaxResponse").html(node);
              }
          }
      });
    });
});
</script>
@endif
@endsection
