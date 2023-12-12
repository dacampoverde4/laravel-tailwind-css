@extends('admin.layout.master')
@section('page_css')
@endsection
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22"><b>Advertisement</b>
                            <a class="btn btn-info btnpad pull-right" href="{{ route('admin.advertisement') }}"><i class="fa fa-arrow-left"></i> Back</a>
                        </h3>
                        <hr>
                        <div class="box-body">
                            <div class="col-md-12 row">
                                <div class="col-md-6">
                                    <p><strong>Title :</strong></p>                   
                                    <p><strong>Banner Plan : </strong> </p>
                                    <p><strong>Description: </strong></p>             
                                    <p><strong>Banners: </strong> </p>
                                    <p><strong>User Groups: </strong> </p>
                                    <p><strong>Amount : </strong> </p>
                                    <p><strong>Time Period : </strong> </p>
                                    <p><strong>Date : </strong> </p>
                                </div>
                                @php
                                    $bannerid = explode(',',$advertisement['banner_ids']);
                                    $taudienceid = explode(',',$advertisement['target_audience_ids']);
                                @endphp
                                <div class="col-md-6">
                                    <p>{{$advertisement['title']}}</p>
                                    <p>{{ $advertisement['banner_plan']}}</p>
                                    <p>{{ $advertisement['description']}}</p>
                                    <p>@if($bannerid)
                                                    @foreach($bannerid as $banner)
                                                    @php $bannerlist = \App\Banner::where('id',$banner)->first();
                                                    @endphp

                                                    {{$bannerlist->banner_width}}_{{$bannerlist->banner_height}}_{{$bannerlist->page_location}}<br> 
                                                    @endforeach
                                                    @endif</p>
                                    <p>@if($taudienceid)
                                                    @foreach($taudienceid as $tid)
                                                    @php $usergrouplist = \App\TargetAudience::where('id',$tid)->first();
                                                    @endphp
                                                    {{$usergrouplist->usergroup_names}}<br> 
                                                    @endforeach
                                                    @endif</p>
                                    <p>{{ $advertisement['total_amt']}}</p>
                                    <p>{{ $advertisement['plan_period']}}</p>
                                    <p>{{date('M d, Y', strtotime($advertisement->created_at))}}</p>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection