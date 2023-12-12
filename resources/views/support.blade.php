@extends('v7.frontend')
@section('page_level_styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@yield('head')
<style>
   .navbar {
   padding: 0 !important;
   margin: 0 !important;
   border: none;
   }
   .lgt_btn h1 {
   font-size: 31px;
   color: #337ab7;
   font-weight: 300;
   }
   .lgt_btn p {
   font-size: 15px;
   color: #8e8b8b;
   font-weight: 300;
   }
   .rgt_btn a {
   padding: 10px 32px;
   font-size: 20px;
   margin-top: 9rem;
   }
   .top_sec, .mid_sec,.btm_sec {
   border-radius: 4px;
   -webkit-box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05);
   box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05);
   padding: 3rem;
   background: #f0eded;
   margin-top: 2rem;
   margin-bottom: 2rem;
   }
   .d_img img {
   width: 100%;
   max-width: 200px;
   }
   .d_text p {
   font-size: 16px;
   color: #535151;
   font-weight: 300;
   margin-bottom: 15px;
   }
   .d_text {
   margin-top: 1rem;
   }
   .d_btn a {
   padding: 6px 24px;
   background: #fff;
   font-size: 17px;
   font-weight: 600;
   }
   .btn.ylo {
   background: #e37547;
   color: #Fff;
   }
   .d-txt-brdr {
   border-top: 1px solid;
   border-bottom: 1px solid;
   padding: 20px 0;
   border-color: #e6dfdf;
   }
   .d_btm_sec {
   text-align: center;
   }
   .d_btm_img img {
   width: 100%;
   max-width: 100px;
   }
   .d_btm_txt p {
   font-size: 19px;
   color: #535151;
   font-weight: 600;
   margin-top: 2rem;
   text-transform: capitalize;
   }
   .d_text h1 {
   font-size: 25px;
   color: #337ab7;
   font-weight: bold;
   }
   .btm_sec h1 {
   margin: 0;
   font-size: 29px;
   margin-bottom: 2rem;
   }
   .d_btm_sec {
   margin-top: 1rem;
   }
   .d_text p span {
   color: #e37547;
   font-weight: bold;
   }
   .borderp{
   	border-bottom: 1px solid #e6dfdf;
   	padding-bottom: 20px;
   }
   .pb10 {
      margin: 10px auto 0;
   }
   .btn-sec{
      padding: 15px 0;
   }
   .btn-sec button {
      background-color: #3b5998;
      border-color: #3b5998;
   }
   .d_btm_sec {
      padding: 10px;
      border: 1px solid #ffffff;
      border-radius: 10px;
      min-height: 210px;
   }
   .d_btm_sec p {
       padding: 0;
       margin: 15px 0 10px;
   }
   .mleft{
      margin-left: 15px;
   }
   .checkbox_sec{
      margin: 0 !important;
   }
   .amnt{
      color: green;
   }
   @media only screen and (max-width: 767px){
      .d_btm_sec {
         min-height: auto !important;
      }
   }
</style>
@stop
@section('content')
<div class="sprt_sec">
   <div class="container">      
      <div class="mid_sec">
         <div class="row">
            <div class="col-md-3">
               <div class="d_img">
                  <img src="  {{ asset('/images/icon-Give.png ')}}">
               </div>
            </div>
            <div class="col-md-9">
               <div class="d_text">                 
                  <h1>Become a proud Sponsor</h1>
                  <p class="borderp">Did you know that in Second Life:  Over 43% of avatars seeking adoption, experienced some type of relationship trauma in Real Life?</p>
                  <p class="borderp">When asked why do we care about adoption in Second Life, considering the Real Life investments at stake, our most significant concern is the people behind the avatars. At first glance, one may see pixels; however, we see so much more. Everyone deserves a chance at happiness, and we've developed AvDopt to aide in the pursuit of happiness.</p>
                  <p class="borderp">This year, we have the ambitious goal of releasing many features and expanding our services in Second Life, most of which are free. Won't you consider helping us give the gift of convenience, reliability, and quality? After all, your small investment can help us to do big things.</p>
               </div>
               <div class="d_btn">
                  <a data-toggle="modal" data-target="#donationModal" class="btn ylo "> Donate </a>
                  <a href="{{ url('/about') }}" class="btn  "> Learn more</a>
               </div>
               <!-- Modal donation start -->
                  <div class="donation_popup">
                     <div class="modal fade" id="donationModal" tabindex="-1" role="dialog" aria-labelledby="feeaturePlanModalLabel"
                          aria-hidden="true">
                         <div class="modal-dialog" role="document">
                             <div class="modal-content featured_popup">
                                 <div class="modal-header padding0">
                                     <h4 class="modal-title">Submit Donation Form
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button></h4>
                                 </div>
                                 <div class="modal-body">
                                    <div class="row">
                                       <form action="{{ route('wallet.checkoutcredit') }}" method="POST" id="payment-form">
                                          @csrf
                                          <input type="hidden" name="checkout_type" value="2">
                                          <div class="form-row">
                                             <div class="col-md-12 pb10">
                                                <label for="card-element"><b>Please enter the amount of Lindens/Tokens you'd like to donate to AvDopt:</b></label>
                                                <input type="number" class="form-control" name="amount" value="" id="amount" required/>
                                             </div>
                                          </div>

                                          <div class="form-row">
                                             <div class="col-md-12 pb10">
                                                <label for="card-element"><b>Would you like your profile displayed as an AvDopt Supporter?</b></label>
                                                <div class="checkbox checkbox_sec">
                                                   <label><input type="checkbox" class="check" name="show_supporter" value="1">yes</label>
                                                   <label class="mleft"><input type="checkbox" class="check" name="show_supporter" value="0">No</label>
                                                </div>                                                
                                             </div>
                                          </div>

                                          <div class="form-row">
                                             <div class="col-md-12 pb10">
                                                <label for="card-element"><b>Show the amount you donated?</b></label>
                                                <div class="checkbox checkbox_sec">
                                                   <label><input type="checkbox" class="check_amnt" name="show_amount" value="1">yes</label>
                                                   <label class="mleft"><input type="checkbox" class="check_amnt" name="show_amount" value="0">No</label>
                                                </div>                                                
                                             </div>
                                          </div>

                                          <div class="form-row">
                                             <div class="col-md-12 btn-sec text-center">
                                                <div class="btn_bt">
                                                   <button class="btn btnred subbtn btn-primary">Submit</button>
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
               <!-- Modal end -->
            </div>
         </div>
      </div>
      <div class="btm_sec">
         <h1>Avdopt Supporters</h1>
         <div class="row">
            @foreach($users as $user)
               <div class="col-md-3">
                  <div class="d_btm_sec">
                     <div class="d_btm_img">
                        <a href="{{ url('userprofile')}}/{{ base64_encode($user->id) }}"><img src="{{ ( $user->profile_pic )? url('/uploads').'/'.$user->profile_pic : url('/images/default.png')}}" class="img-circle"></a>
                     </div>
                     <div class="d_btm_txt">
                        <p><a href="{{ url('userprofile')}}/{{ base64_encode($user->id) }}">{{ @$user->displayname }}</a></p>
                        @if($user->show_amount > 0)
                        <p><span class="amnt">Amount</span> : {{ @$user->amount }} Tokens</p>
                        @endif
                     </div>
                  </div>
               </div>
            @endforeach
            
         </div>
      </div>
   </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
   $('.check').click(function() {
      $('.check').not(this).prop('checked', false);
   });
   $('.check_amnt').click(function() {
      $('.check_amnt').not(this).prop('checked', false);
   });
});
</script>