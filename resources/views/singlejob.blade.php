@extends('layouts.frontend')
@section('content')
<h2 class="mtopbottom60 text-center">{{ $job->title }}</h2>
<div class="single_job_main">
    <div class="container">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <p>{{ $job->description }}</p>
        <table class="table">
        <tr><th>Location <i class="fa fa-map-marker" aria-hidden="true"></i> : </th><td><a target="_blank" class="btn btn-sm btn-primary" href="{{ $job->location }}"> Visit Location </a></td></tr>
        <tr><th>Company Name <i class="fa fa-building" aria-hidden="true"></i> : </th><td>{{ $job->company_name }}</td></tr>
        <tr><th>Job Type <i class="fa fa-briefcase" aria-hidden="true"></i> : </th><td>{{ $job->job_type }}</td></tr>
        <tr><th>Salary <i class="fa fa-money" aria-hidden="true"></i> : </th><td>{{ $job->salary }}</td></tr>
        <tr><th>Salary Type <i class="fa fa-money" aria-hidden="true"></i> : </th><td>{{ ucfirst($job->salary_type) }}</td></tr>
        @php
            if($job->tag_title){
            echo '<tr><th>Tags <i class="fa fa-tag" aria-hidden="true"></i> </th><td>'; 
                echo '<ul class="tags">';
                    $tags = json_decode($job->tag_title);
                    foreach($tags as $tag){
                        echo '<li>'.$tag.'</li>';
                    }
                echo '</ul></td></tr>';
            }
        @endphp
        </table>
        <a id="apply_now" href="javascript:void(0)" style="margin-bottom:30px" class="btn btn-danger btnred">Apply Now</a>
        
        <form id="userapply" style="display:none" action="{{ route('userapply.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="Name">Name</label>
                      <input type="name" name="name" class="form-control" placeholder="Name">
                       @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                      <label for="Email">Email</label>
                      <input type="email" class="form-control" name="email" placeholder="Email">
                      @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="Phone No">Phone No.</label>
                      <input type="number" class="form-control" name="contact_no" placeholder="Phone No.">
                      @if ($errors->has('contact_no'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('contact_no') }}</strong>
                        </span>
                        @endif
                    </div>
                    <input type="hidden" value="{{ $job->id }}" name="job_id">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                      <label for="Phone No">Upload Resume</label>
                      <input type="file" class="form-control" name="file" placeholder="Upload Resume">
                      @if ($errors->has('file'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('file') }}</strong>
                        </span>
                        @endif
                    </div>
    
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-12">
                      <button name="submit" class="btnred btnpad border0 border_radius mtop20" style="margin-bottom:30px" id="form_send">Send</button>
                    </div>
    
                </div>
            </form>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">

$(document).ready(function(){
    $("#apply_now").click(function(){
        $("#userapply").slideToggle("slow");
        //alert('dgdfg');
    });
});  


</script>

@endsection