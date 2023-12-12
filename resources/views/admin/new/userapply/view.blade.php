@extends('admin.New.layout.master')
@section('content')
<div class="row">
<!-- Column -->
<div class="col-lg-12 col-xlg-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h3 class="inline_block font22"><b class="vertical_align"><img src="{{ asset('backend/images/applicants2.png') }}" alt="Img" title="Img" class="announcement"> APPLICANTS</b>
                        <a class="btn btn-info pull-right" href="{{ url('admin/applicants') }}"><i class="fa fa-arrow-left"></i> Back</a>
                    </h3>
                    <hr>
                    <div class="msgtabs pt50">
                        <div class="container-fluid">
                            @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                            @endif
                            <div class="row">
                                @foreach($job as $key=> $formdata)
                                <div class="col-md-6 field">
                                    {{strtoupper($formdata->field)}}
                                </div>
                                <div class="col-md-6 value">
                                    {{$formdata->value}}
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection