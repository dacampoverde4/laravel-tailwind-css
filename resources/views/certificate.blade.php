@extends('layouts.master')
@section('htmlheader')
<link rel="stylesheet" href="{{ asset('css/stripe.css') }}" type="text/css" />
<script src="https://js.stripe.com/v3/"></script>
<style>
   .table_sec {
   padding-top: 10px;
   margin-top: 1%;
   }
   table.table.color-table.info-table.table_sec td {
   text-align: center;
   }
   table.table.color-table.info-table.table_sec th {
   text-align: center;
   }
   .lft_sec {
   background: #1976d2;
   padding: 5px;
   }
   p.txt_sec {
   color: #000;
   }
   b.token_sec {
   /* font-weight: bold; */
   color: #000;
   }
   .form-row {
   padding: 0 98px !important;
   }
   .lft_sec h1 {
   color: #fff;
   font-size: 26px;
   padding-left: 2rem;
   text-transform: capitalize;
   margin:0;
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
   .btn.btnred {
   background: #26dad2;
   color: #fff;
   }
   .btn_bt {
   text-align: center;
   }
   .para_bt {
   text-align: center;
   margin-top: 1rem;
   }
   .card {
   height: 100%;
   min-height:600px;
   }
   .middle_content {
   text-align: center;
   /* padding: 1px; */
   padding-top: 2rem;
   font-weight: 600;
   font-style: italic;
   }
   p.txt_sec {
   color: #000;
   text-transform: capitalize;
   }
   .card-no-border .card {
        padding: 20px;
    }
   .text_sec {
     float: right;
     position: relative;
     top: 30px;
     }
   h1.header_txt {
   text-align: center;
   padding-top: 1rem;
   color: #2683ae;
   }
   .certificate_border {
    	height: 650px;
    	border: 2px solid #2582ad;
    	padding: 6px;
    	border-radius: 55px;
    }
   .img_sec img {
   position: relative;
   bottom: 121px;
   right: 34px;
   }
   .img_sec_bottom img {
   float: right;
   left: 45px;
   position: relative;
   top: 197px;
   }
   .img_sec_logo img {
   max-width: 333px;
   width: 100%;
   bottom: 13rem;
   position: relative;
   }
   h1.sign_sec {
   font-size: 28px;
   font-family: cursive;
   }
   .user_pic {
   position: relative;
   bottom: 32rem;
   text-align: center;
   }
   .user_pic img {
   width: 100%;
   max-width: 101px;
   height: 96px;
   }
   .user_pic {
    	display: flex;
    	max-width: 370px;
    	width: 100%;
    	margin: 0 auto;
    	justify-content: space-between;
    }
   img.heart_sec_user {
   border-radius: 0 !important;
   padding: 24px;
   height: 84px;
   }
   .content_sec {
   position: relative;
   text-align: center;
   bottom: 31rem;
   /* padding: 22px; */
   }
   span.border_txt {
   background-color: #f9f9f9;
   /* padding: 1px; */
   padding: 5px 60px 5px 60px;
   /*  border-bottom: 1px solid #a5a5a5;  */
   color: #000;
   font-weight: 600;
   }
   .content_sec h4 {
   padding: 15px;
   color: #424242;
   }
   .content_date {
   position: relative;
   bottom: 27rem;
   max-width: 100%;
   width: 333px;
   text-align: center;
   left: 29rem;
   /* font-size: 16px; */
   }
   h3.date_sec {
   color: #000;
   font-size: 16px;
   font-weight: 600;
   }
   .content_about {
   position: relative;
   bottom: 27rem;
   /* padding: 0px 161px 32px 292px; */
   text-align: center;
   font-size: 13px;
   }
   p.about_sec {
   padding-left: 10rem;
   padding-right: 10rem;
   font-size: 15px;
   color: #000;
   font-weight: 500;
   }
   h3.ceo_sec {
   font-size: 16px;
   color: #000;
   font-weight: 600;
   }
   hr.horizontal_sec {
   width: 100%;
   max-width: 34% !important;
   margin-top: 0 !important;
   margin-bottom: 0 !important;
   /* color: #000; */
   }
   .img_sec_logo {
   position: relative;
   top: 48px;
   /* width: 100%; */
   /* max-width: 140px; */
   float: inherit;
   left: 55rem;
   }
   .col-md-12.button_sec {
   text-align: center;
   /* padding: 1px; */
   padding-bottom: 2rem;
   }
   .btn.btnred.orange_button {
   background: #ed8022;
   color: #fff;
   /* padding-left: 0rem; */
   margin-left: 1rem;
   padding: 7px 27px 7px 27px;
   }
   .actionBtns .col-md-12 {
	display: flex;
	align-items: center;
	justify-content: center;
	margin-bottom: 50px;
}
#btn-Convert-Html2Image {
	margin-right: 15px;
}
.membership{overflow:hidden;}
   .userPicImg{
     background-size: 100px auto;
     background-repeat: no-repeat;
     background-position: center center;
   }
   .downloadLoader {
	height: 25px;
	margin-right: 15px;
  opacity: 0;
}

</style>
@endsection

@section('main-content')

<?php if(isset($certificateInfo) && count($certificateInfo)>0){ ?>

<div class="maincontent" id="html-content-holder">
   <div class="content bgwhite">
      <div class="membership" style="margin-top: 2rem;">

         <div class="container-fluid card">
            <div class="certificate_border">
               <h1 class="header_txt"><span>AvDopt</span> Certificate of Adoption</h1>

               <div class="img_sec">
                  <img src="{{ asset('frontend/images/border.png') }}" alt="mail" />
               </div>
               <div class="img_sec_bottom">
                  <img src="{{ asset('frontend/images/borderrightbottom.png') }}" alt="mail"  />
               </div>
               <div class="img_sec_logo">
                  <img src="{{ asset('frontend/images/certificate_log.png') }}" alt="mail" title="AvDopt" />
               </div>
               <div class="user_pic">
                  <div class="userPicImg" style="background-image:url({{ url('uploads') }}/{{ $certificateInfo['adopterPP']}});width:100px;height:100px;border-radius:50%;">
                  </div>
                  <img class="heart_sec_user" src="{{ asset('frontend/images/heart_icon.png') }}" alt="mail" title="AvDopt">
                  <div class="userPicImg" style="background-image:url({{ url('uploads') }}/{{$certificateInfo['adopteePP']}});width:100px;height:100px;border-radius:50%;">
                  </div>

               </div>
               <div class="content_sec">
                 <!-- Adopter -->
                 @if(Auth::user()->id == $getTrial->user_id)
                   <h4>This certifies  that <span class="border_txt">{{$certificateInfo['adopterSLName']}}</span>,</h4>
                   <h4>has officially adopted a <span class="border_txt">{{$certificateInfo['adoptee_familyrole']}}</span>,</h4>
                   <h4>named <span class="border_txt">{{$certificateInfo['adopteeSLName']}}</span>,</h4>
                 @endif

                 <!-- Adoptee -->
                 @if(Auth::user()->id == $getTrial->matcher_id)
                   <h4>This certifies  that <span class="border_txt">{{$certificateInfo['adopteeSLName']}}</span>,</h4>
                   <h4>has officially been adopted by a <span class="border_txt">{{$certificateInfo['adopter_familyrole']}}</span>, </h4>
                   <h4>named <span class="border_txt">{{$certificateInfo['adopterSLName']}}</span>,</h4>
                 @endif

               </div>
               <div class="content_sec">
                  <h3 class="date_sec">{{$certificateInfo['successDate']}} SLT</h3>
               </div>
               <div class="content_sec">
                 <!-- Adopter -->
                 @if(Auth::user()->id == $getTrial->user_id)
                  <p class="about_sec">
                  <!-- By Signing This Certificate, You Promise To Give <b>{{$certificateInfo['adopteeSLName']}}</b> All Of The Love And Care That {{$certificateInfo['adoptee_attr']}} Require In Return, Your <b>{{$certificateInfo['adoptee_familyrole']}}</b> Will Give You All The Love, Comfort and Attention You Need. -->
                    By signing this certificate, you promise to give <b>{{$certificateInfo['adopteeSLName']}}</b> all of the love and care that {{$certificateInfo['adoptee_attr']}} require in return, your <b>{{$certificateInfo['adoptee_familyrole']}}</b> will give you all the love, comfort and attention you need. Failure to meet adoption requirements herein, may result in dissolution.
                </p>
                  @endif
                  <!-- Adoptee -->
                  @if(Auth::user()->id == $getTrial->matcher_id)
                   <p class="about_sec">
                     <!-- By Signing This Certificate, You Promise To Give <b>{{$certificateInfo['adopterSLName']}}</b> All Of The Love And Care That {{$certificateInfo['adopter_attr']}} Require In Return, Your <b>{{$certificateInfo['adopter_familyrole']}}</b> Will Give You All The Love, Comfort and Attention You Need. -->

                    By signing this certificate, you promise to give <b>{{$certificateInfo['adopterSLName']}}</b> all of the love and care that {{$certificateInfo['adopter_attr']}} require in return, your <b>{{$certificateInfo['adopter_familyrole']}}</b> will give you all the love, comfort and attention you need. Failure to meet adoption requirements herein, may result in dissolution.
                   </p>

                   @endif

                  <p class="about_sec">Signed and Approved by</p>
                  <h1 class="sign_sec">Mikekey Monday</h1>
                  <hr class="horizontal_sec">
                  <h3 class="ceo_sec">CEO & Founder</h3>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@if(Auth::user()->id == $getTrial->user_id || Auth::user()->id == $getTrial->matcher_id)
<div class="col-md-12 actionBtns" id="certificateAction-btn" >

       <div class="col-md-12">
         <?php
         if(Auth::user()->id == $getTrial->user_id){
           $file_path = 'adoption_certificate_adopter_'.$getTrial->id.'.png';
         }
         if(Auth::user()->id == $getTrial->matcher_id){
           $file_path = 'adoption_certificate_adoptee_'.$getTrial->id.'.png';
         }
         ?><img src="{{ url('uploads')}}/loading.gif" class="downloadLoader"/>
         <button id="btn-Convert-Html2Image" class="btn btnred" download>DOWNLOAD</button>

        <div class="sharethis-inline-share-buttons" data-title="Adoption Certificate" data-url="{{ url('uploads/certificates')}}/{{$file_path}}" data-image="{{ url('uploads/certificates')}}/{{$file_path}}"></div>
      </div>
</div>
@endif



<?php }else{ ?>
  <div class="maincontent">
     <div class="content bgwhite">
        <div class="membership" style="margin-top: 2rem;">
           <div class="container-fluid card">
              <div class="certificate_border">
                 <h1 class="header_txt">Certificate of Adoption</h1>
                 <div class="img_sec">
                    <img src="{{ asset('frontend/images/border.png') }}" alt="mail">
                 </div>
                 <div class="img_sec_bottom">
                    <img src="{{ asset('frontend/images/borderrightbottom.png') }}" alt="mail" >
                 </div>
                 <div class="img_sec_logo">
                    <img src="{{ asset('frontend/images/certificate_log.png') }}" alt="mail" title="AvDopt">
                 </div>
                 <div class="user_pic">
                    <img  class="lft_user" src="{{ asset('frontend/images/member4.png') }}" alt="mail" title="AvDopt">
                    <img class="heart_sec_user" src="{{ asset('frontend/images/heart_icon.png') }}" alt="mail" title="AvDopt">
                    <img  class="right_user"src="{{ asset('frontend/images/member6.png') }}" alt="mail" title="AvDopt">
                 </div>
                 <div class="content_sec">
                    <h4>This certifies  that &nbsp;<span class="border_txt">AvDopter SL Name</span>,</h4>
                    <h4>has officiallay adopted &nbsp;<span class="border_txt">AvDopter Family Role</span>,</h4>
                    <h4>named &nbsp;<span class="border_txt">AvDopter SL Name</span>,</h4>
                 </div>
                 <div class="content_sec">
                    <h3 class="date_sec">August 11, 2019 &nbsp; &nbsp; 12:37 PM SLT</h3>
                 </div>
                 <div class="content_sec">
                    <p class="about_sec"> by signing this certificate , you promise to give your adopted magical animal all of the love and care that it require in return, your magical animal will give you all the love, comfort and attention you need.</p>
                    <p class="about_sec"> Signed and approved by</p>
                    <h1 class="sign_sec">Mikekey Monday</h1>
                    <hr class="horizontal_sec">
                    <h3 class="ceo_sec">CEO & Founder</h3>
                 </div>
              </div>
           </div>
        </div>
     </div>
  </div>

<?php
}
?>
@endsection


@section('og')
<meta property="og:title" content="Adoption Certificate" />
<meta property="og:image" content="{{ url('uploads/certificates')}}/{{$file_path}}" />
<meta property="og:url" content="{{ url('uploads/certificates')}}/{{$file_path}}" />
@endsection

@section("page_level_scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js" integrity="sha256-c3RzsUWg+y2XljunEQS0LqWdQ04X1D3j22fd/8JCAKw=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/canvas2image/0.1/canvas2image.min.js"></script>


<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5dafdf7bfa343600199433b7&product=inline-share-buttons' async='async'></script>
<script>

$(document).ready(function(){

  var certificateName = "{{$file_path}}";
  var element = $("#html-content-holder");
  var getCanvas;

  html2canvas(element, {
                allowTaint: true,
                logging: true,
                taintTest: false,
                scale:2,
                onrendered: function (canvas) {
                       getCanvas = canvas;

                }
  });


  setTimeout(function(){
    var imgageData = getCanvas.toDataURL("image/png", 1.0);
    // Now browser starts downloading it instead of just showing it
    var newData = imgageData.replace(/^data:image\/(png|jpg|jpeg)/, "data:application/octet-stream");

    // save image
    $.ajax({
       type: "POST",
       url: "{{ url('ajaxrequest/save-certificate')}}",
       data: {
           imgBase64: imgageData,
           trial_id : '{{$getTrial->id}}',
           _token   : "{{ csrf_token() }}",
       }
     }).done(function(o) {

          $("#btn-Convert-Html2Image").on('click', function () {
              $(".downloadLoader").css("opacity", "1");
              var link = document.createElement('a');
              link.download = certificateName;
              link.href = newData;
              document.body.appendChild(link);
              link.click();
              link.remove();
              $(".downloadLoader").css("opacity", "0");
          });
       console.log('saved');

    });
  }, 2000);


  // $("#btn-Convert-Html2Image").on('click', function () {
  //
  //     $(".downloadLoader").css("opacity", "1");
  //     var imgageData = getCanvas.toDataURL("image/png", 1.0);
  //     // Now browser starts downloading it instead of just showing it
  //     var newData = imgageData.replace(/^data:image\/(png|jpg|jpeg)/, "data:application/octet-stream");
  //
  //     // save image
  //     $.ajax({
  //        type: "POST",
  //        url: "{{ url('ajaxrequest/save-certificate')}}",
  //        data: {
  //            imgBase64: imgageData,
  //            trial_id : '{{$getTrial->id}}',
  //            _token   : "{{ csrf_token() }}",
  //        }
  //      }).done(function(o) {
  //
  //        $(".downloadLoader").css("opacity", "0");
  //        console.log('saved');
  //        var link = document.createElement('a');
  //        link.download = certificateName;
  //        link.href = newData;
  //        document.body.appendChild(link);
  //        link.click();
  //        link.remove();
  //     });
  //   });
});
</script>
@endsection
