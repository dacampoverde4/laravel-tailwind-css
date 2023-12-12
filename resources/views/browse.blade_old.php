@extends('layouts.frontend')
@section('content')
<div class="browse_main mb30">
    <div class="browse_query_box">
        <!-- ------------Pagination--------- -->
        <div class="col-md-6 col-sm-6 col-xs-12">
           <div class="browse_query">
               <form action="" id="searchform" method="get">
                   @csrf
                   <div class="col-md-5 col-sm-5 col-xs-5">
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
                           <select class="width100" @if(Auth::user()) disabled @endif>
                               @foreach($allgroup as $grouptitle)
                                   <option @if($gID == $grouptitle->id) selected @endif  value="{{ $grouptitle->id }}">{{ $grouptitle->title }}</option>
                               @endforeach
                           </select>
                       @endif
                   </div>
                   <div class="col-md-5 col-sm-5 col-xs-5">
                       <label>Seeking a:</label>
                       @if($group)
                           <select class="width100" name="usergroup" id="seeking">
                               @foreach($group as $grouptitle)
                                    @if ($grouptitle->id == @$_GET['usergroup'])
                                        @php $val = 'selected';  @endphp
                                    @elseif ($grouptitle->id == @$seacrhresult->search_usergroup)
                                       @php $val = 'selected';  @endphp
                                    @else
                                        @php $val = '';  @endphp
                                    @endif
                                    @php
                                      $roledata = json_decode($grouptitle->genderrole);
                                      $titles = \App\GenderRole::find($roledata);
                                      $titlearray = array();
                                      foreach($titles as $title){
                                          $titlearray[] = $title->title;
                                      }
                                      $code = json_encode($titlearray);
                                    @endphp

                                   <option  {{ @$val }} minage="{{ @$grouptitle->minage }}" maxage="{{ @$grouptitle->maxage }}" titles='{{ @$code }}' role="{{ @$grouptitle->genderrole }}" value="{{ @$grouptitle->id }}">{{ $grouptitle->title }}</option>
                               @endforeach
                           </select>
                       @endif
                   </div>
                   @php 
                        $isthisSubscribe = isthisSubscribed();       
                   @endphp
                   @if( $advanceSearchEnableorNot != '' )
                       <div class="col-md-5 col-sm-5 col-xs-5">
                           <label for="species_search">Species:</label>
                           <select class="width100" id="species_search" name="species">
                               <option value="">Please select</option>
                               @if( $species )
                                   @foreach( $species as $row )
                                       <option value="{{ $row->id }}" {{$row->id==@$_GET['species'] ? 'selected' : ''}}>
                                           <?php echo $row->name;?>
                                       </option>
                                   @endforeach
                               @endif
                           </select>
                       </div>
                       <div class="col-md-5 col-sm-5 col-xs-5">
                           <label>Gender:</label>
                           @if($genders)
                               <select class="width100" id="gender_search" name="gender">

                               </select>
                           @endif
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                           <label>Min Age:</label>
                               <select class="width100" id="minage_search" name="minage">
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
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                           <label>Max Age:</label>
                               <select class="width100" id="maxage_search" name="maxage">
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
                        </div>
                   @endif
                   <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 padding0">
                       <label></label>
                       <button class="" @if(Auth::user()) id="searchbtn" @endif><i class="fa fa-search" aria-hidden="true"></i>Search</button>
                   </div>
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
    <div class="browse_query_box min_height">
    <div class="users_box">
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
            

                        <h3>
                            <div class="inline_block tooltip_box">
                                <i style="color: @if( $user->is_online ) green @else red @endif" class="fa fa-bars"  aria-hidden="true"></i>
                                <div class="tooltip2">
                                <div class="tooltip2_inner vertical_align">
                                    <div class="col-md-5 col-sm-6 col-xs-12">
                                        <a href="{{ url('userprofile')}}/{{ base64_encode($user->id) }}" class="featured_user2" style="background-image:url({{ ( $user->profile_pic )? url('/uploads').'/'.$user->profile_pic : url('/images/default.png')}});">
                                          
                                            </a>   
                                    </div>
                                    <div class="col-md-7 col-sm-6 col-xs-12 padding0">
                                        <ul>
                                            <li class=""><img src="{{ url('/') }}/frontend/images/user.png" alt="Profile Icon" title="Profile Icon"><span>Name: <a href="{{ url('userprofile')}}/{{ base64_encode($user->id) }}">{{ title_case( $user->name ) }} </a></span></li>
                                            <li class=""><img src="{{ url('/') }}/frontend/images/age.png" alt="Age Img" title="Age Img">  <span>Age: {{ ( $user->age )? $user->age . ' Years' : '' }} </span></li>
                                            <li class=""><img src="{{ url('/') }}/frontend/images/gender.png" alt="Gender Icon" title="Gender Icon"> <span> Gender: {{ @$user->usergender->title }}</span></li>
                                            <li class=""><img src="{{ url('/') }}/frontend/images/last_login.png" alt="last Login Icon" title="Profile Icon"> 
                                                <span> Status: 
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
$ug = app('request')->input('usergroup');
$gn = app('request')->input('gender');
if($gn){
  $usergroupVar = app('request')->input('usergroup');
  $genderVar = app('request')->input('gender');
}
else{
  $usergroupVar = @$seacrhresult->usergroup;
  $genderVar = @$seacrhresult->gender;
}

@endphp
<input type="hidden" value="{{ @$seacrhresult->maxage }}" id="hiddenmax">
<input type="hidden" value="{{ @$seacrhresult->minage }}" id="hiddenmin">
<input type="hidden" value="{{ @$genderVar }}" id="hiddengender">
<input type="hidden" value="{{ @$usergroupVar }}" id="hiddenusergroup">


@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
      var minage = $('#seeking option:selected').attr('minage');
        var maxage = $('#seeking option:selected').attr('maxage');
        var ids = $('#seeking option:selected').attr('role');
        var titles = $('#seeking option:selected').attr('titles');

        $('#minage_search').find('option').remove();
        $('#maxage_search').find('option').remove();
        for( var i = minage; i <= maxage-1+1; i++ ){
            $("#minage_search, #maxage_search").append('<option value="'+i+'">'+i+'</option>');
        }

        var ids = $('#seeking option:selected').attr('role');
        var titles = $('#seeking option:selected').attr('titles');
        var idparse = JSON.parse(ids)+'';
        var idtitle = JSON.parse(titles)+'';
        arr1 = idparse.split(',');
        arr2 = idtitle.split(',');
        for(i=0; i < arr1.length; i++){
          $("#gender_search").append('<option value="'+arr1[i]+'">'+arr2[i]+'</option>');
        }
      $('#seeking').on('change', function() {
        $("#gender_search option").remove();
        var minage = $('option:selected', this).attr('minage');
        var maxage = $('option:selected', this).attr('maxage');
        var ids = $('option:selected', this).attr('role');
        var titles = $('option:selected', this).attr('titles');
        var idparse = JSON.parse(ids)+'';
        var idtitle = JSON.parse(titles)+'';
        arr1 = idparse.split(',');
        arr2 = idtitle.split(',');
        for(i=0; i < arr1.length; i++){
          $("#gender_search").append('<option value="'+arr1[i]+'">'+arr2[i]+'</option>');
        }


        $('#minage_search').find('option').remove();
        $('#maxage_search').find('option').remove();
        for( var i = minage; i <= maxage-1+1; i++ ){
            $("#minage_search, #maxage_search").append('<option value="'+i+'">'+i+'</option>');
        }
      });
      var maxHide = $('#hiddenmax').val();
      var minHide = $('#hiddenmin').val();
      var genderHide = $('#hiddengender').val();
      var usergroupHide = $('#hiddenusergroup').val();
      $("#minage_search option[value="+minHide+"]").attr('selected', 'selected');
      $("#maxage_search option[value="+maxHide+"]").attr('selected', 'selected');
      $("#gender_search option[value="+genderHide+"]").attr('selected', 'selected');
      $("#seeking option[value="+usergroupHide+"]").attr('selected', 'selected');
    });
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection