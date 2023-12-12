@extends('layouts.master')

@section('page_level_styles')
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{ asset('frontendnew/css/userads_style.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

@yield('page_level_styles')

@section('main-content')
 <div class="container-fluid page-titles">
   
</div>
<!-- Start Main Content ---->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        	<div class="card">
        		<div class="card-body">
                </div>  
                <div class="row">
                    <div class="col-md-12">
                        @if(session()->has('success'))
                            <div class="mt10">
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            </div>
                            @endif

                            @if(session()->has('error'))
                            <div class="mt10">
                                <div class="alert alert-error">
                                    {{ session()->get('error') }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                            <ul class="nav nav-tabs">
                              <li><a data-toggle="tab" href="#Advertise">Advertise</a></li>
                              <li class="active"><a data-toggle="tab" href="#my_campaigns" >My Campaigns</a></li>
                            </ul>
                            <div class="tab-content">
                              <div id="Advertise" class="tab-pane fade in ">
                                <div class="card-body">                    
                                    <center><h1 class="Advertm"><strong>Advertise on AvDopt.com</strong></h1></center> 
                                    <center><h3 class="Advertmp"><i>Drive traffic to your business, raise brand awareness, and increase your sales.</i></h3></center>
                                    <div class="row">
                                        <div class="col-md-4 same_col">
                                            <h3 class="Advertsub">We know a lot about advertising</h3>
                                            <p class="Advertsubp">AvDopt is a website that connects Second Life users with great adoption opportunities. Win the hearts and minds of our diverse members today!</p>
                                        </div>
                                        <div class="col-md-4 same_col">
                                            <h3 class="Advertsub">Get in front of customers</h3>
                                            <p class="Advertsubp">Increase your visibility to consumers and generate sales. It's never been easier advertising to a targeted audience that shops both online and in-world.</p>

                                        </div>
                                        <div class="col-md-4 same_col">
                                            <h3 class="Advertsub">Size truly doesn't matter</h3>
                                            <p class="Advertsubp">It doesn't just look great; advertising on AvDopt.com works too. We offer advertising opportunities to our clients regardless of the size business.</p>
                                        </div>    
                                    </div>
                                    <hr class="Adverthr">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 adver_sec">
                                          <center><h2 class="pkgttl">Advertisement Packages</h2></center>  
                                          <center><p class="pkgttlsub">Please take advantage of our Advertisement Packages and <br>
                                            experience the benefits of a successful marketing campaign.</p></center>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if(session()->has('success'))
                                                <div class="mt10">
                                                    <div class="alert alert-success">
                                                        {{ session()->get('success') }}
                                                    </div>
                                                </div>
                                                @endif
                
                                                @if(session()->has('error'))
                                                <div class="mt10">
                                                    <div class="alert alert-error">
                                                        {{ session()->get('error') }}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                
                                    <div class="row mtb10 bot_col_sec">
                                        @foreach($alladvertisement   as $key=>$value)                            
                                        <div class="col-xs-12 col-sm-6 col-md-4 bot_cols">
                                            <div class="single_ads">
                                                <h4>
                                                    <span class="pckttlsec">{{ $value->title }}</span>
                                                    <span class="pckamntsec">T{{ $value->total_amt }}/ {{ $value->banner_plan }}</span>
                                                </h4>
                                                <div class="single_ads_inner">
                                                    <div class="sec_hgt">                                        
                                                        <div class="adsdesc">
                                                            <p>{!! $value->description !!}</p>
                                                        </div> 
                                                        <h5 class="ttl_sec">Banner List</h5>
                                                        @if($value->banners_list)
                                                           <ul class="usrbanner_lists">
                                                                @foreach($value->banners_list as $key2=>$value2) 
                                                                    <li>
                                                                    @foreach($value2 as $key3=>$value3)
                                                                        <span class="banerprice_ttl">
                                                                            @if($key3 == 'banner_width')
                                                                                {{ $value3 }}
                                                                            @endif
                                                                            
                                                                            @if($key3 == 'banner_height')
                                                                                X {{ $value3 }}
                                                                            @endif
                                                                        </span>
                                                                        @if($key3 == 'page_location')
                                                                            <span class="pagesec">page - {{$value3}}</span>
                                                                        @endif
                                                                    @endforeach
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    
                                                        <h5 class="ttl_sec">Target Audience</h5>
                                                        @if($value->target_audiences)
                                                            <ul class="taraud_lists">
                                                            @foreach($value->target_audiences as $key2=>$value2)
                                                                <li>
                                                                    <p>
                                                                        <span class="target_aud_sec">Group {{ $key2+1}} - {{ $value2['usergroup_names'] }}</span>
                                                                        <!-- <span class="target_aud_price">Group price - {{ $value2['price'] }}</span> -->
                                                                    </p>
                                                                </li>
                                                            @endforeach    
                                                            </ul> 
                                                        @endif                                        
                                                    </div>
                                                    <div class="paybtn_sec"> 
                                                        @if($value->paid == 0)
                                                            <a href="{{ route('checkoutads.manageads', $value->id)}}" class="btn btn-info">Buy</a>
                                                        @elseif( $value->paid == 1)
                                                            <button  class="btn btn-disabled upgraded_ads" disabled >Paid</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                
                                </div>
                              </div>
                            <div id="my_campaigns" class="tab-pane fade active">
                                
                    <div class="row mtb20">
                     
                        @foreach($advertisement as $key=>$value)
                            @if($value->status != 'Deleted')                            
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="single_ads_manageads">
                                    <h4>
                                        @if($value->adevertisementlist)
                                        <span class="pckttlsec">{{ $value['adevertisementlist']['title'] }}</span>
                                        <span class="pckamntsec">T{{ $value['adevertisementlist']['total_amt'] }}/ {{ $value['adevertisementlist']['banner_plan'] }}</span>
                                        @endif
                                    </h4>
                                    <div class="single_ads_inner">
                                        <div class="sec_hgt_manageads"> 
                                            <h5 class="ttl_sec">Ads Status</h5>
                                            <p>current status - <span class="boldfont">{{ $value->status }}</span></p>
                                            <p>Ads started time - <span class="addstime">@if($value->start_at != ''){{ $value->start_at }} @else Not started @endif</span></p>
                                            <p>Ads ends time - 
                                                <span class="addetime">
                                                    @if($value->ended_at != '')
                                                       {{ $value->ended_at }}
                                                    @elseif($value->approve == 1 && $value->ended_at == '') 
                                                       {{ $value->end_date }} 
                                                    @elseif($value->approve == 0 && $value->ended_at == '') 
                                                       Not started 
                                                    @endif
                                                </span>
                                            </p>
                                            <p>Paid Amount - <span class="paidamnt boldfont">@if($value->paid == 1){{ $value['adevertisementlist']['total_amt'] }}Token @else Not paid @endif</span></p>
                                            <h5 class="ttl_sec pgsttl">Ads display on pages - </h5>
                                            <ul class="pgslist">       
                                                @if($value->banners)
                                                    @foreach($value->banners as $keyb=>$valueb)
                                                        <li>{{ $valueb['page_location'] }}</li>
                                                    @endforeach
                                                @endif
                                            </ul>                            
                                        </div>
                                        
                                        <div class="paybtn_sec">
                                            @if($value->ended_at != '')
                                                <a href="{{ route('deletesubads.manageads', $value->id) }}" class="btn btn-danger">Delete Advertisment</a>
                                            @elseif($value->ended_at == '' && is_array($value->userbanners) && count($value->userbanners) == 0 )
                                                <a href="{{ route('uploadbanners.manageads', $value->id) }}" class="btn btn-info">Upload Banners Images</a>
                                            @elseif($value->ended_at == '' && is_array($value->userbanners) && count($value->userbanners) > 0 )
                                                <a href="{{ route('editbanners.manageads', $value->id) }}" class="btn btn-info">Edit Banners Images</a>
                                            @endif                                                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    </div>
        		</div>
        	</div>
        </div>            
    </div>
</div>
<!-- End Main Content ---->
@endsection
@section('footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection