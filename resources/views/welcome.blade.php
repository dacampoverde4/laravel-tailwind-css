@extends('v7.frontend')
<style>
img.gallery-show {
    height: 300px;
    width: 100% !important;
    border: none;
    margin: 0;
}

span.discover-btn {
    color: #46c6b3;
}

span.discover-btn2 {
    color: #f29b37;
}

h2.section-title.white {
    color: #ffffff;
    margin-bottom: 3rem;
}

p.section-subtitle.white {
    color: #ffffff;
    margin-top: 3rem;
}
@media only screen and (min-width: 768px) and (max-width: 991px){
    img.gallery-show {
        height: 250px !important;
    }
}
@media only screen and (max-width: 450px){
    .owl-carousel .owl-item img {
        width: 100%!important;
        margin: 0 10%;
        height: 100px !important;
    }
    .owl-item.active{
        margin-right: 10px !important;
    }
}
</style>


<!-- For pop up video play -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
    .bs-example{
        margin: 20px;
    }
    .modal-content iframe{
        margin: 0 auto;
        display: block;
    }
    .sus_msg
    {
        position: absolute;
        margin-top: -90px;
        background-color: #ffffff00;
        z-index: 99;
        display: table !important;
        width: 100%;
    }
    .sus_text
    {
        padding: 6px !important;
    }
    a.gl_btn img {
    padding-right: 10px!important;
}
</style>



@section('content')

  <!--begin home section -->
    <section class="home-section" id="home_wrapper">
        <div class="container">
            <div class="col-md-12">
                <div class="sus_msg">
                    @if (session('warning'))
                    <div class="alert alert-warning sus_text">
                    {!! session('warning') !!}
                    <a href="javascript:void(0)" class="close announcementmessages" data-dismiss="alert"
                        aria-label="close">&times;</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
		<div class="home-section-overlay"></div>

		<!--begin container -->
		<div class="container">

	        <!--begin row -->
	        <div class="row">

	            <!--begin col-md-12-->
	            <div class="col-md-12 ">

	          		<h1>Ready To Join The Adoption <br> Revolution In Second Life?</h1>

	          		<p>Be noticed for who you are, not what you look like. Seriously!<br>
					Ditch the panels and the lag; you deserve better! Why not <br>join the best? <span class="discover-btn2"><b>Avdopt.com</b></span> - We are the <span class="discover-btn2">"<b>A"</b></span> in <span class="discover-btn2"><b>Adoption</b></span></p>

	        		<a class="popup4 btn-blue" href="{{route('register')}}">REGISTER</a>

	        		<a href="{{route('about')}}" class="btn-white">LEARN MORE</a>

	          </div>
	          <!--end col-md-12-->

	        </div>
	        <!--end row -->

		</div>
		<!--end container -->

    </section>
    <!--end home section -->

    <section class="section-grey" id="about">

        <!--begin container-->
        <div class="container">

            <!--begin row-->
            <div class="row">

                <!--begin col-md-6-->
                <div class="col-md-6">

                    <div class="youtube-video-wrapper">

                        <!--begin popup-gallery-->
                        <div class="popup-gallery">

                            <!-- <a class="popup4 youtube-video-icon" href="https://www.youtube.com/watch?v=FPfQMVf4vwQ"> -->
                                <!-- ================================================================ -->

                                <div class="bs-example">
    <!-- Button HTML (to Trigger Modal) -->
    <a href="#myModal" class=" btn btn-lg btn-primary" data-toggle="modal"><i class="fa fa-play"></i></a>

    <!-- Modal HTML -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <b>AvDopt Commercial</b>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <iframe src="https://player.vimeo.com/video/449482439" width="555" height="321" class="frame-border wow bounceIn" data-wow-delay="1s"></iframe>
</div>
            </div>
        </div>
    </div>
</div>
                                <!-- ================================================================ -->

                        </div>
                        <!--end popup-gallery-->

                    </div>

                </div>
                <!--end col-sm-6-->

                <!--begin col-md-6-->
                <div class="col-md-6">

                	<h3>WE ARE THE <span class="discover-btn">"A"</span> IN ADOPTION</h3>

                	<p>On Avdopt, you're more than just a photo on a prim. You have stories to tell, and things to talk about that are more interesting than lag. Get noticed for who you are, not what you look like. Ditch the panels and the lag; you deserve better!<br><br>

AvDopt is the future of adoption in Second Life! We conveniently avatars to match based on their criteria. Experience quality, convenience, and security at its' finest. Join the revolution of SL adoption and find your right match today!</p>

                    <!--<ul class="features-list-dark">-->

                    <!--    <li><i class="fa fa-check lyla"></i> Netsum est, qui ipsum quiaim netsum sequi net tempor.</li>-->

                    <!--    <li><i class="fa fa-check lyla"></i> Etiam tempor ante acu ipsum finibus, atimus urnas.</li>-->

                    <!--    <li><i class="fa fa-check lyla"></i> Atimus urnas netsudat, qui ipsum quiaim netsum.</li>-->

                    <!--    <li><i class="fa fa-check lyla"></i> Etiam tempor ante acum ipsum et finibus.</li>-->

                    <!--</ul>-->

                    <a href="{{route('about')}}" class="btn btn-lg btn-blue center_mob_btn">Who We Are</a>

                </div>
                <!--end col-md-6-->

            </div>
            <!--end row-->

        </div>
        <!--end container-->

    </section>
    <!--end section-grey-->


<section class="section-gradient" id="gallery">

		<!--begin container -->
		<div class="container-fluid	">

			<!--begin row -->
			<div class="row">

				<!--begin col-md-12 -->
				<div class="col-md-12 text-center">

					<h2 class="section-title white">Recently Active Members </h2>

					<!--<p class="section-subtitle white">There are many variations of passages of Lorem Ipsum available, but the majority<br>have suffered alteration, by injected humour, or new randomised words.</p>-->
						<div class="row">

						<div class="gallery-item-wrapper padding-top-30">

					<!--begin owl carousel -->
						<div id="owl2" class="owl-carousel owl-theme  slider_u">
                        @foreach($recentusers as $singleuser)
                        @if ($singleuser->role_id != 1)
                            <a href="{{route('viewprofile', base64_encode( $singleuser->id ))}}">
                                <img src="{{ asset('/uploads/'.$singleuser->profile_pic)}}" alt="showcase" class="gallery-show">
                                    </a>
                                
                        @endif	 
						@endforeach
                    </div>
                    
					<!--end owl carousel -->

					<!--begin owl-dots -->
					<div class="owl-dots">

						<div class="owl-dot active"><span></span></div>

						<div class="owl-dot"><span></span></div>

						<div class="owl-dot"><span></span></div>

					</div>
					<!--end owl-dots -->

				</div>



                        <!--<div class="col-md-2">-->


                        <!--<img src="" alt="showcase" class="gallery-show">-->



                        <!--</div>-->
                        <!--<div class="col-md-2">-->

                        <!--<img src="" alt="showcase" class="gallery-show">-->



                        <!--</div>-->
                        <!--<div class="col-md-2">-->

                        <!--<img src="" alt="showcase" class="gallery-show">-->



                        <!--</div>-->
                        <!--<div class="col-md-2">-->

                        <!--<img src="" alt="showcase" class="gallery-show">-->



                        <!--</div>-->
					</div>
						<p class="section-subtitle white">Discover even more members by browsing Avdopt today!</p>
						<a href="{{route('browse')}}" class="btn-white btn_mob_sz">Browse</a>
				</div>
				<!--end col-md-12 -->

				<!--begin col-md-12 -->

			</div>
			<!--end row -->

		</div>
		<!--end container -->





	</section>










    <!--begin blog -->
    <section class="section-grey" id="blog">

        <!--begin container-->
        <div class="container">

            <!--begin row-->
            <div class="row margin-bottom-50">

                <!--begin col-md-12-->
                <div class="col-md-10 col-md-offset-1 text-center">
                    <h2 class="section-title">Latest Events</h2>

                    <div class="separator_wrapper">
                        <i class="icon icon-star-two blue"></i>
                    </div>


                </div>
                <!--end col-md-12-->

            </div>
            <!--end row-->

            <!--begin row-->
            <div class="row">

       @foreach($latesevents as $events)
       @php

                      $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $events->date);
                      $day = date('D', strtotime($to));
                      $dayNumceric = date('d', strtotime($to));
                      $month = date('M', strtotime($to));
                      $time = date('h:i A', strtotime($events->date));
                    @endphp
                <!--begin col-sm-4 -->
                <div class="col-sm-4">

                    <!--begin blog-item -->
                    <div class="blog-item">

                        <!--begin popup image -->
                        <div class="popup-wrapper">
                            <div class="popup-gallery">
                                <a href="{{ route( 'event.single', $events->id ) }}">
                                <img src="{{ asset('/images/'.(!empty($events->image)? 'events/'.$events->image: 'default.png'))}}" class="width-100" style="height: 200px;" alt="pic"><span class="eye-wrapper2"><i class="icon icon-link eye-icon"></i></span></a>
                            </div>
                        </div>
                        <!--begin popup image -->

                        <!--begin blog-item_inner -->
                        <div class="blog-item-inner">

                            <h3 class="blog-title"><a href="{{ route( 'event.single', $events->id ) }}">{{$events->title}}</a></h3>

                            <a href="{{ route( 'event.single', $events->id ) }}" class="blog-icons"><i class="icon icon-user"></i> {{ $day }}, {{ $month }} {{ $dayNumceric }}</a>



                            <p>{!!substr($events->content, 0, 100)!!}</p>

                            <a href="{{ route( 'event.single', $events->id ) }}" class="btn btn-lg btn-blue small">Read More!</a>

                        </div>
                        <!--end blog-item-inner -->

                    </div>
                    <!--end blog-item -->

                </div>
                <!--end col-sm-4-->
               @endforeach


            </div>
            <!--end row-->

        </div>
        <!--end container-->

    </section>
    <!--end blog -->

  		<!--begin contact -->
    <section class="section-dark sec-dark-mob" id="contact">

        <!--begin container-->
        <div class="container">

            <!--begin row-->
            <div class="row">

                <!--begin col-md-10 -->
				<div class="col-md-10 col-md-offset-1 text-center margin-bottom-30">

					<h2 class="section-title grey">Visit Avdopt In-world</h2>

					<p class="section-subtitle grey">Our main office (in-world) is open to the public 24/7. Wether you need to register at our main<br> office or simply exploure the many beauties of the Avdopt Sim, an adventure awaits you...</p>
					<a href="https://maps.secondlife.com/secondlife/AvDopt/184/123/37" " target="_blank" class="btn btn-lg btn-blue">Visit Avdopt</a>

				</div>
				<!--end col-md-10 -->

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

    <!--                <p>Copyright © 2017 - 2020 adoption All rights reserved. </p>-->

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
    <!--                        <a href="#">-->
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
<style type="text/css">
    /*.owl-carousel .owl-item img{
        width: 300px !important;
        height: 300px !important;
        display: table !important;
    }*/
    /*@media only screen and (min-width: 2200px){
        .owl-carousel .owl-item {
            width: 2% !important;
            margin-right: 10px !important;
        }
    }
    @media only screen and (mmax-width: 2199px){
        .owl-carousel .owl-item {
            width: 3% !important;
            margin-right: 10px !important;
        }
    }*/

</style>

<script type="text/javascript">

$(document).ready(function(){
    //var slideIndex = 0;
// showSlides();

// function showSlides() {
//   var i;
//   var slides = document.getElementsByClassName("slider_ur");
//   var dots = document.getElementsByClassName("dot");
//   for (i = 0; i < slides.length; i++) {
//     slides[i].style.display = "none";  
//   }
//   slideIndex++;
//   if (slideIndex > slides.length) {slideIndex = 1}    
//   for (i = 0; i < dots.length; i++) {
//     dots[i].className = dots[i].className.replace(" active", "");
//   }
//   slides[slideIndex-1].style.display = "block";  
//   dots[slideIndex-1].className += " active";
//   setTimeout(showSlides, 2000); // Change image every 2 seconds
// }

    /* Get iframe src attribute value i.e. YouTube video url
    and store it in a variable */
    var url = $("#cartoonVideo").attr('src');

    /* Assign empty url value to the iframe src attribute when
    modal hide, which stop the video playing */
    $("#myModal").on('hide.bs.modal', function(){
        $("#cartoonVideo").attr('src', '');
    });

    /* Assign the initially stored url back to the iframe src
    attribute when modal is displayed again */
    $("#myModal").on('show.bs.modal', function(){
        $("#cartoonVideo").attr('src', url);
    });

    $("#owl2").owlCarousel({
      dots: true,
      loop: true,
      margin: 20,
      autoplay:true,
      autoplayTimeout:5000,
      autoplayHoverPause:false,
      responsive: {
        0: {
          dotsEach: 2,
          items: 3
        },
        450: {
          dotsEach: 2,
          items: 3
        },
        700: {
          dotsEach: 2,
          items: 3
        },
        1200: {
          dotsEach: 5,
          items: 4
        },
        1800: {
          dotsEach: 5,
          items: 5
        },
        2200: {
          dotsEach: 5,
          items: 6
        },
        2500: {
          dotsEach: 5,
          items: 8
        }
      }
    });
    
});


</script>
