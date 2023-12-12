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
a.gl_btn img {
    padding-right: 10px!important;
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
				<div class="col-md-6 about-pg-iframe">
                     <iframe src="https://player.vimeo.com/video/449482439" width="555" height="321" class="frame-border wow bounceIn" data-wow-delay="1s"></iframe>

				</div>
				<!--end col-md-6 -->

	        </div>
	        <!--end row -->

		</div>
		<!--end container -->

    </section>
    <!--end home section -->

    	<!--begin section-grey -->
    <section class="aboutpagesection-grey" id="aboutpageabout">

        <!--begin container-->
        <div class="container">

            <!--begin row -->
			<div class="row">

				<!--begin col-md-6 -->
				<div class="col-md-6">

					<img src="http://laravel.avdopt.com/frontend/images/usergroup/about1.png" alt="img" class="width-100 wow fadeInUp" data-wow-delay="0.04s">

				</div>
				<!--end col-md-6 -->


                <!--begin col-md-6-->
                <div class="col-md-6">

                	<h3><span class="discover-btn3">"AVDOPT"</span> IS GOOD + BETTER + <span class="discover-btn3">BEST</span></h3>

                	<p><b>Avdopt</b> is the first service within Second Life adoption industry to use a scientific approach to matching highly compatible avatars.
 Our user-friendly platform facilitates a Compatibility Matching System which matches Toddlers, Children, Teens, Adults, and Elders based on 12 Dimensions of Compatibility for lasting and fulfilling adoptions.<br><br>

Traditional in-world adoption agencies can be challenging for those seeking adoptions that last - but <b>Avdopt</b> is not a conventional adoption agency. <br><br>

Of all the matches you may find at the other adoption agencies, very few will be compatible with you individually. It's a challenge to determine the level of compatibility of a potential match through methods of browsing adoption panels and reading meaningless notecards. <br><br>

On <b>Avdopt</b>, you're more than just a photo on a prim. You have stories to tell, and things to talk about that are more interesting than lag. Get noticed for who you are, not what you look like. Ditch the panels and the lag; you deserve better!<br><br>

<b>Avdopt</b> is the future of adoption in Second Life! We conveniently allow avatars to match based on their criteria. Experience quality, convenience, and security at its' finest. Join the revolution of Second Life adoption and find your right match today!

</p>


                </div>
                <!--end col-md-6-->

            </div>
            <!--end row-->

        </div>
        <!--end container-->

    </section>
    <!--end section-grey-->

    	<!--begin team section -->
  	<section class="section-white" id="team">

	    <!--begin container-->
        <div class="container">

            <!--begin row-->
            <div class="row">

				<!--begin col-md-12 -->
				<div class="col-md-12 text-center">

					<h2 class="section-title">Meet The <span class="discover-btn3">A</span> Team</h2>

					<p class="section-subtitle">Meet the inovative, dedicated, and energetic team behind the adoption revolotion in Second Life!</p>

				</div>
				<!--end col-md-12 -->

                <!--begin team-item -->
                <div class="col-sm-6 col-md-4">

	                <div class="team-item">

	                    <img src="/frontend/images/usergroup/mikekeymonday.jpg" class="team-img" alt="Mikekey">

	                    <h3>MIKEKEY MONDAY</h3>

	                    <div class="team-info"><p>CEO & Founder</p></div>

	                    <p>AvDopt is a project that excites our CEO & Founder, Mikekey Monday, beyond normalcy. He saw the need, created the concept, and established the AvDopt platform. </p>

	                    <ul class="team-icon">

	                        <li><a href="http://www.facebook.com/mikekeymonday" class="facebook"><i class="fa fa-facebook"></i></a></li>
	                        <li><a href="http://www.instagram.com/mikekeymondaysl" class="pinterest"><i class="fa fa-instagram"></i></a></li>
	                        <li><a href="#" class="dribble"><i class="fa fa-dribbble"></i></a></li>


	                    </ul>

                	</div>

                </div>
                <!--end team-item -->

                <!--begin team-item -->
                <div class="col-sm-6 col-md-4">

	                <div class="team-item">

	                    <img src="/frontend/images/usergroup/destiny.jpg" class="team-img" alt="pic">

	                    <h3>Destiny Mandrake</h3>

	                    <div class="team-info"><p>Executive Director</p></div>

	                    <p>Angelic Mandrake calculates the right moves and executes strategies very well when it comes to snagging the right opportunities and spearheading AvDopt's direction.</p>

	                    <ul class="team-icon">

	                        
	                        <li><a href="#" class="dribble"><i class="fa fa-dribbble"></i></a></li>

	                    </ul>

	                </div>

                </div>
                <!--end team-item -->

                <!--begin team-item -->
                <div class="col-sm-6 col-md-4">

	                <div class="team-item">

	                    <img src="/frontend/images/usergroup/fumopic.jpg" class="team-img" alt="pic">

	                    <h3>Fumo Ruffo</h3>

	                    <div class="team-info"><p>Marketing Specialist</p></div>

	                    <p>With a rich background in sales, digital marketing, and advertising, Fumo Ruffo delivers materials to reach customers through various communication methods.</p>

	                    <ul class="team-icon">

	                    

	                        <li><a href="#" class="dribble"><i class="fa fa-dribbble"></i></a></li>

	                    </ul>

	                </div>

                </div>
                <!--end team-item -->

						<a href="/team" class="btn btn-lg btn-blue small about">Browse</a>
            </div>
            <!--end row-->

        </div>
        <!--end container-->

  	</section>
  	<!--end team section -->

    	<!--begin section-gradient -->
	<section class="section-gradient padding-top-50 no-padding-bottom">

		<!--begin container -->
		<div class="container	">

			<!--begin row -->
			<div class="row">

				<!--begin col-md-6 -->
				<div class="col-md-6">

					<img src="/frontend/images/usergroup/advertise.png" alt="img" class="width-100 wow fadeInUp" data-wow-delay="0.25s">

				</div>
				<!--end col-md-6 -->

				<!--begin col-md-6 -->
				<div class="col-md-6">

					<h2 class="section-title white padding-top-20">Ready To Promote Your Business?</h2>

					<p class="section-subtitle white">Avdopt provides the essential tools to create and launch your next digital marketing campaign. Choose between impressions or paid-per-click advertising methods. Advertise with AvDopt, and drive traffic to your business, raise brand awareness, and increase your sales.</p>

                    <ul class="features-list-hero">

                        <li class="wow fadeIn" data-wow-delay="0.5s">
                            <i class="pe-7s-plane"></i>
                            Increase your visibility to consumers by advertising to a targeted audience that shops both online and In-World.
                        </li>

                        <li class="wow fadeIn" data-wow-delay="0.75s">
                            <i class="pe-7s-tools hi-icon"></i>
                            Please take advantage of our essential tools and experience the benefits of a successful marketing campaign.
                        </li>

                        <li class="wow fadeIn" data-wow-delay="1s">
                            <i class="pe-7s-umbrella hi-icon"></i>
                            It doesn't just look great; advertising with us works too. We offer opportunities to our clients regardless of the size business.
                        </li>

                        <li class="wow fadeIn" data-wow-delay="1.25s">
                            <i class="pe-7s-like hi-icon"></i>
                            AvDopt connects Second Life Avatars with great adoption opportunities. Win the hearts and minds of our diverse members!

                        </li>

                    </ul>

				</div>
				<!--end col-md-6 -->

			</div>
			<!--end row -->

		</div>
		<!--end container -->

	</section>
    <!--end section-gradient -->



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
