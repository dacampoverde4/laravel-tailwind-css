@extends('layouts.frontend')
@section('content')
<h2 class="mtopbottom60 text-center">ALL JOBS</h2>
<div class="browse_main mb80">
    <div class="container">
        @foreach($jobs as $job)
            <div class="row mb30"> 
              <div class="col-sm-3">
                  <h3 style="margin-top:0">{{ $job->title }}</h3>
                  @if($job->tag_title)
                     <i>Tags:</i>
                     @php
                        $getjobs = ( $job->tag_title )? json_decode( $job->tag_title ) : array();
                        echo "<span class='tag'>".implode('</span>,<span class="tag">', $getjobs)."</span>";
                     @endphp <br>
                 @endif
                 @if($job->company_name)<span><i>Company:</i>{{ $job->company_name }}</span><br> @endif
                 @if($job->salary)<span><i>Salary:</i> {{ $job->salary }}</span><br> @endif  
                 @if($job->location)<span><i>Location:</i>  <a target="_blank" class="btn btn-sm btn-primary" href="{{ $job->location }}">Visit Location</a></span><br>@endif
              </div>
              <div class="col-sm-6">
                 @if($job->description)<p>{{ $job->description }}</p> @endif
                  
                 
              </div>
              <div class="col-sm-3">
                  <a class="btn btn-danger btnred" href="{{ route('job.single', $job->id) }}">View More</a>
              </div>
            </div>
        @endforeach

    </div> 
</div>
@endsection