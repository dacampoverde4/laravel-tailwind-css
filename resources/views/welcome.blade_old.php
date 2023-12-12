@extends('layouts.frontend')
@section('content')
<div class="banner_section">
    <div id="form-errors"></div>
    @if (!Auth::check())
    <form method="POST" action="{{ route('register') }}" id="myForm">
   @csrf
        <h3 class="bgred">CREATE AN ACCOUNT</h3> 
       <div class="result col-md-12"></div> 
          
        <input type="hidden" name="isajax" value="1"/>    
            <!--div class="col-md-12 col-sm-12 vertical_align mtop20 padding0">
                <div class="col-md-4 col-sm-4 col-xs-4"><label>SCREEN NAME</label></div>
                <div class="col-md-8 col-sm-8 col-xs-8">
                    <input type="text" name="name">
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </div>
            </div-->
            <div class="col-md-12 col-sm-12 vertical_align padding0 mtop20">
                <div class="col-md-4 col-sm-4 col-xs-4"><label>FIRST NAME</label></div> 
                <div class="col-md-8 col-sm-8 col-xs-8"><input type="text" name="fullname">
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('fullname') }}</strong>
                    </span>
                </div>
            </div> 
            <div class="col-md-12 col-sm-12 vertical_align padding0">
                <div class="col-md-4 col-sm-4 col-xs-4"><label>LAST NAME</label></div>
                <div class="col-md-8 col-sm-8 col-xs-8"><input type="text" name="lastname">
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('lastname') }}</strong>
                    </span>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 vertical_align padding0">
                <div class="col-md-4 col-sm-4 col-xs-4"><label>EMAIL ADDRESS</label></div>
                <div class="col-md-8 col-sm-8 col-xs-8"><input type="email" name="email">
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 vertical_align padding0">
                <div class="col-md-4 col-sm-4 col-xs-4"><label>USER GROUP</label></div>
                <div class="col-md-8 col-sm-8 col-xs-8">
                    <select class="form-control changeUserGroup" id="user_group" onchange="getGoup(this.value)" name="user_group"  required="required" >
                        @if( $group )    
                        @foreach( $group as $row )
                        @if ($loop->first)
                        <script type="text/javascript">
                        $(document).ready(function() {
                            getGoup(<?php echo $row->id ?>)
                        });
                        </script>
                        @endif
                        <option value="{{ $row->id }}"><?php echo $row->title ?></option>
                        @endforeach
                        @endif
                    </select>
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('user_group') }}</strong>
                    </span>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 vertical_align padding0">
                <div class="col-md-4 col-sm-4 col-xs-4"><label for="gender" class="col-md-4 col-form-label text-md-right">GENDER</label></div>
                <div class="col-md-8 col-sm-8 col-xs-8">
                    <div class="col-md-12 padding0" id="genderInfodisplay">
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 vertical_align padding0">
                <div class="col-md-4 col-sm-4 col-xs-4"><label for="species_id" >SPECIES</label></div>
                <div class="col-md-8 col-sm-8 col-xs-8">
                    <select class="form-control" id="species_id" name="species_id" >
                        <option value="">Please select</option>
                        @if( $species )
                            @foreach( $species as $row )
                                <option value="{{ $row->id }}"><?php echo $row->name ?></option>
                            @endforeach
                        @endif
                    </select>
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('species_id') }}</strong>
                        </span>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 vertical_align padding0">
                <div class="col-md-4 col-sm-4 col-xs-4"><label>SET PASSWORD</label></div>
                <div class="col-md-8 col-sm-8 col-xs-8"><input type="password" name="password">


                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 vertical_align padding0">
                <div class="col-md-4 col-sm-4 col-xs-4"><label>CONFIRM PASSWORD</label></div>
                <div class="col-md-8 col-sm-8 col-xs-8"><input type="password" name="password_confirmation"></div>
            </div>
            <div class="col-md-12 col-sm-12 mb padding0">
                <div class="col-md-4 col-sm-4 col-xs-4"></div>
                <div class="col-md-8 col-sm-8 col-xs-8"><button  name="submit" class="btnred btnpad border0 border_radius" id="form_submit">REGISTER</button></div>
            </div>
        </form>
        @endif
    </div>
    <!-- End banner Section -->

    <!-- Start flayer Section -->
    <div class="flayer_section">
        <div class="main_container  row">
            <div class="col-md-12 col-sm-12">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <img src="{{ asset('frontend/images/man.png') }}" alt="mail" title="mail">
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <h2 class="mtop50">WE ARE THE <span class="fontred">"A"</span> IN ADOPTION</h2>
                    <p>AvDopt is the future of adoption in Second Life! We conveniently allow parents and child avatars to match based on their criteria. Experience quality, convenience and security at it's finest. Join the revolution of Second Life adoption and find your match today!
                    </p>
                    <a href="#" class="btn_join">JOIN US FOR FREE</a>
                </div>
            </div>
        </div>  
    </div>
    <!-- End flayer Section -->

    <!-- Start Members Section -->
    <div class="members_section mtopbottom fullwidth">
        <div class="main_container text-center">
            <h2 class="mtopbottom60">RECENT MEMBERS</h2>
            @php
                //$allusers = App\User::where('is_online', 1)->limit(6)->orderBy('id', 'desc')->get();
            @endphp
            <div class="owl-carousel">
                @foreach($recentusers as $singleuser)
                    <div class="item">
                        <a href="{{route('viewprofile', base64_encode( $singleuser->id ))}}">
                           
                             <div class="img_container" style="background-image:url({{ asset('/uploads/'.$singleuser->profile_pic)}});"></div>
                            <h2>{{ $singleuser->name }}</h2>
                            <span style="color: #656565;">{{ @$singleuser->usergroup->title}}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>  
    </div>
    <!-- End flayer Section -->

    <!-- Start Top Members Section -->
    <div class="topmembers_section fullwidth">
        <h2 class="mtopbottom60 text-center">TOP MEMBERS</h2>
        <div class="text-center tommembers">
            @foreach($topusers as $topuser)
            @if($loop->iteration==1 || $loop->iteration==2 || $loop->iteration==6 || $loop->iteration==7)
                <div class="col-md-3">
            @endif
            @if($loop->iteration==2 || $loop->iteration==3 || $loop->iteration==4 || $loop->iteration==5 || $loop->iteration==7 || $loop->iteration==8 || $loop->iteration==9 || $loop->iteration==10)
                <div class="col-md-6">
            @endif
                <a href="{{route('viewprofile', base64_encode( $topuser->id ))}}">
                     <div class="img_container"><img src="{{ asset('/uploads/'.$topuser->profile_pic)}}"></div>
                </a>
            @if($loop->iteration==1 || $loop->iteration==5 || $loop->iteration==6 || $loop->iteration==10)
                </div>
            @endif
           @if($loop->iteration==2 || $loop->iteration==3 || $loop->iteration==4 || $loop->iteration==5 || $loop->iteration==7 || $loop->iteration==8 || $loop->iteration==9 || $loop->iteration==10)
                </div>
            @endif
            @endforeach 
        </div>
    </div>
    <!-- End Icons Section -->

    <!-- Start Icons Section -->
    <div class="icon_section fullwidth">
        <div class="main_container  row">
            <div class="col-md-12 col-sm-12 text-center mtopbottom">
                <ul>
                    <li><img src="{{ asset('frontend/images/heart_icon.png') }}" alt="mail" title="mail"><h2 class="mtop20">@php echo countAllMembers(); @endphp</h2><h6>Members in Total</h6></li>
                    <li><img src="{{ asset('frontend/images/couple.png') }}" alt="mail" title="mail"><h2 class="mtop20">@php echo countAllParents(); @endphp </h2><h6>Total Parents</h6></li>
                    <li><img src="{{ asset('frontend/images/cross.png') }}" alt="mail" title="mail"><h2 class="mtop20">@php echo countAllGirls(); @endphp</h2><h6> Total Girls</h6></li>
                    <li><img src="{{ asset('frontend/images/circle_arrow.png') }}" alt="mail" title="mail"><h2 class="mtop20">@php echo countAllBoys(); @endphp</h2><h6>Total Boys</h6></li>
                </ul>
            </div>
        </div>  
    </div>
    <!-- End Icons Section -->

    <!-- Start video Section -->
    <div class="video_section fullwidth">
        <div class="container">
            <div class="col-md-12 col-sm-12 text-center mtopbottom">
                <img src="{{ asset('frontend/images/quote.png') }}" alt="quote">
                <h2>NOTHING SAY BETTER THAN A VEDIO</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown </p>
                <a href="#" class="mtop70">See Vedio</a>
                <img src="{{ asset('frontend/images/vedio_icon.png') }}" alt="mail" title="mail">
            </div>
        </div>  
    </div>
    <!-- End video Section -->

    <!-- Start testimonial Section -->
    <div class="testimonial_section fullwidth">
        <div class="container">
            <div class="col-md-12 col-sm-12 text-center mtopbottom">
                <h2>SOME SUCCESS STORY</h2>
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active text-center text-center">
                            <img src="{{ asset('frontend/images/testimonial_img.png') }}" alt="">
                            <img src="{{ asset('frontend/images/quote.png') }}" alt="">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            <span>John & Sara</span>
                        </div>

                        <div class="item text-center">
                            <img src="{{ asset('frontend/images/testimonial_img.png') }}" alt="">
                            <img src="{{ asset('frontend/images/quote.png') }}" alt="">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            <span>John & Sara</span>
                        </div>

                        <div class="item text-center">
                            <img src="{{ asset('frontend/images/testimonial_img.png') }}" alt="">
                            <img src="{{ asset('frontend/images/quote.png') }}" alt="">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            <span>John & Sara</span>
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <img src="{{ asset('frontend/images/left_arrow.png') }}" alt="Arrow">

                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <img src="{{ asset('frontend/images/right_arrow.png') }}" alt="Arrow">

                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>  
    </div>
    <!-- End testimonial Section -->
    @endsection