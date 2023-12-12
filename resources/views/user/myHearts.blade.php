@extends('layouts.master')

@section('main-content')
<!-- Start Main Content ---->
<div class="container-fluid page-titles">
    <div class="row">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"> <i style="font-size:22px" class="fa fa-heart"></i> My Hearts</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">My Hearts</li>
                    </ol>
                </div>
    </div>
</div>
  <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">                        

        <!-- Start Upgrade Membership ---->

        @if ( !isthisSubscribed() )
            <div class="row upgrade">
    			<div class="col-md-10">
    				<div class="upgdinfo bggray font300">
    					<p>Hey {{ ucfirst( Auth::user()->display_name_on_pages ) }}!. Upgrade your membership today to check your Hearts.</p>
    				</div>
    			</div>
    			<div class="col-md-2">							
        			<a style="padding: 18px 0px;" href="{{ url('pricing') }}" class="btn btnred width100">Upgrade Membership</a>
    			</div>
    		</div>
    	@endif
        <!-- End Upgrade Membership ---->
        <!-- Start Match Tabs -->
        @if ( isthisSubscribed() )
            <div class="matchtabs pt30">
                <div class="container-fluid">
                    <div class="col-md-12 mb30">
                        @if( $hearts )
                            @foreach( $hearts as $heart )
                                @php
                                    $userdata = \App\User::find($heart->wishlistedby);
                                @endphp
                                @if( $userdata )
                                <a href="{{route('viewprofile', base64_encode( $heart->wishlistedby ))}}">
                                <div class="col-md-2 text-center">
                                    <img src="{{ $userdata->profile_pic_url  }}" alt="">
                                    @if( $userdata->is_online )
                                        <span class="green"></span>
                                    @endif
                                    <div class="mtop20">
                                        <h4><a href="{{ route('viewprofile', base64_encode($heart->wishlistedby)) }}">{{ ucfirst( $userdata->display_name_on_pages ) }}</a></h4>
                                        <span>{{ @$userdata->usergroup->title }}</span>
                                    </div>
                                </div>
                                </a>
                                @endif
                            @endforeach
                        @endif
                    </div>   
                </div>
            </div>
        @endif
        <!-- End Match Tabs -->

   </div>
                        </div>
                    </div>
                </div>
                 </div>
<!-- End Main Content ---->
@endsection