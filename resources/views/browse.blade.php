@extends('v7.frontend')

@section('page_level_styles')

      <link rel="stylesheet" type="text/css" href="{{ asset('frontend/font-awesome/css/font-awesome.min.css') }}">
  <!--<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">-->
  <!--<link href="https://fonts.googleapis.com/css?family=Bubblegum+Sans|Delius" rel="stylesheet">-->
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}">
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
           @yield('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/custom.css') }}">
    <style>
    @yield('page_level_styles')

<style>
  .browse_query_box {
    width: 100%;
    background: #fff;
  }
  .browse_main {
    display: block;
    float: right;
    width: 100%;
    background: #fff;
  }
  #upgradeAccount-btn {
    margin: 30px 0 0;
  }
  
</style>
    @stop
@section('content')
<div class="browse_main mb30">
    <div class="browse_query_box cont_sec">
        <!-- ------------Pagination--------- -->
        <div class="col-md-6 col-sm-6 col-xs-12">
           <div class="browse_query form_div_browse">
               <form action="" id="searchform" method="get">
                   @csrf
                   <div class="col-md-6 col-sm-5 col-xs-5">
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
                           <select class="form-control" @if(Auth::user()) disabled @endif>
                               @foreach($allgroup as $grouptitle)
                                   <option @if($gID == $grouptitle->id) selected @endif  value="{{ $grouptitle->id }}">{{ $grouptitle->title }}</option>
                               @endforeach
                           </select>
                       @endif
                   </div>
                   <div class="col-md-6 col-sm-5 col-xs-5">
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
                         $familyroletitles = \App\FamilyRole::find($familyroledata);
                         $familyroletitlearray = array();
                         foreach($familyroletitles as $familyroletitle){
                         $familyroletitlearray[] = $familyroletitle->title;
                         }
                         $familyrole_code = json_encode(array_reverse($familyroletitlearray));

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

                         $usergroupminage_code = min($usergroupminagearray);
                         $usergroupmaxage_code = max($usergroupmaxagearray);
                         @endphp
                         <option {{ @$val }} minage="{{ @$usergroupminage_code }}" maxage="{{ @$usergroupmaxage_code }}" usergrouptitles='{{ @$usergroup_code }}' usergrouproles="{{ @$seekingrole->usergroups }}" seekingroles="{{ @$seekingrole->seeking_roles }}" seekingtitles='{{ @$seekingrole_code }}' familytitles='{{ @$familyrole_code }}' familyroles="{{ @$seekingrole->family_roles }}" value="{{ @$seekingrole->id }}">{{ $seekingrole->title }}</option>
                         @endforeach
                       </select>
                       @endif
                   </div>
                   @php
                        $isthisSubscribe = isthisSubscribed();


                   @endphp

                   @if( $advanceSearchEnableorNot != '' )
                       <div class="col-md-6 col-sm-5 col-xs-5">
                           <label>Family role:</label>
                           @if($seekingroles)
                               <select class="form-control" name="family_role_search" id="family_role_search">
                                 @foreach($seekingroles as $seekingrole)

                                   @if ($seekingrole->id == @$_GET['family_role_search'])
                                   {{@$_GET['family_role_search']}}
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
                                 <option  {{ @$val }} gender='{{ $title->gender}}' familytitles='{{ @$code }}' familyroles="{{ @$seekingrole->family_roles }}" value="{{ @$title->id }}">{{ $title->title }}</option>
                                 @php
                                 }
                                 $code = json_encode($titlearray);
                                 @endphp
                                 @endforeach
                               </select>
                           @endif
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                           <label>Min Age:</label>
                           @if($seekingroles)
                               <select class="form-control" id="minage_search" name="minage_search">
                                 @for ($i = 1; $i <= 100; $i++)
                                      @if ($i == @$_GET['minage'])
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
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                           <label>Max Age:</label>
                           @if($seekingroles)
                               <select class="form-control" id="maxage_search" name="maxage_search">
                                 @for ($i = 1; $i <= 100; $i++)
                                     @if ($i == @$_GET['maxage'])
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
                        <div class="col-md-6 col-sm-5 col-xs-5">
                            <label for="species_search">Species:</label>
                            <select class="form-control" id="species_search" name="species_search">
                                <option value="">Please Select</option>
                                @if( $species )
                                    @foreach( $species as $row )
                                        <option value="{{ $row->id }}" {{$row->id==@$_GET['species'] ? 'selected' : ''}}>
                                            <?php echo $row->name;?>
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-6 col-sm-5 col-xs-5">
                            <label for="species_search">Ethnicity:</label>
                            <select class="form-control" id="ethnicity_search" name="ethnicity_search">
                                <option value="">Please Select</option>
                                @if( $ethnicityGroups )
                                @foreach( $ethnicityGroups as $row )
                                    @if($user)
                                        @if($row->id==$user->ethnicity_group_id)
                                        <option value="{{ $row->id }}" selected><?php echo $row->title ?></option>
                                        @else
                                        <option value="{{ $row->id }}"><?php echo $row->title ?></option>
                                        @endif
                                    @else
                                        <option value="{{ $row->id }}"><?php echo $row->title ?></option>
                                    @endif
                                @endforeach
                                @endif
                            </select>
                        </div>
                   @endif
                   <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 padding0">
                      <button class="srcbtn" type="button" @if(Auth::user()) id="searchbtn" @else id="searchbtnpublic" @endif><i class="fa fa-search" aria-hidden="true"></i>Search</button>
                   </div>

                    @if($upgradeStatus == 1)
                      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 padding0"><a class="btn btn-info" href="{{url('pricing')}}" id="upgradeAccount-btn">Upgrade</a></div>
                    @endif
                    @if( !$isthisSubscribe )
                       <div class="col-md-12 col-sm-12 col-xs-12 mtop20">
                           <p>Get even more options with our advanced search tools.. </p>
                       </div>
                    @endif
               </form>
           </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
             <a href="#" class="font20"><b style="color:#3C5CB1">Browse Users > All</b></a>
             <nav aria-label="Page navigation example">
                 <ul class="pagination">
                 <li class="page-item"><a class="page-link" href="#">Page {{ $users->currentPage() }} of {{ $users->count() }}</a></li>

                 </ul>
                 {{ $users->appends(request()->query())->links()  }}
            </nav>
           </div>
        </div>
        <!-- ------------Featured Images---- -->

         @include('includes.features', ['featurecount'=>5])
    </div>
    <div class="clearfix"></div>
    <div class="browse_query_box cont_sec2 min_height">
    <div class="users_box row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            @foreach($users as $user)
             <div class="col-md-3 col-sm-3 text-center user_outer_box">

                <div class="user_img">
                    @php
                        $issubscribed = isthisUserSubscribed($user->id);
                        $isfeatured = isthisSubscribedFeature($user->id);
                    @endphp
                    @if( $issubscribed )
                         <div class="p_tag">P</div>
                    @endif
                    @if( $isfeatured )
                        <div class="featured_tag"><span>Featured</span></div>
                    @endif
                    <a href="{{ url('userprofile')}}/{{ base64_encode($user->id) }}">
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
                                @if( $isfeatured )
                                    <div class="featured_tag"><span>Featured</span></div>
                                @endif
                                @if( $issubscribed )
                                    <div class="premuim_tag"><span>Premuim</span></div>
                                @endif
                            </div>
                            </div>
                            {{ @$user->displayname }}
                        </h3>

                    <div class="users_info mtop20"><p><span>{{ likeCount($user->id) }} </span><span>Likes</span></p><p><span>{{ \App\Match::matchCount($user->id) }} </span><span>Matches</span></p></div>

                </div>
            </div>
            @endforeach

        </div>
    </div>
     </div>
</div>
    <!-- -------------All Images------------- -->
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
          $("#family_role_search").append('<option value="'+arrfamily1[i]+'">'+arrfamily2[i]+'</option>');
        }

      $('#seeking_role_search').on('change', function() {
        $("#family_role_search option").remove();
        var minage = $('#seeking_role_search option:selected').attr('minage');
        var maxage = $('#seeking_role_search option:selected').attr('maxage');
        var familyids = $('#seeking_role_search option:selected').attr('familyroles');
        var familytitles = $('#seeking_role_search option:selected').attr('familytitles');
        var usergroupids = $('#seeking_role_search option:selected').attr('usergrouproles');
        var usergrouptitles = $('#seeking_role_search option:selected').attr('usergrouptitles');

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
          $("#family_role_search").append('<option value="'+arrfamily1[i]+'">'+arrfamily2[i]+'</option>');
        }

      });

      var maxHide = $('#hiddenmax').val();
      var minHide = $('#hiddenmin').val();
      var genderHide = $('#hiddengender').val();
      var usergroupHide = $('#hiddenusergroup').val();
        var speciesHide = $('#hiddenspecies').val();
      $("#minage_search option[value="+minHide+"]").attr('selected', 'selected');
      $("#maxage_search option[value="+maxHide+"]").attr('selected', 'selected');
      $("#gender_search option[value="+genderHide+"]").attr('selected', 'selected');
      $("#seeking option[value="+usergroupHide+"]").attr('selected', 'selected');
      $("#species_search option[value="+speciesHide+"]").attr('selected', 'selected');

    });

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection
