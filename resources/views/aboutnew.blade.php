@extends('v7.frontend')
<style>
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
</style>
@section('content')
  <!--begin home section -->
    <section class="aboutpage-section" id="aboutpage_wrapper">

		<div class="aboutpage-section-overlay"></div>

		<!--begin container -->
		<div class="container">

	        <!--begin row -->
	        <div class="row">
	          
	            <!--begin col-md-6-->
	            <div class="col-md-6 padding-top-30">

	          		<h1>Say Goodbye To Adoption Panels & Hello To AvDopt!</h1>

	          		<p>On Avdopt, you're more than just a photo on a prim. You have stories to tell, and things to talk about that are more interesting than lag. Get noticed for who you are, not what you look like. Ditch the panels and the lag; you deserve better!</p>

	        		

	            </div>
	            <!--end col-md-6-->
	       
				<!--begin col-md-6 -->
				<div class="col-md-6">
            
                    <iframe src="http://player.vimeo.com/video/69988283?color=fe403a&amp;title=0&amp;byline=0&amp;portrait=0" width="555" height="321" class="frame-border wow bounceIn" data-wow-delay="1s"></iframe>
                   
				</div>
				<!--end col-md-6 -->

	        </div>
	        <!--end row -->

		</div>
		<!--end container -->

    </section>
    <!--end home section -->
    
    	<!--begin section-grey -->
   
    <!--end section-grey-->
    
    	<!--begin team section -->

  	<!--end team section -->
    

    <!--end section-gradient -->
    
    <div class=" pge_top">
    <div class=" container">
<div class=" page-title ">

<div class="row">

<div class="col-lg-7 col-xlg-7 col-md-7">
<div class="card">
<div class="card-body">
<div class="texting_sec">
<h1>TEXTTEXTTEXTTEXTTEXT </h1>
<p>TEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXT</p>

</div>
</div>
</div>
</div>

<div class="col-lg-5 col-xlg-5 col-md-5">
<div class="card">
<div class="card-body">
<div class="mnth_head">
<h1 class="">Employee of the month</h1>
</div>
<div class="row">
<div class="col-lg-4 col-xlg-4 col-md-4">
<div class="img_left">
<img src="{{ asset('frontend/images/5.jpg') }}" width="150">
</div>
</div>
<div class="col-lg-8 col-xlg-8 col-md-8">
<div class="rightext">
<h1>janet adams </h1>
<span>Human resources </span>
<p>TEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTTEXTT</p>

</div>
</div>
</div>
</div>
</div>

</div>

</div>

</div>

<div class="container">
<ul class="nav nav-pills nav-fill navtop nv_sec">
<li class="nav-item">
<a class="nav-link active" href="#menu1" data-toggle="tab">all</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#menu2" data-toggle="tab">web designer</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#menu3" data-toggle="tab">html coader</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#menu4" data-toggle="tab">marketing</a>
</li>
</ul>
<div class="tab-content">

<div class="tab-pane active" role="tabpanel" id="menu1">

<div class="row">

<div class="col-lg-3 col-xlg-3 col-md-3">
<div class="card cr_full">
<div class="card-body">

<div class="card_img">
<img src="{{ asset('frontend/images/5.jpg') }}">

</div>
<div class="card_txt">
<h1>Jeff Walsh</h1>
<span>Ceo</span>
<p> orem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa</p>
</div>

<div class="icon-sec">
<a class=""><i class="fa fa-facebook"></i></a>
<a class=""><i class="fa fa-google-plus"></i></a>
<a class=""><i class="fa fa-facebook"></i></a>
<a class=""><i class="fa fa-linkedin"></i></a>
</div>
</div>
</div>

</div>

<div class="col-lg-3 col-xlg-3 col-md-3">
<div class="card cr_full">
<div class="card-body">

<div class="card_img">
<img src="{{ asset('frontend/images/5.jpg') }}">

</div>
<div class="card_txt">
<h1>Jeff Walsh</h1>
<span>Ceo</span>
<p> orem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa</p>
</div>

<div class="icon-sec">
<a class=""><i class="fa fa-facebook"></i></a>
<a class=""><i class="fa fa-google-plus"></i></a>
<a class=""><i class="fa fa-facebook"></i></a>
<a class=""><i class="fa fa-linkedin"></i></a>
</div>
</div>
</div>

</div>

<div class="col-lg-3 col-xlg-3 col-md-3">
<div class="card cr_full">
<div class="card-body">

<div class="card_img">
<img src="{{ asset('frontend/images/5.jpg') }}">

</div>
<div class="card_txt">
<h1>Jeff Walsh</h1>
<span>Ceo</span>
<p> orem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa</p>
</div>

<div class="icon-sec">
<a class=""><i class="fa fa-facebook"></i></a>
<a class=""><i class="fa fa-google-plus"></i></a>
<a class=""><i class="fa fa-facebook"></i></a>
<a class=""><i class="fa fa-linkedin"></i></a>
</div>
</div>
</div>

</div>

<div class="col-lg-3 col-xlg-3 col-md-3">
<div class="card cr_full">
<div class="card-body">

<div class="card_img">
<img src="{{ asset('frontend/images/5.jpg') }}">

</div>
<div class="card_txt">
<h1>Jeff Walsh</h1>
<span>Ceo</span>
<p> orem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa</p>
</div>

<div class="icon-sec">
<a class=""><i class="fa fa-facebook"></i></a>
<a class=""><i class="fa fa-google-plus"></i></a>
<a class=""><i class="fa fa-facebook"></i></a>
<a class=""><i class="fa fa-linkedin"></i></a>
</div>
</div>
</div>

</div>

<div class="col-lg-3 col-xlg-3 col-md-3">
<div class="card cr_full">
<div class="card-body">

<div class="card_img">
<img src="{{ asset('frontend/images/5.jpg') }}">

</div>
<div class="card_txt">
<h1>Jeff Walsh</h1>
<span>Ceo</span>
<p> orem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa</p>
</div>

<div class="icon-sec">
<a class=""><i class="fa fa-facebook"></i></a>
<a class=""><i class="fa fa-google-plus"></i></a>
<a class=""><i class="fa fa-facebook"></i></a>
<a class=""><i class="fa fa-linkedin"></i></a>
</div>
</div>
</div>

</div>

<div class="col-lg-3 col-xlg-3 col-md-3">
<div class="card cr_full">
<div class="card-body">

<div class="card_img">
<img src="{{ asset('frontend/images/5.jpg') }}">

</div>
<div class="card_txt">
<h1>Jeff Walsh</h1>
<span>Ceo</span>
<p> orem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa</p>
</div>

<div class="icon-sec">
<a class=""><i class="fa fa-facebook"></i></a>
<a class=""><i class="fa fa-google-plus"></i></a>
<a class=""><i class="fa fa-facebook"></i></a>
<a class=""><i class="fa fa-linkedin"></i></a>
</div>
</div>
</div>

</div>

<div class="col-lg-3 col-xlg-3 col-md-3">
<div class="card cr_full">
<div class="card-body">

<div class="card_img">
<img src="{{ asset('frontend/images/5.jpg') }}">

</div>
<div class="card_txt">
<h1>Jeff Walsh</h1>
<span>Ceo</span>
<p> orem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa</p>
</div>

<div class="icon-sec">
<a class=""><i class="fa fa-facebook"></i></a>
<a class=""><i class="fa fa-google-plus"></i></a>
<a class=""><i class="fa fa-facebook"></i></a>
<a class=""><i class="fa fa-linkedin"></i></a>
</div>
</div>
</div>

</div>

<div class="col-lg-3 col-xlg-3 col-md-3">
<div class="card cr_full">
<div class="card-body">

<div class="card_img">
<img src="{{ asset('frontend/images/5.jpg') }}">

</div>
<div class="card_txt">
<h1>Jeff Walsh</h1>
<span>Ceo</span>
<p> orem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa</p>
</div>

<div class="icon-sec">
<a class=""><i class="fa fa-facebook"></i></a>
<a class=""><i class="fa fa-google-plus"></i></a>
<a class=""><i class="fa fa-facebook"></i></a>
<a class=""><i class="fa fa-linkedin"></i></a>
</div>
</div>
</div>

</div>

</div>

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