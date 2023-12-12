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
        <div class="event_heading text-center padding40">
        <div class="container">
            <h1>Find Your next experience</h1>
            <form action="" method="GET">
              @csrf
              <div class="col-md-4 col-sm-4 padding0 mtop30">
                  <select name="category" class="searchdropdown eventcat form-control">
                    @foreach($categories as $category)
                      <option @if(isset($_GET['category'])) @if($category->id == $_GET['category'] ) selected @endif @endif value="{{ $category->id }}">{{ $category->term_name }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="col-md-3 col-sm-3 padding0 mtop30">
                  <input type="text" name="location" value="@if(isset($_GET['location'])) {{@$_GET['location']}}@endif" placeholder="Kingston, Jamaica">
              </div>
              <div class="col-md-3 col-sm-3 padding0 mtop30">
                  @php
                    $months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');
                  @endphp
                  <select name="dates" class="searchdropdown eventcat form-control">
                    <option value="-1">All Dates</option>
                    @foreach($months as $key=>$month)
                      <option @if(isset($_GET['dates'])) @if($key == $_GET['dates'] ) selected @endif @endif value="{{ $key }}">{{ $month }}</option>
                    @endforeach
                  </select>
              </div>
              <div class="col-md-2 col-sm-2 padding0 mtop30">
                  <button type="submit">Search</button>
              </div>
          </form>
        </div>
        </div>
        @php
          //dd($events);
        @endphp
        <div class="Experience padding80">
            <div class="container">
                <div class="row">
                 @if (count($events) > 0)
                  @foreach($events as $event)
                    @php
                      $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->date);
                      $day = date('D', strtotime($to));
                      $dayNumceric = date('d', strtotime($to)); 
                      $month = date('M', strtotime($to)); 
                      $time = date('h:i A', strtotime($event->date));
                    @endphp
                    <div class="col-md-3 col-sm-4">
                      <div class="events">
                        <div class="time">
                            <div class="col-md-6 col-sm-6 pull-right">
                                <h5> {{ $day }}, {{ $month }} {{ $dayNumceric }} </h5> 
                                <h5>{{ $time }}</h5>
                            </div>
                         </div>   
                        <div class="Experience_profile_pic"></div>
                        <div class="event_info">
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
                            </ul>
                        </div>    
                        <hr>
                        <div class="col-md-6 col-sm-6">
                             <a href="{{ route( 'event.single', $event->id ) }}" class="">View More</a>
                        </div>
                        <div class="col-md-6 col-sm-6">
                             <span class="save_event {{in_array(Auth::user()->id,$event->saved_event_user_ids)?'saved':''}}" data-event-id="{{$event->id}}"><img src="{{ URL::asset('frontend/images/img7.png') }}" /></span>
                        </div>
                      </div>   
                    </div>
                  @endforeach
                @else
                  <h3 class="text-center">No Results Found</h3>
                @endif
            </div>
            </div>
        </div>   

        <!-- End profile Edit Section -->


@endsection
@section('scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    var csrf_token ='{{ csrf_token() }}';
</script>
<script src="{{ asset('frontend/js/events.js') }}" type="text/javascript" language="JavaScript"></script>
<script>

    $(document).ready(function() {
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