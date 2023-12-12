@extends('v7.frontend')
@section('page_level_styles')
    <style>
        .save_event {
            cursor: pointer;
        }

        .save_event.saved {
            background-color: green;
        }

        p.days_ref {
            color: #fff;
            font-size: 12px;
        }

        p.hours_ref {
            color: #fff;
            font-size: 12px;
        }

        p.minutes_ref {
            color: #fff;
            font-size: 12px;
        }

        p.seconds_ref {
            color: #fff;
            font-size: 12px;
        }

        .album-thumb {
            position: absolute;
            left: 0;
            top: 0px;
            width: 231px !important;
            height: auto;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .img_sec {
            height: 220px;
        }

        div#bs-example-navbar-collapse-1 {
            float: none !important;
        }

    </style>

    <link href="http://fonts.googleapis.com/css?family=Lato:400,900,700,400italic,300,700italic" rel="stylesheet"
          type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,700' rel='stylesheet'
          type='text/css'>

    <link rel="stylesheet" type="text/css" href="{{ asset('frontendevents/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendevents/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendevents/assets/css/flexslider.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendevents/assets/css/owl.carousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendevents/assets/css/animations.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendevents/assets/css/dl-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendevents/assets/css/jquery.datetimepicker.css')}}">
    <link rel="stylesheet" href="{{ asset('frontendevents/assets/css/main.css')}}">
    <script src="{{ asset('frontendevents/assets/js/modernizr-2.6.2-respond-1.1.0.min.js')}}"></script>

    <!--<script src="{{ asset('frontendevents/assets/js/ajaxify.min.js')}}"></script>-->
    <script src="{{ asset('frontendevents/assets/js/jquery.downCount.js')}}"></script>
    <script src="{{ asset('frontendevents/assets/js/jquery.datetimepicker.full.min.js')}}"></script>
    <script src="{{ asset('frontendevents/assets/js/jquery.bxslider.min.js')}}"></script>
    <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&#038;sensor=false&#038;ver=3.0'></script>
    <script src="{{ asset('frontendevents/assets/js/jplayer/jquery.jplayer.min.js')}}"></script>
    <script src="{{ asset('frontendevents/assets/js/jplayer/jplayer.playlist.min.js')}}"></script>
    <script src="{{ asset('frontendevents/assets/js/jquery.flexslider-min.js')}}"></script>
    <script src="{{ asset('frontendevents/assets/js/jquery.stellar.min.js')}}"></script>
    <script src="{{ asset('frontendevents/assets/js/jquery.sticky.js')}}"></script>
    <script src="{{ asset('frontendevents/assets/js/jquery.waitforimages.js')}}"></script>
    <script src="{{ asset('frontendevents/assets/js/masonry.pkgd.min.js')}}"></script>
    <script src="{{ asset('frontendevents/assets/js/packery.pkgd.min.js')}}"></script>
    <script src="{{ asset('frontendevents/assets/js/tweetie.min.js')}}"></script>
    <script src="{{ asset('frontendevents/assets/js/owl.carousel.min.js')}}"></script>


@stop
@section('content')
    <!-- Start Events Section -->

    <div id="ajaxArea">

        <!--=================================
        Albums Section
        =================================-->

        <section class="album-header">
            <figure class="album-cover-wrap">
                <div class="album-cover_overlay"></div>
                <img class="album-cover"
                     src="{{ $event->cover_pic?asset('/images/events/'.$event->cover_pic ):asset('frontendnew/images/banner-img.jpg')}}"
                     alt=""
                     data-stellar-ratio="0.5">
            </figure>
            <div class="container">
                @if ($event)
                    @php

                        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->date);
                        $day = date('D', strtotime($to));
                        $dayNumceric = date('d', strtotime($to));
                        $month = date('M', strtotime($to));
                        $time = date('h:i A', strtotime($event->date));
                       // $cDate = \Carbon\Carbon::parse($event->date);

                       $today      = new DateTime('now');
                       $event_date   = new DateTime($event->date);
                       $difference = $today->diff($event_date);
                       $d = $difference->format('%d');
                       $h = $difference->format('%h');
                       $m = $difference->format('%i');
                       $s = $difference->format('%s');

                    @endphp

                    <div class="cover-content">

                        <a href="{{route('events')}}" class="btn btn-default text-bold btn-lg text-uppercase "><i
                                    class="icon-angle-circled-left"></i> Back to Events</a>
                        <hr>
                        <div class="clearfix text-uppercase album_overview">
                            <figure class="album-thumb">
                                @if(!empty($event->image))
                                    <img class="img_sec" src="{{ asset('/images/events/'.$event->image)}}">
                                @else
                                    <img class="img_sec" src="{{ asset('frontendevents/assets/demo-data/a1.jpg')}}"
                                         alt="">
                                @endif

                            </figure>
                            @if(Auth::check())
                                @php $data= Auth::user()->savedEvents()->where('event_id',$event->id)->get(); @endphp

                                @if(!empty($data[0]))
                                    <a class="btn  btn-success btn-transparent-2 save_event saved mt-20"
                                       id="save-events" data-event-id="{{$event->id}}">Saved</a>
                                @else
                                    <a class="btn  btn-success btn-transparent-2 save_event mt-20" id="save-events"
                                       data-event-id="{{$event->id}}">Save Event</a>
                                @endif
                            @else
                                <div class="mt-20">
                                    &nbsp;
                                </div>
                            @endif
                            @php $date_flag=true; @endphp
                            @if($event->date < now())
                                @php $date_flag=false; @endphp
                            @endif
                            @if($date_flag == true)
                            <ul class="countdown clearfix mt-20">
                                
                                <li>
                                    <div class="text">
                                        <span class="days">00</span>
                                        <p class="days_ref">days</p>
                                    </div>
                                </li>

                                <li>
                                    <div class="text">
                                        <span class="hours">00</span>
                                        <p class="hours_ref">hours</p>
                                    </div>
                                </li>

                                <li>
                                    <div class="text">
                                        <span class="minutes">00</span>
                                        <p class="minutes_ref">minutes</p>
                                    </div>
                                </li>

                                <li>
                                    <div class="text">
                                        <span class="seconds">00</span>
                                        <p class="seconds_ref">seconds</p>
                                    </div>
                                </li>
                            </ul>
                            @else
                            <ul><li>
                                    <div class="text">
                                        <p class="seconds_ref">Event Ended</p>
                                    </div>
                                </li></ul>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </section>
        <section class="mt-40 mb-30 event_follow_row">

            <div class="container">
                <div class="row">
                    @if ($event)
                        @php
                            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->date);
                            $day = date('D', strtotime($to));
                            $dayNumceric = date('d', strtotime($to));
                            $month = date('M', strtotime($to));
                            $time = date('h:i A', strtotime($event->date));
                        @endphp
                        <div class="col-md-3">
                            <div class="singleEventDetails table-responsive mt-20">
                                <h3><span class="fa fa-info-circle"></span>Event Info</h3>
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        @if($date_flag)
                                            <td class="style">Event Date</td>
                                            <td>{{ $day }}, {{ $month }} {{ $dayNumceric }}</td>
                                        @else
                                            <td class="style">Event Ended</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if($date_flag)
                                            <td class="style">Time</td>
                                            <td>{{$time}} SLT</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="style">Grand Prize</td>
                                        <td>L${{$event->price}}</td>
                                    </tr>
                                    <tr>
                                        <td class="style">Venue</td>
                                        <td>   @if($event->location_url)
                                                <a target="_blank" class="btn btn-sm btn-success"
                                                   href="{{$event->location_url }}">Visit Location</a>
                                            @else
                                                N/A
                                            @endif</td>
                                    </tr>


                                    {{--
                                    @php
                                      $buyCheck =checkEventButOrNot($event->id);
                                    @endphp
                                    @if(isset($buyCheck) || $event->price == 0 || $event->price == '')
                                      <tr></tr><td><a class="btn btn-danger btnred" href="{{ @$event->location_url }}">See Event</a></td></tr>
                                      @else
                                      @php
                                      $price = $event->price * 100;
                                    @endphp
                                    <!--<li>
                                     <form action="{{ route('event.buy', $event->id) }}" method="POST">
                                      @csrf
                                        <input name="amount" type="hidden" value="{{ $price }}">
                                        <script
                                          src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                          data-key="{{ env('STRIPE_KEY') }}"
                                          data-amount="{{ $price }}"
                                          data-name="{{ @$event->title }}"
                                          data-description="{{ @$event->title }}"
                                          data-image="http://laravel.avdopt.com/backend/images/logo.jpg"
                                          data-locale="auto">
                                        </script>
                                      </form>
                                    </li>-->
                                    @endif
                                    --}}
                                    <!--<tr>-->
                                    <!--    <td class="style">Duration</td>-->
                                    <!--    <td>3 h</td>-->
                                    <!--  </tr>-->
                                    </tbody>
                                </table>
                            </div>
                            <!--<div id="google-map1" class="xv-gmap event-map" data-theme="green" data-address="kansas city" data-zoomlvl="13" data-maptype="HYBRID"></div>-->
                        </div>
                        <div class="col-md-6">
                            <article class="articleSingle">
                                <h2>Description</h2>

                                <p> {!! $event->content !!}</p>

                            </article>
                        </div>
                        <div class="col-md-3">
                            <div class="singlevtads text-center">                            
                                <div class="adsimgsec ads_240_400_size ptb10">
                                    <img src="{{ url('/images/240x400.jpg')}}" class="">
                                </div>
                            </div>   
                        </div>
                    @endif
                </div>
            </div>

        </section>

        <!--=================================
        Similar Albums
        =================================-->

    </div>

    <!-- End profile Edit Section -->


@endsection
@section('scripts')
    <script>
        var csrf_token = '{{ csrf_token() }}';

        //timer code
        function makeTimer() {
            var edate = "<?php echo $to?>";
            var endTime = new Date(edate);
            endTime = (Date.parse(endTime) / 1000);

            var now = new Date();
            now = (Date.parse(now) / 1000);

            var timeLeft = endTime - now;

            var days = Math.floor(timeLeft / 86400);
            var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
            var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
            var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

            if (days < 0) return false;
            if (hours < "10") {
                hours = "0" + hours;
            }
            if (minutes < "10") {
                minutes = "0" + minutes;
            }
            if (seconds < "10") {
                seconds = "0" + seconds;
            }

            $(".days").html(days);
            $(".hours").html(hours);
            $(".minutes").html(minutes);
            $(".seconds").html(seconds);

        }

        setInterval(function () {
            makeTimer();
        }, 1000);
        onload(makeTimer());
    </script>
    <script src="{{ asset('js/notify.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('frontend/js/events.js') }}" type="text/javascript" language="JavaScript"></script>
    <script src="{{ asset('frontendevents/assets/js/main.js')}}"></script>
    <style>

        .events {
            min-height: 300px;
            display: table;
        }

        button.stripe-button-el, button.stripe-button-el span {
            background: #eb3939;
            border: none;
            box-shadow: none;
            width: 100px;
        }
        .event__follow_row{
          margin-top:100px;
        }
    </style>
@endsection