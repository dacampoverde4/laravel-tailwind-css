@extends('layouts.master')
@section('htmlheader')
<style>
.fade:not(.show) {
     opacity: 1;
}
.right-section.profile_ad.photos img {
    width: 100%;
    max-width: 100%;
}
.right-section.profile_ad.ad_sec {
    float: right;
    margin-bottom: 3rem;


}
.right-section.profile_ad.ad_sec {
    float: right;
    margin: 3rem 0;
}
.right-section.profile_ad span {
    margin-top: 16px;
    font-size: 14px;
    margin-left: 2px;
}
.right-section.profile_ad img {
    width: 100%;
    max-width: 33px;
}

.right-section.profile_ad h3 {
    display: inline-flex;
}
    .right-section.profile_ad {
    background: #fff;
    box-shadow: 0 0 5px #ccc;
    padding: 14px;

}
   .right-section {
    display: inline-block;

    padding: 23px 20px 35px 30px;
    vertical-align: top;
    width: 100%;
}
    .right-section.profile_ad.left_2 {
    margin-top: 3rem;
}

    .right-section.profile_ad.left_2.photo {
    margin-top: 0rem !important;
}
.right-section.profile_ad.photos img {
    width: 100%;
    max-width: 100%;
}
 .right-section.profile_ad.ad_sec {
    float: right;
    margin-bottom: 3rem;


}
.right-section.profile_ad.ad_sec {
    float: right;
    margin: 3rem 0;
}
.right-section.profile_ad span {
    margin-top: 16px;
    font-size: 14px;
    margin-left: 2px;
}
.right-section.profile_ad img {
    width: 100%;
    max-width: 33px;
}

.right-section.profile_ad h3 {
    display: inline-flex;
}
    .right-section.profile_ad {
    background: #fff;
    box-shadow: 0 0 5px #ccc;
    padding: 14px;

}
    .right-section.profile_ad.left_2 {
    margin-top: 3rem;
}

    .right-section.profile_ad.left_2.photo {
    margin-top: 0rem !important;
}
    .right-section.profile_ad.left_2 {
    margin-top: 3rem;
}

    .right-section.profile_ad.left_2.photo {
    margin-top: 0rem !important;
}
.right-section.profile_ad.photos img {
    width: 100%;
    max-width: 100%;
}

.list_sec li {
    border-bottom: 1px solid #eee;
    color: #4f4e4e;
    padding: 7px 0;
    position: relative;
    width: 100%;
    list-style-type: none;

}
.Usergradientbg {
    background: rgba(0, 0, 0, 0) linear-gradient(to right, #d9d900 27%, #25c8ff 73%) repeat scroll 0 0;
    border-radius: 6px;
    bottom: 44%;
    color: #000;
    font-size: 15px;
    font-weight: bold;
    padding: 0px 4px;
    position: absolute;
    right: 33px;
    text-transform: uppercase;
    top: -4px;
    margin-top: 10px;
    height: 32px;
}

.Usergradientbg > span {
    border: 1px solid #fff;
    border-radius: 4px;
    padding: 0 15px;
    vertical-align: middle;
    position: relative;
    top: 4px;
}
ul.nav.nav-tabs.profile-tab {
    margin-bottom: 12px;
    background-color: #fff;
}
.nav-tabs {
    border-bottom: none !important;
}
.nav-tabs .nav-item {
    margin-bottom: -1px;
    width: 33%;
    text-align: center;
    margin-right: 1px;
    margin-left: 1px;
}
ul.nav.nav-tabs.profile-tab a {
    color: #000;
}
.nav-tabs .nav-link {
    border: 1px solid transparent !important;
    border-top-left-radius: .25rem !important;
    border-top-right-radius: .25rem !important;
}
.card .card-subtitle {
    font-weight: 200;
    margin: 14px;
    color: #99abb4;
}
.panel-warning > .panel-heading + .panel-collapse > .panel-body {
    border-top-color: #faebcc;
}
.list_sec{
margin:0;
padding:0;
}
ul.nav.nav-tabs.profile-tab li a:hover {
    color: #fff;
    background: #3b5998;
}
img.img-responsive.radius {
    height: 293px;
}
.like_btn {
    color: #ee3c3c;
}
.like_btn, .match_btn {
    float: left;
    margin-left: 0rem;
}

ul.list_sec li span {
    vertical-align: middle;
    padding-left: 7px;
}
.like_btn i, .match_btn i {
    display: inline-block;
    font-size: 25px;
    padding-right: 8px;
}
.match_btn {
    color: #30a6cc;
    margin-left: 15px;
    cursor: default;
}
.like_btn, .match_btn {
    background: transparent none repeat scroll 0 0;
    border: 1px solid #eaeaea;
    border-radius: 4px;
    font-size: 21px;
    padding: 5px 20px;
    display: inline-flex;
}
.edit_sec {

    text-align: right;
    margin: 9px 0 0;
}
.profile-tab li a.nav-link.active, .customtab li a.nav-link.active {
    text-decoration: none;
    background-color: #3b5998;
    color: #fff;
    text-align: center;
    border: none;
}
a.nav-link.active {
    color: #fff!important;
    border:none!important;
}
.customtab li a.nav-link, .profile-tab li a.nav-link {
    border: 0px;
    padding: 11px 20px;
    color: #67757c;
    border-radius: unset;
    margin-right: 2px;
}v.nav-tabs.profile-tab li a:hover {
    background-color: #3b5998;
    color: #fff;
}

.panel-warning > .panel-heading {
    color: #8a6d3b;
    background-color: #fcf8e3;
    border-color: #faebcc;
}
.panel-group .panel-heading {
    border-bottom: 0;
}

.panel-heading {
    padding: 8px 10px 16px 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}

.panel-group .panel-heading {
    border-bottom: 0;
}

.fa.pull-right {
    margin-left: .3em;
}

.panel-title {
    margin-top: 0;
    margin-bottom: 0;
    font-size: 16px;
    font-weight: 500;
    color: #454545;
    font-family: 'Roboto', sans-serif;
}

.bgred {
    background: #EB3939 !important;
    color: #fff;
    padding: 5px;
    font-size: 19px;
}


h3.font_family.bgred {
    margin-top: 15px;
}

.panel-group .panel + .panel {
    margin-top: 5px;
}

h3.font_family.bgred {
    margin-top: 15px;
}

h3.font_family {
    margin: 0;
}

.panel-title > a, .panel-title > small, .panel-title > .small, .panel-title > small > a, .panel-title > .small > a {
    color: #656565;
}

.panel-group .panel-heading + .panel-collapse > .panel-body, .panel-group .panel-heading + .panel-collapse > .list-group {
    border-top: 3px solid #4285f4;
}

.collapse.in {
    display: block;
}
.panel-group {
    margin: 10px 0;
}

.panel-body {
    padding: 20px 10px 10px 10px;
}
.panel-warning {
    border-color: #faebcc !important;
}
.panel {
    margin-bottom: 9px;
    background-color: #fff;
    border: 1px solid transparent;
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
}
img.img-box {
    width: 100%;
}
.left-section {
    display: inline-block;
    vertical-align: middle;
    width: 100%;
}
.mtopbottom20 {
    margin: 20px 0px;
}
.slick-slide img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.slick-initialized .slick-slide {
    height: 220px !important
  }
  .mtopbottom20 button.slick-next.slick-arrow, .mtopbottom20 button.slick-prev.slick-arrow {
      display: none !important;
  }
.familyRoles-list small {
    float: left;
    width: 100%;
    margin-bottom: 10px;
}
.familyRoles-list {
    float: left;
    width: 100%;
    margin: 15px 0 40px;
}
.familyRoles-list > div {
    float: left;
    margin: 5px 8px 5px 0;
}
.familyRoles-list > div > a {
    padding: 4px 12px !important;
    font-size: 14px;
}
.familyRoles-list > div > a > i {
    margin-right: 5px;
}
</style>
@endsection

@section('main-content')
        @php
        $at_least_one_answer_found=0;
        if($useranswer){
            $answerarray = json_decode($useranswer->answer_data,true);
            if($answerarray){
                foreach($answerarray as $key=>$answer){
                    $model = App\Questionnaires::find($key);
                    if(count( $answerarray[$model->id] ) > 0 ){
                        foreach($answerarray[$model->id] as $getanswer)
                        {
                            if($getanswer)
                            {
                                $at_least_one_answer_found=1;
                            }
                        }
                    }
                }
            }
        }
        @endphp
  <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Profile</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>

                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
                <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>

    <div class="container-fluid">

        @if ( !isthisSubscribed() )
            <div class="row upgrade">
                <div class="col-md-10">
                    <div class="upgdinfo bggray font300">
                        <p>Hey {{ ucfirst( Auth::user()->display_name_on_pages ) }}! Upgrade your membership today to experience unlimited features.</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <a style="padding: 18px 0px;" href="{{ url('pricing') }}" class="btn btnred width100">Upgrade Membership</a>
                </div>
            </div>
        @endif

                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                              <h4 class="card-title m-t-10"><b>{{ ucfirst( $user->display_name_on_pages ) }}</b></h4>
                                <!--<center class="m-t-30"> <img src="{{ $user->profile_pic_url}}" class="img-box"  />-->
                                <div class="left-section">
                                  <div class="slider-for">
                                      <div style="background-image:url({{ ( $user->profile_pic )? url('/uploads').'/'.$user->profile_pic : url('/images/default.png')}});background-size:cover;background-position:50% 50%;height:450px !important; width:373px;"></div>
                                      @php
                                          $images = @$user->photos;
                                      @endphp
                                      @if( $images )
                                          @foreach($images as $row)
                                              <div style="background-image:url({{ asset('/uploads/'.$row->image)}});background-size:cover;background-position:50% 50%;height:450px !important; width:106px;"> </div>
                                          @endforeach
                                      @endif
                                  </div>
                              </div>

                              <div class="modal fade" id="myModal" role="dialog">
                                  <div class="modal-dialog">
                                      <!-- Modal content-->
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title font22">Photo Album</h4>
                                          </div>
                                          <div class="modal-body">
                                              <h5 class="mtop20 font16">Upload multiple images for Photos Album</h5>
                                              {!! Form::open([ 'route' => [ 'dropzone.uploadfile' ], 'files' => true, 'class' => 'dropzone','id'=>"image-upload"]) !!}
                                              {!! Form::close() !!}

                                              <div class="slider-for-pop">
                                                  <div><img class="img-box" src="{{ ( $user->profile_pic )? url('/uploads').'/'.$user->profile_pic : url('/images/default.png')}}" alt="Profile Img" title="Profile Img"> </div>
                                                  @php
                                                      $images = $user->photos;
                                                  @endphp
                                                  @if( $images )
                                                      @foreach($images as $row)
                                                          <div><img class="img-box" src="{{ asset('/uploads/'.$row->image)}}" alt="Profile Img" title="Profile Img"> </div>
                                                      @endforeach
                                                  @endif
                                              </div>

                                          </div>

                                      </div>

                                  </div>
                              </div>

                    <!-- <center class="m-t-30">
                        <div class="slider-for">
                            <div style="background-image:url({{ ( $user->profile_pic )? url('/uploads').'/'.$user->profile_pic : url('/images/default.png')}});background-size:cover;background-position:50% 50%;height:450px; width:373px;"></div>
                                @php
                                $images = $user->photos;
                                @endphp
                                @if( $images )
                            @foreach($images as $row)
                                    <div style="background-image:url({{ asset('/uploads/'.$row->image)}});background-size:cover;background-position:50% 50%;height:450px; width:106px;"> </div>
                                @endforeach
                            @endif
                        </div>
                    </div>  </center> -->




                                  <div>
                                    <h6 class="card-subtitle">Accoubts Manager Amix corp</h6>
                                    </div>
                                   <div class="row text-center justify-content-md-center">
                                      <!--   <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">254</font></a></div>
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium">54</font></a></div> -->
                                    <div class="col-md-12 padding0">
                                    <button type="button" class="like_btn "><i style="font-size:30px" class="fa">&#xf087;</i>{{ $likecount }} Likes</button>
                                    <button type="button" class="match_btn"><i style="font-size:30px" class="fa fa-check-square-o" aria-hidden="true"></i>{{ \App\Match::matchCount() }} Matches</button>
                                    </div>
                                    </div>
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body">
                              @if(null != $getFamilyRoleInfo)
                              <div class="familyRoles-list">
                                <small class="text-muted">Family Roles </small>

                                        @foreach($getFamilyRoleInfo as $frole)
                                        <div class="input_group cl_ble">
                                        <a href="javascript:void(0);" data-color="success" class="btn btn-success btn_family_role">
                                        <i class="fa fa-check-square-o"></i>{{$frole->title}}
                                        </a>
                                        </div>

                                        @endforeach
                                </div>
                              @endif
                              <small class="text-muted p-t-30 db">Email address </small>
                                <h6>{{ ucfirst( $user->email ) }}</h6>
                                <small class="text-muted p-t-30 db">Joining Date</small>
                                <h6>{{ ( $user->created_at )? date("F j, Y", strtotime($user->created_at) ) : '' }}</h6>

                                 <!-- <small class="text-muted p-t-30 db">Address</small>
                                <h6>71 Pilgrim Avenue Chevy Chase, MD 20815</h6> -->



                            </div>
                        </div>

                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                      <div class="card">
                            <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
                                <div class="btn-group" role="group">
                                    <button type="button" id="about" class="btn btn-primary" href="#profile_first" data-toggle="tab">
                                        <div class="hidden-xs">ABOUT ME</div>
                                    </button>
                                </div>
                               @if($at_least_one_answer_found)
                                <div class="btn-group" role="group">
                                    <button type="button" id="questionnary" class="btn btn-default" href="#profile_third" data-toggle="tab">
                                        <div class="hidden-xs">MATCH QUEST</div>
                                    </button>
                                </div>
                                @endif
                                <div class="btn-group" role="group">
                                    <button type="button" id="seeking" class="btn btn-default" href="#profile_second" data-toggle="tab">
                                        <div class="hidden-xs">HISTORY</div>
                                    </button>
                                </div>
                            </div>
                        <div class="well">
                            <!-- Nav tabs -->

                            <!-- Tab panes -->
                            <div class="tab-content">

                                <!--second tab-->
                                <div class="tab-pane fade in active" id="profile_first">
                                  <div class="card-body">
                            <div class="row">

                        <div class="col-md-6">
                            <ul class="list_sec">
                                <li class="font17"><img src="{{url('/')}}/frontend/images/user.png" alt="Profile Icon" title="Profile Icon"> <span><b>Name:</b> {{ ucfirst( $user->display_name_on_pages ) }} </span></li>
                                <li class="font17"><img src="{{url('/')}}/frontend/images/membership.png" alt="Membership Icon" title="Membership Icon">  <span><b>Membership Type:</b> {!! getGroupTagWithColor($user->id) !!}</span> </li>
                                <li class="font17"><img src="{{url('/')}}/frontend/images/age.png" alt="Age Img" title="Age Img">  <span><b>Age:</b> {{ ( $user->age )? $user->age . ' Years' : '' }}  </span></li>
                                <li class="font17"><img src="{{url('/')}}/frontend/images/gender.png" alt="Gender Icon" title="Gender Icon"> <span><b>Gender: </b> {{ @$user->usergender->title }}</span></li>

                            </ul>
                        </div>

                        <div class="col-md-6">
                            <ul class="list_sec">

                                <li class="font17"><img src="{{url('/')}}/frontend/images/user.png" alt="Species Icon" title="Species Icon"> <span><b>Species:</b> {{ $user->species?$user->species->name:'N/A' }} </span></li>
                                <li class="font17"><img src="{{url('/')}}/frontend/images/join_date.png" alt="Join Date Icon" title="Profile Icon"> <span> <b>Join Date:</b> {{ ( $user->created_at )? date("F j, Y", strtotime($user->created_at) ) : '' }}</span></li>
                                <li class="font17"><img src="{{url('/')}}/frontend/images/last_login.png" alt="last Login Icon" title="Profile Icon"> <span> <b>Last Seen:</b> {!! $user->last_seen_ago_html !!}</span></li>

                            </ul>
                        </div>

                                        </div>
                                        <div class="card-body"> <small class="text-muted"></small>
                                            <h6>{{ $user->about_me}}</h6>
                                        <div class="pull-right">
                                                <a href="{{ route('edit.profile') }}" class="btn btn-primary  leave_note">Edit Profile</a>
                                            </div>
                                        </div>


                                    </div>
                                  </div>

<!-- ========================================================================================================= -->
                                      <div>
                                             <div class="card-body">
                                               <div class="sl-right">
                                                    <div><a href="#" class="link">{{ ucfirst( $user->display_name_on_pages ) }}</a>
                                                        <p>Gallery by <a href="#"> {{ ucfirst( $user->display_name_on_pages ) }} </a></p>
                                                        <div class="row">
                                                            @php
                                                                $images = $user->photos;
                                                            @endphp
                                                            @if( $images )
                                                                <div class="left-section mtopbottom20">
                                                                    <div class="slider-thumb">
                                                                        <div class="slider-nav">
                                                                            <div class="col-lg-6 col-md-6 m-b-20" ><img class="img-box" src="{{ ( $user->profile_pic )? url('/uploads').'/'.$user->profile_pic : url('/images/default.png')}}" alt="Profile Img" title="Profile Img"> </div>
                                                                            @foreach($images as $row)
                                                                                <div class="col-lg-6 col-md-6 m-b-20" ><img class="img-box" src="{{ asset('/uploads/'.$row->image)}}" alt="Profile Img" title="Profile Img"> </div>
                                                                            @endforeach
                                                                         </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <!--<div class="col-lg-3 col-md-6 m-b-20"><img src="../assets/images/big/img1.jpg" class="img-responsive radius" /></div>-->
                                                        </div>
                                                        <div class="like-comm"> <a href="javascript:void(0)" class="link m-r-10">2 comment</a> <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> </div>
                                                    </div>
                                                </div>
                                            </div>
<!-- ========================================================================================================= -->
                                </div>

                                <div class="tab-pane fade in" id="profile_second">
                                  <div class="card-body">
                                      <div class="col-md-12 pull-right">
                                          <p>Comming Soon</p>
                                      </div>
                                  </div>
                                </div>

                                @if($at_least_one_answer_found)
                                <div class="tab-pane fade in" id="profile_third">
                                    <div class="card-body">
                                        <div class="col-md-12 pull-right">
                                            <h3 class="font_family bgred">MATCH QUEST</h3>
                                            <div class="panel-group " id="accordion" role="tablist" aria-multiselectable="true">
                                            @foreach($answerarray as $key=>$answer)
                                            @php
                                                $model = App\Questionnaires::find($key);
                                            @endphp
                                            @php
                                                $expanded='false';
                                                $collapse='panel-collapse collapse';
                                            @endphp
                                            @if ($loop->first)
                                            @php
                                               $expanded='true';
                                               $collapse='panel-collapse collapse in';
                                            @endphp
                                            @endif
                                            @php
                                            $answer_found=0;
                                            if(count( $answerarray[$model->id] ) > 0 ){
                                                foreach($answerarray[$model->id] as $getanswer){
                                                    if($getanswer)
                                                    {
                                                        $answer_found=1;
                                                    }
                                                }
                                            }
                                            @endphp
                                            @if($answer_found)
                                                <div class="panel panel-warning">
                                            <div class="panel-heading" role="tab" id="heading{{ $loop->iteration }}">
                                                <h4 class="panel-title font17">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $loop->iteration }}" aria-expanded="{{ $expanded }}" aria-controls="collapseOne">
                                                        <b>{{ $model->question_title }}</b>
                                                        <i class="fa fa-plus pull-right"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse{{ $loop->iteration }}" class="{{ $collapse }}" role="tabpanel" aria-labelledby="heading{{ $loop->iteration }}">
                                                <div class="panel-body fontclr73">
                                                    @if(count( $answerarray[$model->id] ) > 1 )
                                                        <ul>
                                                            @foreach($answerarray[$model->id] as $getanswer)
                                                               <li>{{ $getanswer }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        @php
                                                            echo current($answerarray[$model->id]);
                                                        @endphp
                                                    @endif
                                                </div>
                                            </div>
                                                </div>
                                            @endif
                                            @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
            </div>

<!-- End profile Section -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
@endsection


@section('footer')

<script type="text/javascript">
    $(document).ready(function(){

       $('.slider-for').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          fade: true,
          asNavFor: '.slider-nav',
             autoplay: false
        });
        $('.slider-nav').slick({
          slidesToShow: 2,
          slidesToScroll: 1,
          asNavFor: '.slider-for',
          dots: false,
          centerMode: true,
          focusOnSelect: true

        });

        $("#noteselect").change(function(){
        var selectvalue = $("#noteselect option:selected").val();
        if(selectvalue=='other'){
            $(this).remove();
            $('.textareanote').append('<textarea type="text" class="form-control" name="note"></textarea>');
        }
        });

        $('.reportorblock').click(function(){
            var id = $(this).attr('data-id');
            if(id==1){
                var type = 'report';
                var header = 'Report User <code>{{ ucfirst( $user->name ) }}</code>';
            }
            else{
                var type = 'block';
                var header = 'Block User <code>{{ ucfirst( $user->name ) }}</code>';
            }
            $('#type').val(type);
            $('#subbtn').text(type);
            $('.formreportblock .modal-title').html(header);
        });
            // masonary
        var $grid = $('.grid').isotope({
          itemSelector: '.grid-item',
          columnWidth: 160,
          gutter: 20,
          percentPosition: true,
          masonry: {
            columnWidth: '.grid-sizer'
          }
        });

      $(".nav-tabs a").click(function(){
        $(this).tab('show');
      });

      $(".btn-pref .btn").click(function () {
          $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
          // $(".tab").addClass("active"); // instead of this do the below
          $(this).removeClass("btn-default").addClass("btn-primary");
      });

    });
</script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}"/><link rel="stylesheet" type="text/css" href="http://kenwheeler.github.io/slick/slick/slick-theme.css"/>
<script type="text/javascript" src="{{ asset('js/slick.js') }}"></script>
@endsection
