@extends('v7.frontend')
@php
    $featurecount = isset($featurecount)? $featurecount: 5;

    $featuredUsers = getSubscribedFeatureUsers($featurecount);
    $featuredPlans = getFeaturedPlans();
@endphp
@section('page_level_styles')
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/profile_front.css') }}"/> -->
@endsection
@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}"/>

<link rel="stylesheet" type="text/css" href="http://kenwheeler.github.io/slick/slick/slick-theme.css"/>
<script src="{{ asset('js/notify.min.js') }}" type="text/javascript"></script>
<link href="{{ URL::asset('new-assets/common/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />


@yield('head')
<!--<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}"-->
<style>
	{{-- REVIEW SECTION CSS STARTS HERE --}}
		.profile_info .avg__reviews ul li {
		    border-bottom: none;
		    color: #4f4e4e;
		    padding: 7px 0 7px 8px;
		    position: relative;
		    width: auto;
		}
        .paginate-box {
            justify-content: center;
            display: flex;
        }
        .right-section.profile_ad.reviewpage .paginate-box span {
            margin-top: 0;
            margin-left: 0;
        }
		.right-section.profile_ad.ad_sec.review_sec {
		    max-height: 500px;
		    overflow-y: auto;
		    overflow-x: hidden;
		}
		.review_sec .clntrate p span.bgredtag {
		    color: #fff;
		    font-size: 12px;
		    font-weight: 400;
		    margin-left: 10px;
		}
		.bgredtag{
		    border-radius: 13px;
		    color: #fff;
		    font-size: 10px;
		    padding: 2px 20px 2px 20px;
		    position: relative;
		    text-decoration: none;
		    text-transform: uppercase;
		    background: #EB3939 !important;
		    display: inline-block;
		}

		.bggreentag{
		    border-radius: 13px;
		    color: #fff !important;
		    font-size: 10px;
		    padding: 2px 20px 2px 20px;
		    position: relative;
		    text-decoration: none;
		    text-transform: uppercase;
		    background: #5cb85c !important;
		    display: inline-block;
		}
		.avg__reviews ul {
		    display: flex;
		    float: right;
		}
		.cmt .clrblue{
			color: #4287f5;
			padding: 0 ;
		}
		.mt-15 {
		    margin-top: 15px !important;
		}
		.rating-stars{
			margin-bottom: 20px;
		}

		/* Rating Star Widgets Style */
		.rating-stars ul {
		  list-style-type:none;
		  padding:0;
		  
		  -moz-user-select:none;
		  -webkit-user-select:none;
		}
		.rating-stars ul > li.star {
		  display:inline-block;
		  
		}

		/* Idle State of the stars */
		.rating-stars ul > li.star > i.fa {
		  font-size:2.2em; /* Change the size of the stars */
		  color:#ccc; /* Color on idle state */
		}

		/* Hover state of the stars */
		.rating-stars ul > li.star.hover > i.fa {
		  color:#FFCC36;
		}

		/* Selected state of the stars */
		.rating-stars ul > li.star.selected > i.fa {
		  color:#FF912C;
		}


		 .mt40px{
            margin-top:40px
        }
        .rvetitbtn{            
            padding: 20px;
        }
        .rivebtn button {
            background-color: #65b704;
            color: #000;
            font-weight: 700;
            padding: 0px 30px;
            height: 60px;
            display: inline-block;
            font-size: 18px;
            line-height: 60px;
            text-shadow: -2px -1px #fff;
            border-radius: 5px;
            outline: 0;
        }
        .clntrate ul, .rivefrm ul{
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .clntrate ul li  {
            display: inline-block;
        }
        .clntrate ul, .clntrate p {
            display: inline-block;
            margin: 0;
        }
        .clntrate li i {
            color: #f2bf42;
            padding: 0px 0px;
            font-size: 18px;
        }
        .clntrate .gry-bg i {
            color: #c1c1c1;
        }
        .rivttle h3 {
            font-size: 25px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .dtecmt {
            display: block !important;
        }
        .clntrate p span {

            color: #7a98cb;
            font-weight: 700;

        }
        .dtecmt h6 {
            display: inline-block;
        }
        .cmt h6 {
            margin: 0;
        }
        .cmt span {
            padding: 0px 23px;
        }
        .cmt button {

        background-color: #f7f8fa;
        border: 1px solid #c1c1c1;
        border-radius: 2px;
        margin: 0px 5px;
        padding: 2px 11px;
            cursor: pointer

        }
       .cmt .repbtn {
            background-color: transparent;
            border: 0;
            color: #678cc0;
            font-weight: bold;
        }
        .rivefrm {
            padding: 30px 40px;
        }
        .aplyrate h4 {
            font-size: 26px;
            text-transform: uppercase;
            font-weight: bold;
            color: #333;
            margin: 0;
            margin-bottom: 20px;
        }
        .aplyrate li a {
            font-size: 27px;
            color: #a2a1a1;
            margin: 0px 3px;
        }
        .aplyrate li {
            display: inline-block;
        }
        .aplyrate {
            padding-bottom: 30px;
        }
        .aplrvi input, .aplrvi textarea {
            width: 100%;
            border: 1px solid #c1c1c1;
            background-color: #fff;
            height: 40px;
            padding: 11px;
            color: #000;
            border-radius: 3px;
            margin-bottom: 19px;

        }
        .aplrvi textarea{
            height: 100px
        }
        .aplrvi button {

            background-color: #65b704;
            color: #fff;
            font-weight: 700;
            padding: 0px 19px;
            height: 40px;
            display: inline-block;
            font-size: 18px;
            line-height: 35px;
            border-radius: 5px;
            outline: 0;
            border: 1px solid #65b704;

        }
        .crsbtn .close {

	        position: absolute;
	        right: -20px;
	        top: -10px;
	        background-color: #535353;
	        opacity: 9;
	        color: #fff;
	        line-height: 0px;
	        width: 37px;
	        margin: 0;
	        border-radius: 50%;
	        font-size: 23px;
	        padding: 15px 0px 21px;

	    }
	    .crsbtn {

	        padding: 0 22px;
	        position: relative
	            border: 0;

	    }
	    li.yelw-bg a {
	      color: #f2bf42;
	  }

	{{-- REVIEW SECTION CSS ENDS HERE --}}


	p.datesec small {
    font-weight: 700;
    display: block;
}

    .divider
{
    position: relative;
    margin-top: 3px;
    height: 1px;
    margin-bottom: 10px;
}

.div-transparent:before
{
    content: "";
    position: absolute;
    top: 0;
    left: 5%;
    right: 5%;
    width: 90%;
    height: 1px;
    background-image: linear-gradient(to right, transparent, rgb(48,49,51), transparent);
}

img.feature_img {
    width: 100%;
    max-width: 100px !important;
    height: 104px;
}
h5.q_sec {
    text-align: center;
    padding: 50px 0px;
    color: #6d6d6d;
}
.right-section.profile_ad.photos img {
    width: 100%;
    max-width: 100%;
}
 button.feature_button {
    background: #fff;
    padding: 5px 15px;
    border: none;
    border: 2px solid #eaeaea;
    border-radius: 6px;
        margin-top: 8px;
}
i.stand {
    color: #da0505;
    top: 13px;
}
 .right-section.profile_ad.ad_sec {
    float: right;
    margin-bottom: 3rem;
}
.right-section.photo_upload{
    background: #fff;
    box-shadow: 0 0 5px #ccc;
    padding: 14px;
}

.qeat_sec {
    background: #fff;
    float: left;
    width: 100%;
    padding: 5px 15px;
}
.unlock-more-match-quest {
	margin: 10px 0 !important;
}
.my_fun_sec {
    margin-top: 2rem;
    float: left;
    width: 100%;
}
.right-section.profile_ad.ad_sec {
    float: right;
    margin: 3rem 0;
}
h3.font_family.bgred {
    margin-top: 15px;
}
h3.font_family {

    margin: 0;
}
.right-section.profile_ad span {
    margin-top: 16px;
    font-size: 14px;
    margin-left: 2px;
}
 .ban_sec {
    padding: 1px;
    margin-bottom: 14px;
    text-align: center;
}
.right-section.profile_ad img {
    width: 100%;
    max-width: 33px;
    padding-bottom: 10px;
}

.right-section.profile_ad h3 {
    display: inline-flex;
}
.ban_sec h2 {
    color: #fff;
}
.yellow {
    background-color: #f29d38;
}
.black {
    background-color: #000;
}
.blue {
    background: #3498db;
}
.red {

    background-color: #ca1111;
}
.col-md-12.about_sec {
    margin: 12px auto;
    padding: 0;
}
.nav > li > a:hover, .nav > li > a:focus {
    text-decoration: none;
    background-color: #3b5998;
    color: #fff;
    text-align: center;
}
.nav-tabs > li > a {
    margin-right: 2px;
    line-height: 1.42857143;
    border: 1px solid transparent;
    border-radius: 4px 4px 0 0;
    text-align: center;
    text-decoration: none;
    color: #000;
}
.nav-tabs {
    margin-bottom: 16px;
    background-color: #fff;
    border-bottom: none;
}
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    color: #fff;
    cursor: default;
    background-color: #3b5998;
    /* border: 1px solid #ddd; */
    /* border-bottom-color: transparent; */
}
ul.nav.nav-tabs.tab_sec li {
    width: 33%;
    margin-left: 1px;
    margin-right: 1px;
}
    .featuredmembers_img #exampleModal .modal-body {
    height: 650px;
    }
    .featuredmembers_img .modal-body {
    background: #fee56e;
    background: -moz-linear-gradient(top, #fee56e 0%, #f13a36 98%);
    background: -webkit-linear-gradient(top, #fee56e 0%,#f13a36 98%);
    background: linear-gradient(to bottom, #fee56e 0%,#f13a36 98%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fee56e', endColorstr='#f13a36',GradientType=0 );
    padding: 8px 15px 55px;
    }
    .padding0 {
    padding: 0;
    }
    .featuredmembers_img .modal-body p {
    color: #222;
    font-family: helvetica;
    font-size: 16px;
    line-height: 20px;
    padding: 19px 53px;
    text-align: center;
    }
    .featuredmembers_img .modal-header img {
    left: 8px;
    position: absolute;
    top: 6px;
    width: 46px;
    z-index: 1;
    }
    .featuredmembers_img .modal-title {
    background-color: #000;
    color: #fff;
    font-size: 28px;
    font-weight: bold;
    line-height: 1.42857;
    margin: 0;
    padding: 6px 0;
    text-align: center;
    text-transform: uppercase;
    }
    .scheme_box {
    background-color: #f2f2f2;
    display: block;
    margin: 0 auto;
    min-height: 518px;
    width: 80%;
    }
    .colorred {
    color: rgb(238,60,60) !important;
    }

    ul.myfun_list li {
    /* display: block; */
    display: inline-block;
    margin-bottom: 2rem;
    padding: 2px;
    }

    .start_chat, .show_message {
    display: inline-block;
    }
    .myfun_list li a span {
    background-color: #fff;
    border-radius: 50%;
    display: inline-block;
    height: 9px;
    left: 7px;
    position: absolute;
    top: 14px;
    width: 9px;
    box-shadow: 0px 1px 1px #000 inset;
    }
    .chat_span {
    background-color: #eee;
    border-bottom-left-radius: 4px;
    border-top-left-radius: 4px;
    box-shadow: 0 4px 0 0 #ccc;
    display: inline-block;
    margin: 0 0 0 3px;
    padding: 7px 0px 11px 17px;
    position: relative;
}
    ul.myfun_list {
    padding: 14px;
    background: #fff;
    }
    .chat_span::before {
    background-color: #eee;
    box-shadow: 0 4px 0 0 #ccc;
    content: "";
    height: 38px;
    right: -17px;
    position: absolute;
    top: 0;
    transform: skewX(-24deg);
    width: 29px;
    margin: 0px;
}

    .chat_span i {
    color: #2DB642;
    font-size: 18px;
    font-weight: normal;
    }
    .col-md-4.padding0.about_me {
    background: #fff;
    width: 395px;
    }
    .chat_note {
    background-color: #2db642;
    border: 0 none;
    border-radius: 4px;
    box-shadow: 0 4px 0 0 #218a2b;
    color: #fff;
    font-family: "Bubblegum Sans",cursive;
    font-size: 14px;
    padding: 10px 18px 12px 32px;
}

    .padding0 {
    padding: 0;
    }


    .addScroll{
      overflow-x: hidden;
      height: 130px;
      overflow-y: scroll;
    }

    .hstrytabscoll{
        max-height: 400px;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    .leave_note {
    background-color: #02b1e8;
    border: 0 none;
    border-radius: 4px;
    box-shadow: 0 3px 0 0 #078ba4;
    color: #fff;
    font-family: "Bubblegum Sans",cursive;
    font-size: 14px;
    margin-left: 0;
    padding: 8px 28px 12px 28px;
}
    .right-section.profile_ad {
    background: #fff;
    box-shadow: 0 0 5px #ccc;
    padding: 14px;

}
    .message_span {
    background-color: #eee;
    border-bottom-right-radius: 4px;
    border-top-right-radius: 4px;
    box-shadow: 0 4px 0 0 #ccc;
    display: inline-block;
    margin: 0 0 0 3px;
    padding: 11px 19px 8px 7px;
    position: relative;
    top: 4px;
}

    .message_span::before {
    background-color: #eee;
    box-shadow: 0 4px 0 0 #ccc;
    content: "";
    height: 39px;
    left: -18px;
    position: absolute;
    top: 0;
    transform: skewX(-24deg);
    width: 29px;
    margin-top: 0;
}

    .message_span i {
    color: #2D4760;
    font-size: 15px;
    font-weight: normal;
    }
    .left-section {
    display: inline-block;
    width: 100%;
    vertical-align: top;
    padding: 5px;
    background: #fff;
    margin-right: 18px;
}




    .mtopbottom80 {
        margin: 0px 0px;
        background: #f5f5f5;
        padding: 30px;
    }
    .hrt-sec {
    text-align: right;
    padding-right: 2rem;
    padding:1rem;
    }

    .profile-section i.fa.fa-heart-o.addtowishlist.show_error_if_found, .profile-section i.fa.addtowishlist.show_error_if_found.fa-heart.colorred {
    margin-left: 24px;
    margin-bottom: 0;
    }

    .hrt-sec i {
    color: #ff0404 !important;
    }

    i.fa.fa-heart-o, i.fa.fa-heart {
    margin-bottom: 10px;
    }

.trialDefaultText {
    font-size: 15px;
    color: #000;
    line-height: 22px;
    text-align: left;
}
.request-header img {
    height: 80px;
    width: 80px;
    border-radius: 50%;
}
.request-content {
    border: 1px solid #eee;
    border-radius: 4px;
    box-shadow: 0 0px 3px rgba(0,0,0,.5);
  margin-bottom: 15px;
}
.request-header,.request-body {
    border-bottom: 1px solid #eee;
    padding: 10px;
}
.request-footer{
  padding: 10px;
  text-align: center;
}

/****new*****/
.bnrp0 {
    padding: 0;
}
.bnrp0 h4 {
    background-color: #2b2b2b;
    color: #fff;
    text-align: center;
    padding: 16px 0px;
    font-size: 35px;
    font-weight: 400;
}
.middlecontent .requestActionButtons {
    float: inherit;
    display: flex;
    margin: 0px 0px;
}
.middlecontent .requestActionButtons a {
    margin: 0px 4px;
}
.usenamwe h4 {
    color: #1976d2;
    font-size: 15px;
    text-align: center;
    margin: 10px 0px;
    font-weight: 700;
}
.midleinfouser:after {
    content: '';
    position: absolute;
    width: 90%;
    height: 2px;
    background-color: #dadada;
    display: inline-block;
    top: 34%;
    left: 50%;
    transform: translate(-50%,-50%);
}
.midleinfouser {
    position: relative;
    width: 100%;
}
.midltxtlft span:after {
    content: '';
    height: 20px;
    width: 20px;
    background-color: #67d6f2;
    position: absolute;
    border-radius: 50%;
      top: -17px;;
    left: 50%;
    transform: translateX(-50%);
    z-index: 999;
  }
.midltxtrgt span:before {
  content: '';
      height: 20px;
      width: 20px;
      background-color: #67d6f2;
      position: absolute;
      border-radius: 50%;
          top: -17px;
      right: 42%;
      transform: translateX(-50%);
      z-index: 999;
}
.midleinfouser {
    position: relative;
    width: 70%;
    display: flex;
    justify-content: space-around;
    align-items: center;
}

.midltxtlft, .midltxtrgt {
    width: 50%;
    display: inline-block;
    text-align: center;
    position: relative;
}
.midleinfouser span {
    text-transform: capitalize;
    color: #333;
    font-weight: 800;
    font-size: 16px;
}
.arw:after {
    content: '';
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 4px 13px 4px 0;
    border-color: transparent #dadada transparent transparent;
    position: absolute;
    top: 34%;
    transform: translateY(-50%);
    left: 23px;
}
.arw:before {
    content: '';
    width: 0;
  height: 0;
  border-style: solid;
  border-width: 4px 0 4px 13px;
  border-color: transparent transparent transparent #dadada;
    position: absolute;
    top: 34%;
    transform: translateY(-50%);
    right: 23px;
}
.middlecontent .requestActionButtons a {
    margin: 0px 4px;
    text-transform: uppercase;
    padding: 7px 15px;
    line-height: 16px;
}
.col-md-2.leftSidebar li a {
    padding: 20px 38px !important;
    background-position: -3px 10px;
    background-size: 43px;
}
.bnrp0 h4 img {
    filter: invert(1);
}

.borderline {
    padding: 0px 20px;
     display: -webkit-box;
}
.request-body p {
    margin-bottom: 0px;
}


    .padding0 {
    padding: 0;
    }

    .request-content {
    border: 1px solid #eee;
    border-radius: 4px;
    box-shadow: 0 0px 3px rgba(0,0,0,.5);
    margin-bottom: 15px;
}

.request-content {
    border: 1px solid #eee;
    border-radius: 4px;
    box-shadow: 0 0px 3px rgba(0,0,0,.5);
}


    .slider-thumb {
    max-width: 90%;
    text-align: center;
    margin: auto;
    }

    .slider-thumb {
    text-align: center;
    }

    .slider-nav img {
    height: 120px;
    object-fit: cover;
    padding: 0 5px;
    width: 120px;
    }


    .profile_info {
    background: #fff none repeat scroll 0 0;
    box-shadow: 0 0 5px #ccc;
    }

    .right-section {
    display: inline-block;

    padding: 23px 20px 35px 30px;
    vertical-align: top;
    width: 100%;
}
.nav > li > a {
    position: relative;
    display: block;
    padding: 16px 15px;
}


    .like_btn, .match_btn {
    background: transparent none repeat scroll 0 0;
    border: 1px solid #eaeaea;
    border-radius: 4px;
    font-size: 21px;
    padding: 5px 25px;
    display: inline-flex;
    }

    .colorred {
    color: rgb(238,60,60) !important;
    }

    .like_btn, .match_btn {
    float: left;
    margin-left: 0rem;
    }

    .like_btn {
    color: #ee3c3c;
    }

    .like_btn i, .match_btn i {
    display: inline-block;
    font-size: 25px;
    padding-right: 8px;
    }

    .profile_info span.reportblock, .profile_info i {
    text-align: right;
    display: block;
    }
    i {
    cursor: pointer;
    position: relative;
    }

    .match_btn {
    color: #30a6cc;
    margin-left: 15px;
    /*cursor:default;*/
    }

     .match_btn i
     {
         cursor:default;
     }


    .profile_info span.reportblock {
    margin-top: 20px;
    }
    .col-md-12.pull-right {
    background: #fff;
    box-shadow: 0 0 5px #ccc;
    left: 20px;
    }
     .col-md-12.pull-right-his {
    background: #fff;
    box-shadow: 0 0 2px #ccc;

    }


    .reportblock {
    margin-top: 0 !important;
    }
    .reportblock {
    margin-top: 0 !important;
    }
    .profile_info a {
    text-decoration: underline;
    width: 100%;
    color: #727272;
    font-weight: 600;
    }

    ul {
    padding: 0;
    }

    ul, ol {
    list-style: none;
    list-style-image: none;
    margin: 0;
    padding: 0;
    color: #858585;
    font-size: 14px;
    line-height: 24px;
    margin-bottom: 20px;
    }

    .profile_info ul li {
    border-bottom: 1px solid #eee;
    color: #4f4e4e;
    padding: 7px 0;
    position: relative;
    width: 100%;
    }

    img {
    max-width: 100%;
    }

    .profile_info ul li span {
    vertical-align: middle;
    padding-left: 7px;
    }

    .font17 {
    font-size: 17px;
    }

    ul li {
    list-style-type: none;
    }

    ul li, ol li {
    font-size: 15px;
    line-height: 28px;
    }

    .profile_info ul li span {
    vertical-align: middle;
    padding-left: 7px;
    }



    .ad_box {
    background: #000 none repeat scroll 0 0;
    color: #fff;
    font-size: 30px;
    min-height: 100px;
    padding: 36px 18px;
    text-align: center;
    }


    .about_me h3 {
     margin: 16px 17px!important;
    margin-bottom: 0;
    width: 100%;
    display: inline-block;
    }
    .ad_box {
    color: #fff;
    font-size: 30px;
    text-align: center;
    }
    .myfun_list li a {
    border-radius: 13px;
    color: #fff;
    font-size: 10px;
    padding: 11px 11px 11px 18px;
    position: relative;
    text-decoration: none;
    text-transform: uppercase;
    }
    .bgred {
    background: #EB3939 !important;
    color: #fff;
    padding: 1rem;
    font-size: 19px;
    }
    .col-md-6.padding0.about_me {
    padding: 20px;
    background: #fff;
    }
    .profile-section {
    margin-bottom: 3rem;
    }
    .fl_sec {
    float: left;
    width: 100%;
    margin-top: 0;
}
    .t.start_chat {
    margin-top: 5px;
}
.left-section.lfts {
    padding-bottom: 0!important;
}

    .ad_box.down {
    color: #fff;
    font-size: 30px;
    text-align: center;
    padding: 188px 18px;
    }
    .featuredclass_6 h3 {
    background-color: #000;
    border-radius: 12px;
    color: #FFEE58;
    display: inline-block;
    font-size: 25px;
    margin: 0 auto;
    padding: 15px 10px 15px 10px;
    position: relative;
    text-align: center;
    }
    .profile_section .Featured_members h3 img {
    left: -12px;
    position: absolute;
    top: 9px;
    width: 15%;
    }
    .featuredmembers_img {
    color: #fff;
    display: inline-block;
    margin-top: -18px;
    padding: 58px 0px;
    background: #ee3c3c;
    background: -moz-linear-gradient(top, #f28e54 3%, #ee3c3c 73%);
    background: -webkit-linear-gradient(top, #f28e54 3%,#ee3c3c 73%);
    background: linear-gradient(to bottom, #f28e54 3%,#ee3c3c 73%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ee3c3c', endColorstr='#f28e54',GradientType=0 );
    }
    .featuredclass_6 .featuredmembers_img .vertical_align a {
    color: #fdee57;
    font-size: 14px;
    width: 100%;
    height: 0;
    }
    .featuredclass_6 .vertical_align button {
    background-color: #fdeb58;
    border: 0 none;
    border-radius: 50%;
    color: #000;
    font-weight: bold;
    height: 45px;
    text-align: center;
    width: 45px;
    }
    .col-md-12.col-sm-12.padding0.mtop80.Featured_members {
    margin-top: 5rem;
    }

    .Featured_members a {
    color: #0ec2eb;
    font-style: italic;
    font-weight: bold;
    font-size: 22px;
    margin-top:20px;
    }
    .Usergradientbg {
    background: rgba(0, 0, 0, 0) linear-gradient(to right, #d9d900 27%, #25c8ff 73%) repeat scroll 0 0;
    border-radius: 6px;
    bottom: 44%;
    color: #000;
    font-size: 15px;
    font-weight: bold;
    padding: 0px 4px;
    position: absolute;
    right: 33px;
    text-transform: uppercase;
    top: -4px;
    margin-top: 10px;
    height: 32px;
    }
    .profile_info ul li span {
    vertical-align: middle;
    padding-left: 7px;
    }
    .Usergradientbg > span {
    border: 1px solid #fff;
    border-radius: 4px;
    padding: 0 15px;
    }
    .right-section.profile_ad.left_2 {
    margin-top: 3rem;
}

    .right-section.profile_ad.left_2.photo {
    margin-top: 0rem !important;
}

.media.media-body {
    overflow: hidden !important;
    zoom: 1 !important;
    padding: 20px !important;
}


.left-section.the_left {
    padding: 7px;
    text-align: center;
    padding-bottom: 15px;
}

#modal_user_list_who_liked .modal_user_list_who_liked_loading,  #modal_user_match .modal_user_match_loading {
    width: 100px;
    margin: 0 auto;
    display: block;
    position: absolute;
    z-index: 1;
    right: 0;
    left: 0;
}
    #modal_user_list_who_liked .modal-body, #modal_user_match .modal-body{
            height: 300px;
            overflow-y: scroll;
    }
    .modal_user_list_who_liked_container .row {
        margin-top: 6px;
        padding-bottom: 6px;
    }
    .modal_user_list_who_liked_container .media-left{
        padding: 2px;
        /*border: 1px solid #e5e5e5;*/
        height:50px;
    }
    .modal_user_list_who_liked_container .media-body{
        padding-left: 10px;
    }

    .modal_user_list_who_liked_container .media-object {
        width: 80px;
        max-width: initial;
        background: #ffffff;
        object-fit: contain;
        height: 80px;
        border-radius: 50%;
        border: 1px solid #54505059;
        padding: 3px;
    }
    #modal_user_list_who_liked .modal_user_list_who_liked_row_separator {
        border-top: 1px solid #e5e5e5;
        border-bottom: 1px solid #ffffff;
        margin-top:2px;
        margin-bottom:2px;
        padding:0;
    }

    .custom-img {
            position: absolute;
            top: 60%;
            left: 15%;
            text-align: center;
            padding: 15px 6px;
            line-height: 2;
            font-size: 15px;
            font-weight: bold;
    }
    .alert-success p{
        color: #3c763d;
    }
    /*Review Page Css*/
    .right-section.profile_ad.reviewpage h3 span {
        margin-top: 16px;
        font-size: 22px;
        margin-left: 2px;
        font-weight: 500;
        text-transform: inherit;
        color: #3B5999;
    }
    .reviewpage .revsec button.repbtn {
        padding: 0;
    }
    .reviewpage .clntrate strong {
        font-weight: 600;
        color: #000;
        text-transform: capitalize;
        display: inline-block;
        margin-left: 0px;
        font-size: 20px;
    }
    .reviewpage .clntrate {
        display: flex;
        align-items: center;
        flex-flow: row-reverse;
        justify-content: space-between;
    }
    .right-section.profile_ad.reviewpage span {
        margin-top: 8px;
        font-size: 14px;
        margin-left: 2px;
    }
    .reviewpage .dtecmt p {
        margin-bottom: 6px;
    }
    .reviewpage .dtecmt .bgredtag {
        border-radius: 30px;
        padding: 2px 12px 2px 12px;
        margin-left: 10px !important;
    }
    .reviewpage .cmt .repbtn {
        background-color: #678cc0;
        border: 0;
        color: #fff;
        font-weight: bold;
        padding: 7px 12px !important;
        display: inline-block;
        font-weight: 500;
        text-transform: uppercase;
        margin: 0;
    }
    .reviewpage .divider {
        margin-top: 25px !important;
        height: 1px;
        margin-bottom: 15px;
        opacity: 0.2;
    }
    .right-section.profile_ad.ad_sec.review_sec.reviewpage {
        max-height: inherit;
    }
    .right-section.profile_ad.ad_sec.reviewpage {
        padding: 30px;
    }
    .reviewpage .cmt span {
        padding: 0px;
    }
    .reviewpage .cmt span.clrblue {
        margin-right: 8px;
    }
    .dtecmt span.bggreentag {
        margin-left: 10px !important;
        display: inline-block;
    }


    @media (min-width: 768px) {
        .modal_user_match_container .row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }
    }

    .modal_user_match_container .thumbnail img{
        width:150px;
        max-width:150px;
        background: #ffffff;
        object-fit: contain;
        height:150px;
    }

    .modal_user_match_container .thumbnail{
        width: 162px;
        padding: 2px;
        margin-left:auto;
        margin-right:auto;
        margin-bottom:5px;
    }

    .modal_user_match_container .img_cont{

        padding: 2px;
        border: 1px solid #e5e5e5;
        height:156px;

    }

    .modal_user_match_container .caption h5{

        margin-bottom: 8px;
        margin-top: 8px;

    }

    .modal_user_match_container .matches_with_h5{
        margin-bottom: 20px;
        margin-top: 20px;
    }

    .myfun_list.familyRolesList li {
        color: #2f362f;
        font-size: 16px;
        font-weight: 500;
        margin: 5px 0;
    }

.userpf_popup .modal-dialog {
    width: 60%;
}
.userpf_popup img[alt] {
    font-size: 12px;
}
.userpf_popup .modal-title img {
    left: 8px;
    position: absolute;
    top: 6px;
    width: 46px;
    z-index: 1;
}
.userpf_popup #exampleModalLabel {
    background-color: #000;
    color: #fff;
    font-size: 28px;
    font-weight: bold;
    line-height: 1.42857;
    margin: 0;
    padding: 6px 0;
    text-align: center;
    text-transform: uppercase;
}
.userpf_popup button.close {
    background-color: #fff;
    border: 0 none;
    border-radius: 50%;
    color: #95cafd;
    font-size: 34px;
    height: 32px;
    line-height: 0;
    margin-top: 0;
    opacity: 1;
    padding: 0;
    position: absolute;
    right: 30px;
    top: 10px;
    width: 32px;
}
.userpf_popup .close > span {
    display: block;
    font-size: 36px;
    height: 16px;
    margin-right: 1px;
    font-weight: 900;
}
.userpf_popup .modal-body {
    background: linear-gradient(to bottom, #fee56e 0%,#f13a36 98%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fee56e', endColorstr='#f13a36',GradientType=0 );
    padding: 8px 15px 55px;
}
.userpf_popup .modal-body p {
    color: #222;
    font-family: helvetica;
    font-size: 16px;
    line-height: 20px;
    padding: 10px 53px;
    text-align: center;
    margin: 0;
}
.userpf_popup .basic {
    min-height: 235px;
    background-color: #fff;
    border: 5px solid transparent;
    display: inline-block;
    margin: 16px 0 0;
    padding: 19px 14px;
    width: 100%;
}
.userpf_popup .basic:hover {
    border: 5px solid #f2f2f2;
    box-shadow: 0 0 18px #ccc;
    transition: all 0.2s ease 0s;
}
.userpf_popup .scheme_box .left, .right {
    display: inline-block;
    float: left;
    width: 50%;
}
.userpf_popup .fontclr {
    color: #EB3939 !important;
}
.userpf_popup  .scheme_box .basic .left .fontclr {
    font-size: 16px;
    font-weight: bold;
    text-transform: capitalize;
    margin: 0;
}
.userpf_popup  .scheme_box .right > h5 {
    color: #55cf00;
    float: right;
    font-family: Verdana;
    font-size: 14px;
    font-weight: bold;
    margin: 2px 0;
}
.userpf_popup .modal-body .basic p{
    color: #666;
    display: inline-block;
    font-family: delius;
    font-size: 12px;
    line-height: 15px;
    padding: 0;
    text-align: left;
    width: 100%;
}
.mtop20 {
    margin-top: 20px;
}
.basic button span{
    background-color: #55cf00;
    border: 0 none;
    border-radius: 4px;
    font-size: 14px;
    padding: 5px 22px;
    position: relative;
    z-index: 1;
    color: white;
}
.userpf_popup .basic button:hover::before {
    opacity: 1;
}
.userpf_popup .basic button::before {
    background-color: #ffffff;
    border: 7px solid #f2f2f2;
    border-radius: 50%;
    bottom: -33px;
    box-shadow: 0 0 15px #ccc inset;
    content: "";
    height: 100px;
    left: 0;
    margin: 0 auto;
    opacity: 0;
    position: absolute;
    right: 0;
    transition: all 0.6s ease 0s;
    width: 100px;
    z-index: 1;
}
.userpf_popup .basic button{
    background: none;
    border: none;
    position: relative;
    transition: all ease 0.6s;
}
.userpf_popup .basic button:focus {
    outline: none;
}
.feat_infop {
    clear: both;
    height: 110px;
    overflow: hidden;
}
.photos button.plus{
    background: #5cb85c !important;
    color: #fff !important;
    border: none !important;
    padding: 10px 30px;
    margin: 0 0 0px;
}
.photos button.plus:focus{
    border-color: #5cb85c !important;
}
@media only screen and (max-width: 767px)
{
    .userpf_popup .modal-dialog {
        width: 95% !important;
    }
    .userpf_popup .modal-title {
        font-size: 20px !important;
    }
    .userpf_popup .modal-body p {
        padding: 10px 10px;
    }
    .userpf_popup  .modal-body .scheme_box {
        width: 100%;
        min-height: auto;
        height: auto;
        padding: 0 0 15px;
    }
    .userpf_popup .close > span {
        font-size: 32px;
        margin-top: 16px;
        margin-right: 2px;
        text-align: center;
    }
    .userpf_popup .modal-header .close {
        right: 20px !important;
        top: 4px !important;
    }
}

@media only screen and (min-width: 768px){
    .upgrd_btn, .cncl_btn {
        bottom: 40px;
        position: absolute !important;
    }
}

@media only screen and (min-width: 991px) and (max-width: 1200px)
{
    .profile_section .left-section.mtopbottom20 .fl_sec .col-md-6.padding0
    {
        width: 100%;
    }
    .profile_section .left-section.mtopbottom20 .fl_sec .col-md-6.padding0:first-child
    {
        margin-bottom: 8px;
    }
}

@media only screen and (max-width: 991px){
    .feat_infop {
        clear: both;
        height: auto !important;
    }
}

.familyRoles-list small {
     float: left;
     width: 100%;
     margin-bottom: 10px;
}
.familyRoles-list {
	float: left;
	width: 100%;
	margin: 0px 0 0px;
	background: #fff;
	padding: 14px;
}
 .familyRoles-list > div {
     float: left;
     margin: 5px 8px 5px 0;
 }
 .familyRoles-list > div > a {
     padding: 4px 12px !important;
     font-size: 14px;
 }
 .familyRoles-list > div > a > i {
     margin-right: 5px;
 }
 .familyRoles-list > h3 {
     margin-bottom: 15px;
     margin-left: 15px;
 }
 .reqUserImg {
     height: 80px;
     width: 80px;
     border-radius: 50%;
     display: table;
     margin: 0 auto;
 }
 #trialRequest_alert {
   background: #d9534f;
 }
 .reqInfomsg > h4 {
   color: #fff;
   margin: 0;
 }
 .reqInfomsg > p {
   color: #fff;
   font-size: 16px;
   margin: 5px 0;
 }
 .reqInfomsg {
   padding: 8px;
 }
 #trialRequest_alert .close {
   color: #fff !important;
   opacity: 1;
   background: rgba(0,0,0,0.6);
   height: 25px;
   width: 25px;
   text-align: center;
   vertical-align: middle;
   line-height: 22px;
   border: ;
   border-radius: 50%;
 }
 #sendRequestBtn,#chatFreeBtn {
   font-size: 18px;
   padding: 6px 20px;
 }

 .featmembtn{
  margin: 0px auto 10px;
  display: table !important;
  text-align: center;
  font-style: normal !important;
  color: white !important;
}

 .btn_family_role
{
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;
    display: inline-block;
    padding: 6px 12px !important;
    margin-bottom: 0;
    border: 1px solid transparent;
    border-radius: 4px;
    text-align: center;
    white-space: nowrap;
}
.editProfile-btn {
    color: #fff !important;
    text-decoration: none !important;
}
.modal_user_match_container {
	display: table;
}
.matchesMessage {
	text-align: center;
	width: 100%;
}
.modal_user_match_container .caption h5 {
	margin-bottom: 8px;
	margin-top: 8px;
	font-size: 14px;
	text-align: center;
}
.matchesIcon {
	height: 85px;
	width: auto;
	display: table;
	margin: 0 auto;
}
.row.alert.alert-info span {
	margin-left: 5px;
}
.adsimgsec {
    text-align: center;
}
.ads_970_250 img {
    max-width: 100% !important;
    width: 100% !important;
    padding-bottom: 0 !important;
}
.mb15{
    margin-bottom: 15px;
}
.ptb10{
    padding: 10px 0;
}
#agree{
    margin:5px;
}

.modal .form-group p{
    padding: 10px;
}
.success{
    color:green;
}
.failure{
    color: red;
}
.adptnow{
    max-width: 500px;
}
.adptnow .modal-header{
    display: flex;
    align-items: center;
}
.adptnow .modal-header h4{
    font-size: 18px;
    color: #455a64;
}
.adptnow .modal-header button.close{
    margin-left: auto;
    opacity: 0.7;
}
.adptnow .modal-header button.close span{
    font-size: 24px;
    color: #000;
}
.adptnow .modal-body{
    padding: 20px 20px 25px;
}
.adptnow input[type="checkbox"]{
    width: 20px;
    height: 20px;
}
.adptnow .form-horizontal .form-group{
    margin: 0 0 20px;
}
.adptnow .terms p{
    padding: 5px 0 0;
    font-size: 17px;
    line-height: 24px;
    text-align: left;
}
.adptnow form{
    text-align: center;
}
.adptnow .btn-primary{
    padding: 7px 12px;
    background: #5c4ac7;
    border: 1px solid #5c4ac7;
    -webkit-box-shadow: 0 2px 2px 0 rgba(116, 96, 238, 0.14), 0 3px 1px -2px rgba(116, 96, 238, 0.2), 0 1px 5px 0 rgba(116, 96, 238, 0.12);
    box-shadow: 0 2px 2px 0 rgba(116, 96, 238, 0.14), 0 3px 1px -2px rgba(116, 96, 238, 0.2), 0 1px 5px 0 rgba(116, 96, 238, 0.12);
    -webkit-transition: 0.2s ease-in;
    -o-transition: 0.2s ease-in;
    transition: 0.2s ease-in;
}
.btnupgrd{
    margin: 5px;
}
.photos .modal-header h4.font22 {
    font-size: 22px;
    font-weight: 500;
}
.photos .modal-header {
    background-color: #f5f5f5;
}
.photos .modal-body p {
    color: black;
}
div#view_photos h4 {
    margin: 0;
}
.grid-item img {
    display: block;
    text-align: center;
    width: 100%;
}
a.deleteProduct {
    margin-bottom: 20px;
    position: relative;
    display: inline-block;
    text-align: left;
    margin: 0px auto;
    z-index: 9;
    background-color: #f0f0f0;
    padding-left: 5px;
}
a.setprofilecrop {
    float: right;
    display: inline-block;
    padding-right: 5px;
    color: green;
    font-size: 20px;
}
a.deleteProduct i {
    font-size: 20px;
    padding: 5px 0;
}
.grid-item {
    height: 130px;
    overflow: hidden;
    padding: 0px;
    position: relative;
    border: 1px solid #cfcfcf;
    margin: 12px 0;
    background-color: #f0f0f0;
}
.dropzone .dz-preview.dz-error .dz-error-message {
    display: none !important;
}
.btn-upload-profile {
    background-color: transparent !important;
    border: 1px solid #f2f2f2;
    color: white !important;
    margin: 5px 0;
    top: 0px;
    position: absolute;
    z-index: 99;
    left: 20px;
    padding: 8px 10px;
}
.usrimgs {
    height: 140px;
    border: 1px solid #f2f2f2;
    padding: 6px;
    margin: 5px 0;
}
.usrimgs img {
    max-width: 100% !important;
    height: 100px;
    object-fit: contain;
    display: block;
    text-align: center;
    margin: 0 auto;
}
.photoselectsec{
    display: none;
}
.photouploadsec{
    display: none;
}
.btn_select_photos {
    margin: 0 0 10px 0;
    border-radius: 0;
}
.btn_upload_new{
    margin: 0 0 10px 0;
    border-radius: 0;
}
.setprofilelink {
    clear: both;
    display: block;
    text-align: center;
}
.right_1 ul.nav.nav-tabs li {
	width: 33.33%;
	display: inline-block;
	border: 1px solid #eee;
}
.right_1 ul.nav.nav-tabs li a , .right_1 ul.nav.nav-tabs li.active a{
	padding: 8px;
	font-size: 14px;
	border-radius: 0px;
	border: none !important;
}
.right_1 ul.nav.nav-tabs {
	margin: 0;
}
.modal-dialog {
    width: 445px;
    margin: 30px auto;
}
.media{
    min-height: 110px;
}
</style>
@endsection
@section('content')
<div class="maincontent backend">
    <div class="content">
<!-- Start profile Section -->
        <div class="container">
            <div class="adsimgsec ads_728_90_size ptb10">
                <img src="{{ url('/images/728x90.png')}}" class="">
            </div>
        </div>
        <div class="profile_section mtopbottom80 userprofle_sec">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {!! session()->get('message') !!}
                </div>
            @endif
            @php
                $message = '';
                $subnotrequired = 0;
                if( Auth::user() ){
                    if( !isthisSubscribed() ){
                        $subnotrequired = 1;
                        $message = "You have subscribe first to take this feature";
                    }
                }else{
                    $message = "You have to sign in first";
                }

                $at_least_one_answer_found=0;
                
            @endphp
            @php
            $imgPath = public_path().'/uploads/'.$user->profile_pic;
            if (file_exists($imgPath)) {
                 $image = url('uploads').'/'.$user->profile_pic;
             }else {
                 $image = url('uploads').'/default.jpg';
             }
            @endphp
            <div class="container  alert-trail-bar" >

                <div class="container-fluid usr_prof_sec">
    
                    <div class="profile-section">
                        
                    <div class="row">
                      
        					{{-- REVIEW SECTION STARTS HERE --}}
         					<div class="right-section profile_ad ad_sec review_sec reviewpage">
                                {{-- REVIEW HEADER START--}}
                                <div class="row">
                                    <div class="col-md-9">
                                        <h3 class="font_family" >
                                            <span><b>REVIEWS</b></span>
                                        </h3>
                                    </div>    
                                    <div class="col-md-3">
                                    	@if(@$trailReq && (@$canSendAdoptionReview || @$canSendDissolveReview || @$canSendTrialReview))
        									@php
        										if(@$trailReq->getReviewsTrail && !@$trailReq->getReviewsAdoption){
        											$reviewType = 'adoption';
        										}elseif($canSendDissolveReview == 1){
        											$reviewType = 'dissolve';
        										}else{
        											$reviewType = 'trial';
        										}	
        									@endphp	
                                        	{{-- <script type="text/javascript">alert({{$canSendDissolveReview}})</script> --}}
                                        	<button class="feature_button" data-toggle="modal"  id="addReviweBtn" data-reviewtype= "{{@$reviewType}}" data-id="{{@$trailReq->id}}" data-target="#addReviewModal"><b>ADD REVIEW</b></button>
                                   		@endif
                                    </div>
                                </div>
                                {{-- REVIEW HEADER ENDS--}}

                                <hr class="hr">
    						
    						  {{-- REVIEW BODY STARTS --}}
                                <div class="review-body">
                                	@forelse(@$reviews as $review)
                                		<div class="revsec">
        				                    <div class="clntrive">
        				                      <div class="clntrate">
        				                         <ul>
        				                         	@for($i= 0; $i < $review->stars; $i++)
        												<li><i class="fa fa-star" aria-hidden="true"></i></li>
        				                         	@endfor
        				                         	@if($review->stars < 5)
        												@for($i= 0; $i < 5 - $review->stars ; $i++)
        													 <li class="gry-bg"><i class="fa fa-star-o" aria-hidden="true"></i></li>
        												@endfor
        				                         	@endif
        				                            
        				                          </ul>
        				                          <p><strong>{{$review->subject}}</strong></p>     				                          
        				                          
        				                        </div>
                                                <div class="dtecmt">
                                                    <p> By <span>{{$review->user->displayname}}</span> on {{date("M d, Y , h:ia",strtotime($review->created_at))}}<span class="{{($review->type == 'trial') ? 'bggreentag' : 'bgredtag' }}">{{$review->type}}</span></p> 
                                                  </div>
        				                        <div class="clntrive">
        				                          <p>{{$review->message}}</p>
        				                           <div class="cmt d-flex">

        												@if(!@$review->reviewComment)
        					                             	<span class="clrblue">Comment</span><span>Was this reviews helpful to you?</span>
        					                                <button onclick="comment({{$review->id}},1)">Yes</button>
        					                                <button onclick="comment({{$review->id}},0)"> No</button>
        				                                @endif
        				                                @if(!@$review->ReviewAbuse)
        				                                	<button onclick="report({{$review->id}})" class="repbtn"> Reports abuse</button>				 
        				                                @endif                        
        				                            </div>				                            
        				                        </div>
        				                        
        				                    
        				                    </div>
        				                </div>
        				                <div class="divider div-transparent mt-15"></div>
                                	@empty
                                	@endforelse

                                </div>

                                {{-- REVIEW BODY ENDS --}}

                                {{-- ADD REVIEW MODAL STARTS HERE --}}

                                <!-- The Modal -->
        						<div class="modal" id="addReviewModal">
        							<div class="modal-dialog">
        								<div class="modal-content">
        									<!-- Modal Header -->
        									<div class="modal-header crsbtn">
        										<button type="button" class="close" data-dismiss="modal">&times;</button>
        									</div>
        									<!-- Modal body -->
        									<div class="rivefrm">
            									<div class="aplyrate">
            									    <h4 class="modal-heading">Add review</h4>

            									    <div class="success-message"></div>
            									    <div class="bodyform">
            										    <div class='rating-stars'>
            											    <ul id='stars'>
            													<li class='star' title='Poor' data-value='1'>
            														<i class='fa fa-star fa-fw'></i>
            													</li>
            													<li class='star' title='Fair' data-value='2'>
            														<i class='fa fa-star fa-fw'></i>
            													</li>
            													<li class='star' title='Good' data-value='3'>
            														<i class='fa fa-star fa-fw'></i>
            													</li>
            														<li class='star' title='Excellent' data-value='4'>
            													<i class='fa fa-star fa-fw'></i>
            													</li>
            													<li class='star' title='WOW!!!' data-value='5'>
            														<i class='fa fa-star fa-fw'></i>
            													</li>
            											    </ul>
            										  	</div>
            										  	<form class="aplrvi">
            										    	<input type="text" name="subject" id="subject" placeholder="Subject" value="">
            										    	<input type="hidden" id = "stars_value" name="stars" value="">
            										    	<input type="hidden" id = "tid" name="tid" value="">
            										    	<input type="hidden" id = "reviewtype" name="type" value="">
            										    	<input type="hidden" id = "other_user_id" name="other_user_id" value="{{$user->id}}">
            										      	<textarea placeholder="Message" id = "message" name="message"></textarea>
            										      	<div class="errors-addReviewModal"></div>
            										      	<button id="review-submit">Submit</button>
            										  	</form>
            										</div>  	
            									</div>
        								    </div>
        							    </div>
        						    </div>   
                                </div>
                                {{-- ADD REVIEW MODAL ENDS HERE --}}
                                {{-- REVIEW SECTION ENDS HERE --}}
                                <div class="paginate-box">
                                        {{ $reviews->links() }}
                                    </div>
                            </div>




                        </div>
                    </div>
                </div>    
                   
            </div>
        </div>
    </div>
</div>
<!-- End profile Section -->

    @if(Auth::check())
        @include('profile.upgrade_match_quest_package')
    @endif
@endsection

@section('scripts')
<script src="{{ URL::asset('new-assets/common/js/common.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.js"></script>
<script src="{{ asset('backend/js/profile.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontendnew/js/gallery_slider.js') }}" type="text/javascript"></script>

<script src="{{ URL::asset('new-assets/common/plugins/croppie/croppie.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new-assets/common/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new-assets/common/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{ URL::asset('new-assets/frontend/js/upload_crop_image.js')}}" type="text/javascript"></script>
<script>
    var account_setup_profile_image_by_string_submit_url= "{{ route('profile.uploadprofile') }}";
    var account_setup_step_2_submit_url='{{url('/account-setup/profile-info')}}';
    var csrf_token ='{{ csrf_token() }}';
    var image_folder_url='{{ asset('/uploads') }}';
    var home_url='{{url('/home')}}';
</script>

<script type="text/javascript">


function comment(id,status){
	// var token = $(this).attr("data-token");
    $.ajax({
        url: "{{route('review.comment')}}",
        method: 'POST',
        dataType: "JSON",
        data: {
            "id": id,
            "status": status,
              "_token": '{{ csrf_token() }}'
        },
        success: function (result)
        {
            console.log("It works");
            // nowclass.remove();
            if(result.status == 200)
            {
                location.reload();
            }
        }
    });
}

function report(id){
    $.ajax({
        url: "{{route('review.abuse')}}",
        method: 'POST',
        dataType: "JSON",
        data: {
            "id": id,
            "_token": '{{ csrf_token() }}'
        },
        success: function (result)
        {
            console.log("It works");
            // nowclass.remove();
            if(result.status == 200)
            {
                location.reload();
            }
        }
    });
}

	


$(document).ready(function(){
$(".deleteProduct").click(function(){
    var nowclass = $(this).parents('.grid-item');
        var id = $(this).attr("data-id");
       
        $.ajax(
        {
            url: "{{url('userprofile/album/delete')}}/"+id,
            method: 'post',
            dataType: "JSON",
            data: {
                "id": id,
                "_token": '{{ csrf_token() }}'
            },
            success: function (result)
            {
                console.log("It works");
                nowclass.remove();
                if(result.status == true)
                {
                    location.reload();
                }
            }
        });

    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#avatarFile").change(function(){
        readURL(this);
    });
});

var $grid = $('.grid').isotope({
  itemSelector: '.grid-item',
  columnWidth: 160,
  gutter: 20,
  percentPosition: true,
  masonry: {
    columnWidth: '.grid-sizer'
  }
});
</script>

<script type="text/javascript">

	$('#addReviweBtn').click(function(){
		$('#tid').val($(this).data("id"));
		$('#reviewtype').val($(this).data("reviewtype"));
	});

    var url_auth_check='{{url("ajaxrequest/auth_check")}}';

   		 $(document).ready(function(){
  
			/* 1. Visualizing things on Hover - See next part for action on click */
			$('#stars li').on('mouseover', function(){
				var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

				// Now highlight all the stars that's not after the current hovered star
				$(this).parent().children('li.star').each(function(e){
					if (e < onStar) {
						$(this).addClass('hover');
					}
					else {
						$(this).removeClass('hover');
					}
				});

			}).on('mouseout', function(){
				$(this).parent().children('li.star').each(function(e){
					$(this).removeClass('hover');
				});
			});
			  
			  
			/* 2. Action to perform on click */
			$('#stars li').on('click', function(){
				var onStar = parseInt($(this).data('value'), 10); // The star currently selected
				var stars = $(this).parent().children('li.star');

				for (i = 0; i < stars.length; i++) {
					$(stars[i]).removeClass('selected');
				}

				for (i = 0; i < onStar; i++) {
					$(stars[i]).addClass('selected');
				}

				// JUST RESPONSE (Not needed)
				var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
				

				if (ratingValue >= 1) {
					$('#stars_value').val(ratingValue);
				}
				responseMessage(msg);
			    
			});


			// SUBMIT REVIEW BUTTON

			$("button#review-submit").click(function(e){
		        e.preventDefault();
		      
	            $.ajax({
	                method: "POST",
	                url: "{{route('reviews.store')}}",
	                data: {
	                    other_user_id  : $("#other_user_id").val(),
	                    stars: $("#stars_value").val(),
	                   	subject: $("#subject").val(),
	                   	message: $("#message").val(),
	                   	type: $("#reviewtype").val(),
	                   	tid: $("#tid").val(),
	                    _token: "{{csrf_token()}}"
	                },
	            })
		        .done(function( data ) {

		                // console.log(data);
		                if(data.status == 200){
		                	$("#addReviewModal .errors-addReviewModal ").empty();
		                	$("#addReviewModal .bodyform ").empty();
		                    $("#addReviewModal .success-message").html("<h5 class='success'><i class='fa fa-check'> </i> "+data.message+"</h5>");
		                    setInterval(function(){$('#addReviewModal').modal('toggle'); $('#addReviewModal').remove();  location.reload();  }, 6000);

		                    //
		                }else if(data.status == 400){

		                    $("#addReviewModal  .failure").remove();
		                     $("#addReviewModal ..errors-addReviewModal ").append("<p class='failure'> "+data.message+"</p>");
		                    $("#addReviewModal .modal-footer").empty();
		                }else{
		                    $("#addReviewModal ..errors-addReviewModal").html("<h5 class='failure'><i class='fa fa-check'> </i> "+data.message+"</h5>");
		                    $("#addReviewModal .modal-footer").empty();
		                }
		             
		        }).fail( function(xhr, textStatus, errorThrown){

		        		if(xhr.responseJSON.errors){
		        			var errors  = xhr.responseJSON.errors;
		        			$("#addReviewModal .errors-addReviewModal ").empty();
		        			for(var key in errors){

							 	$("#addReviewModal .errors-addReviewModal ").append("<p class='failure'> "+errors[key]+"</p>")
							}
		        		}
				    });

		    });



		});


		function responseMessage(msg) {
		  $('.success-box').fadeIn(200);  
		  $('.success-box div.text-message').html("<span>" + msg + "</span>");
		}




$(document).ready(function(){
  $(".nav-tabs a").click(function(){
    $(this).tab('show');
  });

});
</script>

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

@endsection
