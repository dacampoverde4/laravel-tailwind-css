@extends('layouts.frontend')
@section('page_level_styles')
    <style>
        .save_event{
            cursor: pointer;
        }
        .save_event.saved{
            background-color:green;
        }
    </style>
@stop
@section('content')
 <!-- Start Events Section -->

        <div class="Experience padding80">
            <div class="container"> 
              @if (session('message'))
                  <div class="alert alert-success">
                      {{ session('message') }}
                  </div>
              @endif
                <div class="row">
                 @if ($event)
                    @php
                      $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->date);
                      $day = date('D', strtotime($to));
                      $dayNumceric = date('d', strtotime($to)); 
                      $month = date('M', strtotime($to)); 
                      $time = date('h:i A', strtotime($event->date));
                    @endphp
                    <div class="col-md-3 col-sm-4" style="width: 100%;">
                      <div class="events">
                        <div class="time">
                            <div class="col-md-6 col-sm-6 pull-right">
                                <h5> {{ $day }}, {{ $month }} {{ $dayNumceric }} </h5> 
                                <h5>{{ $time }}</h5>
                            </div>
                         </div>   
                        <div class="Experience_profile_pic"></div>
                        <div class="event_info col-sm-4">
                            <h4 class="mtop70">{{ @$event->title }}</h4>
                            <ul>
                                <li><img src="{{ URL::asset('frontend/images/football.png') }}" alt="" title="">Sports & Fitness</li>
                                <li>
                                    @if($event->location_url)
                                        <img src="{{ URL::asset('frontend/images/location.png') }}" /><a target="_blank" class="btn btn-sm btn-success" href="{{$event->location_url }}">Visit Location</a>
                                    @else
                                        <img src="{{ URL::asset('frontend/images/location.png') }}" />N/A
                                    @endif
                                </li>

                                {{--
                                @php
                                  $buyCheck =checkEventButOrNot($event->id);
                                @endphp
                                @if(isset($buyCheck) || $event->price == 0 || $event->price == '')
                                  <li><a class="btn btn-danger btnred" href="{{ @$event->location_url }}">See Event</a></li>
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
                            </ul>
                        </div>  
                        <div class="col-sm-8">
                          {!! $event->content !!}
                        </div>  
                        <hr>
                        <div class="col-md-6 col-sm-6 pull-right">
                             <span class="save_event {{in_array(Auth::user()->id,$event->saved_event_user_ids)?'saved':''}}"  data-event-id="{{$event->id}}" ><img src="{{ URL::asset('frontend/images/img7.png') }}" /></span>
                        </div>
                      </div>   
                    </div>
                @endif
            </div>
            </div>
        </div>   

        <!-- End profile Edit Section -->


@endsection
@section('scripts')
<script>
    var csrf_token ='{{ csrf_token() }}';
</script>
<script src="{{ asset('frontend/js/events.js') }}" type="text/javascript" language="JavaScript"></script>
<script>
jQuery('button.stripe-button-el span').text('Buy Now');
  </script>
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
</style>
@endsection