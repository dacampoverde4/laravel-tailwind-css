@extends('v7.frontend')
@section('page_level_styles')

    <!--<link href="http://fonts.googleapis.com/css?family=Lato:400,900,700,400italic,300,700italic" rel="stylesheet" type="text/css">-->
    <!--<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,700' rel='stylesheet' type='text/css'>    -->

    <!--<link rel="stylesheet" type="text/css" href="{{ asset('frontendevents/assets/css/bootstrap.min.css')}}">-->
    <!--<link rel="stylesheet" type="text/css" href="{{ asset('frontendevents/assets/css/font-awesome.min.css')}}">-->
    <!--<link rel="stylesheet" type="text/css" href="{{ asset('frontendevents/assets/css/flexslider.css')}}">-->
    <!--<link rel="stylesheet" type="text/css" href="{{ asset('frontendevents/assets/css/owl.carousel.css')}}">-->
    <!--<link rel="stylesheet" type="text/css" href="{{ asset('frontendevents/assets/css/animations.css')}}">-->
    <!--<link rel="stylesheet" type="text/css" href="{{ asset('frontendevents/assets/css/dl-menu.css')}}">-->
    <!--<link rel="stylesheet" type="text/css" href="{{ asset('frontendevents/assets/css/jquery.datetimepicker.css')}}">-->
    <!-- <link rel="stylesheet" href="{{ asset('frontendevents/assets/css/main.css')}}"> -->
    <link rel="stylesheet" href="{{ asset('frontendevents/assets/css/event-main.css')}}">
<style type="text/css">
    .event-caption-content p {
        font-size: 12px
    }.event-caption-content .days .hours .minutes .seconds {
        font-size: 15px
    }
    /*.save_event {
        cursor: pointer;
    }
    .save_event.saved {
        background-color: green;
    }*/
    a.gl_btn img {
    padding-right: 10px!important;
}
.event-ban img{
    width: 730px;
    height: 90px;
}
</style>
@stop
@section('content')
    <!-- Start Events Section -->
    <div class="majorWrap eventpg">

        <div class="majorWrap">
        @if($featured_events->count()>0)
            <div class="event-slider">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                  <!-- Indicators -->
                  <ol class="carousel-indicators">
                    @foreach($featured_events as $key=>$featured_event)
                        <li data-target="#myCarousel" data-slide-to="{{$key}}" class="{{$key==0?'active':''}}"></li>
                    @endforeach
                  </ol>

                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">
                  @foreach($featured_events as $key=>$featured_event)
                    <div class="item {{$key==0?'active':''}}">
                    @if(empty($featured_event->cover_pic))
                        <img class="event-carousel-img" src="https://images.pexels.com/photos/3064258/pexels-photo-3064258.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="Los ">
                    @else
                        <img class="event-carousel-img" src="{{ asset('/images/events/'. $featured_event->cover_pic) }}" alt="{{ $featured_event->cover_pic }}">                     
                    @endif                         
                      <div class="event-carousel-caption">
                        <div class="event-c-picture">
                            @if(empty($featured_event->image))
                                <img src="{{asset('/images/default.png')}}" alt="">
                            @else
                                <img src="{{asset('/images/events/'.$featured_event->image)}}" alt="{{ $featured_event->image }}">
                            @endif
                        </div>
                        <div class="event-caption-content">
                            <h3>{{ $featured_event->title }}</h3>
                            @php
                                $content = strip_tags(htmlspecialchars_decode(\Illuminate\Support\Str::limit($featured_event->content, 200,'...')));
                            @endphp
                            <div class="post-content">{!!  $content !!}</div>
                            @php $date_flag=true; @endphp
                            @if($featured_event->date < now())
                                @php $date_flag=false; @endphp
                            @endif
                            @if($date_flag == true)
                            <ul class="countdown clearfix mt-20">
                                <li><span class="days{{$key}}">00</span><br> <p>Days</p></li>
                                <li><span class="hours{{$key}}">00</span><br> <p>Hours</p></li>
                                <li><span class="minutes{{$key}}">00</span><br> <p>Minutes</p></li>
                                <li><span class="seconds{{$key}}">00</span><br> <p>Seconds</p></li>
                            </ul>
                            @else
                            <ul>
                            <li><span class="seconds{{$key}}">Event Ended</span></li>
                            </ul>
                            @endif
                        </div>
                        <div class="view-location-button">
                            <div class="v-l-button">
                                <a href="{{ route( 'event.single', $featured_event->id ) }}" class="view">View</a>
                                <a target="blank" href="{{ !empty($featured_event->location_url)? $featured_event->location_url: '#' }}" class="location">Location</a>
                            </div>
                        </div>
                      </div>
                    </div>
                     <script>
                        //timer code
                        function makeTimer{{$key}}() {
                            var edate = "<?php echo \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $featured_event->date)?>";
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

                            $(".days{{$key}}").html(days);
                            $(".hours{{$key}}").html(hours);
                            $(".minutes{{$key}}").html(minutes);
                            $(".seconds{{$key}}").html(seconds);

                        }

                        setInterval(function () {
                            makeTimer{{$key}}();
                        }, 1000);
                        onload(makeTimer{{$key}}());
                    </script>
                @endforeach
                </div>
            </div>
@endif
            <!--=================================================
            events finder
            ==================================================-->

            <section class="events-finder" style="margin-top:1rem;">
                <div class="container">
                        <div class="col-md-12 banner event-ban">
                            <img src="http://laravel.avdopt.com/images/728x90.png" class="">
                        </div>
                    <header>
                        <div class="row">
                            <div class="col-xs-12 col-md-3">
                                <h2 class="text-uppercase">Latest Events.</h2>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <div class="event-form text-right">
                                    <form action="{{route('event.search')}}" method="GET">
                                        @csrf
                                        <div class="form-input search-keyword">
                                            <input type="text" placeholder="Search Keyword" name="search_keyword"
                                                   value="{{isset($_GET['search_keyword'])?$_GET['search_keyword']:''}}">
                                            <i class="icon fa fa-search"></i>
                                        </div>

                                        <div class="form-input select-location">
                                            <div class="custome-select">
                                                <b class="icon fa fa-calendar"></b>
                                                <span>Select a month</span>
                                                @php
                                                    $months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');
                                                @endphp
                                                <select name="dates" id="search-dropdown-box"
                                                        class="search-cate notranslate">
                                                    <option value="">All months</option>
                                                    @foreach($months as $key=>$month)
                                                        <option @if(isset($_GET['dates'])) @if($key == $_GET['dates'] ) selected
                                                                @endif @endif value="{{ $key }}">{{ $month }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-input select-location">
                                            <div class="custome-select">
                                                <b class="fa fa-bars"></b>
                                                <span>Select a Category</span>

                                                <select name="category" id="search-dropdown-box"
                                                        class="search-cate notranslate">
                                                    <option value="">All Category</option>
                                                    @foreach($categories as $category)
                                                        <option @if(isset($_GET['category'])) @if($category->id == $_GET['category'] ) selected
                                                                @endif @endif value="{{ $category->id }}">{{ $category->term_name }}</option>
                                                    @endforeach
                                                </select>
                                                <!--<select id="search-dropdown-box" class="search-cate notranslate">-->
                                                <!--   <option value="">Option1</option>                      -->
                                                <!--   <option value="">Option2</option>                      -->
                                                <!--   <option value="">Option3</option>                      -->
                                                <!--   <option value="">Option4</option>                      -->
                                                <!--   <option value="">Option5</option>                      -->
                                                <!--</select>-->
                                            </div>
                                        </div>
                                        <button class="btn btn-default" type="submit">find event</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </header>
                    <div class="featured-events">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="store-grid text-uppercase text-bold">
                                    @if (count($events) > 0)
                                        @foreach($events as $event)
                                            @php
                                                $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->date);
                                                $day = date('D', strtotime($to));
                                                $dayNumceric = date('d', strtotime($to));
                                                $month = date('M', strtotime($to));
                                                $time = date('h:i A', strtotime($event->date));
                                                $mytime = \Carbon\Carbon::now(); // today
                                                //echo $event->date;
                                               
                                            @endphp
                                            <div class="store-product event-product-box">
                                                <figure>

                                                    @if(!empty($event->image))
                                                        <img class="img_sec" width="265" height="265"
                                                             src="{{ asset('/images/events/'.$event->image)}}">
                                                    @else
                                                        <img class="img_sec" width="265" height="265"
                                                             src="{{ asset('frontendevents/assets/demo-data/a1.jpg')}}">
                                                    @endif
                                                    <figcaption>
                                                        <a href="{{ route( 'event.single', $event->id ) }}"
                                                           class="btn btn-grey"><i class="fa fa-ticket "></i> View</a>
                                                    </figcaption>
                                                </figure>
                                                @if(Auth::check())
                                                    @php $data= Auth::user()->savedEvents()->where('event_id',$event->id)->get(); @endphp

                                                    @if(!empty($data[0]))
                                                        <!-- <a class="btn  btn-success btn-transparent-2 save_event saved mt-20"
                                                           id="save-events" data-event-id="{{$event->id}}">Saved</a> -->
                                                           <a class="save_event saved" href="javascript:void(0)" id="save-events" data-event-id="{{$event->id}}" title="Unsave Event">
                                                               <img style="width:30px;" src="images/remove-bookmark.png" />
                                                           </a>
                                                    @else
                                                           <a class="save_event" href="javascript:void(0)" id="save-events" data-event-id="{{$event->id}}" title="Save Event"><img style="width:30px;" src="images/add-bookmark.png" /></a>
                                                    @endif
                                                @endif
                                                <div class="product-info">
                                                    <h3>{{ $event->title}}</h3>
                                                    @if($event->date > now())
                                                    <h6><i class="fa fa-clock-o"></i> {{ $day }}
                                                        , {{ $month }} {{ $dayNumceric }}</h6>
                                                    @else
                                                    <h6 style="color:red;"><i class="fa fa-clock-o"></i> {{ $day }}
                                                        , {{ $month }} {{ $dayNumceric }} &nbsp;&nbsp; ENDED</h6>
                                                    @endif
                                                <!-- <span class="price-tag">${{$event->price * 100}}</span> -->
                                                </div>

                                            </div>
                                        @endforeach
                                    @else
                                        <h3 class="text-center">No Results Found</h3>
                                    @endif
                                </div><!--album-grid-->

                            </div><!--column-->
                        </div>
                    </div>
                </div>
        </div>
        </section>
    </div>
    <!-- End profile Edit Section -->


@endsection
@section('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        var csrf_token = '{{ csrf_token() }}';
    </script>
    <script src="{{ asset('frontendevents/assets/js/modernizr-2.6.2-respond-1.1.0.min.js')}}"></script>
    <script src="{{ asset('js/notify.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('frontend/js/event-main.js') }}" type="text/javascript" language="JavaScript"></script>

<!--    <script src="{{ asset('frontendevents/assets/js/jquery.js')}}"></script>-->
<!--    <script src="{{ asset('frontendevents/assets/js/ajaxify.min.js')}}"></script>-->
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

    <script src="{{ asset('frontendevents/assets/js/main.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.searchdropdown').select2({
                placeholder: 'Search events or catagories',
            });
        });
    </script>
    <style>
        span.select2-container ul li, span.select2-container span {
            width: 100%;
        }

        .select2-container--default .select2-selection--single {
            height: 42px;
            border-radius: 0;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 37px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 41px;
        }
    </style>
@endsection