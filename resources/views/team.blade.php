@extends('v7.frontend')
@section('page_level_styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>
   .profile-tab li a.nav-link.active, .customtab li a.nav-link.active {
   text-decoration: none;
   background-color: #3b5998;
   color: #fff;
   text-align: center;
   border: none;
   }
   .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
   color: #fff !important;
   cursor: default;
   background-color: #3b5998 !important;
   border: 1px solid #ddd;
   border-bottom-color: transparent;
   }
   img.emp_img {
    position: relative;
    top: 21px;
}
   img.staff_img {
    height: 230px;
}
   a.nav-link.active {
   color: #fff!important;
   border:none!important;
   }
   .customtab li a.nav-link, .profile-tab li a.nav-link {
   border: 0px;
   padding: 15px 0 !important;
   color: #67757c;
   }
   .nav-tabs .nav-item {
   margin-bottom: -1px;
   width: 33%;
   text-align: center;
   margin-right: 1px;
   margin-left: 1px;
   }
   ul.nav.nav-tabs.profile-tab a {
   color: #000;
   }
   .nav-tabs .nav-link {
   border: 1px solid transparent !important;
   border-top-left-radius: .25rem !important;
   border-top-right-radius: .25rem !important;
   }
   ul.nav.nav-tabs.profile-tab li a:hover {
   color: #fff;
   background: #3b5998;
   }
   img.gallery-show {
   height: 310px  !important;
   }
   span.discover-btn {
   color: #6B02FF;
   }
   span.discover-btn2 {
   color: #f29b37;
   }
   span.discover-btn3 {
   color: #3aa595;
   }
   .icon-sec a {
   padding: 5px;
   }
   .nav-pills .nav-link.active,
   .nav-pills .show > .nav-link {
   color: #fff !important;
   background-color: #007bff;
   }
   .card-body {
   -ms-flex: 1 1 auto;
   flex: 1 1 auto;
   padding: 1.25rem;
   }
   .nav.nav-pills.nav-fill.navtop.nv_sec li a {
   text-transform: uppercase;
   }
   .card {
   border: 0px;
   border-radius: 4px;
   -webkit-box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05);
   box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05);
   }
   .card {
   margin-bottom: 30px;
   }
   .card {
   position: relative;
   display: -ms-flexbox;
   display: flex;
   -ms-flex-direction: column;
   flex-direction: column;
   min-width: 0;
   word-wrap: break-word;
   background-color: #fff;
   background-clip: border-box;
   border-radius: .25rem;
   }
   .card_txt h1 {
   font-size: 20px;
   margin-bottom: 0;
   text-transform: uppercase;
   line-height: 20px;
   }
   .card_txt {
   margin-top: 2rem;
   }
   .nv_sec {
   width: 50%
   }
   .rightext p {
   font-size: 15px;
   margin-top: 1rem;
   }
  .card_txt p {
    margin-top: 1rem;
    height: 98px;
}
   .nav.nav-pills.nav-fill.navtop.nv_sec li a {
   color: #918787;
   }
   .img_left img {
   width: 100%;
   }
   .img_left img {
   width: 100%;
   -webkit-filter: grayscale(100%);
   }
   .card_img img {
   width: 100%;
   -webkit-filter: grayscale(100%);
   }
   .rightext h1 {
   font-size: 22px;
   margin-bottom: 0;
   line-height: 20px;
   }
  .cr_full {
    text-align: center;
    height: 457px;
}
   .tab-content {
   margin-top: 3rem;
   }
   .mnth_head h1 {
   font-size: 26px;
   }
   .texting_sec h1 {
   font-size: 26px;
   }
   .page-title {
   margin-top: 4rem;
   }
   .pge_top {
   background: #ffffffe6!important;
   }
   a.btn.btn-lg.btn-blue.small.about {
   margin-left: 45%;
   background: linear-gradient(135deg, #46c6b3 100%, #3aa595 0%);
   margin-bottom: 3rem;
   }
   a.btn.btn-lg.btn-blue.small.about:hover {
   background: linear-gradient(135deg, #46c6b3 0%, #2a786c 100%);
   }
   .card.eom_sec {
    height: 100%;
    min-height: 260px;
}
</style>
@stop
@section('content')

<div class=" pge_top">
   <div class=" container">
      <div class=" page-title ">
         <div class="row">
            <div class="col-lg-7 col-xlg-7 col-md-7">
               <div class="card eom_sec">
                  <div class="card-body">
                     <div class="texting_sec">
                        <h1>	 
						@if(!empty($employee))
						@foreach($employee as $row)
						{{$row->title}}
						@endforeach
						@endif
						</h1>
                        <p>
						@if(!empty($employee))
						@foreach($employee as $row)
						{{substr($row->description,0 ,550)}}
						@endforeach
						@endif

						</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-5 col-xlg-5 col-md-5">
               <div class="card eom_sec">
                  <div class="card-body">
                     <div class="mnth_head">
                        <h1 class="">Employee of the month</h1>
                     </div>
                     <div class="row">
					 @if(!empty($employee))
						 @foreach($employee as $row)
                        <div class="col-lg-4 col-xlg-4 col-md-4">
                           <div class="img_left">
                               @if(!empty($row->profile_pic))
						  <img class="emp_img" src="  {{ ( $row->profile_pic )? url('/uploads').'/'.$row->profile_pic : url('/images/default.png')}}">
						   @else
                              <img src="{{ asset('frontend/images/5.jpg') }}">
						  @endif
                           </div>
                        </div>
                        <div class="col-lg-8 col-xlg-8 col-md-8">
                           <div class="rightext">
                              <h1>{{$row->displayname}} </h1>
                              <span>Human resources </span>
                              <p>{{substr($row->about_me,0 ,120)}}</p>
                           </div>
                        </div>
						@endforeach
						@endif
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container">
         <ul class="nav nav-tabs">
            <li class="nav-link  @if(empty($cat_id)) active @endif"><a  href="{{ url('/team') }}">All</a></li>
			@if(!empty($categories))
			@foreach($categories as $category)
			<li class="nav-link @if(!empty($cat_id)) @if($cat_id== $category->id ) active @endif @endif" ><a  href="{{ route('teams', $category->id)}}">{{$category->category_name}}</a></li>
			@endforeach
				@endif
            <!--li><a data-toggle="tab" href="#menu1">Web Designer</a></li>
            <li><a data-toggle="tab" href="#">Html Coader</a></li>
            <li><a data-toggle="tab" href="#">Marketing</a></li-->
         </ul>
         <div class="tab-content">
            <div class="tab-pane active" role="tabpanel" id="menu1">
               <div class="row">
			   
			   @if(!empty($staff))
				   @foreach( $staff as $viewstaff)
			
                  <div class="col-lg-3 col-xlg-3 col-md-3">
                     <div class="card cr_full">
                        <div class="card-body">
						   <a href="{{route('viewprofile', base64_encode( $viewstaff->id ))}}">
                           <div class="card_img">
						   @if(!empty($viewstaff->profile_pic))
						  <img class="staff_img" src="  {{ ( $viewstaff->profile_pic )? url('/uploads').'/'.$viewstaff->profile_pic : url('/images/default.png')}}">
						   @else
                              <img src="{{ asset('frontend/images/5.jpg') }}">
						  @endif
                           </div>
						   </a>
                           <div class="card_txt">
                              <h1>{{$viewstaff->displayname}}</h1>
                              <span>{{$viewstaff->designation}}</span>  
                              <p> {{substr($viewstaff->about_me,0 ,120)}}</p>
                           </div>
                          
                        </div>
                     </div>
                  </div>
				
				@endforeach
				
				  @endif
           
                 
               </div>
               <a href="{{ url('/jobs') }}" class="btn btn-lg btn-blue small  about">Join Our Team</a> 
            </div>
            <div class="tab-pane" role="tabpanel" id="menu2">Created By Cytus ۲</div>
            <div class="tab-pane" role="tabpanel" id="menu3">Created By Cytus ۳</div>
            <div class="tab-pane" role="tabpanel" id="menu4">Created By Cytus ۳</div>
         </div>
      </div>
   </div>
</div>
<!--begin contact -->
<section class="section-dark" id="contact">
   <!--begin container-->
   <div class="container">
      <!--begin row-->
      <div class="row">
         <!--begin col-md-10 -->
         <div class="col-md-10 col-md-offset-1 text-center margin-bottom-30">
            <h2 class="section-title grey">Visit Avdopt In-world</h2>
            <p class="section-subtitle grey">Our main office (in-world) is open to the public 24/7. Wether you need to register at our main<br> office or simply exploure the many beauties of the Avdopt Sim, an adventure awaits you...</p>
            <a href="http://maps.secondlife.com/secondlife/AvDopt/101/130/37" " target="_blank" class="btn btn-lg btn-blue">Visit Avdopt</a>
         </div>
         <!--end col-md-10 -->
      </div>
      <!--end row-->
      <!--begin row-->
      <div class="row margin-20">
      </div>
      <!--end col-md-12-->
      </form>
      <!--end contact form -->
   </div>
   <!--end row-->
   </div>
   <!--end container-->
</section>
<!--end contact-->
<!--begin footer -->
<!--<div class="footer">-->
<!--begin container -->
<!--    <div class="container">-->
<!--begin row -->
<!--        <div class="row">-->
<!--begin col-md-12 -->
<!--            <div class="col-md-12 text-center">-->
<!--                <p>Copyright © 2019 AvDopt, All rights reserved. </p>-->
<!--begin footer_social -->
<!--                <ul class="footer_social">-->
<!--                    <li>-->
<!--                        <a href="#">-->
<!--                            <i class="fa fa-twitter"></i>-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="#">-->
<!--                            <i class="fa fa-pinterest"></i>-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="http://www.facebook.com/avdopt">-->
<!--                            <i class="fa fa-facebook"></i>-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="#">-->
<!--                            <i class="fa fa-instagram"></i>-->
<!--                        </a>-->
<!--                    </li>--> 
<!--                    <li>-->
<!--                        <a href="#">-->
<!--                            <i class="fa fa-skype"></i>-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="#">-->
<!--                            <i class="fa fa-dribble"></i>-->
<!--                        </a>-->
<!--                    </li>-->
<!--                </ul>-->
<!--end footer_social -->
<!--            </div>-->
<!--end col-md-6 -->
<!--        </div>-->
<!--end row -->
<!--    </div>-->
<!--end container -->
<!--</div>-->
<!--end footer -->
<!-- End testimonial Section -->
@endsection