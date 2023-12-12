@extends('v7.frontend')
@section('page_level_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/custom.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/featured-members.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/font-awesome/css/font-awesome.min.css') }}">
<!--<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">-->
<!--<link href="https://fonts.googleapis.com/css?family=Bubblegum+Sans|Delius" rel="stylesheet">-->
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}">

<style>
.gndchecklabel {
  display: block;
  position: relative;
  padding-left: 32px;
  margin-bottom: 3px;
  cursor: pointer;
  font-size: 17px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.gndchecklabel input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.gndchecklabel .checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 22px;
  width: 22px;
  background-color: #eee;
  border: 2px solid #ddd;
}

/* When the checkbox is checked, add a blue background */
.gndchecklabel input:checked ~ .checkmark {
  background-color: #4aa02d;
  border-color: #4aa02d;
}
.carousel-control{
  width: 0;
}

/* Create the checkmark/indicator (hidden when not checked) */
.gndchecklabel .checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.gndchecklabel input:checked ~ .checkmark:after {
  display: block;
}
.verifiedimg{
  width: 20px;
  height: 20px;
}
/* Style the checkmark/indicator */
.gndchecklabel .checkmark:after {
  left: 7px;
  top: 3px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
.lftcheckbox h3{
  margin: 0 0 15px;
  padding: 0;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 14px;
  color: #333;
  font-weight: 600;
  min-height: 15px;
}
.gndrpref{
  padding: 35px 30px 30px;
  clear: both;
}
.lftcheckbox.lftcheckbox4 {
    display: flex;
    align-items: flex-end;
}
.noresult{
  margin: 20px 15px 55px;
  padding: 15px 20px;
  background: #f5f5f5;
  border-radius: 10px;
  text-align: center;
}

.browse_img img{
    width: 728px;
    height: 90px;
    margin: 0 auto;
    display: block;
}
.lftcheckbox.lftcheckbox3 {
    margin-top: 0;
}
.browse_query .lftcheckbox4 button {
    margin-left: auto;
    margin-top: 5px;
}
.row.fetu_mem_imgs_sec {
    display: flex;
    flex-wrap: wrap;
}
.nametext {
    word-break: break-word;
}

@media(max-width: 991px){
  .lftcheckbox.lftcheckbox2 {
    margin-top: 30px;
}
}

</style>

<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/isotope.pkgd.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('frontend/js/custom.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/notify.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/common.js') }}" type="text/javascript"></script>
  <script type="text/javascript">
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'url' => url('/'),
        ]); ?>



    </script>
@endsection


@section('content')
<div class="container">
    <div class="row rowpd">
        <div class="col-md-6 feature-user-slider">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                    <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                </ol>
                <!-- Wrapper for slides -->
                <div class="slidesec_bg">
                <div class="fetu_memttl_sec">
                    <h4><span class="fetu_memttl">Featured Members</span></h4>
                </div>
                <button type="button" class="btn btn-light pull-right go_btn" data-toggle="modal" data-target="#exampleModal">
                            GET FEATURED
                </button>
                <div class="carousel-inner">


                    @foreach($randomUser as $randomUser)
                    <div class="col-md-12 item {{ $loop->first ? 'active' : '' }}">
                        <div class="profile-photo">
                            <a href="{{route('viewprofile', base64_encode( $randomUser->id ))}}">
                            <img src="{{ asset('/uploads/'.$randomUser->profile_pic)}}" />
                        </a>
                        </div>
                        <div class="info">
                            <div class="username">
                                <a href="{{route('viewprofile', base64_encode( $randomUser->id ))}}">{{$randomUser->displayname}}
                                @if($randomUser->verify_request == 1)
                                <img src="{{ asset('/uploads/verification-icon-71.png')}}" class="verifiedimg" />
                                @endif
                                </a>
                            </div>
                            <div class="desciption">{{str_limit($randomUser->about_me, 80)}}</div>
                            <div class="users_info match-likes">
                                <div class=" matches-btn"><i aria-hidden="true" class="fa fa-heart-o"></i> {{ \App\Match::matchCount($randomUser->id) }} <span>MATCHES</span></div>
                                <div class="likes-btn"><i aria-hidden="true" class="fa fa-thumbs-o-up"></i> {{ likeCount($randomUser->id) }} <span>LIKES</span></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class=""></span>
                <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class=""></span>
                <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        @php
        $featurecount = isset($featurecount)? $featurecount: 5;
        $featuredUsers = getSubscribedFeatureUsers($featurecount);
        $featuredPlans = getFeaturedPlans();
        @endphp

        <div class="col-md-6 col-sm-12 col-xs-12 fetrd_rght_sec featuredclass_{{ $featurecount }}">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 logof">
                    <p>NEW MEMBERS</p>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8">
                    <div class="padding0 memberbtn">
                      <!--   <a class="tagline" href="{{route('browse')}}" >Say hi to our new members...</a> -->
                        <p class="tagline" >Say hi to our new members...</p>
                    </div>
                </div>
            </div>
            <div class="row fetu_mem_imgs_sec">
                @foreach($newusers as $user)
                    @php
                        $issubscribed = isthisUserSubscribed($user->id);
                        $isfeatured = isthisSubscribedFeature($user->id);
                        $isfeatured = isthisSubscribedFeature($user->id);
                    @endphp

                    <div class="col-xs-6 col-sm-3 col-md-3 imgbox-feature-slide">
                        <a href="{{ url('userprofile')}}/{{ base64_encode($user->id) }}">
                            <div class="imgbox"  style="background-image:url({{ ( $user->profile_pic )? url('/uploads').'/'.$user->profile_pic : url('/images/default.png')}});">
                            </div>
                        </a>
                        <p class="nametext">{{$user->displayname}}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row rowpd">
        <div class="col-md-12">
                <div class="browse_query form_div_browse">
                    <form action="" id="searchform" method="get">
                        @csrf
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label>I'm a:</label>
                                @php
                                $gID = '';
                                @endphp
                                @if($allgroup)
                                @if(Auth::user())
                                @if(Auth::user()->group)
                                @php
                                $gID = Auth::user()->group;
                                @endphp
                                @endif
                                @endif
                                <select class="form-control" id="my_role_search" @if(Auth::user()) disabled @endif>
                                @foreach($allgroup as $grouptitle)
                                    <option  @if($gID == $grouptitle->id) selected @endif  value="{{ $grouptitle->id }}">{{ $grouptitle->title }}</option>
                                @endforeach
                                </select>
                                @endif
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label>Seeking:</label>
                                @if($seekingroles)
                                <select class="form-control" name="seeking_role_search" id="seeking_role_search">
                                  @foreach($seekingroles as $seekingrole)
                                          @if ($seekingrole->id == @$_GET['seeking_role_search'])
                                            @php $val = 'selected';  @endphp
                                          @elseif ($seekingrole->id == @$seacrhresult->seeking_role)
                                            @php $val = 'selected';  @endphp
                                          @else
                                           @php $val = '';  @endphp
                                          @endif

                                          @php
                                          $seekingroledata = json_decode($seekingrole->seeking_roles);
                                          $seekingroletitles = \App\FamilyRole::find($seekingroledata);

                                          $seekingroletitlearray = array();
                                          foreach($seekingroletitles as $seekingroletitle){
                                              $seekingroletitlearray[] = $seekingroletitle->title;
                                          }
                                          $seekingrole_code = json_encode(array_reverse($seekingroletitlearray));

                                          $familyroledata = json_decode($seekingrole->family_roles);
                                          $familyroletitlearray = array();

                                           $familyroletitles = \App\FamilyRole::all()->pluck('title','id')->toArray();
                                            
                                           foreach(json_decode($seekingrole->family_roles) as $frt){
                                           
                                          
                                            
                                             $familyroletitlearray[]  =$familyroletitles[$frt];
                                             
                                          }
                                            
                                        // print_r($familyroletitlearray);exit;

                                          $familyrole_code = json_encode($familyroletitlearray);
                                          //print_r($familyrole_code);exit;

                                          $usergroupdata = json_decode($seekingrole->usergroups);
                                          $usergrouptitles = \App\Usergroup::find($usergroupdata);
                                          $usergrouptitlearray = array();
                                          $usergroupminagearray = array();
                                          $usergroupmaxagearray = array();
                                          foreach($usergrouptitles as $usergrouptitle){
                                          $usergrouptitlearray[] = $usergrouptitle->title;
                                          $usergroupminagearray[] = $usergrouptitle->minage;
                                          $usergroupmaxagearray[] = $usergrouptitle->maxage;
                                          }
                                          $usergroup_code = json_encode(array_reverse($usergrouptitlearray));

                                          // $usergroupminage_code = min($usergroupminagearray);
                                          // $usergroupmaxage_code = max($usergroupmaxagearray);

                                          $usergroupminage_code = $seekingrole->minage;
                                          $usergroupmaxage_code = $seekingrole->maxage;

                                          if($usergroupdata && $gID){
                                            foreach($usergroupdata as $usergroupkey => $usergroupvalue){
                                              if($gID == $usergroupvalue){
                                                  @endphp
                                                  <option {{ @$val }} minage="{{ @$usergroupminage_code }}" maxage="{{ @$usergroupmaxage_code }}" usergrouptitles='{{ @$usergroup_code }}' usergrouproles="{{ @$seekingrole->usergroups }}" seekingroles="{{ @$seekingrole->seeking_roles }}" seekingtitles='{{ @$seekingrole_code }}' familytitles='{{ @$familyrole_code }}' familyroles="{{ @$seekingrole->family_roles }}" value="{{ @$seekingrole->id }}">{{ $seekingrole->title }}</option>
                                                  @php
                                              }
                                            }
                                          }else{
                                            @endphp
                                            <option {{ @$val }} minage="{{ @$usergroupminage_code }}" maxage="{{ @$usergroupmaxage_code }}" usergrouptitles='{{ @$usergroup_code }}' usergrouproles="{{ @$seekingrole->usergroups }}" seekingroles="{{ @$seekingrole->seeking_roles }}" seekingtitles='{{ @$seekingrole_code }}' familytitles='{{ @$familyrole_code }}' familyroles="{{ @$seekingrole->family_roles }}" value="{{ @$seekingrole->id }}">{{ $seekingrole->title }}</option>
                                            @php
                                          }

                                          @endphp
                                          @endforeach
                                </select>

                                @endif
                        </div>
                            @php
                            $isthisSubscribe = isthisSubscribed();
                            @endphp

                            @if( $advanceSearchEnableorNot == '1' )
                        <div class="col-md-4 col-sm-4as col-xs-12">
                            <label>Family role:</label>
                                @if($seekingroles)

                                <select class="form-control" name="family_role_search" id="family_role_search">
                                  @foreach($seekingroles as $seekingrole)
                                    
                                    @if ($seekingrole->id == @$_GET['family_role_search'])
                                      {{-- {{@$_GET['family_role_search']}} --}}

                                      @php $val = 'selected';  @endphp
                                    @elseif ($seekingrole->id == @$seacrhresult->seeking_role)
                                        
                                      @php $val = 'selected';  @endphp
                                    @else
                                      @php $val = '';  @endphp
                                    @endif
                                  @php
                                  $familyroledata = json_decode($seekingrole->family_roles);


                                  $titles = \App\FamilyRole::find($familyroledata);
                                 
                                  $titlearray = array();
                                  foreach($titles as $title){

                                   $titlearray[] = $title->title;
                                    
                                    @endphp


                                  <option  {{ @$val }} gender='{{ $title->gender}}' familytitles='{{ @$code }}' familyroles="{{ @$seekingrole->family_roles }}" value="{{ $title->id }}">{{ $title->title }}</option>
                                  @php
                                  }
                                  $code = json_encode($titlearray);
                                  @endphp
                                  @endforeach
                                </select>
                                @endif
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 mtop20">
                            <label for="species_search">Species:</label>
                            <select class="form-control" id="species_search" name="species_search">
                                <option value="">Please Select</option>
                                @if( $species )
                                    @foreach( $species as $row )
                                    <option value="{{ $row->id }}" {{$row->id==@$_GET['species_search'] ? 'selected' : ''}}>
                                    <?php echo $row->name;?>
                                    </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 mtop20">
                            <label>Min Age:</label>
                                @if($seekingroles)
                                <select class="form-control" id="minage_search" name="minage_search">
                                @for ($i = 1; $i <= 100; $i++)
                                @if ($i == @$_GET['minage_search'])
                                @php $val = 'selected';  @endphp
                                @elseif ($i == @$seacrhresult->minage)
                                @php $val = 'selected';  @endphp
                                @else
                                @php $val = '';  @endphp
                                @endif
                                <option {{ @$val }} value="{{ $i }}">{{ $i }}</option>
                                @endfor
                                </select>
                                @endif
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 mtop20">
                            <label>Max Age:</label>
                                @if($seekingroles)
                                <select class="form-control" id="maxage_search" name="maxage_search">
                                @for ($i = 1; $i <= 100; $i++)
                                @if ($i == @$_GET['maxage_search'])
                                @php $val = 'selected';  @endphp
                                @elseif ($i == @$seacrhresult->maxage)
                                @php $val = 'selected';  @endphp
                                @else
                                @php $val = '';  @endphp
                                @endif
                                <option {{ @$val }}  value="{{ $i }}">{{ $i }}</option>
                                @endfor
                                </select>
                                @endif
                        </div>
                        <div class="col-md-4 col-sm-5 col-xs-5 mtop20">
                            <label for="species_search">Ethnicity:</label>
                            <select class="form-control" id="ethnicity_search" name="ethnicity_search">
                                <option value="">Please Select</option>
                                @if( $ethnicityGroups )
                                @foreach( $ethnicityGroups as $row )
                                        <option value="{{ $row->id }}" {{$row->id==@$_GET['ethnicity_search'] ? 'selected' : ''}}><?php echo $row->title ?></option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="gndrpref goldmembr">
                          <div class="row">

                            <div class="col-md-3">
                              <div class="lftcheckbox lftcheckbox1 ">
                                <h3>HUDs</h3>
                                <div class="hudList">
                                  @php
                                  if(count($huds)>0){
                                    $sel = "";
                                    foreach($huds as $hud){
                                  @endphp
                                      <div class="prefchecklist">
                                        <label class="gndchecklabel">{{$hud->title}}
                                          <input type="checkbox" name="huds-{{$hud->id}}" value="{{$hud->id}}" {{ $hud->id == @$_GET['huds-'.$hud->id] ? 'checked' : ''}}>
                                          <span class="checkmark"></span>
                                        </label>
                                      </div>
                                      @php
                                    }
                                  }
                                  @endphp
                                </div>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="lftcheckbox lftcheckbox2">
                                <h3>Preferences</h3>
                                <div class="prefchecklist">
                                  <label class="gndchecklabel">Pride Friendly
                                    <input type="checkbox" name="pride_friendly" value="1" {{1==@$_GET['pride_friendly'] ? 'checked' : ''}}>
                                    <span class="checkmark"></span>
                                  </label>
                                </div>
                                <div class="prefchecklist">
                                  <label class="gndchecklabel">Premium Members
                                    <input type="checkbox" name="premium_members" value="1" {{1==@$_GET['premium_members'] ? 'checked' : ''}}>
                                    <span class="checkmark"></span>
                                  </label>
                                </div>
                                <div class="prefchecklist">
                                  <label class="gndchecklabel">Verified Members
                                    <input type="checkbox" name="verified_members" value="1" {{1==@$_GET['verified_members'] ? 'checked' : ''}}>
                                    <span class="checkmark"></span>
                                  </label>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-3">

                              <div class="lftcheckbox lftcheckbox3">
                                <h3>  </h3>
                                <div class="prefchecklist">
                                  <label class="gndchecklabel">Recent Active
                                    <input type="checkbox" name="recent_active" value="1" {{1==@$_GET['recent_active'] ? 'checked' : ''}}>
                                    <span class="checkmark"></span>
                                  </label>
                                </div>
                                <div class="prefchecklist">
                                  <label class="gndchecklabel">Completed Match Quest
                                    <input type="checkbox" name="com_match_quest" value="1" {{1==@$_GET['com_match_quest'] ? 'checked' : ''}}>
                                    <span class="checkmark"></span>
                                  </label>
                                </div>
                                <div class="prefchecklist">
                                  <label class="gndchecklabel">Has Profile Picture
                                    <input type="checkbox" name="profile_pic" value="1" {{1==@$_GET['profile_pic'] ? 'checked' : ''}}>
                                    <span class="checkmark"></span>
                                  </label>
                                </div>
                              </div>
                            </div>

                            @endif
                            <div class="col-md-3 padding0 mtop20 text-center">
                              
                            </div>
                            @if( $advanceSearchEnableorNot == '1' )
                          </div>
                          <div class="lftcheckbox lftcheckbox4">
                            <button class="srcbtn" type="button" @if(Auth::user()) id="searchbtn" @else id="searchbtnpublic" @endif><i class="fa fa-search" aria-hidden="true"></i>Search</button>
                          </div>
                      </div>
                      
                      @endif

                        <!-- @if($upgradeStatus == 1)
                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6 padding0 mtop20 text-center"><a class="btn btn-info" href="{{url('pricing')}}" id="upgradeAccount-btn">Upgrade</a></div>
                        @endif -->
                        @if( $advanceSearchEnableorNot != '1' )
                        <div class="col-md-12 col-sm-12 col-xs-12 mtop20">
                          <?php //echo $advanceSearchEnableorNot;echo '<pre>';print_r($randomUser);?>
                            <p class="getmrinfo">Get even more options with our advanced search tools..
                            @if( !$subscription )
                            <a class="btn btn-info" href="{{url('pricing')}}">Upgrade</a>
                            @else
                            <a class="btn btn-info" href="{{url('pricing')}}">Manage</a>
                            @endif
                            </p>
                        </div>
                        @endif

                    </form>
                </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12 banner browse_img">
          <img src="http://laravel.avdopt.com/assets/images/match_quest_categoies/PAQJ0m1k2g_1573238630_.jpg" class="banner" alt="your image">
     </div>
    </div>


    <div class="">
        <div class="featuredmembers_img">
                <div class="col-md-12">
                            @if( $featuredUsers )
                              @foreach($featuredUsers as $featuredUser)
                              <div class="col-md-3 col-sm-3 col-xs-3">
                                  @if($featuredUser->user)
                                  <a href="{{ url('userprofile')}}/{{ base64_encode($featuredUser->user->id) }}" class="featured_user" style="background-image:url({{ ( $featuredUser->user->profile_pic )? url('/uploads').'/'.$featuredUser->user->profile_pic : url('/images/default.png')}});">
                                  </a>
                                  @endif
                              </div>
                              @endforeach
                            @endif
                </div>
                <!-- --------------Featured Members popup----------------- -->
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content featured_popup">
                                    <div class="modal-header padding0">
                                        <h5 class="modal-title" id="exampleModalLabel"><img class="img-responsive" alt="" src="/frontend/images/flame.png">GET FEATURED</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>The first part of standing out is getting noticed. Even before visitors see your profile and activity, they see you. Studies show that featured profiles are nine times more likely to be viewed.</p>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="{{ url('featured-members')}}" class="btn btn-success btn-md featmembtn">View Featured Members</a>
                                            </div>
                                        </div>
                                        <div class="scheme_box">
                                            @php
                                            $tokenamount = getWebsiteSettingsByKey('token_amount');
                                            if(Auth::check())
                                            $subscription = App\Subscription::where('user_id', Auth::user()->id)->where('name', 'feature')->first();
                                            @endphp
                                            @if(null != $featuredPlans)
                                            @foreach($featuredPlans as $featuredPlan)
                                            <div class="col-md-6 ">
                                                <div class="basic">
                                                    <div class="left">
                                                        <h3 class="fontclr">{{ @$featuredPlan->name }}</h3>
                                                    </div>
                                                    <div class="right">
                                                        <h5>{{ @$featuredPlan->tokens }} Tokens</h5>
                                                    </div>
                                                    <div class="feat_infop">
                                                        <p class=" mtop20">{!! $featuredPlan->info !!}</p>
                                                    </div>
                                                    @if( $subscription )
                                                    @php
                                                    $user = App\User::find(Auth::user()->id);
                                                    @endphp
                                                    @if( $subscription->stripe_plan == $featuredPlan->plan_id && $user->subscribed('feature') && ( !$user->subscription('feature')->onGracePeriod() ) )
                                                    <form class="form-horizontal " role="form" method="POST" action="{{ url('/')}}/subscription/featurecancel">
                                                        @csrf
                                                        <input type="hidden" name="chargeId" value="{{ $featuredPlan->plan_id }}" >
                                                        <button type="submit" onclick="return confirm('Are you sure you want to cancel this plan?')" class="mtop10 mb cncl_btn"><span>Cancel</span><</button>
                                                    </form>
                                                    @else
                                                    <form class="form-horizontal " role="form" method="POST" action="{{ url('/')}}/subscription/checkout">
                                                        @csrf
                                                        <input type="hidden" name="chargeId" value="{{ $featuredPlan->plan_id }}" >
                                                        <button type="submit" onclick="return confirm('Are you sure you want to upgrade this plan?')" class="mtop10 mb upgrd_btn"><span>Buy Now</span><</button>
                                                    </form>
                                                    @endif
                                                    @else
                                                    <form class="form-horizontal " role="form" method="POST" action="{{ url('/')}}/subscription/checkout">
                                                        @csrf
                                                        <button type="submit" class="mtop10 mb"><span>Buy</span></button>
                                                        <input type="hidden" name="chargeId" value="{{ $featuredPlan->plan_id }}" >
                                                        <div class="hidescript">
                                                            <!--<script
                                                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                                                data-key="{{ env('STRIPE_KEY') }}"
                                                                data-amount="{{ ( $tokenamount )? $featuredPlan->tokens * ( $tokenamount * 100 ): $featuredPlan->tokens * 100 }}"
                                                                data-name="{{ $featuredPlan->name }}"
                                                                data-description="Feature Profile charge"
                                                                data-image="{{url('/')}}/backend/images/logo.jpg"
                                                                data-locale="auto">
                                                                </script>-->
                                                        </div>
                                                    </form>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <div class="col-md-12">
                                                <h4 class="alert alert-info"> Please Contact with admin to get featured plans </h4>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
                <!-- --------------End Featured Members popup----------------- -->
        </div>
    </div>
<style>
.banner.browse_img {
    margin-bottom: 40px;
    margin-top: 20px;
}
.brwse_pgination p.noresult {
    margin: 0 15px 40px;
}
.all-user-rows {
    padding: 0;
}
.row.rowpd.brwse_pgination {
    margin-bottom: 60px;
}
</style>
    <div class="row rowpd brwse_pgination">
      @if($noresult != '')
      <p class="noresult"> {{$noresult}} </p>
      @endif
        @foreach($users as $key=>$user)
        @php
            $issubscribed = isthisUserSubscribed($user->id);
            $isfeatured = isthisSubscribedFeature($user->id);
        @endphp

        @if($loop->iteration % $divs_per_row == 1)
        <div class="col-md-12 all-user-rows">
                @endif
                <div class="col-md-3 text-center user_outer_box">
                    <div class="user_img featuredmem_sec">
                      <a href="{{ url('userprofile')}}/{{ base64_encode($user->id) }}">
                        @if( $issubscribed )<div class="p_tag">P</div>@endif
                        @if( $isfeatured )<div class="featured_tag"><span>Featured</span></div>@endif
                            <div class="imgbox"  style="background-image:url({{ ( $user->profile_pic )? url('/uploads').'/'.$user->profile_pic : url('/images/default.png')}});">
                            </div>
                        </a>
                        {!! getGroupTagWithColor($user->id) !!}
                        <h3 class="featured_userttl">
                            <div class="inline_block tooltip_box feat_tooltip">
                                <i style="color: @if( $user->is_online ) green @else red @endif" class="fa fa-bars"  aria-hidden="true"></i>
                                <div class="tooltip2">
                                    <div class="tooltip2_inner vertical_align">
                                        <div class="col-md-5 col-sm-6 col-xs-12">
                                            <a href="{{ url('userprofile')}}/{{ base64_encode($user->id) }}" class="featured_user2" style="background-image:url({{ ( $user->profile_pic )? url('/uploads').'/'.$user->profile_pic : url('/images/default.png')}});">
                                            </a>
                                        </div>
                                        <div class="col-md-7 col-sm-6 col-xs-12 padding0">
                                            <ul>
                                                <li class="">
                                                    <img src="{{ url('/') }}/frontend/images/user.png" alt="Profile Icon" title="Profile Icon" class="feat_lst_icons"><span>Name: <a href="{{ url('userprofile')}}/{{ base64_encode($user->id) }}">{{ title_case( $user->display_name_on_pages ) }}</a></span>
                                                </li>
                                                <li class=""><img src="{{ url('/') }}/frontend/images/age.png" alt="Age Img" title="Age Img" class="feat_lst_icons"><span>Age: {{ ( $user->age )? $user->age . ' Years' : '' }}</span>
                                                </li>
                                                <li class="">
                                                    <img src="{{ url('/') }}/frontend/images/gender.png" alt="Gender Icon" title="Gender Icon" class="feat_lst_icons"><span>Gender: {{ @$user->usergender->title }}</span>
                                                </li>
                                                <li class=""><img src="{{ url('/') }}/frontend/images/last_login.png" alt="last Login Icon" title="Profile Icon" class="feat_lst_icons"><span>Status:
                                                    @if( $user->is_online )
                                                    <span class="fontgreen">Online</span>
                                                    @else
                                                    <span class="fontred">Offline</span>
                                                    @endif
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tooltip2_inner">
                                        <div class="tooltip_intro">
                                            @if( $user->about_me )
                                            <p><span><b>Introduction:</b></span>{{ str_limit($user->about_me, 100, ' ...') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    @if( $isfeatured )<div class="featured_tag"><span>Featured</span></div>@endif
                                </div>
                            </div>
                            <a href="{{route('viewprofile', base64_encode( $user->id ))}}">
                                {{ @$user->displayname }}
                                 @if($user->verify_request == 1)<img src="{{ asset('/uploads/verification-icon-71.png')}}" class="verifiedimg" />@endif
                            </a>
                        </h3>
                        
                        <h3 class="featured_userttl"><span class="lt_seen" style="color:red;"> <b style="color:#337ab7;">Last Seen:</b> {!! $timeDurations[$key] !!} Ago</span></h3>
                        <div class="users_info match-likes">
                            <div class=" matches-btn"><i aria-hidden="true" class="fa fa-heart-o"></i> {{ \App\Match::matchCount($user->id) }}
                                <span>MATCHES</span></div>
                            <div class="likes-btn"><i aria-hidden="true" class="fa fa-thumbs-o-up"></i> {{ likeCount($user->id) }} <span>LIKES</span></div>
                        </div>
                    </div>
                </div>
                @if(($loop->iteration > 1 && $loop->iteration % $divs_per_row == 0) || $loop->iteration == $users->count() )
                      </div>
                @endif

        @endforeach


          @php
            $users->appends(request()->query->all())->previousPageUrl();
         @endphp
        {{ $users->links() }}
    </div>

  </div>
</div>
@php
echo $speciesVar = app('request')->input('species_search');

if($speciesVar==''){
  $seekingVar = app('request')->input('seeking_role_search');
  $familyVar = app('request')->input('family_role_search');
  $minageVar = app('request')->input('minage_search');
  $maxageVar = app('request')->input('maxage_search');
  $speciesVar = '';

}
else{
  $seekingVar = @$seacrhresult->search_usergroup;
  $familyVar = @$seacrhresult->search_usergroup;
  $minageVar = @$seacrhresult->search_usergroup;
  $maxageVar = @$seacrhresult->search_usergroup;
  $speciesVar = @$seacrhresult->species_id;
}

@endphp
<input type="hidden" value="{{ @$maxageVar }}" id="hiddenmax">
<input type="hidden" value="{{ @$minageVar }}" id="hiddenmin">
<input type="hidden" value="{{ @$seekingVar }}" id="hiddenseekingrole">
<input type="hidden" value="{{ @$familyVar }}" id="hiddenfamilyrole">
<input type="hidden" value="{{ @$familyVar }}" id="hiddenusergroup">
<input type="hidden" value="{{ @$speciesVar }}" id="hiddenspecies">

@endsection
@section('scripts')
<script type="text/javascript">

    $(document).ready(function(){
      const urlParams = new URLSearchParams(window.location.search);
      const selectedFamily = urlParams.get('family_role_search');
      const selectedMinAge = urlParams.get('minage_search');
      const selectedMaxAge = urlParams.get('maxage_search');

      $("#family_role_search option").remove();
        var minage = $('#seeking_role_search option:selected').attr('minage');
        var maxage = $('#seeking_role_search option:selected').attr('maxage');
        var familyids = $('#seeking_role_search option:selected').attr('familyroles');
        var familytitles = $('#seeking_role_search option:selected').attr('familytitles');
        var usergroupids = $('#seeking_role_search option:selected').attr('usergrouproles');
        var usergrouptitles = $('#seeking_role_search option:selected').attr('usergrouptitles');

        $("#hiddenusergroup").val(usergroupids);

        $('#minage_search').find('option').remove();
        $('#maxage_search').find('option').remove();
        for( var i = minage; i <= maxage-1+1; i++ ){
            $("#minage_search, #maxage_search").append('<option value="'+i+'">'+i+'</option>');
        }

        var idfamilyparse = JSON.parse(familyids)+'';
        var idfamilytitle = JSON.parse(familytitles)+'';
        arrfamily1 = idfamilyparse.split(',');
        arrfamily2 = idfamilytitle.split(',');

        for(i=0; i < arrfamily1.length; i++){

          if(arrfamily1[i] == selectedFamily){
              $("#family_role_search").append('<option value="'+arrfamily1[i]+'" selected>'+arrfamily2[i]+'</option>');
          }else{
              $("#family_role_search").append('<option value="'+arrfamily1[i]+'">'+arrfamily2[i]+'</option>');
          }

        }


      $('#seeking_role_search').on('change', function() {
        // alert();
        $("#family_role_search option").remove();
        var minage = $('#seeking_role_search option:selected').attr('minage');
        var maxage = $('#seeking_role_search option:selected').attr('maxage');

        console.log(minage);
        console.log(maxage);
        var familyids = $('#seeking_role_search option:selected').attr('familyroles');
        var familytitles = $('#seeking_role_search option:selected').attr('familytitles');
        var usergroupids = $('#seeking_role_search option:selected').attr('usergrouproles');
        var usergrouptitles = $('#seeking_role_search option:selected').attr('usergrouptitles');

        $('#minage_search').find('option').remove();
        $('#maxage_search').find('option').remove();
        for( var i = minage; i <= maxage-1+1; i++ ){
            $("#minage_search, #maxage_search").append('<option value="'+i+'">'+i+'</option>');
        }
        $('#minage_search option:first').attr('selected','selected');
        $('#maxage_search option:last').attr('selected','selected');
        
        var idfamilyparse = JSON.parse(familyids)+'';
        var idfamilytitle = JSON.parse(familytitles)+'';
        arrfamily1 = idfamilyparse.split(',');
        arrfamily2 = idfamilytitle.split(',');
        for(i=0; i < arrfamily1.length; i++){
          $("#family_role_search").append('<option value="'+arrfamily1[i]+'">'+arrfamily2[i]+'</option>');
        }
      });

      $("#minage_search").on('change', function() {
          getHuds();
      });

      $("#maxage_search").on('change', function() {
          getHuds();
      });



      function getHuds(){
        
        var minage =$('#minage_search option:selected').val();
        var maxage =$('#maxage_search option:selected').val();

          jQuery.ajax({
              url:"{{ route('seekinghuds') }}", //the page containing php script
              method: 'POST',
              data:{'minage': minage,'maxage': maxage,'_token': '{{ csrf_token() }}'},
              success:function(result){
                            $('.hudList').html('');

                            console.log(result);
                            $.each(result, function(key, value) {
                              $('.hudList').append('<div class="prefchecklist"><label class="gndchecklabel">'+value+'<input type="checkbox" name="huds-'+key+'" value="'+value+'" ><span class="checkmark"></span></label></div>');
                            });
                        }
            });
      }

      var maxHide = $('#hiddenmax').val();
      var minHide = $('#hiddenmin').val();
      var genderHide = $('#hiddengender').val();
      var usergroupHide = JSON.parse($('#hiddenusergroup').val());
      // console.log('usergroupHide---->',JSON.parse(usergroupHide));
        var usergroupHideString = '';
       $.each(usergroupHide, function( index, value ) {
          if(index != usergroupHide.length-1){
            usergroupHideString += value+',';
          }else{
            usergroupHideString += value;
          }
          });

       

      var speciesHide = $('#hiddenspecies').val();
      $("#minage_search option[value="+selectedMinAge+"]").attr('selected', 'selected');
      $("#maxage_search option[value="+selectedMaxAge+"]").attr('selected', 'selected');
      $("#gender_search option[value="+genderHide+"]").attr('selected', 'selected');
      $("#seeking_role_search option[value="+usergroupHideString+"]").attr('selected', 'selected');
      $("#species_search option[value="+speciesHide+"]").attr('selected', 'selected');





    });

          $("#my_role_search").on('change', function() {
                  var group_id =$('#my_role_search option:selected').val();
                  jQuery.ajax({
          					url:"{{ route('seekingroles') }}", //the page containing php script
          					method: 'POST',
                    data:{'group_id': group_id,'_token': '{{ csrf_token() }}'},
          					success:function(result){
                                  $('#seeking_role_search').html('');
                                  $.each(result, function(key, value) {
                                    $('#seeking_role_search').append('<option value="'+value.id+'">'+value.title+'</option>');
                                  });
                              }
                  });
           });

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

    $(document).ready(function () {
      $('.fdi-Carousel .item').each(function () {
        var next = $(this).next();
        if (!next.length) {
          next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));

        //this will only work for carousel with 3 items since it only adds next() and  next.next();

        if (next.next().length > 0) {
          next.next().children(':first-child').clone().appendTo($(this));
        }
        else {
          $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
        }
      });
});
</script>
@endsection
