@extends('layouts.master')

@section('main-content')
 <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"> My Visitors</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">My Visitors</li>
                    </ol>
                </div>
               
            </div>
    <!-- Start Main Content ---->
    <div class="container-fluid">
        <div class="row">
        <div class="col-xs-12 col-md-10">      
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header"> My Profile Visitors</div>
                    <div class="card-body">                     

                        <!-- Start Upgrade Membership ---->

                        @if ( !isthisSubscribed() )
                            <div class="row mtop30 upgrade">
                    			<div class="col-md-10">
                    				<div class="upgdinfo bggray font300">
                    					<p>Hey {{ ucfirst( Auth::user()->display_name_on_pages ) }}!. Upgrade your membership today to check your likes.</p>
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
                            <div class="myliketab mtop30 pt30">
                                <div class="container-fluid">
                                    <div class="col-md-12 mb30">
                                        <div class="el-element-overlay">
                                            <div class="row">



                                                @if( $visitors )
                                                    @foreach( $visitors as $key=>$userid )
                                                        @php
                                                            //$userdata = \App\User::whereNotIn('group', [1,3])->find($userid);
                                                            $userdata = \App\User::find($userid);
                                                          

                                                        @endphp
                                                        @if( $userdata )
                                                            <div class="col-lg-3 col-md-6">
                                                                <div class="card shadow_sec">
                                                                    <div class="el-card-item">
                                        								<a class="btn default btn-outline" href="{{route('viewprofile', base64_encode( $userid ))}}">
                                                                        <div class="el-card-avatar el-overlay-1 img_outer_sec"> <img src="{{ $userdata->profile_pic_url  }}" /> @if( $userdata->is_online )
                                                                                <span class="green"></span>
                                                                            @endif
                                        								
                                                                            <div class="el-overlay scrl-dwn">
                                                                               
                                                                            </div>
                                        								
                                                                        </div>
                                        									</a>
                                                                        <div class="el-card-content">
                                                                            <h3 class="box-title">{{ ucfirst( $userdata->display_name_on_pages ) }}</h3> <small>{{ @$userdata->usergroup->title }}</small>
                                                                            <br/> </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    @else
                                                        <div class="col-lg-12 col-md-12 text-center ">
                                                            <span class="text-center text-danger">No record found</span>
                                                        </div>
                                                    @endif
                                            </div> 
                                        </div>
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
            <div class="col-xs-12 col-md-2">
                <div class="card">
                    <div class="card-body">
                        <div class="subs_sec new_sb text-center">
                            <h1>AD SPONSORS</h1>
                        </div>
                        <div class="adsimgsec ads_160_600_size">
                            <img src="{{ url('/images/160x600.jpg')}}" class="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- End Main Content ---->
@endsection